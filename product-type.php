<?php

interface Product_Type_Interface {
    public function register();
    public function get();
    public function get_type();
    public function get_price();
    public function get_name();
    public function get_brand();
    public function get_slug();
}

class Mapiful_Product_Type_Base implements Product_Type_Interface {
    protected $typeIdentifier;
    protected $entrypoint;

    function __construct($typeIdentifier, $entrypoint = false){
        $this->typeIdentifier = $typeIdentifier;
        $this->entrypoint = $entrypoint;
    }

    public function register($priority = 100){
        add_filter('product_type_get_types', [$this, 'add_product_type'], $priority, 1);
        add_filter('product_type_get_type',  [$this, 'determine_product_type'], $priority, 3);
    }

    public function add_product_type($types){
        $types[$this->typeIdentifier] = get_class($this);
        return $types;
    }

    public function determine_product_type($type, $entrypoint){
        return $type;
    }

    public function get(){
        return $this;
    }

    public function get_type(){
        return $this->typeIdentifier;
    }

    public function get_price($discount = 0){
        return $this->entrypoint['price'] - $discount;
    }

    public function get_name(){
        return $this->entrypoint['name'];
    }

    public function get_brand(){
        return $this->entrypoint['brand'];
    }

    public function get_slug(...$args){
        $string = implode('-', $args); 
        return strtolower(preg_replace('~[^\pL\d]+~u', '-', $string));
    }
}
