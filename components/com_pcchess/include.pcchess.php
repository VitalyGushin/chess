<?php
// PCChess Component//
/**
* Content code
* @ Package PCChess
* @ Copyright (C) 2005 Robert Prince
* @ All rights reserved
* @ PCChess is Free Software
* @ Released under GNU/GPL License : http://www.gnu.org/copyleft/gpl.html
* @ version $Id: include.pcchess.php,v 2.0 2010-08-16 17:00:00 marian Exp $
**/
defined( '_JEXEC' ) or die( 'Restricted access' );


/**************************************** LANGUAGE HANDLING ****************************************/
// Leave the next line in for all languages:
include(JPATH_SITE.DS.'administrator/components/com_pcchess/language/pcc.lang.us.php');

// Uncomment the next line and change SAMPLE to the appropriate language for the language files.
// include_once(JPATH_SITE.DS.'administrator/components/com_pcchess/language/pcc.lang.SAMPLE.php');

// new language selection with backend modul
// if you don't use the backend you need to set the language by commenting out the
// following 4 lines and use one of the include statements before
// $params = &JComponentHelper::getParams( 'com_pcchess' );	// get the language parameter
// $pcchess_lang=$params->get('lang');
// if (empty($pcchess_lang)) { $pcchess_lang = "it"; }		// ensure a working default
// include_once(JPATH_SITE.DS.'administrator/components/com_pcchess/language/pcc.lang.'.$pcchess_lang.'.php');
/************************************** END LANGUAGE HANDLING **************************************/

include_once(JPATH_SITE.DS.'/components/com_pcchess/chess.inc.php');

// General Functions

function pcc_UBBreplace( $var )
// Adapted from a function by Kirk Bushell.
// Obtained from http://www.liquidpulse.net/code/php/formatting/ubb_regular_expression_function
{
  # Strip any HTML tags
  $var = preg_replace( "/<\/?[^\\<>|\/]*>/", "", $var );

  # Bold, underline, and italic UBB tags
  $var = preg_replace( "/\[b\](.+)\[\/b\]/", "<b>\\1</b>", $var );
  $var = preg_replace( "/\[u\](.+)\[\/u\]/", "<u>\\1</u>", $var );
  $var = preg_replace( "/\[i\](.+)\[\/i\]/", "<i>\\1</i>", $var );

  # UBB Url tags
  $var = preg_replace( "/\[url=(.+)\](.+)\[\/url\]/", "<a href=\"\\1\">\\2</a>", $var );

  return $var;
}

function pcc_ConvertTextToList($text, $classname, $order=0) {
	return (empty($text) ? "" : "<" . ($order == 0 ? "ul" : "ol") . " class=\"" . $classname . "\">\n"
	 . pcc_ConvertLBToLI($text, $classname)
	 . "</" . ($order == 0 ? "ul" : "ol") . ">\n");
}

function pcc_ConvertLBToLI($text, $classname) {
	$text = preg_replace("/(\r\n|\n|\r)/", "\n", $text); // cross-platform newlines
	$text = preg_replace("/\n\n+/", "\n\n", $text); // take care of duplicates
	$text = preg_replace('/\n?(.+?)(\n|\z)/s', "<li class=\"" . $classname . "\">$1</li>\n", $text);
	return $text;
}

function pcc_ConvertLBToBR($text) {
	$text = str_replace("\r\n", "\n", $text);
	$text = str_replace("\n", "<br />", $text);
	return $text;
}

function pcc_ConvertLBToSpace($text) {
	$text = str_replace("\r\n", "\n", $text);
	$text = str_replace("\n", " ", $text);
	return $text;
}

function pcc_AddOverlibCall($pcontent) {
	$content = str_replace("'","\\'", $pcontent);
	$content = str_replace("<", "\\u003C",$content);
	$content = str_replace(">", "\\u003E",$content);
	return (empty($content) ? "" : " onmouseover=\"return overlib('" . $content . "');\" onmouseout=\"return nd();\"");
}

//Echo Functions
// Displays Statistics Table
function pcc_EchoPlayerList($player_list, $breakout=0) {
	global $pcc_lang;
	if (empty($player_list)) {
		echo "<h2>" . $pcc_lang['no_players'] . "</h2>";
	} else {
		//echo "<h2>" . $pcc_lang['player_list_title'] . "</h2>\n";
		echo "<table class=\"pcc_gamelist\" cellpadding=\"0\" cellspacing=\"0\">\n";
		echo "<tr><th class=\"pcc_gamelist\">" . $pcc_lang['player_list_th_player'] . "</th>" .
		 "<th class=\"pcc_gamelist\">" . $pcc_lang['player_list_th_profil'] . "</th>" .
		 "<th class=\"pcc_gamelist_mid\">" . $pcc_lang['player_list_th_active'] . "</th>" .
		 "<th class=\"pcc_gamelist_mid\">" . $pcc_lang['player_list_th_complete'] . "</th>" .
		 "<th class=\"pcc_gamelist_mid\">" . $pcc_lang['player_list_th_wins'] . "</th>" .
		 "<th class=\"pcc_gamelist_mid\">" . $pcc_lang['player_list_th_draws'] . "</th>" .
		 "<th class=\"pcc_gamelist_mid\">" . $pcc_lang['player_list_th_points'] . "</th>";
		if ($breakout==1) {
			echo
			 "<th class=\"pcc_gamelist\">" . $pcc_lang['player_list_th_active_white'] . "</th>" .
			 "<th class=\"pcc_gamelist\">" . $pcc_lang['player_list_th_complete_white'] . "</th>" .
			 "<th class=\"pcc_gamelist\">" . $pcc_lang['player_list_th_wins_white'] . "</th>" .
			 "<th class=\"pcc_gamelist\">" . $pcc_lang['player_list_th_draws_white'] . "</th>" .
			 "<th class=\"pcc_gamelist\">" . $pcc_lang['player_list_th_active_black'] . "</th>" .
			 "<th class=\"pcc_gamelist\">" . $pcc_lang['player_list_th_complete_black'] . "</th>" .
			 "<th class=\"pcc_gamelist\">" . $pcc_lang['player_list_th_wins_black'] . "</th>" .
			 "<th class=\"pcc_gamelist\">" . $pcc_lang['player_list_th_draws_black'] . "</th>";
		}
		echo "</tr>\n";
		foreach ($player_list as $row) {
			$atag = "<a href=\"" . JRoute::_("index.php?option=com_pcchess&Itemid=" . pcc_GetItemIdPlayersMenuID() .
			 "&page=players&user_id=" . $row->id) . "\">";
			$compro = "<a href=\"" . JRoute::_("index.php?option=com_community&view=profile&userid=" . $row->id ) . "\">";
			$id = $row->id;
			//$dop = pcc_GetUserDop($id);
			$dop = $row->dop;
			$points = ($row->wins_white + $row->wins_black + ($row->draws_white + $row->draws_black + $dop)/2 );
			echo "<tr><td class=\"pcc_gamelist\" width=\"150px\">" .  $atag . $row->username . "</a></td>" .
			 "<td class=\"pcc_gamelist\" width=\"auto\"> </a></td>" .  //" .  $compro . "[+]" . "
			 "<td class=\"pcc_gamelist_mid\">" .  ($row->active_games_white + $row->active_games_black) . "</td>" .
			 "<td class=\"pcc_gamelist_mid\">" .  ($row->complete_games_white + $row->complete_games_black) . "</td>" .
			 "<td class=\"pcc_gamelist_mid\">" .  ($row->wins_white + $row->wins_black) . "</td>" .
			 "<td class=\"pcc_gamelist_mid\">" .  ($row->draws_white + $row->draws_black) . "</td>" .
			 "<td class=\"pcc_gamelist_mid\">" .  $points . "</td>";
			if ($breakout==1) {
				echo "<td class=\"pcc_gamelist\">" .  $row->active_games_white  . "</td>" .
				 "<td class=\"pcc_gamelist\">" .  $row->complete_games_white . "</td>" .
				 "<td class=\"pcc_gamelist\">" .  $row->wins_white . "</td>" .
				 "<td class=\"pcc_gamelist\">" .  $row->draws_white . "</td>" .
				 "<td class=\"pcc_gamelist\">" .  $row->active_games_black . "</td>" .
				 "<td class=\"pcc_gamelist\">" .  $row->complete_games_black . "</td>" .
				 "<td class=\"pcc_gamelist\">" .  $row->wins_black . "</td>" .
				 "<td class=\"pcc_gamelist\">" .  $row->draws_black . "</td>";
			}
			echo "</tr>\n";
		}
		echo "</table>\n";
	}
}

function pcc_EchoNewGameForm() {
	global $pcc_lang;

	// replacement for global $my variable
	$user = &JFactory::getUser();
	$userid = $user->get('id');

	$submiturl = JRoute::_("index.php?option=com_pcchess&Itemid=" . pcc_GetItemIdNewGameMenuID() . "&page=newchallenge");
	$playerlist = pcc_GetAllPlayers();
?>
<div class="activegames">
<h2><?php echo $pcc_lang['new_game_form_heading'] ?></h2>

<!-- START form - open challenge -->
<form action="<?php echo $submiturl ?>" method="post" name="pcc_data" class="pcchess_forminput">
	<input name="page" type="hidden" value="newchallenge">
	<input name="user_id" type="hidden" value="<?php echo $userid ?>">

	<div>
		<h4><?php echo $pcc_lang['new_game_form_opponent'] ?></h4>
		<select name="challenger_id">
		  <option value="0" selected="selected"><?php echo $pcc_lang['new_game_form_any_player'] ?></option>
		  <?php
		  foreach ($playerlist as $row) {
			  if (!($row->id == $userid)) {
				  echo "<option value=\"" . $row->id . "\">" . $row->username . "</option>\n";
			  }
		  }
			?>
		</select>
	</div>
	<div>
		<h4><?php echo $pcc_lang['new_game_form_color'] ?></h4>
		<input name="color" type="radio" value="0" checked="checked"><?php echo $pcc_lang['new_game_form_white'] ?><br />
		<input name="color" type="radio" value="1"><?php echo $pcc_lang['new_game_form_black'] ?>
	</div>

	<div>
		<h4><?php echo $pcc_lang['new_game_form_notification'] ?></h4>
		<input name="notify" type="radio" value="1"><?php echo $pcc_lang['new_game_form_notification_no'] ?><br />
		<input name="notify" type="radio" value="0" checked="checked"><?php echo $pcc_lang['new_game_form_notification_yes'] ?>
	</div>

	<div>
		<h4><?php echo $pcc_lang['new_game_form_comment_head'] ?></h4>
		<textarea name="comment" cols="50" rows="5"></textarea><br /><br />
		<input name="submit_pcc_data" type="submit" class="button" value="<?php echo $pcc_lang['create_game_notification'] ?>">
	</div>
</form>
<!-- END form - open challenge -->

</div>

<?php
}

function pcc_EchoForkGameForm($game_info, $move, $color) {
	global $pcc_lang;

	// replacement for global $my variable
	$user = &JFactory::getUser();
	$userid = $user->get('id');

	$submiturl = JRoute::_("index.php?option=com_pcchess&Itemid=" . pcc_GetItemIdNewGameMenuID() . "&page=forkgame");
	if (!empty($userid)) {
		?>
		<form action="<?php echo $submiturl ?>" method="post" name="pcc_fork" class="pcchess_forkgameform">
		<input name="page" type="hidden" value="forkgame">
		<input name="user_id" type="hidden" value="<?php echo $userid ?>">
		<input name="game_id" type="hidden" value="<?php echo $game_info->game_id ?>">
		<input name="move" type="hidden" value="<?php echo $move ?>">
		<input name="color" type="hidden" value="<?php echo $color ?>">
		<select name="forkgame" onChange="this.form.fork_game_go.disabled = (this.form.forkgame.selectedIndex == 0);">
		<option value="0"><?php echo $pcc_lang['fork_game_first_option'] ?></option>
		<?php if ((($game_info->white_user_id == $userid) || ($game_info->black_user_id == $userid))) {
			echo "  <option value=\"1\">" . $pcc_lang['fork_game_same_players'] . "</option>\n" .
			 "  <option value=\"2\">" . $pcc_lang['fork_game_switch_sides'] . "</option>";
		} ?>
 	  	<option value="3"><?php echo $pcc_lang['fork_game_open_white'] ?></option>
	  	<option value="4"><?php echo $pcc_lang['fork_game_open_black'] ?></option>
		</select>&nbsp;<input name="fork_game_go" id="fork_game_go" type="submit" value="<?php echo $pcc_lang['forms_go'] ?>" disabled="disabled"></form>
		<?php
	}
}

function pcc_ProcessForkGame($game_id, $move, $color, $forkgame, $user_id) {
	global $pcc_lang;

	// replacement for global $my variable
	$user = &JFactory::getUser();
	$userid = $user->get('id');

	// replacement for global $database variable
	$db = &JFactory::getDbo();

	if (! empty($userid)) {
		if (! ($userid == $user_id)) {
			echo "<p>" . $pcc_lang['process_fork_no_login'] . "</p>";
		} else {
			if (! (($color == "1") || ($color == "0"))) {
				echo "<p>" . $pcc_lang['process_fork_no_color'] . "</p>";
			} else {
				$game_info = pcc_GetInfoForOneGame($game_id);
				if (!empty($game_info)) {
					$last_move_no = ((0.0 + $move) <= $game_info->last_move_no ? 0.0 + $move : $game_info->last_move_no);
					$last_move_color = (((0.0 + $move) <= $game_info->last_move_no ? 0.0 + $color :
					 ((0.0 + $color) <= $game_info->last_move_color ? 0.0 + $color : $game_info->last_move_color)));
					if ($forkgame == 1) {
						$white_user_id = $game_info->white_user_id;
						$black_user_id = $game_info->black_user_id;
						$notify_white = $game_info->notify_white;
						$notify_black = $game_info->notify_black;
						$complete = ($game_info->white_user_id == $user_id ? 3 : 4);
					} elseif ($forkgame == 2) {
						$white_user_id = $game_info->black_user_id;
						$black_user_id = $game_info->white_user_id;
						$notify_white = $game_info->notify_black;
						$notify_black = $game_info->notify_white;
						$complete = ($game_info->white_user_id == $user_id ? 4 : 3);
					} elseif ($forkgame == 3) {
						$white_user_id = $user_id;
						$black_user_id = 0;
						$notify_white = ($game_info->white_user_id == $user_id ? $game_info->notify_white : $game_info->notify_black);
						$notify_black = 0;
						$complete = 2;
					} elseif ($forkgame == 4) {
						$white_user_id = 0;
						$black_user_id = $user_id;
						$notify_white = 0;
						$notify_black = ($game_info->white_user_id == $user_id ? $game_info->notify_white : $game_info->notify_black);
						$complete = 2;
					} else {
						echo "<p>" . sprintf($pcc_lang['process_fork_bad_fork'], $forkgame) . "</p>";
						return false;
					}
					$db->setQuery( "INSERT INTO #__chess_game (" .
					 "fork_from_game_id, \n" .
					 "start, \n" .
					 "white_user_id, \n" .
					 "black_user_id, \n" .
					 "result, \n" .
					 "complete, \n" .
					 "notify_white, \n" .
					 "notify_black, \n" .
					 "draw_offered, \n" .
					 "comment) \n" .
					 "VALUES ( " .
					 $game_id . ", \n" .
					 "NOW(), \n" .
					 $white_user_id . ", \n" .
					 $black_user_id . ", \n" .
					 "0, \n" .
					 $complete . ", \n" .
					 $notify_white . ", \n" .
					 $notify_black . ", \n" .
					 "0, \n" .
					 "'" . htmlspecialchars(sprintf($pcc_lang['process_fork_comment'], $last_move_no,
					 ($last_move_color == 0 ? $pcc_lang['white'] : $pcc_lang['black']),
					 pcc_AwaitingChallengerName($game_info->white_username), pcc_AwaitingChallengerName($game_info->black_username),
					 date($pcc_lang['date_format'],  strtotime($game_info->start))),ENT_QUOTES) . "')");

					$db->query();

					$db->setQuery("SELECT LAST_INSERT_ID()");
					$new_game_id = $db->loadResult();

					$move_list = pcc_GetGameMoveList($game_id, $last_move_no, $last_move_color);

					$query = "INSERT INTO #__chess_move (" .
					 "game_id, " .
					 "move_no, " .
					 "color, " .
					 "move, " .
					 "comment, " .
					 "entered) \n" .
					 "VALUES ";
					$i = 0;
					foreach ($move_list as $row) {
						$i = $i + 1;
						if ($row->addmove == 1) {
							$query = $query . ($i == 1 ? " \n" : ", \n") . "(" .
							 $new_game_id . ", " .
							 $row->move_no . ", " .
							 $row->color . ", " .
							 "'" . $row->move . "', " .
							 ((($row->move_no == $last_move_no) && ($row->color == $last_move_color)) ?
							  "'" . $pcc_lang['process_fork_last_move'] . "'" : "''") . ", " .
							 "NOW())";
						} else {
							break;
						}
					}
					$db->setQuery( $query );
					$db->query();

					pcc_EchoGame($new_game_id, 1000, 1);
				} else {
					echo "<p>" . sprintf($pcc_lang['game_not_found'], $game_id) . "</p>";
				}
			}
		}
	} else {
		echo "<p>" . $pcc_lang['process_fork_no_login'] . "</p>";
	}
}

function pcc_EchoAcceptGameForm($game_info) {
	global $pcc_lang;

	// replacement for global $my variable
	$user = &JFactory::getUser();
	$userid = $user->get('id');


	if (! empty($userid)) {
		if ($game_info->complete == 3) {
			$acceptcolor = 1;
			$specific = true;
		} elseif ($game_info->complete == 4) {
			$acceptcolor = 0;
			$specific = true;
		} else {
			$acceptcolor = ($game_info->white_user_id == 0 ? 0 : 1);
			$specific = false;
		}
		echo "<h2>" . sprintf($pcc_lang['accept_game_header'], ($acceptcolor == 1 ? $pcc_lang["Black"] : $pcc_lang["White"]),
		 ($acceptcolor == 1 ? pcc_AwaitingChallengerName($game_info->white_username) : pcc_AwaitingChallengerName($game_info->black_username))) . "</h2>\n";
		if (!empty($game_info->comment)) {
			echo "<p>" . $game_info->comment . "<p>\n";
		}
		$submiturl = JRoute::_("index.php?option=com_pcchess&Itemid=" . pcc_GetItemIdNewGameMenuID() .
		 "&page=acceptchallenge");
		$declineurl = JRoute::_("index.php?option=com_pcchess&Itemid=" . pcc_GetItemIdNewGameMenuID() .
		 "&page=declinechallenge&game_id=" . $game_info->game_id);
?>
	<form action="<?php echo $submiturl ?>" method="post" name="pcc_data" class="pcchess_forminput">
	<input name="page" type="hidden" value="acceptchallenge">
	<input name="game_id" type="hidden" value="<?php echo $game_info->game_id ?>">
	<input name="user_id" type="hidden" value="<?php echo $userid ?>">
	<input name="notify" type="radio" value="1"> <?php echo $pcc_lang['accept_game_no_notify'] ?><br />
	<input name="notify" type="radio" value="0" checked="checked"> <?php echo $pcc_lang['accept_game_notify'] ?><br />
	<input name="submit_pcc_data" type="submit" value="<?php echo $pcc_lang['accept_game_accept'] ?>">&nbsp;<?php if ($specific) {?><input name="decline_pcc_game" type="button" onClick="MM_goToURL('parent','<?php echo $declineurl ?>');return document.MM_returnValue" value="<?php echo $pcc_lang['accept_game_decline'] ?>"><?php } ?>
	</form>
<?php
		if ($game_info->total_no_moves > 0) {
			if (array_key_exists('move', $_REQUEST)) {
				$move = $_REQUEST['move'];
				if (array_key_exists('color', $_REQUEST)) {
					$color = $_REQUEST['color'];
				} else {
					$color = "1";
				}
			} else {
				$move = "100000";
				$color = "1";
			}
			pcc_EchoGame($game_info->game_id, $move, $color, '', '', -1, '', true);
		}
	} else {
		echo "<p>" . $pcc_lang['accept_game_no_login'] . "</p>";
	}
}

function pcc_EchoRevokeChallengeForm($game_info) {
	global $pcc_lang;

	// replacement for global $my variable
	$user = &JFactory::getUser();
	$userid = $user->get('id');


	if (! empty($userid)) {
		echo "<h2>" . sprintf($pcc_lang['revoke_game_header'], pcc_AwaitingChallengerName($game_info->white_username),
		 pcc_AwaitingChallengerName($game_info->black_username)) . "</h2>\n";
		if (!empty($game_info->comment)) {
			echo "<p>" . $game_info->comment . "<p>\n";
		}
		echo "<p>" . $pcc_lang['revoke_game_warn'] . "<p>\n";
		$declineurl = JRoute::_("index.php?option=com_pcchess&Itemid=" . pcc_GetItemIdNewGameMenuID() .
		 "&page=revokechallenge&game_id=" . $game_info->game_id);
?>
	<form action="<?php echo $declineurl ?>" method="post" name="pcc_data" class="pcchess_forminput">
	<input name="decline_pcc_game" type="button" onClick="MM_goToURL('parent','<?php echo $declineurl ?>');return document.MM_returnValue" value="<?php echo $pcc_lang['revoke_game_revoke'] ?>">
	</form>
<?php
		if ($game_info->total_no_moves > 0) {
			if (array_key_exists('move', $_REQUEST)) {
				$move = $_REQUEST['move'];
				if (array_key_exists('color', $_REQUEST)) {
					$color = $_REQUEST['color'];
				} else {
					$color = "1";
				}
			} else {
				$move = "100000";
				$color = "1";
			}
			pcc_EchoGame($game_info->game_id, $move, $color, '', '', -1, '', true);
		}
	} else {
		echo "<p>" . $pcc_lang['revoke_game_no_login'] . "</p>";
	}
}

function pcc_ProcessDeclineGame($game_id) {
	global $pcc_lang;
	// replacement for global $database variable
	$db = &JFactory::getDbo();

	// replacement for global $my variable
	$user = &JFactory::getUser();
	$userid = $user->get('id');

	if (! empty($userid)) {
		$game_info = pcc_GetInfoForOneGame($game_id);
		if (empty($game_info)) {
			echo "<p>" . sprintf($pcc_lang['game_not_found'], $game_id) . "</p>";
		} elseif ($game_info->complete < 2) {
			echo "<p>" . $pcc_lang['decline_already_begun'] . "</p>";
		} elseif (! ((($game_info->white_user_id == $userid) && ($game_info->complete == 4)) ||
		 (($game_info->black_user_id == $userid) && ($game_info->complete == 3)))) {
			echo "<p>" . $pcc_lang['decline_not_specific'] . "</p>";
		} else {
			$acceptcolor = ($game_info->complete == 4 ? 0 : 1);
			$from = $user->get('email');
			$fromname = $user->get('name');
			if ($acceptcolor == 0) {
				$notify_opponent = $game_info->notify_black;
				$user_name_opponent = $game_info->black_username;
				$recipient = $game_info->black_email;
			} else {
				$notify_opponent = $game_info->notify_white;
				$user_name_opponent = $game_info->white_username;
				$recipient = $game_info->white_email;
			}
			pcc_DeleteGame($game_info->game_id);
			if ($notify_opponent == 0) {
				$emailsent = false;
			} else {
				$subject = sprintf($pcc_lang['decline_subject'], $fromname);
				$body = sprintf($pcc_lang['decline_body'], $fromname, ($acceptcolor == "1" ? $pcc_lang["black"] : $pcc_lang["white"]));
				$emailsent = JUtility::sendMail($from, $fromname, $recipient, $subject, $body);
			}
			echo "<p>" . sprintf(($emailsent ? $pcc_lang['decline_message_notify'] : $pcc_lang['decline_message_no_notify']),
			 $user_name_opponent, ($acceptcolor == "1" ? $pcc_lang["black"] : $pcc_lang["white"])) . "</p>";
		}
	} else {
		echo "<p>" . $pcc_lang['decline_no_login'] . "</p>";
	}
}

// STOPPED INTERNATIONALIZATION TEST THIS NEXT LINE

function pcc_RevokeChallenge($game_id) {
	global $pcc_lang;
	// replacement for global $database variable
	$db = &JFactory::getDbo();
	// replacement for global $my variable
	$user = &JFactory::getUser();
	$userid = $user->get('id');

	if (! empty($userid)) {
		$game_info = pcc_GetInfoForOneGame($game_id);
		if (empty($game_info)) {
			echo "<p>" . sprintf($pcc_lang['game_not_found'],$game_id) . "</p>";
		} elseif ($game_info->complete < 2) {
			echo "<p>" . $pcc_lang['revoke_already_begun'] . "</p>";
		} elseif (! (((($game_info->white_user_id == $userid) || ($game_info->black_user_id == $userid)) && ($game_info->complete == 2)) ||
		 (($game_info->white_user_id == $userid) && ($game_info->complete == 3)) ||
		 (($game_info->black_user_id == $userid) && ($game_info->complete == 4)))) {
			echo "<p>" . $pcc_lang['revoke_not_specific'] . "</p>";
		} else {
			$gamedescription = pcc_AwaitingChallengerName($game_info->white_username) . $pcc_lang['v'] . pcc_AwaitingChallengerName($game_info->black_username);
			pcc_DeleteGame($game_info->game_id);
			echo "<p>" . sprintf($pcc_lang['revoke_success'], $gamedescription) . "</p>";
		}
	} else {
		echo "<p>" . $pcc_lang['revoke_no_login'] . "</p>";
	}
}

function pcc_DeleteGame($game_id) {
	// replacement for global $database variable
	$db = &JFactory::getDbo();
	$query = "DELETE FROM #__chess_game WHERE game_id = " . $game_id . " LIMIT 1";
	$db->setQuery( $query ,1);
	$db->query();
	$query = "DELETE FROM #__chess_move WHERE game_id = " . $game_id;
	$db->setQuery( $query );
	$db->query();
}

function pcc_ProcessAcceptGame($game_id, $user_id, $notify) {
	global $pcc_lang;
	// replacement for global $database variable
	$db = &JFactory::getDbo();

	// replacement for global $my variable
	$user = &JFactory::getUser();
	$userid = $user->get('id');

	if (! empty($userid)) {
		if (! ($userid == $user_id)) {
			echo "<p>" . $pcc_lang['accept_no_login'] . "</p>";
		} else {
			$game_info = pcc_GetInfoForOneGame($game_id);
			if (empty($game_info)) {
				echo "<p>" . sprintf($pcc_lang['game_not_found'],$game_id) . "</p>";
			} elseif ((! (($game_info->white_user_id == 0) || ($game_info->black_user_id == 0))) &&
			 !(($game_info->complete == 3) || ($game_info->complete == 4))) {
				echo "<p>" . $pcc_lang['accept_already'] .
				 "<a href=\"" . pcc_GetGamehref($game_info) . "\">" .
				 pcc_AwaitingChallengerName($row->white_username) . $pcc_lang['v'] .
		 		 pcc_AwaitingChallengerName($row->black_username) . "</a></p>";
			} elseif (($game_info->complete == 2) || ($game_info->complete == 3) || ($game_info->complete == 4)) {
				$acceptcolor = ($game_info->complete == 2 ? ($game_info->white_user_id == 0 ? 0 : 1) : ($game_info->complete == 4 ? 0 : 1));
				$from = $user->get('email');
				$fromname = $user->get('username');
				if ($acceptcolor == 0) {
					$notify_opponent = $game_info->notify_black;
					$user_name_opponent = $game_info->black_username;
					$recipient = $game_info->black_email;
				} else {
					$notify_opponent = $game_info->notify_white;
					$user_name_opponent = $game_info->white_username;
					$recipient = $game_info->white_email;
				}
				$query = "UPDATE #__chess_game SET " .
				 "complete = 0, \n" .
				 (($acceptcolor == 0) ? "white_user_id" : "black_user_id") . " = " . $userid . ", \n" .
				 (($acceptcolor == 0) ? "notify_white" : "notify_black") . " = " . ($notify == "0" ? '0' : '1') . " \n" .
				 "WHERE game_id = " . $game_id;
				$db->setQuery( $query );
				$db->query();

				if ($notify_opponent == 0) {
					$emailsent = false;
				} else {
					$subject = $pcc_lang['accept_subject'];
					$url = pcc_GetGamehref($game_info);
					$body = sprintf($pcc_lang['accept_body'], $fromname, ($acceptcolor == "1" ? $pcc_lang["black"] : $pcc_lang["white"]), $url);
					$emailsent = JUtility::sendMail($from, $fromname, $recipient, $subject, $body);
				}
				pcc_EchoGame($game_id, 1000, 1, "<p>" . sprintf(($emailsent ? $pcc_lang['accept_opponent_notified'] :
				 $pcc_lang['accept_opponent_not_notified']),$user_name_opponent, ($acceptcolor == "1" ? $pcc_lang["black"] : $pcc_lang["white"])) . ".<br />" .
				 ($notify == "0" ? $pcc_lang['accept_you_will_not_be_notified'] : $pcc_lang['accept_you_will_be_notified']) . "</p>");
			} else {
				echo "<p>" . $pcc_lang['accept_unknown'] . "<p>";
			}
		}
	} else {
		echo "<p>" . $pcc_lang['accept_no_login'] . "</p>";
	}
}

function pcc_ProcessNewGame($user_id, $color, $notify, $comment, $challenger_id) {
	global $pcc_lang;
	// replacement for global $database variable
	$db = &JFactory::getDbo();

	// replacement for global $my variable
	$user = &JFactory::getUser();
	$userid = $user->get('id');

	//if (! empty($userid))
	//{
		//if (! ($userid == $user_id))
		//{
		//echo "<p>" . $pcc_lang['issue_challenge_no_login'] . "</p>";
		//}
		//else
		//{
			if (! (($color == "1") || ($color == "0"))) {
				echo "<p>" . $pcc_lang['issue_challenge_no_color'] . "</p>";
			} else {
				$white_user_id = ($color == "0" ? $user_id : $challenger_id);
				$black_user_id = ($color == "1" ? $user_id : $challenger_id);
				$notify_white = ($color == "0" ? ($notify == "0" ? '0' : '1') : 0);
				$notify_black = ($color == "1" ? ($notify == "0" ? '0' : '1') : 0);
				$complete = ($challenger_id == "0" ? 2 : $color + 3);
				$query = "INSERT INTO #__chess_game (white_user_id, black_user_id, notify_white, notify_black, complete, comment, start) \n"
				 . "VALUES ("
				 . $white_user_id . ", \n"
				 . $black_user_id . ", \n"
				 . $notify_white . ", \n"
				 . $notify_black . ", \n"
				 . $complete . ", \n"
				 . "'" . htmlspecialchars($comment, ENT_QUOTES) . "', \n"
				 . "NOW())";
				$db->setQuery( $query );
				$db->query();

			//	echo "<p>" . sprintf($pcc_lang['issue_message'], ($color == "0" ? $pcc_lang["black"] : $pcc_lang["white"])) . " " .
			//	 ($notify == "0" ? $pcc_lang['issue_you_will_not_be_notified'] : $pcc_lang['issue_you_will_be_notified']) . "</p>";
			}
		//}
	//}
		//else
		//{
		//echo "<p>" . $pcc_lang['issue_no_login'] . "</p>";
		//}
}

function pcc_ShowAddMoveForm($game_id, $message='', $pcc_move='', $pcc_notify=1, $pcc_comment='') {
	global $pcc_lang;

	// replacement for global $my variable
	$user = &JFactory::getUser();
	$userid = $user->get('id');

	$submiturl = JRoute::_("index.php?option=com_pcchess&Itemid=" . pcc_GetItemIdActiveGameMenuID() . "&page=submitmove");
	if (! empty($message)) {
		echo "<span class=\"pcchess_error\">" . $message . "</span>\n";
	}
	$checked = (($pcc_notify == 1) ? " checked=\"checked\"" : '');
	?>
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_popupHelp() { //v1.0
  alert(<?php echo $pcc_lang[add_form_help_text] ?>);
}
//-->
</script>
	<br/><form action="<?php echo $submiturl ?>" method="post" name="pcc_data">
	<input name="page" type="hidden" value="submitmove">
	<input name="game_id" type="hidden" value="<?php echo $game_id ?>">

<!-- START redesign form -->
<div class="comments">
<!-- http://css-tricks.com/creating-a-nice-textarea -->
<script type="text/javascript">
function setbg(color)
	{
	document.getElementById("styled").style.background=color
	}
</script>
<?php echo $pcc_lang['add_form_comment'] ?>          <!-- цвет поля комментариев как уберешь курсор-->
<textarea name="pcc_comment" id="styled" type="text" size="30" maxlength="255" onfocus="this.value=''; setbg('#ffffff');" onblur="setbg('#f6f6f6')" value="<?php echo htmlspecialchars($pcc_comment) ?>"></textarea> <!-- f8e1b8-->
</div>

<div class="move">
<p><?php echo $pcc_lang[add_form_move] ?></p>
<input name="pcc_Move" type="text" size="12" maxlength="8" value="<?php echo $pcc_move ?>">&nbsp;
<input name="submit_pcc_data" type="submit" value="<?php echo $pcc_lang['forms_go'] ?>">&nbsp;
<!-- <input name="Help" type="button" onClick="MM_popupHelp()" value="<?php echo $pcc_lang[add_form_help] ?>"> -->
<!-- check below to find why pop-up is not working ! -->
</div>

<div class="notify">
<input name="pcc_notify" type="checkbox" value="1"<?php echo $checked ?>>&nbsp;<?php echo $pcc_lang['add_form_notify'] ?>
</div>

<div class="info">
<p><?php echo $pcc_lang['info'] ?></p>
	<ul>
		<li><?php echo $pcc_lang['warn_resign'] ?></li>
		<li><?php echo $pcc_lang['warn_draw'] ?></li>
	</ul>
</div>
</form>
<!-- END redesign form -->

	<?php
}

function pcc_EchoNewGameList ($game_list) {
	global $pcc_lang;
	echo "<table class=\"pcc_gamelist\" cellpadding=\"0\" cellspacing=\"0\">\n";
	echo "<tr><th class=\"pcc_gamelist\">" . $pcc_lang['game_list_players'] . "</th><th class=\"pcc_gamelist\">" . $pcc_lang['game_list_status'] .
	 "</th><th class=\"pcc_gamelist\">" . $pcc_lang['game_list_started'] . "</th>" . "<th class=\"pcc_gamelist\">" . $pcc_lang['game_list_comments'] .
	 "</th></tr>\n";
	foreach ($game_list as $row) {
		$atag = "<a href=\"" . pcc_GetGamehref($row) . "\">";
		echo "<tr class=\"pcc_gamelist\"><td class=\"pcc_gamelist\">" . $atag . pcc_AwaitingChallengerName($row->white_username) . $pcc_lang['v'] .
		 pcc_AwaitingChallengerName($row->black_username) . "</a>" .
		 "</td><td class=\"pcc_gamelist\">" . pcc_GetGameStatus($row) .
		 "</td><td class=\"pcc_gamelist\">" . date($pcc_lang['date_format'],  strtotime($row->start))  .
		 "</td><td class=\"pcc_gamelist_comments\">" . pcc_ConvertLBToSpace(htmlspecialchars($row->comment)) . "</td></tr>\n";
	}
	echo "</table>\n";
}

function pcc_EchoGameList ($game_list, $showcomments = false) {
	global $pcc_lang;
	echo "<table class=\"pcc_gamelist\" cellpadding=\"0\" cellspacing=\"0\">\n";
	echo "<tr><th class=\"pcc_gamelist\">" . $pcc_lang['game_list_players'] . "</th><th class=\"pcc_gamelist\">" . $pcc_lang['game_list_status'] .
	 "</th><th class=\"pcc_gamelist\">" . $pcc_lang['game_list_started'] . "</th>" .
	 "<th class=\"pcc_gamelist\">" . $pcc_lang['game_list_num_moves'] . "</th><th class=\"pcc_gamelist\">" . $pcc_lang['game_list_last_move'] . "</th></tr>\n";
	foreach ($game_list as $row) {
		$atag = "<a href=\"" . pcc_GetGamehref($row) . "\">";
		echo "<tr class=\"pcc_gamelist\"><td class=\"pcc_gamelist\">" . $atag . pcc_AwaitingChallengerName($row->white_username) . $pcc_lang['v'] .
		 pcc_AwaitingChallengerName($row->black_username) . "</a>" .
		 "</td><td class=\"pcc_gamelist\">" . pcc_GetGameStatus($row) .
		 "</td><td class=\"pcc_gamelist\">" . date($pcc_lang['date_format'],  strtotime($row->start))  .
		 "</td><td class=\"pcc_gamelist\">" . round($row->move_and_color,0) .
		 "</td><td class=\"pcc_gamelist\">" . date($pcc_lang['date_format'],  strtotime($row->last_move)) . "</td></tr>\n";
		if ($showcomments && (! empty($row->comment))) {
			echo "<tr><td class=\"pcc_gamelist_comments\" colspan=\"5\">" . pcc_ConvertLBToSpace(htmlspecialchars($row->comment)) . "</td></tr>\n";
		}
	}
	echo "</table>\n";
}

function pcc_DrawGame($game_id, $pcc_comment) {
	global $pcc_lang;
	// replacement for global $database variable
	$db = &JFactory::getDbo();
	// replacement for global $my variable
	$user = &JFactory::getUser();
	$userid = $user->get('id');

	if (empty($userid)) {
		echo "<p>" . $pcc_lang['draw_no_login'] . "</p>";
	} elseif (empty($game_id)) {
		echo "<p>" . $pcc_lang['no_game_id'] . "</p>";
	} else {
		//Confirm game and user id.
		$game_info = pcc_GetInfoForOneGame($game_id);
		if (! (($game_info->white_user_id == $userid) || ($game_info->black_user_id == $userid))) {
			echo "<p>" . sprintf($pcc_lang['draw_wrong_player'], $game_info->white_username, $game_info->black_username) . "</p>";
		} else {
			$nextmovecolor = ($game_info->move_and_color == 0 ? 0 :
			 ((($game_info->move_and_color - round($game_info->move_and_color,0)) == 0) ? 1 : 0));
			$send = pcc_SendMoveEmail($game_id, $nextmovecolor, "DRAW", htmlspecialchars($pcc_comment, ENT_QUOTES));
			$emailmsg = ($send ? $pcc_lang['draw_message_notify'] : $pcc_lang['draw_message_no_notify']);
			$query = "UPDATE #__chess_game SET draw_offered = 1 \n WHERE game_id = " . $game_id;
			$db->setQuery( $query );
			$db->query();
			echo pcc_EchoGame($game_id, 1000, 1, $emailmsg);
		}
	}
}

// STOPPED INTERNATIONALIZATION TEST THIS NEXT LINE

function pcc_ResignGame($game_id, $pcc_comment) {
	global $pcc_lang;
	// replacement for global $database variable
	$db = &JFactory::getDbo();
	// replacement for global $my variable
	$user = &JFactory::getUser();
	$userid = $user->get('id');

	if (empty($userid)) {
		echo "<p>" . $pcc_lang['resign_no_login'] . "</p>";
	} elseif (empty($game_id)) {
		echo "<p>" . $pcc_lang['no_game_id'] . "</p>";
	} else {
		//Confirm game and user id.
		$game_info = pcc_GetInfoForOneGame($game_id);
		if (! (($game_info->white_user_id == $userid) || ($game_info->black_user_id == $userid))) {
			echo "<p>" . sprintf($pcc_lang['resign_wrong_player'], $game_info->white_username, $game_info->black_username) . "</p>";
		} else {
			$nextmovecolor = ($game_info->move_and_color == 0 ? 0 :
			 ((($game_info->move_and_color - round($game_info->move_and_color,0)) == 0) ? 1 : 0));
			$send = pcc_SendMoveEmail($game_id, $nextmovecolor, "RESIGN", htmlspecialchars($pcc_comment, ENT_QUOTES));
			$emailmsg = ($send ? $pcc_lang['resign_message_notify'] : $pcc_lang['resign_message_no_notify']);
			$query = "UPDATE #__chess_game SET result = " . ($nextmovecolor + 4 . ", \n"
			 . "complete = 1 \n"
			 . "WHERE game_id = " . $game_id);
			$db->setQuery( $query );
			$db->query();
			echo pcc_EchoGame($game_id, 1000, 1, $emailmsg);
		}
	}
}

function pcc_ProcessAcceptDraw($game_id, $accept) {
	global $pcc_lang;
	// replacement for global $database variable
	$db = &JFactory::getDbo();
	// replacement for global $my variable
	$user = &JFactory::getUser();
	$userid = $user->get('id');

	if (empty($userid)) {
		echo "<p>" . $pcc_lang['accept_draw_no_login'] . "</p>";
	} elseif (empty($game_id)) {
		echo "<p>" . $pcc_lang['no_game_id'] . "</p>";
	} else {
		//Confirm game and user id.
		$game_info = pcc_GetInfoForOneGame($game_id);
		if (! (($game_info->white_user_id == $userid) || ($game_info->black_user_id == $userid))) {
			echo "<p>" . sprintf($pcc_lang['accept_draw_wrong_player'], $game_info->white_username, $game_info->black_username) . "</p>";
		} else {
			$nextmovecolor = ($game_info->move_and_color == 0 ? 0 :
			 ((($game_info->move_and_color - round($game_info->move_and_color,0)) == 0) ? 1 : 0));
			$send = pcc_SendMoveEmail($game_id, 1-$nextmovecolor, ($accept ? "ACCEPT" : "REJECT"), htmlspecialchars($pcc_comment, ENT_QUOTES));
			$emailmsg = ($send ? ($accept ? $pcc_lang['accept_draw_accept_notify'] : $pcc_lang['accept_draw_reject_notify']) :
			 ($accept ? $pcc_lang['accept_draw_accept_no_notify'] : $pcc_lang['accept_draw_reject_no_notify']));
			$query = "UPDATE #__chess_game SET result = " . ($accept ? "3" : "0") . ", \n"
			 . "complete = " . ($accept ? "1" : "0") . ", \n"
			 . "draw_offered = 0 \n"
			 . "WHERE game_id = " . $game_id;
			$db->setQuery( $query );
			$db->query();
			echo pcc_EchoGame($game_id, 1000, 1, $emailmsg);
		}
	}
}

function pcc_AwaitingChallengerName($user_name) {
	global $pcc_lang;
	return (empty($user_name) ? $pcc_lang['awaiting_player'] : $user_name);
}

function pcc_GetGameStatus($game_info) {
	global $pcc_lang;
	if ($game_info->complete == 2) {
		return ($game_info->white_user_id == 0 ? $pcc_lang['game_status_awaiting_white'] : $pcc_lang['game_status_awaiting_black']);
	} elseif ($game_info->complete == 3) {
		// awaiting acceptance from black
		return $pcc_lang['game_status_awaiting_black'];
	} elseif ($game_info->complete == 4) {
		// awaiting acceptance from white
		return $pcc_lang['game_status_awaiting_white'];
	} elseif ($game_info->complete == 5) {
		// awaiting acceptance from white
		return $pcc_lang['game_status_admin_suspend'];
	} elseif ($game_info->draw_offered == 1) {
		return (($game_info->move_and_color == 0.0 || !( ($game_info->move_and_color - round($game_info->move_and_color,0)) == 0.0)) ?
		 $pcc_lang['game_status_white_draw_offer'] : $pcc_lang['game_status_black_draw_offer']);
	} elseif ($game_info->complete == 0) {
		return (($game_info->move_and_color == 0.0 || !( ($game_info->move_and_color - round($game_info->move_and_color,0)) == 0.0)) ?
		 $pcc_lang['game_status_white_to_move'] : $pcc_lang['game_status_black_to_move']);
	} else {
		if ($game_info->result == 0) {
			return $pcc_lang['game_status_white_mated_black'];
		} elseif ($game_info->result == 1) {
			return $pcc_lang['game_status_black_mated_white'];
		} elseif ($game_info->result == 2) {
			return $pcc_lang['game_status_stalemate'];
		} elseif ($game_info->result == 3) {
			return $pcc_lang['game_status_draw_agreed_to'];
		} elseif ($game_info->result == 4) {
			return $pcc_lang['game_status_white_resigned'];
		} elseif ($game_info->result == 5) {
			return $pcc_lang['game_status_black_resigned'];
		} else {
			return $pcc_lang['game_status_unknown_result'];
		}
	}
}

function pcc_EchoGame($game_id, $move, $color, $message='', $pcc_move='', $pcc_notify=-1, $pcc_comment='', $calledfromacceptgame=false) {
	global $Notation, $NotationList, $mainframe, $pcc_lang;
	#echo "DBG: GameID $game_id, Move $move, Color $color<br>";
	// replacement for global $my variable
	$user = &JFactory::getUser();
	$userid = $user->get('id');

	$game_info = pcc_GetInfoForOneGame($game_id);
	echo "<script type=\"text/javascript\" src=\"".JUri::base(true) ."/components/com_pcchess/js/overlib_mini.js\"></script>";
	if (empty($game_info)) {
		echo "<p>" . sprintf($pcc_lang['game_not_found'],$game_id) . "<p>";
	} else {
		pcc_SetItemID(pcc_GetGameItemId($game_info));
		if (empty($userid)) {
			$mygame = false;
		} else {
			$mygame = (($game_info->white_user_id == $userid) || ($game_info->black_user_id == $userid));
		}

		if ((!$calledfromacceptgame) && (($game_info->complete == 2) && (! $mygame) && (! empty($userid)))) {
			pcc_EchoAcceptGameForm($game_info);
		} elseif ((!$calledfromacceptgame) && (($game_info->complete == 3) && ($game_info->black_user_id == $userid) && (! empty($userid)))) {
			pcc_EchoAcceptGameForm($game_info);
		} elseif ((!$calledfromacceptgame) && (($game_info->complete == 4) && ($game_info->white_user_id == $userid) && (! empty($userid)))) {
			pcc_EchoAcceptGameForm($game_info);
		} elseif ((!$calledfromacceptgame) && ((((($game_info->white_user_id == $userid) || ($game_info->black_user_id == $userid)) && ($game_info->complete == 2)) ||
		 (($game_info->white_user_id == $userid) && ($game_info->complete == 3)) ||
		 (($game_info->black_user_id == $userid) && ($game_info->complete == 4))))) {
			if (empty($userid)) {
				pcc_EchoAcceptGameForm($game_info);
			} else {
				pcc_EchoRevokeChallengeForm($game_info);
			}
		} else {
			$mainframe->setPageTitle(pcc_AwaitingChallengerName($game_info->white_username) . $pcc_lang['v'] .
			 pcc_AwaitingChallengerName($game_info->black_username) . $pcc_lang['started'] . date($pcc_lang['date_format'],  strtotime($game_info->start)));
			$mainframe->appendPathWay(pcc_AwaitingChallengerName($game_info->white_username) . $pcc_lang['v'] .
			 pcc_AwaitingChallengerName($game_info->black_username));
			if (! $calledfromacceptgame) {
				echo "<h2 class=\"header1\">" . pcc_AwaitingChallengerName($game_info->white_username) . $pcc_lang['v'] .
				 pcc_AwaitingChallengerName($game_info->black_username) ."</h2>\n";
				echo "<p class=\"started_date\">" . $pcc_lang['game_list_started'] . date($pcc_lang['date_format'],  strtotime($game_info->start)) .  "</p>";
			} else {
				echo "<h2>" . $pcc_lang['echo_game_start_position'] . "</h2>\n";
			}
			$movelist = pcc_GetGameMoveList($game_id, $move, $color);
			if (read_Game($movelist, true)) {
				echo "<table class=\"pcchess_gamedisplay\">\n";
				echo "<tr>";
				echo "<td class=\"pcchess_gamedisplay\">";
				echo "<div class=\"frame\">"; // START the moves column.
				// Check if it's possible to replace TD's with DIV's.

				echo "<table class=\"pcchess_movelist\">\n";
				$openrow = false;

				$nummoves = 0;
				$nummovesshow = 0;
				$nextmove_no = "P";
				$prevmove_no = "N";
				$nextcolor = "0";
				foreach ($movelist as $row) {
					if ($row->color == 0) {
						echo "<tr>";
						$openrow = true;
						echo "<td class=\"pcchess_movelist\">" . $row->move_no . ".</td>";
					}

					$atag = "<a href=\"" . pcc_GetGamehref($game_info, $row->move_no, $row->color) ."\" class=\"pcchess_movelink" .
					 ($row->addmove == 1 ? 'shown' : '') . "\"" .  ">";

					echo "<td class=\"pcchess_movelist" . (empty($row->comment) ? '' : '_comment') . "\"" .
					 pcc_AddOverlibCall(pcc_ConvertLBToBR(date($pcc_lang['date_time_format'], strtotime($row->entered)) .
					(empty($row->comment) ? '' : "\n\n" . htmlspecialchars($row->comment)))) . ">" . $atag .
					pcc_TranslatePGN($NotationList[$nummoves]) . "</a></td>";

					if ($row->color == 1) {
						echo "</tr>\n";
						$openrow = false;
					}
					if ($row->addmove == 1) {
						$nummovesshow++;
					} else {
						if ($nextmove_no == "P") {
							$nextcolor = $row->color;
							$nextmove_no = $row->move_no;
							$prevmove_no = $row->move_no-1;
						}
					}
					$nummoves++;
				}
				if ($nummoves == 0) {
					$nextmove_no = 1;
					$nextcolor = 0;
				}
				//Take care of special case for previous button of being on last move.
				if (empty($userid)) {
					$mymove = false;
					$blackonbottom = false;
				} else {
					$blackonbottom = ($game_info->black_user_id == $userid);
					if (empty($movelist)) {
						$mymove = ($game_info->white_user_id == $userid);
					} else {
						$row = end($movelist);
						if ($mygame) {
							$mymove = (($game_info->white_user_id == $userid) && ($row->color == 1)) ||
							 (($game_info->black_user_id == $userid) && ($row->color == 0));
						} else {
							$mymove = false;
						}
					}
				}
				$showaddmoveform = ((($nummovesshow == $nummoves) and $mymove) and ($game_info->complete == 0));
				if (($prevmove_no == "N") && ($nummovesshow > 1)){
					// flip to opposite color.
					$nextcolor = 1-$row->color;
					$prevmove_no = $row->move_no-$nextcolor;
				}
				if ($openrow) {
					echo "<td class=\"pcchess_movelist\">&nbsp;</td></tr>\n";
				}

				$showacceptdraw = false;
				if ($game_info->draw_offered == 1) {
					$showaddmoveform = false;
					if ($mymove) {
						if (empty($message)) {
							$message = $pcc_lang["echo_game_player_offered_draw"];
						}
					} elseif ($mygame) {
						$showacceptdraw = true;
					} else {
						$message = (($nextcolor == 0) ? $pcc_lang["echo_game_white_offered_draw"] : $pcc_lang["echo_game_black_offered_draw"]);
					}
				}

				if ($pcc_notify == -1) {
					// Read notify move if not passed in.
					$pcc_notify = (($nextcolor == 0) ? $game_info->notify_white : $game_info->notify_black);
				}
				echo "<tr><td class=\"pcchess_exportlink\" colspan=\"3\"><a class=\"pcchess_exportlink\" href=\"" . pcc_GetGamePGNhref($game_info) .
				 "\">" . $pcc_lang["echo_game_export"] . "</a></td></tr>\n";
				echo "</table>\n";
				echo "</div>\n";
				echo "</td>\n"; //END the moves column.


				echo "<td class=\"pcchess_gamedisplay\">"; // START the chesstable display.

				if (read_Game($movelist, false)) {
					echo get_current_Position($blackonbottom, $showaddmoveform);
					echo "\n<br/>";
					$event1 = "\"MM_goToURL('parent','";
					$event2 = "');return document.MM_returnValue\"";

					echo "<input value=\" |&lt; \" onclick=" . $event1 .
					 pcc_GetGamehref($game_info, "1", "0") . $event2 . " type=\"button\"" .
					 ($nummovesshow < 2 ? " disabled=\"disabled\"" : '') . "/>\n";

					echo "<input value=\" &lt;&lt; \" onclick=" . $event1 .
					 pcc_GetGamehref($game_info, $prevmove_no, $nextcolor) . $event2 .
					 " type=\"button\"" .
					 ($nummovesshow < 2 ? " disabled=\"disabled\"" : '') . "/>\n";

					echo "<input value=\"" . $pcc_lang["echo_game_refresh"] . "\" onclick=" . $event1 .
					 pcc_GetGamehref($game_info) . $event2 .
					 " type=\"button\"/>\n";

					echo "<input value=\" &gt;&gt; \" onclick=" . $event1 .
					 pcc_GetGamehref($game_info, $nextmove_no, $nextcolor) . $event2 .
					 " type=\"button\"" . ($nummovesshow == $nummoves ? " disabled=\"disabled\"" : '') . "/>\n";

					$row = end($movelist);
					echo "<input value=\" &gt;| \" onclick=" . $event1 .
					 pcc_GetGamehref($game_info, $row->move_no, $row->color) . $event2 .
					 " type=\"button\"" . ($nummovesshow == $nummoves ? " disabled=\"disabled\"" : '') . "/>\n<br/>";
					if ($showaddmoveform) {
						pcc_ShowAddMoveForm($game_id, $message, $pcc_move, $pcc_notify, $pcc_comment);
					} elseif ($showacceptdraw) {
						pcc_ShowAcceptDrawForm($game_id, $nextcolor);
					} elseif (! empty($message) ) {
						echo $message;
					} elseif (($game_info->complete > 1)) {
						echo $pcc_lang["echo_game_not_started"] . strtolower(pcc_GetGameStatus($game_info)) . ".";
					} elseif (!($game_info->complete == 0)) {
						echo "<h4>" . $pcc_lang["echo_game_over"] . strtolower(pcc_GetGameStatus($game_info)) . "</h4>";
					} elseif ($mymove) {
						echo $pcc_lang["echo_game_last_position_to_move"];
					} elseif ($mygame) {
						echo "<h4>" . $pcc_lang["echo_game_opponents_move"] . "</h4>";
					}
					if (($game_info->complete == 0) || ($game_info->result> 2) || (($game_info->complete == 1) && !($nummovesshow == $nummoves))) {
					//	pcc_EchoForkGameForm($game_info, $move, $color);
					} else {
						echo "<br />";
					}
					echo pcc_GetDiscussThisLink($game_info);
				} else {
					echo "<p>" . $pcc_lang["error"] . $query . "</p>";
				}
				echo "</td>"; // END the chesstable display.



				echo "</tr></table>";

				// TEST. Un alt mod de a 'grupa' comentariile intr-un DIV si nu 'atasate' fiecarei mutari ca popup [TANASE]
				// E ok dar nu apar numele jucatorului care a scris comentariul!
				// De vazut cum se poate introduce numele jucatorului in fata comentariului, cum se poate preleva ceva de genul USERID...
				// Ulterior, cind acest model de competarii va fi functional, se vor elimina liniile de comentariu din fata // si apoi se vor elimina acele OVERLIB
				// echo "<h4>Commenti</h4>";
				// echo "<div class=\"comentariu\">";
				// foreach ($movelist as $row) {
				//	echo "<p>$row->comment</p>";
				// }
				// echo "</div>";
				// sf comentariu


			} else {
				echo "<p>" . $pcc_lang["error"] . $query . "</p>";
			}
		}
	}
	# Backlink
//	echo "<p id=backlink><a href=\"credits\">Powered by</a>&nbsp;<a href=\"http://www.pcchess.net\">PCChess</a></p>";
}

function pcc_TranslatePGN($move) {
	global $pcc_lang_pgn_find, $pcc_lang_pgn_replace;
	return str_replace($pcc_lang_pgn_find, $pcc_lang_pgn_replace, $move);
}

function pcc_ShowAcceptDrawForm($game_id, $nextcolor) {
	global $pcc_lang;
	// replacement for global $my variable
	$user = &JFactory::getUser();
	$userid = $user->get('id');

	$submiturl = JRoute::_("index.php?option=com_pcchess&Itemid=" . pcc_GetItemIdActiveGameMenuID() . "&page=acceptdraw");
?>
	<br /><form action="<?php echo $submiturl ?>" method="post" name="pcc_data" class="pcchess_forminput">
	<input name="page" type="hidden" value="acceptdraw">
	<input name="game_id" type="hidden" value="<?php echo $game_id ?>">
	<input name="user_id" type="hidden" value="<?php echo $userid ?>">
	<?php echo $pcc_lang['accept_draw_prompt'] ?> <input name="accept" type="radio" value="1"><?php echo $pcc_lang['Yes'] ?>&nbsp;
	<input name="accept" type="radio" value="0" checked="checked"><?php echo $pcc_lang['No'] ?> &nbsp;<input name="submit_pcc_data" type="submit" value="<?php echo $pcc_lang['forms_go'] ?>"></form>
<?php
}

function pcc_ProcessMove($game_id, $p_pcc_Move, $pcc_notify, $pcc_comment) {
	global  $pgn_Move, $pcc_lang;
	// replacement for global $database variable
	$db = &JFactory::getDbo();
	// replacement for global $my variable
	$user = &JFactory::getUser();
	$userid = $user->get('id');

	$pcc_Move = htmlspecialchars($p_pcc_Move, ENT_QUOTES);
	if (empty($pcc_Move)) {
		pcc_EchoGame($game_id, 1000, 1, $pcc_lang['process_move_no_move']);
	} elseif (empty($userid)) {
		echo "<p>" . $pcc_lang['process_move_no_login'] . "</p>";
	} elseif (empty($game_id)) {
		echo "<p>" . $pcc_lang['no_game_id'] . "</p>";
	} else {
		//Confirm game and user id.
		$game_info = pcc_GetInfoForOneGame($game_id);
		if (! (($game_info->white_user_id == $userid) || ($game_info->black_user_id == $userid))) {
			echo "<p>" . sprintf($pcc_lang['process_move_wrong_player'], $game_info->white_username, $game_info->black_username) . "</p>";
		} else {
			$nextmovecolor = ($game_info->move_and_color == 0 ? 0 :
			 ((($game_info->move_and_color - round($game_info->move_and_color,0)) == 0) ? 1 : 0));
			$nextmove = ($game_info->move_and_color == 0 ? 1 :
			 round($game_info->move_and_color,0) + ($nextmovecolor == 0 ? 1 : 0));
			$current_notify = (($nextmovecolor == 0) ? $game_info->notify_white : $game_info->notify_black);
			$new_notify = (($pcc_notify == 1) ? 1 : 0);
			if (! ($userid == ($nextmovecolor == 0 ? $game_info->white_user_id : $game_info->black_user_id))) {
				echo "<p>" . $pcc_lang['echo_game_opponents_move'] . "</p>";
			} else {
				$movelist = pcc_GetGameMoveList($game_id, 1000, 1);
				if (read_Game($movelist, true)) {
					#echo "DBG: pcc_Move $pcc_Move<br>";
					if (add_Move($pcc_Move)) {
						#echo "DBG: Move seems possible<br>";
						//Translate pgn notation:
						$pgn_Move = pcc_TranslatePGN($pgn_Move);

						$game_status = get_GameState();
						$query = "INSERT INTO #__chess_move (game_id, move_no, color, move, comment, entered) \n"
						 . "VALUES ("
						 . $game_id . ", \n"
						 . $nextmove . ", \n"
						 . $nextmovecolor . ", \n"
						 . "'" . $pcc_Move . "', \n"
						 . "'" . htmlspecialchars($pcc_comment, ENT_QUOTES) . "', \n"
						 . "NOW())";
						$db->setQuery( $query );
						$db->query();
						$send = pcc_SendMoveEmail($game_id, $nextmovecolor, $pgn_Move, htmlspecialchars($pcc_comment, ENT_QUOTES));
						$emailmsg = "<br/>" . ($send ? $pcc_lang['process_move_reject_notify'] : $pcc_lang['process_move_accept_no_notify']);
						if (!($new_notify == $current_notify)) {
							$query = "UPDATE #__chess_game SET " . (($nextmovecolor == 0) ? "notify_white" : "notify_black") .
							 " = " . $new_notify . " \n"
							 . "WHERE game_id = " . $game_id;
							$db->setQuery( $query );
							$db->query();
						}
						if (($game_status == 1) || ($game_status == 2)) {
							$query = "UPDATE #__chess_game SET result = " . ($game_status == 1 ? $nextmovecolor : 2) . ", \n"
							 . "complete = 1 \n "
							 . "WHERE game_id = " . $game_id;
							$db->setQuery( $query );
							$db->query();
							echo pcc_EchoGame($game_id, 1000, 1, ($game_status == 1 ? sprintf($pcc_lang['process_move_checkmate'], $pgn_Move) :
							 sprintf($pcc_lang['process_move_stalemate'], $pgn_Move)) . "." . $emailmsg);
						} else {
							echo pcc_EchoGame($game_id, 1000, 1, sprintf($pcc_lang['process_move_added'], $pgn_Move) . $emailmsg);
						}
					} else {
						echo pcc_EchoGame($game_id, 1000, 1, sprintf($pcc_lang['process_move_invalid'], $pgn_Move),
						 $pcc_Move, $pcc_notify, $pcc_comment);
					}
				} else {
					echo "<p>" . $pcc_lang['process_move_error'] . "</p>";
				}
			}
		}
	}
}

function pcc_SendMoveEmail($game_id, $move_color, $pgn_Move, $pcc_comment) {
	global $pcc_lang;
	$game_info = pcc_GetInfoForOneGame($game_id);

	if ($move_color == 0) {
		//white moved
		$from = $game_info->white_email;
		$fromname = $game_info->white_username;
		$recipient = $game_info->black_email;
		$send_email = $game_info->notify_black;
	} else {
		$from = $game_info->black_email;
		$fromname = $game_info->black_username;
		$recipient = $game_info->white_email;
		$send_email = $game_info->notify_white;
	}
	if ($send_email == 1) {
		$url = pcc_GetGamehref($game_info);
		$subject = $pcc_lang['send_mail_subject'];
		$comment = (empty($pcc_comment) ? "" : sprintf($pcc_lang['send_mail_comment'], $fromname) . "\"" . $pcc_comment . "\"");
		if ($pgn_Move == "RESIGN") $move = sprintf($pcc_lang['send_mail_resign'], $fromname, $game_info->white_username, $pcc_lang['v'],
		    $game_info->black_username, $url);
		elseif ($pgn_Move == "DRAW") $move = sprintf($pcc_lang['send_mail_draw_offer'], $fromname, $game_info->white_username, $pcc_lang['v'],
		    $game_info->black_username, $url);
		elseif ($pgn_Move == "ACCEPT") $move = sprintf($pcc_lang['send_mail_draw_accept'], $fromname, $game_info->white_username, $pcc_lang['v'],
		    $game_info->black_username, $url);
		elseif ($pgn_Move == "REJECT")$move = sprintf($pcc_lang['send_mail_draw_reject'], $fromname, $game_info->white_username, $pcc_lang['v'],
		    $game_info->black_username, $url);
		else $move = sprintf($pcc_lang['send_mail_move'], $fromname, $pgn_Move, $game_info->white_username, $pcc_lang['v'],
		    $game_info->black_username, $url);
		$body = $move . $comment;
		return JUtility::sendMail($from, $fromname, $recipient, $subject, $body);
	} else {
		return false;
	}
}

//Database Functions
function pcc_GetGameMoveList($game_id, $move, $color) {
	// replacement for global $database variable
	$db = &JFactory::getDbo();
	if (($color + 0.0) == 0.0) {
		$cond = " (m.move_no < " . $move . " OR (m.move_no = " . $move . " AND m.color = 0))";
	} else {
		$cond = " (m.move_no <= " . $move . ")";
	}
	$cond = "if(" . $cond . ", 1, 0) addmove";
	$query = "SELECT m.move, m.move_no, m.color, m.comment, m.entered, "  . $cond .
	 " FROM #__chess_move m WHERE m.game_id = " . $game_id . " ORDER BY m.move_no, m.color";
	$db->setQuery( $query );
	return $db->loadObjectList();
}

function pcc_GetUserName($user_id) {
	// replacement for global $database variable
	$db = &JFactory::getDbo();
	$query = 'SELECT username FROM #__users WHERE id=' . $user_id;
	$db->setQuery( $query );
	return $db->loadResult();
}

//Returns Y in first (0) position if player has active games, otherwise N.
//Returns Y in second (1) position if player has complete games, otherwise N.
function pcc_HasGames() {
	// replacement for global $database variable
	$db = &JFactory::getDbo();
	// replacement for global $my variable
	$user = &JFactory::getUser();
	$userid = $user->get('id');

	if (! empty($userid)) {
		$query = 'SELECT SUM(IF(g.complete = 0, 1, 0)) num_active, SUM(IF(g.complete = 1, 1, 0)) num_complete ' .
		 ' FROM #__chess_game g ' .
		 ' WHERE g.white_user_id = ' . $userid . ' OR g.black_user_id = ' . $userid;
		$db->setQuery( $query );
		$rows = $db->loadObjectList();
		if (empty ($rows)) {
			return 'NN';
		} else {
			return (($rows[0]->num_active > 0) ? 'Y' : 'N') . (($rows[0]->num_complete > 0) ? 'Y' : 'N');
		}
	} else {
		return 'NN';
	}
}

function pcc_GetInfoForOneGame($game_id) {
	// replacement for global $database variable
	$db = &JFactory::getDbo();
	$query = pcc_GetGameListSQL('g.game_id = ' . $game_id);
	$db->setQuery( $query );
	$db->query();
	$res = $db->loadObjectList();
	if (empty($res)) {
		return;
	} else {
		return $res[0];
	}
}

function pcc_GetMyActiveGames() {
	// replacement for global $database variable
	$db = &JFactory::getDbo();
	// replacement for global $my variable
	$user = &JFactory::getUser();
	$userid = $user->get('id');

	$myid = (! empty($userid) ? $userid : -1);
	$query = pcc_GetGameListSQL('g.complete = 0 AND (g.white_user_id = ' . $myid . ' OR g.black_user_id = ' . $myid . ')');
	$db->setQuery( $query );
	return $db->loadObjectList();
}

function pcc_GetMyActiveGamesMyMove() {
	// replacement for global $my variable
	$user = &JFactory::getUser();
	$userid = $user->get('id');

	return pcc_GetActiveGamesPlayersMove((! empty($userid) ? $userid : -1));
}

function pcc_GetActiveGamesPlayersMove($userid) {
	// replacement for global $database variable
	$db = &JFactory::getDbo();
	$query = pcc_GetGameListSQL('g.complete = 0 AND (g.white_user_id = ' . $userid . ' OR g.black_user_id = ' . $userid . ')',
	 'COALESCE(IF(g.white_user_id = ' . $userid . ', ((MAX(m.move_no + m.color/10) - MAX(m.move_no))*10) <> 0, ' .
	 '((MAX(m.move_no + m.color/10) - MAX(m.move_no))*10) = 0),0) OR ' .
	  '((COALESCE(COUNT(m.move_no),0) = 0) AND (g.white_user_id = ' . $userid . '))');
	$db->setQuery( $query );
	return $db->loadObjectList();
}

function pcc_GetMyActiveGamesNotMyMove() {
	// replacement for global $my variable
	$user = &JFactory::getUser();
	$userid = $user->get('id');
	return pcc_GetActiveGamesNotPlayersMove((! empty($userid) ? $userid : -1));
}

function pcc_GetActiveGamesNotPlayersMove($userid) {
	// replacement for global $database variable
	$db = &JFactory::getDbo();
	$query = pcc_GetGameListSQL('g.complete = 0 AND (g.white_user_id = ' . $userid . ' OR g.black_user_id = ' . $userid . ')',
	 'COALESCE(IF(g.white_user_id = ' . $userid . ', ((MAX(m.move_no + m.color/10) - MAX(m.move_no))*10) = 0, ' .
	 '((MAX(m.move_no + m.color/10) - MAX(m.move_no))*10) <> 0),0) OR ' .
	  '((COALESCE(COUNT(m.move_no),0) = 0) AND (g.white_user_id <> ' . $userid . '))');
	$db->setQuery( $query );
	return $db->loadObjectList();
}

function pcc_GetNotMyActiveGames() {
	// replacement for global $database variable
	$db = &JFactory::getDbo();
	// replacement for global $my variable
	$user = &JFactory::getUser();
	$userid = $user->get('id');

	$myid = (! empty($userid) ? $userid : -1);
	$query = pcc_GetGameListSQL('g.complete = 0 AND !(g.white_user_id = ' . $myid . ' OR g.black_user_id = ' . $myid . ')');
	$db->setQuery( $query );
	return $db->loadObjectList();
}

function pcc_GetMyCompleteGames() {
	// replacement for global $my variable
	$user = &JFactory::getUser();
	$userid = $user->get('id');

	return pcc_GetCompleteGamesOnePlayer((! empty($userid) ? $userid : -1));
}

function pcc_GetCompleteGamesOnePlayer($userid) {
	// replacement for global $database variable
	$db = &JFactory::getDbo();
	$query = pcc_GetGameListSQL('g.complete = 1 AND (g.white_user_id = ' . $userid . ' OR g.black_user_id = ' . $userid . ')');
	$db->setQuery( $query );
	return $db->loadObjectList();
}

function pcc_GetNotMyCompleteGames() {
	// replacement for global $database variable
	$db = &JFactory::getDbo();
	// replacement for global $my variable
	$user = &JFactory::getUser();
	$userid = $user->get('id');

	$myid = (! empty($userid) ? $userid : -1);
	$query = pcc_GetGameListSQL('g.complete = 1 AND !(g.white_user_id = ' . $myid . ' OR g.black_user_id = ' . $myid . ')');
	$db->setQuery( $query );
	return $db->loadObjectList();
}

function pcc_GetUserDop($id) {
	// replacement for global $database variable
	$db = &JFactory::getDbo();
	$query = 'SELECT dop FROM #__users WHERE id=' . $id;
	$db->setQuery( $query );
	return $db->loadResult();
}

function pcc_GetGameId() {
	// replacement for global $database variable
	$db = &JFactory::getDbo();
	$query = 'SELECT game_id FROM chess_chess_game ORDER BY game_id DESC LIMIT 1';
	$db->setQuery( $query );
	return $db->loadResult();
}

function pcc_GetMaxTour($thistournid) {
	// replacement for global $database variable
	// Получаем максимальный тур текущего турнира в личном первенстве

	//$query21 = mysql_query ("SELECT id as 'thistournid' FROM chess_tournaments ORDER BY id DESC LIMIT 1");
   // $quer21 = mysql_fetch_assoc($query21); // Запоминаем id текущего турнира (последний по счету, но не последний по важности=))))
   	//$thistournid = $quer21['thistournid'];

	$db = &JFactory::getDbo();
	$query = 'SELECT tour FROM chess_chess_game WHERE type = 0 AND tourn_id = ' . $thistournid . ' ORDER BY tour DESC LIMIT 1';
	$db->setQuery( $query );
	return $db->loadResult();
}

function pcc_GetMaxTourTeam($thistournid) {
	// replacement for global $database variable
	// Получаем максимальный тур текущего турнира в командном первенстве
	$db = &JFactory::getDbo();
	$query = 'SELECT tour FROM chess_chess_game WHERE type = 1 AND tourn_id = ' . $thistournid . ' ORDER BY tour DESC LIMIT 1';
	$db->setQuery( $query );
	return $db->loadResult();
}

function pcc_GetPoints($player_list, $breakout=0) {	global $play_points;
	foreach ($player_list as $row) // Записываем в массив очки каждого юзера
		{
		$id = $row->id;
		$dop = pcc_GetUserDop($id);
		$points = ($row->wins_white + $row->wins_black + ($row->draws_white + $row->draws_black + $dop)/2 );
		// Здесь зделать чтобы только в текущем турнире и только в играх личного первенства выделялись очки!!! А для командного первенства написать отдельную функцию.
		$play_points[$row->id] = $points;
		}
	$max_point = 0;
    foreach ($play_points as $a) // Ищем максимальное очко
    	{
    	if ($a > $max_point)
    		{
    		$max_point = $a;
    		}
    	}
    $count_point = 0;
    foreach ($play_points as $b) // Считаем количество лидеров
    	{
    	if ($b == $max_point)
    		{
    		$count_point = $count_point+1;
    		}
    	}
     if ($count_point == 1) // Если лидер один, то записываем его в БД
     	{
     	foreach ($player_list as $row)
     		{     		if ($play_points[$row->id] == $max_point)
     			{     			$winner_id = $row->id;
     			$query21 = mysql_query ("SELECT id as 'thistournid' FROM chess_tournaments ORDER BY id DESC LIMIT 1");
    			$quer21 = mysql_fetch_assoc($query21); // Запоминаем id текущего турнира (последний по счету, но не последний по важности=))))
   				$thistournid = $quer21['thistournid'];
   				$query22 = mysql_query ("SELECT winner_id FROM chess_tournaments WHERE id = '$thistournid'");
   				$quer22 = mysql_fetch_assoc($query22); // Запоминаем победителя текущего турнира
   				$win_id = $quer22['winner_id'];
   				if ($win_id == 0) // Если победитель еще не записывался
   					{   					// Далее проверяем есть ли игры, требующие судейского решения   					$zapros3 = mysql_query("SELECT COUNT('game_id') as 'count' FROM chess_chess_game WHERE type = '0' AND result = '6' AND tourn_id = '$thistournid'");
   					$zapr3 = mysql_fetch_assoc($zapros3);
   					$count = $zapr3['count'];
   					if ($count == 0)
   						{
     					$zapros4 = mysql_query ("UPDATE chess_tournaments SET winner_id = '$winner_id' WHERE id = '$thistournid'"); // Записываем id победителя
     					// Далее высылаем письма всем участникам что турнир закончился и победитель определен (один раз должно выполниться)
                    	$mailfrom = 'wit-89@mail.ru';
						$fromname = 'Chess Tournament Site';
						$subject = 'The events of the tournament';
        				$message = 'Individual championship chess tournament was over. The winner is determined!';
						$querry22 = mysql_query ("SELECT id as 'min_id' FROM chess_users WHERE app <> '0' ORDER BY id ASC LIMIT 1"); // Выбрать игрока текущего турнира с минимальным ID
						$querry23 = mysql_query ("SELECT id as 'max_id' FROM chess_users WHERE app <> '0' ORDER BY id DESC LIMIT 1");// Выбрать игрока текущего турнира с максимальным ID
    					$querr22 = mysql_fetch_assoc($querry22);
    					$querr23 = mysql_fetch_assoc($querry23);
    					$min_id = $querr22['min_id'];
    					$max_id = $querr23['max_id'];
    					for ($i = $min_id; $i <= $max_id; $i++)
    						{
    						$querry24 = mysql_query ("SELECT id as 'next_id' FROM chess_users WHERE id = '$i' AND app <> '0'");
    						$querr24 = mysql_fetch_assoc($querry24);
    						$next_id = $querr24['next_id'];
    						if ($next_id <> 0)
    							{
    							$querry25 = mysql_query("SELECT email FROM chess_users WHERE id = '$i'");
    							$querr25 = mysql_fetch_assoc($querry25);
    							$email = $querr25['next_id'];
    							JUtility::sendMail($mailfrom, $fromname, $email, $subject, $message);
    							}
    						}
    					}
     				}     			}     		}
     	}}

function pcc_GetTeamPoints($player_list, $breakout=0) {
	global $team_points;
	//global $winner_id;
	$winner_id = 0;
	foreach ($player_list as $row) // Записываем в массив очки каждого юзера и суммируем очки команды
		{
		$id = $row->id;
		$points = ($row->wins_white + $row->wins_black + ($row->draws_white + $row->draws_black)/2 );
		// Здесь зделать чтобы только в текущем турнире и только в играх командного первенства выделялись очки!!!
		$play_points[$id] = $points; // Мы имеем массив с id и количеством очков командников
		//echo $points; echo " "; echo $id; echo "<br>";
		$query1 = mysql_query("SELECT team FROM chess_users WHERE id = '$id'");	// Получаем id команды очередного пользователя
        $quer1 = mysql_fetch_assoc($query1);
        $team = $quer1['team'];
        $team_points[$team] = $team_points[$team] + $play_points[$id]; // Суммируем очки команды с очками текущего пользователя        foreach ($team_points as $c)
        if ($team_points[$team] > $c)
        	{         	$winner_id = $team;        	}
        //echo $team; echo " "; echo $team_points[$team]; echo "<br>";
		}

	$max_point = 0;
    foreach ($team_points as $a) // Ищем максимальное очко
    	{
    	if ($a > $max_point)
    		{
    		$max_point = $a;
    		}
    	}
    	//echo $max_point; echo "   ";
    $count_point = 0;
    foreach ($team_points as $b) // Считаем количество лидеров
    	{
    	if ($b == $max_point)
    		{
    		$count_point = $count_point+1;
    		}
    	}
    	//echo $count_point; echo "<br>";
     if ($count_point == 1) // Если лидер один, то записываем его в БД
     	{
     	$query21 = mysql_query ("SELECT id as 'thistournid' FROM chess_tournaments ORDER BY id DESC LIMIT 1");
    	$quer21 = mysql_fetch_assoc($query21); // Запоминаем id текущего турнира (последний по счету, но не последний по важности)
   		$thistournid = $quer21['thistournid'];
   		$query22 = mysql_query ("SELECT team_winner_id FROM chess_tournaments WHERE id = '$thistournid'");
   		$quer22 = mysql_fetch_assoc($query22); // Запоминаем команду-победителя текущего турнира
   		$team_winner_id = $quer22['team_winner_id'];
   		if ($team_winner_id == 0)  // Если победитель еще не записывался
   			{   			// Далее проверяем есть ли игры, требующие судейского решения
   			$zapros3 = mysql_query("SELECT COUNT('game_id') as 'count' FROM chess_chess_game WHERE type = '1' AND result = '6' AND tourn_id = '$thistournid'");
   			$zapr3 = mysql_fetch_assoc($zapros3);
   			$count = $zapr3['count'];
   			if ($count == 0)
   				{
	     		$zapros4 = mysql_query ("UPDATE chess_tournaments SET team_winner_id = '$winner_id' WHERE id = '$thistournid'"); // Записываем id победителя
	            // Далее высылаем письма всем участникам что командный турнир закончился и победитель определен (один раз должно выполниться)
	            $mailfrom = 'wit-89@mail.ru';
				$fromname = 'Chess Tournament Site';
				$subject = 'The events of the tournament';
	        	$message = 'Team championship chess tournament was over. The winner is determined!';
				$querry22 = mysql_query ("SELECT id as 'min_id' FROM chess_users WHERE team <> '0' ORDER BY id ASC LIMIT 1"); // Выбрать игрока текущего турнира с минимальным ID
				$querry23 = mysql_query ("SELECT id as 'max_id' FROM chess_users WHERE team <> '0' ORDER BY id DESC LIMIT 1");// Выбрать игрока текущего турнира с максимальным ID
	    		$querr22 = mysql_fetch_assoc($querry22);
	    		$querr23 = mysql_fetch_assoc($querry23);
	    		$min_id = $querr22['min_id'];
	    		$max_id = $querr23['max_id'];
	    		for ($i = $min_id; $i <= $max_id; $i++)
	    			{
	    			$querry24 = mysql_query ("SELECT id as 'next_id' FROM chess_users WHERE id = '$i' AND team <> '0'");
	    			$querr24 = mysql_fetch_assoc($querry24);
	    			$next_id = $querr24['next_id'];
	    			if ($next_id <> 0)
	    				{
	    				$querry25 = mysql_query("SELECT email FROM chess_users WHERE id = '$i'");
	    				$querr25 = mysql_fetch_assoc($querry25);
	    				$email = $querr25['next_id'];
	    				JUtility::sendMail($mailfrom, $fromname, $email, $subject, $message);
	    				}
	    			}
    			}
     		}
     	}
}

function pcc_Proverka() {	// Проверяется все ли игры завершены и определяется победитель	global $play_points;

	$query21 = mysql_query ("SELECT id as 'thistournid' FROM chess_tournaments ORDER BY id DESC LIMIT 1");
    $quer21 = mysql_fetch_assoc($query21); // Запоминаем id текущего турнира (последний по счету, но не последний по важности=))))
   	$thistournid = $quer21['thistournid'];

 	$max_tour = pcc_GetMaxTour($thistournid);
    $tour_id = $max_tour+1;
    $tour_pr = $tour_id-1;

    // Далее из БД дергается количество обязательных туров
    $query20 = mysql_query ("SELECT kolobyaztur as 'kolobyaztur' FROM chess_tournaments WHERE id = '$thistournid'");
    $quer20 = mysql_fetch_assoc($query20);
    $kolobyaztur = $quer20['kolobyaztur'];

    $qqquery15 = mysql_query ("SELECT * FROM chess_chess_game WHERE type = '0' and tourn_id = '$thistournid'"); // Все игры личного первенства в этом турнире
    $query15 = mysql_query ("SELECT * FROM chess_chess_game WHERE type = '0' AND complete = '0'"); // Все начатые игры
   	//если все игры завершены
   	if ((mysql_num_rows($query15) == 0) AND (mysql_num_rows($qqquery15) <> 0))
   		{   		if ($max_tour >= $kolobyaztur)
   			{
   			//Определяем пабидитибля
			pcc_GetPoints(pcc_GetIndividualPlayers(),0);
			$max_point = 0;
    		foreach ($play_points as $a)
    			{    			if ($a > $max_point)
    				{
    				$max_point = $a;
    				}
    			}
   			$count_point = 0;
    		foreach ($play_points as $b)
    			{    			if ($b == $max_point)
    				{
    				$count_point = $count_point+1;
    				}
    			}
  			}
  			else
  			{  			$count_point = 2; // Просто делаем условие неопределенного победителя  			}
    	if ($count_point > 1)
    		{
    		// Паибитиль не определен
      		$query1 = mysql_query("SELECT * FROM chess_users WHERE app = '1' ORDER BY id ASC LIMIT 1"); // Выбрать пользователя, подавшего заявку, с минимальным ID
			$query2 = mysql_query("SELECT * FROM chess_users WHERE app = '1' ORDER BY id DESC LIMIT 1");
			$first_id = mysql_fetch_assoc($query1);
 			$last_id = mysql_fetch_assoc($query2);
 			$zapros1 = mysql_query ("SELECT COUNT('id') as 'id_count' FROM chess_users WHERE app = '1'"); // Получить количество участников, подавших заявку
  			$kol = mysql_fetch_assoc($zapros1);
    		$kol_app = $kol['id_count']; // Количество заявок
            while ($tour_id  <> $tour_pr)
 				{
    			if (!($kol_app % 2 == 0))
    				{
    				// Если количество заявок - нечетное
    				$zapros2 = mysql_query("SELECT MAX(dop) as 'max_dop' FROM chess_users"); // Получить максимальное число начисленных дополнительных очков
            		$max = mysql_fetch_assoc($zapros2);
           			$max_dop = $max['max_dop'];
            		$zapros3 = mysql_query("SELECT id FROM chess_users WHERE app = '1' AND dop < '$max_dop' ORDER BY RAND() LIMIT 1");
            		// (Выбрать ID случайного подавшего заявку пользователя с не максимальным количеством доп. очков)
            		if (!mysql_num_rows($zapros3) == 0)
            			// Выбор левого пользователя
            			{
            			// Если такой запрос не пуст и комуто уже начислялись очки
               			$left = mysql_fetch_assoc($zapros3);
            			$left_user = $left['id'];
                		}
                		else
                		{
                		// Если у всех 0 доп. очков или равное их количество
                		$zapros4 = mysql_query("SELECT id FROM chess_users WHERE app = '1' ORDER BY RAND() LIMIT 1");
                		$left = mysql_fetch_assoc($zapros4);
            			$left_user = $left['id']; // ID Левого юзера
                		}
            		// Дополнительное очко юзеру-неудачнику
            		$zapros4 = mysql_query ("UPDATE `chess`.`chess_users` SET dop = dop + 1 , tour = '$tour_id' WHERE `chess_users`.`id` = '$left_user'");
    				}
        		// Распределяем четное количество участников
            	$user_id = 0;
				$rand_id = 0;
				$tour_pr = $tour_id-1;
   	 			$query7 = mysql_query ("SELECT * FROM chess_users WHERE tour = '$tour_pr'"); // Выбрать участников с прошлым туром
   	 			//если не пусто
   	 			if (!mysql_num_rows($query7) == 0)
   	 				{
   	 				// Выбираем первого игрока
					$user_id = mt_rand($first_id['id'],$last_id['id']);
    				$query4 = mysql_query ("SELECT * FROM chess_users WHERE app = '1' AND id = '$user_id' and tour <> '$tour_id'");
    				while (mysql_num_rows($query4) == 0)
						{
						$user_id = rand($first_id['id'],$last_id['id']);
       					$query4 = mysql_query ("SELECT * FROM chess_users WHERE app = '1' AND id = '$user_id' and tour <> '$tour_id'");
						}
					$query5 = mysql_query ("UPDATE `chess`.`chess_users` SET `tour` = '$tour_id' WHERE `chess_users`.`id` = '$user_id'");
					// Выбор случайного соперника
 					$rand_id = mt_rand($first_id['id'],$last_id['id']);
					$query3 = mysql_query ("SELECT * FROM chess_users WHERE app = '1' AND id = '$rand_id' and tour <> '$tour_id'");
					while (mysql_num_rows($query3) == 0)
						{
						$rand_id=rand($first_id['id'],$last_id['id']);;
    	   				$query3 = mysql_query ("SELECT * FROM chess_users WHERE app = '1' AND id = '$rand_id' and tour <> '$tour_id'");
						}
					$query6 = mysql_query ("UPDATE `chess`.`chess_users` SET `tour` = '$tour_id' WHERE `chess_users`.`id` = '$rand_id'");
					$challenger_id = $rand_id;
	    			}
				$color = rand(0,1);
				$notify = 0; // Yes
				if ($user_id <>0 and $rand_id <> 0)
					{
					// Создаем новую игру
					pcc_ProcessNewGame($user_id, $color, $notify, $comment, $challenger_id);
					$end = pcc_GetGameId();
					$querry2 = mysql_query ("SELECT id as 'thistournid' FROM chess_tournaments ORDER BY id DESC LIMIT 1"); // Зопоминаем id текущего турнира
    				$querr2 = mysql_fetch_assoc($querry2);
   	 				$thistournid = $querr2['thistournid'];
					$query13 = mysql_query ("UPDATE chess_chess_game SET tour = '$tour_id' , complete = '0' , type = '0', tourn_id = '$thistournid' WHERE game_id = '$end'");
					//  type = '0' - значит что игра личного первенства (1 - командное)
					}
				$query14 = mysql_query ("SELECT * FROM chess_users WHERE app = '1' AND tour = '$tour_pr'"); // Остались нераспределенные игроки?
    			if (mysql_num_rows($query14) == 0)
					{
					$tour_id = $tour_id-1;
					}
				}
			// И высылаем всем участникам письмо что запущены игры следующего тура
   			$mailfrom = 'wit-89@mail.ru';
			$fromname = 'Chess Tournament Site';
			$subject = 'The events of the tournament';
        	$message = 'Attention! Run the game the next round of personal superiority.';
			$querry22 = mysql_query ("SELECT id as 'min_id' FROM chess_users WHERE app <> '0' ORDER BY id ASC LIMIT 1"); // Выбрать игрока текущего турнира с минимальным ID
			$querry23 = mysql_query ("SELECT id as 'max_id' FROM chess_users WHERE app <> '0' ORDER BY id DESC LIMIT 1");// Выбрать игрока текущего турнира с максимальным ID
    		$querr22 = mysql_fetch_assoc($querry22);
    		$querr23 = mysql_fetch_assoc($querry23);
    		$min_id = $querr22['min_id'];
    		$max_id = $querr23['max_id'];
    		for ($i = $min_id; $i <= $max_id; $i++)
    			{
    			$querry24 = mysql_query ("SELECT id as 'next_id' FROM chess_users WHERE id = '$i' AND app <> '0'");
    			$querr24 = mysql_fetch_assoc($querry24);
    			$next_id = $querr24['next_id'];
    			if ($next_id <> 0)
    				{
    				$querry25 = mysql_query("SELECT email FROM chess_users WHERE id = '$i'");
    				$querr25 = mysql_fetch_assoc($querry25);
    				$email = $querr25['next_id'];
    				JUtility::sendMail($mailfrom, $fromname, $email, $subject, $message);
    				}
    			}
			}
    	/*if ($count_point == 1) // Победитель определен. Выводим его имя!
    		{    		$query17 = mysql_query ("SELECT winner_id as 'winner_id' FROM chess_tournaments WHERE  id = '$thistournid'");
            $win_id = mysql_fetch_assoc($query17);
           	$winner_id = $win_id['winner_id'];    		$query16 = mysql_query ("SELECT username as 'winner_name' FROM chess_users WHERE  id = '$winner_id'");
            $win = mysql_fetch_assoc($query16);
           	$winner = $win['winner_name'];
    		echo "<div class=\"activegames\"><h1>Attention! Completed all the games in the individual championship!<br>
    		<br>The WINNER in individual championship is " . $winner . "!<br><br>Congratulations!</h1></div><br>";
    		} */   		}
}

function pcc_GetTourGames($tour_id) {	//Таки выводим расписание
	// replacement for global $database variable
	$db = &JFactory::getDbo();
	$query = pcc_GetGameListSQL('g.tour = ' . $tour_id . ' AND type = 0');
	$db->setQuery( $query );
	return $db->loadObjectList();
}

function pcc_GetTourGamesTeam($tour_id) {
	// Выводим расписание командного первенства
	// replacement for global $database variable
	$db = &JFactory::getDbo();
	$query = pcc_GetGameListSQL('g.tour = ' . $tour_id . ' AND type = 1');
	$db->setQuery( $query );
	return $db->loadObjectList();
}

function pcc_Raspr() {
// Распределить
	$query9 = mysql_query ("UPDATE `chess`.`chess_users` SET `tour` = '0' WHERE id <> '0'");
	$query12 = mysql_query ("UPDATE `chess`.`chess_users` SET `dop` = '0' WHERE id <> '0'");
		$query15 = mysql_query("DELETE FROM chess_chess_game WHERE tour <> '0'");
	$tour_id = 1;
	$user = &JFactory::getUser();
	$userid = $user->get('id');
	$query1 = mysql_query("SELECT * FROM chess_users ORDER BY id ASC LIMIT 1");
	$query2 = mysql_query("SELECT * FROM chess_users ORDER BY id DESC LIMIT 1");
	$first_id = mysql_fetch_assoc($query1);
 	$last_id = mysql_fetch_assoc($query2);
	while ($tour_id <= 4)
 	 	{
		$query = mysql_query ("UPDATE `chess`.`chess_users` SET `tour` = '$tour_id' WHERE `chess_users`.`id` = '$userid'");
		$user_id = 0;
		$rand_id = 0;
		$sss = 0;
		$tour_pr = $tour_id-1;
   	 	$query7 = mysql_query ("SELECT * FROM chess_users WHERE tour = '$tour_pr'");
   	 	//если не пусто
   	 	if (!mysql_num_rows($query7) == 0)
   	 		{    		$sss = 1;			$user_id = mt_rand($first_id['id'],$last_id['id']);
    		$query4 = mysql_query ("SELECT * FROM chess_users WHERE id = '$user_id' and tour <> '$tour_id'");
    		while (mysql_num_rows($query4) == 0)
				{
				$user_id = rand($first_id['id'],$last_id['id']);
       			$query4 = mysql_query ("SELECT * FROM chess_users WHERE id = '$user_id' and tour <> '$tour_id'");
				}
			$query5 = mysql_query ("UPDATE `chess`.`chess_users` SET `tour` = '$tour_id' WHERE `chess_users`.`id` = '$user_id'");
			echo $user_id;
			echo "<br>";
	    	}
    	$query8 = mysql_query ("SELECT * FROM chess_users WHERE tour = '$tour_pr'");
    	//если не пусто
    	if (!mysql_num_rows($query8) == 0)
    		{
			// Выбор случайного соперника
 			$rand_id = mt_rand($first_id['id'],$last_id['id']);
			$query3 = mysql_query ("SELECT * FROM chess_users WHERE id = '$rand_id' and tour <> '$tour_id'");
			while (mysql_num_rows($query3) == 0)
				{
				$rand_id=rand($first_id['id'],$last_id['id']);;
    	   		$query3 = mysql_query ("SELECT * FROM chess_users WHERE id = '$rand_id' and tour <> '$tour_id'");
				}
			$query6 = mysql_query ("UPDATE `chess`.`chess_users` SET `tour` = '$tour_id' WHERE `chess_users`.`id` = '$rand_id'");
			$challenger_id = $rand_id;
			echo $rand_id;
			}
			else
				{
				if ($sss == 1)
					{					//нечетное кол-во: добавить пол-очка тому кто остался ($user_id); и перейти к следующему туру
            		$query10 = mysql_query ("UPDATE `chess`.`chess_users` SET dop = dop + 1 WHERE `chess_users`.`id` = '$user_id'");					}
				// четное количество тур++				}
		$color = rand(0,1);
		$notify = 0; // Yes
		if ($user_id <>0 and $rand_id <> 0)
			{			pcc_ProcessNewGame($user_id, $color, $notify, $comment, $challenger_id);
			$end = pcc_GetGameId();
			$query13 = mysql_query ("UPDATE `chess`.`chess_chess_game` SET tour = '$tour_id' , complete = '0' WHERE `chess_chess_game`.`game_id` = '$end'");
			}
		$query14 = mysql_query ("SELECT * FROM chess_users WHERE tour = '$tour_pr'");
    	if (mysql_num_rows($query14) == 0)
			{
			$tour_id = $tour_id+1;
			echo "<br>";
			echo $tour_id;
			echo "<br>";
			}
  		}
}

function pcc_NewRaspr() {
// Распределить
	$query9 = mysql_query ("UPDATE `chess`.`chess_users` SET `tour` = '0' WHERE id <> '0'"); // Обнуляем туры всех пользователей
	$query12 = mysql_query ("UPDATE `chess`.`chess_users` SET `dop` = '0' WHERE id <> '0'"); // Обнуляем доп. очки всех пользователей
	$querry3 = mysql_query ("SELECT id as 'thistournid' FROM chess_tournaments ORDER BY id DESC LIMIT 1"); // Запоминаем id текущего турнира
    $querr3 = mysql_fetch_assoc($querry3);
   	$thistournid = $querr3['thistournid'];
	$query15 = mysql_query("DELETE FROM chess_chess_game WHERE type = '0' AND tourn_id = '$thistournid'"); // Удаляем все игры личного первенства в настоящем турнире
	$tour_id = 1;
	//$user = &JFactory::getUser();
	//$userid = $user->get('id');
	$query1 = mysql_query("SELECT * FROM chess_users WHERE app = '1' ORDER BY id ASC LIMIT 1"); // Выбрать пользователя, подавшего заявку, с минимальным ID
	$query2 = mysql_query("SELECT * FROM chess_users WHERE app = '1' ORDER BY id DESC LIMIT 1");
	$first_id = mysql_fetch_assoc($query1);
 	$last_id = mysql_fetch_assoc($query2);
 	// Тут теперь проверяем количество набранных участников (должно быть не менее двух)
 	$zapros1 = mysql_query ("SELECT COUNT('id') as 'id_count' FROM chess_users WHERE app = '1'"); // Получить количество участников, подавших заявку
  	$kol = mysql_fetch_assoc($zapros1);
    $kol_app = $kol['id_count']; // Количество заявок
    if ($kol_app >= 2)  // Не меньше двух должно быть
 		{ 		//echo "1<br>";
 		echo $tour_id; echo "<br>";
   		while ($tour_id <= 1)
    		{    		// Сначала на один тур распределяем игры
    		if (!($kol_app % 2 == 0))
    			{    			// Если количество заявок - нечетное
    			$zapros2 = mysql_query("SELECT MAX(dop) as 'max_dop' FROM chess_users"); // Получить максимальное число начисленных дополнительных очков
            	$max = mysql_fetch_assoc($zapros2);
           		$max_dop = $max['max_dop'];
            	$zapros3 = mysql_query("SELECT id FROM chess_users WHERE app = '1' AND dop < '$max_dop' ORDER BY RAND() LIMIT 1");
            	// (Выбрать ID случайного подавшего заявку пользователя с не максимальным количеством доп. очков)
            	if (!mysql_num_rows($zapros3) == 0)
            		// Выбор левого пользователя
            		{
            		// Если такой запрос не пуст и комуто уже начислялись очки
               	 	$left = mysql_fetch_assoc($zapros3);
            		$left_user = $left['id'];
                	}
                	else
                	{                	// Если у всех 0 доп. очков или равное их количество
                	$zapros4 = mysql_query("SELECT id FROM chess_users WHERE app = '1' ORDER BY RAND() LIMIT 1");
                	$left = mysql_fetch_assoc($zapros4);
            		$left_user = $left['id']; // ID Левого юзера
                	}
            	// Дополнительное очко юзеру-неудачнику
            	$zapros4 = mysql_query ("UPDATE `chess`.`chess_users` SET dop = dop + 1 , tour = '$tour_id' WHERE `chess_users`.`id` = '$left_user'");
    			}

        	// Распределяем четное количество участников
            $user_id = 0;
			$rand_id = 0;
			$tour_pr = $tour_id-1;
   	 		$query7 = mysql_query ("SELECT COUNT('id') as 'id_count' FROM chess_users WHERE tour = '$tour_pr' AND app = '1'"); // Получить количество участников с прошлым туром
   	 		$quer7 = mysql_fetch_assoc($query7);
    		$kol_members = $quer7['id_count'];
   	 		//если не пусто
   	 		if ($kol_members <> 0)
   	 			{   	 			// Выбираем первого игрока
				$user_id = mt_rand($first_id['id'],$last_id['id']);
    			$query4 = mysql_query ("SELECT * FROM chess_users WHERE app = '1' AND id = '$user_id' and tour <> '$tour_id'");
    			while (mysql_num_rows($query4) == 0)
					{
					$user_id = rand($first_id['id'],$last_id['id']);
       				$query4 = mysql_query ("SELECT * FROM chess_users WHERE app = '1' AND id = '$user_id' and tour <> '$tour_id'");
					}
				$query5 = mysql_query ("UPDATE `chess`.`chess_users` SET `tour` = '$tour_id' WHERE `chess_users`.`id` = '$user_id'");
				echo $user_id; echo "<br>";
				// Выбор случайного соперника
 				$rand_id = mt_rand($first_id['id'],$last_id['id']);
				$query3 = mysql_query ("SELECT * FROM chess_users WHERE app = '1' AND id = '$rand_id' and tour <> '$tour_id'");
				while (mysql_num_rows($query3) == 0)
					{
					$rand_id=rand($first_id['id'],$last_id['id']);;
    	   			$query3 = mysql_query ("SELECT * FROM chess_users WHERE app = '1' AND id = '$rand_id' and tour <> '$tour_id'");
					}
				$query6 = mysql_query ("UPDATE `chess`.`chess_users` SET `tour` = '$tour_id' WHERE `chess_users`.`id` = '$rand_id'");
				$challenger_id = $rand_id; echo $rand_id;
	    		}
			$color = rand(0,1);
			$notify = 0; // Yes
			if ($user_id <>0 and $rand_id <> 0)
				{				// Создаем новую игру
				pcc_ProcessNewGame($user_id, $color, $notify, $comment, $challenger_id);
				$end = pcc_GetGameId();
				$querry2 = mysql_query ("SELECT id as 'thistournid' FROM chess_tournaments ORDER BY id DESC LIMIT 1"); // Запоминаем id текущего турнира
    			$querr2 = mysql_fetch_assoc($querry2);
   	 			$thistournid = $querr2['thistournid'];
				$query13 = mysql_query ("UPDATE chess_chess_game SET tour = '$tour_id' , complete = '0' , type = '0', tourn_id = '$thistournid' WHERE game_id = '$end'");
				}
			$query14 = mysql_query ("SELECT * FROM chess_users WHERE app = '1' AND tour = '$tour_pr'"); // Остались нераспределенные игроки?
    		if (mysql_num_rows($query14) == 0)
				{
				$tour_id = $tour_id+1;
				echo "<br>";
				//echo $tour_id;
				//echo "<br>";				}
			}
      	}
      	else
        {
       	echo "<h2>Not enough members for individual championship</h2>";
      	}
}

function pcc_TeamRaspr() {
// Командное распределение
	$querry2 = mysql_query ("SELECT id as 'thistournid' FROM chess_tournaments ORDER BY id DESC LIMIT 1");
    $querr2 = mysql_fetch_assoc($querry2); // Запоминаем id текущего турнира (последний по счету, но не последний по важности=))))
   	$thistournid = $querr2['thistournid'];

	// Тут сначала удаляются команды, которые не добрали игроков
    $qquerry = mysql_query("SELECT member_count FROM chess_tournaments ORDER BY id DESC LIMIT 1");
    $qquerr = mysql_fetch_assoc($qquerry); // Запоминаем количество участников команды в текущем (последнем) турнире
    $member_count = $qquerr['member_count'];
    $qquerry3 = mysql_query("SELECT id as 'first_team' FROM chess_teams WHERE tourn_id = '$thistournid' ORDER BY id ASC LIMIT 1"); // Ищем id первой команды в этом турнире
    $qquerr3 = mysql_fetch_assoc($qquerry3);
    $first_team = $qquerr3['first_team'];
    $qquerry1 = mysql_query("SELECT id as 'last_team' FROM chess_teams WHERE tourn_id = '$thistournid' ORDER BY id DESC LIMIT 1"); // Ищем id последней команды
    $qquerr1 = mysql_fetch_assoc($qquerry1);
    $last_team = $qquerr1['last_team'];
    for ($i = $first_team; $i <= $last_team; $i++)
    	{        $qquerry2 = mysql_query("SELECT kol_members FROM chess_teams WHERE id = '$i'"); // Выдираем количество участников команды
        $qquerr2 = mysql_fetch_assoc($qquerry2);
    	$kol_members = $qquerr2['kol_members'];
    	if ($kol_members < $member_count)
    		{    		for ($j = 1; $j<9; $j++) // Зачищаем инфу о членстве в команде у юзеров-участников
    			{                $qquerry5 = mysql_query("SELECT id_$j as 'nextid' FROM chess_teams WHERE id = '$i'"); // Выдираем id очерендного участника
       			$qquerr5 = mysql_fetch_assoc($qquerry5);
    			$nextid = $qquerr5['nextid'];
                $qquerry5 = mysql_query("UPDATE chess_users SET team = '0' WHERE id = '$nextid'"); // Убираем информацию о членстве в команде у пользователя    			}
            $qquerry4 = mysql_query("DELETE FROM chess_teams WHERE id = '$i'"); // И удаляем команду    		}    	}
	$query9 = mysql_query ("UPDATE chess_users SET team_tour = '0'"); // Обнуляем командные туры всех пользователей
	$query999 = mysql_query ("UPDATE chess_teams SET team_count = '0'"); // Обнуляем командные счетчики всех команд

	$query15 = mysql_query("DELETE FROM chess_chess_game WHERE type = '1' AND tourn_id = '$thistournid'"); // Удаляем все игры командного первенства в этом турнире
	$tour_id = 1;
	//$user = &JFactory::getUser();
	//$userid = $user->get('id');
	$query1 = mysql_query("SELECT * FROM chess_users WHERE team <> '0' ORDER BY id ASC LIMIT 1"); // Выбрать пользователя, состоящего в команде, с минимальным ID
	$query2 = mysql_query("SELECT * FROM chess_users WHERE team <> '0' ORDER BY id DESC LIMIT 1");
	$first_id = mysql_fetch_assoc($query1);
 	$last_id = mysql_fetch_assoc($query2);
 	// Тут теперь проверяем количество набранных команд (должно быть не менее двух)
 	$zapros1 = mysql_query ("SELECT COUNT('id') as 'id_count' FROM chess_teams WHERE tourn_id = '$thistournid'"); // Получить количество команд в текущем турнире
  	// team <> 0 - значит состоит в какойто команде, следовательно участвует в распределении
  	$kol = mysql_fetch_assoc($zapros1);
    $kol_app = $kol['id_count']; // Количество командников
    if ($kol_app >= 2)
 		{
 		echo $tour_id; echo "<br>";
   		while ($tour_id <= 1) // Распределяем только первый тур
    		{
            $user_id = 0;
			$rand_id = 0;
			$tour_pr = $tour_id-1;
   	 		$query7 = mysql_query ("SELECT * FROM chess_users WHERE team_tour = '$tour_pr' AND team <> '0'"); // Выбрать участников с прошлым туром
   	 		if (mysql_num_rows($query7) <> 0) // Если они есть (их четное количество, два точно есть!))
   	 			{
   	 			// Выбираем первого игрока
   	 			$zapros35 = mysql_query("SELECT MAX(team_count) as 'max_count' FROM chess_teams"); // Получить максимальный командный счетчик
            	$zapr35 = mysql_fetch_assoc($zapros35);
           		$max_count = $zapr35['max_count'];
           		$query37 = mysql_query ("SELECT * FROM chess_teams WHERE team_count < '$max_count'"); // Найти команды которые выбирались меньше
   	 			if (mysql_num_rows($query37) <> 0) // Если они есть
   	 				{
					$user_id = mt_rand($first_id['id'],$last_id['id']);
					// Случайный, участвует в командном первенстве, еще не выбирался в этом туре и из команды, которая меньше других юзалась
					$zapros36 = mysql_query("SELECT team_count as 'count1' FROM chess_teams WHERE (id_1 = '$user_id' OR id_2 = '$user_id'
					OR id_3 = '$user_id' OR id_4 = '$user_id' OR id_5 = '$user_id' OR id_6 = '$user_id' OR id_7 = '$user_id' OR id_8 = '$user_id') AND tourn_id = '$thistournid'");
					// Получить командный счетчик первой команды
            		$zapr36 = mysql_fetch_assoc($zapros36);
           			$count1 = $zapr36['count1'];
    				$query4 = mysql_query ("SELECT * FROM chess_users WHERE team <> '0' AND id = '$user_id' and team_tour < '$tour_id' and '$count1' < '$max_count'");//Есть такие?
    				while (mysql_num_rows($query4) == 0) // Если нет
						{
						$user_id = rand($first_id['id'],$last_id['id']);
						$zapros36 = mysql_query("SELECT team_count as 'count1' FROM chess_teams WHERE (id_1 = '$user_id' OR id_2 = '$user_id'
						OR id_3 = '$user_id' OR id_4 = '$user_id' OR id_5 = '$user_id' OR id_6 = '$user_id' OR id_7 = '$user_id' OR id_8 = '$user_id') AND tourn_id = '$thistournid'");
            			$zapr36 = mysql_fetch_assoc($zapros36);
           				$count1 = $zapr36['count1'];
       					$query4 = mysql_query ("SELECT * FROM chess_users WHERE team <> '0' AND id = '$user_id' and team_tour < '$tour_id' and '$count1' < '$max_count'");
						}
					$query33 = mysql_query ("SELECT team as 'team1' FROM chess_users WHERE id = '$user_id'"); // Запоминаем команду первого юзера
					$quer33 = mysql_fetch_assoc($query33);
    				$team1 = $quer33['team1'];
					$query5 = mysql_query ("UPDATE chess_users SET team_tour = '$tour_id' WHERE id = '$user_id'"); // Плюсуем тур первому юзеру
					$query34 = mysql_query ("UPDATE chess_teams SET team_count = team_count + 1 WHERE id = '$team1'"); // Плюсуем счетчик в команде первого пользователя
					echo $user_id; echo "<br>";
					}
					else // Если их нет
					{					$user_id = mt_rand($first_id['id'],$last_id['id']);
					// Случайный, участвует в командном первенстве, еще не выбирался в этом туре
    				$query4 = mysql_query ("SELECT * FROM chess_users WHERE team <> '0' AND id = '$user_id' and team_tour < '$tour_id'");
    				while (mysql_num_rows($query4) == 0)
						{
						$user_id = rand($first_id['id'],$last_id['id']);
       					$query4 = mysql_query ("SELECT * FROM chess_users WHERE team <> '0' AND id = '$user_id' and team_tour < '$tour_id'");
						}
					$query33 = mysql_query ("SELECT team as 'team1' FROM chess_users WHERE id = '$user_id'"); // Запоминаем команду первого юзера
					$quer33 = mysql_fetch_assoc($query33);
    				$team1 = $quer33['team1'];
					$query5 = mysql_query ("UPDATE chess_users SET team_tour = '$tour_id' WHERE id = '$user_id'"); // Плюсуем тур первому юзеру
					$query34 = mysql_query ("UPDATE chess_teams SET team_count = team_count + 1 WHERE id = '$team1'"); // Плюсуем счетчик в команде первого пользователя
					echo $user_id; echo "<br>";					}
				// Выбор случайного соперника
				$zapros35 = mysql_query("SELECT MAX(team_count) as 'max_count' FROM chess_teams"); // Получить максимальный командный счетчик
            	$zapr35 = mysql_fetch_assoc($zapros35);
           		$max_count = $zapr35['max_count'];
           		$query37 = mysql_query ("SELECT * FROM chess_teams WHERE team_count < '$max_count'"); // Найти команды которые выбирались меньше
   	 			if (mysql_num_rows($query37) <> 0) // Если они есть
   	 				{
 					$rand_id = mt_rand($first_id['id'],$last_id['id']); // Выбираем случайный id
 					$zapros38 = mysql_query("SELECT team_count as 'count2' FROM chess_teams WHERE (id_1 = '$rand_id' OR id_2 = '$rand_id'
					OR id_3 = '$rand_id' OR id_4 = '$rand_id' OR id_5 = '$rand_id' OR id_6 = '$rand_id' OR id_7 = '$rand_id' OR id_8 = '$rand_id') AND tourn_id = '$thistournid'");
					// Получить командный счетчик второго юзверя
            		$zapr38 = mysql_fetch_assoc($zapros38);
           			$count2 = $zapr38['count2'];
					$query3 = mysql_query ("SELECT * FROM chess_users WHERE team <> '0' AND id = '$rand_id' and team_tour < '$tour_id' and '$count2' < '$max_count' and team <> '$team1'");
					while (mysql_num_rows($query3) == 0)
						{
						$rand_id=rand($first_id['id'],$last_id['id']);
						$zapros38 = mysql_query("SELECT team_count as 'count2' FROM chess_teams WHERE (id_1 = '$rand_id' OR id_2 = '$rand_id'
						OR id_3 = '$rand_id' OR id_4 = '$rand_id' OR id_5 = '$rand_id' OR id_6 = '$rand_id' OR id_7 = '$rand_id' OR id_8 = '$rand_id') AND tourn_id = '$thistournid'");
						// Получить командный счетчик второго юзверя
            			$zapr38 = mysql_fetch_assoc($zapros38);
           				$count2 = $zapr38['count2'];
    	   				$query3 = mysql_query ("SELECT * FROM chess_users WHERE team <> '0' AND id = '$rand_id' and team_tour <> '$tour_id' and '$count2' < '$max_count' and team <> '$team1'");
						}
					$query33 = mysql_query ("SELECT team as 'team2' FROM chess_users WHERE id = '$rand_id'"); // Запоминаем команду второго юзера
					$quer33 = mysql_fetch_assoc($query33);
    				$team2 = $quer33['team2'];
					$query6 = mysql_query ("UPDATE chess_users SET team_tour = '$tour_id' WHERE id = '$rand_id'"); // Плюсуем тур второму юзеру
					$query34 = mysql_query ("UPDATE chess_teams SET team_count = team_count + 1 WHERE id = '$team2'"); // Плюсуем счетчик в команде второго юзверя
					$challenger_id = $rand_id; echo $rand_id; echo "<br>";
	    			}
	    			else // Если их нет
	    			{	    			$rand_id = mt_rand($first_id['id'],$last_id['id']); // Выбираем случайный id
					$query3 = mysql_query ("SELECT * FROM chess_users WHERE team <> '0' AND id = '$rand_id' and team_tour < '$tour_id' and team <> '$team1'");
					while (mysql_num_rows($query3) == 0)
						{
						$rand_id=rand($first_id['id'],$last_id['id']);;
    	   				$query3 = mysql_query ("SELECT * FROM chess_users WHERE team <> '0' AND id = '$rand_id' and team_tour < '$tour_id' and team <> '$team1'");
						}
					$query33 = mysql_query ("SELECT team as 'team2' FROM chess_users WHERE id = '$rand_id'"); // Запоминаем команду второго юзера
					$quer33 = mysql_fetch_assoc($query33);
    				$team2 = $quer33['team2'];
					$query6 = mysql_query ("UPDATE chess_users SET team_tour = '$tour_id' WHERE id = '$rand_id'"); // Плюсуем тур второму юзеру
					$query34 = mysql_query ("UPDATE chess_teams SET team_count = team_count + 1 WHERE id = '$team2'"); // Плюсуем счетчик в команде второго юзверя
					$challenger_id = $rand_id; echo $rand_id; echo "<br>";	    			}
	    		}
			$color = rand(0,1);
			$notify = 0; // Yes
			if ($user_id <>0 and $rand_id <> 0)
				{
				// Создаем новую игру
				pcc_ProcessNewGame($user_id, $color, $notify, $comment, $challenger_id);
				$end = pcc_GetGameId();
				$query13 = mysql_query ("UPDATE chess_chess_game SET tour = '$tour_id' , complete = '0' , type = '1', tourn_id = '$thistournid' WHERE game_id = '$end'");
				}

			$query14 = mysql_query ("SELECT * FROM chess_users WHERE team <> '0' AND team_tour = '$tour_pr'"); // Остались нераспределенные игроки?
    		if (mysql_num_rows($query14) == 0)
				{
				$tour_id = $tour_id+1;
				}
			}
      	}
      	else
        {
       	echo "<h2>Not enough teams for the team championship</h2>";
      	}
}

function pcc_TeamProverka() {
// Проверяется все ли игры завершены и определяется победитель и если что добавляется тур
	global $team_points;

	$query21 = mysql_query ("SELECT id as 'thistournid' FROM chess_tournaments ORDER BY id DESC LIMIT 1");
    $quer21 = mysql_fetch_assoc($query21); // Запоминаем id текущего турнира (последний по счету, но не последний по важности=))))
   	$thistournid = $quer21['thistournid'];

 	$max_tour = pcc_GetMaxTourTeam($thistournid); // Получить максимальный тур в этом турнире (текущий)
    $tour_id = $max_tour+1; // Текущий тур
    $tour_pr = $tour_id-1; // Прошлый тур - для проверки, остались ли в нем незаконченые игры

    // Далее из БД дергается количество обязательных туров
    $query20 = mysql_query ("SELECT kolobyazteamtur as 'kolobyazteamtur' FROM chess_tournaments WHERE id = '$thistournid'");
    $quer20 = mysql_fetch_assoc($query20);
    $kolobyaztur = $quer20['kolobyazteamtur'];

    $qqquery15 = mysql_query ("SELECT * FROM chess_chess_game WHERE type = '1' and tourn_id = '$thistournid'"); // Все игры командного первенства в этом турнире
    $query15 = mysql_query ("SELECT * FROM chess_chess_game WHERE type = '1' AND complete = '0' AND tourn_id = '$thistournid'"); // Все начатые игры
   	//если все игры в текущем командном турнире завершены и если они вообще есть, то...
   	if ((mysql_num_rows($query15) == 0) AND (mysql_num_rows($qqquery15) <> 0))
   		{
   		if ($max_tour >= $kolobyaztur) // Если обязательные туры проведены
   			{
   			//Определяем пабидитибля
			pcc_GetTeamPoints(pcc_GetCommandPlayers(),0);
			$max_point = 0;
    		foreach ($team_points as $a) // Ищем максимальное очко
    			{
    			if ($a > $max_point)
    				{
    				$max_point = $a;
    				}
    			}
    		$count_point = 0;
    		foreach ($team_points as $b) // Считаем количество лидеров
    			{
    			if ($b == $max_point)
    				{
    				$count_point = $count_point+1;
    				}
    			}
  			}
  			else
  			{
  			$count_point = 2; // Просто делаем условие неопределенного победителя
  			}
  			//echo $count_point;
    	if ($count_point > 1)
    		{
    		// Паибитиль не определен
    		//echo "Zahodit";
    		//echo $tour_id;
    		//echo $tour_pr;
    		$query999 = mysql_query ("UPDATE chess_teams SET team_count = '0'"); // Обнуляем командные счетчики всех команд
			$query1 = mysql_query("SELECT * FROM chess_users WHERE team <> '0' ORDER BY id ASC LIMIT 1"); // Выбрать пользователя, состоящего в команде, с минимальным ID
			$query2 = mysql_query("SELECT * FROM chess_users WHERE team <> '0' ORDER BY id DESC LIMIT 1");
			$first_id = mysql_fetch_assoc($query1);
 			$last_id = mysql_fetch_assoc($query2);
   			while ($tour_id <> $tour_pr) // Распределяем только один тур
    			{
            	$user_id = 0;
				$rand_id = 0;
				//echo "Yes";
   	 			$query7 = mysql_query ("SELECT * FROM chess_users WHERE team_tour = '$tour_pr' AND team <> '0'"); // Выбрать участников с прошлым туром
   	 			if (mysql_num_rows($query7) <> 0) // Если они есть (их четное количество, два точно есть!))
   	 				{   	 				//	echo "Yes";
   	 				// Выбираем первого игрока
   	 				$zapros35 = mysql_query("SELECT MAX(team_count) as 'max_count' FROM chess_teams"); // Получить максимальный командный счетчик
            		$zapr35 = mysql_fetch_assoc($zapros35);
           			$max_count = $zapr35['max_count'];
           			$query37 = mysql_query ("SELECT * FROM chess_teams WHERE team_count < '$max_count'"); // Найти команды которые выбирались меньше
   	 				if (mysql_num_rows($query37) <> 0) // Если они есть
   	 					{
						$user_id = mt_rand($first_id['id'],$last_id['id']);
						// Случайный, участвует в командном первенстве, еще не выбирался в этом туре и из команды, которая меньше других юзалась
						$zapros36 = mysql_query("SELECT team_count as 'count1' FROM chess_teams WHERE (id_1 = '$user_id' OR id_2 = '$user_id'
						OR id_3 = '$user_id' OR id_4 = '$user_id' OR id_5 = '$user_id' OR id_6 = '$user_id' OR id_7 = '$user_id' OR id_8 = '$user_id') AND tourn_id = '$thistournid'");
						// Получить командный счетчик первой команды
            			$zapr36 = mysql_fetch_assoc($zapros36);
           				$count1 = $zapr36['count1'];
    					$query4 = mysql_query ("SELECT * FROM chess_users WHERE team <> '0' AND id = '$user_id' and team_tour < '$tour_id' and '$count1' < '$max_count'");//Есть такие?
    					while (mysql_num_rows($query4) == 0) // Если нет
							{
							$user_id = rand($first_id['id'],$last_id['id']);
							$zapros36 = mysql_query("SELECT team_count as 'count1' FROM chess_teams WHERE (id_1 = '$user_id' OR id_2 = '$user_id'
							OR id_3 = '$user_id' OR id_4 = '$user_id' OR id_5 = '$user_id' OR id_6 = '$user_id' OR id_7 = '$user_id' OR id_8 = '$user_id') AND tourn_id = '$thistournid'");
            				$zapr36 = mysql_fetch_assoc($zapros36);
           					$count1 = $zapr36['count1'];
       						$query4 = mysql_query ("SELECT * FROM chess_users WHERE team <> '0' AND id = '$user_id' and team_tour < '$tour_id' and '$count1' < '$max_count'");
							}
						$query33 = mysql_query ("SELECT team as 'team1' FROM chess_users WHERE id = '$user_id'"); // Запоминаем команду первого юзера
						$quer33 = mysql_fetch_assoc($query33);
    					$team1 = $quer33['team1'];
						$query5 = mysql_query ("UPDATE chess_users SET team_tour = '$tour_id' WHERE id = '$user_id'"); // Плюсуем тур первому юзеру
						$query34 = mysql_query ("UPDATE chess_teams SET team_count = team_count + 1 WHERE id = '$team1'"); // Плюсуем счетчик в команде первого пользователя
						//echo $user_id; echo "<br>";
						}
						else // Если их нет
						{
						$user_id = mt_rand($first_id['id'],$last_id['id']);
						// Случайный, участвует в командном первенстве, еще не выбирался в этом туре
    					$query4 = mysql_query ("SELECT * FROM chess_users WHERE team <> '0' AND id = '$user_id' and team_tour < '$tour_id'");
    					while (mysql_num_rows($query4) == 0)
							{
							$user_id = rand($first_id['id'],$last_id['id']);
       						$query4 = mysql_query ("SELECT * FROM chess_users WHERE team <> '0' AND id = '$user_id' and team_tour < '$tour_id'");
							}
						$query33 = mysql_query ("SELECT team as 'team1' FROM chess_users WHERE id = '$user_id'"); // Запоминаем команду первого юзера
						$quer33 = mysql_fetch_assoc($query33);
    					$team1 = $quer33['team1'];
						$query5 = mysql_query ("UPDATE chess_users SET team_tour = '$tour_id' WHERE id = '$user_id'"); // Плюсуем тур первому юзеру
						$query34 = mysql_query ("UPDATE chess_teams SET team_count = team_count + 1 WHERE id = '$team1'"); // Плюсуем счетчик в команде первого пользователя
						//echo $user_id; echo "<br>";
						}
					// Выбор случайного соперника
					$zapros35 = mysql_query("SELECT MAX(team_count) as 'max_count' FROM chess_teams"); // Получить максимальный командный счетчик
            		$zapr35 = mysql_fetch_assoc($zapros35);
           			$max_count = $zapr35['max_count'];
           			$query37 = mysql_query ("SELECT * FROM chess_teams WHERE team_count < '$max_count'"); // Найти команды которые выбирались меньше
   	 				if (mysql_num_rows($query37) <> 0) // Если они есть
   	 					{
 						$rand_id = mt_rand($first_id['id'],$last_id['id']); // Выбираем случайный id
 						$zapros38 = mysql_query("SELECT team_count as 'count2' FROM chess_teams WHERE (id_1 = '$rand_id' OR id_2 = '$rand_id'
						OR id_3 = '$rand_id' OR id_4 = '$rand_id' OR id_5 = '$rand_id' OR id_6 = '$rand_id' OR id_7 = '$rand_id' OR id_8 = '$rand_id') AND tourn_id = '$thistournid'");
						// Получить командный счетчик второго юзверя
            			$zapr38 = mysql_fetch_assoc($zapros38);
           				$count2 = $zapr38['count2'];
						$query3 = mysql_query ("SELECT * FROM chess_users WHERE team <> '0' AND id = '$rand_id' and team_tour < '$tour_id' and '$count2' < '$max_count' and team <> '$team1'");
						while (mysql_num_rows($query3) == 0)
							{
							$rand_id=rand($first_id['id'],$last_id['id']);
							$zapros38 = mysql_query("SELECT team_count as 'count2' FROM chess_teams WHERE (id_1 = '$rand_id' OR id_2 = '$rand_id'
							OR id_3 = '$rand_id' OR id_4 = '$rand_id' OR id_5 = '$rand_id' OR id_6 = '$rand_id' OR id_7 = '$rand_id' OR id_8 = '$rand_id') AND tourn_id = '$thistournid'");
							// Получить командный счетчик второго юзверя
            				$zapr38 = mysql_fetch_assoc($zapros38);
           					$count2 = $zapr38['count2'];
    	   					$query3 = mysql_query ("SELECT * FROM chess_users WHERE team <> '0' AND id = '$rand_id' and team_tour <> '$tour_id' and '$count2' < '$max_count' and team <> '$team1'");
							}
						$query33 = mysql_query ("SELECT team as 'team2' FROM chess_users WHERE id = '$rand_id'"); // Запоминаем команду второго юзера
						$quer33 = mysql_fetch_assoc($query33);
    					$team2 = $quer33['team2'];
						$query6 = mysql_query ("UPDATE chess_users SET team_tour = '$tour_id' WHERE id = '$rand_id'"); // Плюсуем тур второму юзеру
						$query34 = mysql_query ("UPDATE chess_teams SET team_count = team_count + 1 WHERE id = '$team2'"); // Плюсуем счетчик в команде второго юзверя
						$challenger_id = $rand_id; //echo $rand_id; echo "<br>";
			   			}
	    				else // Если их нет
	    				{
	    				$rand_id = mt_rand($first_id['id'],$last_id['id']); // Выбираем случайный id
						$query3 = mysql_query ("SELECT * FROM chess_users WHERE team <> '0' AND id = '$rand_id' and team_tour < '$tour_id' and team <> '$team1'");
						while (mysql_num_rows($query3) == 0)
							{
							$rand_id=rand($first_id['id'],$last_id['id']);;
    	   					$query3 = mysql_query ("SELECT * FROM chess_users WHERE team <> '0' AND id = '$rand_id' and team_tour < '$tour_id' and team <> '$team1'");
							}
						$query33 = mysql_query ("SELECT team as 'team2' FROM chess_users WHERE id = '$rand_id'"); // Запоминаем команду второго юзера
						$quer33 = mysql_fetch_assoc($query33);
    					$team2 = $quer33['team2'];
						$query6 = mysql_query ("UPDATE chess_users SET team_tour = '$tour_id' WHERE id = '$rand_id'"); // Плюсуем тур второму юзеру
						$query34 = mysql_query ("UPDATE chess_teams SET team_count = team_count + 1 WHERE id = '$team2'"); // Плюсуем счетчик в команде второго юзверя
						$challenger_id = $rand_id; //echo $rand_id; echo "<br>";
	    				}
	    			}
				$color = rand(0,1);
				$notify = 0; // Yes
				if ($user_id <>0 and $rand_id <> 0)
					{
					// Создаем новую игру
					pcc_ProcessNewGame($user_id, $color, $notify, $comment, $challenger_id);
					$end = pcc_GetGameId();
					$query13 = mysql_query ("UPDATE chess_chess_game SET tour = '$tour_id' , complete = '0' , type = '1', tourn_id = '$thistournid' WHERE game_id = '$end'");
					// Далее проверяем, покинул ли ктото из участников турнир
					$querry13 = mysql_query("SELECT team_out FROM chess_users WHERE id = '$user_id'");
					$querr13 = mysql_fetch_assoc($querry13);
					$team_out_1 = $querr13['team_out'];
					if ($team_out_1 == 1) // Заносим поражение первому
						{                        $querry14 = mysql_query("SELECT white_user_id FROM chess_chess_game WHERE game_id = '$end'");
                        $querr14 = mysql_fetch_assoc($querry14);
                        $white_user_id = $querr14['white_user_id'];
                        if ($white_user_id == $user_id) // Заносим поражение белому
                        	{                        	$querry15 = mysql_query ("UPDATE chess_chess_game SET complete = '1' , result = '1' WHERE game_id = '$end'");                        	}
                        	else // Иначе - черному
                        	{                        	$querry15 = mysql_query ("UPDATE chess_chess_game SET complete = '1' , result = '0' WHERE game_id = '$end'");                        	}						}
					$querrry13 = mysql_query("SELECT team_out FROM chess_users WHERE id = '$rand_id'");
					$querrr13 = mysql_fetch_assoc($querrry13);
					$team_out_2 = $querrr13['team_out'];
					if ($team_out_2 == 1) // Заносим поражение второму
						{
                        $querry14 = mysql_query("SELECT white_user_id FROM chess_chess_game WHERE game_id = '$end'");
                        $querr14 = mysql_fetch_assoc($querry14);
                        $white_user_id = $querr14['white_user_id'];
                        if ($white_user_id == $rand_id) // Заносим поражение белому
                        	{
                        	$querry15 = mysql_query ("UPDATE chess_chess_game SET complete = '1' , result = '1' WHERE game_id = '$end'");
                        	}
                        	else // Иначе - черному
                        	{
                        	$querry15 = mysql_query ("UPDATE chess_chess_game SET complete = '1' , result = '0' WHERE game_id = '$end'");
                        	}
						}
	                if (($team_out_1 == 1) AND ($team_out_2 == 1)) // Если оба вышли - ничья
	                	{                        $querry15 = mysql_query ("UPDATE chess_chess_game SET complete = '1' , result = '2' WHERE game_id = '$end'");	                	}
					}
				$query14 = mysql_query ("SELECT * FROM chess_users WHERE team <> '0' AND team_tour = '$tour_pr'"); // Остались нераспределенные игроки?
    			if (mysql_num_rows($query14) == 0)
					{
					$tour_id = $tour_id-1;
					}
				}
			// И высылаем всем участникам письмо что запущены игры следующего тура
   			$mailfrom = 'wit-89@mail.ru';
			$fromname = 'Chess Tournament Site';
			$subject = 'The events of the tournament';
        	$message = 'Attention! Run the game the next round of the championship team.';
			$querry22 = mysql_query ("SELECT id as 'min_id' FROM chess_users WHERE team <> '0' ORDER BY id ASC LIMIT 1"); // Выбрать игрока текущего турнира с минимальным ID
			$querry23 = mysql_query ("SELECT id as 'max_id' FROM chess_users WHERE team <> '0' ORDER BY id DESC LIMIT 1");// Выбрать игрока текущего турнира с максимальным ID
    		$querr22 = mysql_fetch_assoc($querry22);
    		$querr23 = mysql_fetch_assoc($querry23);
    		$min_id = $querr22['min_id'];
    		$max_id = $querr23['max_id'];
    		for ($i = $min_id; $i <= $max_id; $i++)
    			{
    			$querry24 = mysql_query ("SELECT id as 'next_id' FROM chess_users WHERE id = '$i' AND team <> '0'");
    			$querr24 = mysql_fetch_assoc($querry24);
    			$next_id = $querr24['next_id'];
    			if ($next_id <> 0)
    				{
    				$querry25 = mysql_query("SELECT email FROM chess_users WHERE id = '$i'");
    				$querr25 = mysql_fetch_assoc($querry25);
    				$email = $querr25['next_id'];
    				JUtility::sendMail($mailfrom, $fromname, $email, $subject, $message);
    				}
    			}
			}
    	/*if ($count_point == 1) // Победитель определен. Выводим его имя!
    		{
    		$query17 = mysql_query ("SELECT team_winner_id as 'winner_id' FROM chess_tournaments WHERE id = '$thistournid'");
            $win_id = mysql_fetch_assoc($query17); // Запрашиваем id победителя
           	$winner_id = $win_id['winner_id'];
    		$query16 = mysql_query ("SELECT name as 'winner_name' FROM chess_teams WHERE id = '$winner_id'");
            $win = mysql_fetch_assoc($query16);
           	$winner = $win['winner_name'];
    		echo "<div class=\"activegames\"><h1>Attention! Completed all the games in the team championship!<br>
    		<br>The WINNER in team championship is " . $winner . "!<br><br>Congratulations!</h1></div>";
    		}  */
   		}
}

function pcc_GetAllActiveGames() {
	// replacement for global $database variable
	$db = &JFactory::getDbo();
	$query = pcc_GetGameListSQL('g.complete = 0');
	$db->setQuery( $query );
	return $db->loadObjectList();
}

function pcc_GetAllCompleteGames() {
	// replacement for global $database variable
	$db = &JFactory::getDbo();
	$query = pcc_GetGameListSQL('g.complete = 1');
	$db->setQuery( $query );
	return $db->loadObjectList();
}

function pcc_GetAllGamesAwaitingAnyPlayer() {
	// replacement for global $database variable
	$db = &JFactory::getDbo();
	$query = pcc_GetGameListSQL('g.complete = 2');
	$db->setQuery( $query );
	return $db->loadObjectList();
}

function pcc_GetAllGamesAwaitingAnyButOnePlayer($user_id) {
	// replacement for global $database variable
	$db = &JFactory::getDbo();
	$query = pcc_GetGameListSQL('((g.complete = 2) AND NOT (black_user_id = ' . $user_id . ' OR white_user_id = ' . $user_id . '))');
	$db->setQuery( $query );
	return $db->loadObjectList();
}

function pcc_GetAllGamesAwaitingAPlayer($user_id) {
	// replacement for global $database variable
	$db = &JFactory::getDbo();
	$query = pcc_GetGameListSQL('(g.complete = 3 AND black_user_id = ' . $user_id . ') OR (g.complete = 4 AND white_user_id = ' . $user_id . ')');
	$db->setQuery( $query );
	return $db->loadObjectList();
}


function pcc_GetAllGamesIssuedByAPlayer($user_id) {
	// replacement for global $database variable
	$db = &JFactory::getDbo();
	$query = pcc_GetGameListSQL('((g.complete = 4 AND black_user_id = ' . $user_id . ') OR (g.complete = 3 AND white_user_id = ' . $user_id . '))' .
	 ' OR ((g.complete = 2) AND (black_user_id = ' . $user_id . ' OR white_user_id = ' . $user_id . '))');
	$db->setQuery( $query );
	return $db->loadObjectList();
}

function pcc_GetAllPlayers() {
	// replacement for global $database variable
	$db = &JFactory::getDbo();
	$query = "SELECT u.id, \n" .
	 " u.username, \n" .
	 "  name, \n" .
	 "  u.email, \n" .
	 "  COUNT(g.game_id) games_white,  \n" .
	 "  SUM(IF(g.complete=0,1,0)) active_games_white, \n" .
	 "  SUM(IF(g.complete=1,1,0)) complete_games_white, \n" .
	 "  SUM(IF((g.result = 0 or g.result = 5) AND (g.complete=1), 1, 0)) wins_white, \n" .
	 "  SUM(IF((g.result = 2 or g.result = 3) AND (g.complete=1), 1, 0)) draws_white, \n" .
	 "  0 as games_black,  \n" .
	 "  0 as active_games_black,  \n" .
	 "  0 as complete_games_black, \n" .
	 "  0 as wins_black, \n" .
	 "  0 as draws_black \n" .
	 " FROM #__chess_game g INNER JOIN #__users u ON g.white_user_id = u.id  \n" .
	 " GROUP BY u.id, u.username, u.email  \n" .
	 " ORDER BY u.username, u.id";
	$db->setQuery( $query );
	$db->query();
	$user_list = $db->loadObjectList();

	$query = "SELECT u.id, \n" .
	 " u.username, \n" .
	 "  u.email, \n" .
	 "  0 as games_white,  \n" .
	 "  0 as active_games_white,  \n" .
	 "  0 as complete_games_white, \n" .
	 "  0 as wins_white, \n" .
	 "  0 as draws_white, \n" .
	 "  COUNT(g.game_id) games_black,  \n" .
	 "  SUM(IF(g.complete=0,1,0)) active_games_black, \n" .
	 "  SUM(IF(g.complete=1,1,0)) complete_games_black, \n" .
	 "  SUM(IF((g.result = 1 or g.result = 4) AND (g.complete=1), 1, 0)) wins_black, \n" .
	 "  SUM(IF((g.result = 2 or g.result = 3) AND (g.complete=1), 1, 0)) draws_black \n" .
	 " FROM #__chess_game g INNER JOIN #__users u ON g.black_user_id = u.id  \n" .
	 " GROUP BY u.id, u.username, u.email  \n" .
	 " ORDER BY u.username, u.id";
	$db->setQuery( $query );
	$db->query();
	$black_list = $db->loadObjectList();

	// Эт я добавил - тут выводится инфо о последнем игроке которого еще нет в списке игр
    $zapros2 = mysql_query("SELECT MAX(tour) as 'max_tour' FROM chess_users"); // Получить максимальный тур
    $maxt = mysql_fetch_assoc($zapros2);
    $max_tour = $maxt['max_tour'];
	if ($max_tour == 1)// Это если первый тур тока
	{
	$query = "SELECT u.id, \n" .
	 " u.username, \n" .
	 "  u.email, \n" .
	 "  0 as games_white,  \n" .
	 "  0 as active_games_white,  \n" .
	 "  0 as complete_games_white, \n" .
	 "  0 as wins_white, \n" .
	 "  0 as draws_white, \n" .
	 "  0 as games_black,  \n" .
	 "  0 as active_games_black,  \n" .
	 "  0 as complete_games_black, \n" .
	 "  0 as wins_black, \n" .
	 "  0 as draws_black \n" .
	 " FROM #__chess_game g INNER JOIN #__users u WHERE u.dop = 1 \n" .
	 " GROUP BY u.id, u.username, u.email  \n" .
	 " ORDER BY u.username, u.id";
	$db->setQuery( $query );
	$db->query();
	$posledniy_list = $db->loadObjectList();
	foreach($posledniy_list as $posledniy)
		{
		$user_list[] = $posledniy;
		}
	}

	foreach($black_list as $black) {
		$key = pcc_array_usearch('pcc_compare_user_objects', $black, $user_list);
		if ($key == -1) {
			// Add element to array and set white values.
			$user_list[] = $black;
		} else {
			//Set black values.
			$user_list[$key]->active_games_black = $black->games_black;
			$user_list[$key]->active_games_black = $black->active_games_black;
			$user_list[$key]->complete_games_black = $black->complete_games_black;
			$user_list[$key]->wins_black = $black->wins_black;
			$user_list[$key]->draws_black = $black->draws_black;
		}
	}
	uasort($user_list,'pcc_Compare_User_Names');
	return  $user_list;
}

function pcc_GetIndividualPlayers() {
	// replacement for global $database variable
	// Получить список игроков личного первенства текущего турнира
	$query21 = mysql_query ("SELECT id as 'thistournid' FROM chess_tournaments ORDER BY id DESC LIMIT 1");
    $quer21 = mysql_fetch_assoc($query21); // Запоминаем id текущего турнира (последний по счету, но не последний по важности=))))
   	$thistournid = $quer21['thistournid'];
   	if (mysql_num_rows($query21) == 0)     // Чтобы не было ошибки когда не создано турниров
   		{   		$thistournid = 0;   		}

	$db = &JFactory::getDbo();
	$query = "SELECT u.id, \n" .
	 " u.username, \n" .
	 "  name, \n" .
	 "  u.email, \n" .
	 " u.dop as dop, \n" .
	 "  COUNT(g.game_id) games_white,  \n" .
	 "  SUM(IF(g.complete=0,1,0)) active_games_white, \n" .
	 "  SUM(IF(g.complete=1,1,0)) complete_games_white, \n" .
	 "  SUM(IF((g.result = 0 or g.result = 5) AND (g.complete=1), 1, 0)) wins_white, \n" .
	 "  SUM(IF((g.result = 2 or g.result = 3) AND (g.complete=1), 1, 0)) draws_white, \n" .
	 "  0 as games_black,  \n" .
	 "  0 as active_games_black,  \n" .
	 "  0 as complete_games_black, \n" .
	 "  0 as wins_black, \n" .
	 "  0 as draws_black \n" .
	 " FROM #__chess_game g INNER JOIN #__users u ON g.white_user_id = u.id WHERE g.type = 0 AND g.tourn_id = $thistournid \n" .
	 " GROUP BY u.id, u.username, u.email  \n" .
	 " ORDER BY u.username, u.id";
	$db->setQuery( $query );
	$db->query();
	$user_list = $db->loadObjectList();

	$query = "SELECT u.id, \n" .
	 " u.username, \n" .
	 "  u.email, \n" .
	 " u.dop as dop, \n" .
	 "  0 as games_white,  \n" .
	 "  0 as active_games_white,  \n" .
	 "  0 as complete_games_white, \n" .
	 "  0 as wins_white, \n" .
	 "  0 as draws_white, \n" .
	 "  COUNT(g.game_id) games_black,  \n" .
	 "  SUM(IF(g.complete=0,1,0)) active_games_black, \n" .
	 "  SUM(IF(g.complete=1,1,0)) complete_games_black, \n" .
	 "  SUM(IF((g.result = 1 or g.result = 4) AND (g.complete=1), 1, 0)) wins_black, \n" .
	 "  SUM(IF((g.result = 2 or g.result = 3) AND (g.complete=1), 1, 0)) draws_black \n" .
	 " FROM #__chess_game g INNER JOIN #__users u ON g.black_user_id = u.id WHERE g.type = 0 AND g.tourn_id = $thistournid \n" .
	 " GROUP BY u.id, u.username, u.email  \n" .
	 " ORDER BY u.username, u.id";
	$db->setQuery( $query );
	$db->query();
	$black_list = $db->loadObjectList();

	foreach($black_list as $black) {
		$key = pcc_array_usearch('pcc_compare_user_objects', $black, $user_list);
		if ($key == -1) {
			// Add element to array and set white values.
			$user_list[] = $black;
		} else {
			//Set black values.
			$user_list[$key]->active_games_black = $black->games_black;
			$user_list[$key]->active_games_black = $black->active_games_black;
			$user_list[$key]->complete_games_black = $black->complete_games_black;
			$user_list[$key]->wins_black = $black->wins_black;
			$user_list[$key]->draws_black = $black->draws_black;
		}
	}
	uasort($user_list,'pcc_Compare_User_Names');
	return  $user_list;
}

function pcc_GetCommandPlayers() {
	// replacement for global $database variable
	// Получить список игроков личного первенства текущего турнира
	$query21 = mysql_query ("SELECT id as 'thistournid' FROM chess_tournaments ORDER BY id DESC LIMIT 1");
    $quer21 = mysql_fetch_assoc($query21); // Запоминаем id текущего турнира (последний по счету, но не последний по важности=))))
   	$thistournid = $quer21['thistournid'];
    if (mysql_num_rows($query21) == 0)     // Чтобы не было ошибки когда не создано турниров
   		{
   		$thistournid = 0;
   		}

	$db = &JFactory::getDbo();
	$query = "SELECT u.id, \n" .
	 " u.username, \n" .
	 "  name, \n" .
	 "  u.email, \n" .
	 "  0 as dop, \n" .
	 "  COUNT(g.game_id) games_white,  \n" .
	 "  SUM(IF(g.complete=0,1,0)) active_games_white, \n" .
	 "  SUM(IF(g.complete=1,1,0)) complete_games_white, \n" .
	 "  SUM(IF((g.result = 0 or g.result = 5) AND (g.complete=1), 1, 0)) wins_white, \n" .
	 "  SUM(IF((g.result = 2 or g.result = 3) AND (g.complete=1), 1, 0)) draws_white, \n" .
	 "  0 as games_black,  \n" .
	 "  0 as active_games_black,  \n" .
	 "  0 as complete_games_black, \n" .
	 "  0 as wins_black, \n" .
	 "  0 as draws_black \n" .
	 " FROM #__chess_game g INNER JOIN #__users u ON g.white_user_id = u.id WHERE g.type = 1 AND g.tourn_id = $thistournid \n" .
	 " GROUP BY u.id, u.username, u.email  \n" .
	 " ORDER BY u.username, u.id";
	$db->setQuery( $query );
	$db->query();
	$user_list = $db->loadObjectList();

	$query = "SELECT u.id, \n" .
	 " u.username, \n" .
	 "  u.email, \n" .
	 "  0 as dop, \n" .
	 "  0 as games_white,  \n" .
	 "  0 as active_games_white,  \n" .
	 "  0 as complete_games_white, \n" .
	 "  0 as wins_white, \n" .
	 "  0 as draws_white, \n" .
	 "  COUNT(g.game_id) games_black,  \n" .
	 "  SUM(IF(g.complete=0,1,0)) active_games_black, \n" .
	 "  SUM(IF(g.complete=1,1,0)) complete_games_black, \n" .
	 "  SUM(IF((g.result = 1 or g.result = 4) AND (g.complete=1), 1, 0)) wins_black, \n" .
	 "  SUM(IF((g.result = 2 or g.result = 3) AND (g.complete=1), 1, 0)) draws_black \n" .
	 " FROM #__chess_game g INNER JOIN #__users u ON g.black_user_id = u.id WHERE g.type = 1 AND g.tourn_id = $thistournid \n" .
	 " GROUP BY u.id, u.username, u.email  \n" .
	 " ORDER BY u.username, u.id";
	$db->setQuery( $query );
	$db->query();
	$black_list = $db->loadObjectList();

	foreach($black_list as $black) {
		$key = pcc_array_usearch('pcc_compare_user_objects', $black, $user_list);
		if ($key == -1) {
			// Add element to array and set white values.
			$user_list[] = $black;
		} else {
			//Set black values.
			$user_list[$key]->active_games_black = $black->games_black;
			$user_list[$key]->active_games_black = $black->active_games_black;
			$user_list[$key]->complete_games_black = $black->complete_games_black;
			$user_list[$key]->wins_black = $black->wins_black;
			$user_list[$key]->draws_black = $black->draws_black;
		}
	}
	uasort($user_list,'pcc_Compare_User_Names');
	return  $user_list;
}

function pcc_Compare_User_Names($a, $b) {
       $al = strtolower($a->username);
       $bl = strtolower($b->username);
       if ($al == $bl) {
           return 0;
       }
       return ($al > $bl) ? +1 : -1;
}

function pcc_array_usearch($cb, $ndl, $hs, $strict=false) {
   if (!is_array($hs)) user_error('Third argument to array_usearch is expected to be an array, '.gettype($hs).' given', E_USER_ERROR);
   foreach($hs as $key=>$value) if (call_user_func_array($cb, Array($ndl, $value, $key, $strict))) return $key;
   return -1;
};

function pcc_compare_user_objects($ndl, $value, $key, $strict) {
	return ($ndl->id == $value->id);
}

function pcc_GetAllGames(){
	// replacement for global $database variable
	$db = &JFactory::getDbo();
	$query = pcc_GetGameListSQL('');
	$db->setQuery( $query );
	return $db->loadObjectList();
}

function pcc_GetGameListSQL($where, $having = '') {
    return "SELECT g.game_id, \n " .
     "g.tour, \n " .
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
     (! empty($where) ? "WHERE " . $where . " \n": "") .
	 "GROUP BY g.game_id, \n " .
     "g.tour, \n " .
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
     (! empty($having) ? "HAVING " . $having . " \n": "") .
     "ORDER BY last_move DESC, g.start ASC ";
}

function pcc_GetGameItemId($game_info) {
	if ($game_info->complete == 0) {
		return pcc_GetItemIdActiveGameMenuID();
	} elseif ($game_info->complete == 1) {
		return pcc_GetItemIdCompleteGameMenuID();
	} elseif (($game_info->complete == 2) || ($game_info->complete == 3) || ($game_info->complete == 4)) {
		return pcc_GetItemIdNewGameMenuID();
	} else {
		return pcc_GetItemIdMainMenuID();
	}
}

function pcc_GetGamehref($game_info, $move=-1, $color=-1){
	if (empty($game_info)) {
		return JRoute::_(JUri::base()."index.php?option=com_pcchess&Itemid=" . pcc_GetItemIdMainMenuID());
	} else {
		if ($move==-1) {
			return JRoute::_(JUri::base()."index.php?option=com_pcchess&Itemid=" . pcc_GetGameItemId($game_info) .
			 "&page=showgame&game_id=" . $game_info->game_id);
		} else {
			return JRoute::_(JUri::base()."index.php?option=com_pcchess&Itemid=" . pcc_GetGameItemId($game_info) .
			 "&page=showgame&game_id=" . $game_info->game_id . "&move=" . $move . "&color=" . $color);
		}
	}
}

function pcc_GetGamePGNhref($game_info) {
	return JRoute::_(JUri::base()."index.php?option=com_pcchess&page=exportgame&game_id=" . $game_info->game_id);
}

function pcc_SetItemID($pItemid) {
	global $Itemid;
	if (empty($_REQUEST['Itemid']) || !(($_REQUEST['Itemid'] == pcc_GetItemIdActiveGameMenuID()) ||
	 ($_REQUEST['Itemid'] == pcc_GetItemIdCompleteGameMenuID()) ||
	 ($_REQUEST['Itemid'] == pcc_GetItemIdNewGameMenuID()) ||
	 ($_REQUEST['Itemid'] == pcc_GetItemIdPlayersMenuID()) ||
	 ($_REQUEST['Itemid'] == pcc_GetItemIdMainMenuID()))) {
		$_REQUEST['Itemid'] = $pItemid;
		$Itemid = $pItemid;
	}
}

function pcc_GetDiscussThisLink($game_info) {
	global $pcc_lang;
	$link = "";
	$discuss_link = "";
	if (!empty($game_info->discuss_url)) {
		if (is_callable('pcc_GetLinkFromGameInfo', false)) {
			$link = pcc_GetLinkFromGameInfo($game_info);
		} else {
			$link_text = $pcc_lang['discuss_this_link_view_comments'];
			$discuss_link = $game_info->discuss_url;
		}
	} elseif (is_callable('pcc_DiscussThisLink', false)) {
		$discuss_link = pcc_DiscussLink($game_info);
		$link_text = $pcc_lang['discuss_this_link_this_game'];
	} elseif (is_callable('pcc_DiscussGeneralLink', false)) {
		$discuss_link = pcc_DiscussGeneralLink();
		$link_text = $pcc_lang['discuss_this_link_games'];
	} else {
		$discuss_link = '';
	}
	if (!empty($link)) {
		return $link;
	} elseif (!empty($discuss_link)) {
		return "\n<a href=\"" . $discuss_link . "\">" . $link_text . "</a>\n";
	} else {
		return '';
	}
}

// These functions ensure that the appropriate menu item is highlighted.
// If not using mambo menu items to control the flow, set all to the main chess menu item id
// and set the return value of pcc_UseMamboMenus to false.

function pcc_UseMamboMenus() {
	// If you want to display the menu items across the top of the component instead of using
	// mambo menu items.
	return (JUri::base(true) == "http://www.princeclan.org");
}

function pcc_GetItemIdMainMenuID(){
	// Change return value to item id of main chess page.
	// This menu item should be a component menu item set to the PrinceClan Chess component.
	return 81;
}

function pcc_GetItemIdActiveGameMenuID(){
	// Change return value to item id of active games chess page.
	// The url for this menu item should look like this:
	// /index.php?option=com_pcchess&amp;Itemid=" . pcc_GetItemIdActiveGameMenuID() . "&amp;page=allactivegames
	return 84;
}

function pcc_GetItemIdCompleteGameMenuID(){
	// Change return value to item id of complete games chess page.
	// The url for this menu item should look like this:
	// "/index.php?option=com_pcchess&amp;Itemid=" . pcc_GetItemIdCompleteGameMenuID() . "&amp;page=allcompletegames
	return 86;
}

function pcc_GetItemIdNewGameMenuID(){
	// Change return value to item id of new game chess page.
	// The url for this menu item should look like this:
	// "/index.php?option=com_pcchess&amp;Itemid=" . pcc_GetItemIdNewGameMenuID() . "&amp;page=newgame
	return 85;
}

function pcc_GetItemIdPlayersMenuID(){
	// Change return value to item id of players chess page.
	// The url for this menu item should look like this:
	// "/index.php?option=com_pcchess&amp;Itemid=" . pcc_GetItemIdPlayersMenuID() . "&amp;page=players
	return 87;
}
?>
