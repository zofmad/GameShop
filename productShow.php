<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


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

if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['product_delete_id'])){
    if(is_numeric($_GET['product_delete_id'])){
        $product = new Product();
        $productId = $conn->real_escape_string($_GET['product_delete_id']);
        $product->loadProductFromDB($conn, $productId);
        if($product->deleteProduct($conn)){
            echo "Product has been deleted.<br>";
            echo "<a href='index.php'>Go to the main page</a><br>";

        }else{
             header('Location: index.php');
        }
        
   
    }   
}

if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['product_show_id'])){
    
    if(is_numeric($_GET['product_show_id'])){
        $product = new Product();
        $productId = $conn->real_escape_string($_GET['product_show_id']);
        $product->loadProductFromDB($conn, $productId);
        $product->showProduct();
        if($product->getBasketId() == $basket->getId()){
            echo "Product is in Your basket.<br>";
            echo "<a href='?product_delete_id=".$product->getId()."'>Delete product from basket</a><br>";
        }
        echo "<a href='productEdit.php?product_edit_id=".$product->getId()."'>Edit product</a><br>";
        echo "<a href='?product_delete_id=".$product->getId()."'>Delete product</a><br>";

    
    }
//    else{
//        header('Location: index.php');
//    }
}




$conn->close();
$conn = NULL;


?>

            

