delimiter //
drop procedure if exists insert_user //
create procedure insert_user(out return1 boolean, in username varchar(128), in password varchar(21845))
begin 
	declare totalUsers int unsigned unsigned;
	declare md5password binary(16);
	set return1 = true;

	select count(*) into totalUsers from user;
	if totalUsers = 4294967295 
	then 
		set return1 = false;
	else 
		set md5password = unhex(md5(password));
		insert into user(username, password) values(username, md5password); 
	end if;
	
end//

set @b = "Kevin";
set @c = "abc123";
call insert_user(@a, @b, @c);