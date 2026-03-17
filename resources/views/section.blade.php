@extends('layouts.app')

@section('title', $title ?? 'Page')

@section('content')
    <x-page :title="$title" :breadcrumbs="$breadcrumbs ?? []">
        {!! $content ?? '<p>Content for this page.</p>' !!}
    </x-page>
@endsection
