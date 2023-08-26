@extends('Layout.layout')
@section('content')
    <div>
        <div class="px-20 mt-10">
            <div>
                <h1 class="text-4xl text-primary font-semibold mb-5">Manage Order</h1>
            </div>
            <div class="text-lg text-primary font-medium">
                This Week
            </div>
        </div>


        <div class="flex flex-col gap-5 px-20 mt-5 w-full items-center">
            <div class="flex items-center w-full justify-between">
                <div class="flex justify-between items-center w-[85%]">
                    @foreach ($week_dates as $week_date)
                        <form action="/manageorder">
                            <button class="flex gap-2 border-2 border-dgray px-6 py-2 rounded  text-primary text-2xl hover:bg-primary hover:text-white" type="submit" name="submit_button" value="{{ $week_date }}">
                                <div class="font-medium">
                                    {{ $week_date->format('D') }}
                                </div>
                                <div class="font-semibold">
                                    {{ $week_date->format(' d') }}
                                </div>
                            </button>
                        </form>
                    @endforeach
                </div>
                <div class="w-0.5 h-10 bg-dgray mx-3"></div>
                <div>
                    <button class="flex items-center px-6 py-3 bg-secondary text-white rounded gap-2 hover:scale-105 hover:shadow-md transition-all duration-200 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary">
                        <i class="fa fa-list" fill="currentColor" viewBox="0 0 20 20"></i>
                        <span>Status</span>
                    </button>
                </div>
            </div>
            <div class="flex justify-between items-center w-full h-fit mb-10">
                <div class="inline-block w-[75%]">
                    <form id="my-form" action="" class="flex items-center px-3 gap-2 border-2 border-dgray rounded shadow-md w-full">
                        <i class="fa fa-search"></i>
                        <input type="hidden" name="submit_button" value="{{ $selected_date }}">
                        <input class="w-full py-3" type="search" placeholder="Enter a keyword" name="search">
                    </form>
                </div>

                <div class="w-0.5 h-10 bg-dgray mx-4"></div>
                <div class="inline-block w-[30%]">
                    <form id="my-form" action="" class="flex items-center px-3 gap-2 border-2 border-dgray rounded shadow-md w-full">
                        <img src="{{ Storage::url("assets/calender.png") }}" class="w-7 h-7">
                        <input type="hidden" name="submit_button" value="{{ $selected_date }}">
                        <input class="w-full py-3" type="text" id="date" name="date" placeholder="Enter a date">
                    </form>
                </div>
            </div>

            <div class="flex flex-col items-center justify-center w-full">
                <div class=" bg-white rounded shadow w-full h-1/2 p-6 border-2 border-lgray">
                    {{-- data --}}
                    <div class="flex gap-14 mb-7">
                        <div class="w-4/12 text-lg font-semibold text-primary ">
                            Order ID
                        </div>
                        <div class="w-2/12 text-lg font-semibold text-primary">
                            Status
                        </div>
                        <div class="w-2/12 text-lg font-semibold text-primary">
                            Date
                        </div>
                        <div class="w-2/12 text-lg font-semibold text-primary">
                            Buyer
                        </div>
                        <div class="w-2/12 text-lg font-semibold text-primary">
                            Total
                        </div>
                    </div>
                    <div class="flex flex-col gap-3">
                        @foreach ($order_header as $oh)
                            <a href="/orderdetail/{{ $oh->id }}">
                                <div class="text-lg font-medium">
                                    {{$oh->id}}
                                </div>
                                <div class="flex items-center gap-14">
                                    @foreach ($oh->order_detail as $od)
                                    @if ($loop->first)
                                    <div class="w-4/12">
                                        <div class="">
                                            <div class="text-base text-dgray">Preview</div>
                                            <div class="flex w-full items-center gap-2">
                                                <div class="w-16 h-16 rounded">
                                                    <img class="w-full h-full object-cover" src="{{ Storage::url("profile/menu/".$od->menu->profile_menu) }}"/>
                                                </div>
                                                <div class="text-base text-black font-medium">
                                                    {{$od->menu->name}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="w-2/12">
                                        <div class="w-2/3 py-2 px-4 border-[3px] border-secondary text-secondary font-medium rounded flex items-center justify-center">
                                            {{$od->status}}
                                        </div>
                                    </div>

                                    <div class="font-medium w-2/12">
                                        {{ date('d/m/Y', strtotime($od->arrival_date)) }}
                                    </div>

                                    <div class="flex gap-2 items-center w-2/12">
                                        <div class="w-9 h-9 rounded-full overflow-hidden">
                                            <img class="object-cover w-full h-full" src="{{Storage::url("profile/user/".$od->order_header->user->profile_picture)}}" alt="Profile Image">
                                        </div>
                                        <div class="font-medium">
                                            {{$od->order_header->user->username}}
                                        </div>
                                    </div>
                                    @break
                                    @endif
                                    @endforeach
                                    <div class="font-semibold w-2/12">
                                        Rp{{ number_format($oh->total_price/1000, 3, '.', ',') }},00
                                    </div>
                                </div>
                                <div class="mt-1 text-base text-secondary">+{{count($oh->order_detail)}} other item</div>
                            </a>
                            @if (!$loop->last)
                                <hr class="bg-gray-200 bg-opacity-20 h-[2px]">
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        var form = document.getElementById('my-form');
        var dateInput = document.getElementById('date');
        var dateAvailableDate = document.getElementById('available-date')
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
