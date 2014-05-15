delimiter //
create trigger addnewsfeed after insert on diaryentry
for each row
begin
	insert into newsfeed values("diaryentry", new.diaryID, new.username, new.timeposted, new.privacySetting);
end //
delimiter ;

delimiter //
create trigger addnewsfeed2 after insert on activityatlocation
for each row
begin
	insert into newsfeed values("activityatlocation", new.aalID, new.username, now(), "1");
end //
delimiter ;