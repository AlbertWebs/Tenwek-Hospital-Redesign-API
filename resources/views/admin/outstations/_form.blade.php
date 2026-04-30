@php $outstation = $outstation ?? new \App\Models\Outstation; @endphp
<x-admin.card>
    <div class="space-y-4">
        <div>
            <label for="name" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Name *</label>
            <input type="text" name="name" id="name" value="{{ old('name', $outstation->name) }}" required class="mt-1 block w-full rounded-xl border border-slate-300 dark:border-slate-600 dark:bg-slate-800 px-4 py-2.5 shadow-sm focus:border-teal-500 focus:ring-teal-500 sm:text-sm @error('name') border-red-500 @enderror" />
            @error('name')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
        </div>
        <div>
            <label for="slug" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Slug *</label>
            <input type="text" name="slug" id="slug" value="{{ old('slug', $outstation->slug) }}" class="mt-1 block w-full rounded-xl border border-slate-300 dark:border-slate-600 dark:bg-slate-800 px-4 py-2.5 shadow-sm focus:border-teal-500 focus:ring-teal-500 sm:text-sm @error('slug') border-red-500 @enderror" placeholder="url-friendly-name" />
            @error('slug')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
        </div>
        <div class="grid gap-4 sm:grid-cols-2">
            <div>
                <label for="order" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Display order</label>
                <input type="number" name="order" id="order" min="0" value="{{ old('order', $outstation->order ?? 0) }}" class="mt-1 block w-full rounded-xl border border-slate-300 dark:border-slate-600 dark:bg-slate-800 px-4 py-2.5 shadow-sm focus:border-teal-500 focus:ring-teal-500 sm:text-sm" />
            </div>
        </div>
        <div>
            <label for="summary" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Short summary</label>
            <textarea name="summary" id="summary" rows="2" class="mt-1 block w-full rounded-xl border border-slate-300 dark:border-slate-600 dark:bg-slate-800 px-4 py-2.5 shadow-sm focus:border-teal-500 focus:ring-teal-500 sm:text-sm" placeholder="Shown on the listing cards">{{ old('summary', $outstation->summary) }}</textarea>
        </div>
        <div>
            <label for="address" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Address</label>
            <textarea name="address" id="address" rows="3" class="mt-1 block w-full rounded-xl border border-slate-300 dark:border-slate-600 dark:bg-slate-800 px-4 py-2.5 shadow-sm focus:border-teal-500 focus:ring-teal-500 sm:text-sm">{{ old('address', $outstation->address) }}</textarea>
        </div>
        <div class="grid gap-4 sm:grid-cols-2">
            <div>
                <label for="latitude" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Latitude</label>
                <input type="text" name="latitude" id="latitude" value="{{ old('latitude', $outstation->latitude) }}" class="mt-1 block w-full rounded-xl border border-slate-300 dark:border-slate-600 dark:bg-slate-800 px-4 py-2.5 shadow-sm focus:border-teal-500 focus:ring-teal-500 sm:text-sm" placeholder="-0.379..." />
                @error('latitude')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>
            <div>
                <label for="longitude" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Longitude</label>
                <input type="text" name="longitude" id="longitude" value="{{ old('longitude', $outstation->longitude) }}" class="mt-1 block w-full rounded-xl border border-slate-300 dark:border-slate-600 dark:bg-slate-800 px-4 py-2.5 shadow-sm focus:border-teal-500 focus:ring-teal-500 sm:text-sm" placeholder="35.116..." />
                @error('longitude')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>
        </div>
        <p class="text-xs text-slate-500">Set both latitude and longitude for the location to appear on the public map (OpenStreetMap). You can copy coordinates from Google Maps or OpenStreetMap.</p>
        <div class="grid gap-4 sm:grid-cols-2">
            <div>
                <label for="phone" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Phone</label>
                <input type="text" name="phone" id="phone" value="{{ old('phone', $outstation->phone) }}" class="mt-1 block w-full rounded-xl border border-slate-300 dark:border-slate-600 dark:bg-slate-800 px-4 py-2.5 shadow-sm focus:border-teal-500 focus:ring-teal-500 sm:text-sm" />
            </div>
            <div>
                <label for="email" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $outstation->email) }}" class="mt-1 block w-full rounded-xl border border-slate-300 dark:border-slate-600 dark:bg-slate-800 px-4 py-2.5 shadow-sm focus:border-teal-500 focus:ring-teal-500 sm:text-sm" />
            </div>
        </div>
        <div>
            <label for="content" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Full page content</label>
            <textarea name="content" id="content" rows="12" class="mt-1 block w-full rounded-xl border border-slate-300 dark:border-slate-600 dark:bg-slate-800 px-4 py-2.5 shadow-sm focus:border-teal-500 focus:ring-teal-500 sm:text-sm font-mono text-sm" placeholder="HTML allowed (trusted editors only)">{{ old('content', $outstation->content) }}</textarea>
        </div>
        <div class="flex items-center gap-2">
            <input type="hidden" name="is_published" value="0" />
            <input type="checkbox" name="is_published" id="is_published" value="1" {{ old('is_published', $outstation->is_published ?? true) ? 'checked' : '' }} class="h-4 w-4 rounded border-slate-300 text-teal-600 focus:ring-teal-500" />
            <label for="is_published" class="text-sm font-medium text-slate-700 dark:text-slate-300">Published</label>
        </div>
    </div>
</x-admin.card>
