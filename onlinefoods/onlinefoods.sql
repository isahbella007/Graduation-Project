create table restaurant(
restaurantid int (50) Not Null Primary Key Auto_Increment, 
name char (25),
address varchar (25), 
category char (25), 
email varchar(20), 
password varchar(20),
region char(20),
FLAG char(20) default 'PENDING',
datecreated date
); 

create table foodcategory(
foodcategoryid int(50) Not Null Primary key  Auto_Increment, 
restaurantid int(50) Not Null, 
foodcategoryname char(25), 
datecreated date, 
foreign key(restaurantid) References restaurant(restaurantid) 
);

create table foodmenu(
foodmenuid int(50) Not Null Primary key Auto_Increment, 
restaurantid int(50) Not null, 
foodcategoryid int (50) Not Null, 
foodcategory char(20) Not null,
itemname char(25) Not Null, 
price int(10) Not null, 
description char(50) Not Null, 
image BLOB Null, 
datecreated date Not Null,

foreign key (restaurantid) References restaurant(restaurantid), 
foreign key (foodcategoryid) References foodcategory(foodcategoryid)
ON DELETE CASCADE
);

Create table appeal(
appealid int(50) Not Null Primary key Auto_Increment, 
restaurantid int(50) Not null, 
res_name  char (25) Not Null,
message text(3000) Not Null, 
status char(50) not null DEFAULT 'NEW',

foreign key (restaurantid) References restaurant(restaurantid), 

);
CREATE TABLE `admin` (
    name char(255), 
    image varchar (255), 
    email varchar(255),
    password varchar(255)
);
Insert into admin(name, image, email, password) VALUES ('Bella', 'bella.jpg', 'isabellakpai@gmail.com', 'hellothere');

Create TABLE vacancy(
    vacancyid int(50) Not Null Primary Key Auto_Increment,
    restaurantid int(50) Not Null, 
    position char(25) not null, 
    availability int(50) not null, 
    description text(5000) not null,
    flag char(25) not null default 'ACTIVE',
    foreign key(restaurantid) References restaurant(restaurantid)
);
create table pdf(
    id int(50)  Not Null Primary Key Auto_Increment,
    name varchar(255) not null, 
    mime varchar(255) not null, 
    data BLOB
);

CREATE TABLE apply(
applyid int(50) not null Primary key Auto_Increment, 
restaurantid int(50) not null,
name char(255) not null, 
surname char(255) not null, 
contact int(50) not null, 
address varchar(255) not null, 
email varchar(255) not null, 
description varchar(255) not null, 
gender char(255) not null, 
position char(255) not null, 
image varchar(255) null,
-- Remeber to return for the pdf inserting
foreign key(restaurantid) References restaurant(restaurantid)
);

CREATE TABLE employee(
    employeeid int(50) not null Primary key Auto_Increment,
    restaurantid int(50) not null, 
    name char(255) not null, 
    surname char(255) not null, 
    password varchar(255) not null default 'welcome', 
    contact varchar(50) not null, 
    address varchar(255) not null, 
    email varchar(255) not null, 
    gender char(255) not null, 
    position char(255) not null, 
    image varchar(255) null,
    status char(255) not null default 'Available',
-- Remeber to return for the pdf inserting
    foreign key(restaurantid) References restaurant(restaurantid)   
);
ALTER TABLE employee Auto_Increment = 1000;

Create Table foodinventory(
    id int(50) not null Primary key Auto_Increment,  
    restaurantid int(50) not null, 
    itemname char(255) not null, 
    cost int(50) not null, 
    quantity int(50) not null, 
    datebought date not null, 
    dateentered datetime not null, 
    submittedby char(255) not null,
    updatedby char(255) not null,
    foreign key(restaurantid) References restaurant(restaurantid)
);

Create Table customers (
customerid int(50) not null Primary key Auto_Increment,
name char(255) not null  
phonenumber int(50) not null, 
password varchar(255) not null
);
-- Insert dummy data
INSERT into customers( name) values("Amina");
INSERT into customers( name) values ("Joy");
INSERT into customers( name) values ("Stepp");
INSERT into customers( name) values ("Oxe");

CREATE TABLE address (
  addressid int(11) NOT NULL Primary key Auto_Increment,
  address varchar(222) NOT NULL,
  customerid int(222) NOT NULL,
  region char(25) NOT NULL,
);
foreign key(customerid) References customers(customerid) ON Delete CASCADE

Create table orders(
    orderid int(50) not null Primary key Auto_Increment, 
    customerid int(50) not null,
    restaurantid int(50) not null, 
    addressid int(10) not null, 
    itemname char(255) not null, 
    price int(50) not null, 
    quantity int(12) not null, 
    paymentmethod char(50) not null, 
    message text(5000) null,
    orderdate CURRENT_DATE not null, 
    status char(255) not null default 'New',

    foreign key(restaurantid) References restaurant(restaurantid),
    FOREIGN key(addressid) REFERENCES address(addressid),
    foreign key(customerid) 
        References customers(customerid)
        ON DELETE CASCADE
);
Create table report(
    reportid int(50) not null PRIMARY KEY AUTOINCREMENT,
    restaurantid int(50) not null,
    orderid varchar(50) not null , 
    customerid int(50) not null,
    message text(2000) not null,

    foreign key(restaurantid) References restaurant(restaurantid),
    foreign key(customerid) 
        References customers(customerid)
);

-- Insert Dummy Data.
INSERT INTO orders(customerid, restaurantid, itemname, price, spicelevel, paymentmethod) VALUES(1 ,2,"Orange Chicken + Rice", 39,"Normal", "Cash");
INSERT INTO orders(customerid, restaurantid, itemname, price, spicelevel, paymentmethod) VALUES (5, 1, "Jollof Rice", 30, "Spicy", "Credit Card");
INSERT INTO orders(customerid, restaurantid, itemname, price, spicelevel, paymentmethod) VALUES(5, 1, "Coconut Rice", 30, "Spicy", "Credit Card");
INSERT INTO orders(customerid, restaurantid, itemname, price, spicelevel, paymentmethod) VALUES(1, 1, "Coconut Rice", 30, "Spicy", "Credit Card");

Create table sales(
    saleid int(50) not null Primary key Auto_Increment, 
    customerid int(50) not null, 
    restaurantid int(50) not null, 
    itemname char(255) not null, 
    price int(50) not null,
    salesday date,

    foreign key(restaurantid) References restaurant(restaurantid),
    foreign key(customerid) References customers(customerid)
    ON DELETE CASCADE
);
INSERT INTO sales(customerid, restaurantid, itemname, price) VALUES(1, 2, "Orange Chicken + Rice", 39);
INSERT INTO sales(customerid, restaurantid, itemname, price) VALUES(5, 1, "Jollof Rice" , 30);
INSERT INTO sales(customerid, restaurantid, itemname, price) VALUES(5, 1, "Coconut Rice", 30);
INSERT INTO sales(customerid, restaurantid, itemname, price) VALUES(1, 1, "Coconut Rice", 30);

Create table employeehistory(
    employeehistoryid int(50) not null Primary key Auto_Increment, 
    restaurantid int(50) not null, 
    employeeid int(50) not null,
    orderid int(50)not null, 
    

    foreign key(restaurantid) References restaurant(restaurantid) on delete CASCADE,
    foreign key(employeeid) References employee(employeeid) on delete CASCADE,
    foreign key(orderid) References orders(orderid) on DELETE CASCADE
);