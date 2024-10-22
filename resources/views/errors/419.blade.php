@extends('errors::layout')

@section('title', __('Page Expired'))
@section('image', __('images/illustrations/419.svg'))
@section('content')
    <h1 class="mb-3 text-2xl font-bold leading-tight text-gray-900 sm:text-4xl lg:text-5xl dark:text-white">Page Expired</h1>
    <p class="mb-5 text-base font-normal text-gray-500 md:text-lg dark:text-gray-400">Sorry, your session has expired. Please refresh the page and try again.</p>
@endsection
