<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Product{
    
    static public function loadAllProducts(mysqli $conn){
        $sqlLoadProducts = "SELECT * FROM products";
        $result = $conn->query($sqlLoadProducts);
        if($result){
            $products = array();
            foreach($result as $row){
                $product = new Product();
                $product->id = $row['ID'];
                $product->basketId = $row['basket_id'];
                $product->title = $row['Title'];
                $product->price = $row['Price'];
                $products[]=$product;
            }
            return $products; 
        }
        return []; 
    }
    
    static public function loadAllProductsInBasket(mysqli $conn, $basketId){
        $sqlLoadProducts = "SELECT * FROM products WHERE basket_id=$basketId";
        $result = $conn->query($sqlLoadProducts);
        if($result){
            $products = array();
            if($result->num_rows > 0){
                while($row=$result->fetch_assoc()){
                    $product = new Product();
                    $product->id = $row['ID'];
                    $product->basketId = $row['basket_id'];
                    $product->title = $row['Title'];
                    $product->price = $row['Price'];   
                    $products[] = $product;
                }
          
            return $products;
            }  
            
        }
       
        return []; 
    }
    
    
    
    
    
    private $id;
    private $basketId;
    private $title;
    private $price;
    
    public function __construct(){
        $this->id = -1;//id = -1 -> produktu nie ma  jeszcze w bazie
        $this->basketId = null;
        $this->title = '';
        $this->price = '';        
    }
    
    
    //nastawianie atrybutow obiektu wylacznie 
    //za pomoca seterow
    public function addProductToDB(mysqli $conn){
        if($this->id === -1){
            $sqlAddProduct = "INSERT INTO products"
                    . " (basket_id, Title, Price) VALUES "
                    . "(null,'$this->title','$this->price')"; 
            if($conn->query($sqlAddProduct)){
                $this->id = $conn->insert_id;

                return $this;     
            }    
            echo $conn->error;
        }
        return false;   
    }

    public function loadProductFromDB(mysqli $conn, $id){ 
        $sqlLoadProduct = "SELECT * FROM products WHERE id=$id";
        $result = $conn->query($sqlLoadProduct);
        if($result){
            if($result->num_rows === 1){
                $row = $result->fetch_assoc();
                $this->id = $row['ID'];
                $this->basketId = $row['basket_id'];
                $this->title = $row['Title'];
                $this->price = $row['Price'];    
                return $this;
            }
        }
        
        return false;
           
    }
    

    
    public function updateProduct(mysqli $conn){
        if($this->id !== -1){
            
            $sqlUpdateProduct = "UPDATE products SET "
                    . "Title = '$this->title',"
                    . "Price = '$this->price'"
                    . "basket_id = '$this->basketId'"
                    . "WHERE products.id='$this->id'";
            if($conn->query($sqlUpdateProduct)){
                return $this;
            }       
        }
        
        return false;   
    }
     public function deleteProduct(mysqli $conn){
        if($this->id !== -1){
            
            $sqlDeleteProduct = "DELETE FROM products WHERE products.id=$this->id";
            if($conn->query($sqlDeleteProduct)){
                return true;
            }       
        }
        
        return false;   
    }

    
    
    
    public function showProduct(){
        echo "ID: $this->id <br> Title: $this->title <br> "
                . "Price: $this->price PLN <br>";
    } 

    
    public function setPrice($price){
        if(is_numeric($price)){
            $this->price = $price;
            return $this;
        }
        return false;
        
    }
    public function setTitle($title){
        if(is_string($title)){
            $this->title = $title;
            return $this;
        }
        
        return false;
    }
    public function  setBasketId($basketId){
        if(is_numeric($basketId) || $basketId === null){
            $this->basketId = $basketId; 
            return $this;   
        }
        return false;
        
    }
    public function getId(){
        return $this->id;
        
    }
    public function getTitle(){
        return $this->title;
    }
    public function getPrice(){
        return $this->price;
    
    }
    public function getBasketId(){
        return $this->basketId;
    }
    
    
    
    
}
        
    
    
            
    
    
    
    
    
    
    
    
    
