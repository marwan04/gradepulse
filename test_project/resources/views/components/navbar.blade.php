<nav class="bg-gradient-to-r from-blue-700 to-blue-500 text-white shadow-lg">
    <div class="container mx-auto px-6 py-4 flex justify-between items-center">
        <!-- Logo/Title -->
        <div class="text-2xl font-bold">
            <a href="#" class="hover:text-gray-200">Student Dashboard</a>
        </div>

        <!-- Student Name and Logout -->
        <div class="flex items-center space-x-6">
            <span class="text-lg font-medium">
                Welcome, <span class="text-yellow-300">{{ auth('student')->user()->name }}</span>
            </span>
            <a href="{{ route('logout') }}" class="text-sm bg-red-500 px-4 py-2 rounded hover:bg-red-700 transition-colors duration-300">
                Logout
            </a>
        </div>
    </div>
</nav>
