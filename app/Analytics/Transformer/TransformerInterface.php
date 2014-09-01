<?php namespace Analytics\Transformer;

/**
 * Ensure all transformers have a transform method.
 */
interface TransformerInterface {
    
    public function transform(array $data);
    
}