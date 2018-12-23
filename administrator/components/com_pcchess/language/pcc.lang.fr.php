<?php
// Description: Traduction francaise du component pcchess.
// File: pcc.lang.fr.php
// Author: ROPARS Eric [www.thechessplayground.org]

#echo "DBG: Default Lang US<br>";
global $pcc_lang,$pcc_lang_pgn_find,$pcc_lang_pgn_replace ;

$pcc_lang = array(
	//General Messages.
	'date_time_format'					=> "d M y H:i:s",
	'date_format'						=> "d M y",
	'forms_go'							=> "Envoie",
	'game_not_found'					=> "La partie  %s n'a pas pu etre trouve.",
	'no_game_id'						=> "partie introuvable.",
	'v'									=> " contre ",
	'black'								=> "noir",
	'white'								=> "blanc",
	'Black'								=> "Noir",
	'White'								=> "Blanc",
	'started'							=> " a commence ",
	'error'								=> "Erreur: ",
	'Yes'								=> "Oui",
	'No'								=> "Non",
	'create_game_notification'			=> "creez une partie",
	'avviso'							=> "attention",
	'login_register'					=> "Si vous vouler jouer une partie, enregistrez vous.",
	
	//Top links and main page title.
	'toplink_activegames' 				=>	"Parties en cours",
	'toplink_newgame' 					=>	"Nouvelles parties",
	'toplink_completegames' 			=>	"Parties terminees",
	'toplink_players'	 				=>	"Joueurs",
	'toplink_exercise' 					=>	"Exercices d'echecs",
	'toplink_shredder' 					=>	"Jouez contre Shredder",
	'title'								=> 	"Echecs sur le Foyer des Anciens OAA",
	'component_title' 					=>	"Echecs par correspondance",
	
	//Active games.
	'active_game_html_title'			=> "Parties en cours",
	'active_game_all'					=> "Toutes les parties en cours:",
	'active_game_no_games'				=> "Il n'y a pas de parties en cours.",
	'active_game_specific_challenges'	=> "vous avez envoye un challenge a %s:",
	'active_game_awaiting_move'			=> "Parties en attente de coups par %s:",
	'active_game_no_awaiting_move'		=> "Il n'y a pas de parties en attente de de coups par %s.",
	'active_game_opponents_move'		=> "Parties en attente de coups des adversaire de %s's:",
	'active_game_no_opponents_move'		=> "Tout les adversaires de %s ont joue leurs coups.",
	'active_game_other'					=> "Autres parties en cours",
	'active_game_no_other'				=> "Il n y a pas d'autres parties en cours.",
	
	//Complete games.
	'complete_game_html_title'			=> "Parties terminees",
	'complete_game_all'					=> "Toutes les parties terminees:",
	'complete_game_no_games'			=> "Il n y a pas de parties terminees.",
	'complete_game_player'				=> "les parties terminees de %s:",
	'complete_game_no_player'			=> "Ce joueur:  <strong>%s</strong> n'a pas encore termine de partie.",
	'complete_game_other'				=> "Autres parties terminees:",
	'complete_game_no_other'			=> "Il n y a pas d'autres parties terminees.",
	
	//Submit move.
	'submit_move_corrupt'				=> "The data for Le coups to add is corrupted. Please try again.",
	'submit_move_empty'					=> 'pas de coups entre, entrez votre coups.',
	'submit_move_resign_caps_warn'		=> 'Vous devez taper "RESIGN" en majuscule pour abandonner.',
	'submit_move_draw_caps_warn'		=> 'Vous devez taper "DRAW" en majuscule pour offrir la nulle.',
	'warn_resign'						=> 'Vous devez taper <strong>RESIGN</strong>en majuscule pour abandonner.',
	'warn_draw'							=> 'Vous devez tapez<strong>DRAW</strong> en majuscule pour offrir la nulle.',
	
	//New games.
	'new_game_html_title'				=> "Nouvelle partie",
	'new_game_specific'					=> "cliqez sur le challenge pour accepter",
	'new_game_no_specific'				=> "Personne ne vous a challenge.",
	'new_game_open'						=> "Cliquez sur un challenge publique pour accepter:",
	'new_game_open_not_logged_in'		=> "connectez vous ou creez un compte pour accepter un challenge:",
	'new_game_no_open'					=> "Il n'y a pas de challenge publique.",
	'new_game_pending'					=> "Vous avez cree ces challenge:",
	'new_game_no_pending'				=> "Il n'y a pas de challenge cfrees par vous.",
	
	//Fork game.
	'fork_game_no_player_selected'		=> "Pour creer une partie a partir de cette position, il vous faut choisir un adversaire.",
	
	//Players.
	'players_html_title'				=> "Joueur",
	'player_html_title'					=> "les parties de %s",
	'players_not_found'					=> "%s n'est pas inscrit comme joueur.",
	'players_html_title'				=> "Joueurs",
	'players_html_title'				=> "Joueurs",
	'players_html_title'				=> "Joueurs",

	//All games.
	'all_games_html_title'				=> "Toutes les parties",
	'all_games_pathway'					=> "Toutes les parties",
	'all_games_header'					=> "Toutes les parties dans la base de donnees",

	//All games.
	'unknown_request'					=> "erreur",
	
	//pcc_EchoPlayerList()
	'no_players'						=> "Il n'y a pas de joueurs en ce moment.",
	'player_list_title'					=> "Liste des joueurs et resultats",	
	'player_list_th_player'				=> "Joueur",
	'player_list_th_active'				=> "Parties<br />en cours",
	'player_list_th_complete'			=> "Parties<br />Terminees",
	'player_list_th_wins'				=> "Victoires",
	'player_list_th_draws'				=> "Nulle",
	'player_list_th_points'				=> "Points",
	'player_list_th_active_white'		=> "Parties<br />en cours<br />blancs",
	'player_list_th_complete_white'		=> "Parties<br />terminees<br />Blanc",
	'player_list_th_wins_white'			=> "Victoire<br />Blanc",
	'player_list_th_draws_white'		=> "Nulle<br />Blanc",
	'player_list_th_active_black'		=> "Parties<br />en cours<br />Noir",
	'player_list_th_complete_black'		=> "Parties<br />terminees<br />Noir",
	'player_list_th_wins_black'			=> "Victoires<br />Noir",
	'player_list_th_draws_black'		=> "Nulles<br />Noir",
	
	//pcc_EchoNewGameForm()
	'new_game_form_heading'				=> "Entrez info sur le challenge:",
	'new_game_form_color'				=> "Couleur:",
	'new_game_form_white'				=> "Blanc",
	'new_game_form_black'				=> "Noir",
	'new_game_form_opponent'			=> "Adversaire:",
	'new_game_form_any_player'			=> "** Any Player **",
	'new_game_form_notification'		=> "Alertes:",
	'new_game_form_notification_yes'	=> "envoyez moi un email quand mon adversaire joue son coup.",
	'new_game_form_notification_no'		=> "ne me prevenez pas par email losque c'est mon tour, je verifierai tous les jours.",
	'new_game_form_comment_head'		=> "Commentaires:",
	
	//pcc_EchoForkGameForm()
	'fork_game_first_option'			=> "--Creez une partie a partir de cette position--",
	'fork_game_same_players'			=> "utilisez les memes adversaires",
	'fork_game_switch_sides'			=> "meme adversaire, differentes couleurs",
	'fork_game_open_white'				=> "Creer un challenge, je joue avec les blancs",
	'fork_game_open_black'				=> "Creer un challenge, je joue avec les noirs",

	//pcc_ProcessForkGame()
	'process_fork_no_login'				=> "Vous devez etre connecte pour creer un challenge",
	'process_fork_no_color'				=> "Vous n'avez pas selectionne de couleur.",
	'process_fork_bad_fork'				=> "The fork value %s is incorrect.",
	'process_fork_comment'				=> "This game was forked at move %1\$s/%2\$s from the game between " . 
										   "%3\$s v. %4\$s that was started on %5\$s.",
	'process_fork_last_move'			=> "Last move transferred from parent game.",
	
	//pcc_EchoAcceptGameForm()
	'accept_game_header'				=> "Accepter l'offre de jouer %1\$s v. %2\$s",
	'accept_game_notify'				=> "envoyez moi une email lorsque c'est mon tour.",
	'accept_game_no_notify'				=> "ne me prevenez pas par email losque c'est mon tour, je verifierai tous les jours.",
	'accept_game_accept'				=> "Accepter le challenge",
	'accept_game_decline'				=> "refuser le challenge",
	'accept_game_no_login'				=> "Vous devez etre connecte pour accepter le challenge.",

	//pcc_EchoRevokeChallengeForm()
	'revoke_game_header'				=> "Your Challenge for the Game %s v. %s",
	'revoke_game_warn'    				=> "ATTENTION: une fois que vous cliquez sur &quot;Annuler Challenge&quot; ce challenge sera annule aussitot.",
	'revoke_game_revoke'				=> "Annuler le challenge",
	'revoke_game_no_login'				=> "Vous devez etre connecte de maniere a annuler un challenge.",
	
	//pcc_ProcessDeclineGame()
	'decline_already_begun'				=> "Cette partie a deja commence et nbe peux plus etre annulee",
	'decline_not_specific'				=> "Ce challenge ne vous est pas destine, vous ne pouvez pas l'effacer.",
	'decline_subject'					=> "PCChess: Votre challenge vers %s a ete decline.",
	'decline_body'						=> "%1\$s a refuse de jouer %2\$s.",
	'decline_message_notify'			=> "%1\$s a ete notifie par email de votre refus %2\$s.",
	'decline_message_no_notify'			=> "%1\$s a ete notifie de votre refus %2\$s.",
	'decline_no_login'					=> "Vous devez etre connecte pour refuser une partie.",
	
	//pcc_RevokeChallenge()
	'revoke_already_begun'				=> "This game has already begun and may not be revoked.",
	'revoke_not_specific'				=> "This challenge was not specific to you so you may not revoke it.",
	'revoke_success'					=> "The challenge issued for %s has been revoked.",
	'revoke_no_login'					=> "You must be logged in to revoke a challenge.",

	//pcc_ProcessAcceptGame()
	'accept_no_login'					=> "You must be logged in to accept a challenge.",
	'accept_already'					=> "This game was already accepted by someone else: ",
	'accept_subject'					=> "Prince Clan Chess: Your challenge has been accepted.",
	'accept_body'						=> "%1\$s agreed to play %2\$s at %3\$s.",
	'accept_you_will_be_notified'		=> "You will be notified by email when your opponent moves.",
	'accept_you_will_not_be_notified'	=> "You will not be notified by email when<br />your opponent moves. Please check back daily.",
	'accept_unknown'					=> "Unknown situation in pcc_ProcessAcceptGame().",
	'accept_opponent_notified'			=> "%1\$s has been notified by email of your agreement to play %2\$s.",
	'accept_opponent_not_notified'		=> "%1\$s has not been notified by email of your agreement to play %2\$s.",
	
	//pcc_ProcessNewGame()
	'issue_challenge_no_login'			=> "You must be logged in correctly to issue a challenge.",
	'issue_challenge_no_color'			=> "A correct color was not selected.",
	'issue_you_will_be_notified'		=> "You will be notified via email when this challenge is accepted.",
	'issue_you_will_not_be_notified'	=> "You will not be notified via email when this challenge is accepted. Please check back daily.",
	'issue_message'						=> "Your request for an opponent to play %s has been saved.",
	'issue_no_login'					=> "You must be logged in to create a new game.",

	//pcc_ShowAddMoveForm()
	'add_form_move'						=> "Move:",
	'add_form_help'						=> "Help",
	'add_form_instructions'				=> "Type RESIGN in Move to resign, DRAW to offer draw.",
	'add_form_comment'					=> "Comment:",
	'add_form_notify'					=> "Notify me when my opponent moves.",
	'add_comment'						=> "Write your comment...",
	'info'								=> "Info",

	//Game List
	'game_list_players'					=> "Players",
	'game_list_status'					=> "Status",
	'game_list_started'					=> "Started",
	'game_list_num_moves'				=> "#&nbsp;Moves",
	'game_list_last_move'				=> "Last&nbsp;Move",
	'game_list_comments'				=> "Comments",
	
	//pcc_DrawGame()
	'draw_no_login'						=> "You must be logged in to offer a draw.",
	'draw_wrong_player'					=> "This game is between %1\$s and %2\$s. Only these players may offer draws in this game.",
	'draw_message_notify'				=> ' An email was sent to notify your opponent of your draw offer.',
	'draw_message_no_notify'			=> ' Your opponent has not been notified of your draw offer.',

	//pcc_ResignGame()
	'resign_no_login'					=> "You must be logged in to resign.",
	'resign_wrong_player'				=> "This game is between %1\$s and %2\$s. Only these players may resign in this game.",
	'resign_message_notify'				=> ' An email was sent to notify your opponent of your resignation.',
	'resign_message_no_notify'			=> ' Your opponent has not been notified of your resignation.',

	//pcc_ProcessAcceptDraw()
	'accept_draw_no_login'				=> "You must be logged in to accept or reject a draw.",
	'accept_draw_wrong_player'			=> "This game is between %1\$s and %2\$s. Only these players may accept or reject draws in this game.",
	'accept_draw_accept_notify'			=> ' An email was sent to notify your opponent that you accept the draw.',
	'accept_draw_accept_no_notify'		=> ' Your opponent has not been notified that you accept the draw.',
	'accept_draw_reject_notify'			=> ' An email was sent to notify your opponent that you reject the draw.',
	'accept_draw_reject_no_notify'		=> ' Your opponent has not been notified that you reject the draw.',

	//pcc_AwaitingChallengerName()
	'awaiting_player'					=> "&lt;Awaiting Player&gt;",

	//pcc_GetGameStatus()
	'game_status_awaiting_white'		=> "Awaiting white",
	'game_status_awaiting_black'		=> "Awaiting black",
	'game_status_admin_suspend'			=> "Admin suspend",
	'game_status_white_draw_offer'		=> "White offered draw",
	'game_status_black_draw_offer'		=> "Black offered draw",
	'game_status_white_to_move'			=> "Au Blancs de jouer",
	'game_status_black_to_move'			=> "Au Noirs de jouer",
	'game_status_white_mated_black'		=> "Les Blancs ont mate les Noirs",
	'game_status_black_mated_white'		=> "Les Noirs ont mate les Blancs",
	'game_status_stalemate'				=> "Pat",
	'game_status_draw_agreed_to'		=> "1/2-1/2",
	'game_status_white_resigned'		=> "0-1",
	'game_status_black_resigned'		=> "1-0",
	'game_status_unknown_result'		=> "resultat inconnu",
	
	//pcc_EchoGame()
	'echo_game_start_position'			=> 'La partie commencera a partir de cette position:',
	'echo_game_player_offered_draw'		=> "Vous venez d'offrir la nulle, attendez la reponse.",
	'echo_game_white_offered_draw'		=> "Les Blancs ont offert la nulle, le Noirs n'ont pas encore repondu.",
	'echo_game_black_offered_draw'		=> "Vous venez d'offrir la nulle, attendez la reponse.",
	'echo_game_export'					=> "exporter la partie",
	'echo_game_refresh'					=> "rafraichir",
	'echo_game_not_started'				=> "Partie non debutee, ",
	'echo_game_over'					=> "Partie Terminee, ",
	'echo_game_last_position_to_move'	=> "Allez sur la derniere position pour entrer votre coups.",
	'echo_game_opponents_move'			=> "Au tour de votre adversaire",
	
	//pcc_ShowAcceptDrawForm()
	'accept_draw_prompt'				=> "Accepter l'offre de nul?",

	//pcc_ProcessMove()
	'process_move_no_move'				=> "Vous devez jouer votre coups.",
	'process_move_no_login'				=> "Il vous faut etre connecte pour jouer votre coups",
	'process_move_wrong_player'			=> "Cette partie est entre %1\$s et %2\$s. Seulement ces joueurs peuvent bouger les pieces",
	'process_move_accept_no_notify'		=> ' Votre opponent n'a pas ete prevenue de votre coups',
	'process_move_reject_notify'		=> ' un email a ete envoye a votre adversaire',
	'process_move_checkmate'			=> 'Le coups %s a engendre un mat. Vous avez gagne!',
	'process_move_stalemate'			=> 'Le coups %s a engendre un pat. Match Nul.',
	'process_move_added'				=> 'Le coups %s a ete ajkoute a la partie.',
	'process_move_invalid'				=> 'Le coups %s n'est pas un coups valide.',
	'process_move_error'				=> 'erreur de base de donnees lors de la lecture de votre partie.',
	
	//pcc_SendMoveEmail()
	'send_mail_subject'					=> "Prince Clan Chess Automated Move Notification",
	'send_mail_comment'					=> " %s a commente: ",
	'send_mail_resign'					=> "%1\$s a abandonne la partie %2\$s%3\$s%4\$s at %5\$s.",
	'send_mail_draw_offer'				=> "%1\$s a offer un match nul %2\$s%3\$s%4\$s at %5\$s.",
	'send_mail_draw_accept'				=> "%1\$s a accepte votre offe de nulle %2\$s%3\$s%4\$s at %5\$s.",
	'send_mail_draw_reject'				=> "%1\$s a refuse votre offre de nulle %2\$s%3\$s%4\$s at %5\$s.",
	'send_mail_move'					=> "%1\$s a joue le coups %2\$s in the game %3\$s%4\$s%5\$s at %6\$s.",
	
	//pcc_GetDiscussThisLink()
	'discuss_this_link_view_comments'	=> 'Lire les commentaires a propos de cette partie dans le forum des echecs.',
	'discuss_this_link_this_game'		=> 'Discuter de cette partie sur le forum.',
	'discuss_this_link_games'			=> 'Discuter sur les echecs ',
	
	//Module
	'pcc_status_your_turn_header'		=> 'Partie- Votre Tours',
	'pcc_status_your_turn_none'			=> 'Il n'y a pas de partie ou c'est votre tours de jouer',
	'pcc_status_opp_turn_header'		=> "Parties - Tours de votre adversaire",
	'pcc_status_opp_turn_none'			=> "Il ny a pas de partie ou c'est le tour de votre adversaire.",
	'pcc_status_spec_challenges'		=> "Challenges Recus",
	'pcc_status_spec_challenges_none'	=> "Vous n'avez recu aucun challenge.",
	'pcc_status_open_challenges'		=> "Challenges Publiques Ouverts",
	'pcc_status_open_challenges_none'	=> "Il n' y a pas de challenges publiques ouverts.",

	'add_form_help_text'				=> "'Entrée les coups en utilisant la notation algébrique début-fin des cases. Par example, e2-e4.\\n\\n' +
	 'En cliquant sur la case de départ et de fin transmettra la notation correcte dans la boîte de déplacement.\\n\\n' +
	 'Pour le Roque Cliquez sur la case de départ du Rois ensuite la Case cible. Par example, e1-g1 or e1-c1. All castling rules are enforced.\\n\\n' +
	 'Pour capturer un pion en passant,  entré la case de départ du pion et la case d`arriver. Par example, e4-f3.\\n\\n' +
	 'Les pions sont automatiquement promus en reines, sauf indication. Par example, e7-e8 N Le pion sera promu en Cavalier. Utilisez Q, B, R, N. ' +
	 'L'espace entre la case cible et la pièce désigner est obligatoire.\\n\\n' +
	 'Tapez DRAW pour offrir ou accepter le nul.  Il n'est pas possible de retirer une offre de nul une fois fait.\\n\\n'+
	 'Tapez RESIGN pour abandonner. Il n`existe aucun moyen de retirer l`abandon.'",


	'end'								=> "end"
);

$pcc_lang_pgn_find = array(
    "K",
    "Q",
    "R",
    "B",
    "N");

$pcc_lang_pgn_replace = array(
    "R",
    "D",
    "T",
    "F",
    "C");
?>