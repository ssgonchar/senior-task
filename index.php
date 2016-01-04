<?php
/**
 * Created by PhpStorm.
 * User: mrikirill
 */
include ('route.php');
include ('tree.php');
include ('factory.php');

$route=new Route;
$route->start();

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

function print_pre($ar){echo "<pre>";print_r($ar);echo "</pre>";}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Senior task</title>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
    <script src="script.js"></script>
</head>
<body>
     <div class="container">

         <h4>Заполняем дерево объектами</h4>
         <pre>
// 1. создать корень country<br>
$tree->createNode(new Node('country'));<br>
// 2. создать в нем узел kiev<br>
$tree->createNode(new Node('kiev'), $tree->getNode('country'));<br>
// 3. в узле kiev создать узел kremlin<br>
$tree->createNode(new Node('kremlin'), $tree->getNode('kiev'));<br>
// 4. в узле kremlin создать узел house<br>
$tree->createNode(new Node('house'), $tree->getNode('kremlin'));<br>
// 5. в узле kremlin создать узел tower<br>
$tree->createNode(new Node('tower'), $tree->getNode('kremlin'));<br>
// 6. в корневом узле создать узел moskow<br>
$tree->createNode(new Node('moskow'), $tree->getNode('country'));<br>
// 7. сделать узел kremlin дочерним узлом у moskow<br>
$tree->attachNode($tree->getNode('kremlin'), $tree->getNode('moskow'));<br>
// 8. в узле kiev создать узел maidan<br>
$tree->createNode(new Node('maidan'), $tree->getNode('kiev'));<br>
// 9. удалить узел kiev<br>
$tree->deleteNode($tree->getNode('kiev'));<br></pre>
                <h4>Результат выполнения print_r($tree->export());</h4>
                <?=print_pre($tree->export());?>
                <h4>Через класс фабрику NodeFactory добавляем создаем узел domen и добавлем в него дочерние объеты типа product1 и product2</h4>
                <?=print_pre($tree->nodes);?>
         <div class="row">
         <div class="col-md-12 fcontroller_block">

                 <a href="javascript:void(0)" class="btn btn-primary fcontroller_block__btn">Запросить данные через Front Controller</a>

                <textarea class="form-control fcontroller_block__out" rows="3" placeholder="Результат ответа сервиса ?action=tree&do=export"></textarea>

         </div>
         </div>
     </div>
</body>
</html>
