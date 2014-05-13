use wildbook;

INSERT INTO User (username, password) VALUES 	
		("bobjoe", unhex(md5("hunter1"))), 
		("williammunoz", unhex(md5("123456"))), 
		("soniawixom", unhex(md5("password"))), 
		("feliciaweathers", unhex(md5("12345678"))), 
		("danielreid", unhex(md5("qwerty"))), 
		("michaelsweeny", unhex(md5("abc123")));

INSERT INTO friendsWith (username1, username2) VALUES 
	("bobjoe", "soniawixom"), 
	("bobjoe", "feliciaweathers"), 
	("bobjoe", "danielreid"), 
	("williammunoz", "soniawixom"), 
	("williammunoz", "feliciaweathers"), 
	("michaelsweeny", "danielreid");

INSERT INTO friendRequest(usernameFrom, usernameTo)
VALUES
("bobjoe", "williammunoz"), ("feliciaweathers", "michaelsweeny"), ("soniawixom", "michaelsweeny");

INSERT INTO Profile(username, firstname, lastname, profilepic, birthday, gender, city, description)
VALUES
("bobjoe", "Bob", "Joe", null, "1980-01-01", "1", "Santa Monica", "Hi I\"m Bob"), ("williammunoz", "William", "Munoz", null, "1981-02-02", "M", "El Segundo", "Hi I\"m William"), 
("soniawixom", "Sonia", "Wixom", null, "1982-03-03", "2", "Los Angeles", "Hi I\"m Sonia"), 
("feliciaweathers", "Felicia", "Weathers", null, "1983-04-04", "2", "New York", "Hi I\"m Felicia"), 
("danielreid", "Daniel", "Reid", null, "1984-05-05", "1", "Asheville", "Hi I\"m Daniel"), 
("michaelsweeny", "Michael", "Sweeny",null, "1985-06-06", "1", "Boston", "Hi I\"m Michael");


INSERT INTO Location(locationName, longitude, latitude)
VALUES
("TestLocation1", 55.71324, 177.37544),
("TestLocation2", 54.40223, -11.14271),
("TestLocation3", -25.27770, 76.44962);

INSERT INTO Activity(activityName)
VALUES
("Hiking"), ("Biking"), ("Jogging"), ("Rock Climbing");

INSERT INTO DiaryEntry(username, activityID, locationID, diaryTitle, diaryDesc, timeposted, lastedited, privacySetting)
VALUES
("bobjoe", "2", "1", "Biking at TestLocation1!", "First time posting and biking omg wish me luck!!", "2014-04-08 12:35:29.123", "2014-04-08 12:35:29.123", "Friends"),
("bobjoe", "2", "1", "Biking at TestLocation2 NOW!", "YO check me out guys I'm doing it, I'm doing it!!", "2014-04-20 12:35:29.123", null, "Friends");


INSERT INTO Comment(userofEntry, diaryID, userofComment, commentText, timeposted, lastEdited)
VALUES
("bobjoe", 1, "feliciaweathers", "have fun!!", "2014-04-08 12:55:29.123", "2014-04-08 12:55:29.123");

INSERT INTO likeLocation(username, locationID)
VALUES
("bobjoe", 1), ("bobjoe", 2), ("soniawixom", 3), ("feliciaweathers", 1);

INSERT INTO likeActivity(username, activityID)
VALUES
("michaelsweeny", 2), ("bobjoe", 1), ("feliciaweathers", 1);

INSERT INTO likeEntry(userofEntry, diaryID, userWhoLikes)
VALUES
("bobjoe", 1, "feliciaweathers");

