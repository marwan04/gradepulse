<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Grade Pulse')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <style>
        /* :ocean: Transparent Navbar inside Hero Section */
        .navbar {
            position: absolute;
            width: 100%;
            background: rgba(0, 0, 0, 0.1); /* Light transparent background */
            transition: all 0.3s ease-in-out;
        }
        .navbar-brand {
            font-size: 24px;
            font-weight: bold;
            color: white !important;
        }
        .navbar-nav .nav-link {
            color: white !important;
            font-size: 16px;
            transition: 0.3s;
        }
        .navbar-nav .nav-link:hover {
            color: #FFA500 !important;
        }
        .btn-auth {
            background-color: #FFA500;
            border-radius: 20px;
            padding: 8px 18px;
            transition: 0.3s;
        }
        .btn-auth:hover {
            background-color: #E69500;
        }

        /* :art: Hero Section - Integrated with Navbar */
        .hero {
            background: linear-gradient(135deg, #0056B3, #30A7A3);
            color: white;
            text-align: center;
            padding: 120px 0;
        }
        .btn-accent {
            background-color: #FFA500;
            border-radius: 20px;
            padding: 10px 20px;
            transition: 0.3s;
        }
        .btn-accent:hover {
            background-color: #E69500;
        }

        /* :rocket: Features Section */
        .feature-box {
            border-radius: 10px;
            padding: 30px;
            background: #F8F9FA;
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }
        .feature-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        .testimonial {
            background: linear-gradient(135deg, #30A7A3, #0056B3);
            color: white;
            padding: 50px 0;
        }
        .footer {
            background: #1F3A60;
            color: white;
            padding: 20px 0;
            text-align: center;
        }
    </style>
    @yield('styles')
</head>
<body>

    <!-- :white_check_mark: Transparent Navbar Blended into Hero -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <i class="bi bi-mortarboard-fill"></i> Grade Pulse
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#features">Features</a></li>
                    <li class="nav-item"><a class="nav-link" href="#testimonials">Testimonials</a></li>
                </ul>

                <!-- :white_check_mark: Authentication Links -->
                @guest
                    <a class="btn btn-outline-light me-2" href="{{ route('login') }}">Sign In</a>
                    <a class="btn btn-auth" href="{{ route('register') }}">Register</a>
                @else
                    <div class="dropdown">
                        <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle"></i> {{ Auth::user()->name }}
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <!-- :white_check_mark: Show Dashboard Link Based on Role -->
                            @if(Auth::guard('student')->check())
                                <li><a class="dropdown-item" href="{{ route('student.dashboard') }}"><i class="bi bi-speedometer2"></i> Student Dashboard</a></li>
                            @elseif(Auth::guard('instructor')->check())
                                <li><a class="dropdown-item" href="{{ route('instructor.dashboard') }}"><i class="bi bi-speedometer2"></i> Instructor Dashboard</a></li>
                            @endif

                            <li><a class="dropdown-item" href="#"><i class="bi bi-gear"></i> Settings</a></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button class="dropdown-item text-danger"><i class="bi bi-box-arrow-right"></i> Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @endguest
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <div>@yield('content')</div>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; {{ date('Y') }} Grade Pulse | <a href="#" class="text-light">Privacy Policy</a></p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>