@extends('errors::layout')

@section('title', __('Payment Required'))
@section('image', __('images/illustrations/402.svg'))
@section('content')
    <h1 class="mb-3 text-2xl font-bold leading-tight text-gray-900 sm:text-4xl lg:text-5xl dark:text-white">Payment Required
    </h1>
    <p class="mb-5 text-base font-normal text-gray-500 md:text-lg dark:text-gray-400">Sorry, your request cannot be processed
        until payment is made. Please complete the payment process to continue.</p>
@endsection
