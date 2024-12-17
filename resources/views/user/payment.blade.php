<x-app-layout>
    <x-slot name="header">
        <h2 style="font-size: 1.25rem; font-weight: bold; color: #2d3748;">
            {{ __('Payment Page') }}
        </h2>
    </x-slot>

    <div style="padding: 3rem 0;">
        <div style="max-width: 1120px; margin: 0 auto; padding: 0 1.5rem;">
            <div style="background-color: #fff; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); border-radius: 0.5rem;">
                <div style="padding: 1.5rem;">
                    <h3 style="font-size: 1.25rem; font-weight: bold; margin-bottom: 1rem;">
                        Pay for {{ $product->name }}
                    </h3>
                    <p style="margin-bottom: 1rem;">Price: <strong>${{ $product->price }}</strong></p>

                    @if (session('success'))
                        <p style="color: #38a169; margin-bottom: 1rem;">{{ session('success') }}</p>
                    @endif

                    @if ($errors->any())
                        <p style="color: #e53e3e; margin-bottom: 1rem;">{{ $errors->first() }}</p>
                    @endif

                    <form id="payment-form" method="POST" action="{{ route('pay.store') }}">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                        <label for="card-element" style="display: block; font-weight: 500; margin-bottom: 0.5rem; color: #4a5568;">
                            Card Details
                        </label>
                        <div id="card-element" style="border: 1px solid #cbd5e0; padding: 0.75rem; border-radius: 0.375rem;"></div>

                        <input type="hidden" id="stripeToken" name="stripeToken">

                        <button type="submit" 
                                style="margin-top: 1rem; background-color: #3182ce; color: #ffffff; font-weight: bold; padding: 0.5rem 1rem; border-radius: 0.375rem; border: none; cursor: pointer;">
                            Pay Now
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://js.stripe.com/v3/"></script>
    <script>
        const stripe = Stripe("{{ config('services.stripe.key') }}");
        const elements = stripe.elements();
        const card = elements.create('card');
        card.mount('#card-element');

        const form = document.getElementById('payment-form');
        form.addEventListener('submit', async (event) => {
            event.preventDefault();

            const { token, error } = await stripe.createToken(card);

            if (error) {
                alert(error.message);
            } else {
                document.getElementById('stripeToken').value = token.id;
                form.submit();
            }
        });
    </script>
</x-app-layout>
