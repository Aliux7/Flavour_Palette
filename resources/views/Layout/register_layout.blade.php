<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Flavour Palette</title>
</head>
<body class="">
    <style>
        input:focus {
            outline-color: transparent;
            -webkit-focus-ring-color: transparent;
        }
        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        :root {
            --white: white;
            --darkgreen: #727C4A;
        }

        .switch-wrapper {
            position: relative;
            display: inline-flex;
            padding: 4px;
            width: 100%;
            border: 1px solid lightgrey;
            margin: 2rem 0px 2rem 0px;
            border-radius: 5px;
            background: var(--white);
        }

        .switch-wrapper [type="radio"] {
            position: absolute;
            left: -9999px;
        }

        .switch-wrapper [type="radio"]:checked#customer ~ label[for="customer"],
        .switch-wrapper [type="radio"]:checked#seller ~ label[for="seller"] {
            color: var(--white);
        }

        .switch-wrapper [type="radio"]:checked#customer ~ label[for="customer"]:hover,
        .switch-wrapper [type="radio"]:checked#seller ~ label[for="seller"]:hover {
            background: transparent;
        }

        .switch-wrapper
            [type="radio"]:checked#customer
            + label[for="seller"]
            ~ .highlighter {
            transform: none;
        }

        .switch-wrapper
            [type="radio"]:checked#seller
            + label[for="customer"]
            ~ .highlighter {
            transform: translateX(100%);
        }

        .switch-wrapper label {
            font-size: 16px;
            z-index: 1;
            min-width: 50%;
            line-height: 32px;
            cursor: pointer;
            border-radius: 5px;
            transition: color 0.25s ease-in-out;
        }

        .switch-wrapper label:hover {
            background: var(--lightgray);
        }

        .switch-wrapper .highlighter {
            position: absolute;
            top: 4px;
            left: 4px;
            width: calc(50% - 4px);
            height: calc(100% - 8px);
            border-radius: 5px;
            background: var(--darkgreen);
            transition: transform 0.25s ease-in-out;
        }

    </style>
    <div class="relative flex flex-col items-center justify-center p-6 w-full h-fit">
        <img class="absolute top-0 left-0 -z-10 w-full h-full object-cover" src="{{Storage::url("assets/header-photo.png")}}" alt="">
        <div class="flex flex-col z-10 items-center justify-center bg-white rounded shadow w-3/4 h-fit" style="background-color: rgba(255, 255, 255, 0.9);">
            <div class="w-3/4 flex h-fit flex-col justify-center px-6 py-12 lg:p-85">
                <a href="{{url('/')}}"><img src="{{Storage::url("assets/Logo.png")}}" class="mx-auto h-40 w-auto"></a>
                @yield('tab_content')
            </div>
        </div>
    </div>
</body>
</html>
