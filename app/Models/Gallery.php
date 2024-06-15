<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Gallery extends Model
{
    use HasFactory;

    protected $primaryKey = 'gallery_id';
    protected $keyType = 'int';
    public $incrementing = true;

    protected $fillable = [
        'galleries_uuid',
        'galleries_judul',
        'galleries_rf',
        'galleries_foto',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->galleries_uuid)) {
                $model->galleries_uuid = (string) Str::uuid();
            }
        });
    }
}
