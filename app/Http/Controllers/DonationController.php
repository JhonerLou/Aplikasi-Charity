<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use Illuminate\Support\Facades\File;
use App\Models\Campaign;
use Illuminate\Http\Request;
use Xendit\Configuration;
use Xendit\Invoice\InvoiceApi;
use Xendit\Invoice\CreateInvoiceRequest;


class DonationController extends Controller
{
    public function index()
    {
        // Show all donations (or paginated)
        $donation = Donation::with('campaign', 'user')->latest()->paginate(10);
        return view('donation.index', compact('donation'));
    }

    public function create(Request $request)
    {
        // Need a list of campaigns to choose from
        $campaigns = Campaign::pluck('title', 'id');
        $selectedCampaign = $request->query('campaign_id');

        return view('donation.create', compact('campaigns', 'selectedCampaign'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'campaign_id' => 'required|exists:campaign,id',
            'amount' => 'required|numeric|min:1',
            'message' => 'nullable|string|max:500',
        ]);
        $donation = Donation::create([
            'user_id' => auth()->id(),
            'campaign_id' => $request->campaign_id,
            'amount' => $request->amount,
            'message' => $request->message,
            'payment_status' => 'pending',
        ]);

        // Redirect to the pay.blade.php with the donation object
        return redirect()->route('donation.pay', $donation);

    }

    public function show(Donation $donation)
    {
        return view('donation.show', compact('donation'));
    }

    public function edit(Donation $donation)
    {
        $campaigns = Campaign::pluck('title', 'id');
        return view('donation.edit', compact('donation', 'campaign'));
    }

    public function update(Request $request, Donation $donation)
    {
        $data = $request->validate([
            'campaign_id' => 'required|exists:campaign,id',
            'amount' => 'required|numeric|min:1',
            'message' => 'nullable|string|max:500',
        ]);

        $donation->update($data);

        return redirect()->route('donation.show', $donation)
            ->with('success', 'Donation updated.');
    }

    public function destroy(Donation $donation)
    {
        $donation->delete();
        return redirect()->route('donation.index')
            ->with('success', 'Donation removed.');
    }


    // public function pay(Request $request, Donation $donation)
    // {
    //     MidtransConfig::init();

    //     $params = [
    //         'transaction_details' => [
    //             'order_id' => 'DON-' . $donation->id,
    //             'gross_amount' => (int)$donation->amount,
    //         ],
    //         'customer_details' => [
    //             'first_name' => $donation->user->name,
    //             'email' => $donation->user->email,
    //         ],
    //     ];

    //     $snapToken = \Midtrans\Snap::getSnapToken($params);

    //     return view('donation.pay', compact('snapToken', 'donation'));
    // }

}
