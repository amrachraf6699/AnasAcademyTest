<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 h-screen flex items-center justify-center">

    <div class="max-w-md w-full bg-white shadow-md rounded-lg p-6 text-center">
        <h1 class="text-2xl font-bold text-gray-800 mb-4">Welcome to AnasAcademyTask Home</h1>

        <div class="mb-4">
            <p class="text-gray-600">Laravel Version:</p>
            <p class="text-lg font-semibold text-blue-600">{{ app()->version() }}</p>
        </div>

        <div>
            <p class="text-gray-600">Current Time:</p>
            <p class="text-lg font-semibold text-green-600">{{ now()->format('Y-m-d H:i:s') }}</p>
        </div>
    </div>

</body>
</html>
