CREATE DATABASE hms;
USE hms;
CREATE TABLE hotel(hno INT(2) PRIMARY KEY, hname VARCHAR(30), hadd VARCHAR(50), rooms INT(3), rating FLOAT);
CREATE TABLE rooms(hno INT(2) REFERENCES hotel(hno), rno INT(3), rtype VARCHAR(20), rate INT(5), PRIMARY KEY(hno,rno));
CREATE TABLE guests(gno INT(4) AUTO_INCREMENT PRIMARY KEY, gname VARCHAR(30), gadd VARCHAR(50), gmob BIGINT(11));
CREATE TABLE fac(facid INT(3) PRIMARY KEY, facname VARCHAR(25));
CREATE TABLE hotfac(hno INT(2) REFERENCES hotel(hno),facid INT(3) REFERENCES fac(facid) ON DELETE CASCADE, PRIMARY KEY(hno,facid));
CREATE TABLE bookings(bid INT(5) AUTO_INCREMENT PRIMARY KEY,
                    gno INT(4) REFERENCES guests(gno),
                    hno INT(2) REFERENCES hotel(hno),
                    rno INT(3) REFERENCES rooms(rno),
                    dtfr DATE, dtto DATE)AUTO_INCREMENT=1000;
CREATE TABLE users(userid VARCHAR(20) PRIMARY KEY,pass VARCHAR(30));

INSERT INTO hotel VALUES(11,'Camp Nou','Barcelona(Spain)',10,4.9),
                        (22,'Santiago Bernabeu','Madrid(Spain)',8,4.7),
                        (33,'Salt Lake','Kolkata(India)',8,4.1),
                        (44,'Lusail Iconic','Lusail(Qatar)',6,3.8),
                        (55,'Old Trafford','Manchester(England)',4,3.5);

INSERT INTO guests(gname,gadd,gmob) 
VALUES ('Lionel Messi','Argentina',9658364782),('Cristiano Ronaldo','Portugal',8977342657),('Sunil Chhetri','India',7564533243),('Ronaldo','Brazil',9807765844),
        ('Robert Lewandowski','Poland',9088752345),('Zalatan Ibrahimovic','Sweden',9780564723),('Luis Suarez','Uruguay',9988963456),
        ('Sergio Ramos','Spain',7686972312),('Luka Modric','Croatia',8973423123),('Diego Godin','Uruguay',885221345),
        ('Gareth Bale','Wales',7687544332),('Marcelo','Brazil',8878970903),('Karim Benzema','France',7865432234),
        ('Toni Kroos','Germany',9878237231),('Casemiro','Brazil',9734123412),('Iker Casillas','Spain',9977435332),
        ('Neymar Jr','Brazil',7464657685),('Andres Iniesta','Spain',8790645432),('Sergio Busquets','Spain',7686553123),
        ('Xavi','Spain',7869734256),('Pepe','Portugal',7777667543),('Pele','Brazil',7869564758),
        ('Angel Di Maria','Argentina',7687992357),('Manuel Neuer','Germany',8792343235),('Antoine Griezmann','France',8677980984),
        ('Kylian Mbappe','France',7786452464),('Erling Haaland','Norway',9970433256),('Vinicius Jr','Brazil',9232157854),
        ('Eduardo Camavinga','France',8674565342),('Fede Valverde','Uruguay',8623256789),('David Alaba','Austria',8864352678),
        ('Debanjan Ghosh','India',1010101010),('Vishal Hanchnoli','India',7777777777);

INSERT INTO rooms VALUES(11,101,'Single',5000),(11,102,'Single',5000),(11,103,'Single',5000),
                        (11,201,'Double',8000),(11,202,'Double',8000),
                        (11,301,'Family',10000),(11,302,'Family',10000),(11,303,'Family',10000),
                        (11,401,'Presidential Suite',12000),(11,402,'Presidential Suite',12000),
                        (22,101,'Single',3000),(22,102,'Single',3000),(22,103,'Single',3000),
                        (22,201,'Double',6500),(22,202,'Double',6500),
                        (22,301,'Family',9000),(22,302,'Family',9000),
                        (22,401,'Presidential Suite',1100),
                        (33,101,'Single',2500),(33,102,'Single',2500),(33,103,'Single',2500),
                        (33,201,'Double',6000),(33,202,'Double',6000),(33,203,'Double',6000),
                        (33,301,'Family',7500),
                        (33,401,'Presidential Suite',10000),
                        (44,101,'Single',3000),(44,102,'Single',3000),
                        (44,201,'Double',5000),(44,202,'Double',5000),(44,203,'Double',5000),
                        (44,301,'Family',7000),
                        (55,101,'Single',2000),(55,102,'Single',2000),(55,103,'Single',2000),
                        (55,201,'Double',4000);

INSERT INTO fac VALUES(1,'WIFI'),(2,'POOL'),(3,'SPA'),(4,'GYM'),(5,'AC'),(6,'RESTUARANT'),(7,'ROOM SERVICE'),(8,'PARKING');

INSERT INTO hotfac VALUES(11,1),(11,2),(11,3),(11,4),(11,5),
                (22,5),(22,6),(22,4),(22,7),
                (33,1),(33,5),(33,3),(33,6),(33,7),
                (44,5),(44,8),(44,2),
                (55,3);
INSERT INTO users VALUES('vsh','123');
