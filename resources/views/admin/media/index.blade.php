@extends('admin.layouts.app')

@section('title', 'Media Library')

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
    <style>
        #dropzone-media .dz-preview { margin: 12px; }
        #dropzone-media .dz-progress { display: block; height: 8px; border-radius: 4px; overflow: hidden; background: #e2e8f0; margin-top: 6px; }
        #dropzone-media .dz-upload { display: block; height: 100%; background: #0d9488; border-radius: 4px; transition: width 0.2s ease; }
        #dropzone-media .dz-success-mark, #dropzone-media .dz-error-mark { margin-top: 8px; }
        #dropzone-media .dz-error-message { font-size: 12px; margin-top: 4px; }
        #media-upload-progress { display: none; height: 6px; border-radius: 3px; overflow: hidden; background: #e2e8f0; margin-top: 12px; }
        #media-upload-progress.show { display: block; }
        #media-upload-progress .bar { height: 100%; background: #0d9488; border-radius: 3px; transition: width 0.15s ease; }
    </style>
@endpush

@section('content')
    <x-admin.breadcrumb :items="['Media Library' => null]" />

    <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-semibold text-slate-900">Media Library</h1>
            <p class="mt-1 text-slate-600">Upload and manage images and files.</p>
        </div>
    </div>

    <x-admin.card class="mb-6">
        <div id="dropzone-media" class="dropzone rounded-xl border-2 border-dashed border-slate-200 bg-slate-50/50 p-8 min-h-[180px] flex flex-wrap items-center justify-center content-center">
            <div class="dz-message text-slate-500 text-center w-full" data-dz-message>
                <svg class="mx-auto h-10 w-10 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                <p class="mt-2">Drop files here or click to upload.</p>
            </div>
        </div>
        <div id="media-upload-progress" class="px-4 pb-4" aria-hidden="true">
            <div class="bar" style="width: 0%;" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
    </x-admin.card>

    <x-admin.card>
        @if($media->isEmpty())
            <div class="rounded-xl border-2 border-dashed border-slate-200 bg-slate-50/50 p-12 text-center">
                <svg class="mx-auto h-12 w-12 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14"/></svg>
                <p class="mt-4 text-slate-500">No media yet. Upload images or files above to get started.</p>
            </div>
        @else
            <div class="grid grid-cols-2 gap-4 sm:grid-cols-4 md:grid-cols-6">
                @foreach($media as $item)
                    <div class="aspect-square rounded-xl border border-slate-200 bg-slate-50 overflow-hidden hover:ring-2 hover:ring-teal-500/20 transition">
                        <div class="flex h-full items-center justify-center p-2 text-slate-400 text-xs truncate">{{ $item->file_name }}</div>
                    </div>
                @endforeach
            </div>
            @if($media->hasPages())
                <div class="mt-6 border-t border-slate-100 pt-4">{{ $media->links() }}</div>
            @endif
        @endif
    </x-admin.card>

    @push('scripts')
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Dropzone.autoDiscover = false;
            var progressWrap = document.getElementById('media-upload-progress');
            var progressBar = progressWrap && progressWrap.querySelector('.bar');

            var dz = new Dropzone('#dropzone-media', {
                url: '{{ route("admin.media.store") }}',
                paramName: 'file',
                maxFilesize: 10,
                maxFiles: 20,
                parallelUploads: 2,
                acceptedFiles: 'image/*,.pdf,.doc,.docx,.xls,.xlsx',
                headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') },
                addRemoveLinks: false,
                init: function () {
                    this.on('totaluploadprogress', function (progress) {
                        if (progressWrap && progressBar) {
                            var pct = Math.round(progress);
                            progressWrap.classList.toggle('show', pct > 0 && pct < 100);
                            progressBar.style.width = pct + '%';
                            progressBar.setAttribute('aria-valuenow', pct);
                        }
                    });
                    this.on('queuecomplete', function () {
                        if (progressWrap && progressBar) {
                            progressBar.style.width = '100%';
                            progressBar.setAttribute('aria-valuenow', 100);
                            setTimeout(function () {
                                progressWrap.classList.remove('show');
                                progressBar.style.width = '0%';
                                progressBar.setAttribute('aria-valuenow', 0);
                                window.location.reload();
                            }, 400);
                        } else {
                            window.location.reload();
                        }
                    });
                    this.on('error', function (file, message) {
                        var msg = typeof message === 'string' ? message : (message.message || 'Upload failed');
                        console.error('Upload error:', msg);
                    });
                }
            });
        });
    </script>
    @endpush
@endsection
