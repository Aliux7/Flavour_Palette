@extends('Layout.layout')

@section('content')
    <div class="bg-gray-100 flex flex-col items-center justify-center py-10 px-5 h-full">
        <div class="flex flex-col items-center justify-center p-6 w-3/4 h-auto">
            <div class=" bg-white rounded shadow w-3/4 h-auto py-12 px-6">
                <form action="/updateprofile" class="flex flex-col gap-5 w-full" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value = "{{$user->id}}"/>
                    <div class="font-semibold text-2xl">Account Detail</div>
                    <div class="mt-5">
                        <label for="profile_picture" class="">Profile picture</label>
                        <div style="width: 35vw;display: flex; justify-content: space-between;">
                            {{-- <img class="" src="{{Storage::url("assets/profile/".$user->image)}}" style="width:30px;height:30px;"/> --}}
                            <input type="file" class="" id="profile_picture" name="profile_picture" style="width: 20vw; border: 0px solid rgba(128, 128, 128, 0.418);}">
                        </div>
                    </div>

                    <div class="mt-5">
                        <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email</label>
                        <div class="mt-2">
                            <input type="text" class="block w-full rounded-md border-0 py-1.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-yellow-500 sm:text-sm sm:leading-6"  id="email" name="email" placeholder="Email" value="{{$user->email}}">
                        </div>
                    </div>

                    <div class="mt-5">
                        <label for="username" class="block text-sm font-medium leading-6 text-gray-900">Username</label>
                        <div class="mt-2">
                            <input type="text" class="block w-full rounded-md border-0 py-1.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-yellow-500 sm:text-sm sm:leading-6" id="username" name="username" placeholder="Username" value="{{$user->username}}">
                        </div>
                    </div>

                    <div class="mt-5">
                        <label for="fullname" class="block text-sm font-medium leading-6 text-gray-900">Full Name</label>
                        <div class="mt-2">
                            <input type="text" class="block w-full rounded-md border-0 py-1.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-yellow-500 sm:text-sm sm:leading-6" id="fullname" name="fullname" placeholder="Full Name" value="{{$user->fullname}}">
                        </div>
                    </div>

                    <div class="mt-5">
                        <label for="phone_number" class="block text-sm font-medium leading-6 text-gray-900">Phone Number</label>
                        <div class="mt-2">
                            <input type="number" class="block w-full rounded-md border-0 py-1.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-yellow-500 sm:text-sm sm:leading-6" id="phone_number" name="phone_number" placeholder="Phone Number" value="{{$user->phone_number}}">
                        </div>
                    </div>

                    <div class="mt-5">
                        <label for="gender" class="mr-2 text-sm font-medium leading-6 text-gray-900">Gender</label>
                        @if ($user->gender == 'male')
                            <input type="radio" name="gender" value="male" class="mr-2 text-sm font-medium leading-6 text-gray-900" checked>Male
                            <input type="radio" name="gender" value="female" class="mr-2 text-sm font-medium leading-6 text-gray-900">Female
                            @else
                            <input type="radio" name="gender" value="male" class="mr-2 text-sm font-medium leading-6 text-gray-900">Male
                            <input type="radio" name="gender" value="female" class="mr-2 text-sm font-medium leading-6 text-gray-900" checked>Female
                        @endif

                    </div>

                    <div class="mt-5">
                        <label for="dob" class="block text-sm font-medium leading-6 text-gray-900">Date of Birth</label><br>
                        <input type="date" name="dob" id="dob"  class="block w-full rounded border-0 py-1.5 px-3 text-primary shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-yellow-500 sm:text-sm sm:leading-6" value="{{$user->dob}}">
                    </div><br>

                    @if ($errors->any())
                        <div class="">
                            {{$errors->first()}}
                        </div>
                    @endif
                    <div class="mt-5 flex justify-center w-full">
                        <button type="submit" class="flex w-full justify-center rounded-md bg-secondary px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:scale-105 hover:shadow-md transition-all duration-200 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-600">Save</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="flex flex-col items-center justify-center p-6 w-3/4 h-auto">
            <div class=" bg-white rounded shadow w-3/4 h-auto py-12 px-6">
                <form action="/updatepassword" class="flex flex-col gap-5 w-full" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="font-semibold text-2xl">Change Password</div>
                    <div class="mt-5">
                        <label for="old_password" class="block text-sm font-medium leading-6 text-gray-900">Old Password</label>
                        <div id="old_div" class="relative mt-2 flex items-center w-full h-fit">
                            <input type="password" class="block w-full rounded border-0 py-1.5 px-3 text-primary shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-yellow-500 sm:text-sm sm:leading-6" id="old_password" name="old_password" placeholder="Old Password">
                            <div class="absolute" style="right: 10px;" onclick="pass3()">
                                <i id="eye-icon-old" class="fa fa-eye-slash"></i>
                            </div>
                        </div>
                    </div>
                    <div class="mt-5">
                        <label for="password" class="block text-sm font-medium leading-6 text-gray-900">New Password</label>
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
                    <input type="hidden" name="id" value = "{{$user->id}}"/>

                    @if ($errors->any())
                        <div class="">
                            {{$errors->first()}}
                        </div>
                    @endif
                    <button type="submit" class="flex w-full justify-center rounded-md bg-secondary px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:scale-105 hover:shadow-md transition-all duration-200 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-600">Save</button>
                </form>
            </div>
        </div>
        @if (Auth::user()->role == 'seller')
        <div class="flex flex-col items-center justify-center p-6 w-3/4 h-auto">
            <div class=" bg-white rounded shadow w-3/4 h-auto py-12 px-6">
            <form action="/updatecatering" class="flex flex-col gap-5 w-full" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value = "{{$user->catering->id}}"/>
                <div class="font-semibold text-2xl">Catering Detail</div>
                <div class="mt-5">
                    <label for="catering_name" class="block text-sm font-medium leading-6 text-gray-900">Catering Name</label>
                    <input type="text" class="block w-full rounded border-0 py-1.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-yellow-500 sm:text-sm sm:leading-6" id="catering_name" name="catering_name" placeholder="" value="{{$user->catering->name}}">
                </div>

                <div class="mt-5">
                    <div class="mt-2">
                        <label for="description" class="block text-sm font-medium leading-6 text-gray-900">Description</label>
                        <textarea class="block w-full rounded border-0 py-1.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-yellow-500 sm:text-sm sm:leading-6" name="description" id="description" cols="30" rows="5" value="{{$user->catering->description}}"></textarea>
                    </div>
                </div>

                <div class="mt-5">
                    <div class="mt-2">
                        <label for="address" class="block text-sm font-medium leading-6 text-gray-900">Address</label>
                        <textarea class="block w-full rounded border-0 py-1.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-yellow-500 sm:text-sm sm:leading-6" name="address" id="address" cols="30" rows="5" value="{{$user->catering->address}}"></textarea>
                    </div>
                </div>


                <div class="mt-5">
                    <div class="mt-2">
                        <label for="working_hour" class="block text-sm font-medium leading-6 text-gray-900">Working Hour</label>
                        <div class="flex flex-row items-center justify-center w-full">
                            <input class="block rounded w-3/4 border-0 py-1.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-yellow-500 sm:text-sm sm:leading-6" type="time" name="opening_hour" id="opening_hour" value="{{$user->catering->opening_hour}}">
                            <label class="px-3">-</label>
                            <input class="block rounded w-3/4 border-0 py-1.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-yellow-500 sm:text-sm sm:leading-6" type="time" name="closing_hour" id="closing_hour" value="{{$user->catering->closing_hour}}">
                        </div>
                    </div>
                </div>

                <link rel="stylesheet" href="https://unpkg.com/flowbite@1.4.4/dist/flowbite.min.css" />


                <div class="mt-5">
                    <div class="mt-2">
                        <label for="halal_certification" class="block text-sm font-medium leading-6 text-gray-900">Halal Certification</label>
                        <div class="mt-2">
                            {{-- <img class="" src="{{Storage::url("assets/profile/".$user->image)}}" style="width:30px;height:30px;"/> --}}
                            <label
                                class="flex justify-center w-full h-40 px-4 transition bg-white border-2 border-gray-300 border-dashed rounded appearance-none cursor-pointer hover:border-gray-400 focus:outline-none">
                                <span class="flex items-center space-x-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-600" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                    </svg>
                                    <span class="font-medium text-gray-600">
                                        Drop files to Attach, or
                                        <span class="text-blue-600 underline">browse</span>
                                    </span>
                                </span>
                                <input type="file" id="halal_certification" name="halal_certification" class="hidden">
                            </label>
                            {{-- <input type="file" class="" id="halal_certification" name="halal_certification" style="width: 20vw; border: 0px solid rgba(128, 128, 128, 0.418);}"> --}}
                        </div>
                    </div>
                </div>

                <div class="mt-5">
                    <div class="mt-2">
                        <label for="business_permit" class="block text-sm font-medium leading-6 text-gray-900">Business Permit</label>
                        <div class="mt-2">
                            {{-- <img class="" src="{{Storage::url("assets/profile/".$user->image)}}" style="width:30px;height:30px;"/> --}}
                            <label
                                class="flex justify-center w-full h-40 px-4 transition bg-white border-2 border-gray-300 border-dashed rounded appearance-none cursor-pointer hover:border-gray-400 focus:outline-none">
                                <span class="flex items-center space-x-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-600" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                    </svg>
                                    <span class="font-medium text-gray-600">
                                        Drop files to Attach, or
                                        <span class="text-blue-600 underline">browse</span>
                                    </span>
                                </span>
                                <input type="file" id="business_permit" name="business_permit" class="hidden">
                            </label>
                            {{-- <input type="file" class="" id="business_permit" name="business_permit" style="width: 20vw; border: 0px solid rgba(128, 128, 128, 0.418);}"> --}}
                        </div>
                    </div>
                </div>

                @if ($errors->any())
                    <div class="">
                        {{$errors->first()}}
                    </div>
                @endif

                <div class="mt-10 flex justify-center w-full">
                    <div class="flex w-full justify-center rounded bg-secondary px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:scale-105 hover:shadow-md transition-all duration-200 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-600">
                        <button type="submit" >Next</button>
                    </div>
                </div>
            </form>
            </div>
            @endif
            </div>
        </div>

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
        var c;
        function pass3(){
            if(c==1){
                document.getElementById('old_password').type='password';
                document.getElementById('eye-icon-old').classList.remove('fa-eye');
                document.getElementById('eye-icon-old').classList.add('fa-eye-slash');
                c=0;
            }else{
                document.getElementById('old_password').type='text';
                document.getElementById('eye-icon-old').classList.remove('fa-eye-slash');
                document.getElementById('eye-icon-old').classList.add('fa-eye');
                c=1;
            }
        }
    </script>
@endsection


