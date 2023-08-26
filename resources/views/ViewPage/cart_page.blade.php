@extends('Layout.layout')

@section('content')

    <div class="flex justify-between p-12">
        <div class="w-3/5 flex flex-col gap-5">

            <div class="w-full text-4xl font-semibold border-b-2 border-lgray pb-5">Cart</div>

            <?php $total_price = 0 ?>
            @foreach ($carts as $index => $c)
            <div class="">
                <form action="{{ url('/cart/update') }}" method="POST" enctype="application/json">
                    {{ csrf_field() }}
                    <div class="flex flex-col gap-6 border-b-2 border-lgray pb-5">
                        <?php
                            $date = new DateTime($c->available_date);
                            $formattedDate = $date->format('l, d F Y');
                        ?>
                        <div class="text-base font-semibold">{{ $formattedDate }}</div>
                        <div class="text-base font-semibold text-secondary">
                            {{ $c->menu->catering->name }}
                        </div>
                        <div class="flex items-center gap-5 h-40">
                            <div class="w-40 h-auto">
                                <img class="object-cover w-full h-full" src="{{Storage::url("profile/menu/".$c->menu->profile_menu)}}" alt="">
                            </div>

                            <div class="flex flex-col justify-between h-full w-full">
                                <div>
                                    <div>
                                        {{$c->menu->name}}
                                    </div>
                                    <div class="mt-2 text-sm text-dgray">
                                        @foreach ($c->menu->menu_category as $mg)
                                            {{$mg->category->name}}
                                        @endforeach
                                    </div>
                                </div>

                                <div class="flex justify-between w-full">
                                    <div class="text-base font-semibold">
                                        Rp {{ number_format($c->menu->price, 2, ',', '.'); }}
                                    </div>
                                    <input type="number" id="menu-price-{{ $index }}" value="{{ $c->menu->price }}" hidden>
                                    <?php $total_price += ($c->menu->price*$c->quantity) ?>
                                    <div class="flex items-center justify-center gap-3">
                                        <button type="submit" class="" name="action" value="Delete"><img src="{{Storage::url("assets/trash.png")}}" alt=""></button>
                                        <div class="flex items-center justify-center w-full">
                                            <button class="border rounded-left bg-transparent" style="color: black; width: 25%; outline: none;" id="decrease-{{ $index }}">-</button>
                                            <input class="border" style="text-align: center; color: black !important; max-width: 40%;" type="number" id="quantity-{{ $index }}" name="quantity" value="{{$c->quantity}}" disabled>
                                            <button class="border rounded-right bg-transparent" style="color: black; width: 25%; outline: none;" id="increase-{{ $index }}">+</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <script>
                    var quantity_input = document.getElementById('quantity-{{ $index }}');

                    // add quantity
                    $(document).ready(function() {
                        $('#increase-{{ $index }}').click(function(e) {
                            e.preventDefault();
                            const data = {
                                _token: "{{ csrf_token() }}",
                                id: "{{ $c->id }}",
                                quantity: quantity_input.value,
                                type: "add"
                            }
                            const jsonData = JSON.stringify(data);

                            $.ajax({
                                url: '/cart/update',
                                method: 'POST',
                                data: jsonData,
                                dataType: 'json',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                                    'Content-Type': 'application/json'
                                },
                                contentType: 'application/json',
                                processData: true,
                                success: function(response) {
                                    $("#quantity-{{ $index }}").val(response.quantity);
                                    updateTotalPrice();
                                },
                                error: function(xhr, status, error) {
                                    console.error(error);
                                }
                            });
                        });
                    });

                    // min quantity
                    $(document).ready(function() {
                        $('#decrease-{{ $index }}').click(function(e) {
                            e.preventDefault();
                            const data = {
                                _token: "{{ csrf_token() }}",
                                id: "{{ $c->id }}",
                                quantity: quantity_input.value,
                                type: "minus"
                            }
                            const jsonData = JSON.stringify(data);

                            $.ajax({
                                url: '/cart/update',
                                method: 'POST',
                                data: jsonData,
                                dataType: 'json',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                                    'Content-Type': 'application/json'
                                },
                                contentType: 'application/json',
                                processData: true,
                                success: function(response) {
                                    document.getElementById('quantity-{{ $index }}').value = response.quantity;
                                    updateTotalPrice();
                                },
                                error: function(xhr, status, error) {
                                    console.error(error);
                                }
                            });
                        });
                    });
                </script>
            </div>
            @endforeach
        </div>

        <div class="w-2/5 flex items-start justify-center">
            <div class="flex flex-col items-center justify-center w-full mx-auto">
                <div class=" bg-white rounded shadow w-3/4 h-1/2 py-7 border-2 border-lgray px-6">
                    <form action="/delivery">
                        {{ csrf_field() }}
                        <div class="flex flex-col gap-5 w-full" >
                            <div class="flex justify-between">
                                <label for="">Total Price</label>
                                <label for="total_price" id="total_price">Rp{{ number_format($total_price/1000, 3, '.', ',') }},00</label>
                                <input type="hidden" name="total_price" value="{{ $total_price }}">
                            </div>
                            <button type="submit" class="flex w-full justify-center rounded bg-secondary px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:scale-105 hover:shadow-md transition-all duration-200 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary" name="action">Checkout</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        var price_element = document.getElementById('total_price');

        function updateTotalPrice() {
            let total_price = 0;
            const total_menu = {{ $carts->count() }};
            for (let i = 0; i < total_menu; i++) {
                total_price += document.getElementById('menu-price-' + i).value * document.getElementById('quantity-' + i).value;
            }
            price_element.innerHTML = `${total_price.toLocaleString("id-ID", {
                                            style: "currency",
                                            currency: "IDR"
                                        })}`;
        }
    </script>
@endsection
