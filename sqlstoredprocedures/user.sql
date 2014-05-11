use wildbook;

drop function if exists user_create;
delimiter //
create function user_create(username varchar(128), password varchar(21845))
	returns boolean
	reads sql data
begin
	declare md5password binary(16);

	set md5password = unhex(md5(password));
	insert into user(username, password) values(username, md5password); 
	return true;

end //
delimiter ;

#select user_create("Kevin", "abc123");

drop function if exists user_isPasswordValid;
delimiter //
create function user_isPasswordValid(username varchar(128), password varchar(21845))
	returns boolean
	reads sql data
begin
	declare md5password binary(16);
	if not exists(select 1 from user where user.username = username) 
	then
		return false;
	else
		select user.password into md5password from user where user.username = username;
		return unhex(md5(password)) = md5password;
	end if;
end //
delimiter ;

#select user_isPasswordValid("Kevin", "abc123");
#select user_isPasswordValid("Kevin", "nottherightpassword");
