#Setup db

create database wildbook;
use wildbook;

create table User 
(
	username varchar(128) not null unique,
	password binary(16) not null,
	primary key(username)
);

create table friendsWith
( 
	username1 varchar(128) not null,
	username2 varchar(128) not null,
	primary key(username1, username2),
	foreign key(username1) references User(username),
	foreign key(username2) references User(username)
);

create table friendRequest
( 
	usernameFrom varchar(128) not null,
	usernameTo varchar(128) not null,
	primary key(usernameFrom, usernameTo),
	foreign key(usernameFrom) references User(username),
	foreign key(usernameTo) references User(username)
);

create table MultiMedia
(
	username varchar(64) not null,
	multimediaID int not null auto_increment,
	mediaType varchar(5) not null, 
	mediaName varchar(64) not null,
	mediaDesc varchar(512) null,
	primary key(multimediaID),
	foreign key(username) references User(username)
);

create table Profile
(
	username varchar(128) not null unique,
	firstname varchar(64) not null,
	lastname varchar(64) not null,
	profilepic int null,
	birthday date null,
	gender varchar(1) null,
	city varchar(64) null,
	description varchar (512) null,
	privacy varchar(1) null,
	primary key(username),
	foreign key(username) references User(username),
	foreign key(profilepic) references Multimedia(multimediaID)
 );

create table Location
(	
	locationID int not null auto_increment,
	locationName varchar(64) not null,
	longitude double not null,
	latitude double not null,
	primary key(locationID)
);

create table Activity
(	
	activityID int not null auto_increment,
	activityName varchar(64) not null,
	primary key(activityID)
);

create table DiaryEntry
(
	username varchar(128) not null,
	diaryID int not null auto_increment,
	activityID int not null,
	locationID int not null,
	multimediaID int null,
	diaryTitle varchar(128) not null,
	diaryDesc varchar(512) null,
	timeposted datetime not null,
	lastedited datetime null,
	privacySetting varchar(1) not null,
	primary key(diaryID),
	foreign key(username) references User(username),
	foreign key(activityID) references Activity(activityID),
	foreign key(locationID) references Location(locationID),
	foreign key(multimediaID) references Multimedia(multimediaID)
);

create table Comment
(
	commentID int not null auto_increment,
	userofEntry varchar(128) not null,
	diaryID int not null,
	userofComment varchar(128) not null,
	commentText varchar(512) null,
	timeposted datetime not null,
	lastEdited datetime null,
	primary key(commentID),
	foreign key(userofEntry, diaryID) references DiaryEntry(username, diaryID),
	foreign key(userofComment) references User(username)
);

create table likeLocation
(
	username varchar(128) not null,
	locationID int not null,
	primary key(username, locationID),
	foreign key(username) references User(username),
	foreign key(locationID) references Location(locationID)
);

create table likeActivity
(
	username varchar(128) not null,
	activityID int not null,
	primary key(username, activityID),
	foreign key(username) references User(username),
	foreign key(activityID) references Activity(activityID)
);

create table likeActivityatLocation
(
	username varchar(128) not null,
	activityID int not null,
	locationID int not null,
	primary key(username, activityID, locationID),
	foreign key(username) references User(username),
	foreign key(activityID) references Activity(activityID),
	foreign key(locationID) references Location(locationID)
);

create table likeEntry
(
	userofEntry varchar(128) not null,
	diaryID int not null,
	userWhoLikes varchar(128) not null,
	primary key(userofEntry, diaryID, userWhoLikes),
	foreign key(userWhoLikes) references User(username),
	foreign key(userofEntry, diaryID) references DiaryEntry(username, diaryID)
);
