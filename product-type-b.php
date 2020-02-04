<?php

class Mapiful_Product_Type_B extends Mapiful_Product_Type_Base {

    function __construct($entrypoint = false){
        parent::__construct('product_type_b', $entrypoint);
    }

    public function determine_product_type($type, $entrypoint){
        if($entrypoint['brand'] == 'apple') $type = $this->typeIdentifier;
        return $type;
    }

    public function get_brand(){
        return "Pear";
    }
}
