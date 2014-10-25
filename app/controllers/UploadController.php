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
            // Make sure we are getting the proper file.
            if (Input::file('file')->isValid()){
                $extension = Input::file('file')->getClientOriginalExtension();
                $path = Input::file('file')->getRealPath();
                $size = Input::file('file')->getSize();
                

                if($extension == "json"){
                    
                    Input::file('file')->move(
                        storage_path() . "/uploads",
                        $file = hash_file('sha256', $path) . ".json"
                    );
                    
                    $upload = Upload::create(array(
                        "user_id" => Session::get('id'),
                        "filename" => $file,
                        "filesize" => $size,
                        "synced" => 0
                    ));
                    
                    return $this->respond(Upload::__($upload->toArray()));
                }
            }
            
            return $this->respondConflict("File is not valid");
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
            // Display specific upload.
            $uploads = Upload::whereRaw('user_id = ' . Session::get('id') . 'and id = ' . $id)->first();
            
            return $this->respond($uploads);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        // No need to update file ...
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
            $upload = Upload::find($id);
        
            if(is_object($upload)) {

                try{
                    Upload::destroy($id);
                } catch(Exception $e) {
                    return $this->respondConflict("Upload constraint violation on delete");
                }

                return $this->respond(array("message" => "Upload was deleted"));
            } else {
                return $this->respondNotFound("Upload $id does not exist");
            }
	}


}
