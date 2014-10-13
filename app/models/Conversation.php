<?php

use Analytics\Transformer\TransformerInterface;
use Analytics\Transformer\TransformerTrait;

class Conversation extends Eloquent implements TransformerInterface {

	use TransformerTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'conversations';

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
        protected $fillable = array('conversation_id');
        
        /**
         * User validation rules
         *
         * @var type 
         */
        public static $rules = array(
            'conversation_id' => 'required',
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
                'conversationid' => $data['conversation_id']
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

}
