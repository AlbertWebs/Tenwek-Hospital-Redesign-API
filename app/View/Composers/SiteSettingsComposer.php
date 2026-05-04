<?php

namespace App\View\Composers;

use App\Models\Setting;
use App\Support\SiteSettingDefaults;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class SiteSettingsComposer
{
    public function compose(View $view): void
    {
        $defaults = SiteSettingDefaults::items();
        $site = $defaults;

        if (Schema::hasTable('settings')) {
            foreach (array_keys($defaults) as $key) {
                $site[$key] = (string) Setting::get($key, $defaults[$key]);
            }
        }

        $site['primary_tel_href'] = SiteSettingDefaults::telHrefFromDisplay($site['phone_primary'] ?? '');
        $site['ambulance_tel_href'] = SiteSettingDefaults::telHrefFromDisplay($site['ambulance_phone'] ?? '');

        $view->with('site', $site);
    }
}
