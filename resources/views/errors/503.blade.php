@extends('errors::layout')

@section('title', __('Under Maintenance'))
@section('image', __('images/illustrations/maintenance.svg'))
@section('content')
    <h1 class="mb-3 text-2xl font-bold leading-tight text-gray-900 sm:text-4xl lg:text-5xl dark:text-white">Under
        Maintenance</h1>
    <p class="mb-5 text-base font-normal text-gray-500 md:text-lg dark:text-gray-400">Sorry for the inconvenience but
        we’re performing some maintenance at the moment. If you need to you can always <a href="#"
            class="text-primary-700 hover:underline dark:text-primary-500">contact us</a>, otherwise we’ll be back
        online shortly!.</p>
@endsection
