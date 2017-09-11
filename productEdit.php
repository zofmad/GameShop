<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



    
    
if(!($_SERVER['REQUEST_METHOD'] === 'GET' && !isset($_GET['product_edit_id']))){
    header('Location: index.php');
}
    if(is_numeric($_GET['product_edit_id'])){
        $product = new Product();
        $productId = $conn->real_escape_string($_GET['product_edit_id']);
        $product->loadProductFromDB($conn, $productId);
        
        
        $productTitle = $product->getTitle();
        $productPrice = $product->getPrice();
        
      
        }else{
             header('Location: index.php');
        }
        
   
    }   


?>

<meta charset='UTF-8'>
<form action='#' method='POST' title="New Product">
    <b>Edit product</b>
    <fieldset>
        <label>Title:
            <input type="text" name="Title"/>
        </label>
        <br>
        <label>Price:
            <input type="number" name="Price" value="0" step="0.01" min="0"/>
        </label>
        <br>
        <label>
            <input type='submit' value="Add new product"></input>
        </label>
        <input type="hidden" name="tweet_id" value="//<?php echo $tweetId?>"> 
        hidden schowane pole formularza, wylacznie przekazywanie zmiennej
    </fieldset>
</form>
            
