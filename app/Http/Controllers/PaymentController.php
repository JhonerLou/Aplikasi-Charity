<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Xendit\Invoice\InvoiceApi;
use Xendit\Configuration;
use App\Models\Campaign;
use App\Models\Donation;

class PaymentController extends Controller
{
    public function __construct()
    {
        Configuration::setXenditKey(env('XENDIT_SECRET_KEY'));
    }

    public function createInvoice(Request $request)
    {
        $request->validate([
            'campaign_id' => 'required|exists:campaign,id',
            'amount' => 'required|numeric|min:1',
        ]);

        $campaign = Campaign::findOrFail($request->campaign_id);
        $user = auth()->user();

        $params = [
            'external_id' => 'donation-' . uniqid(),
            'payer_email' => $user->email,
            'description' => 'Donation for ' . $campaign->title,
            'amount' => $request->amount,
            'success_redirect_url' => route('payment.success'),
            'failure_redirect_url' => route('payment.failure'),
        ];

        $invoiceApi = new InvoiceApi();
        $invoice = $invoiceApi->createInvoice($params);

        return redirect($invoice['invoice_url']);
    }

    public function success()
    {
        // Handle successful payment
        return view('payment.success');
    }

    public function failure()
    {
        // Handle failed payment
        return view('payment.failure');
    }
}
