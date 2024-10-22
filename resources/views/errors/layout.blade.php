<!doctype html>
<html lang="en" class="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ config('app.description') }}">
    <meta name="author" content="{{ config('app.author') }}">

    <title>@yield('title')</title>

    <link rel="stylesheet" href="{{ asset('app.css') }}">

    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">

    <script>
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia(
                '(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>
</head>

<body class="bg-gray-50 dark:bg-gray-800">
    <main class="bg-gray-50 dark:bg-gray-900">
        <div class="flex flex-col justify-center items-center px-6 mx-auto h-screen xl:px-0 dark:bg-gray-900">
            <div class="block md:max-w-lg mb-3">
                <img src="{{ url('/') }}/@yield('image')" alt="@yield('title')">
            </div>

            <div class="text-center xl:max-w-4xl">
                @yield('content')
                
                <a href="/"
                    class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center mr-3 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                    <svg class="mr-2 -ml-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                            clip-rule="evenodd"></path>
                    </svg>
                    Go back home
                </a>
            </div>

        </div>
    </main>
</body>

</html>
