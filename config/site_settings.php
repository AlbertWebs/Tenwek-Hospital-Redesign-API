<?php

/**
 * Site-wide settings stored in the `settings` table (see SettingSeeder).
 * Keys, defaults, validation, and admin form labels.
 */
return [
    'items' => [
        'site_name' => [
            'group' => 'general',
            'label' => 'Site name',
            'default' => 'Tenwek Hospital',
            'rules' => 'required|string|max:160',
        ],
        'site_tagline' => [
            'group' => 'general',
            'label' => 'Site tagline',
            'default' => 'We Treat ~ Jesus Heals',
            'rules' => 'required|string|max:200',
        ],
        'layout_title_suffix' => [
            'group' => 'general',
            'label' => 'Browser title suffix',
            'hint' => 'Shown after the page title in the browser tab (e.g. “— Cardiothoracic Centre”).',
            'default' => 'Cardiothoracic Centre',
            'rules' => 'nullable|string|max:120',
        ],
        'top_bar_message' => [
            'group' => 'general',
            'label' => 'Top bar message (before ambulance number)',
            'default' => 'To book our ambulance, contact the Tenwek Hospital Coverage team on',
            'rules' => 'required|string|max:500',
        ],
        'phone_primary' => [
            'group' => 'contact',
            'label' => 'Primary phone (display)',
            'default' => '0700 499 699',
            'rules' => 'required|string|max:80',
        ],
        'phone_alt' => [
            'group' => 'contact',
            'label' => 'Alternate phones (display)',
            'default' => '0740 346 537 / 0728 091 900',
            'rules' => 'nullable|string|max:120',
        ],
        'email' => [
            'group' => 'contact',
            'label' => 'Main public email',
            'default' => 'customer.experience@tenwekhosp.org',
            'rules' => 'required|email|max:160',
        ],
        'address' => [
            'group' => 'contact',
            'label' => 'Postal / mailing address',
            'default' => 'P.O Box 39-20400 Bomet, Kenya',
            'rules' => 'required|string|max:300',
        ],
        'ambulance_phone' => [
            'group' => 'contact',
            'label' => 'Ambulance / coverage phone (display)',
            'default' => '0727 033 725',
            'rules' => 'required|string|max:80',
        ],
        'twitter' => [
            'group' => 'social',
            'label' => 'X (Twitter) URL',
            'default' => 'https://twitter.com/tenwekhospital',
            'rules' => 'nullable|string|max:500',
        ],
        'facebook' => [
            'group' => 'social',
            'label' => 'Facebook URL',
            'default' => 'https://www.facebook.com/tenwekhospital',
            'rules' => 'nullable|string|max:500',
        ],
        'youtube' => [
            'group' => 'social',
            'label' => 'YouTube URL',
            'default' => 'https://www.youtube.com/tenwekhospital',
            'rules' => 'nullable|string|max:500',
        ],
        'instagram' => [
            'group' => 'social',
            'label' => 'Instagram URL',
            'default' => 'https://www.instagram.com/tenwekhospital',
            'rules' => 'nullable|string|max:500',
        ],
        'linkedin' => [
            'group' => 'social',
            'label' => 'LinkedIn URL',
            'default' => '',
            'rules' => 'nullable|string|max:500',
        ],
        'meta_title_default' => [
            'group' => 'seo',
            'label' => 'Default meta title',
            'default' => 'Tenwek Hospital | We Treat ~ Jesus Heals',
            'rules' => 'required|string|max:200',
        ],
        'meta_description_default' => [
            'group' => 'seo',
            'label' => 'Default meta description',
            'default' => 'Tenwek Hospital is a Level 5 Teaching and Referral Mission Hospital in Bomet County, Kenya. Compassionate healthcare, cardiothoracic centre, training.',
            'rules' => 'required|string|max:500',
        ],
        'meta_keywords' => [
            'group' => 'seo',
            'label' => 'Default meta keywords',
            'hint' => 'Comma-separated. Optional; used in the site-wide default meta keywords tag.',
            'default' => '',
            'rules' => 'nullable|string|max:500',
        ],
    ],

    'group_labels' => [
        'general' => 'General & branding',
        'contact' => 'Contact details',
        'social' => 'Social media',
        'seo' => 'SEO defaults',
    ],
];
