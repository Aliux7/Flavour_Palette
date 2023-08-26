<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Flavour Palette</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body class="relative flex flex-col items-center justify-center p-6 w-screen h-screen">

    <style>
        input:focus {
            outline-color: transparent;
            -webkit-focus-ring-color: transparent;
        }
    </style>
    <img class="absolute top-0 left-0 -z-10 w-full h-full object-cover" src="{{Storage::url("assets/header-photo.png")}}" alt="">
    <div class="flex flex-col z-10 items-center justify-center p-6 w-3/4 h-fit">
        <div class=" bg-white rounded shadow w-3/4 h-fit" style="background-color: rgba(255, 255, 255, 0.9);">
        <form action="/login" method="POST" >
            {{ csrf_field() }}
            <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:p-8">
                <div class="sm:mx-auto sm:w-full sm:max-w-sm">
                    <a href="{{url('/')}}"><img src="{{Storage::url("assets/Logo.png")}}" class="mx-auto h-36 w-auto"></a>
                    <h2 class="mt-10 text-center text-4xl font-semibold leading-9 tracking-tight text-primary ">Welcome Back!</h2>
                    <p class="mt-10 text-center text-sm leading-9 tracking-tight text-primary">Sign in to continue</p>
                </div>

                <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
                <form class="space-y-6" action="#" method="POST">
                    <div>
                    <label for="email" class="block text-sm font-medium leading-6 text-primary">Email or Username</label>
                        <div class="mt-2">
                            <input type="email" id="email" name="email" required class="block w-full rounded border-0 py-1.5 px-3 text-primary shadow-sm ring-1 ring-inset ring-dgray placeholder:text-dgray focus:ring-2 focus:ring-inset focus:ring-orange sm:text-sm sm:leading-6" placeholder="Email or Username" value="{{ Cookie::get('emailcookie') !== null ? Cookie::get('emailcookie') : '' }}">
                        </div>
                    </div>
                    <div class="mt-5">
                        <label for="password" class="block text-sm font-medium leading-6 text-primary">Password</label>
                        <div class="relative mt-2 flex items-center w-full h-fit">
                            <input type="password" required class="block w-full rounded border-0 py-1.5 px-3 text-primary shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-yellow-500 sm:text-sm sm:leading-6" id="password" name="password" placeholder="Password">
                            <div class="absolute" style="right: 10px; cursor: pointer;" onclick="pass()">
                                <i id="eye-icon" class="fa fa-eye-slash"></i>
                            </div>
                        </div>
                    </div>

                    @if ($errors->any())
                        <div class="text-red-600 font-bold mt-3 text-sm">
                            {{$errors->first()}}
                        </div>
                    @endif

                    <div class="mt-5 flex items-center justify-center gap-2">
                        <input class="rounded" type="checkbox" id="remember" name="remember">
                        <label class="text-sm" for="remember">Remember Me</label>
                    </div>

                    <div class="mt-5 flex justify-center w-full">
                        <button type="submit" class="flex w-full justify-center rounded bg-secondary px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:scale-105 hover:shadow-md transition-all duration-200 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary">Sign In</button>
                    </div>
                </form>

                <p class="mt-20 text-center text-sm text-primary">
                    Don’t have an account?
                    <a href="{{route('tab_customer')}}" class="font-semibold leading-6 text-secondary hover:text-primary" type="button">Sign Up</a>
                </p>
                </div>
            </div>

            <script>
                var a;
                function pass(){
                    if(a==1){
                        document.getElementById('password').type='password';
                        document.getElementById('eye-icon').classList.remove('fa-eye');
                        document.getElementById('eye-icon').classList.add('fa-eye-slash');
                        a=0;
                    }else{
                        document.getElementById('password').type='text';
                        document.getElementById('eye-icon').classList.remove('fa-eye-slash');
                        document.getElementById('eye-icon').classList.add('fa-eye');
                        a=1;
                    }
                }
            </script>

        </form>
        </div>
    </div>
</body>
</html>
