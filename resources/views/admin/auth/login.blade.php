<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Sign in — Tenwek Admin</title>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
</head>
<body class="min-h-screen bg-slate-50 font-sans antialiased flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <div class="rounded-2xl border border-slate-200/80 bg-white p-8 shadow-sm">
            <div class="mb-8 text-center">
                <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-xl bg-teal-600 text-xl font-semibold text-white">T</div>
                <h1 class="mt-4 text-2xl font-semibold text-slate-900">Tenwek Admin</h1>
                <p class="mt-1 text-sm text-slate-500">Sign in to manage the website</p>
            </div>
            <form method="POST" action="{{ url('/admin/login') }}" class="space-y-5">
                @csrf
                <div>
                    <label for="email" class="block text-sm font-medium text-slate-700">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus autocomplete="email"
                           class="mt-1.5 block w-full rounded-xl border border-slate-300 px-4 py-2.5 text-slate-900 shadow-sm focus:border-teal-500 focus:ring-teal-500 sm:text-sm @error('email') border-red-500 @enderror" />
                    @error('email')
                        <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-slate-700">Password</label>
                    <input type="password" name="password" id="password" required autocomplete="current-password"
                           class="mt-1.5 block w-full rounded-xl border border-slate-300 px-4 py-2.5 text-slate-900 shadow-sm focus:border-teal-500 focus:ring-teal-500 sm:text-sm" />
                </div>
                <div class="flex items-center">
                    <input type="checkbox" name="remember" id="remember" class="h-4 w-4 rounded border-slate-300 text-teal-600 focus:ring-teal-500" />
                    <label for="remember" class="ml-2 block text-sm text-slate-600">Remember me</label>
                </div>
                <button type="submit" class="w-full rounded-xl bg-teal-600 px-4 py-2.5 text-sm font-medium text-white shadow-sm transition hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2">
                    Sign in
                </button>
            </form>
        </div>
        <p class="mt-6 text-center text-sm text-slate-500">&copy; {{ date('Y') }} Tenwek Hospital</p>
    </div>
</body>
</html>
