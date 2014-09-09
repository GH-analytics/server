<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

use Analytics\Transformer\TransformerInterface;
use Analytics\Transformer\TransformerTrait;

class User extends Eloquent implements UserInterface, RemindableInterface, TransformerInterface {

	use UserTrait, RemindableTrait, TransformerTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');
        
        /**
         * Values that are allowed to be mass assigned.
         *
         * @var array
         */
        protected $fillable = array('firstname', 'lastname', 'email', 'password');
        
        /**
         * User validation rules
         *
         * @var type 
         */
        public static $rules = array(
            'first' => 'required|alpha|max:20',
            'last' => 'required|alpha|max:20',
            'email' => 'required|email|max:100',
            'password' => 'min:8'
        );
    
        /**
         * Used to seperate the database from the API.
         * 
         * @param array $data
         * @return type
         */
        public function transform(array $data) {
            return array(
                'first' => $data['firstname'],
                'last' => $data['lastname'],
                'email' => $data['email'],
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
