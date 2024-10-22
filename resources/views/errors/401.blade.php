@extends('errors::layout')

@section('title', __('Unauthorized'))
@section('image', __('images/illustrations/401.svg'))
@section('content')
    <h1 class="mb-3 text-2xl font-bold leading-tight text-gray-900 sm:text-4xl lg:text-5xl dark:text-white">Unauthorized
    </h1>
    <p class="mb-5 text-base font-normal text-gray-500 md:text-lg dark:text-gray-400">Sorry, you are not authorized to access this page. Please <a href="{{ route('login') }}"
            class="text-primary-700 hover:underline dark:text-primary-500">log in</a> to continue !</p>
@endsection
