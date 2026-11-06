<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $email
 * @property string $locale
 */
class Subscriber extends Model
{
    protected $fillable = ['email', 'locale', 'ip_address'];
}
