<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ANINF</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <style>
        :root { --sky: #0ea5e9; --sky-dark: #0369a1; --sky-light: #e0f2fe; --gray: #64748b; --gray-light: #f1f5f9; --border: #e2e8f0; }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'DM Sans', sans-serif; background: #f0f9ff; color: #334155; }
        .flash { padding: 0.75rem 1.5rem; font-size: 0.88rem; text-align: center; }
        .flash-success { background: #d1fae5; color: #065f46; border-bottom: 1px solid #6ee7b7; }
        .flash-error { background: #fee2e2; color: #991b1b; border-bottom: 1px solid #fca5a5; }
    </style>
</head>
<body>

@if(session('success'))
    <div class="flash flash-success">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="flash flash-error">{{ session('error') }}</div>
@endif

<main>{{ $slot ?? '' }}</main>
@yield('content')

@livewireScripts
</body>
</html>