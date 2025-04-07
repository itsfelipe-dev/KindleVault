<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Mail\SendHighlightEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;
class SendDailyHighlightEmail implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function handle()
    {

        $users = User::whereHas('smtpCredentials')->get();

        foreach ($users as $user) {

            $smtpCredentials = $user->smtpCredentials;


            $highlight = $user->highlights()
                ->whereRaw('LENGTH(text) > 20')
                ->inRandomOrder()
                ->first();
            $bookDetails = $highlight->book;

            if (!$highlight) {
                Log::warning("No highlight found for user {$user->email}");
                continue;
            }


            if ($smtpCredentials) {
                try {

                    config([
                        'mail.mailers.smtp.host' => $smtpCredentials->host,
                        'mail.mailers.smtp.port' => $smtpCredentials->port,
                        'mail.mailers.smtp.username' => $smtpCredentials->username,
                        'mail.mailers.smtp.password' =>  Crypt::decrypt($smtpCredentials->password),
                        'mail.mailers.smtp.encryption' => $smtpCredentials->encryption,
                        'mail.from.address' => $smtpCredentials->sender_email,
                        'mail.from.name' => env('APP_NAME'),
                    ]);


                    Mail::to($user->email)->send(new SendHighlightEmail($highlight, $bookDetails));

                    Log::info("Email sent to {$user->email} using their SMTP settings.");
                } catch (\Exception $e) {
                    Log::error("Error sending email to {$user->email}: " . $e->getMessage());
                }
            } else {
                Log::warning("No SMTP credentials found for user {$user->email}");
            }
        }
    }
}
