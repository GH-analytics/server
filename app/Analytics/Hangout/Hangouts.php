<?php namespace Analytics\Hangout;

use Jmem;
use Conversation;
use Participant;
use Message;
use Illuminate\Support\Facades\DB;
use Whoops\Example\Exception;

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
            
            $holder[$exits->gaia_id] = $exits;
        }
        
        return $holder;
    }
    
    private function messages($json, $id, $participants) {
        // Get the array of messages.
        $messages = $json['conversation_state']['event'];

            foreach($messages as $message) {
                // Ignote attachments for now. Can't get much useful info from them anyway.
                if(isset($message['chat_message']) && isset($message['chat_message']['message_content']['segment'])){
                    foreach($message['chat_message']['message_content']['segment'] as $part) {
                        // Skip if all that we are looping over is a line break
                        if(!isset($participants[$message['sender_id']['gaia_id']])){
                            // Runs in the case someone was in the chat but now has left...
                            $participant = Participant::where('gaia_id', '=', $message['sender_id']['gaia_id'])->first();
                            if(!is_object($participant)) {
                                $participant = Participant::create(array(
                                    'identifier' => '',
                                    'gaia_id' => $message['sender_id']['gaia_id']
                                ));
                            }
                            $id->participants()->save($participant);
                            $participants[$participant->gaia_id] = $participant;
                        }

                        if(isset($part['text'])){
                            $created = Message::create(array(
                                'conversation_id' => $id->id,
                                'participant_id' => $participants[$message['sender_id']['gaia_id']]->id,
                                'type' => $part['type'],
                                'message' => $part['text'],
                                'timestamp' => $message['timestamp']
                            ));
                        }
                    }
                }
            }
    }
    
}

