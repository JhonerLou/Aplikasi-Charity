<?php

namespace App\Http\Controllers;

use App\Models\Donation;
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


    public function pay(Request $request, Donation $donation)
    {
        Xendit::setApiKey(env('xnd_public_development_j_kiheSF71qe9PigQUBS1VxmUDiqOQ9ESkgdl8z1gWv2NnTMHdrQmCODx5gyqNbm'));

        $params = [
            'external_id' => 'donation-' . $donation->id,
            'payer_email' => $donation->user->email,
            'description' => 'Donation for: ' . $donation->campaign->title,
            'amount' => (int) $donation->amount,
        ];

        $invoice = \Xendit\Invoice::create($params);

        // Optional: Save invoice ID or status
        $donation->update([
            'payment_status' => 'pending',
            'xendit_invoice_id' => $invoice['id'],
        ]);

        return redirect($invoice['invoice_url']);
    }

}
