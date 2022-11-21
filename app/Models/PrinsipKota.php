<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PrinsipKota extends Model
{
    use HasFactory;

    protected $table = 'beranda.prinsip_kota';
    protected $fillable = ['title', 'desc', 'image'];

    protected $primaryKey = 'id';
    protected $keyType = 'string';

    public $incrementing = false;

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = Str::uuid();
            }
        });
    }
}