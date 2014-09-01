<?php namespace Analytics\Transformer;

/**
 * Ensure all transformers have a transform method.
 * Implimenting this method helps make sure future database
 * changes to not change anything with the way the API 
 * would need to be accessed.
 */
interface TransformerInterface {
    
    public function transform(array $data);
    
}