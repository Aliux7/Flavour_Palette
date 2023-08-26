@extends('Layout.layout')
@section('content')
    <style>
        .container{
            width: 100%;
            height: 800px;
            background-color: #000000;
        }

        .slider{
            width: 100%;
            height: 800px;
            overflow: hidden;
        }

        .slides{
            width: 300%;
            height: 800px;
            display: flex;
        }

        .slides input{
            display: none;
        }

        .slide{
            width: 34%;
            transition: 2s;
        }

        .slide img{
            width: 100%;
            height: 800px;
        }

        .navigation-manual{
            position: absolute;
            width: 100%;
            margin-top: -40px;
            display: flex;
            justify-content: center;
        }

        .manual-btn{
            border: 2px solid #343C2D;
            padding: 15px;
            border-radius: 100px;
            cursor: pointer;
            transition: 1s;
        }

        .manual-btn:not(:last-child){
            margin-right: 20px;
        }

        .manual-btn:hover{
            background: #343C2D;
        }

        #radio1:checked ~ .first{
            margin-left: 0;
        }

        #radio2:checked ~ .first{
            margin-left: -34%;
        }

        #radio3:checked ~ .first{
            margin-left: -68%;
        }

        .navigation-auto{
            position: absolute;
            display: flex;
            width: 100%;
            justify-content: start;
            margin-top: 740px;
            margin-left: 20px;
        }

        .navigation-auto div{
            border: 2px solid #727C4A;
            padding: 15px;
            border-radius: 100px;
            transition: 1s;
        }

        .navigation-auto div:not(:last-child){
            margin-right: 20px;
        }

        #radio1:checked ~ .navigation-auto .auto-btn1{
            background: #343C2D;
        }


        #radio2:checked ~ .navigation-auto .auto-btn2{
            background: #343C2D;
        }

        #radio3:checked ~ .navigation-auto .auto-btn3{
            background: #343C2D;
        }
    </style>

    <div class="w-screen">
        @if (Auth::user() && Auth::user()->role == 'seller')
            <div class="px-20 mt-10">
                <div>
                    <h1 class="text-4xl text-primary font-semibold mb-5">Your Catering Menus</h1>
                </div>
                <div style="display: ">
                    <form id="my-form" action="/catalog">
                        <input type="hidden" name="submit_button" value="{{ $selected_date }}">
                        <input type="date" id="date" name="date" required class="block w-full rounded border-0 py-1.5 px-3 text-primary shadow-sm ring-1 ring-inset ring-dgray placeholder:text-dgray focus:ring-2 focus:ring-inset focus:ring-orange sm:text-sm sm:leading-6">
                    </form>
                </div>
            </div>
        @else
            <div class="container">
                <div class="overflow-hidden w-screen h-auto">
                    <div class="flex w-[300%]">
                        <input class="hidden" type="radio" name="radio-btn" id="radio1">
                        <input class="hidden" type="radio" name="radio-btn" id="radio2">
                        <input class="hidden" type="radio" name="radio-btn" id="radio3">

                        <div class="slide first">
                            <img class="object-cover" src="{{ Storage::url("advertisement/advertisement1.png") }}" alt="">
                        </div>
                        <div class="slide">
                            <img class="object-cover" src="{{ Storage::url("advertisement/advertisement2.png") }}" alt="">
                        </div>
                        <div class="slide">
                            <img class="object-cover" src="{{ Storage::url("advertisement/advertisement3.png") }}" alt="">
                        </div>

                        <div class="navigation-auto">
                            <div class="auto-btn1"></div>
                            <div class="auto-btn2"></div>
                            <div class="auto-btn3"></div>
                        </div>
                    </div>
                    <div class="absolute flex justify-start w-full mt-[-60px] ml-[20px]">
                        <label for="radio1" class="manual-btn"></label>
                        <label for="radio2" class="manual-btn"></label>
                        <label for="radio3" class="manual-btn"></label>
                    </div>
                </div>
                <script src="resources/js/Slider.js"></script>
            </div>

            <div class="px-20 mt-10">
                @if (Auth::user() && Auth::user()->role == 'customer')
                    <div class="bg-secondary flex flex-col gap-3 px-5 py-3 rounded">
                        <label class="text-white font-medium">Location</label>
                        <div class="flex items-center gap-2">
                            <img src="{{ Storage::url("assets/location.png") }}" style="width: 20px">
                            <form action="/catalog">
                                {{ csrf_field() }}
                                <input class="w-full bg-transparent placeholder:text-white" type="text" name="address" id="address" value="{{Auth::user()->address}}" placeholder="Input Your Address">
                            </form>
                        </div>
                    </div>
                @endif
            </div>
        @endif

        <div class="flex flex-col gap-5 px-20 mt-5 w-full">
            <div class="flex items-center w-full justify-between">
                <img src="{{ Storage::url("assets/calender.png") }}">
                <div class="flex justify-between items-center w-[75%]">
                    @foreach ($week_dates as $index=>$week_date)
                        <form action="/catalog">
                            <?php
                                $submit_button = null;
                                if(request('submit_button')){
                                    $submit_button = request('submit_button');
                                    $submit_button_datetime = DateTime::createFromFormat('Y-m-d H:i:s', $submit_button);
                                    $submit_button = $submit_button_datetime->format('Y-m-d');
                                }
                            ?>
                            <button id="button-{{$week_date->format('Y-m-d')}}" class="flex gap-2 border-2 w-[1/8] border-primary px-4 py-2 rounded  text-primary text-2xl hover:bg-primary hover:text-white" type="submit" name="submit_button" value="{{ $week_date }}">
                                <div class="font-medium">
                                    {{ $week_date->format('D') }}
                                </div>
                                <div class="font-semibold">
                                    {{ $week_date->format(' d') }}
                                </div>
                            </button>
                        </form>
                        <script>
                            if('{{$submit_button}}' == '{{$week_date->format('Y-m-d')}}'){
                                let dateButton = document.getElementById('button-{{$week_date->format('Y-m-d')}}');
                                dateButton.classList.add('bg-primary');
                                dateButton.classList.add('text-white');
                                dateButton.classList.add('text-2xl');
                                console.log('button-{{$week_date->format('Y-m-d')}}');

                            }
                        </script>
                    @endforeach
                </div>
                <div class="border-l-2 border-primary flex gap-5 pr-5 pl-14">
                    <div class="border-2 border-primary p-2 rounded">
                        <img id="sort-btn" class="cursor-pointer" src="{{ Storage::url("assets/sort.png") }}" style="width: 30px;"/>
                    </div>
                    <div class="border-2 border-primary p-2 rounded">
                        <img id="filter-btn" class="cursor-pointer" src="{{ Storage::url("assets/filter.png") }}" style="width: 30px;"/>
                    </div>
                </div>
            </div>
            <div class="relative flex justify-center items-center w-full h-fit mb-10">
                <i class="mx-auto absolute fa fa-search left-5 "></i>
                <form class="pl-14 border-2 border-primary rounded shadow-md w-full"action="{{ url('/catalog') }}">
                    <input type="hidden" name="submit_button" value="{{ $selected_date }}">
                    <input class="form-control w-full p-3 outline-none" type="search" placeholder="Enter a keyword" name="search">
                </form>
            </div>

            @if (Auth::user() && Auth::user()->role == 'seller')
                <div id="menu-data" class="w-full flex flex-wrap justify-between gap-y-10">
                    @foreach ($menus as $m)
                        <div class="">
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

                                        <form id="myForm1" action="/updatemenu" method="post">
                                            {{ csrf_field() }}
                                            <div class="flex w-full items-center gap-3 mt-5">
                                                <input type="hidden" name="menu_id" value="{{$m->id}}">
                                                <button class="flex w-full justify-center rounded bg-secondary px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:scale-105 hover:shadow-md transition-all duration-200 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary" type="submit" name="action" value="Edit">Edit</button>
                                                <button id="delete-btn1" class="font-medium text-secondary px-5" type="submit" name="action" value="Delete">Delete</button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    @for ($i = 0; $i < 5; $i++)
                        <div class="w-80 h-1 max-w-xs overflow-hidden rounded bg-transparent"></div>
                    @endfor
                </div>
                    <h1 class="text-4xl text-primary font-semibold mb-5">Archived Menus</h1>
                    <div class="w-full flex flex-wrap justify-between gap-y-10">
                        @foreach ($archived_menus as $am)
                            <div class="">
                                <div class="w-80 h-full max-w-xs overflow-hidden rounded shadow-md bg-white">
                                    <div>
                                        <div>
                                            <a href="/menudetail/{{ $am->id }}">
                                                <img class="" src="{{ Storage::url("profile/menu/".$am->profile_menu) }}"/>
                                            </a>
                                        </div>
                                        <div class="flex flex-col gap-3 px-3 py-6">

                                            <div class="flex justify-between h-auto">
                                                <div id="" class="h-14 text-primary font-semibold text-xl max-w-[65%]">
                                                    {{ $am->name }}
                                                </div>
                                                <div id="" class="">
                                                    <?php
                                                        $total_rating = 0;
                                                        $total_review = 0;
                                                    ?>
                                                    @foreach ($am->review as $rw)
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
                                                    By {{$am->catering->name}}
                                                </div>

                                                <div id=""  class="text-primary font-semibold text-base">
                                                    @foreach ($am->menu_category as $index => $amc)
                                                        {{$amc->category->name}}
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
                                                        Rp{{ number_format($am->price/1000, 3, '.', ',') }},00
                                                    </div>
                                                </div>
                                                <div class="border-l-2 border-gray-400 pl-2">
                                                    <div class="text-primary font-regular text-sm">Ordered</div>
                                                    <div id="" class="text-primary font-semibold text-base">
                                                        {{$am->ordered}}
                                                    </div>
                                                </div>
                                            </div>

                                            <form id="myForm" action="/updatemenu" method="POST" enctype="multipart/form-data">
                                                {{ csrf_field() }}
                                                <div class="flex w-full items-center gap-3 mt-5">
                                                    <input type="hidden" name="menu_id" value="{{$am->id}}">
                                                    <button class="flex w-full justify-center rounded bg-secondary px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:scale-105 hover:shadow-md transition-all duration-200 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary" type="submit" name="action" value="Edit">Edit</button>
                                                    <button id="delete-btn" class="font-medium text-secondary px-5" type="submit" name="action" value="Delete">Delete</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        @for ($i = 0; $i < 5; $i++)
                            <div class="w-80 h-1 max-w-xs overflow-hidden rounded bg-transparent"></div>
                        @endfor
                    </div>

                    <div class="flex flex-col items-center justify-center p-6 w-3/4 mx-auto">
                        <div class=" bg-white rounded shadow w-3/4 h-1/2">
                            <form action="" method="POST" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="flex w-full flex-col gap-5 px-6 py-12 lg:p-8">

                                    <div>
                                        <h2 class="mt-10 text-center text-4xl font-semibold leading-9 tracking-tight text-primary " >Add New Menu</h2>
                                    </div>

                                    <div class="">
                                        <div class="">
                                            <label for="name" class="block text-sm font-semibold leading-6 text-primary">Name</label>
                                            <div class="mt-2">
                                                <input type="text" required class="block w-full rounded border-0 py-1.5 px-3 text-primary shadow-sm ring-1 ring-inset ring-dgray placeholder:text-dgray focus:ring-2 focus:ring-inset focus:ring-orange sm:text-sm sm:leading-6" id="name" name="name" placeholder="Menu Name">
                                            </div>
                                        </div><br>
                                        <div class="">
                                            <label for="description" class="block text-sm font-semibold leading-6 text-primary">Description</label>
                                            <div class="mt-2">
                                                <input type="text" required class="block w-full rounded border-0 py-1.5 px-3 text-primary shadow-sm ring-1 ring-inset ring-dgray placeholder:text-dgray focus:ring-2 focus:ring-inset focus:ring-orange sm:text-sm sm:leading-6" id="description" name="description" placeholder="Menu Description">
                                            </div>
                                        </div><br>
                                        <div class="">
                                            <label for="price" class="block text-sm font-semibold leading-6 text-primary">Price</label>
                                            <div class="mt-2">
                                                <input type="text" required class="block w-full rounded border-0 py-1.5 px-3 text-primary shadow-sm ring-1 ring-inset ring-dgray placeholder:text-dgray focus:ring-2 focus:ring-inset focus:ring-orange sm:text-sm sm:leading-6" id="price" name="price" placeholder="Menu Price">
                                            </div>
                                        </div><br>
                                        <div class="">
                                            <label for="category" class="block text-sm font-semibold leading-6 text-primary">Category</label>
                                            <div class="mt-2">
                                                <select name="category" id="category" required class="block w-full rounded border-0 py-1.5 px-3 text-primary shadow-sm ring-1 ring-inset ring-dgray placeholder:text-dgray focus:ring-2 focus:ring-inset focus:ring-orange sm:text-sm sm:leading-6" >
                                                @foreach ($categories as $cg)
                                                    <option value="{{ $cg->name }}">{{ $cg->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div><br>
                                        <div class="">
                                            <label for="available-date" class="block text-sm font-medium leading-6 text-primary">Available Date</label>
                                            <div class="mt-2">
                                                <input type="date" name="available-date" id="available-date" required class="block w-full rounded border-0 py-1.5 px-3 text-primary shadow-sm ring-1 ring-inset ring-dgray placeholder:text-dgray focus:ring-2 focus:ring-inset focus:ring-orange sm:text-sm sm:leading-6">
                                            </div>
                                        </div><br>

                                        @if ($errors->any())
                                        <div class="">
                                            {{ $errors->first() }}
                                        </div>
                                        @endif

                                        <div class="mt-5 flex justify-center w-full">
                                            <button type="submit" class="flex w-full justify-center rounded bg-secondary px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:scale-105 hover:shadow-md transition-all duration-200 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary">Add Menu</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @else
                <div id="menu-data" class="w-full flex flex-wrap justify-between gap-y-10">
                    @foreach ($menus as $m)
                        <div class="">
                            <div class="w-80 h-full max-w-xs overflow-hidden rounded shadow-md bg-white">
                                <div>
                                    <div>
                                        <?php
                                        $submit_button = request()->input('submit_button');
                                        ?>
                                        <a href="/menudetail/{{ $m->id }}?submit_button={{ urlencode($submit_button) }}">
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
                                            @else
                                                <a href="/menudetail/{{ $m->id }}" class="bg-secondary rounded-full h-12 w-12 flex items-center justify-center text-white font-medium text-4xl hover:shadow-secondary hover:shadow-md" type="submit" >+</a>
                                            @endif
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @for ($i = 0; $i < 5; $i++)
                            <div class="w-80 h-1 max-w-xs overflow-hidden rounded bg-transparent"></div>
                        @endfor
                </div>

                {{-- <div style="">
                    <a href="{{ $menus->previousPageUrl() }}">&laquo;</a>
                    @for($i = 1; $i <= $menus->lastPage(); $i++)
                    <a class="" href="{{ $menus->url($i) }}">{{ $i }}</a>
                    @endfor
                    <a href="{{ $menus->nextPageUrl() }}">&raquo;</a>
                </div> --}}

            @endif
        </div>
    </div>

    <div id="layer2" class="hidden fixed inset-0 bg-black bg-opacity-50 z-40"></div>

    <div id="sort-modal" class="hidden fixed w-fit z-50 p-14 bg-white shadow-md rounded" style="top: 55%; left: 50%; transform: translate(-50%, -50%);">
        <form action="/catalog" class="flex w-fit gap-5 flex-col">
            <label for="sort_by" class="font-semibold text-xl">Sort By</label>
            <div class="flex flex-col gap-2">
                <div class="flex items-center gap-3 font-medium text-base">
                    <input type="radio" name="sort_by" value="highest_rating">Highest Rating
                </div>
                <div class="flex items-center gap-3 font-medium text-base">
                    <input type="radio" name="sort_by" value="lowest_price">Lowest Price
                </div>
                <div class="flex items-center gap-3 font-medium text-base">
                    <input type="radio" name="sort_by" value="highest_price">Highest Price
                </div>
            </div>
            <input type="hidden" name="submit_button" value="{{ $selected_date }}">
            <button type="submit" class="mt-5 flex w-full justify-center rounded bg-secondary px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:scale-105 hover:shadow-md transition-all duration-200 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary">Sort</button>
        </form>
    </div>

    <div id="filter-modal" class="hidden fixed w-5/12 z-50 p-10 bg-white shadow-md rounded" style="top: 55%; left: 50%; transform: translate(-50%, -50%);">
        <form class="flex flex-col items-start gap-3" action="/catalog" enctype="multipart/form-data">
            <label for="filter" class="font-semibold text-xl">Filter</label>
            <div class="flex flex-col gap-2 w-full">
                <label class="text-secondary font-medium text-base">Price Range</label>

                <div class="flex items-center justify-between w-full border-b-2 border-gray-200 pb-3">
                    <input class="border-2 rounded py-1 px-5" type="number" name="lowest_price" id="lowest_price">
                    -
                    <input class="border-2 rounded py-1 px-5" type="number" name="highest_price" id="highest_price">

                </div>
            </div>
            <div class="flex flex-col items-start gap-3 border-b-2 border-gray-200 pb-3 w-full">
                <label class="text-secondary font-medium text-base">Rating</label>
                <div class="flex flex-col gap-2">
                    <div class="flex items-center gap-3 font-medium text-base">
                        <input type="radio" name="rating" value="all">All
                    </div>
                    <div class="flex items-center gap-3 font-semibold text-base">
                        <input type="radio" name="rating" value="5">5
                    </div>
                    <div class="flex items-center gap-3 font-semibold text-base">
                        <input type="radio" name="rating" value="4">4+
                    </div>
                    <div class="flex items-center gap-3 font-semibold text-base">
                        <input type="radio" name="rating" value="3">3+
                    </div>
                </div>
            </div>

            <div class="flex flex-col items-start gap-5 w-full">
                <label class="text-secondary font-medium text-base">Category</label>
                <div class="flex flex-wrap gap-5">
                    @foreach ($categories as $c)
                    <div class="flex">
                        <input type="checkbox" id="{{ $c->name }}" name="categories[]" value="{{ $c->name }}" class="peer hidden">
                        <label for="{{ $c->name }}" class="select-none cursor-pointer rounded-xl border-2 border-primary
                        py-1 px-3 font-bold text-primary transition-colors duration-200 ease-in-out peer-checked:bg-primary peer-checked:text-white peer-checked:border-primary">
                            {{ $c->name }}
                        </label>
                    </div>
                    @endforeach
                </div>
            </div>
            <input type="hidden" name="submit_button" value="{{ $selected_date }}">
            <button type="submit" class="mt-5 flex w-full justify-center rounded bg-secondary px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:scale-105 hover:shadow-md transition-all duration-200 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary" name="filter" value="submit">Filter</button>
        </form>
    </div>

    <div id="inactivate-modal" class="hidden flex flex-col items-center fixed w-3/12 z-50 p-10 bg-white shadow-md rounded" style="top: 50%; left: 50%; transform: translate(-50%, -50%);">
        <div class="w-full text-xl text-center">Are you sure you want to deactivate your account?</div>
        <div class="mt-5 flex justify-center w-full">
            <button id="" type="submit" class="flex w-full justify-center rounded bg-transparent border-2 border-secondary px-3 py-1.5 text-sm font-semibold leading-6 text-secondary shadow-sm hover:scale-101 hover:bg-secondary hover:text-white hover:shadow-md transition-all duration-200 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary">Yes</button>
        </div>
        <div class="mt-5 flex justify-center w-full">
            <a href="#" onclick="location.reload()" class="w-full">
                <button type="submit" class="flex w-full justify-center rounded bg-secondary border-4 border-secondary px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:scale-105 hover:shadow-md transition-all duration-200 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary">Cancel</button>
            </a>
        </div>
        <div></div>
    </div>

    <div id="confirm-modal" class="hidden flex flex-col items-center fixed w-3/12 z-50 p-10 bg-white shadow-md rounded" style="top: 50%; left: 50%; transform: translate(-50%, -50%);">
        <div class="w-full text-xl text-center">Are you sure you want to remove your menu?</div>
        <div class="mt-5 flex justify-center w-full">
            <button id="confirmDelButton" type="submit" class="flex w-full justify-center rounded bg-transparent border-4 border-secondary px-3 py-1.5 text-sm font-semibold leading-6 text-secondary shadow-sm hover:scale-101 hover:bg-secondary hover:text-white hover:shadow-md transition-all duration-200 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary">Yes</button>
        </div>
        <div class="mt-5 flex justify-center w-full">
            <a href="#" onclick="location.reload()" class="w-full">
                <button type="submit" class="flex w-full justify-center rounded bg-secondary border-4 border-secondary px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:scale-105 hover:shadow-md transition-all duration-200 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary">Cancel</button>
            </a>
        </div>
        <div></div>
    </div>

    <script>

        let filterBtn = document.getElementById('filter-btn');
        let sortBtn = document.getElementById('sort-btn');

        let layer2 = document.getElementById('layer2');
        let filterModal = document.getElementById('filter-modal');
        let sortModal = document.getElementById('sort-modal');
        let deleteBtn = document.getElementById('delete-btn');
        let deleteBtn1 = document.getElementById('delete-btn1');
        let confirmationModal = document.getElementById('confirm-modal');

        filterBtn.addEventListener('click', function() {
            layer2.style.display = 'block';
            filterModal.style.display = 'block';
        });

        sortBtn.addEventListener('click', function() {
            layer2.style.display = 'block';
            sortModal.style.display = 'block';
        });

        layer2.addEventListener('click', function() {
            layer2.style.display = 'none';
            confirmationModal.style.display = 'none';
            sortModal.style.display = 'none';
            filterModal.style.display = 'none';
        });

        deleteBtn.addEventListener('click', function(){
            layer2.style.display = 'block';
            confirmationModal.style.display = 'block';
            event.preventDefault();

            confirmDelButton.addEventListener('click', function(){
                var deleteForm = document.getElementById('myForm');
                deleteForm.submit();
            });

        });

        deleteBtn1.addEventListener('click', function(){
            layer2.style.display = 'block';
            confirmationModal.style.display = 'block';
            event.preventDefault();

            confirmDelButton.addEventListener('click', function(){
                var deleteForm = document.getElementById('myForm1');
                deleteForm.submit();
            });
        });

        var form = document.getElementById('my-form');
        var dateInput = document.getElementById('date');
        var dateAvailableDate = document.getElementById('available-date');
        dateInput.addEventListener('change', function() {
            var selected_date = new Date(this.value);

            if (selected_date.getDay() !== 1) {
                alert('Start date must be in Monday!');
                this.value = '';
            }else{
            form.submit();
        }
        });

        dateAvailableDate.addEventListener('change', function(){
            var selected_date = new Date(this.value);
            var today = new Date();

            if (selected_date <= today) {
                alert('Please select a date after today.');
                this.value = '';
            }
        });
    </script>
@endsection
