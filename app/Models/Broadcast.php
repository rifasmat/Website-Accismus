<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Broadcast extends Model
{
    use HasFactory;

    protected $primaryKey = 'broadcast_id';
    protected $keyType = 'int';
    public $incrementing = false;

    protected $fillable = [
        'broadcast_uuid',
        'broadcast_sentby',
        'broadcast_pengirim_email',
        'broadcast_subject',
        'broadcast_penerima',
        'broadcast_pesan',
        'broadcast_tanggal',
        'broadcast_status',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->broadcast_uuid)) {
                $model->broadcast_uuid = (string) Str::uuid();
            }
        });
    }
}
