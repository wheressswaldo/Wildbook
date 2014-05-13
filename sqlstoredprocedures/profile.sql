use wildbook;

drop function if exists profile_exists;
delimiter //
create function profile_exists(username varchar(128))
	returns boolean
	reads sql data
begin
	return exists(select 1 from profile where profile.username = username);
end //
delimiter ;

#select profile_exists("kevin");

drop procedure if exists profile_get;
delimiter //
create procedure profile_get(
	in username varchar(128), 
	out firstname varchar(64), 
	out lastname varchar(64),
	out profilepic blob,
	out birthday datetime,
	out gender varchar(1),
	out city varchar(64),
	out description varchar(512)
)
begin
	select 
		profile.firstname, 
		profile.lastname, 
		profile.profilepic, 
		profile.birthday,
		profile.gender, 
		profile.city, 
		profile.description 
		into firstname, lastname, profilepic, birthday, gender, city, description
	from profile
	where profile.username = username;
end//
delimiter ;

#call profile_get('kevin', @firstname, @lastname, @profilepic, @birthday, @gender, @city, @description);		
#select @firstname, @lastname, @profilepic, @birthday, @gender, @city, @description;

drop function if exists profile_create;
delimiter //
create function profile_create(
	username varchar(128),
	firstname varchar(64),
	lastname varchar(64),
	profilepic blob,
	birthday datetime,
	gender varchar(1),
	city varchar(64),
	description varchar(512)
)
	returns boolean
	reads sql data
begin
	insert into profile values(username,firstname,lastname,profilepic,birthday,gender,city,description);
	return true;
end //
delimiter ;

#update profile set firstname='Bob', lastname='Joe', profilepic=,birthday='1980-01-01',gender='1',city='Santa Monica',description='Hi I"m Boba',privacy='' where username='bobjoe'; 