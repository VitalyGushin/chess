	DROP TABLE IF EXISTS #__chess_game;
	DROP TABLE IF EXISTS #__chess_move;
	
	CREATE TABLE IF NOT EXISTS #__chess_game (
	  game_id int(11) unsigned NOT NULL auto_increment,
	  fork_from_game_id int(11) unsigned NOT NULL default '0',
	  start datetime NOT NULL default '0000-00-00 00:00:00',
	  white_user_id int(11) unsigned NOT NULL default '0',
	  black_user_id int(11) unsigned NOT NULL default '0',
	  result int(1) unsigned NOT NULL default '0',
	  complete int(2) unsigned NOT NULL default '0',
	  notify_white int(1) unsigned NOT NULL default '0',
	  notify_black int(1) unsigned NOT NULL default '0',
	  draw_offered int(1) unsigned NOT NULL default '0',
	  discuss_url varchar(255) default NULL,
	  comment varchar(255) default NULL,
	  PRIMARY KEY  (game_id),
	  KEY white_user (white_user_id),
	  KEY black_user (black_user_id),
	  KEY fork_from_game_id (fork_from_game_id)
	) TYPE=MyISAM;

	CREATE TABLE IF NOT EXISTS #__chess_move (
	  game_id int(11) unsigned NOT NULL default '0',
	  move_no int(11) unsigned NOT NULL default '0',
	  color int(1) unsigned NOT NULL default '0',
	  move varchar(100) NOT NULL default '',
	  comment mediumtext,
	  entered datetime NOT NULL default '0000-00-00 00:00:00',
	  PRIMARY KEY  (game_id,move_no,color)
	) TYPE=MyISAM;
