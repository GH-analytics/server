<?php namespace Analytics\Transformer;

/**
 * Avoid redundent implimentations of transformCollection
 * method. use Trait in all classes implimenting transformer interface.
 */
trait TransformerTrait {
    
    public function transformCollection (array $data) {
        return array_map( array($this, 'transform'), $data);
    }
    
    /**
     * Static helper method for easy transforming of
     * all objects using the TransformerTrait.
     * 
     * @param array $data
     * @return type
     */
    public static function transformer(array $data) {
        $class = __CLASS__;
        $transformerClass = new $class;
        return $transformerClass->transformCollection($data);
    }
}