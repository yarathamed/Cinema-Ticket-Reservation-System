CREATE TABLE customer(
    customer_id int not null auto_increment,
    first_name varchar(35),
    last_name varchar(35),
    email varchar(100),
    pass varchar(30),
    PRIMARY KEY (customer_id)); 

CREATE TABLE admin(
    admin_id int not null auto_increment,
    username varchar (20),
    email varchar(100),
    password  varchar(20),
    PRIMARY KEY (admin_id));        

CREATE TABLE reservation(
    reservation_number varchar(100) not null ,
    movie_id  varchar(100) NOT NULL,
    customer_id int,
    movie_name varchar(60),
    timeslot datetime,
    n_of_seats int,
    PRIMARY KEY (reservation_number));

CREATE TABLE payment(
    payment_no varchar(100),
    reservation_number varchar(100),
    customer_id int,
    amount int,
    type_of_payment varchar(20),
    CONSTRAINT payment_PK PRIMARY KEY (payment_no));     

CREATE TABLE movie (
  movie_id  varchar(100) NOT NULL,
  movie_name varchar(60) DEFAULT NULL,
  available_seats int(11) DEFAULT NULL,
  timeslot datetime DEFAULT NULL,
  price int(11) DEFAULT NULL,
  movie_image varchar(100) DEFAULT NULL
) ;

ALTER TABLE movie
  ADD PRIMARY KEY (movie_id),
  ADD UNIQUE KEY `MOVIE_UK` (movie_name,timeslot);

 ALTER TABLE payment
 ADD CONSTRAINT payment_fk
 FOREIGN KEY (reservation_number)REFERENCES  reservation (reservation_number);

 ALTER TABLE reservation
 ADD CONSTRAINT reservation_fk
 FOREIGN KEY (movie_id)REFERENCES  movie (movie_id);

 ALTER TABLE reservation
 ADD CONSTRAINT reservation1_fk
 FOREIGN KEY (customer_id)REFERENCES  customer(customer_id);  