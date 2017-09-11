<?php 
session_start();
require_once 'src/connection.php';
require_once 'src/Product.php';
require_once 'src/Basket.php';
if(!isset($_SESSION['basketId'])){
    $basket = new Basket();
    if($basket->addBasketToDB($conn)){
        $_SESSION['basketId'] = $basket->getId();
        echo "Basket added.<br>";
    }
}else{
    $basket = new Basket();
    if($basket->loadBasketFromDB($conn, $_SESSION['basketId'])){
        echo "Basket loaded.<br>";
    }  
}

?>

<meta charset="UTF-8">
<a href='basketShow.php'>Your basket</a>
<br>



<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */




echo '<h1>Welcome to Gameshop site!</h1>';

echo 'Product list:';


$products = Product::loadAllProducts($conn);
$ordinalNb = 1;
echo "<table style='border-collapse: collapse'>
    <tr style='border: solid 1px'>
    <th style='border: solid 1px'>Ord. Nb</th><th style='border: solid 1px'>ID</th>
    <th style='border: solid 1px'>Title</th><th style='border: solid 1px'>Price</th>
    <th style='border: solid 1px'></th>
    </tr>";

foreach($products as $product){
    echo "<tr style='border: solid 1px'><td>".$ordinalNb."</td>"
            . "<td style='border: solid 1px'>".$product->getId()."</td>"
            . "<td style='border: solid 1px'>".$product->getTitle()."</td>"
            . "<td style='border: solid 1px'>".$product->getPrice()."</td>"
            . "<td style='border: solid 1px'>";
    if($product->getBasketId() == $basket->getId() ){
        echo "Product is in Your basket.<br>";
        echo "<a href='?product_delete_id=".$product->getId()."'>Delete product from basket</a><br>";        
    }else{
        echo "<a href='?product_add_id=".$product->getId()."'>Add product to basket</a><br>";
        //w obsluzeniu czy mozna czy nie
    }
    
    echo "<a href='productShow.php?product_show_id=".$product->getId()."'>Show product</a><br></td></tr>";
    $ordinalNb++;
}
echo '</table>';





?>
<a href='allUsers.php'>Add product</a>

            


