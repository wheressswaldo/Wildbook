--SQL Inserts for Test Data

INSERT INTO User (username, password) VALUES 	
		("bobjoe", "hunter1"), 
		("williammunoz", "123456"), 
		("soniawixom", "password"), 
		("feliciaweathers", "12345678"), 
		("danielreid", "qwerty"), 
		("michaelsweeny", "abc123")

INSERT INTO friendsWith (username1, username2) VALUES 
	("bobjoe", "soniawixom"), 
	("bobjoe", "feliciaweathers"), 
	("bobjoe", "danielreid"), 
	("williammunoz", "soniawixom"), 
	("williammunoz", "feliciaweathers"), 
	("michaelsweeny", "danielreid")

INSERT INTO friendRequest(usernameFrom, usernameTo) VALUES
("bobjoe", "williammunoz"), 
("feliciaweathers", "michaelsweeny"), 
("soniawixom", "michaelsweeny")

INSERT INTO Profile(username, firstname, lastname, profilepic, birthday, gender, city, description) VALUES
("bobjoe", "Bob", "Joe", null, "1980-01-01", "M", "Santa Monica", "Hi I\"m Bob"), ("williammunoz", "William", "Munoz", null, "1981-02-02", "M", "El Segundo", "Hi I\"m William"), 
("soniawixom", "Sonia", "Wixom", null, "1982-03-03", "F", "Los Angeles", "Hi I\"m Sonia"), 
("feliciaweathers", "Felicia", "Weathers", null, "1983-04-04", "F", "New York", "Hi I\"m Felicia"), 
("danielreid", "Daniel", "Reid", null, "1984-05-05", "M", "Asheville", "Hi I\"m Daniel"), 
("michaelsweeny", "Michael", "Sweeny",null, "1985-06-06", "M", "Boston", "Hi I\"m Michael")

INSERT INTO Location(locationName, longitude, latitude) VALUES
("TestLocation1", 55.71324, 177.37544),
("TestLocation2", 54.40223, -11.14271),
("TestLocation3", -25.27770, 76.44962)

INSERT INTO Activity(activityName) VALUES
("Hiking"),
("Biking"), 
("Jogging"), 
("Rock Climbing")

INSERT INTO DiaryEntry(username, activityID, locationID, diaryTitle, diaryDesc, timeposted, lastedited, privacySetting) VALUES
("bobjoe", "2", "1", "Biking at TestLocation1!", "First time posting and biking omg wish me luck!!", "2014-04-08 12:35:29.123", "2014-04-08 12:35:29.123", "Friends")

INSERT INTO Comment(userofEntry, diaryID, userofComment, commentText, timeposted, lastEdited) VALUES
("bobjoe", 1, "feliciaweathers", "have fun!!", "2014-04-08 12:55:29.123", "2014-04-08 12:55:29.123")

INSERT INTO likeLocation(username, locationID) VALUES
("bobjoe", 1),
("bobjoe", 2), 
("soniawixom", 3), 
("feliciaweathers", 1)

INSERT INTO likeActivity(username, activityID) VALUES
("michaelsweeny", 2), 
("bobjoe", 1), 
("feliciaweathers", 1)

INSERT INTO likeEntry(userofEntry, diaryID, userWhoLikes) VALUES
("bobjoe", 1, "feliciaweathers")


