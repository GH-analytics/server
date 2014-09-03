<?php namespace Analytics\Repository;

use Analytics\Repository\RepositoryInterface;
use Analytics\Repository\RepositoryTrait;
use Analytics\Transformer\UserTransformer;

use Illuminate\Support\Facades\Hash;
use User;

class UserRepository implements RepositoryInterface {
    
    use RepositoryTrait;
    
    private $rules = array(
        'first' => 'required|alpha|max:20',
        'last' => 'required|alpha|max:20',
        'email' => 'required|email|max:100'
    );
    
    public function all() {
        return UserTransformer::_(User::all()->toArray());
    }

    /**
     * Return false in cases where an exception may have been thrown.
     * Likely only when a user tries to sign up twice with the same
     * email.
     * 
     * @param type $data
     * @return boolean
     */
    public function create($data) {
        try {
            User::create(array(
                'firstname' => $data['first'],
                'lastname' => $data['last'],
                'email' => $data['email'],
                'password' => Hash::make($data['password'])
            ));
        } catch(\Exception $e) {
            return false;
        }
    }

    public function exists($id) {
        return is_object(User::find($id));
    }

    public function get($id) {
        return UserTransformer::_(User::find($id));
    }

    /**
     * Make sure we are able to remove the requested id
     * if no error is thrown return true.
     * 
     * @param type $id
     * @return boolean
     */
    public function remove($id) {
        try{
            User::destory($id);
            return true;
        }catch(Exception $e){
            return false;
        }
    }

    public function update($data, $id) {
        
    }

}