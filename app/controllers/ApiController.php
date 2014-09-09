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
    
    /**
     * 404 Error Code
     * 
     * @param type $message
     * @return type
     */
    public function respondNotFound($message = "Not Found") {
        return $this->setStatusCode(404)->respondWithError($message);
    }

    /**
     * 401 Error Code
     * 
     * @param type $message
     * @return type
     */
    public function respondUnauthorized($message = "You do not have access") {
        return $this->setStatusCode(401)->respondWithError($message);
    }
    
    /**
     * 409 Error Code
     * 
     * @param type $message
     * @return type
     */
    public function respondConflict($message = "Please pass in valid JSON") {
        return $this->setStatusCode(409)->respondWithError($message);
    }
}


