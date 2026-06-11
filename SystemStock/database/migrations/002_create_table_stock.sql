create table stock(
	id int primary key auto_increment, 
    quantity int not null,
    id_product int not null unique, 
    foreign key(id_product) references products(id)
);