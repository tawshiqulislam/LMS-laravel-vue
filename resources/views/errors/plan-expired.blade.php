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
                <p class="title">{{ __('Subscription Expired') }}</p>
                <p class="description">
                    This organization’s plan has expired, so access to this domain is currently unavailable.<br>
                    Please contact your organization administrator to renew the subscription.<br><br>
                    If you are the owner, you can log in to the <a href="{{ config('app.url') }}">main portal</a> to
                    manage and renew your plan.
                </p>
            </div>

            <a href="{{ config('app.url') }}" target="_blank" class="reload_btn" style="text-decoration: none">
                {{ __('Return to Main Portal') }}
            </a>
        </section>
    </main>
</body>

</html>
