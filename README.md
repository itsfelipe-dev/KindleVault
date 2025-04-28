# KindleVault
Tool that allows users to upload their Kindle highlights, receive daily notifications with selected highlights, and browse through their saved highlights effortlessly. ✨



## 🚀 Features

* **📥 Kindle Highlight Upload:** Easily import your Kindle highlights from HTML files.
![Highlight Upload](https://github.com/itsfelipe-dev/KindleVault/blob/main/docs/assets/upload_highlight.png?raw=true)

* **📚 Book and Highlight Viewing:** Browse and review your highlights organized by book.
* **📝 Add Personal Notes**: Attach your own thoughts or reflections to each highlight.
![Highlight View](https://github.com/itsfelipe-dev/kindleVault/blob/main/docs/assets/view_highlight.png?raw=true)

* **⏰ Scheduled Email Notifications:** Receive daily email digests of your highlights at configured times.  
![Email Notifications](https://github.com/itsfelipe-dev/KindleVault/blob/main/docs/assets/email_notification.png?raw=true)

> **✨ Quote**
>
> "To read without reflecting is like eating without digesting."
— **Edmund Burke**

## Installation

1.  **Clone the repository:**

    ```bash
    git clone https://github.com/itsfelipe-dev/KindleVault.git
    cd KindleVault
    ```

2.  **Install Composer dependencies:**

    ```bash
    composer install
    ```

3.  **Copy the `.env.example` file and configure your environment variables:**

    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

    Edit the `.env` file to set up your database connection, email settings, and other environment-specific configurations.

4.  **Run database migrations:**

    ```bash
    php artisan migrate
    ```

5.  **Serve the application:**

    ```bash
    php artisan serve
    ```

    You can then access the application in your browser, usually at `http://localhost:8000`, and create a new account.


## Configuration
### Email Notification 
#### SMTP Configuration
Each user must configure their SMTP settings via their profile page (user/profile).

![SMTP Settings](https://github.com/itsfelipe-dev/kindleVault/blob/main/docs/assets/smtp_settings.png?raw=true)

#### Scheduled Email Settings

The scheduling for the daily highlight emails is configured in the `app/Console/Kernel.php` file. By default, the application is set to send emails twice daily at 9:00 AM and 7:00 PM server time:

```php
$schedule->job(new \App\Jobs\SendDailyHighlightEmail)->twiceDaily(9, 19);
```

##### To modify these settings:
To modify the frequency, update the scheduler using any Laravel scheduling methods.
[Schedule Frequency Options](https://laravel.com/docs/11.x/scheduling#schedule-frequency-options)
#### Queue Worker

This application utilizes Laravel Queues to handle email notifications. To start the queue worker, run the following command:

```bash
php artisan queue:work
```

##### Scheduling Cron Job
```bash
* * * * * php /path/to/your/project/artisan schedule:run >> /dev/null 2>&1
```
##### Customizing the Email Content
The email template is located at resources/views/emails/highlight.blade.php.
