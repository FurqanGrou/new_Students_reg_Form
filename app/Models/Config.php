<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    use HasFactory;

    protected $fillable = [
        'key', 'value',
    ];

    protected $primaryKey = 'key';
    public $timestamps = false;

    public static function getValue($key, $default = '')
    {
        return static::find($key)->value ?? $default;
    }

    public static function setValue($key, $value)
    {
        static::query()->updateOrCreate([
            'key' => $key,
        ], [
            'value' => $value,
        ]);

    }
}
