<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <style>
            body {
                font-family: system-ui, sans-serif;
                background-color: #ffffff;
                color: #27272a;
            }

            .container {
                margin: 0 auto;
                padding: 1rem;
                max-width: 600px;
            }

            .btn {
                background-color: #0069a8;
                color: #ffffff;
                padding: .75rem 1rem;
                border-radius: .375rem;
                text-decoration: none;
            }

            .btn:hover {
                background-color: #005678;
            }

            .text-center {
                text-align: center;
            }
        </style>
    </head>

    <body>
        <div class="container">
            <h1 class="text-center">{{ __('emails.candidacyReceived.heading') }}</h1>
            <p class="text-center">{{ __('emails.candidacyReceived.textHtml') }}</p>
            <br />
            <p class="text-center mb-4"><a class="btn" href="{{ $link }}">{{ __('emails.candidacyReceived.button') }}</a></p>
        </div>
    </body>
</html>