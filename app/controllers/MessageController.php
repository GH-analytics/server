<?php

class MessageController extends ApiController {

    /**
     * Display a listing of the resource.
     * Only bring back 50 at a time so we don't
     * kill the server.
     *
     * @return Response
     */
    public function index()
    {
        return $this->respond(Message::_(Message::paginate(50)->toArray()['data']));
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
        $message = Message::find($id);
        
        if(is_object($message)) {
            return $this->respond(Message::__($message->toArray()));
        }
        
        return $this->respondNotFound("Message $id does not exist");
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

    /**
     * Get the messages passed on the passed in conversation id
     *
     * @param $id
     */
    public function messageByConversation($id) {
        return $this->respond(Message::_(Message::where('conversation_id', '=', $id)->paginate(50)->toArray()['data']));
    }

}
