<!DOCTYPE html>
<html lang="eng">
    <header>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        @vite('resources/css/app.css')
    </header>
    <body>
        <main class="w-full h-full">
            {{ $slot }}
        </main>
    </body>
</html>