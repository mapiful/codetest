<?php
/*
Plugin Name: Mapiful PHP logic / problem solving test
Plugin URI: http://www.mapiful.com/
Description: 
Author: Edvin Brobeck
Version: 1.0
Author URI: http://www.mapiful.com/
*/

// BACKGROUND:
// We have different product types that each require some custom logic to produce the output we want.
// We want to be able to standardize our way of working with the products.
// We also want to be have extendability to introduce new product types in the future.
//  ---------------------------------------------
require_once plugin_dir_path( __FILE__ ) . 'product-type.php';
require_once plugin_dir_path( __FILE__ ) . 'product-type-a.php';
require_once plugin_dir_path( __FILE__ ) . 'product-type-b.php';
require_once plugin_dir_path( __FILE__ ) . 'product-type-c.php';



//  Assignment: Recreate the "Mapiful_Product_Factory" class to produce the expected outcome (separate file).
//  Rule 1: Class Mapiful_Product_Factory() - should not have to be edited to extend with more product types.
//  Bonus points: Code Class Mapiful_Product_Factory() in a way that is agnostic to what methods that exists from the Mapiful_Product_Type Classes.
//  Bonus points: Write documention for a better developer experience (intellisense, etc)
//  ---------------------------------------------

//  Bonus Assignment: Create an additional Product Type (Mapiful_Product_Type_D) that applies a discount on items from the brand ASUS
//  ---------------------------------------------

class Mapiful_Product_Factory {
    protected $entrypoint;
    protected $type;
    protected $types;

    function __construct($entrypoint = false){
        $this->entrypoint = $entrypoint;

        // Standard product type
        $this->default_type = 'product_type_a';

        $this->get_product_types();
        $this->load_type();
    }

    public function get_product_types(){
        // Redacted
        return $this->types;
    }

    public function load_type(){
        // Redacted
        $this->type = '';
    }

    public function call(){
        // Redacted
    }
}
 

function run_awesome_code_test(){

    // Register product types, and priority
    $Product_Type_A = new Mapiful_Product_Type_A();
    $Product_Type_B = new Mapiful_Product_Type_B();
    $Product_Type_C = new Mapiful_Product_Type_C();

    $Product_Type_A->register( 100 );
    $Product_Type_B->register( 200 );
    $Product_Type_C->register( 300 );

    $catalog_items = [
        [ 
            'name'      => 'iPhone', 
            'category'  => 'mobile',
            'brand'     => 'apple',
            'price'     => 1000,
            'discount'  => 0
        ],
        [ 
            'name'      => 'ASUS Router AC68U', 
            'category'  => 'router',
            'brand'     => 'asus',
            'price'     => 40,
            'discount'  => 0
        ],
        [ 
            'name'      => 'XBOX', 
            'category'  => 'console',
            'brand'     => 'microsoft',
            'price'     => 300,
            'discount'  => 10
        ],
        [ 
            'name'      => 'QC35 headphone', 
            'category'  => 'accessories',
            'brand'     => 'bose',
            'price'     => 50,
            'discount'  => 0
        ]
    ];

    $output = [];
    foreach($catalog_items as $item){
        // Use our new shiny product factory to get desired output.
        $product_factory = new Mapiful_Product_Factory($item);
        $output[] = [
            'name'          => $product_factory->call('get_name'),
            'product_type'  => $product_factory->call('get_type'),
            'brand'         => $product_factory->call('get_brand'),
            'price'         => $product_factory->call('get_price', $item['discount']),
            'slug'          => $product_factory->call('get_slug', $item['name'], $item['brand'], $item['category'])
        ];
    }

    // Output early in header
    add_action('wp_head', function() use($output) { 
        echo '<pre style="display:block;width: 100%;background-color:#fff;color:#000;margin:0px;padding:50px;border: 5px solid #000;">';
        print_r($output);
        echo '</pre>';
    }, 10);
}



run_awesome_code_test();
