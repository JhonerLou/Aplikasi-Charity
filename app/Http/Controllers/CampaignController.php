<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    public function index()
    {
        $campaigns = Campaign::all();
        return view('campaigns.index', compact('campaigns'));
    }

    public function create()
    {
        return view('campaigns.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'         => 'required|string|max:255',
            'description'   => 'nullable|string',
            'target_amount' => 'required|numeric|min:1',
        ]);

        Campaign::create($data);

        return redirect()->route('campaigns.index')
                         ->with('success','Campaign created.');
    }

    public function show(Campaign $campaign)
    {
        $campaign->load('donations');
        return view('campaigns.show', compact('campaign'));
    }

    public function edit(Campaign $campaign)
    {
        return view('campaigns.edit', compact('campaign'));
    }

    public function update(Request $request, Campaign $campaign)
    {
        $data = $request->validate([
            'title'         => 'required|string|max:255',
            'description'   => 'nullable|string',
            'target_amount' => 'required|numeric|min:1',
        ]);

        $campaign->update($data);

        return redirect()->route('campaigns.show', $campaign)
                         ->with('success','Campaign updated.');
    }

    public function destroy(Campaign $campaign)
    {
        $campaign->delete();

        return redirect()->route('campaigns.index')
                         ->with('success','Campaign deleted.');
    }
}
