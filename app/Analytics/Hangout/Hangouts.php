<?php namespace Analytics\Hangout;

use Jmem;
use Conversation;
use Participant;


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
            // Get JSON object belonging to this conversation
            $json = json_decode($obj->stream, true);
            // Place the conversation in the database
            $id = $this->conversation($json);
            // Tie all participants to conversation
            $participants = $this->participants($json, $id);
            // Tie all messaged to participants and convo id's
            $this->messages($json, $id, $participants);
        }
        
    }
    
    /**
     * Place conversation in database. Return the id so
     * the participants can be properly tied together.
     * 
     * @param array $json
     * @return int
     */
    private function conversation($json) {
        
        $test = Conversation::create(array(
            'conversation_id' => $json['conversation_id']['id']
        ));
        
        return $test;
    }
    
    /**
     * Place all participants in the database.
     * Relate them to the proper conversation.
     * Check to never add the same person twice.
     * 
     * @param array $json
     * @param int $id
     */
    private function participants($json, $id) {
        
        $participants = $json['conversation_state']['conversation']['participant_data'];
        // Hold all participants and id's in memory for when inserting chat history to db.
        $holder = array();
        
        foreach($participants as $participant) {
            
            $exits = Participant::where('gaia_id', '=', $participant['id']['gaia_id'])->first();
            
            if(!is_object($exits)){
                $exits = Participant::create(array(
                    'identifier' => $participant['fallback_name'],
                    'gaia_id' => $participant['id']['gaia_id']
                ));
            }
            
            // Could be optimized to save all relations as once.
            // Shouldn't be an issue though for now.
            $id->participants()->save($exits);
            
            $holder[] = array(
                'id' => $exits->id,
                'gaia_id' => $exits->gaia_id
            );
            
        }
        
        return $holder;
    }
    
    private function messages($json, $id, $participants) {
        // TODO: Impliment this.
    }
    
}

