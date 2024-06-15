<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Informasi extends Model
{
    use HasFactory;

    protected $primaryKey = 'informasi_id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'informasi_uuid',
        'informasi_judul',
        'informasi_subjudul',
        'informasi_rf',
        'informasi_instagram',
        'informasi_discord',
        'informasi_wa',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->informasi_uuid)) {
                $model->informasi_uuid = (string) Str::uuid();
            }
        });
    }
}
