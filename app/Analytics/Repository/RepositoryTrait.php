<?php namespace Analytics\Repository;

use Illuminate\Support\Facades\Validator;

trait RepositoryTrait {
    
    /**
     * Return true if validation is able to run successfully.
     * If we are unable to complete validation return array of
     * errors that are found to the user.
     * 
     * @param type $data
     * @param type $validation
     * @return boolean
     */
    function validate($data, $validation) {
        $validator = Validator::make(
            $data,
            $validation
        );
        
        if($validator->fails()) {
            return $validator->messages();
        }
    }
    
    /**
     * Return array of the rules that should be matched for
     * this model before saving into the database.
     * 
     * @return type
     */
    public function getRules() {
        return $this->rules;
    }
    
}

