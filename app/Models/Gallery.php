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
        'gallery_uuid',
        'gallery_judul',
        'gallery_rf',
        'gallery_foto',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->gallery_uuid)) {
                $model->gallery_uuid = (string) Str::uuid();
            }
        });
    }
}
