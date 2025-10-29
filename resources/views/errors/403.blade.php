<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 Forbidden</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/error.css') }}">
</head>

<body>
    <main class="flex justify-center items-center">
        <section>
            <div class="image">
                <img src="{{ asset('assets/images/dino-403.svg') }}" alt="403 Forbidden">
            </div>
            <div class="details">
                <p class="title">Access Denied</p>
                <p class="description">
                    You don’t have permission to access to this page.<br>
                    Please contact the administrator if you believe this is an mistake.
                </p>
            </div>

            <a href="/" class="reload_btn" style="text-decoration: none">
                Return to Homepage
            </a>
        </section>
    </main>
</body>

</html>
