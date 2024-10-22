@extends('errors::layout')

@section('title', __('Page not found'))
@section('image', __('images/illustrations/404.svg'))
@section('content')
    <h1 class="mb-3 text-2xl font-bold leading-tight text-gray-900 sm:text-4xl lg:text-5xl dark:text-white">Page not
        found</h1>
    <p class="mb-5 text-base font-normal text-gray-500 md:text-lg dark:text-gray-400">Oops! Looks like you followed a bad
        link. If you think this is a problem with us, please tell us.</p>
@endsection
