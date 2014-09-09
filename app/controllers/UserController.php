<?php

class UserController extends ApiController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return $this->respond(User::_(User::all()->toArray()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $valid = User::isValid(Input::all());
        
        if($valid === true) {
            // Ensure that password is set
            if(Input::get('password') == null) {
                return $this->respondConflict("password must be set");
            }
            
            // Check for if user has already been created
            try {
                User::create(array(
                    "firstname" => Input::get("first"),
                    "lastname" => Input::get("last"),
                    "email" => Input::get("email"),
                    "password" => Hash::make(Input::get("password"))
                ));
            } catch (Exception $e) {
                return $this->respondConflict("User already exists");
            }
            
            return $this->respond(array("message" => "User Created"));
             
        } else {
            return $this->respondConflict($valid);
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $user = User::find($id);
        
        if(is_object($user)) {
            return $this->respond(User::__($user->toArray()));
        }
        
        return $this->respondNotFound("User $id does not exist");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $user = User::find($id);
        
        if(is_object($user)) {
            $valid = User::isValid(Input::all());
        
            if($valid === true) {
                try {
                    $user->firstname = array_key_exists("first", Input::all()) ? Input::get("first") : $user->firstname;
                    $user->lastname = array_key_exists("last", Input::all()) ? Input::get("last") : $user->lastname;
                    $user->email = array_key_exists("email", Input::all()) ? Input::get("email") : $user->email;
                    $user->password = array_key_exists("password", Input::all()) ? Hash::make(Input::get("password")) : $user->password;
                    $user->save();
                } catch (Exception $e) {
                    // Should only fire when email is already in system.
                    return $this->respondConflict("User already exits");
                }
            } else {
                return $this->respondConflict($valid);
            }
        } else {
            return $this->respondNotFound("User $id does not exist");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        
        if(is_object($user)) {
            try{
                User::destroy($id);
            } catch(Exception $e) {
                return $this->respondConflict("User constraint violation on delete");
            }
            
            return $this->respond(array("message" => "User was deleted"));
        } else {
            return $this->respondNotFound("User $id does not exist");
        }
    }

}
