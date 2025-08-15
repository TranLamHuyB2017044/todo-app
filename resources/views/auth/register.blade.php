@extends('layouts.auth')

@section('title', 'Đăng ký')
@section('subtitle', 'Tạo tài khoản mới để quản lý công việc')

@section('content')
  @if ($errors->any())
    <div class="mb-4 rounded-lg border border-red-200 bg-red-50 p-3 text-sm text-red-700">
      <ul class="list-disc pl-5">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form action="{{ route('register') }}" method="POST" class="space-y-4">
    @csrf
    <div>
      <label class="block text-sm font-medium text-slate-700">Tên</label>
      <input type="text" name="name" required
             class="pl-1 mt-1 w-full rounded-md border h-10 border-slate-300 focus:border-[dodgerblue] focus:ring-[dodgerblue]">
    </div>

    <div>
      <label class="block text-sm font-medium text-slate-700">Email</label>
      <input type="email" name="email" autocomplete="email" required
             class="pl-1 mt-1 w-full rounded-md border h-10 border-slate-300 focus:border-slate-900 focus:ring-slate-900/30">
    </div>

    <div>
      <label class="block text-sm font-medium text-slate-700">Mật khẩu</label>
      <input type="password" name="password" autocomplete="new-password" required
             class="pl-1 mt-1 w-full rounded-md border h-10 border-slate-300 focus:border-slate-900 focus:ring-slate-900/30">
    </div>

    <div>
      <label class="block text-sm font-medium text-slate-700">Xác nhận mật khẩu</label>
      <input type="password" name="password_confirmation" required
             class="pl-1 mt-1 w-full rounded-md border h-10 border-slate-300 focus:border-slate-900 focus:ring-slate-900/30">
    </div>

    <button type="submit"
            class="w-full rounded-xl bg-slate-900 py-2.5 text-white font-medium hover:bg-black transition">
      Đăng ký
    </button>
  </form>

  <p class="mt-4 text-center text-sm text-slate-600">
    Đã có tài khoản?
    <a href="{{ route('login') }}" class="font-medium text-slate-900 hover:underline">Đăng nhập</a>
  </p>
@endsection
