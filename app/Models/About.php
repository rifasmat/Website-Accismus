<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class About extends Model
{
    use HasFactory;

    protected $primaryKey = 'about_uuid';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'about_judul',
        'about_text',
        'about_foto',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->about_uuid)) {
                $model->about_uuid = (string) Str::uuid();
            }
        });
    }
}
