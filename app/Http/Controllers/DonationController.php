<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\Transaction;
use App\Models\Campaign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Mail;
use App\Mail\DonationReceipt;



class DonationController extends Controller
{
    public function index()
    {
        $donations = Donation::with('campaign', 'user')->latest()->paginate(10);
        return view('donation.index', compact('donations'));
    }
    public function create(Request $request)
    {
        $selectedCampaign = $request->query('campaign_id');
        $campaign = Campaign::findOrFail($selectedCampaign);

        return view('donation.create', [
            'selectedCampaign' => $selectedCampaign,
            'campaignTitle' => $campaign->title
        ]);
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'campaign_id' => 'required|exists:campaigns,id',
        'amount' => 'required|numeric|min:1',
        'message' => 'nullable|string|max:500',
        'name' => 'required_if:is_anonymous,false|string|max:255',
        'email' => 'required_if:is_anonymous,false|email|max:255',
        'is_anonymous' => 'boolean',
    ]);

    // Set is_anonymous to false if not provided in the request
    $is_anonymous = $request->has('is_anonymous') ? true : false;

    $donation = Donation::create([
        'user_id' => Auth::id(),
        'campaign_id' => $validated['campaign_id'],
        'amount' => $validated['amount'],
        'message' => $validated['message'],
        'donor_name' => $is_anonymous ? 'Anonymous' : $validated['name'],
        'donor_email' => $is_anonymous ? null : $validated['email'],
        'is_anonymous' => $is_anonymous,
        'payment_status' => 'pending',
    ]);

    return redirect()->route('donation.pay', $donation);
}

    public function pay(Donation $donation)
    {
        return view('donation.pay', compact('donation'));
    }

    public function processPayment(Request $request, Donation $donation)
    {
        $request->validate([
            'payment_method' => 'required|in:cash,bank_transfer',
            'transfer_proof' => 'required_if:payment_method,bank_transfer|file|mimes:jpg,jpeg,png,pdf|max:2048'
        ]);

        if ($request->payment_method === 'bank_transfer' && $request->hasFile('transfer_proof')) {
            $path = $request->file('transfer_proof')->store('transfer_proofs', 'public');
            $donation->transfer_proof = $path;
        }

        // Update donation status
        $donation->update([
            'payment_method' => $request->payment_method,
            'payment_status' => $request->payment_method === 'cash' ? 'pending' : 'completed',
            'paid_at' => $request->payment_method === 'cash' ? null : now(),
        ]);

        // Send receipt if not anonymous and payment is completed
        if (!$donation->is_anonymous && $donation->donor_email && $request->payment_method === 'bank_transfer') {
            Mail::to($donation->donor_email)->send(new DonationReceipt($donation));
        }

        return redirect()->route('donation.success', $donation);
    }

    public function success(Donation $donation)
    {
        return view('donation.success', compact('donation'))->with('redirect', route('dashboard'));
    }

    public function show(Donation $donation)
    {
        return view('donation.show', compact('donation'));
    }
}

