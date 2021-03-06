create table if not EXISTS stoc
(
stoc_id int primary key,
stoc_quantity int
);

create table if not exists cakes
(
cake_id int auto_increment primary KEY,
cake_name varchar(30),
cake_price int,
cake_weight INT,
cake_calories INT,
cake_quantity int
);

create table if not exists orders_cakes
(
oc_id_order int,
oc_id_cake int,
oc_quantity int,
primary key (oc_id_order, oc_id_cake)
);

create table if not exists orders
(
order_id int primary key AUTO_INCREMENT,
order_id_client int,
order_pickup_date datetime
);

create table if not exists ingredients_cakes
(
ic_id_cake int,
ic_id_ingredient int,
primary key (ic_id_cake, ic_id_ingredient)
);

create table if not exists ingredients
(
ingredient_id int auto_increment primary key,
ingredient_name varchar(25)
);

create table if not exists accounts
(
account_id int primary key auto_increment,
account_username varchar(50),
account_pass varchar(50),
account_type int
);

create table if not exists clients
(
client_id int NOT NULL AUTO_INCREMENT primary key,
client_id_account int NOT NULL,
client_name varchar(30),
client_address varchar(35),
client_phone varchar(10),
foreign key (client_id_account) references store.accounts(account_id)
);