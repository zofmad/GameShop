/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Author:  OneDLL
 * Created: 2017-09-09
 */


CREATE DATABASE gameshop;


CREATE TABLE baskets(
    ID INT UNSIGNED NOT NULL AUTO_INCREMENT,
    nb_of_products TINYINT NOT NULL,
    combined_price DECIMAL(10, 2) NOT NULL,
    PRIMARY KEY(ID)
) ENGINE = InnoDB;

CREATE TABLE products(
    ID INT UNSIGNED NOT NULL AUTO_INCREMENT,
    basket_id INT UNSIGNED DEFAULT NULL,
    Title VARCHAR(255) NOT NULL,
    Price DECIMAL(10, 2) NOT NULL,
    PRIMARY KEY(ID),
    INDEX basket_id(basket_id),
    CONSTRAINT FK__baskets FOREIGN KEY(basket_id) REFERENCES baskets(id) ON UPDATE CASCADE ON DELETE SET NULL
) ENGINE = InnoDB;



INSERT INTO products VALUES (1,null,"Quake", 2.99), (2,null,"Unreal", 22.99), 
(3,null,"Call of Duty", 1.99), (4,null,"Prey", 5.99), (5,null,"Fear", 12.99);