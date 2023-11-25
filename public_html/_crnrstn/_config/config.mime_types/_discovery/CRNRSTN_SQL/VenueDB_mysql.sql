-- MySQL dump 9.10
--
-- Host: localhost    Database: venue
-- ------------------------------------------------------
-- Server version	4.0.17-max-debug

--
-- Table structure for table `articles`
--

CREATE TABLE articles (
  idArticle int(11) NOT NULL auto_increment,
  sHeadline varchar(100) NOT NULL default '',
  sSummary text NOT NULL,
  sFilename varchar(50) NOT NULL default '',
  dPublishDate varchar(19) NOT NULL default '',
  idEvent int(11) default NULL,
  idArtist int(11) default NULL,
  PRIMARY KEY  (idArticle),
  KEY idArticle (idArticle)
) TYPE=MyISAM;

--
-- Dumping data for table `articles`
--

INSERT INTO articles VALUES (1,'Everything but the Girls','New York City\'s favorite pop cover band, Girlband, has just launched its first national tour in support of its new album, Cover Girl.','Girlbandtour.htm','7/1/2003 11:36:44',0,1);
INSERT INTO articles VALUES (2,'Making it Real','Will NYC-based singer-songwriter Heather Greene\'s new album be the next big thing?','MakingReal.htm','7/1/2003 14:05:39',0,0);
INSERT INTO articles VALUES (3,'Big Plans for the Future','We will be beginning renovations here at the venue next month. The result will be bigger, better, louder, and a bit more expensive.','BigPlans.htm','7/7/2003 11:59:09',0,0);

--
-- Table structure for table `artists`
--

CREATE TABLE artists (
  idArtist int(11) NOT NULL auto_increment,
  sArtistName varchar(50) NOT NULL default '',
  sImageName varchar(50) default NULL,
  sDescription varchar(200) default NULL,
  PRIMARY KEY  (idArtist)
) TYPE=MyISAM;

--
-- Dumping data for table `artists`
--

INSERT INTO artists VALUES (1,'Girlband','girlband.jpg','Girlband has been tuning guitars and turning heads for nearly two years now. Their song smarts and fashion sense have won them fans the world over!');
INSERT INTO artists VALUES (2,'The New Oldies','newoldies.jpg','Something borrowed, something new: these aren\'t your father\'s oldies. These are the new oldies.');
INSERT INTO artists VALUES (3,'Room by River','roombyriver.jpg','Room by River emerged during the mid-1990\'s from Austin\'s hot music scene. They later became Swim.');
INSERT INTO artists VALUES (4,'Swim','swim.jpg','Truly a rock and roll powerhouse supergroup, these handsome lads tore up Texas stages for nearly a decade before becoming attorneys, computer programmers, and other stuff like that.');
INSERT INTO artists VALUES (5,'Nervous Men','nervousmen.jpg','Equal parts Kraftwerk and Duran Duran, this folk-electronic duo is likely to go down in history as the only one-hit wonder that never had a hit.');

--
-- Table structure for table `categories`
--

CREATE TABLE categories (
  idCat int(11) NOT NULL default '0',
  sCatName varchar(50) NOT NULL default '',
  PRIMARY KEY  (idCat)
) TYPE=MyISAM;

--
-- Dumping data for table `categories`
--

INSERT INTO categories VALUES (1,'Electronica');
INSERT INTO categories VALUES (2,'Garage Rock');
INSERT INTO categories VALUES (3,'Art Punk');

--
-- Table structure for table `customers`
--

CREATE TABLE customers (
  idCustomer int(11) NOT NULL auto_increment,
  sUsername varchar(50) NOT NULL default '',
  sPassword varchar(50) NOT NULL default '',
  sFirstName varchar(50) NOT NULL default '',
  sLastName varchar(50) NOT NULL default '',
  sTelephone varchar(50) NOT NULL default '',
  PRIMARY KEY  (idCustomer),
  KEY idCustomer (idCustomer)
) TYPE=MyISAM;

--
-- Dumping data for table `customers`
--

INSERT INTO customers VALUES (1,'nate@nateweiss.com','flash','Nate','Weiss','718/555-1212');

--
-- Table structure for table `events`
--

CREATE TABLE events (
  idEvent int(11) NOT NULL auto_increment,
  idArtist int(11) NOT NULL default '0',
  nTicketPrice double NOT NULL default '0',
  dEventStart char(19) NOT NULL default '',
  PRIMARY KEY  (idEvent),
  KEY idEvent (idEvent)
) TYPE=MyISAM;

--
-- Dumping data for table `events`
--

INSERT INTO events VALUES (1,1,0,'1/4/2004 20:00:00');
INSERT INTO events VALUES (2,2,0,'2/1/2004 19:30:00');
INSERT INTO events VALUES (3,4,0,'1/12/2004 20:00:00');
INSERT INTO events VALUES (4,5,0,'1/20/2004 22:00:00');

--
-- Table structure for table `pagecomments`
--

CREATE TABLE pagecomments (
  idComment int(11) NOT NULL auto_increment,
  sCommentText text NOT NULL,
  sPageIdentifier varchar(100) NOT NULL default '',
  idUser int(11) default NULL,
  dCommentDate varchar(19) NOT NULL default '',
  PRIMARY KEY  (idComment),
  KEY idComment (idComment)
) TYPE=MyISAM;

--
-- Dumping data for table `pagecomments`
--


--
-- Table structure for table `songratings`
--

CREATE TABLE songratings (
  idSongRating int(11) NOT NULL auto_increment,
  idSong int(11) NOT NULL default '0',
  nRating float NOT NULL default '0',
  dRatingDate timestamp(14) NOT NULL,
  PRIMARY KEY  (idSongRating),
  KEY idSongRating (idSongRating)
) TYPE=MyISAM;

--
-- Dumping data for table `songratings`
--

INSERT INTO songratings VALUES (94,1,-2,20030809173804);
INSERT INTO songratings VALUES (95,1,5,20030809190220);
INSERT INTO songratings VALUES (96,1,0,20030809190235);
INSERT INTO songratings VALUES (97,1,1,20030809190239);
INSERT INTO songratings VALUES (98,1,0,20030809190245);
INSERT INTO songratings VALUES (99,1,1,20030809190248);
INSERT INTO songratings VALUES (100,1,0,20030809190250);
INSERT INTO songratings VALUES (101,1,4,20030810153532);
INSERT INTO songratings VALUES (102,1,3,20030810153537);
INSERT INTO songratings VALUES (103,1,-2,20030810160646);
INSERT INTO songratings VALUES (104,1,-1,20030810160653);
INSERT INTO songratings VALUES (105,1,-2,20030810160658);
INSERT INTO songratings VALUES (106,1,-1,20030810160703);
INSERT INTO songratings VALUES (107,1,-2,20030810160707);
INSERT INTO songratings VALUES (108,4,-2,20030813040201);
INSERT INTO songratings VALUES (109,4,1,20030813040204);
INSERT INTO songratings VALUES (110,4,0,20030813040213);
INSERT INTO songratings VALUES (111,4,2,20030813040217);
INSERT INTO songratings VALUES (112,1,-2,20030813190438);
INSERT INTO songratings VALUES (113,1,-1,20030813190450);
INSERT INTO songratings VALUES (114,1,0,20030813190454);
INSERT INTO songratings VALUES (115,1,1,20030813190457);
INSERT INTO songratings VALUES (116,1,-2,20030813190502);
INSERT INTO songratings VALUES (117,4,1,20030813190510);
INSERT INTO songratings VALUES (118,1,-1,20030814010703);
INSERT INTO songratings VALUES (119,1,2,20030814010734);
INSERT INTO songratings VALUES (120,1,-2,20030814010740);
INSERT INTO songratings VALUES (121,3,1,20030820150908);
INSERT INTO songratings VALUES (122,2,2,20030820150919);
INSERT INTO songratings VALUES (123,5,4,20030820150923);
INSERT INTO songratings VALUES (124,5,3,20030820150927);
INSERT INTO songratings VALUES (125,5,4,20030820150931);
INSERT INTO songratings VALUES (126,2,5,20030820150936);
INSERT INTO songratings VALUES (127,1,-1,20030823152901);
INSERT INTO songratings VALUES (128,1,-2,20030823163653);
INSERT INTO songratings VALUES (129,1,1,20030823163730);
INSERT INTO songratings VALUES (130,1,-2,20030823164416);
INSERT INTO songratings VALUES (131,1,-2,20030823164420);
INSERT INTO songratings VALUES (132,1,2,20030823173255);
INSERT INTO songratings VALUES (133,1,2,20030823173308);
INSERT INTO songratings VALUES (134,1,2,20030823173315);
INSERT INTO songratings VALUES (135,1,1,20030823173322);
INSERT INTO songratings VALUES (136,1,1,20030823201047);
INSERT INTO songratings VALUES (137,1,-1,20030823205242);
INSERT INTO songratings VALUES (138,1,1,20030823205308);
INSERT INTO songratings VALUES (139,1,2,20030823205317);
INSERT INTO songratings VALUES (140,1,1,20030823205325);
INSERT INTO songratings VALUES (141,1,2,20030823205449);
INSERT INTO songratings VALUES (142,1,-1,20030927041546);
INSERT INTO songratings VALUES (143,1,0,20030927041655);
INSERT INTO songratings VALUES (144,3,0,20030927150112);
INSERT INTO songratings VALUES (145,1,-1,20030927151954);
INSERT INTO songratings VALUES (146,1,-1,20030927152037);
INSERT INTO songratings VALUES (147,1,1,20030927214418);
INSERT INTO songratings VALUES (148,1,2,20030927214425);
INSERT INTO songratings VALUES (149,1,1,20030927214430);
INSERT INTO songratings VALUES (150,1,2,20030927214432);
INSERT INTO songratings VALUES (151,1,1,20030927214437);
INSERT INTO songratings VALUES (152,1,0,20030927222424);
INSERT INTO songratings VALUES (153,1,0,20030927222658);
INSERT INTO songratings VALUES (154,1,1,20030927222926);
INSERT INTO songratings VALUES (155,1,-1,20030927235241);
INSERT INTO songratings VALUES (156,3,-1,20031006141526);
INSERT INTO songratings VALUES (157,3,1,20031006141534);
INSERT INTO songratings VALUES (158,5,1,20031006142625);
INSERT INTO songratings VALUES (159,5,-2,20031006142633);
INSERT INTO songratings VALUES (160,5,1,20031006144255);

--
-- Table structure for table `songs`
--

CREATE TABLE songs (
  idSong int(11) NOT NULL auto_increment,
  sSongName varchar(50) NOT NULL default '',
  sFileName varchar(50) NOT NULL default '',
  idArtist int(11) NOT NULL default '0',
  PRIMARY KEY  (idSong),
  KEY idSong (idSong)
) TYPE=MyISAM;

--
-- Dumping data for table `songs`
--

INSERT INTO songs VALUES (1,'Heart of Glass','HeartOfGlass.mp3',1);
INSERT INTO songs VALUES (2,'The Tide is High','TideIsHigh.mp3',1);
INSERT INTO songs VALUES (3,'Seattle Rocks','SeattleRocks.mp3',2);
INSERT INTO songs VALUES (4,'Kim the Waitress','KimTheWaitress.mp3',3);
INSERT INTO songs VALUES (5,'Pam the Redhead','PamTheRedhead.mp3',3);

--
-- Table structure for table `users`
--

CREATE TABLE users (
  idUser int(11) NOT NULL auto_increment,
  sUserName varchar(50) NOT NULL default '',
  sPassword varchar(100) NOT NULL default '',
  sRightList varchar(100) default NULL,
  PRIMARY KEY  (idUser),
  KEY idUser (idUser)
) TYPE=MyISAM;

--
-- Dumping data for table `users`
--

INSERT INTO users VALUES (1,'nate','flash','secureItem1,secureItem2');
INSERT INTO users VALUES (2,'winona','flash','secureItem2');

