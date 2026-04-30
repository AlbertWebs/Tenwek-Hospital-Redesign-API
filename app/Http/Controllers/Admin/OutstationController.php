<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Outstation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class OutstationController extends Controller
{
    public function index(): View
    {
        $outstations = Outstation::orderBy('order')->orderBy('name')->paginate(20);

        return view('admin.outstations.index', compact('outstations'));
    }

    public function create(): View
    {
        return view('admin.outstations.create', ['outstation' => new Outstation]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateOutstation($request);
        Outstation::create($validated);

        return redirect()->route('admin.outstations.index')->with('success', 'Outstation created.');
    }

    public function edit(Outstation $outstation): View
    {
        return view('admin.outstations.edit', compact('outstation'));
    }

    public function update(Request $request, Outstation $outstation): RedirectResponse
    {
        $validated = $this->validateOutstation($request, $outstation);
        $outstation->update($validated);

        return redirect()->route('admin.outstations.index')->with('success', 'Outstation updated.');
    }

    public function destroy(Outstation $outstation): RedirectResponse
    {
        $outstation->delete();

        return redirect()->route('admin.outstations.index')->with('success', 'Outstation deleted.');
    }

    protected function validateOutstation(Request $request, ?Outstation $existing = null): array
    {
        $request->merge([
            'slug' => $request->filled('slug') ? trim($request->input('slug')) : null,
        ]);

        $slugRule = $existing
            ? 'required|string|max:255|unique:outstations,slug,'.$existing->id
            : 'nullable|string|max:255|unique:outstations,slug';

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => $slugRule,
            'summary' => 'nullable|string',
            'content' => 'nullable|string',
            'address' => 'nullable|string',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'phone' => 'nullable|string|max:64',
            'email' => 'nullable|email|max:255',
            'order' => 'nullable|integer|min:0|max:65535',
            'is_published' => 'boolean',
        ]);

        $validated['slug'] = $validated['slug'] ?? Str::slug($validated['name']);
        $validated['is_published'] = $request->boolean('is_published');
        $validated['order'] = (int) ($validated['order'] ?? 0);
        foreach (['latitude', 'longitude'] as $coord) {
            if ($validated[$coord] === '' || $validated[$coord] === null) {
                $validated[$coord] = null;
            }
        }

        return $validated;
    }
}
