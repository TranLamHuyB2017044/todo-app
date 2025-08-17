<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Manager</title>
    @vite('resources/css/app.css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body class="bg-gray-100 min-h-screen">

    <header class="bg-slate-700 text-white shadow">
        <div class="max-w-[1200px] mx-auto flex justify-between items-center p-4">
            <h1 class="text-xl font-bold">Product Manager</h1>
            <div class="flex items-center space-x-4">
                <span>Hello, <strong>{{ Auth::user()->name ?? 'Guest' }}</strong></span>
                @auth
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="bg-red-500 hover:bg-red-600 px-3 py-1 rounded text-sm">
                        Logout
                    </button>
                </form>
                @endauth
            </div>
        </div>
    </header>

    <main class="max-w-[1200px] mx-auto mt-6 p-6 bg-white shadow rounded">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- Add product -->
            <div>
                <h2 class="text-lg font-semibold text-slate-800 mb-4">Add Product</h2>
                <form id="addProductForm" class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700">Product Name</label>
                        <input type="text" name="name" class="w-full border rounded px-3 py-2" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700">Quantity</label>
                        <input type="number" name="quantity" value="1" min="1" class="w-full border rounded px-3 py-2" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700">Price (VND)</label>
                        <input type="number" name="price" min="0" class="w-full border rounded px-3 py-2" required>
                    </div>
                    <button type="submit" class="bg-sky-500 text-white px-4 py-2 rounded hover:bg-sky-600 w-full">
                        Add Product
                    </button>
                </form>
            </div>

            <!-- Product list -->
            <div>
                <div class="flex justify-between items-center mb-3">
                    <div>
                        <h3 class="text-lg font-semibold text-slate-800">Product List</h3>
                        <p class="text-slate-500">Manage your products.</p>
                    </div>
                    <div class="w-full max-w-[200px] relative">
                        <input id="searchInput"
                            class="w-full pr-10 h-10 pl-3 border rounded placeholder:text-slate-400 text-slate-700 text-sm"
                            placeholder="Search..." />
                        <button type="button" class="absolute right-1 top-1 h-8 w-8">🔍</button>
                    </div>
                </div>

                <div class="relative flex flex-col w-full bg-white shadow-md rounded-lg overflow-hidden">
                    <table class="w-full text-left table-auto">
                        <thead>
                            <tr class="border-b border-slate-300 bg-slate-50">
                                <th class="p-4 text-sm font-medium text-slate-500">Name</th>
                                <th class="p-4 text-sm font-medium text-slate-500">Qty</th>
                                <th class="p-4 text-sm font-medium text-slate-500">Price</th>
                                <th class="p-4 text-sm font-medium text-slate-500">Total</th>
                                <th class="p-4"></th>
                            </tr>
                        </thead>
                        <tbody  id="productTableBody"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <script>
        const csrfToken = $('meta[name="csrf-token"]').attr('content');

        function fetchProducts(search = '') {
            $.ajax({
                url: '/products',
                type: 'GET',
                data: {
                    search: search
                },
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                success: function(res) {
                    renderProducts(res.data);
                }
            });
        }

        function renderProducts(products) {
            let tableBody = $('#productTableBody');
            tableBody.empty();
            if (products.length === 0) {
                tableBody.append(`<tr><td colspan="5" class="text-center p-4 text-slate-500">No products</td></tr>`);
                return;
            }
            products.forEach(p => {
                tableBody.append(`
        <tr id="product-${p.id}" class="hover:bg-slate-50">
            <td class="p-4 border-b">
                <a href="/products/${p.id}/edit" class="text-sky-600 hover:underline">
                    ${p.name}
                </a>
            </td>
            <td class="p-4 border-b">${p.quantity}</td>
            <td class="p-4 border-b">${Number(p.price).toLocaleString()}₫</td>
            <td class="p-4 border-b">${(p.price * p.quantity).toLocaleString()}₫</td>
            <td class="p-4 border-b text-right">
                <button onclick="deleteProduct(${p.id})" class="text-red-500 hover:text-red-700">X</button>
            </td>
        </tr>
    `);
            });
        }

        $('#addProductForm').on('submit', function(e) {
            e.preventDefault();
            let formData = $(this).serialize();
            $.ajax({
                url: '/products',
                type: 'POST',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function(res) {
                    fetchProducts();
                    $('#addProductForm')[0].reset();
                },
                error: function(err) {
                    alert(err.responseJSON?.message || 'Error adding product');
                }
            });
        });

        function deleteProduct(id) {
            if (!confirm('Delete this product?')) return;
            $.ajax({
                url: `/products/${id}`,
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function() {
                    $(`#product-${id}`).remove();
                }
            });
        }

        $('#searchInput').on('input', function() {
            fetchProducts($(this).val());
        });

        fetchProducts();
    </script>

</body>

</html>
