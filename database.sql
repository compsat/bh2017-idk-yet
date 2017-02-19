drop database bh2017;
create database bh2017;
use bh2017;

create table donors (
    id int not null primary key auto_increment,
    name varchar(255),
    email varchar(255),
    password varchar(255)
);

create table principals (
    id int not nulL primary key auto_increment,
    name varchar(255),
    email varchar(255),
    password varchar(255),
    school_id int
);

create table schools (
    id int not null primary key auto_increment,
    name varchar(255),
    location varchar(255),
    principal_id int,
    image_path varchar(255)
);

create table teachers (
    id int not nulL primary key auto_increment,
    name varchar(255),
    email varchar(255),
    password varchar(255),
    school_id int,
    foreign key (school_id) references schools(id)
);

alter table schools add foreign key (principal_id) references principals(id);
alter table principals add foreign key (school_id) references schools(id);

create table projects (
    id int not null primary key auto_increment,
    name varchar(255),
    school_id int,
    description varchar(255),
    collectedAmount decimal default 0,
    goalAmount decimal,
    image_path varchar(255),
    foreign key (school_id) references schools(id)
);

create table project_needs (
    id int not null primary key auto_increment,
    project_id int,
    need varchar(255),
    price decimal,
    foreign key (project_id) references projects(id)
);

create table project_donor (
    id int not null primary key auto_increment,
    project_id int,
    donor_id int,
    amount decimal,
    donated_date datetime not null default now(),
    foreign key (project_id) references projects(id),
    foreign key (donor_id) references donors(id)
);

create table school_teacher (
    id int not null primary key auto_increment,
    school_id int,
    teacher_id int,
    pending int,
    foreign key (school_id) references schools(id),
    foreign key (teacher_id) references teachers(id)
);


insert into schools (name, location) values ("ABC school", "here"), ("XYZ Elementary", "there");
insert into projects (name, school_id, description, collectedAmount, goalAmount) values ("ABC project 1", 1, "This is ABC's project 1.", 10000, 100000), ("ABC project 2", 1, "This is ABC's project 2.", 2000, 50000), ("XYZ project 1", 2, "This is XYZ's project 1.", 4000, 100000);
insert into principals (name, email, password, school_id) values ("p", "abc@email.com", "pabc", 1);
update schools set principal_id=1 where id=1;

insert into donors (name, email, password) values ("user", "user@user.com", "pass");