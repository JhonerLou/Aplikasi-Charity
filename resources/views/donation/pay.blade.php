<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Complete Your Donation</h2>
    </x-slot>

    <div class="py-6 px-4 max-w-xl mx-auto">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <div class="mb-6 bg-blue-50 p-4 rounded-lg">
                <h3 class="text-lg font-medium text-blue-800">Donation Summary</h3>
                <div class="mt-2">
                    <p class="text-gray-600">Campaign: <span class="font-medium">{{ $donation->campaign->title }}</span></p>
                    <p class="text-gray-600">Amount: <span class="font-medium">${{ number_format($donation->amount, 2) }}</span></p>
                </div>
            </div>

            <form method="POST" action="{{ route('donation.process', $donation) }}" enctype="multipart/form-data">
                @csrf

                <!-- Payment method selection -->
                <div class="mb-6">
                    <h3 class="text-lg font-medium mb-4">Payment Method</h3>
                    <div class="space-y-4">
                        <div class="flex items-center">
                            <input id="cash" name="payment_method" type="radio" value="cash"
                                   class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300" checked>
                            <label for="cash" class="ml-3 block text-sm font-medium">Cash Payment</label>
                        </div>
                        <div class="flex items-center">
                            <input id="bank-transfer" name="payment_method" type="radio" value="bank_transfer"
                                   class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300">
                            <label for="bank-transfer" class="ml-3 block text-sm font-medium">Bank Transfer</label>
                        </div>
                    </div>
                </div>

                <!-- Bank Transfer Details -->
                <div id="bank-details" class="mb-6 hidden">
                    <div class="space-y-4">
                        <div>
                            <label for="bank_name" class="block text-sm font-medium text-gray-700">Bank Name</label>
                            <input type="text" id="bank_name" name="bank_name"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>

                        <div>
                            <label for="account_number" class="block text-sm font-medium text-gray-700">Account Number</label>
                            <input type="text" id="account_number" name="account_number"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>

                        <div>
                            <label for="account_holder_name" class="block text-sm font-medium text-gray-700">Account Holder Name</label>
                            <input type="text" id="account_holder_name" name="account_holder_name"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>

                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Upload Transfer Proof</label>
                            <input type="file" name="transfer_proof" class="w-full">
                        </div>
                    </div>
                </div>

                <button type="submit" class="w-full bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                    Complete Donation
                </button>
            </form>
        </div>
    </div>

    <script>
        document.querySelectorAll('input[name="payment_method"]').forEach(radio => {
            radio.addEventListener('change', function() {
                const bankDetails = document.getElementById('bank-details');
                bankDetails.classList.toggle('hidden', this.value !== 'bank_transfer');
            });
        });
    </script>
</x-app-layout>
