@extends('errors::layout')

@section('title', __('Too Many Requests'))
@section('image', __('images/illustrations/429.svg'))
@section('content')
    <h1 class="mb-3 text-2xl font-bold leading-tight text-gray-900 sm:text-4xl lg:text-5xl dark:text-white">Too Many Requests
    </h1>
    <p class="mb-5 text-base font-normal text-gray-500 md:text-lg dark:text-gray-400">Sorry, you've made too many requests in a short amount of time. Please wait a while before trying again.</p>
@endsection
