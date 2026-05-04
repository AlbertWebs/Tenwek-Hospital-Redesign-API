<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    protected $fillable = ['group', 'key', 'value', 'type'];

    public static function get(string $key, $default = null)
    {
        $setting = Cache::remember("setting.{$key}", 3600, fn () => static::where('key', $key)->first());
        return $setting ? static::castValue($setting->value, $setting->type) : $default;
    }

    /**
     * @param  string|array|bool|int|null  $value
     */
    public static function put(string $key, $value, string $type = 'string', string $group = 'general'): void
    {
        $stored = match ($type) {
            'json' => json_encode($value),
            'boolean' => filter_var($value, FILTER_VALIDATE_BOOLEAN) ? '1' : '0',
            'integer' => (string) (int) $value,
            default => $value === null ? '' : (string) $value,
        };

        static::updateOrCreate(
            ['key' => $key],
            ['group' => $group, 'value' => $stored, 'type' => $type]
        );

        Cache::forget("setting.{$key}");
    }

    protected static function castValue(?string $value, string $type)
    {
        return match ($type) {
            'boolean' => filter_var($value, FILTER_VALIDATE_BOOLEAN),
            'json' => json_decode($value, true),
            'integer' => (int) $value,
            default => $value,
        };
    }
}
