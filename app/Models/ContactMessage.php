<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    protected $fillable = [
        'name',
        'email',
        'message',
        'ip_hash',
    ];

    // Keeps response from including the ip hash for safety.
    protected $hidden = [
        'ip_hash',
    ];
}
