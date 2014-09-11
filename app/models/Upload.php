<?php

use Analytics\Transformer\TransformerInterface;
use Analytics\Transformer\TransformerTrait;

class Upload extends Eloquent implements TransformerInterface {

	use TransformerTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'uploads';

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
        protected $fillable = array('user_id', 'filename', 'filesize');
        
        /**
         * User validation rules
         *
         * @var type 
         */
        public static $rules = array(
            'userid' => 'required|integer',
            'filename' => 'required|alpha|max:250',
            'filesize' => 'required|numeric'
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
                'userid' => $data['user_id'],
                'filename' => $data['filename'],
                'filesize' => $data['filesize'],
                'synced' => $data['synced'],
                'created' => $data['created_at'],
                'updated' => $data['updated_at']
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
