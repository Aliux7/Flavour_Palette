<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Flavour Palette</title>
</head>
<body>
    <style>
        .hide-scroll-bar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
        .hide-scroll-bar::-webkit-scrollbar {
            display: none;
        }

        body{
            overflow-x: hidden;
        }
    </style>

    <nav class="sticky top-0 bg-white flex items-center justify-between px-12 py-4 shadow-md w-screen" style="z-index: 45">
        <div class="w-full block flex-grow lg:flex lg:items-center lg:w-auto">

            <div class="flex items-center gap-12 lg:flex-grow">
                <a href="{{ url('/') }}"><img src="{{Storage::url("assets/Logo.png")}}" width="120" height="70"></a>
                <a href="{{ url('/') }}" class="{{ request()->route()->getName() === 'home' ? 'text-primary' : 'text-secondary' }} block lg:inline-block text-lg font-semibold hover:text-primary hover:drop-shadow-md">Home</a>
                <a href="{{ url('/catalog') }}" class="{{ request()->route()->getName() === 'catalog' ? 'text-primary' : 'text-secondary' }} block lg:inline-block text-lg font-semibold hover:text-primary hover:drop-shadow-md">Menu</a>
                <a href="{{ url('/#about-us') }}" onclick="scrollToAboutUs()" class="{{ request()->route()->getName() === 'about-us' ? 'text-primary' : 'text-secondary' }} block lg:inline-block text-lg font-semibold hover:text-primary hover:drop-shadow-md">About Us</a>
            </div>

            @if (!Auth::user())
                <div class="flex gap-3">
                    <a href="/login" class="inline-block text-lg leading-none px-5 py-2 border-2 rounded font-semibold text-secondary border-secondary hover:text-white hover:bg-secondary transition-all duration-200">Sign In</a>
                    <a href="/register" class="inline-block text-lg leading-none px-5 py-2 bg-secondary rounded font-semibold text-white hover:shadow-md hover:shadow-secondary transition-all duration-200">Sign Up</a>
                </div>
            @else
                <div class="flex gap-10">
                    @if (Auth::user()->role == 'customer')
                        <div class="flex gap-7 items-center">
                            <a href="{{url('/cart')}}" ><i class="fa fa-bag-shopping fa-2x text-secondary"></i></a>
                        </div>
                    @endif
                    <div class="w-10 h-10 mt-2 rounded-full overflow-hidden">
                        <img id="profile-btn" src="{{ Storage::url("profile/user/".Auth::user()->profile_picture) }}" class="object-cover w-full h-full cursor-pointer">
                    </div>
                </div>
            @endif
        </div>
    </nav>

    @if (Auth::user())

        <div id="layer" class="hidden fixed inset-0 bg-black bg-opacity-50 z-40"></div>

        <div id="profile-modal" class="hidden fixed w-5/12 z-50 p-10 bg-white shadow-md rounded" style="top: 50%; left: 50%; transform: translate(-50%, -50%);">
            <div class="flex items-center rounded justify-between p-3 bg-white shadow-md">
                <div class="flex items-center gap-5">
                    <img src="{{ Storage::url("profile/user/".Auth::user()->profile_picture ) }}" height="50" width="50">
                    <div>
                        <p class="font-semibold text-lg text-primary">{{ Auth::user()->username }}</p>
                        <p class="font-light text-sm" style="color: rgba(52, 60, 45, 0.5);">{{ Auth::user()->email }}</p>
                    </div>
                </div>
                <a href="/profile"><i class="fa fa-regular fa-pen-to-square text-primary"></i></a>
            </div>
            <div class="mt-5 flex">
                <div class="flex flex-col gap-3 flex-grow border-r border-r-primary">
                    <div class="flex gap-2 items-center text-left">
                        <i class="fa fa-phone text-primary"></i>
                        <p class="font-medium text-lg text-primary text-left">{{ Auth::user()->phone_number }}</p>
                    </div>
                    @if (Auth::user()->role == 'customer')
                        <div class="flex gap-2 items-center text-left">
                            <i class="fa fa-cake-candles text-primary"></i>
                            <p class="font-medium text-lg text-primary text-left">{{ \Carbon\Carbon::createFromFormat('Y-m-d', Auth::user()->dob)->format('d F Y') }}</p>
                        </div>
                    @endif
                    <div class="flex gap-2 items-center text-left">
                        <i class="fa fa-venus-mars text-primary"></i>
                        <p class="font-medium text-lg text-primary text-left">{{ ucfirst(Auth::user()->gender) }}</p>
                    </div>
                    <div class="flex gap-2 items-center text-left">
                        <i class="fa fa-spinner text-primary"></i>
                        <p class="font-medium text-lg text-primary text-left">{{ ucfirst(Auth::user()->status) }}</p>
                    </div>
                </div>
                <div class="flex flex-col justify-between flex-grow ml-5 gap-16">
                    <div class="flex flex-col gap-3">
                        @if (Auth::user()->role == 'customer')
                            <a class="text-secondary text-lg font-medium hover:text-primary" href="{{url('/orderhistory')}}">Order History</a>
                            <a class="text-secondary text-lg font-medium hover:text-primary" href="{{url('/wishlist')}}">Wishlist</a>
                        @else
                            <a class="text-secondary text-lg font-medium hover:text-primary" href="{{url('/manageorder')}}">Manage Order</a>
                            <a id="withdraw-btn" class="text-secondary text-lg font-medium cursor-pointer hover:text-primary">Withdraw Pocket</a>
                        @endif
                    </div>
                    <div class="flex flex-col gap-3">
                        @if(Auth::user()->status == "active")
                            <label id="inactivate-account" class="cursor-pointer text-secondary text-lg font-medium hover:text-primary">Inactivate Account</label>
                        @else
                            <label id="inactivate-account" class="cursor-pointer text-secondary text-lg font-medium hover:text-primary">Activate Account</label>
                        @endif
                        <a class="cursor-pointer text-secondary text-lg font-medium hover:text-primary" href="{{url('/logout')}}">Logout</a>
                    </div>
                </div>
            </div>
        </div>

        <div id="inactivate-modal" class="hidden flex flex-col items-center fixed w-3/12 z-50 p-10 bg-white shadow-md rounded" style="top: 50%; left: 50%; transform: translate(-50%, -50%);">
            <form action="/">
                @if(Auth::user()->status == "active")
                    <div class="w-full text-xl text-center">Are you sure you want to deactivate your account?</div>
                    <div class="mt-5 flex justify-center w-full">
                        <button type="submit" id="deactivate" name="deactivate" value="deactivate" class="flex w-full justify-center rounded bg-transparent border-2 border-secondary px-3 py-1.5 text-sm font-semibold leading-6 text-secondary shadow-sm hover:scale-101 hover:bg-secondary hover:text-white hover:shadow-md transition-all duration-200 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary">Yes</button>
                    </div>
                @else
                    <div class="w-full text-xl text-center">Are you sure you want to activate your account?</div>
                    <div class="mt-5 flex justify-center w-full">
                        <button type="submit" id="activate" name="activate" value="activate" class="flex w-full justify-center rounded bg-transparent border-2 border-secondary px-3 py-1.5 text-sm font-semibold leading-6 text-secondary shadow-sm hover:scale-101 hover:bg-secondary hover:text-white hover:shadow-md transition-all duration-200 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary">Yes</button>
                    </div>
                @endif
            </form>
            <div class="mt-5 flex justify-center w-full">
                <button id="cancel-button" type="submit" class="flex w-full justify-center rounded bg-secondary border-4 border-secondary px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:scale-105 hover:shadow-md transition-all duration-200 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary">Cancel</button>
            </div>
            <div></div>
        </div>

        <div id="withdraw-modal" class="hidden flex flex-col items-center fixed w-3/12 z-50 p-10 bg-white shadow-md rounded" style="top: 50%; left: 50%; transform: translate(-50%, -50%);">
            <div class="w-2/5 flex items-start justify-center w-full">
                <div class="flex flex-col items-center justify-between w-full mx-auto">
                    <div class="w-full">
                        <form action="/delivery" class="w-full">
                            {{ csrf_field() }}
                            <div class="flex flex-col gap-5 w-full" >
                                <div class="font-semibold text-xl text-primary">Detail Saldo</div>
                                <div class="flex justify-between w-full">
                                    <label for="">Total Price</label>
                                    <label for="total_price" id="total_price">Rp{{ number_format(session('total_price')/1000, 3, '.', ',') }},00</label>
                                    <input type="hidden" name="total_price" value="{{ session('total_price') }}">
                                </div>
                                <button type="submit" class="flex w-full justify-center rounded bg-secondary px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:scale-105 hover:shadow-md transition-all duration-200 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary" name="action">Withdraw</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    @endif

    <section>
        @yield('content')
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
        @stack('javascript')
    </section>

    <footer class="mt-20">
        <div class="px-24 py-10  bg-gradient-to-br from-[#FAD6A0] via-[#BAB183] to-[#818666] w-screen h-auto flex items-start justify-between">
            <div class="w-[25%]">
                <div><a href="{{ url('/') }}"><img src="{{Storage::url("assets/Logo.png")}}" width="120" height="70"></a></div>
                <div class="mt-5 font-semibold text-base text-primary">About Us</div>
                <div class="mt-2 font-regular text-sm text-white">We are Flavour Palette, an online catering service that allows you to enjoy quality meals every day.</div>
            </div>

            <div class="flex flex-col items-start gap-3 w-1/5">
                <div class="font-semibold text-base text-primary">Fast Links</div>
                <div class="font-light text-base text-white"><a href="#">Our Menu</a></div>
                <div class="font-light text-base text-white"><a href="#">Promotions</a></div>
                <div class="font-light text-base text-white"><a href="#">Partners</a></div>
                <div class="font-light text-base text-white"><a href="#">Contact Us</a></div>
            </div>

            <div class="flex flex-col items-start gap-3 w-1/5">
                <div class="font-semibold text-base text-primary">Contact Info</div>
                <div class="font-light text-base text-white"><a href="https://twitter.com/">Twitter</a></div>
                <div class="font-light text-base text-white"><a href="https://www.facebook.com/">Facebook</a></div>
                <div class="font-light text-base text-white"><a href="https://www.instagram.com/">Instagram</a></div>
                <div class="font-light text-base text-white"><a href="https://web.whatsapp.com/">Whatsapp</a></div>
            </div>

            <div class="flex flex-col items-baseline gap-1 w-[25%]">
                <div class="font-semibold text-base text-primary">Newsletter</div>
                <div class="mt-5 font-normal text-base text-white">Stay up to date with us</div>
                <div class="relative mt-5 flex items-center w-full h-fit">
                    <input type="email" id="email" name="email" required class="block w-full rounded border-0 py-1.5 px-3 text-primary placeholder:text-dgray sm:text-sm sm:leading-6" placeholder="Email" value="{{ Cookie::get('emailcookie') !== null ? Cookie::get('emailcookie') : '' }}">
                    <div class="absolute" style="right: -2px; cursor: pointer;">
                        <button class="py-1.5 px-3 bg-orange text-white rounded">Subscribe</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="p-4 w-full flex items-center justify-center">
            <p style="color:rgb(172, 172, 172);">
                &copy; 2023 Flavour Palette All Right Reserved
            </p>
        </div>
    </footer>

    <script>
        let profileBtn = document.getElementById('profile-btn');
        let layer = document.getElementById('layer');
        let profileModal = document.getElementById('profile-modal');
        let inactivateLabel = document.getElementById('inactivate-account');
        let inactivateAcc = document.getElementById('inactivate-modal');
        let withdraw = document.getElementById('withdraw-btn');
        let withdrawModal = document.getElementById('withdraw-modal');

        inactivateLabel.addEventListener('click', function(){
            profileModal.style.display = 'none';
            layer.style.display = 'block';
            inactivateAcc.style.display = 'block';
        });

        profileBtn.addEventListener('click', function() {
            layer.style.display = 'none';
            profileModal.style.display = 'none';
            inactivateAcc.style.display = 'none';

            layer.style.display = 'block';
            profileModal.style.display = 'block';
        });

        layer.addEventListener('click', function() {
            layer.style.display = 'none';
            profileModal.style.display = 'none';
            inactivateAcc.style.display = 'none';
            withdrawModal.style.display = 'none';

        });

        withdraw.addEventListener('click', function(){
            profileModal.style.display = 'none';
            inactivateAcc.style.display = 'none';

            layer.style.display = 'block';
            withdrawModal.style.display = 'block';
        });

        function scrollToAboutUs() {
            var targetOffset = $('#about-us').offset().top - 150; // Adjust the offset as needed
            $('html, body').animate({
                scrollTop: targetOffset
            }, 1000);
        }
    </script>
</body>

</html>
