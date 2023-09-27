<!doctype html>
<html>
<head>
    <title>URL Shortener</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
</head>
<body>

<nav class="flex justify-between items-center py-5 sm:flex-col bg-blue-500 text-white">
    <h1 class="font-bold text-4xl">URL Shortener</h1>
    <ul class="flex justify-between font-bold text-lg items-center gap-5">
        @if(!Auth::check())
            <li class="cursor-pointer"><a href="/registration">Registration</a></li>
            <li class="cursor-pointer"><a href="/login">Login</a></li>
        @else
            <li class="cursor-pointer"><a href="/">Dashboard</a></li>
            <li class="cursor-pointer"><a href="/short">Short Url</a></li>
            <li class="cursor-pointer"><a href="/logout">Logout</a></li>
        @endif
    </ul>
</nav>
