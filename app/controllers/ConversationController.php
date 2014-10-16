<?php

class ConversationController extends ApiController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return $this->respond(Conversation::_(Conversation::all()->toArray()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        // TODO: Currently you are not allowed to add new ones.
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $conv = Conversation::find($id);
        
        if(is_object($conv)) {
            return $this->respond(Conversation::__($conv->toArray()));
        }
        
        return $this->respondNotFound("Conversation $id does not exist");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        // TODO: Currently you are not allowed to update an existing row.
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        // TODO: You are not allowed to delete an item currently.
    }

}
