<?php namespace Analytics\Transformer;

/**
 * Avoid redundent implimentations of transformCollection
 * method. use Trait in all classes implimenting transformer interface.
 */
trait TransformerTrait {
    
    public function transformCollection (array $data) {
        return array_map( array($this, 'transform'), $data);
    }
}