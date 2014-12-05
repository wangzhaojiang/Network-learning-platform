
-- --------------------------------------------------------------------------------
-- create the database if not exists
-- [jake_me] database name 
-- --------------------------------------------------------------------------------

DROP DATABASE IF EXISTS `jaker_me`;

CREATE DATABASE `jaker_me` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;


use `jaker_me`;


-- --------------------------------------------------------------------------------
-- create user_info table
-- [user_info] table name
-- --------------------------------------------------------------------------------
-- columns
-- [uid]        主键，不为空 ,从1000开始
-- [name]       用户名，不为空
-- [permisson]  0: normal; 1:admin
-- [password]   user_info password
-- [sex]        性别, 0 是男的，1是女的
-- [mail] 	mail
-- [school] 	school
-- [logo] 	用户头像的路径
-- [sign] 	个性签名
-- --------------------------------------------------------------------------------
DROP TABLE IF EXISTS `user_info`;

CREATE TABLE `user_info` (
	uid         INT UNSIGNED  PRIMARY KEY AUTO_INCREMENT NOT NULL, 
	name        CHAR(10)  NOT NULL,
	permisson   INT(1)    NOT NULL DEFAULT 0,
	password    CHAR(32)  NOT NULL, 
	sex         INT(1)   NOT NULL  CHECK(sex=0 or sex=1), 
	mail        CHAR(50)  NOT NULL UNIQUE, 
	school      CHAR(128) NOT NULL, 
	logo        CHAR(128) NOT NULL,
	sign 	    VARCHAR(150)
) AUTO_INCREMENT=1000, DEFAULT CHARSET=utf8; 


-- --------------------------------------------------------------------------------
-- create user_info_plan table
-- [user_info_plan] table name
-- --------------------------------------------------------------------------------
-- columns
-- [id]        主键，不为空 ,从1开始
-- [type] 	
-- [uid] 	外键，是user_info的主键，
-- [time] 	计划产生的的时间
-- [vid] 	是外键，是视频表的外键,目前保留
-- [process] 	学习进度，上一次观看到视频的那个地方
-- --------------------------------------------------------------------------------

DROP TABLE IF EXISTS `user_plan`;

CREATE TABLE `user_plan`(
	id  int UNSIGNED PRIMARY KEY AUTO_INCREMENT NOT NULL,
	type INT(2) NOT NULL check(type in (0,1,2)),
	uid int UNSIGNED NOT NULL,
	time DATETIME 	NOT NULL ,
	vid INT NOT NULL,
	process DATETIME NOT NULL,
	foreign key(uid) references user_info(uid) on delete cascade on update cascade
)AUTO_INCREMENT=1,DEFAULT CHARSET=utf8;

-- --------------------------------------------------------------------------------
-- create mail table
-- [mail] table name
-- --------------------------------------------------------------------------------
-- columns
-- [mid]        主键，不为空 ,从1开始
-- [fromuid] 	外键，是发送着，是user_info的外键 	
-- [time] 	是发送私信的时间
-- [content] 	私信的正文
-- [touid] 	是外键，是接受者，是user_info的外键
-- [status] 	是私信阅读的状态，0未读，1,已读
-- --------------------------------------------------------------------------------
DROP TABLE IF EXISTS `user_mail`;

CREATE TABLE `user_mail` (
	mid     INT UNSIGNED  PRIMARY KEY AUTO_INCREMENT NOT NULL, 
	fromuid INT UNSIGNED NOT NULL,
	time   DATETIME NOT NULL,
	content TEXT    NOT NULL,
	touid INT UNSIGNED NOT NULL,
	status  INT(1)  NOT NULL CHECK(status=0 or status=1),
	foreign key(fromuid) references user_info(uid) on update cascade,
	foreign key(touid)  references user_info(uid) on update cascade
)AUTO_INCREMENT=1, DEFAULT CHARSET=utf8; 

-- --------------------------------------------------------------------------------
-- create relation table
-- [relation] table name
-- --------------------------------------------------------------------------------
-- columns
-- [rid]        主键，不为空 ,从1开始,关注和粉丝的表
-- [fromuid] 	外键，是关注者，是user_info的外键 	
-- [touid] 	是外键，是被关注者，是user_info的外键
-- --------------------------------------------------------------------------------

DROP TABLE IF EXISTS `user_relation`;

CREATE TABLE `user_relation` (
	rid INT UNSIGNED PRIMARY KEY AUTO_INCREMENT NOT NULL,
	fromuid INT UNSIGNED  NOT NULL,
	touid INT UNSIGNED    NOT NULL,
	foreign key(fromuid) references user_info(uid) on delete cascade on update cascade,
	foreign key(touid)  references user_info(uid) on delete cascade on update cascade
)AUTO_INCREMENT=1, DEFAULT CHARSET=utf8; 
