<?php


use Illuminate\Support\Facades\Response;

class ApiController extends \BaseController {
    
    protected $statusCode = 200;
    
    public function getStatusCode() {
        return $this->statusCode;
    }
    
    /**
     * Set status code for object and return
     * object for chaining.
     * 
     * @param type $statusCode
     * @return \ApiController
     */
    public function setStatusCode($statusCode) {
        $this->statusCode = $statusCode;
        
        return $this;
    }
    
    /**
     * Base function for Responder class;
     * 
     * @param type $data
     * @return type
     */
    public function respond($data) {
        return Response::json($data, $this->getStatusCode());
    }
    
    /**
     * Response to be used when returning an error
     * to the user for evaluation.
     * 
     * @param type $message
     * @return type
     */
    public function respondWithError($message) {
        return $this->respond(array(
            "message" => $message,
            "error" => $this->getStatusCode()
        ));
    }
       
    public function respondNotFound($message = "Not Found") {
        return $this->setStatusCode(404)->respondWithError($message);
    }
}


