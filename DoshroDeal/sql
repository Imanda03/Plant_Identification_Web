CREATE TABLE user (
    userID int NOT NULL AUTO_INCREMENT,
    username varchar(255),
    password varchar(255),
    email varchar(255),
    phone varchar(255),
    userimage varchar(255),
    PRIMARY KEY (userID),
);
CREATE TABLE product (
    productID int NOT NULL AUTO_INCREMENT,
    title varchar(255),
    price varchar(255),
    description varchar(255),
    pcondition varchar(255),
    location varchar(255),
    filename varchar(255),
    categoryID int,
    PRIMARY KEY (productID),
   
);

	CREATE TABLE sales (
    salesID int NOT NULL AUTO_INCREMENT,
    userID int,
    productID int,
    PRIMARY KEY (salesID),
    CONSTRAINT userID
    FOREIGN KEY (userID)
    REFERENCES user (userID)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
     CONSTRAINT productID
    FOREIGN KEY (productID)
    REFERENCES product (productID)
    ON DELETE CASCADE
    ON UPDATE CASCADE
    
);

CREATE TABLE cart ( cartID int NOT NULL AUTO_INCREMENT, buyerID int, proID int, cquantity int, sellerID int, PRIMARY KEY (cartID), CONSTRAINT sellerID FOREIGN KEY (sellerID) REFERENCES user (userID), CONSTRAINT proID FOREIGN KEY (proID) REFERENCES product (productID) );

CREATE TABLE orders ( orderID int NOT NULL AUTO_INCREMENT, buyer int, seller int, product int, oquantity int, name VARCHAR(128), number VARCHAR(128), address VARCHAR(128),method VARCHAR(128) ,status VARCHAR(128), PRIMARY KEY (orderID), CONSTRAINT seller FOREIGN KEY (seller) REFERENCES user (userID), CONSTRAINT product FOREIGN KEY (product) REFERENCES product (productID) );
