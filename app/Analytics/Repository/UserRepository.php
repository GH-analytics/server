<?php namespace Analytics\Repository;

use Analytics\Repository\RepositoryInterface;
use Analytics\Repository\RepositoryTrait;
use Analytics\Transformer\UserTransformer;

use User;

class UserRepository implements RepositoryInterface {
    
    use RepositoryTrait;
    
    private $rules = array(
        
    );
    
    public function all() {
        $t = new UserTransformer;
        return $t->transformCollection(User::all()->toArray());
    }
    
    public function getRules() {
        return $this->rules;
    }
    
}