<?php namespace Analytics\Hangout;

use Jmem;


class Hangouts {
    
    public function __construct($file) {
        
        $this->start($file);
        
    }
    
    /**
     * Start breaking up the data we have been given.
     */
    private function start($file){
        
        $gen = new Jmem\JsonLoader($file, "conversation_state");

        foreach($gen->parse()->start() as $obj) {

            $json = json_decode($obj->stream, true);
            
            $this->conversation($json);

        }
        
    }
    
    /**
     * Place conversation in database.
     * 
     * @param type $json
     */
    private function conversation($json) {
        
        var_dump($json['conversation_id']['id']);die;
        
    }
    
    /**
     * Place all participants in the database.
     * 
     * @param type $json
     */
    private function participants($json) {
        
    }
    
}

