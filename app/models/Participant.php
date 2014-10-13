<?php

use Analytics\Transformer\TransformerInterface;
use Analytics\Transformer\TransformerTrait;

class Participant extends Eloquent implements TransformerInterface {

	use TransformerTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'participants';

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
        protected $fillable = array('identifier', 'gaia_id');
        
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
            'identifier' => '',
            'gaiaid' => 'required'
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
                'identifier' => $data['identifier'],
                'gaiaid' => $data['gaia_id']
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
