@extends('layouts.auth')

@section('content')
<div class="max-w-lg mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4">Chỉnh sửa sản phẩm</h2>

    <form id="editProductForm" class="space-y-4">
        @csrf
        @method('PUT')

        <input type="hidden" name="id" value="{{ $product->id }}">

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

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        const form = $('#editProductForm');
        const csrfToken = $('meta[name="csrf-token"]').attr('content');

        // Lưu giá trị ban đầu
        const initialValues = {};
        form.serializeArray().forEach(field => initialValues[field.name] = field.value);

        form.on('submit', function(e) {
            e.preventDefault();

            // Kiểm tra dữ liệu có thay đổi
            let changed = false;
            const formDataArray = form.serializeArray();
            formDataArray.forEach(field => {
                if (field.value !== initialValues[field.name]) {
                    changed = true;
                }
            });

            if (!changed) {
                alert('Bạn chưa thay đổi thông tin nào!');
                return;
            }

            const productId = $('input[name="id"]').val();
            $.ajax({
                url: `/products/${productId}`,
                type: 'POST',
                data: form.serialize(),
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function(res) {
                    alert('Cập nhật sản phẩm thành công!');
                    window.location.href = "{{ route('products.index') }}";
                },
                error: function(err) {
                    alert(err.responseJSON?.message || 'Có lỗi xảy ra khi cập nhật sản phẩm');
                }
            });
        });
    });
</script>
@endsection
