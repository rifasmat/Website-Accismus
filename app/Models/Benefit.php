<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Benefit extends Model
{
    use HasFactory;

    protected $primaryKey = 'benefit_uuid';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'benefit_judul',
        'benefit_text',
        'benefit_foto',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->benefit_uuid)) {
                $model->benefit_uuid = (string) Str::uuid();
            }
        });
    }
}
