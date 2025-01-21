<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    @vite('resources/css/app.css') <!-- Ensure TailwindCSS is loaded -->
</head>
<body class="bg-gray-50">
    <!-- Include Navbar -->
    @include('components.navbar')

    <!-- Main Container -->
    <div class="container mx-auto mt-8 p-6">
        <!-- Header -->
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Dashboard Overview</h1>

        <!-- Grid Layout for Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Quick Stats Card -->
            <div class="bg-blue-50 p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 border-l-4 border-blue-600">
                <h2 class="text-xl font-bold text-blue-700">Your Plan</h2>
                <p class="mt-2 text-gray-700">Computer Science</p>
                <p class="text-sm text-gray-600 mt-1">Credits Completed: 60/120</p>
            </div>

            <!-- Progress Tracker -->
            <div class="bg-green-50 p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 border-l-4 border-green-600">
                <h2 class="text-xl font-bold text-green-700">Academic Progress</h2>
                <div class="mt-3 bg-gray-200 rounded-full h-4">
                    <div class="bg-green-500 h-4 rounded-full" style="width: 50%;"></div>
                </div>
                <p class="mt-2 text-sm text-gray-600">50% completed</p>
            </div>

            <!-- Reports Section -->
            <div class="bg-yellow-50 p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 border-l-4 border-yellow-500">
                <h2 class="text-xl font-bold text-yellow-700">Reports</h2>
                <p class="mt-2 text-gray-700">View and download your performance reports.</p>
                <a href="#" class="mt-4 inline-block text-yellow-700 hover:text-yellow-900 font-medium transition-colors duration-300">
                    View Reports
                </a>
            </div>
        </div>
    </div>
</body>
</html>
