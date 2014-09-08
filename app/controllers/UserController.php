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
        $valid = User::isValid();
        
        if($valid === true) {
            $created = $this->user->create(Input::all());
            
            if(is_null($created)) {
                return $this->respond(array("message" => "User Created"));
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
