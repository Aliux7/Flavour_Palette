<?php

namespace App\Http\Controllers;

use App\Models\Catering;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\File;
use Ramsey\Uuid\Uuid;

class UserController extends Controller
{

    public function login(){
        return view('ViewPage.login_page');
    }

    public function registerCustomer(){
        return view('ViewPage.register_customer');
    }

    public function loginAuth(Request $request){
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        //remember me
        $remember = $request->remember;

        if(Auth::attempt($credentials, true)){
            //bikin remember me
            if($remember){
                Cookie::queue('emailcookie', $request->email, 7);
                Session::put('loginsession', $credentials);
            }else{
                Cookie::queue('emailcookie', null);
                Session::put('loginsession', null);
            }
            return redirect('/');
        }
        return redirect()->back()->withInput()->withErrors(['login' => 'Invalid credentials']);
    }

    public function registerAuthCustomer(Request $request){

        if($request->switch == "customer"){
            $user = new User();
            $validation = [
                'profile_picture' => 'required|mimetypes:image/jpeg,image/jpg,image/png',
                'email' => 'required|email|unique:users',
                'phone_number' => 'required',
                'username' => 'required',
                'fullname' => 'required',
                'password' => 'required|min:8|confirmed',
                'password_confirmation' => 'required',
                'gender'=> 'required|in:male,female',
                'dob' => 'required|before:-13 years'
            ];

            $validator = Validator::make($request->all(), $validation);
            if($validator->fails()){
                return back()->withErrors($validator);
            }

            $user->id = Uuid::uuid4();
            $user->email = $request->email;
            $user->phone_number = $request->phone_number;
            $user->username = $request->username;
            $user->fullname = $request->fullname;
            $user->password = bcrypt($request->password);
            $user->gender = $request->gender;
            $user->role = $request->role;
            $user->dob = $request->dob;
            if($request->profile_picture != null){
                $file = $request->file('profile_picture');
                $imageName = time().'.'.$file->getClientOriginalExtension();
                Storage::putFileAs('public/profile/user', $file, $imageName);

                $user->profile_picture = $imageName;
            }
            $user->save();

            return view('ViewPage.login_page');
        }else{
            $validation = [
                'profile_picture' => 'required|mimetypes:image/jpeg,image/jpg,image/png',
                'email' => 'required|email|unique:users',
                'phone_number' => 'required',
                'username' => 'required',
                'fullname' => 'required',
                'password' => 'required|min:8|confirmed',
                'password_confirmation' => 'required',
                'gender'=> 'required|in:male,female',
                'dob' => 'required|before:-13 years'
            ];


            $validator = Validator::make($request->all(), $validation);
            if($validator->fails()){
                return back()->withErrors($validator);
            }
            $imageName = null;
            if($request->profile_picture != null){
                $file = $request->file('profile_picture');
                $imageName = time().'.'.$file->getClientOriginalExtension();
                Storage::putFileAs('public/profile/user/', $file, $imageName);
            }

            $request->flash();
            $seller = $request;

            return view('ViewPage.register_catering', compact('seller','imageName'));
        }

    }

    public function registerAuthCatering(Request $request){
        $validation = [
            'catering_name' => 'required',
            'description' => 'required',
            'address' => 'required',
            'opening_hour' => 'required',
            'closing_hour' => 'required',
            'halal_certification' => 'required|mimetypes:application/pdf,image/jpeg,image/jpg,image/png',
            'business_permit' => 'required|mimetypes:application/pdf,image/jpeg,image/jpg,image/png'
        ];

        $validator = Validator::make($request->all(), $validation);
        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $user = new User();
        $catering = new Catering();
        $user->id = $catering->seller_id = Uuid::uuid4()->toString();
        $user->profile_picture = $request->profile_picture;
        $user->email = $request->old('email');
        $user->phone_number = $request->old('phone_number');
        $user->username = $request->old('username');
        $user->fullname = $request->old('fullname');
        $user->password = bcrypt($request->old('password'));
        $user->gender = $request->old('gender');
        $user->role = $request->old('role');
        $user->dob = $request->old('dob');
        $user->save();

        $catering->id = Uuid::uuid4()->toString();
        $catering->name = $request->catering_name;
        $catering->description = $request->description;
        $catering->halal_certification = $request->halal_certification;
        $catering->business_permit = $request->business_permit;
        $catering->address = $request->address;
        $catering->opening_hour = $request->opening_hour;
        $catering->closing_hour = $request->closing_hour;
        if($request->halal_certification != null){
            $file = $request->file('halal_certification');
            $imageName = time().'.'.$file->getClientOriginalExtension();
            Storage::putFileAs('public/halal_certification/', $file, $imageName);

            $catering->halal_certification = $imageName;
        }
        if($request->business_permit != null){
            $file = $request->file('business_permit');
            $imageName = time().'.'.$file->getClientOriginalExtension();
            Storage::putFileAs('public/business_permit/', $file, $imageName);

            $catering->business_permit = $imageName;
        }
        $catering->save();

        return view('ViewPage.login_page');
    }

    public function profile(){
        $user = Auth::user();
        return view('ViewPage.update_profile', compact('user'));
    }

    public function updateprofile(Request $request){
        $user = User::find($request->id);
        $validation = [
            'profile_picture' => 'mimetypes:image/jpeg,image/jpg,image/png',
            'email' => 'required|email|unique:users',
            'username' => 'required',
            'fullname' => 'required',
            'phone_number' => 'required',
            'gender'=> 'required|in:male,female'
        ];
        $validator = Validator::make($request->all(), $validation);
        if($validator->fails()){
            return back()->withErrors($validator);
        }
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;
        $user->username = $request->username;
        $user->fullname = $request->fullname;
        $user->gender = $request->gender;
        if($request->profile_picture != null){
            $file = $request->file('profile_picture');
            $imageName = time().'.'.$file->getClientOriginalExtension();
            Storage::putFileAs('public/profile/user', $file, $imageName);

            $user->profile_picture = $imageName;
        }
        $user->save();

        return redirect()->back();
    }

    public function updatepassword(Request $request){
        $user = User::find($request->id);
        if(Hash::check($request->old_password, $user->password)){
            $validation = [
                'password' => 'required',
                'confirm_password' => 'required|same:password',
            ];
            $validator = Validator::make($request->all(), $validation);
            if($validator->fails()){
                return back()->withErrors($validator);
            }
            $user->password = Hash::make($request->confirm_password);
            $user->save();
            return redirect('/');
        }else{
            return back()->withErrors("The old password is incorrect");
        }
    }

    public function updatecatering(Request $request){
        $catering = Catering::find($request->id);
        $validation = [
            'catering_name' => 'required',
            'description' => 'required',
            'address' => 'required',
            'opening_hour' => 'required',
            'closing_hour' => 'required',
            'halal_certification' => 'mimetypes:application/pdf,image/jpeg,image/jpg,image/png',
            'business_permit' => 'mimetypes:application/pdf,image/jpeg,image/jpg,image/png'
        ];

        $validator = Validator::make($request->all(), $validation);
        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $catering->name = $request->catering_name;
        $catering->description = $request->description;
        $catering->address = $request->address;
        $catering->opening_hour = $request->opening_hour;
        $catering->closing_hour = $request->closing_hour;
        if($request->halal_certification != null){
            $catering->halal_certification = $request->halal_certification;
            $file = $request->file('halal_certification');
            $imageName = time().'.'.$file->getClientOriginalExtension();
            Storage::putFileAs('public/halal_certification/', $file, $imageName);

            $catering->halal_certification = $imageName;
        }
        if($request->business_permit != null){
            $catering->business_permit = $request->business_permit;
            $file = $request->file('business_permit');
            $imageName = time().'.'.$file->getClientOriginalExtension();
            Storage::putFileAs('public/business_permit/', $file, $imageName);

            $catering->business_permit = $imageName;
        }
        $catering->save();

        return redirect('/');
    }

    public function logout(){
        Auth::logout();
        Session::forget('loginsession');
        return redirect()->back();
    }

}
