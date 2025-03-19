<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'happynotes') }}</title>
        <meta name="description" content="💥🧠📝🎨🚀">

        <link rel="icon" type="image/png" href="/favicon-96x96.png" sizes="96x96" />
        <link rel="icon" type="image/svg+xml" href="/favicon.svg" />
        <link rel="shortcut icon" href="/favicon.ico" />
        <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png" />
        <meta name="apple-mobile-web-app-title" content="happynotes" />
        <link rel="manifest" href="/site.webmanifest" />

        <!-- Styles -->
        @vite(['resources/css/account.scss'])
        @livewireStyles
    </head>
    <body>
        <div class="container mx-auto">
            <div class="container mx-auto">
                <div class="flex justify-center">
                    <div class="w-full md:w-8/12">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Styles -->
        @livewireScripts
    </body>
</html>
