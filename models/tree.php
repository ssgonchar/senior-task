<?php
/**
 * Created by PhpStorm.
 * User: mrikirill
 */

Class Model_tree extends Route{

    /**
     * @return array
     */
    public function exportTree()
    {
        $tree = new TreeComposite();
        $tree->createNode(new Node('country'));
        $tree->createNode(new Node('kiev'), $tree->getNode('country'));
        $tree->createNode(new Node('kremlin'), $tree->getNode('kiev'));
        $tree->createNode(new Node('house'), $tree->getNode('kremlin'));
        $tree->createNode(new Node('tower'), $tree->getNode('kremlin'));
        $tree->createNode(new Node('moskow'), $tree->getNode('country'));
        $tree->attachNode($tree->getNode('kremlin'), $tree->getNode('moskow'));
        $tree->createNode(new Node('maidan'), $tree->getNode('kiev'));
        $tree->deleteNode($tree->getNode('kiev'));
        $tree->createNode(NodeFactory::create('domen','product1'));
        $tree->createNode(NodeFactory::create('RU','product2'),$tree->getNode('domen'));
        $tree->createNode(NodeFactory::create('EU','product2'),$tree->getNode('domen'));
        $tree->createNode(NodeFactory::create('RU','product2'),$tree->getNode('domen'));

        return $tree->export();
    }
}