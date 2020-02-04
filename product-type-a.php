<?php

class Mapiful_Product_Type_A extends Mapiful_Product_Type_Base {

    function __construct($entrypoint = false){
        parent::__construct('product_type_a', $entrypoint, $priority);
    }

}
