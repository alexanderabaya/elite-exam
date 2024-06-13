<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class ForgotPassword extends Model
{
    use HasFactory;

    use HasFactory;
    protected $table = 'forgot_password';

    protected $fillable = [
        'user_id',
        'token',
        'created_at',
        'updated_at',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
    }
}
