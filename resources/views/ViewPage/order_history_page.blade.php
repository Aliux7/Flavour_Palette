@extends('Layout.layout')
@section('content')

    <div class="flex flex-col py-12 px-24">
        <div class="font-semibold text-xl">
            Order History
        </div>
        <div class="flex flex-col gap-5 mt-5 w-full">

            <div class="flex justify-between items-center w-full h-fit">
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

            <div class="flex gap-5 mb-10">
                <div class="text-secondary font-normal text-lg border-2 border-secondary py-1.5 px-4 rounded">
                    In Delivery
                </div>
                <div class="text-secondary font-normal text-lg border-2 border-secondary py-1.5 px-4 rounded">
                    Done
                </div>
                <div class="text-secondary font-normal text-lg border-2 border-secondary py-1.5 px-4 rounded">
                    Latest
                </div>
            </div>

            {{-- data --}}
            @foreach ($order_header as $oh)
                <a href="/orderdetail/{{ $oh->id }}" class="flex flex-col items-center justify-center w-full">
                    <div class=" bg-white rounded shadow w-full h-1/2 p-6 border-2 border-lgray flex flex-col gap-4">
                        @foreach ($oh->order_detail as $od)
                        @if ($loop->first)
                            <div class="flex gap-3">
                                <div class="text-secondary font-normal text-sm">
                                    {{ date('j F Y', strtotime($oh->order_date)) }}
                                </div>
                                <div class="text-secondary font-normal text-xs border-[1px] border-secondary py-[0.05rem] px-[0.1rem] rounded">
                                    {{$od->status}}
                                </div>
                                <div class="text-secondary font-normal text-sm">
                                    {{$oh->id}}
                                </div>
                            </div>
                            <div class="text-xl font-semibold">
                                {{$od->menu->catering->name}}
                            </div>
                            @break
                            @endif
                            @endforeach

                        <div class="flex justify-between items-center h-full ">
                            @foreach ($oh->order_detail as $od)
                                @if ($loop->first)
                                <div class="w-3/4 h-full">
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
                                        <div class="mt-1 text-base text-secondary font-medium">+{{count($oh->order_detail)}} other item</div>
                                    </div>
                                </div>
                                @break
                                @endif
                            @endforeach
                            <div class="border-l-2 border-gray-200 pl-5">
                                <div class="text-base text-dgray">Preview</div>
                                <div class="font-semibold w-2/12">
                                    Rp{{ number_format($oh->total_price/1000, 3, '.', ',') }},00
                                </div>
                            </div>
                        </div>
                        <div class="text-right text-secondary text-base font-semibold">See Detail</div>
                    </div>
                </a>

            @endforeach
        </div>
    </div>

    <script>
        var form = document.getElementById('my-form');
        var dateInput = document.getElementById('date');
        dateInput.addEventListener('change', function() {
            var selected_date = new Date(this.value);
            form.submit();
        });

    </script>

    </div>
@endsection
