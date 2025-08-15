<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'Auth')</title>
  @vite('resources/css/app.css')
  <!-- <link rel="stylesheet" href="{{ asset('resources/css/app.css') }}"> {{-- Tailwind đã build vào public/css/app.css --}} -->
</head>
<body class="min-h-screen bg-gradient-to-br from-slate-50 to-slate-100">
  <div class="flex items-center justify-center min-h-screen px-4">
    <div class="w-full max-w-md">
      {{-- Logo / tiêu đề --}}
      <div class="text-center mb-6">
        <div class="inline-flex items-center gap-2">
          <div class="h-9 w-9 rounded-2xl bg-slate-900 text-white flex items-center justify-center">✓</div>
          <span class="text-xl font-semibold text-slate-800">Todo App</span>
        </div>
        <p class="text-slate-500 mt-2 text-sm">@yield('subtitle')</p>
      </div>

      {{-- Card --}}
      <div class="bg-white/80 backdrop-blur rounded-2xl shadow-lg border border-slate-200">
        <div class="p-6">
          @yield('content')
        </div>
      </div>

      {{-- Footer link nhỏ --}}
      <div class="text-center text-xs text-slate-500 mt-4">
        © {{ date('2025') }} Todo App
      </div>
    </div>
  </div>
</body>
</html>
