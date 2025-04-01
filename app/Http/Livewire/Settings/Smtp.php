<?php

namespace App\Http\Livewire\Settings;

use Livewire\Component;
// use App\Models\user;
use Illuminate\Support\Facades\Crypt;
class Smtp extends Component
{
    public $host, $port, $username, $password, $encryption, $sender_email;
    public function mount()
    {

        $smtpCredentials = auth()->user()->smtpCredentials;

        if ($smtpCredentials) {
            $this->host = $smtpCredentials->host;
            $this->port = $smtpCredentials->port;
            $this->username = $smtpCredentials->username;
            $this->encryption = $smtpCredentials->encryption;
            $this->sender_email = $smtpCredentials->sender_email;
        }
    }
    public function saveSmtpSettings()
    {
        $this->validate([
            'host' => 'required',
            'port' => 'required|integer',
            'username' => 'required',
            'password' => 'required',
            'sender_email' => 'required|email',
        ]);

    
        $user = auth()->user();
        $user->smtpCredentials()->updateOrCreate([
            'user_id' => $user->id,
        ], [
            'host' => $this->host,
            'port' => $this->port,
            'username' => $this->username,
            'password' => Crypt::encrypt($this->password),
            'encryption' => $this->encryption,
            'sender_email' => $this->sender_email,
        ]);

        session()->flash('message', 'SMTP Settings Saved!');
    }

    public function render()
    {
        return view('livewire.settings.smtp');
    }

}
