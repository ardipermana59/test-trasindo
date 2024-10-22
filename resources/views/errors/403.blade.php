@extends('errors::layout')

@section('title', __('Forbidden'))
@section('image', __('images/illustrations/403.svg'))
@section('content')
    <h1 class="mb-3 text-2xl font-bold leading-tight text-gray-900 sm:text-4xl lg:text-5xl dark:text-white">Forbidden</h1>
    <p class="mb-5 text-base font-normal text-gray-500 md:text-lg dark:text-gray-400">Sorry, you don't have permission to access this page.</p>
@endsection
