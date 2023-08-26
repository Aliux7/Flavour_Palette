@extends('Layout.layout')

@section('content')

<div class="p-12 flex flex-col h-auto">
        <div class="text-2xl font-semibold text-primary mb-5">My Wishlist</div>
        <div class="flex flex-wrap gap-5">
            @foreach ($menus as $m)
                <div class="inline-block">
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

                                <div class="">
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
                                    <a href="/login" class="bg-secondary rounded-full h-10 w-10 flex items-center justify-center text-white font-medium text-4xl hover:shadow-secondary  hover:shadow-md">+</a>
                                    @elseif (Auth::user()->role == 'customer')
                                        @php $countWishlist = 0 @endphp
                                        @if(Auth::check())
                                            @php $countWishlist = App\Models\wishlist::countWishlist($m['id']) @endphp
                                        @endif
                                        <div class="flex gap-5 items-center">
                                            <a href="#" data-menuid="{{$m->id}}" class="update_wishlist">
                                                @if ($countWishlist > 0)
                                                    <i class="fas fa-heart fa-2x"></i>
                                                @else
                                                    <i class="far fa-heart fa-2x"></i>
                                                @endif
                                            </a>

                                            <button class="bg-secondary rounded-full h-10 w-10 flex items-center justify-center text-white font-medium text-4xl hover:shadow-secondary hover:shadow-md" type="submit" >+</button>

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
