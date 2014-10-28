<?php

class AuthController extends ApiController {
    
    public function check() {
        
        return $this->respond(Session::all());
        
    }
    
    public function login() {
        
        $user = User::where('email', '=', Input::get('email'))->first();
        
        // Check if this user is in the database.
        if(!is_object($user)) {
            return $this->respondNotFound("This user is not in the database.");
        }
        
        if (Auth::attempt(array(
            'email' => Input::get('email'), 
            'password' => Input::get('password')),
            true)) {
            
            Session::put('id', $user->id);
            Session::put('first', $user->firstname);
            Session::put('last', $user->lastname);
            Session::put('email', $user->email);
            
            return $this->respond(array("message" => "You have been logged in."));
        } else {
            return $this->respondUnauthorized("Your password does not match.");
        }
        
    }
    
    public function logout() {
        
        Auth::logout();
        Session::flush();
        
        return $this->respond(array("message" => "You have been logged out."));
    }

}
