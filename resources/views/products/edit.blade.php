@extends('layouts.auth')

@section('content')
<div class="max-w-lg mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4">Chỉnh sửa sản phẩm</h2>

    <form id="editProductForm" action="{{ route('products.update', $product) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm font-medium">Tên sản phẩm</label>
            <input type="text" name="name" value="{{ $product->name }}"
                class="w-full border rounded px-3 py-2 focus:outline-none focus:border-sky-500">
        </div>

        <div>
            <label class="block text-sm font-medium">Số lượng</label>
            <input type="number" name="quantity" value="{{ $product->quantity }}"
                class="w-full border rounded px-3 py-2 focus:outline-none focus:border-sky-500">
        </div>

        <div>
            <label class="block text-sm font-medium">Giá</label>
            <input type="number" step="0.01" name="price" value="{{ $product->price }}"
                class="w-full border rounded px-3 py-2 focus:outline-none focus:border-sky-500">
        </div>

        <div class="flex justify-end space-x-2 mt-4">

            <a href="{{ route('products.index') }}" class="px-4 py-2 bg-gray-300 rounded mr-2">Hủy</a>

            <button type="submit" id="saveBtn"
                class="bg-sky-500 text-white px-4 py-2 rounded hover:bg-sky-600">
                Cập nhật
            </button>
        </div>
    </form>
</div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('editProductForm');

        // Lưu giá trị ban đầu
        const initialData = new FormData(form);
        const initialValues = {};
        initialData.forEach((value, key) => initialValues[key] = value);

        form.addEventListener('submit', function(e) {
            const currentData = new FormData(form);
            let changed = false;

            currentData.forEach((value, key) => {
                if (value !== initialValues[key]) {
                    changed = true;
                }
            });

            if (!changed) {
                e.preventDefault();
                alert('Bạn chưa thay đổi thông tin nào!');
            }
        });
    });
</script>
