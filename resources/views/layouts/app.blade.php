<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" class="h-full">
    <head>
        <title>{{ config('app.name') }}</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="theme-color" content="#18181b">
        <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}">
        <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
        <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
        @livewireStyles
        @vite('resources/css/app.css')
        @vite('resources/js/app.js')
    </head>
    <body x-data="{ mobileMenu: false, dialogInfo: false, profileDropdown: false }">
        <div class="body grid lg:grid-rows-[4rem_1fr_3rem]">
            <livewire:sidebar.sidebar-admin />
            <div class="grid grid-rows-[4rem_1fr] w-full h-screen">
                <livewire:head.head-admin />
                <main>
                    {{ $slot }}
                </main>
            </div>
        </div>

        <x-info />

        <x-toaster-hub />

        @livewireScripts
    </body>
</html>