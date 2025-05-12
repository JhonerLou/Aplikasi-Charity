<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    public function index()
    {
        $campaign = Campaign::all();
        return view('campaign.index', compact('campaign'));
    }

    public function create()
    {
        return view('campaign.create');
    }

    public function store(Request $request)
    {
        $request->validate([

            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'target_amount' => 'required|numeric|min:1',
            'contact_email' => 'nullable|email',
            'image'         => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('campaign_images', 'public');
            $data['image'] = $imagePath;
        }


        Campaign::create($data);

        return redirect()->route('dashboard')
                         ->with('success','Campaign created.');
    }

    public function show(Campaign $campaign)
    {
        $campaign->load('donation');
        return view('campaign.index', compact('campaign'));
    }

    public function edit(Campaign $campaign)
    {
        return view('campaign.edit', compact('campaign'));
    }

    public function update(Request $request, Campaign $campaign)
    {
        $data = $request->validate([
            'title'         => 'required|string|max:255',
            'description'   => 'nullable|string',
            'target_amount' => 'required|numeric|min:1',
            'contact_email' => 'nullable|email',
            'image'         => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',

        ]);

        $campaign->update($data);

        return redirect()->route('campaign.index', $campaign)
                         ->with('success','Campaign updated.');
    }

    public function destroy(Campaign $campaign)
    {
        $campaign->delete();

        return redirect()->route('campaign.index')
                         ->with('success','Campaign deleted.');
    }


}
