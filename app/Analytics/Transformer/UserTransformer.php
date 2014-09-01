<?php namespace Analytics\Transformer;

use Analytics\Transformer\TransformerInterface;
use Analytics\Transformer\TransformerTrait;

class UserTransformer implements TransformerInterface {
    use TransformerTrait;
    
    public function transform(array $data) {
        return array(
            'first' => $data['firstname'],
            'last' => $data['lastname'],
            'email' => $data['email'],
            'created' => $data['created_at'],
            'updated' => $data['updated_at']
        );
    }
}

