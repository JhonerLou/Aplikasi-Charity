<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\Campaign;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Check if user has already seen the transition page in this session
        if ($request->session()->has('dashboard_visited')) {
            return $this->redirectToDashboard();
        }

        // Mark that the user has seen the transition page
        $request->session()->put('dashboard_visited', true);

        // Show the transition dashboard page
        return view('dashboard');
    }

    public function redirectToDashboard()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            return $this->adminDashboard();
        } else {
            return $this->userDashboard();
        }
    }

    private function adminDashboard()
    {
        // Stats
        $totalCampaigns  = Campaign::count();
        $totalDonations  = Donation::count();
        $raisedAmount    = Donation::sum('amount');

        // Recent activity
        $recentCampaigns = Campaign::latest()->take(5)->get();
        $recentDonations = Donation::with('user','campaign')
                                 ->latest()->take(5)->get();

        return view('dashboard.admin', compact(
            'totalCampaigns',
            'totalDonations',
            'raisedAmount',
            'recentCampaigns',
            'recentDonations'
        ));
    }

    private function userDashboard()
    {
        $user = Auth::user();

        // Their own donations
        $myDonations     = Donation::where('user_id', $user->id)
                                  ->with('campaign')
                                  ->latest()
                                  ->get();

        // Available campaigns to donate to
        $campaigns       = Campaign::all();

        return view('dashboard.user', compact(
            'myDonations',
            'campaigns'
        ));
    }
}
