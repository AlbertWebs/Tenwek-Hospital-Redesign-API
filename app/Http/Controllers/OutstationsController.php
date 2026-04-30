<?php

namespace App\Http\Controllers;

use App\Models\Outstation;
use Illuminate\View\View;

class OutstationsController extends Controller
{
    public function index(): View
    {
        $outstations = Outstation::published()
            ->orderBy('order')
            ->orderBy('name')
            ->get();

        $markers = $outstations
            ->filter(fn (Outstation $o) => $o->hasMapCoordinates())
            ->map(fn (Outstation $o) => [
                'slug' => $o->slug,
                'name' => $o->name,
                'lat' => (float) $o->latitude,
                'lng' => (float) $o->longitude,
                'url' => route('outstations.show', $o),
            ])
            ->values();

        return view('outstations.index', compact('outstations', 'markers'));
    }

    public function show(Outstation $outstation): View
    {
        if (! $outstation->is_published) {
            abort(404);
        }

        $outstationsNav = Outstation::published()
            ->where('id', '!=', $outstation->id)
            ->orderBy('order')
            ->orderBy('name')
            ->limit(12)
            ->get();

        return view('outstations.show', [
            'outstation' => $outstation,
            'outstationsNav' => $outstationsNav,
        ]);
    }
}
