<?php
/**
 * Created by PhpStorm.
 * User: mrikirill
 */

abstract class Tree
{
    // создает узел (если $parentNode == NULL - корень)
    abstract protected function createNode(Node $node,$parentNode=NULL);
    // удаляет узел и все дочерние узлы
    abstract protected function deleteNode(Node $node);
    // делает один узел дочерним по отношению к другому
    abstract protected function attachNode(Node $node,Node $parent);
    // получает узел по названию
    abstract protected function getNode($nodeName);
    // преобразует дерево со всеми элементами в ассоциативный массив
    abstract protected function export();
}


Class TreeComposite extends Tree {

    public $nodes = array();

    /**
     * @param Node $node
     * @param null $parentNode
     */
    public function createNode(Node $node, $parentNode = NULL)
    {
        $this->list[$node->getName()] = $node;

        if(empty($parentNode)) {
            //if (in_array($node, $this->nodes, true)) return;
            $this->nodes[$node->getName()] = $node;
        } else{
            //if (in_array($node, $parentNode->nodes, true)) return;
            $parentNode->nodes[$node->getName()]=$node;
        }

    }

    /**
     * @param Node $node
     */
    public function deleteNode(Node $node)
    {
        if(isset($this->nodes[$node->getName()])) unset($this->nodes[$node->getName()]);
        else foreach ($this->nodes as $n) $n->deleteNode($node);
    }

    /**
     * @param Node $node
     * @param Node $parent
     */
    public function attachNode(Node $node, Node $parent)
    {
        $this->deleteNode($node);
        $parent->nodes[$node->getName()] = $node;
        //$parent->nodes[$node->getName()] = array_merge($parent->nodes,$node->nodes);

    }


    /**
     * @param $nodeName
     */
    public function getNode($nodeName)
    {
        if(isset($this->nodes[$nodeName])) return $this->nodes[$nodeName];
        foreach ($this->nodes as $node) {
            if (is_object($node) && count($node->nodes) > 0)  $res = $node->getNode($nodeName);
        }

        return (is_object($res)) ? $res : false;
    }

    /**
     *
     */
    public function export()
    {
        $res=array();
        foreach ($this->nodes as $k=>$node) {
            $res[$k]="";
            if(is_object($node) && count($node->nodes) > 0) $res[$k]=$node->export();
        }
        return $res;
    }

}