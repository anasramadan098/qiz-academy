<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    <link rel="stylesheet" href="{{asset('admin/css/main.css')}}">
    <title>Dashboard</title>
</head>
<body>
    <nav>
        <span class="active" style="display: none">@yield('active',0)</span>
        <ul>
            <li>
                <a href="/dashboard/users">Users</a>
            </li>
            <li>
                <a href="/dashboard/files">Files</a>
            </li>
            <li>
                <a href="/dashboard/short_courses">Short Courses</a>
            </li>
            <li>
                <a href="/dashboard/long_courses">Long Courses</a>
            </li>
        </ul>
    </nav>
    <main>
        <h1>Dashboard</h1>
        @yield('content')
    </main>

    <script>
        const allLinks = document.querySelectorAll('nav ul li a');
        allLinks[document.querySelector('.active').textContent].classList.add('active');
                    
    </script>
</body>
</html>

