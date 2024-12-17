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

                            <tbody>
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

                    @if ($products->count())
                        <div class="mt-4">
                            <div class="flex justify-center">
                                {{ $products->links('pagination::tailwind') }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
