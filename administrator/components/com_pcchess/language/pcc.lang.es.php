<?php
// Desc.: Archivo en lengua española para el componente PCChess.
// File: pcc.lang.es.php
// Author: Jordi de la Fuente [www.gameflip.es]

#echo "DBG: Default Lang ES<br>";
global $pcc_lang,$pcc_lang_pgn_find,$pcc_lang_pgn_replace ;

$pcc_lang = array(
	//General Messages.
	'date_time_format'					=> "d M y H:i:s",
	'date_format'						=> "d M y",
	'forms_go'							=> "Go",
	'game_not_found'					=> "El juego con n&uacutemero %s no se ha encontrado.",
	'no_game_id'						=> "No id presente.",
	'v'									=> " vs. ",
	'black'								=> "negras",
	'white'								=> "blancas",
	'Black'								=> "Negras",
	'White'								=> "Blancas",
	'started'							=> " comenzado ",
	'error'								=> "Error: ",
	'Yes'								=> "Si",
	'No'								=> "No",
	'create_game_notification'			=> "Crear partida",
	'avviso'							=> "Aviso",
	'login_register'					=> "Si quieres realizar un desaf&iacuteo, tienes que estar registrado.",
	
	//Top links and main page title.
	'toplink_activegames' 				=>	"Activos",
	'toplink_newgame' 				=>	"Nuevo",
	'toplink_completegames' 			=>	"Terminados",
	'toplink_players' 				=>	"Jugadores",
	'toplink_exercise' 				=>	"Chessexercise",
	'toplink_shredder' 				=>	"Play vs Shredder",
	'title'								=> 	"PCChess",
	'component_title' 					=>	"PCChess tu Ajedrez por Correspondencia",
	
	//Active games.
	'active_game_html_title'			=> "Partidas activas",
	'active_game_all'					=> "Todas las partidas activas:",
	'active_game_no_games'				=> "No hay partidas activas.",
	'active_game_specific_challenges'	=> "Desaf&iacuteos hechos expresamente a: %s:",
	'active_game_awaiting_move'			=> "Partidas esperando movimiento de %s:",
	'active_game_no_awaiting_move'		=> "no hay partidas esperando movimiento de %s.",
	'active_game_opponents_move'		=> "Partidas esperando movimiento del oponente de %s:",
	'active_game_no_opponents_move'		=> "No hay partidas esperando movimiento del oponiente de %s.",
	'active_game_other'					=> "Otras Partidas Activas:",
	'active_game_no_other'				=> "No hay m&aacutes partidas activas.",
	
	//Complete games.
	'complete_game_html_title'			=> "Partidas de Ajedrez Completadas",
	'complete_game_all'					=> "Total Partidas Completadas:",
	'complete_game_no_games'			=> "No hay partidas completadas.",
	'complete_game_player'				=> "Partidas Completadas de %s:",
	'complete_game_no_player'			=> "El jugador <strong>%s</strong> no ha completado ninguna partida.",
	'complete_game_other'				=> "Otras Partidas Completadas:",
	'complete_game_no_other'			=> "No hay otras partidas completadas.",
	
	//Submit move.
	'submit_move_corrupt'				=> "Los datos del movimiento est&aacuten corruptos. Por favor, vuelve a intentarlo.",
	'submit_move_empty'					=> 'El movimiento esta vac&iacuteo. Mueve alguna ficha.',
	'submit_move_resign_caps_warn'		=> 'Escribe "RESIGN" en may&uacutesculas para rendirte.',
	'submit_move_draw_caps_warn'		=> 'Escribe "DRAW" en may&uacutesculas para ofrecer tablas.',
	'warn_resign'						=> 'Escribe <strong>RESIGN</strong> en may&uacutesculas para rendirte.',
	'warn_draw'							=> 'Escribe <strong>DRAW</strong> en may&uacutesculas para ofrecer tablas.',
	
	//New games.
	'new_game_html_title'				=> "Nuevas Partidas Ajedrez",
	'new_game_specific'					=> "Clica en alg&uacuten desaf&iacuteo hacia ti para aceptarlo:",
	'new_game_no_specific'				=> "No hay desaf&iacuteos hechos a ti.",
	'new_game_open'						=> "Clica en alg&uacuten desaf&iacuteo abierto hacia ti para aceptarlo:",
	'new_game_open_not_logged_in'		=> "Loguea o reg&iacutestrate para aceptar alg&uacuten desaf&iacuteo abierto:",
	'new_game_no_open'					=> "No hay desaf&iacuteos abiertos.",
	'new_game_pending'					=> "Los siguientes desaf&iacuteos fueron hechos por ti:",
	'new_game_no_pending'				=> "No hay desaf&iacuteos pendientes hechos por ti.",
	
	//Fork game.
	'fork_game_no_player_selected'		=> "Debes escoger un color para<br />crear un juego nuevo en esta posici&oacuten.",
	
	//Players.
	'players_html_title'				=> "Jugadores",
	'player_html_title'					=> "Partidas de %s",
	'players_not_found'					=> "%s no es una id de usuario reconocida.",
	'players_html_title'				=> "Jugadores",
	'players_html_title'				=> "Jugadores",
	'players_html_title'				=> "Jugadores",

	//All games.
	'all_games_html_title'				=> "Todas las partidas",
	'all_games_pathway'					=> "Todas las partidas",
	'all_games_header'					=> "Todas las partidas en el Sistema",

	//All games.
	'unknown_request'					=> "Petici&oacuten desconocida",
	
	//pcc_EchoPlayerList()
	'no_players'						=> "Todav&iacutea no hay jugadores.",
	'player_list_title'					=> "Lista de jugadores y resultados",	
	'player_list_th_player'				=> "Jugador",
	'player_list_th_active'				=> "Partidas<br />Activas",
	'player_list_th_complete'			=> "Partidas<br />Terminadas",
	'player_list_th_wins'				=> "Ganadas",
	'player_list_th_draws'				=> "Tablas",
	'player_list_th_points'				=> "Puntos",
	'player_list_th_active_white'		=> "Partidas<br />Activas<br />Blancas",
	'player_list_th_complete_white'		=> "Partidas<br />Acabadas<br />Blancas",
	'player_list_th_wins_white'			=> "Ganadas<br />Blancas",
	'player_list_th_draws_white'		=> "Tablas<br />Blancas",
	'player_list_th_active_black'		=> "Partidas<br />Activas<br />Negras",
	'player_list_th_complete_black'		=> "Partidas<br />Acabadas<br />Negras",
	'player_list_th_wins_black'			=> "Ganadas<br />Negras",
	'player_list_th_draws_black'		=> "Tablas<br />Negras",
	
	//pcc_EchoNewGameForm()
	'new_game_form_heading'				=> "Introduce la informaci&oacuten para retar a alguien:",
	'new_game_form_color'				=> "Color:",
	'new_game_form_white'				=> "Blancas",
	'new_game_form_black'				=> "Negras",
	'new_game_form_opponent'			=> "Oponente:",
	'new_game_form_any_player'			=> "** Cualquiera **",
	'new_game_form_notification'		=> "Notificaci&oacuten:",
	'new_game_form_notification_yes'	=> "Notif&iacutecame via email cuando mi oponente mueva ficha.",
	'new_game_form_notification_no'		=> "No me notifiques cuando mi oponente mueva ficha - Lo mirar&eacute por mi cuenta.",
	'new_game_form_comment_head'		=> "Comentarios:",
	
	//pcc_EchoForkGameForm()
	'fork_game_first_option'			=> "--Crea un juego nuevo en esta posici&oacuten--",
	'fork_game_same_players'			=> "Usa los mismos jugadores",
	'fork_game_switch_sides'			=> "Mismos jugadores, lado contrario",
	'fork_game_open_white'				=> "Muestra desaf&iacuteo activo conmigo como blancas",
	'fork_game_open_black'				=> "Muestra desaf&iacuteo activo conmigo como negras",

	//pcc_ProcessForkGame()
	'process_fork_no_login'				=> "Tienes que estar logueado para crear una partida.",
	'process_fork_no_color'				=> "No se ha seleccionado un color correcto.",
	'process_fork_bad_fork'				=> "El valor de bifurcaci&oacuten %s no es correcto.",
	'process_fork_comment'				=> "Este juego fue bifurcado en el movimiento %1\$s/%2\$s de la partida entre  " . 
										   "%3\$s vs. %4\$s que comenz&oacute en %5\$s.",
	'process_fork_last_move'			=> "&uacuteltimo movimiento transferido del juego padre.",
	
	//pcc_EchoAcceptGameForm()
	'accept_game_header'				=> "Acepta la oferta para jugar %1\$s vs. %2\$s",
	'accept_game_notify'				=> "Notif&iacutecame via email cuando mi oponente mueva ficha.",
	'accept_game_no_notify'				=> "No me notifiques cuando mi oponente mueva ficha - Lo mirar&eacute por mi cuenta.",
	'accept_game_accept'				=> "Aceptar Desaf&iacuteo",
	'accept_game_decline'				=> "Rechazar Desaf&iacuteo",
	'accept_game_no_login'				=> "Debes estar logueado para aceptar un desaf&iacuteo.",

	//pcc_EchoRevokeChallengeForm()
	'revoke_game_header'				=> "Tu desaf&iacuteo para el juego %s vs. %s",
	'revoke_game_warn'    				=> "AVISO: Una vez que usted pulse &quot Revocar el Desaf&iacuteo &quot este juego ser&aacute suprimido sin imprimirse.",
	'revoke_game_revoke'				=> "Revocar Desaf&iacuteo",
	'revoke_game_no_login'				=> "Tienes que estar logueado para revocar un desaf&iacuteo.",
	
	//pcc_ProcessDeclineGame()
	'decline_already_begun'				=> "Este juego ya est&aacute empezado y no puede rechazarse.",
	'decline_not_specific'				=> "No te hicieron a ti el desafio, por lo que no puedes rechazarlo.",
	'decline_subject'					=> "PCChess: Tu desaf&iacuteo a %s ha sido rechazado.",
	'decline_body'						=> "%1\$s ha rechazado tu desaf&iacuteo para jugar %2\$s.",
	'decline_message_notify'			=> "%1\$s ha sido notificado via email tu rechazo a la partida %2\$s.",
	'decline_message_no_notify'			=> "%1\$s no ha sido notificado via email sobre tu rechazo a la partida %2\$s.",
	'decline_no_login'					=> "Tienes que estar logueado para rechazar una partida.",
	
	//pcc_RevokeChallenge()
	'revoke_already_begun'				=> "Este juego ya est&aacute empezado y no puede revocarse.",
	'revoke_not_specific'				=> "No te hicieron a ti el desaf&iacuteo, por lo que no puedes revocarlo.",
	'revoke_success'					=> "El desaf&iacuteo realizado por %s ha sido revocado.",
	'revoke_no_login'					=> "Tienes que estar logueado para revocar un desaf&iacuteo.",

	//pcc_ProcessAcceptGame()
	'accept_no_login'					=> "Tienes que estar logueado para aceptar un Desaf&iacuteo.",
	'accept_already'					=> "Esta partida ya fue agenciada por otro jugador: ",
	'accept_subject'					=> "PCChess: Tu desaf&iacuteo ha sido aceptado.",
	'accept_body'						=> "%1\$s ha aceptado jugar con %2\$s a %3\$s.",
	'accept_you_will_be_notified'		=> "Se te notificar&aacute via email cuando tu oponente mueva ficha.",
	'accept_you_will_not_be_notified'	=> "No se te notificar&aacute via email cuando <br />tu oponente mueva ficha. Por favor, cons&uacuteltalo a diario.",
	'accept_unknown'					=> "Situaci&oacuten desconocida en pcc_ProcessAcceptGame().",
	'accept_opponent_notified'			=> "%1\$s ha sido notificado via email sobre tu acepto a jugar %2\$s.",
	'accept_opponent_not_notified'		=> "%1\$s no ha sido notificado via email sobre tu acepto a jugar %2\$s.",
	
	//pcc_ProcessNewGame()
	'issue_challenge_no_login'			=> "Tienes que estar logueado correctamente para realizar un Desaf&iacuteo.",
	'issue_challenge_no_color'			=> "No se ha seleccionado un color correcto.",
	'issue_you_will_be_notified'		=> "Se te notificar&aacute via email cuando el desaf&iacuteo sea aceptado.",
	'issue_you_will_not_be_notified'	=> "NO se te notificar&aacute via email cuando el desaf&iacuteo sea aceptado. Por favor, cons&uacuteltalo diariamente.",
	'issue_message'						=> "Tu solicitud de oponente %s ha sido procesada.",
	'issue_no_login'					=> "Tienes que estar logueado para crear una partida.",

	//pcc_ShowAddMoveForm()
	'add_form_move'						=> "Movimiento:",
	'add_form_help'						=> "Ayuda",
	'add_form_instructions'				=> "Escribe RESIGN en el movimiento para rendirte, o DRAW para ofrecer tablas.",
	'add_form_comment'					=> "Comentario:",
	'add_form_notify'					=> "Notif&iacutecame cuando mi oponente mueva ficha.",
	'add_comment'						=> "Escribe tu comentario...",
	'info'								=> "Info",

	//Game List
	'game_list_players'					=> "Jugadores",
	'game_list_status'					=> "Estado",
	'game_list_started'					=> "Comenzada el ",
	'game_list_num_moves'				=> "#&nbsp;Movs.",
	'game_list_last_move'				=> "Ult.&nbsp;Mov.",
	'game_list_comments'				=> "Comentarios",
	
	//pcc_DrawGame()
	'draw_no_login'						=> "Tienes que estar logueado para ofrecer tablas.",
	'draw_wrong_player'					=> "Esta partida es entre %1\$s y %2\$s. Solo ellos pueden ofrecer tablas en esta partida.",
	'draw_message_notify'				=> ' Se le ha enviado un email a tu oponente para informarle de tu solicitud de tablas.',
	'draw_message_no_notify'			=> ' Tu oponente no ha sido notificado sobre tu oferta de tablas.',

	//pcc_ResignGame()
	'resign_no_login'					=> "Tienes que estar logueado para rendirte.",
	'resign_wrong_player'				=> "Esta partida es entre %1\$s y %2\$s. Solo ellos pueden rendirse en esta partida.",
	'resign_message_notify'				=> ' Tu oponente ha sido notificado sobre tu rendici&oacuten.',
	'resign_message_no_notify'			=> ' Tu oponente NO ha sido notificado sobre tu rendici&oacuten.',

	//pcc_ProcessAcceptDraw()
	'accept_draw_no_login'				=> "Tienes que estar logueado para aceptar o rechazar unas tablas.",
	'accept_draw_wrong_player'			=> "Esta partida es entre %1\$s y %2\$s. Solo ellos pueden aceptar o rechazar tablas en esta partida",
	'accept_draw_accept_notify'			=> ' Se ha notificado por email a tu oponente que aceptas las tablas.',
	'accept_draw_accept_no_notify'		=> ' NO se ha notificado por email a tu oponente que aceptas las tablas.',
	'accept_draw_reject_notify'			=> ' Se ha notificado por email a tu oponente que rechazas las tablas.',
	'accept_draw_reject_no_notify'		=> '  NO se ha notificado por email a tu oponente que rechazas las tablas.',

	//pcc_AwaitingChallengerName()
	'awaiting_player'					=> "&lt;Esperando a jugador &gt;",

	//pcc_GetGameStatus()
	'game_status_awaiting_white'		=> "Esperando a blancas",
	'game_status_awaiting_black'		=> "Esperando a negras",
	'game_status_admin_suspend'			=> "Admin la ha suspendido",
	'game_status_white_draw_offer'		=> "Blancas ha ofrecido tablas",
	'game_status_black_draw_offer'		=> "Negras ha ofrecido tablas",
	'game_status_white_to_move'			=> "Blancas mueve",
	'game_status_black_to_move'			=> "Negras mueve",
	'game_status_white_mated_black'		=> "Blancas gano a Negras",
	'game_status_black_mated_white'		=> "Negras gano a blancas",
	'game_status_stalemate'				=> "Tablas",
	'game_status_draw_agreed_to'		=> "1/2-1/2",
	'game_status_white_resigned'		=> "0-1",
	'game_status_black_resigned'		=> "1-0",
	'game_status_unknown_result'		=> "Resultado desconocido",
	
	//pcc_EchoGame()
	'echo_game_start_position'			=> 'La partida empezar&aacute en la siguiente posici&oacuten:',
	'echo_game_player_offered_draw'		=> "Has ofrecido tablas a tu oponente. Debes esperar una respuesta.",
	'echo_game_white_offered_draw'		=> "Blancas ha ofrecido tablas. Negras no ha respondido.",
	'echo_game_black_offered_draw'		=> "Has ofrecido tablas a tu oponente. Debes esperar una respuesta.",
	'echo_game_export'					=> "exportar partida",
	'echo_game_refresh'					=> "Refrescar",
	'echo_game_not_started'				=> "Partida no comenzada, ",
	'echo_game_over'					=> "Fin de la partida, ",
	'echo_game_last_position_to_move'	=> "Ve a la &uacuteltima posici&oacuten para hacer un movimiento.",
	'echo_game_opponents_move'			=> "Es el turno de tu oponente.",
	
	//pcc_ShowAcceptDrawForm()
	'accept_draw_prompt'				=> 'Aceptar Tablas?',

	//pcc_ProcessMove()
	'process_move_no_move'				=> "Debes mover ficha.",
	'process_move_no_login'				=> "Debes estar logueado para mover ficha.",
	'process_move_wrong_player'			=> "Esta partida es entre %1\$s y %2\$s. Solo ellos pueden mover ficha en esta partida.",
	'process_move_accept_no_notify'		=> ' Tu oponente NO ha sido notificado sobre tu movimiento.',
	'process_move_reject_notify'		=> ' Se le ha enviado un email a tu oponente para notificarle que has movido ficha.',
	'process_move_checkmate'			=> 'El movimiento %s resulta ser Jaque Mate. Tu ganas!',
	'process_move_stalemate'			=> 'El movimiento %s resulta ser tablas. Tablas.',
	'process_move_added'				=> 'El movimiento %s ha sido añadido a la partida.',
	'process_move_invalid'				=> 'El movimiento %s no es v&aacutelido desde esta posici&oacuten.',
	'process_move_error'				=> 'Ha habido un error de lectura de tu partida en la base de datos.',
	
	//pcc_SendMoveEmail()
	'send_mail_subject'					=> "PCChess Notificaci&oacuten Autom&aacutetica de Movimientos",
	'send_mail_comment'					=> " %s ha hecho el siguiente comentario: ",
	'send_mail_resign'					=> "%1\$s se ha rendido en la partida %2\$s%3\$s%4\$s a %5\$s.",
	'send_mail_draw_offer'				=> "%1\$s ha ofrecido tablas en la partida %2\$s%3\$s%4\$s a %5\$s.",
	'send_mail_draw_accept'				=> "%1\$s ha aceptado tablas en la partida %2\$s%3\$s%4\$s a %5\$s.",
	'send_mail_draw_reject'				=> "%1\$s ha rechazado tablas en la partida %2\$s%3\$s%4\$s a %5\$s.",
	'send_mail_move'					=> "%1\$s ha hecho el movimiento %2\$s en la partida %3\$s%4\$s%5\$s a a\$s.",
	
	//pcc_GetDiscussThisLink()
	'discuss_this_link_view_comments'	=> 'Ver los comentarios de esta partida en el foro de Ajedrez',
	'discuss_this_link_this_game'		=> 'Comentar esta partida en el foro de Ajedrez.',
	'discuss_this_link_games'			=> 'Comentar partidas en el foro de ajedrez.',
	
	//Module
	'pcc_status_your_turn_header'		=> 'Partidas Ajedrez - Tu Turno',
	'pcc_status_your_turn_none'			=> 'No hay partidas en las que sea tu turno.',
	'pcc_status_opp_turn_header'		=> "Partidas Ajedrez - Turno de tu oponente",
	'pcc_status_opp_turn_none'			=> "No hay partidas en las que sea el turno de tu oponente.",
	'pcc_status_spec_challenges'		=> "Desaf&iacuteos Ajedrez expresamente a ti",
	'pcc_status_spec_challenges_none'	=> "No hay desaf&iacuteos hechos a ti.",
	'pcc_status_open_challenges'		=> "Desaf&iacuteos Ajedrez Abiertos",
	'pcc_status_open_challenges_none'	=> "No hay Desaf&iacuteos de Ajedrez abiertos.",

	'add_form_help_text'				=> "'Realiza movimientos utilizando la notaci&oacuten principio-fin usando notaci&oacuten algebraica para posiciones cuadradas. Por ejemplo, e2-e4.\\n\\n' +
	 'Si clicas sobre una ficha y luego sobre la cuadrilla donde quieres que vaya se escribir&aacute autom&aacuteticamente en la caja.\\n\\n' +
	 'Para enrocarse, clica en el cuadrado de principio y el cuadrado objetivo para el Rey. Por ejemplo, e1-g1 or e1-c1. Todas las reglas del enroque se cumplen.\\n\\n' +
	 'Para matar un peon de pasada, clica en el cuadrado de la pieza siendo movida y el cuadrado donde la pieza terminar&aacute. Por ejemplo, e4-f3.\\n\\n' +
	 'Los peones son promovidos a reinas a no ser que se especifique. Por ejemplo, e7-e8 N promover&aacute un pe&oacuten a caballo. Usa Q, B, R, N.  ' +
	 'Es obligatorio un espacio entre la posici&oacuten objetivo y la pieza de promoci&oacuten.\\n\\n' +
	 'Escribe DRAW para ofrecer o aceptar unas Tablas. Una vez hecha, no puede retirarse una oferta de tablas.\\n\\n'+
	 'Escribe RESIGN para rendirte. No hay manera de corregir una rendici&oacuten.'",


	'end'								=> "end"
);

$pcc_lang_pgn_find = array(
    "K",
    "Q",
    "R",
    "B",
    "N");

$pcc_lang_pgn_replace = array(
    "K",
    "Q",
    "R",
    "B",
    "N");
?>
