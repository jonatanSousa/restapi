# restapi
symfony rest Api 

this is intended to give a service that returns all postal codes and location from portugal 

php bin/console server:start

php  bin/console cron:updateGeolocation update

********

create table api.codigos_postais_moradas (
    id int(10) UNSIGNED PRIMARY KEY AUTO_INCREMENT, 
    post_code int(8) NOT NULL,
    city varchar(30) ,
    street varchar(30),
    reg_date TIMESTAMP
    );


