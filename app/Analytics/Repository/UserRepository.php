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
        return UserTransformer::transformer(User::all()->toArray());
    }
    
    public function getRules() {
        return $this->rules;
    }
    
}