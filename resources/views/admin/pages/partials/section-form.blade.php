@php
    $c = $section->content ?? [];
    $type = $section->type;
@endphp
<form action="{{ route('admin.pages.sections.update', [$page, $section]) }}" method="POST" class="space-y-4">
    @csrf
    @method('PUT')
    <input type="hidden" name="name" value="{{ $section->name }}" />

    @if($type === 'hero')
        <div>
            <label class="block text-sm font-medium text-slate-700">Heading</label>
            <input type="text" name="content[heading]" value="{{ $c['heading'] ?? '' }}" class="mt-1 block w-full rounded-lg border border-slate-300 px-3 py-2 text-sm" />
        </div>
        <div>
            <label class="block text-sm font-medium text-slate-700">Subheading</label>
            <input type="text" name="content[subheading]" value="{{ $c['subheading'] ?? '' }}" class="mt-1 block w-full rounded-lg border border-slate-300 px-3 py-2 text-sm" />
        </div>
        <div>
            <label class="block text-sm font-medium text-slate-700">Image URL</label>
            <input type="text" name="content[image]" value="{{ $c['image'] ?? '' }}" class="mt-1 block w-full rounded-lg border border-slate-300 px-3 py-2 text-sm" placeholder="/storage/..." />
        </div>
        <div class="grid grid-cols-2 gap-3">
            <div>
                <label class="block text-sm font-medium text-slate-700">CTA text</label>
                <input type="text" name="content[cta_text]" value="{{ $c['cta_text'] ?? '' }}" class="mt-1 block w-full rounded-lg border border-slate-300 px-3 py-2 text-sm" />
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700">CTA URL</label>
                <input type="text" name="content[cta_url]" value="{{ $c['cta_url'] ?? '' }}" class="mt-1 block w-full rounded-lg border border-slate-300 px-3 py-2 text-sm" />
            </div>
        </div>
    @elseif($type === 'content')
        <div>
            <label class="block text-sm font-medium text-slate-700">HTML / Text</label>
            <textarea name="content[html]" rows="6" class="mt-1 block w-full rounded-lg border border-slate-300 px-3 py-2 text-sm font-mono">{{ $c['html'] ?? '' }}</textarea>
        </div>
    @elseif($type === 'image')
        <div>
            <label class="block text-sm font-medium text-slate-700">Image URL</label>
            <input type="text" name="content[image_url]" value="{{ $c['image_url'] ?? '' }}" class="mt-1 block w-full rounded-lg border border-slate-300 px-3 py-2 text-sm" />
        </div>
        <div>
            <label class="block text-sm font-medium text-slate-700">Caption</label>
            <input type="text" name="content[caption]" value="{{ $c['caption'] ?? '' }}" class="mt-1 block w-full rounded-lg border border-slate-300 px-3 py-2 text-sm" />
        </div>
        <div>
            <label class="block text-sm font-medium text-slate-700">Layout</label>
            <select name="content[layout]" class="mt-1 block w-full rounded-lg border border-slate-300 px-3 py-2 text-sm">
                <option value="full" {{ ($c['layout'] ?? 'full') === 'full' ? 'selected' : '' }}>Full width</option>
                <option value="left" {{ ($c['layout'] ?? '') === 'left' ? 'selected' : '' }}>Left</option>
                <option value="right" {{ ($c['layout'] ?? '') === 'right' ? 'selected' : '' }}>Right</option>
            </select>
        </div>
    @elseif($type === 'cta')
        <div>
            <label class="block text-sm font-medium text-slate-700">Title</label>
            <input type="text" name="content[title]" value="{{ $c['title'] ?? '' }}" class="mt-1 block w-full rounded-lg border border-slate-300 px-3 py-2 text-sm" />
        </div>
        <div>
            <label class="block text-sm font-medium text-slate-700">Text</label>
            <textarea name="content[text]" rows="2" class="mt-1 block w-full rounded-lg border border-slate-300 px-3 py-2 text-sm">{{ $c['text'] ?? '' }}</textarea>
        </div>
        <div class="grid grid-cols-2 gap-3">
            <div>
                <label class="block text-sm font-medium text-slate-700">Button label</label>
                <input type="text" name="content[button_label]" value="{{ $c['button_label'] ?? '' }}" class="mt-1 block w-full rounded-lg border border-slate-300 px-3 py-2 text-sm" />
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700">Button URL</label>
                <input type="text" name="content[button_url]" value="{{ $c['button_url'] ?? '' }}" class="mt-1 block w-full rounded-lg border border-slate-300 px-3 py-2 text-sm" />
            </div>
        </div>
    @endif

    <div class="flex items-center gap-2 pt-2">
        <button type="submit" class="rounded-lg bg-teal-600 px-4 py-2 text-sm font-medium text-white hover:bg-teal-700">Save section</button>
        <button type="button" @click="editOpen = false" class="rounded-lg border border-slate-300 px-4 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50">Cancel</button>
    </div>
</form>
