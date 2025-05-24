<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Donation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        if ($request->session()->has('dashboard_visited')) {
            return $this->redirectToDashboard();
        }

        $request->session()->put('dashboard_visited', true);

        return view('Dashboard');
    }

    public function redirectToDashboard()
    {
        return Auth::user()->role === 'admin'
            ? $this->adminDashboard()
            : $this->userDashboard();
    }

    private function adminDashboard()
    {
        return view('dashboard.admin', [
            'totalCampaigns'   => Campaign::count(),
            'totalDonations'  => Donation::count(),
            'raisedAmount'    => Donation::sum('amount'),
            'recentCampaigns' => Campaign::latest()->take(5)->get(),
            'recentDonations' => Donation::with('user', 'campaign')->latest()->take(5)->get(),
        ]);
    }

    private function userDashboard()
    {
        $user = Auth::user();

        return view('dashboard.user', [
            'myDonations' => Donation::where('user_id', $user->id)->with('campaign')->latest()->get(),
            'campaigns'   => Campaign::all(),
        ]);
    }
    private function adminCampaigns()
{
    $campaigns = Campaign::all();
    return view('dashboard.admin_campaigns', compact('campaigns'));
}
}
