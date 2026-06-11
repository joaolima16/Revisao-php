create table products(
	id int primary key auto_increment,
    name varchar(150) not null,
    unit_price decimal(5,2) not null, 
    code_product VARCHAR(36) unique not null
);
