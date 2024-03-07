# Laravel Card-to-Card App

This Laravel project allows users to perform simple card-to-card transfers with built-in validations. Additionally, it enhances user experience by sending SMS notifications after each successful transaction using Laravel Queue and Redis for optimal performance.

## Getting Started

Follow these steps to get the app up and running on your local environment:

1. **Migrate Database:**
   Execute the following Artisan command to migrate the database:
   ```
   php artisan migrate
   ```
2. **Run the Application:**
   Start the Laravel development server with the following command:
   ```
   docker-compose up -d
   php artisan serve
   ```
3. **Run Queue Workers:**
   To enable SMS functionality, run the queue listener to process and send SMS in the background:
   ```
   php artisan queue:listen --queue=queue:ctc:transactions:sms
   ```
4. **Configuration:**
   Replace the placeholders with your actual API key and sender number in the .env file:
   ```
   'KAVENEGAR_API_KEY' => 'your_api_key',
   'SMS_SENDER' => 'your_sender_number',
   ```

Now, you're ready to use the new SMS provider in your Laravel Card-to-Card Transfer App.

