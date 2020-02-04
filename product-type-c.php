<?php

class Mapiful_Product_Type_C extends Mapiful_Product_Type_Base {

    function __construct($entrypoint = false){
        parent::__construct('product_type_c', $entrypoint);
    }

    public function determine_product_type($type, $entrypoint){
        if($entrypoint['category'] == 'console') $type = $this->typeIdentifier;
        return $type;
    }

    public function get_name(){
        return "PS4";
    }

    public function get_brand(){
        return "Sony";
    }
}
