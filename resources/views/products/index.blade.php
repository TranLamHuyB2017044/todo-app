<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý sản phẩm</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 min-h-screen">

    <!-- App Bar -->
    <header class="bg-slate-700 text-white shadow">
        <div class="max-w-[1200px] mx-auto flex justify-between items-center p-4">
            <h1 class="text-xl font-bold">Quản lý sản phẩm</h1>
            <div class="flex items-center space-x-4">
                <span>Xin chào, <strong>{{ Auth::user()->name ?? 'Khách' }}</strong></span>
                @auth
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="bg-red-500 hover:bg-red-600 px-3 py-1 rounded text-sm">
                        Đăng xuất
                    </button>
                </form>
                @endauth
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-[1200px] mx-auto mt-6 p-6 bg-white shadow rounded">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- Cột trái: Form thêm sản phẩm -->
            <div>
                <h2 class="text-lg font-semibold text-slate-800 mb-4">Thêm sản phẩm</h2>
                <form action="{{ route('products.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-slate-700">Tên sản phẩm</label>
                        <input type="text" name="name" placeholder="Nhập tên sản phẩm"
                            class="w-full border rounded px-3 py-2 focus:outline-none focus:border-sky-500" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700">Số lượng</label>
                        <input type="number" name="quantity" min="1" value="1"
                            class="w-full border rounded px-3 py-2 focus:outline-none focus:border-sky-500" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700">Giá (VNĐ)</label>
                        <input type="number" name="price" step="1000" min="0"
                            class="w-full border rounded px-3 py-2 focus:outline-none focus:border-sky-500" required>
                    </div>

                    <button type="submit"
                        class="bg-sky-500 text-white px-4 py-2 rounded hover:bg-sky-600 w-full">
                        Thêm sản phẩm
                    </button>
                </form>
            </div>

            <!-- Cột phải: Danh sách sản phẩm -->
            <div>
                <div class="flex justify-between items-center mb-3">
                    <div>
                        <h3 class="text-lg font-semibold text-slate-800">Danh sách sản phẩm</h3>
                        <p class="text-slate-500">Quản lý các sản phẩm của bạn.</p>
                    </div>
                    <div class="w-full max-w-[200px] relative">
                        <input
                            class="w-full pr-10 h-10 pl-3 border border-slate-200 rounded placeholder:text-slate-400 text-slate-700 text-sm focus:outline-none focus:border-slate-400 shadow-sm"
                            placeholder="Tìm kiếm..." />
                        <button class="absolute right-1 top-1 h-8 w-8 flex items-center justify-center" type="button">
                            🔍
                        </button>
                    </div>
                </div>

                <div class="relative flex flex-col w-full bg-white shadow-md rounded-lg overflow-hidden">
                    <table class="w-full text-left table-auto">
                        <thead>
                            <tr class="border-b border-slate-300 bg-slate-50">
                                <th class="p-4 text-sm font-medium text-slate-500">Tên sản phẩm</th>
                                <th class="p-4 text-sm font-medium text-slate-500">SL</th>
                                <th class="p-4 text-sm font-medium text-slate-500">Giá</th>
                                <th class="p-4 text-sm font-medium text-slate-500">Tổng</th>
                                <th class="p-4"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($products as $product)
                            <tr class="hover:bg-slate-50">
                                <td class="p-4 border-b">
                                    <a href="{{ route('products.edit', $product) }}" class="text-sky-600 hover:underline">
                                        {{ $product->name }}
                                    </a>
                                </td>
                                <td class="p-4 border-b">{{ $product->quantity }}</td>
                                <td class="p-4 border-b">{{ number_format($product->price, 0, ',', '.') }}₫</td>
                                <td class="p-4 border-b">
                                    {{ number_format($product->price * $product->quantity, 0, ',', '.') }}₫
                                </td>
                                <td class="p-4 border-b text-right">
                                    <form action="{{ route('products.destroy', $product) }}" method="POST"
                                        onsubmit="return confirm('Xóa sản phẩm này?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700">X</button>
                                    </form>
                                </td>
                            </tr>


                            @empty
                            <tr>
                                <td colspan="5" class="text-center p-4 text-slate-500">Chưa có sản phẩm</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </main>
</body>

</html>
