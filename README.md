<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
  <a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
  <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
  <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
  <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# AnasAcademyTest

## Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/amrachraf6699/AnasAcademyTest.git
   ```

2. Navigate into the project directory:
   ```bash
   cd AnasAcademyTest
   ```

3. Install the dependencies using Composer:
   ```bash
   composer install
   ```

4. Copy the `.env.example` file to `.env`:
   ```bash
   cp .env.example .env
   ```

5. Generate the application key:
   ```bash
   php artisan key:generate
   ```

6. Set up your **Stripe** credentials in the `.env` file:
   ```bash
   STRIPE_KEY=your_stripe_key
   STRIPE_SECRET=your_stripe_secret
   STRIPE_WEBHOOK_SECRET=your_stripe_webhook_key
   ```

7. Run the migration and seeder
   ```bash
   php artisan migrate --seed
   ```

8. Serve the application:
   ```bash
   php artisan serve
   ```

Now you can access the project at `http://localhost:8000`.

## Stripe Integration

This project demonstrates how to integrate Stripe for handling payments:

- **Checkout Page**: Users can enter their card details to make payments.
- **Payment Confirmation**: Stripe handles the payment process and updates the payment status accordingly.
- **Webhook**: The system can listen to Stripe's webhook events to verify the status of payments.

### Stripe Webhook

To process webhook events from Stripe (like successful payments), ensure you have set up your webhook endpoint correctly. You can use the following endpoint in your **Stripe Dashboard**:
```bash
http://your-app-url/stripe/webhook
```

Make sure the webhook handler is set up to listen for events such as `payment_intent.succeeded` and `payment_intent.failed`.