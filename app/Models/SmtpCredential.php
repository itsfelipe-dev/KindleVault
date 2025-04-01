<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmtpCredential extends Model
{
    use HasFactory;

    protected $table = 'smtp_credentials';

    protected $fillable = [
        'user_id',
        'host',
        'port',
        'username',
        'password',
        'encryption',
        'sender_email',
    ];

    /**
     * Get the user that owns the SMTP credentials.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
