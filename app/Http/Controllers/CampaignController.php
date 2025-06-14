<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CampaignController extends Controller
{

    public function index(Request $request)
    {
        $query = Campaign::query()->with('user');
        $validated = $request->validate([
            'search' => 'nullable|string|max:255',
            'category' => 'nullable|in:natural disaster,orphanage,needs crisis,special needs'
        ]);



        // Search functionality
        if (!empty($validated['search'])) {
            $query->where(function ($q) use ($validated) {
                $q->where('title', 'like', "%{$validated['search']}%")
                    ->orWhere('description', 'like', "%{$validated['search']}%");
            });
        }

        // Category filter
        if ($request->has('category')) {
            $query->where('category', $request->input('category'));
        }

        $campaign = $query->paginate(12);
        return view('campaign.index', compact('campaign'));
    }

    public function create()
    {
        $categories = ['Natural Disaster', 'Orphanage', 'Needs Crisis', 'Special Needs'];
        return view('campaign.create', compact('categories'));
    }

    public function store(Request $request)
    {

        $validated = $request->validate([

            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'target_amount' => 'required|numeric|min:1',
            'contact_email' => 'nullable|email',
            'category' => 'required|in:Natural Disaster,Orphanage,Needs Crisis,Special Needs',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $campaign = new Campaign($validated);
        $campaign->user_id = auth()->id();

        $data = $request->all();
        $data['user_id'] = auth()->id();

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('campaign_images', 'public');
            $data['image'] = $imagePath;
        }

        Campaign::create($data);
        $campaign->save();

        return redirect()->route('campaign.index')
            ->with('success', 'Campaign created.');
    }

    public function show(Campaign $campaign)
    {
        $campaign->load('donation');
        return view('campaign.index', compact('campaign'));
    }

    public function edit(Campaign $campaign)
    {
        if (auth()->id() !== $campaign->user_id && !auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }
        $categories = ['Natural Disaster', 'Orphanage', 'Needs Crisis', 'Special Needs'];
        return view('campaign.edit', compact('campaign', 'categories'));
    }

    public function update(Request $request, Campaign $campaign)
    {
        if (auth()->id() !== $campaign->user_id && !auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'target_amount' => 'required|numeric|min:1',
            'contact_email' => 'nullable|email',
            'category' => 'required|in:Natural Disaster,Orphanage,Needs Crisis,Special Needs',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',

        ]);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($campaign->image) {
                Storage::disk('public')->delete($campaign->image);
            }

            $imagePath = $request->file('image')->store('campaign_images', 'public');
            $data['image'] = $imagePath;
        }

        $campaign->update($data);

        return redirect()->route('campaign.index')
            ->with('success', 'Campaign updated.');
    }

    public function destroy(Campaign $campaign)
    {
        if ($campaign->image) {
            Storage::disk('public')->delete($campaign->image);
        }
        $campaign->delete();

        return redirect()->route('campaign.index')
            ->with('success', 'Campaign deleted.');
    }


}
