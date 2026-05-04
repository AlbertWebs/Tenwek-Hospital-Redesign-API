<?php

namespace App\Support;

class SiteSettingDefaults
{
    /**
     * @return array<string, string>
     */
    public static function items(): array
    {
        $out = [];
        foreach (config('site_settings.items', []) as $key => $meta) {
            $out[$key] = (string) ($meta['default'] ?? '');
        }

        return $out;
    }

    /**
     * @return array<string, array{group: string, label: string, hint?: string, rules: string}>
     */
    public static function definitions(): array
    {
        $defs = [];
        foreach (config('site_settings.items', []) as $key => $meta) {
            $defs[$key] = [
                'group' => (string) ($meta['group'] ?? 'general'),
                'label' => (string) ($meta['label'] ?? $key),
                'hint' => isset($meta['hint']) ? (string) $meta['hint'] : null,
                'rules' => (string) ($meta['rules'] ?? 'nullable|string|max:500'),
            ];
        }

        return $defs;
    }

    public static function groupLabels(): array
    {
        return config('site_settings.group_labels', []);
    }

    /**
     * Kenya-oriented tel: href from a display number (digits, spaces, slashes).
     */
    public static function telHrefFromDisplay(?string $display): string
    {
        $digits = preg_replace('/\D+/', '', (string) $display);
        if ($digits === '') {
            return '#';
        }
        if (str_starts_with($digits, '254')) {
            return 'tel:+'.$digits;
        }
        if (str_starts_with($digits, '0')) {
            return 'tel:+254'.substr($digits, 1);
        }

        return 'tel:+'.$digits;
    }
}
