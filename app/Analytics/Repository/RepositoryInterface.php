<?php namespace Analytics\Repository;

/**
 * The Repository interface sits on top of every Model 
 * to ensure all data is accessed and all special cases
 * are met. In cases where no special cases are needed.
 * You Should include the RepositoryTrait so you DRY.
 */

interface RepositoryInterface {

    public function all();

    public function get($id);

    public function validate($data, $validation);

    public function create($data);

    public function update($data, $id);

    public function exists($id);

    public function remove($id);

    public function getRules();

}