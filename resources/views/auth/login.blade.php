@extends('layouts.auth')

@section('title', 'Đăng nhập')
@section('subtitle', 'Chào mừng quay lại!')

@section('content')
  {{-- Thông báo lỗi validate (nếu có, sẽ hiện khi bạn gắn xử lý POST sau này) --}}
  @if ($errors->any())
    <div class="mb-4 rounded-lg border border-red-200 bg-red-50 p-3 text-sm text-red-700">
      <ul class="list-disc pl-5">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form action="{{ route('login') }}" method="POST" class="space-y-4">
    @csrf
    <div>
      <label class="block text-sm font-medium text-slate-700">Email</label>
      <input type="email" name="email" autocomplete="email" required
             class="pl-1 mt-1 w-full rounded-md border h-10 border-slate-300 focus:border-slate-900 focus:ring-slate-900/30">
    </div>

    <div>
      <label class="block text-sm font-medium text-slate-700">Mật khẩu</label>
      <input type="password" name="password" autocomplete="current-password" required
             class="pl-1 mt-1 w-full rounded-md border h-10 border-slate-300 focus:border-slate-900 focus:ring-slate-900/30">
    </div>

    <div class="flex items-center justify-between">
      <label class="inline-flex items-center gap-2 text-sm text-slate-600">
        <input type="checkbox" name="remember" class="rounded border-slate-300 text-slate-900 focus:ring-slate-900/30">
        Ghi nhớ tôi
      </label>
      <a href="#" class="text-sm text-slate-700 hover:underline">Quên mật khẩu?</a>
    </div>

    <button type="submit"
            class="w-full rounded-xl bg-slate-900 py-2.5 text-white font-medium hover:bg-black transition">
      Đăng nhập
    </button>
  </form>

  <p class="mt-4 text-center text-sm text-slate-600">
    Chưa có tài khoản?
    <a href="{{ route('register') }}" class="font-medium text-slate-900 hover:underline">Đăng ký</a>
  </p>
@endsection
