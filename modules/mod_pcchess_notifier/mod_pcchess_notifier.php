<?php
  /* Notifier Module for PCChess
     (c) 2010 by Hartmut Eilers <hartmut@eilers.net>
     This module searches for the number of open challenges and
     the number of games waiting for a move of the logged in user
     $Id: mod_pcchess_notifier.php,v 1.2 2010-04-23 08:35:35 hartmut Exp $
	 Modified version of mod_pcchess_notifier.php, v2.0.1, 2011-04-01 by Marian Tanase
  */
  
  # restrict access
  defined('_JEXEC') or die('Restricted access');

// New feature that allows individual module styling.
  $moduleclass_sfx = $params->get( 'moduleclass_sfx', '');

  /**************************************** LANGUAGE HANDLING ****************************************/
// Uncomment the next line and change SAMPLE to the appropriate language for the language files.
 //if (empty($pcchess_lang)) { $pcchess_lang = "it-IT"; }		// ensure a working default
//include_once(JPATH_SITE.DS.'modules/mod_pcchess_notifier/language/'.$pcchess_lang.'.mod_pcchess_notifier.ini');

// new language selection with backend modul
// if you don't use the backend you need to set the language by commenting out the
// following 4 lines and use one of the include statements before
//$params = &JComponentHelper::getParams( 'com_pcchess' );	// get the language parameter
//$pcchess_lang=$params->get('lang');
//if (empty($pcchess_lang)) { $pcchess_lang = "us"; }		// ensure a working default
//include_once(JPATH_SITE.DS.'/components/com_pcchess/languages/pcc.lang.'.$pcchess_lang.'.php');
/************************************** END LANGUAGE HANDLING **************************************/

  function GetGamesWaitingMove($userid) {
    // this code is copied and adapted from include.pcchess.php
    # this function searches all games waiting for a move of userid
    $db = &JFactory::getDbo();
    $query = "SELECT g.game_id, \n " . 
     "g.start, \n " . 
     "g.white_user_id, \n " . 
     "g.black_user_id, \n " . 
     "g.notify_white, \n " . 
     "g.notify_black, \n " . 
     "uw.username white_username, \n " . 
     "ub.username black_username, \n " . 
     "uw.email white_email, \n " . 
     "ub.email black_email, \n " . 
     "g.result,  \n " . 
     "g.complete, \n " . 
     "g.draw_offered,  \n " . 
     "g.comment, \n " . 
     "g.discuss_url,  \n " .   
	 "MAX(m.move_no + m.color/10) move_and_color, \n " . 
     "MAX(m.move_no) last_move_no, \n " . 
     "((MAX(m.move_no + m.color/10) - MAX(m.move_no))*10) last_move_color, \n " . 
     "COALESCE(COUNT(m.move_no),0) total_no_moves, \n" . 
	 "MAX(m.entered) last_move \n " . 
     "FROM (#__chess_game g \n " . 
     "LEFT JOIN #__users uw ON g.white_user_id = uw.id \n " . 
     "LEFT JOIN #__users ub ON g.black_user_id = ub.id) \n " . 
     "LEFT JOIN #__chess_move m ON g.game_id = m.game_id \n " . 
     "WHERE " . 'g.complete = 0 AND (g.white_user_id = ' . $userid . ' OR g.black_user_id = ' . $userid . ')' . " \n" .
	 "GROUP BY g.game_id, \n " . 
     "g.start, \n " . 
     "g.white_user_id, \n " . 
     "g.black_user_id, \n " . 
     "uw.username, \n " . 
     "ub.username, \n " . 
     "g.result,  \n " . 
     "g.comment, \n " . 
     "g.discuss_url,  \n " .   
     "g.complete, \n " . 
     "g.draw_offered  \n " . 
     "HAVING " . 'COALESCE(IF(g.white_user_id = ' . $userid . ', ((MAX(m.move_no + m.color/10) - MAX(m.move_no))*10) <> 0, ' .
				'((MAX(m.move_no + m.color/10) - MAX(m.move_no))*10) = 0),0) OR ' .
				'((COALESCE(COUNT(m.move_no),0) = 0) AND (g.white_user_id = ' . $userid . '))' . " \n" .
     "ORDER BY last_move DESC, g.start ASC ";
    $db->setQuery( $query );
    return $db->loadObjectList();
  }

  # the next lines pulls module parameters which we currently
  # do not have !
  #$items = $params->get('items', 1);
  
  # prepare query for open challenges 
  # open challenges are those rows where the field complete is set to 2
  $db =&JFactory::getDBO();
  $query = "SELECT * FROM #__chess_game WHERE complete = '2'";
  $db->setQuery( $query);
  $rows = $db->loadObjectList();
  # count the rows and print the result
  $Amount = 0;
  foreach($rows as $row) {
    #echo '<a href="' . JRoute::_('index.php?option=com_reviews&id=' . $row->id . '&task=view') . '">' . $row->name . '</a><br />';
    $Amount=$Amount+1;
  }
  
  if ( $Amount != 0) {
	echo '<strong>' . $Amount . '</strong>';
		if ( $Amount == 1){
			echo ' ' .JText::_('CHALLENGE'). '<br />';
			}
		else
			echo ' ' .JText::_('CHALLENGES'). '<br />';
	}
  else
	echo JText::_('NOCHALLENGES'). '<br />';
 
 
 
  # get the number of games awaiting a move of logged in user
  $user = &JFactory::getUser();
  $userid = $user->get('id');
  
  # only search for waiting games when the user is logged in
  if ( $userid != 0 ) {
    #echo $userid . '<br>';
    $game_list=GetGamesWaitingMove($userid);
    # count the games waiting for a move of user
    $Amount = 0;
    foreach ($game_list as $row) {
      $Amount=$Amount+1;
    }
	
    if ( $Amount != 0) {
		echo '<strong>' . $Amount . '</strong>';
			if ( $Amount == 1){
				echo ' ' .JText::_('GAMEWAITING'). '<br />';
				}
			else
				echo ' ' .JText::_('GAMESWAITING'). '<br />';
	}
	else
		echo JText::_('NOGAMEWAITING'). '<br />';
  }  
  
?>
