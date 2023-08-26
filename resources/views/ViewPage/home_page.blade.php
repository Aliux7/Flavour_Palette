@extends('Layout.layout')

@section('content')
        <section class="relative h-screen w-screen">
            <div class="z-20 text-center relative text-white container h-full mx-auto">
                <div class="flex flex-col gap-16 items-center justify-center h-full max-w-5xl mx-auto">
                    @if (Auth::user() && Auth::user()->role == 'seller')
                        <h1 class="text-orange font-bold text-5xl drop-shadow-md">Increase Your Sales with Flavour Palette</h1>
                        <p class="font-medium text-xl ">Welcome to our online catering website! We provide an easy and convenient way for you to showcase and sell your delicious food to a wide audience. Our platform offers a simple and user-friendly interface for you to manage your orders and reach new customers. Join us and become part of our growing community of satisfied sellers and customers. Start selling on our website today and let us help you grow your business!</p>
                    @else
                        <h1 class="text-orange font-bold text-5xl drop-shadow-md">Savor with Ease Delicious Meals for All</h1>
                        <p class="font-medium text-xl ">Welcome to our online catering website! We provide a wide variety of delicious food that can be easily enjoyed by everyone. We offer a wide selection of food that can satisfy your taste buds. We believe that good food doesn't have to be difficult to enjoy. Therefore, we provide easy and fast online catering services so you can enjoy delicious food anytime, anywhere.</p>
                        <a href="" class="inline-block text-lg leading-none px-5 py-2 border-2 rounded font-semibold text-orange border-orange hover:text-white hover:bg-orange transition-all duration-200">View Menu</a>
                    @endif
                </div>
                </div>
            <div class="absolute inset-0 z-10">
                <img src="{{ Storage::url('assets/header-photo.png') }}" alt="" class="h-full w-full object-cover">
            </div>
        </section>

        <div class="mt-14 w-[85%] mx-auto flex flex-col gap-20">
            @if (!Auth::user() || Auth::user() && Auth::user()->role == 'customer')
                <div class="flex w-full h-max gap-[5%]">
                    <div class="h-full flex flex-col gap-10 w-[40%] items-center">
                        <h1 class="text-primary font-semibold text-5xl">Revolutionize Your Daily Meals</h1>
                        <p class="text-primary font-regular text-xl">Are you tired of the same boring meals every day? Say goodbye to mealtime monotony with our catering subscription service! Our platform allows you to customize your daily meals according to your dietary preferences and taste buds.</p>
                        <a href="{{ url('/catalog') }}" class="w-max inline-block text-lg leading-none px-5 py-2 border-2 rounded font-semibold text-secondary border-secondary hover:text-white hover:bg-secondary transition-all duration-200">View Menu</a>
                    </div>
                    <img class="w-[47.5%] h-full flex-grow" src="{{ Storage::url('assets/first-image.png') }}" alt="">
                </div>
            @endif

            <div class="w-full h-max">
                <img class="w-full h-auto" src="{{ Storage::url('assets/second-image.png') }}" alt="">
            </div>

            @if (!Auth::user() || Auth::user() && Auth::user()->role == 'customer')
                <div id="popular-menu" class="flex flex-col m-auto p-auto w-full">
                    <div class="w-full flex flex-row justify-between items-baseline">
                        <h1 class="text-primary font-semibold text-5xl">Popular Menu for The Week</h1>
                        <a href="{{ url('/catalog') }}" class="mt-auto text-primary font-regular text-sm">See More</a>
                    </div>
                    <div class="mt-5 flex h-auto overflow-x-scroll pb-10 hide-scroll-bar">
                        <div class="flex flex-nowrap">
                            @foreach ($menus as $m)
                                <div class="inline-block px-4">
                                    <div class="w-80 h-full max-w-xs overflow-hidden rounded shadow-md bg-white">
                                        <div>
                                            <div>
                                                <a href="/menudetail/{{ $m->id }}">
                                                    <img class="" src="{{ Storage::url("profile/menu/".$m->profile_menu) }}"/>
                                                </a>
                                            </div>
                                            <div class="flex flex-col gap-3 px-3 py-6">

                                                <div class="flex justify-between h-auto">
                                                    <div id="" class="h-14 text-primary font-semibold text-xl max-w-[65%]">
                                                        {{ $m->name }}
                                                    </div>
                                                    <div id="" class="">
                                                        <?php
                                                            $total_rating = 0;
                                                            $total_review = 0;
                                                        ?>
                                                        @foreach ($m->review as $rw)
                                                            <?php
                                                                $total_rating = $total_rating + $rw->rating;
                                                                $total_review++;
                                                            ?>
                                                        @endforeach
                                                        <i class="fa fa-star" style="color: #E39D36"></i>
                                                        <?php
                                                            if ($total_review < 1) {
                                                                ?>
                                                                <span class="text-primary font-semibold text-sm">No Rating</span>
                                                                <?php
                                                            } else {
                                                                $total_rating = $total_rating / $total_review;
                                                                ?>
                                                                <span class="font-semibold">
                                                                    {{ number_format((float)$total_rating, 2, '.', '') }}
                                                                </span>
                                                                <sub>/5</sub>
                                                                <?php
                                                            }
                                                        ?>
                                                    </div>

                                                </div>

                                                <div class="h-[50px]">
                                                    <div id="" class="text-primary font-regular text-sm">
                                                        By {{$m->catering->name}}
                                                    </div>

                                                    <div id=""  class="text-primary font-semibold text-base">
                                                        @foreach ($m->menu_category as $index => $mc)
                                                            {{$mc->category->name}}
                                                            @if (!$loop->last)
                                                                |
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>

                                                <div class="flex justify-between items-center">
                                                    <div>
                                                        <div class="text-primary font-regular text-sm">Price</div>
                                                        <div id="" class="text-primary font-semibold text-base">
                                                            Rp{{ number_format($m->price/1000, 3, '.', ',') }},00
                                                        </div>
                                                    </div>
                                                    <div class="border-l-2 border-gray-400 pl-2">
                                                        <div class="text-primary font-regular text-sm">Ordered</div>
                                                        <div id="" class="text-primary font-semibold text-base">
                                                            {{$m->ordered}}
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="ml-auto">
                                                    @if (!Auth::user())
                                                    <a href="/login" class="bg-secondary rounded-full h-12 w-12 flex items-center justify-center text-white font-medium text-4xl hover:shadow-secondary  hover:shadow-md">+</a>
                                                    @elseif (Auth::user()->role == 'customer')
                                                        @php $countWishlist = 0 @endphp
                                                        @if(Auth::check())
                                                            @php $countWishlist = App\Models\wishlist::countWishlist($m['id']) @endphp
                                                        @endif
                                                        <div class="flex gap-5 items-center ">
                                                            <a href="#" data-menuid="{{$m->id}}" class="update_wishlist">
                                                                @if ($countWishlist > 0)
                                                                    <i class="fas fa-heart fa-2x"></i>
                                                                @else
                                                                    <i class="far fa-heart fa-2x"></i>
                                                                @endif
                                                            </a>

                                                            <a href="/menudetail/{{ $m->id }}" class="bg-secondary rounded-full h-10 w-10 flex items-center justify-center text-white font-medium text-4xl hover:shadow-secondary hover:shadow-md" type="submit" >+</a>
                                                        </div>
                                                    @else
                                                    <button class="flex w-full justify-center rounded bg-secondary px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:scale-105 hover:shadow-md transition-all duration-200 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary" type="submit" name="action" value="Edit">Edit</button>
                                                    <button class="font-medium text-secondary px-5" type="submit" name="action" value="Delete">Delete</button>
                                                    @endif
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            @endif

        </div>

        <div class="mt-10 flex justify-between h-[90%] w-screen">

            <div>
                <img src="{{Storage::url('assets/food-photo.png')}}" alt="" class="mb-auto w-auto">
            </div>

            <div class="flex flex-col items-end justify-between w-3/5 gap-16">
                <div>
                    <div class="h-full flex flex-col gap-10 w-full items-start">
                        <h1 id="about-us" class="text-primary font-semibold text-5xl">About Us</h1>
                        <p class="text-primary font-regular text-xl">We are Flavour Palette, an online catering service that allows you to enjoy quality meals every day. We have more than 100 professional catering kitchens that are ready to cook your favorite menu, from healthy, fusion, oriental, to traditional dishes. You can order daily catering menu through Flavour Palette app with affordable price and flexible booking. You can also freely customize your catering menu according to your taste and schedule.</p>
                        <a href="{{ url('/catalog') }}" class="w-max inline-block text-lg leading-none px-5 py-2 border-2 rounded font-semibold text-secondary border-secondary hover:text-white hover:bg-secondary transition-all duration-200">View Menu</a>
                    </div>
                </div >
                <div class="flex justify-between items-center w-[99%]">
                    <img src="{{Storage::url('assets/delivery-photo.png')}}" alt="" class="h-full">
                    <img src="{{Storage::url('assets/katsu-photo.png')}}" alt="" class="h-full">
                </div>
            </div>
        </div>

            <div class="pt-14 w-[85%] h-auto mx-auto flex flex-col gap-5">
            <div>
                <h1 class="text-primary font-semibold text-5xl">Meet Our Partners</h1>
            </div>
            <div>
                <div class="flex flex-wrap justify-between h-[400px] gap-y-5">
                    <div class="w-[13.5%] bg-orange h-1/2 flex justify-center items-center"></div>
                    <div class="w-[13.5%] bg-orange h-1/2 flex justify-center items-center"></div>
                    <div class="w-[13.5%] bg-orange h-1/2 flex justify-center items-center"></div>
                    <div class="w-[13.5%] bg-orange h-1/2 flex justify-center items-center"></div>
                    <div class="w-[13.5%] bg-orange h-1/2 flex justify-center items-center"></div>
                    <div class="w-[13.5%] bg-orange h-1/2 flex justify-center items-center"></div>
                    <div class="w-[13.5%] bg-orange h-1/2 flex justify-center items-center"></div>
                    <div class="w-[13.5%] bg-orange h-1/2 flex justify-center items-center"></div>
                    <div class="w-[13.5%] bg-orange h-1/2 flex justify-center items-center"></div>
                    <div class="w-[13.5%] bg-orange h-1/2 flex justify-center items-center"></div>
                    <div class="w-[13.5%] bg-orange h-1/2 flex justify-center items-center"></div>
                    <div class="w-[13.5%] bg-orange h-1/2 flex justify-center items-center"></div>
                    <div class="w-[13.5%] bg-orange h-1/2 flex justify-center items-center"></div>
                    <div class="w-[13.5%] bg-orange h-1/2 flex justify-center items-center"></div>
                  </div>

            </div>
            </div>

        <style>
            .wishlist-btn {
                background: none;
                border: none;
                cursor: pointer;
            }

            .far.fa-heart {
                color: #727C4A;
            }

            .fas.fa-heart {
                color: #727C4A;
                fill: #727C4A;
            }
        </style>

@endsection

@push('javascript')

    <script>
        var user_id = "{{ Auth::id() }}";
        $(document).ready(function(){
            $('.update_wishlist').click(function(){
                event.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var menu_id = $(this).data('menuid');
                $.ajax({
                    type: 'POST',
                    url: '/updatewishlist',
                    data: {
                        menu_id: menu_id,
                        user_id: user_id
                    },
                    success:function(response){
                        if(response.action == 'add'){
                            $('a[data-menuid='+menu_id+']').html('<i class="fas fa-heart fa-2x"></i>');
                            $('#notifDiv').fadeIn();
                            $('#notifDiv').css('background', 'green');
                            $('#notifDiv').text(response.message);
                            setTimeout(() => {
                                $('#notifDiv').fadeOut();
                            }, 3000);
                        }else if(response.action == 'remove'){
                            $('a[data-menuid='+menu_id+']').html('<i class="far fa-heart fa-2x"></i>');
                            $('#notifDiv').fadeIn();
                            $('#notifDiv').css('background', 'red');
                            $('#notifDiv').text(response.message);
                            setTimeout(() => {
                                $('#notifDiv').fadeOut();
                            }, 3000);
                        }
                    }
                });
            });
        });
    </script>
@endpush
