<?php

use Analytics\Transformer\TransformerInterface;
use Analytics\Transformer\TransformerTrait;

class Message extends Eloquent implements TransformerInterface {

	use TransformerTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'messages';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array( );
        
        /**
         * Values that are allowed to be mass assigned.
         *
         * @var array
         */
        protected $fillable = array('participant_id', 'conversation_id', 'type', 'message', 'timestamp');
        
        /**
         * Do not try to insert timestamps into this table
         *
         * @var type 
         */
        public $timestamps = false;


        /**
         * User validation rules
         *
         * @var type 
         */
        public static $rules = array(
            'conversationid' => 'required',
            'participantid' => 'required',
            'type' => 'required',
            'message' => 'required',
            'timestamp' => 'required'
        );
    
        /**
         * Used to seperate the database from the API.
         * 
         * @param array $data
         * @return type
         */
        public function transform(array $data) {
            return array(
                'id' => $data['id'],
                'conversationid' => $data['conversation_id'],
                'participantid' => $data['participant_id'],
                'type' => $data['type'],
                'message' => $data['message'],
                'timestamp' => $data['timestamp']
            );
        }
        
        /**
         * Ensure the data being passed in is valid.
         * 
         * @param type $data
         */
        public static function isValid($data) {
            
            $validation = Validator::make($data, static::$rules);
            
            if( $validation->passes() ) {
                return true;
            } else {
                return $validation->messages();
            }
            
        }
        
        public function participant() {
            return $this->hasOne('Participant');
        }

        public function conversation() {
            return $this->hasOne('Conversation');
        }

}
