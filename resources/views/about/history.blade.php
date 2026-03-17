@extends('layouts.app')
@section('title', 'History')
@section('content')
    <x-page title="History" :breadcrumbs="['About' => route('about.tenwek'), 'History' => null]">
        <p>The history of Tenwek Hospital and its growth into a regional centre of care and training.</p>
        <p class="mt-4">[ Timeline / narrative placeholder ]</p>
    </x-page>
@endsection
