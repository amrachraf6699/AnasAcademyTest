<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Your Products') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <button id="toggle-form-button" style="padding: 0.5rem 1rem; border-radius: 0.375rem; margin-bottom: 1rem; background-color: #2563eb; color: white; border: none; cursor: pointer;">
                        Add New Product
                    </button>                    

                    <div class="overflow-x-auto">
                        <table class="w-full table-auto border-separate border-spacing-0 rounded-lg shadow-md">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700 border-b">Product Name</th>
                                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700 border-b">Price</th>
                                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700 border-b">Quantity</th>
                                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700 border-b">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="product-list">
                                @forelse ($products as $product)
                                    <tr class="bg-white hover:bg-gray-50 transition duration-200">
                                        <td class="px-4 py-3 text-sm font-medium text-gray-700 border-b">{{ $product->name }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-600 border-b">${{ number_format($product->price, 2) }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-600 border-b">{{ $product->quantity }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-700 border-b flex space-x-4">
                                            <a href="{{ route('myproducts.edit', $product->id) }}" class="text-blue-600 hover:text-blue-800 flex items-center space-x-2">
                                                <span>Edit</span>
                                            </a>
                                            |
                                            <form action="{{ route('myproducts.destroy', $product->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-800 flex items-center space-x-2">
                                                    <span>Delete</span>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="bg-white">
                                        <td colspan="4" class="px-4 py-3 text-center text-gray-500">
                                            No products available.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $products->links() }}
                    </div>

                    <div id="add-product-form-container" class="mt-6 hidden">
                        <form id="add-product-form">
                            @csrf
                            <div class="flex flex-col">
                                <label for="name" class="mb-2 text-sm font-medium text-gray-700">Product Name</label>
                                <input type="text" name="name" id="name" class="border-gray-300 border-2 rounded-lg p-2 mb-4" required>

                                <label for="price" class="mb-2 text-sm font-medium text-gray-700">Price</label>
                                <input type="number" name="price" id="price" class="border-gray-300 border-2 rounded-lg p-2 mb-4" required>

                                <label for="quantity" class="mb-2 text-sm font-medium text-gray-700">Quantity</label>
                                <input type="number" name="quantity" id="quantity" class="border-gray-300 border-2 rounded-lg p-2 mb-4" required>

                                <label for="category_id" class="mb-2 text-sm font-medium text-gray-700">Category</label>
                                <select name="category_id" id="category_id" class="border-gray-300 border-2 rounded-lg p-2 mb-4" required>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>

                                <button type="submit" style="background-color: #2563eb; color: white; padding: 0.5rem 1rem; border-radius: 0.375rem; display: inline-block; text-align: center; border: none; cursor: pointer;">
                                    Add Product
                                </button>

                            </div>
                        </form>
                    </div>

                    <div id="validation-errors" class="mt-4 text-red-600 hidden"></div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>

<script>

    document.getElementById('toggle-form-button').addEventListener('click', function() {
        const formContainer = document.getElementById('add-product-form-container');
        formContainer.classList.toggle('hidden');
    });

    document.getElementById('add-product-form').addEventListener('submit', function(event) {
        event.preventDefault();

        const form = event.target;
        const formData = new FormData(form);

        fetch('{{ route('myproducts.store') }}', {
            method: 'POST',
            headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json',
            },
            body: formData,
        })
        .then(response => response.json())
        .then(data => {
            if (data.errors) {
            const errorsContainer = document.getElementById('validation-errors');
            errorsContainer.innerHTML = '';
            errorsContainer.classList.remove('hidden');
            for (const [key, value] of Object.entries(data.errors)) {
                const errorItem = document.createElement('div');
                errorItem.textContent = value[0];
                errorsContainer.appendChild(errorItem);
            }
            } else {
            const productList = document.getElementById('product-list');
            const newRow = document.createElement('tr');
            newRow.classList.add('bg-white', 'hover:bg-gray-50', 'transition', 'duration-200');
            newRow.innerHTML = `
                <td class="px-4 py-3 text-sm font-medium text-gray-700 border-b">${data.product.name}</td>
                <td class="px-4 py-3 text-sm text-gray-600 border-b">$${parseFloat(data.product.price).toFixed(2)}</td>
                <td class="px-4 py-3 text-sm text-gray-600 border-b">${data.product.quantity}</td>
                <td class="px-4 py-3 text-sm text-gray-700 border-b flex space-x-4">
                <a href="/myproducts/${data.product.id}/edit" class="text-blue-600 hover:text-blue-800 flex items-center space-x-2">
                    <span>Edit</span>
                </a>
                |
                <form action="/myproducts/${data.product.id}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this product?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-600 hover:text-red-800 flex items-center space-x-2">
                    <span>Delete</span>
                    </button>
                </form>
                </td>
            `;
            productList.appendChild(newRow);
            form.reset();
            document.getElementById('add-product-form-container').classList.add('hidden');
            document.getElementById('validation-errors').classList.add('hidden');
            }
        })
        .catch(error => console.error('Error:', error));
    });
</script>
