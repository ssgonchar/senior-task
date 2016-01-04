<?php
/**
 * Created by PhpStorm.
 * User: mrikirill
*/

class Node extends TreeComposite
{
    private $name;

    /**
     * Node constructor.
     * @param $name
     */
    function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * Retrun name
     * @return mixed
     */
    public function getName(){
        return $this->name;
    }
}


 class Node_product1 extends Node
 {
     private $name;

     /**
      * Node constructor.
      * @param $name
      */
     function __construct($name)
     {
         $this->name = $name;
     }

     /**
      * @return mixed
      */
     public function getName()
     {
         return $this->name;
     }
 }

class Node_product2 extends Node
{
    private $name;

    /**
     * Node constructor.
     * @param $name
     */
    function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getName(){
        return $this->name;
    }
}

class NodeFactory
{
    /**
     * @param $type
     * @param $name
     * @return mixed
     */
    public static function create($name,$type)
    {
        $product = "Node_" . ucfirst($type);

        if (class_exists($product)) {
            return new $product($name);
        } else {
            return new Node($name);
        }
    }
}