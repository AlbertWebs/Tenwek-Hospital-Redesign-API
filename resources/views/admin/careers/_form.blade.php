@php $career = $career ?? new \App\Models\Career; @endphp
<x-admin.card>
    <div class="space-y-4">
        <div>
            <label for="title" class="block text-sm font-medium text-slate-700">Job title *</label>
            <input type="text" name="title" id="title" value="{{ old('title', $career->title) }}" required class="mt-1 block w-full rounded-xl border border-slate-300 px-4 py-2.5 shadow-sm focus:border-teal-500 focus:ring-teal-500 sm:text-sm @error('title') border-red-500 @enderror" />
            @error('title')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
        </div>
        <div>
            <label for="slug" class="block text-sm font-medium text-slate-700">Slug</label>
            <input type="text" name="slug" id="slug" value="{{ old('slug', $career->slug) }}" class="mt-1 block w-full rounded-xl border border-slate-300 px-4 py-2.5 shadow-sm focus:border-teal-500 focus:ring-teal-500 sm:text-sm @error('slug') border-red-500 @enderror" placeholder="auto-generated from title" />
            @error('slug')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
        </div>
        <div class="grid gap-4 sm:grid-cols-2">
            <div>
                <label for="department" class="block text-sm font-medium text-slate-700">Department</label>
                <input type="text" name="department" id="department" value="{{ old('department', $career->department) }}" class="mt-1 block w-full rounded-xl border border-slate-300 px-4 py-2.5 shadow-sm focus:border-teal-500 focus:ring-teal-500 sm:text-sm" />
            </div>
            <div>
                <label for="employment_type" class="block text-sm font-medium text-slate-700">Employment type</label>
                <select name="employment_type" id="employment_type" class="mt-1 block w-full rounded-xl border border-slate-300 px-4 py-2.5 shadow-sm focus:border-teal-500 focus:ring-teal-500 sm:text-sm">
                    <option value="">—</option>
                    <option value="Full-time" {{ old('employment_type', $career->employment_type) === 'Full-time' ? 'selected' : '' }}>Full-time</option>
                    <option value="Part-time" {{ old('employment_type', $career->employment_type) === 'Part-time' ? 'selected' : '' }}>Part-time</option>
                    <option value="Contract" {{ old('employment_type', $career->employment_type) === 'Contract' ? 'selected' : '' }}>Contract</option>
                    <option value="Internship" {{ old('employment_type', $career->employment_type) === 'Internship' ? 'selected' : '' }}>Internship</option>
                </select>
            </div>
        </div>
        <div>
            <label for="location" class="block text-sm font-medium text-slate-700">Location</label>
            <input type="text" name="location" id="location" value="{{ old('location', $career->location) }}" class="mt-1 block w-full rounded-xl border border-slate-300 px-4 py-2.5 shadow-sm focus:border-teal-500 focus:ring-teal-500 sm:text-sm" placeholder="Tenwek Hospital, Bomet" />
        </div>
        <div>
            <label for="closing_date" class="block text-sm font-medium text-slate-700">Closing date</label>
            <input type="date" name="closing_date" id="closing_date" value="{{ old('closing_date', $career->closing_date?->format('Y-m-d')) }}" class="mt-1 block w-full rounded-xl border border-slate-300 px-4 py-2.5 shadow-sm focus:border-teal-500 focus:ring-teal-500 sm:text-sm" />
        </div>
        <div>
            <label for="description" class="block text-sm font-medium text-slate-700">Description</label>
            <textarea name="description" id="description" rows="4" class="mt-1 block w-full rounded-xl border border-slate-300 px-4 py-2.5 shadow-sm focus:border-teal-500 focus:ring-teal-500 sm:text-sm">{{ old('description', $career->description) }}</textarea>
        </div>
        <div>
            <label for="requirements" class="block text-sm font-medium text-slate-700">Requirements</label>
            <textarea name="requirements" id="requirements" rows="3" class="mt-1 block w-full rounded-xl border border-slate-300 px-4 py-2.5 shadow-sm focus:border-teal-500 focus:ring-teal-500 sm:text-sm">{{ old('requirements', $career->requirements) }}</textarea>
        </div>
        <div>
            <label for="responsibilities" class="block text-sm font-medium text-slate-700">Responsibilities</label>
            <textarea name="responsibilities" id="responsibilities" rows="3" class="mt-1 block w-full rounded-xl border border-slate-300 px-4 py-2.5 shadow-sm focus:border-teal-500 focus:ring-teal-500 sm:text-sm">{{ old('responsibilities', $career->responsibilities) }}</textarea>
        </div>
        <div class="flex items-center gap-2">
            <input type="hidden" name="is_published" value="0" />
            <input type="checkbox" name="is_published" id="is_published" value="1" {{ old('is_published', $career->is_published) ? 'checked' : '' }} class="h-4 w-4 rounded border-slate-300 text-teal-600 focus:ring-teal-500" />
            <label for="is_published" class="text-sm font-medium text-slate-700">Published (visible on Careers page)</label>
        </div>
    </div>
</x-admin.card>
