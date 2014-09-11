<?php

/**
 * This route should only be accessed in the case
 * where the user has already logged into the system
 * and has a session id set.
 */
class UploadController extends ApiController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
            $uploads = Upload::where('user_id', '=', Session::get('id'))->get();
            
            return $this->respond(Upload::_($uploads->toArray()));
	}

	/**
	 * Store a newly created resource in storage.
         * This should be used only to upload files.
	 *
	 * @return Response
	 */
	public function store()
	{
            
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
