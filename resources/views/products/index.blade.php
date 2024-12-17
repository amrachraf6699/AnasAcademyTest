<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold text-center mb-6 text-gray-700">Products List</h1>

        <form action="{{ route('products.filter') }}" method="GET" class="mb-6 flex justify-center">
            <div class="flex items-center gap-4 bg-white p-4 rounded-lg shadow-md">
                <label for="min_price" class="text-gray-600 font-medium">Min Price:</label>
                <input type="number" name="min_price" id="min_price"
                       class="w-32 border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-400 outline-none @error('min_price') border-red-500 @enderror"
                       placeholder="0.00" value="{{ request('min_price') }}">

                @error('min_price')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror

                <button type="submit"
                        class="bg-blue-500 hover:bg-blue-600 text-white font-semibold rounded-lg px-4 py-2 transition duration-300 ease-in-out">
                    Filter
                </button>
                <a href="{{ route('products.index') }}"
                   class="bg-gray-500 hover:bg-gray-600 text-white font-semibold rounded-lg px-4 py-2 transition duration-300 ease-in-out">
                    Clear
                </a>
            </div>
        </form>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse ($products as $product)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                    <div class="p-4">
                        <h2 class="text-lg font-semibold text-gray-800">{{ $product->name }}</h2>
                        <p class="text-gray-600 mt-2">Price: <span class="font-bold">${{ number_format($product->price, 2) }}</span></p>
                        <p class="text-gray-600">Quantity: {{ $product->quantity }}</p>
                        <p class="text-sm text-gray-500 mt-2">Category: {{ $product->category->name }}</p>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center">
                    <p class="text-gray-500">No products available.</p>
                </div>
            @endforelse
        </div>

        <div class="mt-6">
            {{ $products->links('pagination::tailwind') }}
        </div>
    </div>

</body>
</html>
