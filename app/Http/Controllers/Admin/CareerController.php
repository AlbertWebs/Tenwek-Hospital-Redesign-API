<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Career;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class CareerController extends Controller
{
    public function index(): View
    {
        $careers = Career::orderBy('order')->orderBy('closing_date', 'desc')->orderBy('created_at', 'desc')->paginate(20);
        return view('admin.careers.index', compact('careers'));
    }

    public function create(): View
    {
        return view('admin.careers.create', ['career' => new Career]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:careers,slug',
            'department' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'employment_type' => 'nullable|string|max:64',
            'description' => 'nullable|string',
            'requirements' => 'nullable|string',
            'responsibilities' => 'nullable|string',
            'closing_date' => 'nullable|date',
            'is_published' => 'boolean',
        ]);
        $validated['slug'] = $validated['slug'] ?? Str::slug($validated['title']);
        $validated['is_published'] = $request->boolean('is_published');
        Career::create($validated);
        return redirect()->route('admin.careers.index')->with('success', 'Job listing created.');
    }

    public function edit(Career $career): View
    {
        return view('admin.careers.edit', compact('career'));
    }

    public function update(Request $request, Career $career): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:careers,slug,' . $career->id,
            'department' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'employment_type' => 'nullable|string|max:64',
            'description' => 'nullable|string',
            'requirements' => 'nullable|string',
            'responsibilities' => 'nullable|string',
            'closing_date' => 'nullable|date',
            'is_published' => 'boolean',
        ]);
        $validated['is_published'] = $request->boolean('is_published');
        $career->update($validated);
        return redirect()->route('admin.careers.index')->with('success', 'Job listing updated.');
    }

    public function destroy(Career $career): RedirectResponse
    {
        $career->delete();
        return redirect()->route('admin.careers.index')->with('success', 'Job listing deleted.');
    }
}
