<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\Campaign;
use Illuminate\Http\Request;

class DonationController extends Controller
{
    public function index()
    {
        // Show all donations (or paginated)
        $donations = Donation::with('campaign', 'user')->latest()->paginate(10);
        return view('donations.index', compact('donations'));
    }

    public function create()
    {
        // Need a list of campaigns to choose from
        $campaigns = Campaign::pluck('title','id');
        return view('donations.create', compact('campaigns'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'campaign_id'   => 'required|exists:campaigns,id',
            'amount'        => 'required|numeric|min:1',
            'message'       => 'nullable|string|max:500',
        ]);

        // Add any additional fields, e.g. user_id, payment_status
        $data['user_id']      = auth()->id();
        $data['payment_status'] = 'pending';
        $data['donated_at']   = now();

        Donation::create($data);

        return redirect()->route('donations.index')
                         ->with('success','Thank you for your donation!');
    }

    public function show(Donation $donation)
    {
        return view('donations.show', compact('donation'));
    }

    public function edit(Donation $donation)
    {
        $campaigns = Campaign::pluck('title','id');
        return view('donations.edit', compact('donation','campaigns'));
    }

    public function update(Request $request, Donation $donation)
    {
        $data = $request->validate([
            'campaign_id'   => 'required|exists:campaigns,id',
            'amount'        => 'required|numeric|min:1',
            'message'       => 'nullable|string|max:500',
            'payment_status'=> 'required|in:pending,completed,failed,refunded',
        ]);

        $donation->update($data);

        return redirect()->route('donations.show', $donation)
                         ->with('success','Donation updated.');
    }

    public function destroy(Donation $donation)
    {
        $donation->delete();
        return redirect()->route('donations.index')
                         ->with('success','Donation removed.');
    }
}
