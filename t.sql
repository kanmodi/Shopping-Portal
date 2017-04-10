create table address (
	AddID int not null auto_increment,
	Street varchar(200) not null,
	City varchar(100) not null,
	State varchar(100) not null,
	ZipCode varchar(6) not null, --check??
	CID int,
	primary key(AddID)
);
alter table address add foreign key(CID) references customer(CID);
alter table address auto_increment=500;
create table customer (
	CID int not null auto_increment,
	CName varchar(100) not null,
	CGender boolean,
	CDOB date,
	CEmail varchar(100) not null,
	CPass varchar(100) not null,
	CMobileNo varchar(15),
	BillingAddID int,
	DeliveryAddID int,
	check(CDOB<now() and ((year(now()) - year(CDOB)) < 120) and CMobileNo>=1000000000 and CMobileNo < 10000000000),
	primary key(CID),
	foreign key(BillingAddID) references address(AddID),
	foreign key(DeliveryAddID) references address(AddID),
	unique(CEmail)
);
alter table customer auto_increment=100;


create table product(
	PID int not null auto_increment,
	PName varchar(200) not null,
	PDesc varchar(5000),
	PPrice float not null,
	PImgSrc varchar(500),
	PStock int not null,
	primary key(PID),
	check(PPrice>0.0 and PStock>0)
);
alter table product auto_increment=200;

create table basket (
	BID int not null auto_increment,
	CID int,
	NumProds int,
	TotalCost float not null,
	primary key(BID),
	foreign key(CID) references customer(CID),
	check(NumProds>=0 and TotalCost>=0.0),
	unique(CID)
);
alter table basket auto_increment=300;

create table basketProds (
	BID int,
	PID int,
	Quantity int not null,
	foreign key(BID) references basket(BID),
	foreign key(PID) references product(PID),
	primary key(BID,PID),
	check(Quantity>0)
);

create table rating (
	CID int,
	PID int,
	Value int not null,
	check(Value>=0 and Value<=10),
	foreign key(CID) references customer(CID)
	foreign key(PID) references product(PID),
	primary key(CID, PID)
);

create table comment (
	CommID int not null auto_increment,
	CID int,
	PID int,
	Comment varchar(500) not null,
	primary key(CommID),
	foreign key(CID) references customer(CID),
	foreign key(PID) references product(PID)
);
alter table comment auto_increment=400;

create table tag (
	TagID int not null auto_increment,
	TagName varchar(100) not null,
	unique(TagName),
);
alter table category auto_increment=700;

create table tagProduct (
	PID int,
	Tagtt,
	foreign key(PID) references product(PID),
	foreign key(TagID) references tag(TagID),
	unique(PID,TagID)
);

create table ordr (
	OrderID int not null auto_increment,
	CID int,
	PurchaseDate date not null,
	PaymentMode varchar(20),
	OrderStatus varchar(20) not null,
	primary key(OrderID),
	foreign key(CID) references customer(CID),
	check(PurchaseDate<now() and (year(PurchaseDate)>1980))
)
alter table ordr auto_increment=600;

create table orderedProduct (
	OrderID int,
	PID int,
	Quatity int not null,
	primary key(OrderID,PID),
	foreign key(OrderID) references ordr(OrderID),
	foreign key(PID) references product(PID),
	check(Quatity>0) 
);


insert into customer(CName, CGender, CDOB, CEmail, CPass, CMobileNo, BillingAddID, DeliveryAddID) values 
('Akhilesh', 'M', '1994-09-04', 'akhilesh_alliswell@yahoo.com', 'abcd', 9911052855, 500,500),
('Mayank', 'M', '1994-09-05', 'mayankjain94@yahoo.com', 'adbc', 9845632157, 501, 501),
('Aman', 'M', '1992-01-01', 'aman1123@gmail.com', 'pqrs', 9711881372, 502,502),
('Akhil', 'M', '1993-10-10', 'akhilnsit12@gmail.com', 'wxyz', 9874563210, 503, 503),
('Anmol', 'M', '1994-01-01', 'anmolchugh19@yahoo.in', 'asdf', 9658742310, 504, 504),
('Jack Reacher', 'M', '03/23/1978', 'jackreacher123@gmail.com', 'Reacher123', 7823823873, 505, 505),
('Toby Mcguire', 'M', '07/29/1972', 'tobyMcguire297@gmail.com', 'Eureka', 7859375233, 506, 506);


insert into address(Street, City, State) values
	('Khans, St. Joseph’s Road', 'Bannimantap', 'Haryana'),
	('CFTRI House', 'CFTRI', 'Delhi'),
	('Vanarpet', 'Viveknagar', 'Bihar'),
	('a-11, big door', 'Outhicamannii House', 'Kerala');



create table category (
	CatID int not null auto_increment,
	CatName varchar(100) not null,
	CatImgSrc varchar(200),
	ParentCatID int,
	primary key(CatID),
	unique(CatName)
);

insert into tag(TagName) values
	('woodland'),
	('footwear'),
	('sandals'),
	('sandal'),
	('jackandjone'),
	('jackandjones'),
	('jack'),
	('jones'),
	('shoe'),
	('shoes'),
	('lacoste'),
	('formal'),
	('titan'),
	('watch'),
	('gforce'),
	('casual'),
	('formal');