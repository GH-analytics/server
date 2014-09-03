<?php

use Analytics\Repository\UserRepository;

class UserController extends \BaseController {
    
    public function __construct(UserRepository $user) {
        $this->user = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return $this->user->all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $valid = $this->user->validate(Input::all(), $this->user->getRules());
        
        if(is_null($valid)) {
            $created = $this->user->create(Input::all());
            
            if(is_null($created)) {
                
            } else {
                return "this bad.";
            }
        } else {
            return $valid;
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
            //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
            //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
            //
    }

}
