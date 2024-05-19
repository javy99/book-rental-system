<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Rental System</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.4/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .dropdown-content {
            display: none;
            position: absolute;
            right: 0;
            top: 120%;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .dropdown-content a,
        .dropdown-content form {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            border-bottom: 1px solid #eaeaea;
        }

        .dropdown-content a:hover,
        .dropdown-content form:hover {
            background-color: #f1f1f1;
        }

        .dropdown-button::after {
            content: "";
            display: inline-block;
            margin-left: 5px;
            vertical-align: middle;
            border-top: 5px solid;
            border-right: 5px solid transparent;
            border-left: 5px solid transparent;
        }

        .dropdown-button:hover::after {
            border-top-color: #000;
        }
    </style>
</head>

<body class="bg-gray-100 flex flex-col min-h-screen">
    <nav class="bg-white py-4 shadow">
        <div class="container mx-auto flex justify-between">
            <a class="text-lg font-bold" href="/">BRS</a>
            @auth
            <div class="relative">
                <a href="#" class="px-4 dropdown-button font-bold" onclick="toggleDropdown(event)">{{ auth()->user()->name }}</a>
                <div class="dropdown-content">
                    @if(auth()->user()->is_librarian)
                    <a class="font-bold" href="{{ route('createBook') }}" class="px-4">Add New Book</a>
                    <a class="font-bold" href="{{ route('genreList') }}" class="px-4">Genre List</a>
                    <a class="font-bold" href="{{ route('rentalList') }}" class="px-4">Rental List</a>
                    @endif
                    @if(!auth()->user()->is_librarian)
                    <a class="font-bold" href="{{ route('myRentals') }}" class="px-4">My Rentals</a>
                    @endif
                    <a class="font-bold" href="{{ route('profile.show') }}">Profile</a>
                    <form method="POST" action="{{ route('logout') }}" class="inline-block">
                        @csrf
                        <button type="submit" class="w-full text-left font-bold">Logout</button>
                    </form>
                </div>
            </div>
            @else
            <div>
                <a href="{{ route('login') }}" class="px-4">Login</a>
                <a href="{{ route('register') }}" class="px-4">Register</a>
            </div>
            @endauth
        </div>
    </nav>

    <main class="flex-grow">
        @yield('content')
    </main>

    <footer class="bg-white py-4 mt-8 text-center shadow">
        <p class="font-bold">&copy; 2024 Book Rental System | <span id="name">Javy</span></p>
    </footer>


    <script>
        function toggleDropdown(event) {
            event.preventDefault();
            let dropdownContent = event.target.nextElementSibling;
            if (dropdownContent.style.display === "block") {
                dropdownContent.style.display = "none";
            } else {
                dropdownContent.style.display = "block";
            }
        }

        window.onclick = function(event) {
            if (!event.target.matches('.dropdown-button')) {
                var dropdowns = document.getElementsByClassName("dropdown-content");
                for (var i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.style.display === "block") {
                        openDropdown.style.display = "none";
                    }
                }
            }
        }
    </script>
</body>

</html>