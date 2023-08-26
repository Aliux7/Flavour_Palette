@extends('Layout.register_layout')

@section('tab_content')

    <form action="{{ route('authCustomer') }}" method="POST" enctype="multipart/form-data">
        {{csrf_field()}}

        <h2 class="mt-10 text-center text-5xl font-bold leading-9 tracking-tight text-secondary ">Hello!</h2>
        <p class="mt-10 text-center text-lg leading-9 tracking-tight text-gray-400">Sign up to continue</p>

        <div class="w-full text-center px-10">
            <div class="switch-wrapper">
                <input id = "customer" type="radio" name="switch" value="customer" checked>
                <input id = "seller" type="radio" name="switch" value="seller">
                <label for="customer">Customer</label>
                <label for="seller">Seller</label>
                <span class="highlighter"></span>
            </div>
        </div>

        <div class="mt-5 flex flex-col justify-center items-center w-full gap-5">
            <div class="flex flex-col justify-center items-center w-full h-auto">
                <label for="" class=" rounded-full bg-white color-white cursor-pointer w-36 h-36 text-center flex items-center justify-center text-secondary text-4xl font-semibold">+</label>
                {{-- <img class="" src="{{Storage::url("assets/profile/".$user->image)}}" style="width:30px;height:30px;"/> --}}
                <input type="file" class="hidden file:text-white file:bg-secondary file:border-secondary" id="profile_picture" name="profile_picture" style="width: 20vw; border: 0px solid rgba(128, 128, 128, 0.418);}">
            </div>
        </div>

        <div class="mt-5">
            <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email</label>
            <div class="mt-2">
                <input type="text" class="block w-full rounded-md border-0 py-1.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-yellow-500 sm:text-sm sm:leading-6"  id="email" name="email" placeholder="Email">
            </div>
        </div>

        <div class="mt-5">
            <label for="username" class="block text-sm font-medium leading-6 text-gray-900">Username</label>
            <div class="mt-2">
                <input type="text" class="block w-full rounded-md border-0 py-1.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-yellow-500 sm:text-sm sm:leading-6" id="username" name="username" placeholder="Username">
            </div>
        </div>

        <div class="mt-5">
            <label for="fullname" class="block text-sm font-medium leading-6 text-gray-900">Full Name</label>
            <div class="mt-2">
                <input type="text" class="block w-full rounded-md border-0 py-1.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-yellow-500 sm:text-sm sm:leading-6" id="fullname" name="fullname" placeholder="Full Name">
            </div>
        </div>

        <div class="mt-5">
            <label for="phone_number" class="block text-sm font-medium leading-6 text-gray-900">Phone Number</label>
            <div class="mt-2">
                <input type="number" class="block w-full rounded-md border-0 py-1.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-yellow-500 sm:text-sm sm:leading-6" id="phone_number" name="phone_number" placeholder="Phone Number">
            </div>
        </div>

        <div class="mt-5">
            <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
            <div id="password_div" class="relative mt-2 flex items-center w-full h-fit">
                <input type="password" class="block w-full rounded border-0 py-1.5 px-3 text-primary shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-yellow-500 sm:text-sm sm:leading-6" id="password" name="password" placeholder="Password">
                <div class="absolute" style="right: 10px;" onclick="pass()">
                    <i id="eye-icon-pw" class="fa fa-eye-slash"></i>
                </div>
            </div>
        </div>

        <div class="mt-5">
            <label for="password_confirmation" class="block text-sm font-medium leading-6 text-gray-900">Confirm Password</label>
            <div id="confirm_password_div" class="relative mt-2 flex items-center w-full h-fit">
                <input type="password" class="block w-full rounded border-0 py-1.5 px-3 text-primary shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-yellow-500 sm:text-sm sm:leading-6" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password">
                <div class="absolute" style="right: 10px;" onclick="pass2()">
                    <i id="eye-icon-conf" class="fa fa-eye-slash"></i>
                </div>
            </div>
        </div>

        <div class="mt-5">
            <label for="gender" class="mr-2 text-sm font-medium leading-6 text-gray-900">Gender</label>
            <input type="radio" name="gender" value="male" class="mr-2 text-sm font-medium leading-6 text-gray-900">Male
            <input type="radio" name="gender" value="female" class="mr-2 text-sm font-medium leading-6 text-gray-900">Female
        </div>

        <div class="mt-5">
            <label for="dob" class="block text-sm font-medium leading-6 text-gray-900">Date of Birth</label><br>
            <input type="date" name="dob" id="dob"  class="block w-full rounded border-0 py-1.5 px-3 text-primary shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-yellow-500 sm:text-sm sm:leading-6">
        </div><br>

        <input type="hidden" name="role" value = "customer"/>

        @if ($errors->any())
            <div class="">
                {{$errors->first()}}
            </div>
        @endif
        <div class="mt-5 flex justify-center w-full">
            <button type="submit" class="flex w-full justify-center rounded-md bg-secondary px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:scale-105 hover:shadow-md transition-all duration-200 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-600">Sign up</button>
        </div>

        <p class="mt-20 text-center text-sm text-gray-500">
            Already have an account?
            <a href="/login" class="font-semibold leading-6 text-secondary hover:text-indigo-500" type="button">Sign in</a>
        </p>

        <script>
            var a;
            function pass(){
                if(a==1){
                    document.getElementById('password').type='password';
                    document.getElementById('eye-icon-pw').classList.remove('fa-eye');
                    document.getElementById('eye-icon-pw').classList.add('fa-eye-slash');
                    a=0;
                }else{
                    document.getElementById('password').type='text';
                    document.getElementById('eye-icon-pw').classList.remove('fa-eye-slash');
                    document.getElementById('eye-icon-pw').classList.add('fa-eye');
                    a=1;
                }
            }
            var b;
            function pass2(){
                if(b==1){
                    document.getElementById('password_confirmation').type='password';
                    document.getElementById('eye-icon-conf').classList.remove('fa-eye');
                    document.getElementById('eye-icon-conf').classList.add('fa-eye-slash');
                    b=0;
                }else{
                    document.getElementById('password_confirmation').type='text';
                    document.getElementById('eye-icon-conf').classList.remove('fa-eye-slash');
                    document.getElementById('eye-icon-conf').classList.add('fa-eye');
                    b=1;
                }
            }
        </script>

    </form>

@endsection
