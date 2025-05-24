{{-- <x-app-layout>
    <h2 class="text-xl font-bold">Proceed with Payment</h2>
    <button id="pay-button" class="bg-indigo-600 text-white px-4 py-2 rounded mt-4">
        Pay Now
    </button>

    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
    <script type="text/javascript">
        document.getElementById('pay-button').onclick = function () {
            window.snap.pay('{{ $snapToken }}', {
                onSuccess: function(result) {
                    console.log(result);
                    window.location.href = '{{ route('donation.success') }}';
                },
                onPending: function(result) {
                    console.log(result);
                },
                onError: function(result) {
                    console.log(result);
                }
            });
        };
    </script>
</x-app-layout> --}}
