<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Basket{
    
    
    

    
    private $id;
    private $nbOfProducts;
    private $combinedPrice;
    
    public function __construct(){
        $this->id = -1;
        $this->nbOfProducts = 0;
        $this->combinedPrice = 0;        
    }
    public function addBasketToDB(mysqli $conn){
        if($this->id === -1){
            $sqlAddBasket = "INSERT INTO baskets"
                    . " (nb_of_products, combined_price) VALUES"
                    . " ($this->nbOfProducts, $this->combinedPrice);"; 
            if($conn->query($sqlAddBasket)){
                $this->id = $conn->insert_id;
                     
                return $this;     
            }    
        }
        return false;   
    }
   
    public function loadBasketFromDB(mysqli $conn, $id){ 
        $sqlLoadBasket = "SELECT * FROM baskets WHERE id=$id";
        $result = $conn->query($sqlLoadBasket);
        if($result){
            if($result->num_rows === 1){
                $row = $result->fetch_assoc();
                $this->id = $row['ID'];
                $this->nbOfProducts = $row['nb_of_products'];
                $this->combinedPrice = $row['combined_price'];  
                 
                return $this;
            }
        }
        return false;
              
    }
  
    
  
    public function updateBasket(mysqli $conn){
        if($this->id !== 1){
            
            $sqlUpdateBasket = "UPDATE baskets SET "
                    . "nb_of_products = $this->nbOfProducts,"
                    . "combined_price = $this->combinedPrice"
                    . "WHERE baskets.id = $this->id";
            if($conn->query($sqlUpdateBasket)){
                return $this;
            }       
        }
        
        return false;   
    }
    
//    public function showProduct(){
//        echo "ID: $this->id <br> Title: $this->title <br> "
//                . "Price: $this->price PLN";
//    } 

    public function setCombinedPrice($combinedPrice){
        if(is_numeric($combinedPrice)){
            $this->combinedPrice = $combinedPrice;
            return $this;
        }
        return false;
    }
    public function setNbOfProducts($nbOfProducts){
        if(is_numeric($nbOfProducts)){
            $this->nbOfProducts = $nbOfProducts;
            return $this;
        }
        return false;
    }
    
    public function getId(){
        return $this->id;
        
    }
    public function getCombinedPrice(){
        return $this->combinedPrice;
    }
    public function getNbOfProducts(){
        return $this->nbOfProducts;
    }
    
    
}
    
        
    
    
            
    
    
    
    
    
    
    
    
    
