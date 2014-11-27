<?php

class UserController extends BaseController {
    public function viewlogin(){
        return View::make('login');

    }

    public function viewregister(){
        return View::make('register');
    }

    public function login(){
        // get POST data
        $userdata = array(
            'email' => Input::get('email'),
            'password' => Input::get('password')
        );

        if(Auth::attempt($userdata))
        {
            return Redirect::to('/');
        }
        else
        {
            return Redirect::to('/login')->with('loginError','Invalid email or password');
        }
    }
    public function logout(){
        if(Auth::check()){
            Auth::logout();
        }
        return Redirect::to('login');
    }
    public function register(){
        // get POST data
        $userdata = array(
            'email' => Input::get('email'),
            'first_name' => Input::get('firstname'),
            'last_name' => Input::get('lastname'),
            'password' => Input::get('password'),
            'password_confirmation' => Input::get('password_confirmation')
        );
        //validate the registration details
        $validator = Validator::make($userdata, User::$rules);

        if ($validator->passes()) {
            // validation has passed, save user in DB
            $user = new User;
            $user->first_name = $userdata['first_name'];
            $user->last_name = $userdata['last_name'];
            $user->email = $userdata['email'];
            $user->password = Hash::make($userdata['password']);
            $user->save();
            Auth::attempt($userdata);
            return Redirect::to('test')->with('message', 'Thanks for registering!');
        } else {
            // validation has failed, display error messages
            return Redirect::to('login#register')->with('registerError', true)->withErrors($validator)->withInput();
        }

    }

}