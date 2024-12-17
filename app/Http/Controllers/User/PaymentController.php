<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProcessPaymentRequest;
use App\Models\Payment;
use App\Models\Product;
use Illuminate\Http\Request;
use Stripe\Charge;
use Stripe\Stripe;
use Stripe\Webhook;

class PaymentController extends Controller
{
    public function index()
    {
        $product = Product::inRandomOrder()->first();
        return view('user.payment', compact('product'));
    }

    public function store(ProcessPaymentRequest $request)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        $product = Product::findOrFail($request->input('product_id'));

        $payment = Payment::create([
            'product_id' => $product->id,
            'user_id' => auth()->id(),
            'status' => 'pending',
        ]);

        try {
            $paymentIntent = \Stripe\PaymentIntent::create([
                'amount' => $product->price * 100,
                'currency' => 'usd',
                'description' => 'Payment for ' . $product->name,
                'payment_method' => $request->input('stripeToken'),
                'confirmation_method' => 'manual',
                'confirm' => true,
            ]);

            $payment->update([
                'stripe_payment_intent_id' => $paymentIntent->id,
                'stripe_payment_id' => $paymentIntent->charges->data[0]->id,
                'status' => 'success',
            ]);

            return redirect()->route('payment.success');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Payment failed: ' . $e->getMessage()]);
        }
    }


    public function webhook(Request $request)
    {
        $payload = $request->getContent();
        $sigHeader = $request->header('Stripe-Signature');
        $endpointSecret = config('services.stripe.webhook_secret');

        try {
            $event = Webhook::constructEvent($payload, $sigHeader, $endpointSecret);
        } catch (\UnexpectedValueException $e) {
            return response()->json(['error' => 'Invalid payload'], 400);
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            return response()->json(['error' => 'Invalid signature'], 400);
        }

        switch ($event->type) {
            case 'payment_intent.succeeded':
                $paymentIntent = $event->data->object;
                $payment = Payment::where('stripe_payment_id', $paymentIntent->id)->first();
                if ($payment) {
                    $payment->status = 'succeeded';
                    $payment->save();
                }
                break;

            case 'payment_intent.payment_failed':
                $paymentIntent = $event->data->object;
                $payment = Payment::where('stripe_payment_id', $paymentIntent->id)->first();
                if ($payment) {
                    $payment->status = 'failed';
                    $payment->save();
                }
                break;

            default:
                return response()->json(['error' => 'Unhandled event type'], 400);
        }

        return response()->json(['status' => 'success'], 200);
    }
}
