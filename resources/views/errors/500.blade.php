@extends('errors::layout')

@section('title', __('Internal Server Error'))
@section('image', __('images/illustrations/500.svg'))
@section('content')
    <h1 class="mb-3 text-2xl font-bold leading-tight text-gray-900 sm:text-4xl lg:text-5xl dark:text-white">Something
        has gone seriously wrong</h1>
    <p class="mb-5 text-base font-normal text-gray-500 md:text-lg dark:text-gray-400">Sorry, something went wrong on the server. Please try again later.</p>
@endsection
