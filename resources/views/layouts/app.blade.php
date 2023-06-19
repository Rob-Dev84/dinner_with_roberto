<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}"> 
        <meta name="robots" content="@php echo trim($__env->yieldContent('published')); @endphp" />
        <title>@php echo trim($__env->yieldContent('meta_title')); @endphp {{ '-' }} {{ config('app.name', 'Laravel') }}</title>
        <meta property="og:locale" content="{{ str_replace('_', '-', app()->getLocale()) }}" />
        <meta property="og:type" content="article" />
        <meta property="og:title" content="@php echo trim($__env->yieldContent('meta_title')); @endphp {{ '-' }} {{ config('app.name', 'Laravel') }}" />
        <meta property="og:description" content="@php echo trim($__env->yieldContent('meta_description')); @endphp" />
        {{-- <meta name="description" content="@yield('meta_description')" /> --}}
        <meta property="og:url" content="@php echo trim($__env->yieldContent('meta_url')); @endphp" />
        <meta property="og:site_name" content="@php echo trim($__env->yieldContent('meta_site_name')); @endphp" />
        <meta property="article:published_time" content="@php echo trim($__env->yieldContent('meta_published_time')); @endphp" />
        <meta property="article:modified_time" content="@php echo trim($__env->yieldContent('meta_modified_time')); @endphp" />
        <meta property="og:image" content="@php echo trim($__env->yieldContent('meta_image')); @endphp" />
        <meta property="og:image:width" content="@php echo trim($__env->yieldContent('meta_image_width')); @endphp" />
        <meta property="og:image:height" content="@php echo trim($__env->yieldContent('meta_image_height')); @endphp" />
        <meta name="description" content="@php echo trim($__env->yieldContent('meta_description')); @endphp" />
        <meta name="author" content="Roberto" />
        <link rel="canonical" href="@php echo trim($__env->yieldContent('meta_canonical')); @endphp" />
        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')
            
            @can('isAdmin')
                @include('layouts.admin-navigation')
            @endcan

            <!-- Page Heading -->
            {{-- This is the title page --}}
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
