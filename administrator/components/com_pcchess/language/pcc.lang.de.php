<?php
// Language file for princeclan chess component.
// This is a localized file and should be included AFTER pcc.lang.us.php.
// It assumes $pcc_lang has been defined and filled in already.
// This allows language files to default to the master U.S. English when changes are made.
// Any item not changed can be deleted, but this should only be done if performance becomes an issue.

global $pcc_lang,$pcc_lang_pgn_find,$pcc_lang_pgn_replace ;

$pcc_lang = array(

     //General Messages.
    'date_time_format' => "d M y H:i:s",
    'date_format' => "d M Y",
    'forms_go' => "OK",
    'game_not_found' => "Partie Nummer %s nicht gefunden.",
    'no_game_id' => "No game_id present.",
    'v' => " - ",
    'black' => "schwarz",
    'white' => "wei&szlig;",
    'Black' => "Schwarz",
    'White' => "Wei&szlig;",
    'started' => " gestarted ",
    'error' => "Fehler: ",
    'Yes' => "Ja",
    'No' => "Nein",
     
     //Top links and main page title.
    'toplink_activegames' => "Aktive Partien",
    'toplink_newgame' => "Neue Partie",
    'toplink_completegames' => "Beendete Spiele",
    'toplink_players' => "Spieler",
    'toplink_exercise' => "Aufgabe des Tages",
    'toplink_shredder' => "Spiel vs Shredder",
    'component_title' => "dauerschach.community",
     
     //Active games.
    'active_game_html_title' => "Aktive Schach Partien",
    'active_game_all' => "Alle aktiven Partien:",
    'active_game_no_games' => "Es gibt keine aktiven Partien.",
    'active_game_specific_challenges' => "Du wurdest herausgefordert:",
    'active_game_awaiting_move' => "Folgende Partien warten auf einen Zug von dir, %s:",
    'active_game_no_awaiting_move' => "Keine Partien warten auf einen Zug von dir, %s.",
    'active_game_opponents_move' => "Folgende Partien warten auf einen Zug deines Gegners:",
    'active_game_no_opponents_move' => "Keine Partien warten auf einen Zug deines Gegners.",
    'active_game_other' => "Andere aktive Partien:",
    'active_game_no_other' => "Es gibt keine weiteren Partien.",
     
     //Complete games.
    'complete_game_html_title' => "Beendete Partien",
    'complete_game_all' => "Alle beendeten Partien:",
    'complete_game_no_games' => "Es gibt keine beendeten Schach Partien.",
    'complete_game_player' => "%s's beendete Spiele:",
    'complete_game_no_player' => "%s hat keine Spiele beendet.",
    'complete_game_other' => "Weitere beendete Partien:",
    'complete_game_no_other' => "Es gibt keine weiteren beendeten Partien.",
     
     //Submit move.
    'submit_move_corrupt' => "Momentan k&ouml;nnen Sie keinen Zug ausf�hren. Versuchen Sie es sp&auml;ter.",
    'submit_move_empty' => 'Der Zug ist ung&uuml;ltig. Bitte machen Sie einen anderen.',
    'submit_move_resign_caps_warn' => 'Schreibe "RESIGN" in Gro&szlig;buchstaben, um aufzugeben.',
    'submit_move_draw_caps_warn' => 'Schreibe "DRAW" in Gro&szlig;buchstaben, um Remis anzubieten.',
     
     //New games.
    'new_game_html_title' => "Neues Spiel",
    'new_game_specific' => "Klicken Sie auf eine bestimmte Herausforderung, um diese zu akzeptieren:",
    'new_game_no_specific' => "Es gibt keine Herausforderungen f&uuml;r Sie.",
    'new_game_open' => "Klick auf eine offene Herausforderung um zu akzeptieren:",
    'new_game_open_not_logged_in' => "Melde dich an oder registrier dich, um Herausforderungen anzunehmen:",
    'new_game_no_open' => "Es gibt keine offenen Herausforderungen.",
    'new_game_pending' => "Die folgenden Herausforderungen wurden von Ihnen aufgestellt:",
    'new_game_no_pending' => "Es wurden keine offenen Herausforderungen von Ihnen aufgestellt.",
     
     //Fork game.
    'fork_game_no_player_selected' => "You must select a player option to<br />create a new game at this position.",
     
     //Players.
    'players_html_title' => "Schachspieler",
    'player_html_title' => "%s's Schachpartien",
    'players_not_found' => "%s wurde nicht gefunden.",
    'players_html_title' => "Schachspieler",
    'players_html_title' => "Schachspieler",
    'players_html_title' => "Schachspieler",
    
     //All games.
    'all_games_html_title' => "Alle Schachpartien",
    'all_games_pathway' => "Alle Spiele",
    'all_games_header' => "Alle Spiele im System",
    
     //All games.
    'unknown_request' => "Unknown Request. Seite neu laden.",
     
     //pcc_EchoPlayerList()
    'no_players' => "Es gibt noch keine Spieler.",
    'player_list_title' => "Spielerliste und Ergebniszusammenfassung",
    'player_list_th_player' => "Spieler",
    'player_list_th_profil' => "Profil",
    'player_list_th_active' => "aktiv",
    'player_list_th_complete' => "beendet",
    'player_list_th_wins' => "Siege",
    'player_list_th_draws' => "Remis",
    'player_list_th_points' => "Punkte",
    'player_list_th_active_white' => "Aktive Spiele<br />Wei&szlig;",
    'player_list_th_complete_white' => "Beendete Spiele<br />Wei&szlig;",
    'player_list_th_wins_white' => "Sieg Wei&szlig;",
    'player_list_th_draws_white' => "Remis Wei&szlig;",
    'player_list_th_active_black' => "Aktive Spiele<br />Schwarz",
    'player_list_th_complete_black' => "Beendete Spiele<br />Schwarz",
    'player_list_th_wins_black' => "Sieg mit Schwarz",
    'player_list_th_draws_black' => "Remis Schwarz",
     
     //pcc_EchoNewGameForm()
    'new_game_form_heading' => "Gebe hier Informationen f&uuml;r eine Herausforderung ein:",
    'new_game_form_color' => "Farbe:",
    'new_game_form_white' => "Wei&szlig;",
    'new_game_form_black' => "Schwarz",
    'new_game_form_opponent' => "Gegner:",
    'new_game_form_any_player' => "** Jeder Spieler **",
    'new_game_form_notification' => "Mitteilung:",
    'new_game_form_notification_yes' => "Email schicken, wenn mein Gegner zieht (SPAM-Gefahr).",
    'new_game_form_notification_no' => "Keine Email schicken, wenn mein Gegner zieht (empfohlen).",
    'new_game_form_comment_head' => "Kommentar:",
     
     //pcc_EchoForkGameForm()
    'fork_game_first_option' => "--Starte ein neues Spiel aus dieser Stellung--",
    'fork_game_same_players' => "Benutze die gleichen Spieler",
    'fork_game_switch_sides' => "Gleiche Spieler mit vertauschten Farben",
    'fork_game_open_white' => "Neue Herausforderung, ich hab Wei&szlig;",
    'fork_game_open_black' => "Neue Herausforderung, ich hab Schwarz",
    
     //pcc_ProcessForkGame()
    'process_fork_no_login' => "You must be logged in correctly to create a new game.",
    'process_fork_no_color' => "A correct color was not selected.",
    'process_fork_bad_fork' => "The fork value %s is incorrect.",
    'process_fork_comment' => "This game was forked at move %1\$s/%2\$s from the game between %3\$s - %4\$s that was started on %5\$s.",
    'process_fork_last_move' => "Last move transferred from parent game.",
     
     //pcc_EchoAcceptGameForm()
    'accept_game_header' => "Angebot annehmen mit %1\$s gegen %2\$s",
    'accept_game_notify' => "Schick mir eine Email, wenn mein Gegner zieht.",
    'accept_game_no_notify' => "Keine Email schicken, wenn mein Gegner zieht - Ich gucke t&auml;glich nach.",
    'accept_game_accept' => "Herausforderung annehmen",
    'accept_game_decline' => "Herausforderung ablehnen",
    'accept_game_no_login' => "You must be logged in to accept a challenge for a new game.",
    
     //pcc_EchoRevokeChallengeForm()
    'revoke_game_header' => "Deine Herausforderung f&uuml;r das Spiel %s - %s",
    'revoke_game_warn' => "ACHTUNG: Ein Klick auf &quot;Herausforderung zur&uuml;ckziehen&quot; und dieses Spiel wird gel&ouml;scht.",
    'revoke_game_revoke' => "Herausforderung zur&uuml;ckziehen",
    'revoke_game_no_login' => "You must be logged in to revoke a challenge for a new game.",
     
     //pcc_ProcessDeclineGame()
    'decline_already_begun' => "This game has already begun an may not be declined.",
    'decline_not_specific' => "This challenge was not specific to you so you may not decline it.",
    'decline_subject' => "Prince Clan Chess: Your challenge to %s has been declined.",
    'decline_body' => "%1\$s declined to accept your challenge to play %2\$s.",
    'decline_message_notify' => "%1\$s has been notified by email of your declining to play %2\$s.",
    'decline_message_no_notify' => "%1\$s has not been notified by email of your declining to play %2\$s.",
    'decline_no_login' => "You must be logged in to decline a game.",
     
     //pcc_RevokeChallenge()
    'revoke_already_begun' => "This game has already begun an may not be revoked.",
    'revoke_not_specific' => "This challenge was not specific to you so you may not revoke it.",
    'revoke_success' => "Die Herausforderung %s wurde soeben gel&ouml;scht.",
    'revoke_no_login' => "You must be logged in to revoke a challenge.",
    
     //pcc_ProcessAcceptGame()
    'accept_no_login' => "You must be logged in to accept a challenge.",
    'accept_already' => "This game was already accepted by someone else: ",
    'accept_subject' => "Prince Clan Chess: Your challenge has been accepted.",
    'accept_body' => "%1\$s agreed to play %2\$s at %3\$s.",
    'accept_you_will_be_notified' => "You will be notified by email when your opponent moves.",
    'accept_you_will_not_be_notified' => "You will not be notified by email when<br />your opponent moves. Please check back daily.",
    'accept_unknown' => "Unknown situation in pcc_ProcessAcceptGame().",
    'accept_opponent_notified' => "%1\$s wurde per Email benachrichtigt, dass du gegen ihn mit %2\$s spielst.",
    'accept_opponent_not_notified' => "%1\$s wurde nicht per Email benachrichtigt, dass du gegen ihn mit %2\$s spielst.",
     
     //pcc_ProcessNewGame()
    'issue_challenge_no_login' => "You must be logged in correctly to issue a challenge.",
    'issue_challenge_no_color' => "A correct color was not selected.",
    'issue_you_will_be_notified' => "You will be notified via email when this challenge is accepted.",
    'issue_you_will_not_be_notified' => "You will not be notified via email when this challenge is accepted. Please check back daily.",
    'issue_message' => "Your request for an opponent to play %s has been saved.",
    'issue_no_login' => "You must be logged in to create a new game.",
    
     //pcc_ShowAddMoveForm()
    'add_form_move' => "Zug:",
    'add_form_help' => "Hilfe",
    'add_form_instructions' => "Schreibe RESIGN als Zug um aufzugeben, DRAW um Remis anzubieten.",
    'add_form_comment' => "Kommentar:",
    'add_form_notify' => "Mich benachrichtigen, wenn mein Gegner zieht.",
    
     //Game List
    'game_list_players' => "Spieler",
    'game_list_status' => "Status",
    'game_list_started' => "Gestarted",
    'game_list_num_moves' => "#&nbsp;Z&uuml;ge",
    'game_list_last_move' => "Letzter&nbsp;Zug",
    'game_list_comments' => "Kommentar",
     
     //pcc_DrawGame()
    'draw_no_login' => "You must be logged in to offer a draw.",
    'draw_wrong_player' => "This game is between %1\$s and %2\$s. Only these players may offer draws in this game.",
    'draw_message_notify' => ' Dein Gegner wurde &uuml;ber dein Remisangebot benachrichtigt.',
    'draw_message_no_notify' => ' Dein Gegner wurde nicht &uuml;ber dein Remisangebot benachrichtigt.',
    
     //pcc_ResignGame()
    'resign_no_login' => "You must be logged in to resign.",
    'resign_wrong_player' => "This game is between %1\$s and %2\$s. Only these players may resign in this game.",
    'resign_message_notify' => ' Dein Gegner wurde &uuml;ber deine Aufgabe benachrichtigt.',
    'resign_message_no_notify' => ' Dein Gegner wurde nicht &uuml;ber deine Aufgabe benachrichtigt.',
    
     //pcc_ProcessAcceptDraw()
    'accept_draw_no_login' => "You must be logged in to accept or reject a draw.",
    'accept_draw_wrong_player' => "This game is between %1\$s and %2\$s. Only these players may accept or reject draws in this game.",
    'accept_draw_accept_notify' => ' Dein Gegner wurde &uuml;ber das Remis benachrichtigt.',
    'accept_draw_accept_no_notify' => ' Dein Gegner wurde nicht &auml;ber das Remis benachrichtigt.',
    'accept_draw_reject_notify' => ' Dein Gegner wurde dar&uuml;ber benachrichtigt,<br /> dass du das Remis abgelehnt hast.',
    'accept_draw_reject_no_notify' => ' Dein Gegner wurde nicht dar&auml;ber benachrichtigt,<br /> dass du das Remis abgelehnt hast.',
    
     //pcc_AwaitingChallengerName()
    'awaiting_player' => "&lt;Gegner gesucht&gt;",
    
     //pcc_GetGameStatus()
    'game_status_awaiting_white' => "Wartet auf Wei&szlig;",
    'game_status_awaiting_black' => "Wartet auf Schwarz",
    'game_status_admin_suspend' => "Admin suspend",
    'game_status_white_draw_offer' => "<b>+ Wei&szlig; bietet Remis +</b>",
    'game_status_black_draw_offer' => "<b>+ Schwarz bietet Remis +</b>",
    'game_status_white_to_move' => "Wei&szlig; am Zug",
    'game_status_black_to_move' => "Schwarz am Zug",
    'game_status_white_mated_black' => "1 - 0",
    'game_status_black_mated_white' => "0 - 1",
    'game_status_stalemate' => "Stalemate",
    'game_status_draw_agreed_to' => "0,5 - 0,5",
    'game_status_white_resigned' => "0 - 1",
    'game_status_black_resigned' => "1 - 0",
    'game_status_unknown_result' => "Unbekanntes Ergebnis",
     
     //pcc_EchoGame()
    'echo_game_start_position' => 'The game will start in the following position:',
    'echo_game_player_offered_draw' => "You offered your opponent a draw.<br />You must wait for a response.",
    'echo_game_white_offered_draw' => "White has offered a draw.<br />Black has not responded.",
    'echo_game_black_offered_draw' => "You offered your opponent a draw.<br />You must wait for a response.",
    'echo_game_export' => "export game",
    'echo_game_refresh' => "Refresh",
    'echo_game_not_started' => "Game not started, ",
    'echo_game_over' => "Game over, ",
    'echo_game_last_position_to_move' => "Go to the last position to enter your move.",
    'echo_game_opponents_move' => "Dein Gegner ist am Zug.",
     
     //pcc_ShowAcceptDrawForm()
    'accept_draw_prompt' => 'Remis annehmen?',
    
     //pcc_ProcessMove()
    'process_move_no_move' => "Du musst einen Zug eingeben.",
    'process_move_no_login' => "You must be logged in to enter a move.",
    'process_move_wrong_player' => "This game is between %1\$s and %2\$s. Only these players may enter a move in this game.",
    'process_move_accept_no_notify' => ' Your opponent has not been<br />notified of your move.',
    'process_move_reject_notify' => ' An email was sent to notify<br />your opponent of your move.',
    'process_move_checkmate' => 'The move %s resulted in checkmate. You win!',
    'process_move_stalemate' => 'The move %s resulted in stalemate. The game is a draw.',
    'process_move_added' => 'The move %s was added to the game.',
    'process_move_invalid' => 'Der Zug %s ist nicht g&uuml;ltig in dieser Stellung.',
    'process_move_error' => 'There was an error reading your game from the database.',
     
     //pcc_SendMoveEmail()
    'send_mail_subject' => "www.dauerschach.com Automatische Zugbenachrichtigung",
    'send_mail_comment' => " %s schrieb den folgenden Kommentar: ",
    'send_mail_resign' => "%1\$s gab auf im Spiel %2\$s%3\$s%4\$s bei %5\$s.",
    'send_mail_draw_offer' => "%1\$s bietet Remis im Spiel %2\$s%3\$s%4\$s at %5\$s.",
    'send_mail_draw_accept' => "%1\$s nahm das Remis im Spiel %2\$s%3\$s%4\$s at %5\$s an.",
    'send_mail_draw_reject' => "%1\$s lehnte das Remis im Spiel %2\$s%3\$s%4\$s at %5\$s ab.",
    'send_mail_move' => "%1\$s machte den Zug %2\$s im Spiel %3\$s%4\$s%5\$s at %6\$s.",
     
     //pcc_GetDiscussThisLink()
    'discuss_this_link_view_comments' => 'View comments about this game in the Chess forum.',
    'discuss_this_link_this_game' => 'Discuss this game in the Chess forum.',
    'discuss_this_link_games' => 'Discuss games in the Chess forum.',
     
     //Module
    'pcc_status_your_turn_header' => 'Chess Games - Your Turn',
    'pcc_status_your_turn_none' => 'There are no chess games in which it is your turn.',
    'pcc_status_opp_turn_header' => "Chess Games - Opponent's Turn",
    'pcc_status_opp_turn_none' => "There are no chess games in which it is your opponent's turn.",
    'pcc_status_spec_challenges' => "Chess Challenges Specific to You",
    'pcc_status_spec_challenges_none' => "There are no chess challenges specific to you.",
    'pcc_status_open_challenges' => "Open Chess Challenges",
    'pcc_status_open_challenges_none' => "There are no open chess challenges.",

    'add_form_help_text' => "'Enter moves using the notation start-end using algebraic notation for square positions. For example, e2-e4.\\n\\n' +
		 'Clicking on the start and end square will put the correct notation in the move box.\\n\\n' +
		 'To castle, enter the start square and the target square for the King. For example, e1-g1 or e1-c1. All castling rules are enforced.\\n\\n' +
		 'To capture a pawn en passant, enter the square of the pawn being moved and the square the pawn will end up in. For example, e4-f3.\\n\\n' +
		 'Pawns are automatically promoted to queens unless specified. For example, e7-e8 N will promote the pawn to a Knight. Use Q, B, R, N. ' +
		 'The space between the target square and piece designation is mandatory.\\n\\n' +
		 'Type DRAW to offer or accept a draw. There is no way to withdraw a draw offer once made.\\n\\n'+
		 'Type RESIGN to resign. There is no way to withdraw a resignation.'",
    'end' => "Ende"
 );

$pcc_lang_pgn_find = array(
    "K",
    "Q",
    "R",
    "B",
    "N");

	//This array contains the letter to use in algebraic notation for each piece.
	//Do not change the number of elements in this array or the order.
	$pcc_lang_pgn_replace = array(
		"K",  //King
		"D",  //Queen
		"T",  //Rook
		"L",  //Bishop
		"S"); //Knight
 ?>