<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string|null $subject
 * @property string $message
 * @property string $locale
 * @property \Illuminate\Support\Carbon|null $mailed_at
 * @property \Illuminate\Support\Carbon $created_at
 */
class Enquiry extends Model
{
    protected $fillable = ['name', 'email', 'subject', 'message', 'locale', 'ip_address', 'user_agent', 'mailed_at'];

    protected function casts(): array
    {
        return ['mailed_at' => 'datetime'];
    }
}
