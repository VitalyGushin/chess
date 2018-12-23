<?php
// Desc.: File di lingua italiana per il componente PCChess.
// File: pcc.lang.italian.php
// Author: Marian TANASE [www.tanase.it]

#echo "DBG: Default Lang US<br>";
global $pcc_lang,$pcc_lang_pgn_find,$pcc_lang_pgn_replace ;

$pcc_lang = array(
	//General Messages.
	'date_time_format'					=> "d M y H:i:s",
	'date_format'						=> "d M y",
	'forms_go'							=> "Invia la mossa",
	'game_not_found'					=> "Partita numero %s non &egrave; stata trovata.",
	'no_game_id'						=> "Nessun game_id presente.",
	'v'									=> " v. ",
	'black'								=> "nero",
	'white'								=> "bianco",
	'Black'								=> "Nero",
	'White'								=> "Bianco",
	'started'							=> " iniziato ",
	'error'								=> "Errore: ",
	'Yes'								=> "Si",
	'No'								=> "No",
	'create_game_notification'			=> "Crea partita",
	'avviso'							=> "AVVISO",
	'login_register'					=> "Se vuoi lanciare una sfida e di conseguenza di creare una nuova partita, devi essere registrato sul sito.",
	
	//Top links and main page title.
	'toplink_activegames' 				=>	"Partite in svolgimento",
	'toplink_newgame' 					=>	"Nuova partita",
	'toplink_completegames' 			=>	"Partite concluse",
	'toplink_players' 					=>	"Statistiche",
	'toplink_exercise' 					=>	"Chessexercise",
	'toplink_shredder' 					=>	"Play vs Shredder",
	'title'								=> 	"PCChess",
	'component_title' 					=>	"Gioco di Scacchi per Corrispondenza",
	
	//Active games.
	'active_game_html_title'			=> "Partite a scacchi in svolgimento",
	'active_game_all'					=> "Tutte le partite in svolgimento",
	'active_game_no_games'				=> "Non ci sono partite in svolgimento.",
	'active_game_specific_challenges'	=> "Sfide aperte che riguardano il giocatore &quot;%s&quot; :",
	'active_game_awaiting_move'			=> "Partite in cui &egrave; il tuo turno",
	'active_game_no_awaiting_move'		=> "Non ci sono partite in svolgimento in cui devi muovere.",
	'active_game_opponents_move'		=> "Partite in cui il tuo avversario deve muovere",
	'active_game_no_opponents_move'		=> "Non ci sono partite in cui i tuoi avversari devono muovere.",
	'active_game_other'					=> "Altre partite in svolgimento:",
	'active_game_no_other'				=> "Non ci sono altre partite in svolgimento.",
	
	//Complete games.
	'complete_game_html_title'			=> "Partite concluse",
	'complete_game_all'					=> "Tutte le partite concluse",
	'complete_game_no_games'			=> "Non ci sono partite concluse.",
	'complete_game_player'				=> "Tutte le tue partite concluse",
	'complete_game_no_player'			=> "Il giocatore <strong>%s</strong> non ha nessuna partita conclusa.",
	'complete_game_other'				=> "Altre partite concluse:",
	'complete_game_no_other'			=> "Non ci sono altre partite concluse.",
	
	//Submit move.
	'submit_move_corrupt'				=> "E successo un errore. Riprova di nuovo.",
	'submit_move_empty'					=> 'Mossa non valida. Per favore, fai una mossa.',
	'submit_move_resign_caps_warn'		=> 'Per abbandonare la partita, devi scrivere con maiuscole "RESIGN".',
	'submit_move_draw_caps_warn'		=> 'Per proporre la patta, devi scrivere con maiuscole "DRAW".',
	'warn_resign'						=> 'Per abbandonare la partita, devi inserire il testo <strong>RESIGN</strong> nella casella della mossa.',
	'warn_draw'							=> 'Per proporre la patta, inserisci il testo <strong>DRAW</strong>.',
	
	//New games.
	'new_game_html_title'				=> "Nuove partite a scacchi",
	'new_game_specific'					=> "Clicca su una delle sfide aperte che ti riguarda per accettarla:",
	'new_game_no_specific'				=> "Non hai sfide aperte.",
	'new_game_open'						=> "Cliccca su una delle sfide aperte per accettarla:",
	'new_game_open_not_logged_in'		=> "Devi connetterti o registrarti prima di accettare una delle sfide aperte.",
	'new_game_no_open'					=> "Non ci sono sfide aperte.",
	'new_game_pending'					=> "Le seguenti sfide lanciate da te:",
	'new_game_no_pending'				=> "Non ci sono sfide lanciate da te.",
	
	//Fork game.
	'fork_game_no_player_selected'		=> "Devi selezionare un'opzione per creare una nuova partita da questa posizione.",
	
	//Players.
	'players_html_title'				=> "Giocatori di Scacchi",
	'player_html_title'					=> "%s's Gioco di Scacchi",
	'players_not_found'					=> "%s non &egrave; un utente riconosciuto.",
	'players_html_title'				=> "Giocatori di Scacchi",
	'players_html_title'				=> "Giocatori di Scacchi",
	'players_html_title'				=> "Giocatori di Scacchi",

	//All games.
	'all_games_html_title'				=> "Tutte le partite a scacchi",
	'all_games_pathway'					=> "Tutte le partite",
	'all_games_header'					=> "Tutte le partite esistenti",

	//All games.
	'unknown_request'					=> "Richiesta Sconosciuta",
	
	//pcc_EchoPlayerList()
	'no_players'						=> "Non ci sono ancora giocatori.",
	'player_list_title'					=> "Statistiche",	
	'player_list_th_player'				=> "Giocatore",
	'player_list_th_active'				=> "Partite<br />in svolgimento",
	'player_list_th_complete'			=> "Partite<br />Concluse",
	'player_list_th_wins'				=> "Vincite",
	'player_list_th_draws'				=> "Pareggi",
	'player_list_th_points'				=> "Punti",
	'player_list_th_active_white'		=> "Partite<br />in svolgimento</br />per Bianco",
	'player_list_th_complete_white'		=> "Partite<br />concluse<br />per Bianco",
	'player_list_th_wins_white'			=> "Partite vinte<br /> del Bianco",
	'player_list_th_draws_white'		=> "Pareggi<br /> del Bianco",
	'player_list_th_active_black'		=> "Partite<br />in svolgimento<br />per Nero",
	'player_list_th_complete_black'		=> "Partite<br />concluse<br />per Nero",
	'player_list_th_wins_black'			=> "Partite vinte<br /> del Nero",
	'player_list_th_draws_black'		=> "Pareggi<br />del Nero",
	
	//pcc_EchoNewGameForm()
	'new_game_form_heading'				=> "Lancia una sfida:",
	'new_game_form_color'				=> "Colore:",
	'new_game_form_white'				=> "Bianco",
	'new_game_form_black'				=> "Nero",
	'new_game_form_opponent'			=> "Avversario:",
	'new_game_form_any_player'			=> "** Qualsiasi giocatore **",
	'new_game_form_notification'		=> "Notifica:",
	'new_game_form_notification_yes'	=> "Mandami un avviso quando il mio avversario far&agrave; la sua mossa.",
	'new_game_form_notification_no'		=> "Non avvisami per email quando l'avversario far&agrave; la sua mossa - Verificher&ograve; da solo ogni giorno.",
	'new_game_form_comment_head'		=> "Commenti:",
	
	//pcc_EchoForkGameForm()
	'fork_game_first_option'			=> "--Crea una nuova partita da questa posizione--",
	'fork_game_same_players'			=> "I stessi giocatori",
	'fork_game_switch_sides'			=> "I stessi giocatori, cambia colore",
	'fork_game_open_white'				=> "Pubblica una sfida dove io gioco con Bianco",
	'fork_game_open_black'				=> "Pubblica una sfida dove io gioco con Nero",

	//pcc_ProcessForkGame()
	'process_fork_no_login'				=> "Per creare una nuova partita devi essere loggato.",
	'process_fork_no_color'				=> "Non &egrave; stato selezionato il colore giusto.",
	'process_fork_bad_fork'				=> "La mossa %s non &egrave; coretta.",
	'process_fork_comment'				=> "La partita iniziata il %5\$s fra %3\$s e %4\$s &egrave; stata duplicata alla mossa %1\$s/%2\$s.",
	'process_fork_last_move'			=> "L'ultima mossa &egrave; stata trasferita dalla prima partita.",
	
	//pcc_EchoAcceptGameForm()
	'accept_game_header'				=> "Accetto offerta di giocare col %1\$s contro %2\$s",
	'accept_game_notify'				=> "Avvertimi quando il mio avversario far&agrave; la sua mossa.",
	'accept_game_no_notify'				=> "Non avvertirmi per email quando l'avversario far&agrave; la sua mossa - Verificher&ograve; da solo ogni giorno.",
	'accept_game_accept'				=> "Accetto la Sfida",
	'accept_game_decline'				=> "Non accetto la Sfida",
	'accept_game_no_login'				=> "Devi essere loggato per accettare la sfida per una nuova partita.",

	//pcc_EchoRevokeChallengeForm()
	'revoke_game_header'				=> "La tua Sfida per la partita %s contro %s",
	'revoke_game_warn'    				=> "ATTENZIONE: Una volta cliccato su &quot;Non accetto la Sfida&quot; questa partita sar&agrave; cancellata.",
	'revoke_game_revoke'				=> "Non accetto la Sfida",
	'revoke_game_no_login'				=> "Devi essere loggato per Rifiutare una Sfida in una nuova partita.",
	
	//pcc_ProcessDeclineGame()
	'decline_already_begun'				=> "Questa partita &egrave; gi&agrave; iniziata e di conseguenza non pu&ograve; essere annullata.",
	'decline_not_specific'				=> "Questa sfida non riguarda te, quindi non sei abilitato di rifiutarla.",
	'decline_subject'					=> "Questa sfida per %s &egrave; stata rifiutata.",
	'decline_body'						=> "%1\$s ha rifiutato la tua sfida di giocare %2\$s.",
	'decline_message_notify'			=> "%1\$s &egrave; stato avvisato per email del tuo rifiuto di giocare %2\$s.",
	'decline_message_no_notify'			=> "%1\$s non &egrave; stato avvisato per email del tuo rifiuto di giocare %2\$s.",
	'decline_no_login'					=> "Devi essere loggato per poter rifiutare una partita.",
	
	//pcc_RevokeChallenge()
	'revoke_already_begun'				=> "Questa partita &egrave; gi&agrave; iniziata e di conseguenza non pu&ograve; essere annullata.",
	'revoke_not_specific'				=> "Questa sfida non riguarda te, quindi non sei abilitato ad annullarla.",
	'revoke_success'					=> "La sfida per %s &egrave; stata annullata.",
	'revoke_no_login'					=> "Devi essere loggato per poter annullare una sfida.",

	//pcc_ProcessAcceptGame()
	'accept_no_login'					=> "Devi loggarti per accettare una sfida.",
	'accept_already'					=> "Questa partita &egrave; gi&agrave; accettata da un altro giocatore: ",
	'accept_subject'					=> "La tua sfida &egrave; stata accettata.",
	'accept_body'						=> "%1\$s &egrave; d'accordo di giocare %2\$s at %3\$s.",
	'accept_you_will_be_notified'		=> "Sarai avvisato per email quando l'avversario far&agrave; la mossa.",
	'accept_you_will_not_be_notified'	=> "Non sarai avvisato per email quando l'avversario far&agrave; la mossa. Per favore, verifica ogni giorno.",
	'accept_unknown'					=> "Situazione sconosciuta in pcc_ProcessAcceptGame().",
	'accept_opponent_notified'			=> "%1\$s &egrave; stato avvisato per email del tuo accordo di giocare %2\$s.",
	'accept_opponent_not_notified'		=> "%1\$s non &egrave; stato avvisato per email del tuo accordo di giocare col %2\$s.",
	
	//pcc_ProcessNewGame()
	'issue_challenge_no_login'			=> "Devi essere registrato e connesso per lanciare una sfida.",
	'issue_challenge_no_color'			=> "Non &egrave; stato selezionato il colore giusto.",
	'issue_you_will_be_notified'		=> "Sarai avvisato per email quando la sfida sar&agrave; accettata.",
	'issue_you_will_not_be_notified'	=> "Non sarai avvisato per email quando la sfida sar&agrave; accettata. Devi verificare ogni giorno.",
	'issue_message'						=> "La tua richiesta a un avversario di giocare col <b>%s</b> e stata memorizzata.",
	'issue_no_login'					=> "Devi essere loggato per creare una nuova partita.",

	//pcc_ShowAddMoveForm()
	'add_form_move'						=> "La mia mossa !",
	'add_form_help'						=> "Aiuto",
	'add_form_instructions'				=> "Scrivi RESIGN nella casella della mossa per abbandonare, Scrivi DRAW per proporre la PATTA.",
	'add_form_comment'					=> "Commento:",
	'add_form_notify'					=> "Avvisami quando il mio avversario far&agrave; la mossa.",
	'add_comment'						=> "Inserisci il tuo commento...",
	'info'								=> "Informazioni",

	//Game List
	'game_list_players'					=> "Giocatori",
	'game_list_status'					=> "Stato",
	'game_list_started'					=> "Iniziato il ",
	'game_list_num_moves'				=> "#&nbsp;Mosse",
	'game_list_last_move'				=> "Ultima&nbsp;Mossa",
	'game_list_comments'				=> "Commenti",
	
	//pcc_DrawGame()
	'draw_no_login'						=> "Ti devi prima loggarti per proporre la PATTA.",
	'draw_wrong_player'					=> "Questa partita si sta svolgendo tra %1\$s e %2\$s. Solo questi due giocatori possono fare proposte di PATTA in questa partita.",
	'draw_message_notify'				=> ' Un messaggio di email &egrave; stato inviato per avvisare il tuo avversario della tua proposta di PATTA.',
	'draw_message_no_notify'			=> ' Il tuo avversario non &egrave; stato avvisato della tua proposta di PATTA.',

	//pcc_ResignGame()
	'resign_no_login'					=> "Devi essere loggato per abbandonare la partita.",
	'resign_wrong_player'				=> "Questa partita si svolge tra %1\$s e %2\$s. Solo questi giocatori possono abbandonare in questa partita.",
	'resign_message_notify'				=> ' Un messaggio di email &egrave; stato inviato per avvisare l\'avversario del tuo abbandono.',
	'resign_message_no_notify'			=> ' Il tuo avversario non &egrave; stato avvisato del tuo abbandono.',

	//pcc_ProcessAcceptDraw()
	'accept_draw_no_login'				=> "Devi essere loggato per poter accettare o rifiutare una proposta di patta.",
	'accept_draw_wrong_player'			=> "Questa partita si sta svolgendo tra %1\$s e %2\$s. Solo questi giocatori sono abilitati ad accettare o rifiutare proposte di pareggi in questa partita.",
	'accept_draw_accept_notify'			=> ' Un messaggio di email &egrave; stato inviato al tuo avversario, per avvisarlo che hai accettato la patta.',
	'accept_draw_accept_no_notify'		=> ' Il tuo avversario non &egrave; stato avvisato che hai accetatto la patta.',
	'accept_draw_reject_notify'			=> ' Un messaggio di email &egrave; stato inviato al tuo avversario per avvisarlo che hai rifiutato la patta.',
	'accept_draw_reject_no_notify'		=> ' Il tuo avversario non &egrave; stato informato che hai rifiutato la patta.',

	//pcc_AwaitingChallengerName()
	'awaiting_player'					=> "&lt;In attesa di un giocatore&gt;",

	//pcc_GetGameStatus()
	'game_status_awaiting_white'		=> "Aspettando la mossa del Bianco",
	'game_status_awaiting_black'		=> "Aspettando la mossa del Nero",
	'game_status_admin_suspend'			=> "L'amministratore ha sospesso la partita",
	'game_status_white_draw_offer'		=> "Bianco ha proposto la PATTA",
	'game_status_black_draw_offer'		=> "Nero ha proposto la PATTA",
	'game_status_white_to_move'			=> "Turno del Bianco",
	'game_status_black_to_move'			=> "Turno del Nero",
	'game_status_white_mated_black'		=> "Bianco ha vinto",
	'game_status_black_mated_white'		=> "Nero ha vinto",
	'game_status_stalemate'				=> "Patta per stallo",
	'game_status_draw_agreed_to'		=> "1/2-1/2",
	'game_status_white_resigned'		=> "0-1",
	'game_status_black_resigned'		=> "1-0",
	'game_status_unknown_result'		=> "Risultato sconosciuto",
	
	//pcc_EchoGame()
	'echo_game_start_position'			=> 'La partita inizier&agrave; da:',
	'echo_game_player_offered_draw'		=> "Hai proposto la PATTA. Devi aspettare la risposta dell tuo avversario.",
	'echo_game_white_offered_draw'		=> "Bianco ha proposto la PATTA. Nero non ha risposto.",
	'echo_game_black_offered_draw'		=> "Hai proposto la PATTA.<br />Devi aspettare una risposta.",
	'echo_game_export'					=> "Esporta PGN",
	'echo_game_refresh'					=> "Ricarica la pagina",
	'echo_game_not_started'				=> "Partita non iniziata ancora, ",
	'echo_game_over'					=> "Partita conclusa, ",
	'echo_game_last_position_to_move'	=> "Vai all'ultima posizione per fare la mossa.",
	'echo_game_opponents_move'			=> "&Egrave; il turno del tuo avversario .",
	
	//pcc_ShowAcceptDrawForm()
	'accept_draw_prompt'				=> "Accetti la PATTA ?",

	//pcc_ProcessMove()
	'process_move_no_move'				=> "Devi fare una mossa.",
	'process_move_no_login'				=> "Devi essere loggato per fare una mossa.",
	'process_move_wrong_player'			=> "Questa partita si gioca tra %1\$s e %2\$s. Solo questi giocatori possono fare le mosse in questa partita.",
	'process_move_accept_no_notify'		=> ' Il tuo avversario non &egrave; stato avvisato della tua mossa.',
	'process_move_reject_notify'		=> ' Un messaggio di email &egrave; stato inviato all\'avversario per avvisarlo della tua mossa.',
	'process_move_checkmate'			=> 'La mossa %s ha fatto Scacco Matto. Hai vinto!',
	'process_move_stalemate'			=> 'La mossa %s ha generato patta per stallo. La partita &egrave; PATTA.',
	'process_move_added'				=> 'La mossa <strong>%s</strong> &egrave; stata effettuata.',
	'process_move_invalid'				=> 'La mossa %s non &egrave; valida in questa posizione.',
	'process_move_error'				=> '&Egrave; succeso un errore durante il caricamento del gioco dal database.',
	
	//pcc_SendMoveEmail()
	'send_mail_subject'					=> "Notifica Automatica delle Mosse",
	'send_mail_comment'					=> " %s ha lasciato il commento: ",
	'send_mail_resign'					=> "%1\$s ha abbandonato nella partita %2\$s%3\$s%4\$s alla %5\$s.",
	'send_mail_draw_offer'				=> "%1\$s ha proposto risultato di parit&agrave; nella partita %2\$s%3\$s%4\$s alla %5\$s.",
	'send_mail_draw_accept'				=> "%1\$s ha accettato la parit&agrave; nella partita %2\$s%3\$s%4\$s alla %5\$s.",
	'send_mail_draw_reject'				=> "%1\$s ha rifiutato la parit&agrave; nella partita %2\$s%3\$s%4\$s alla %5\$s.",
	'send_mail_move'					=> "%1\$s ha fatto la mossa %2\$s nella partita %3\$s%4\$s%5\$s alla %6\$s.",
	
	//pcc_GetDiscussThisLink()
	'discuss_this_link_view_comments'	=> 'Visualizza i commenti riguardanti questa partita sul forum.',
	'discuss_this_link_this_game'		=> 'Commenta questa partita sul forum.',
	'discuss_this_link_games'			=> 'Commenta le partite sul forum.',
	
	//Module
	'pcc_status_your_turn_header'		=> 'Scacchi - Il tuo turno',
	'pcc_status_your_turn_none'			=> 'No ci sono partite in svolgimento in cui &egrave; il tuo turno.',
	'pcc_status_opp_turn_header'		=> "Scacchi - Il turno del tuo avversario",
	'pcc_status_opp_turn_none'			=> "Non ci sono partite in svolgimento in cui &egrave; il turno del tuo avversario.",
	'pcc_status_spec_challenges'		=> "Sfide lanciate che ti riguardano",
	'pcc_status_spec_challenges_none'	=> "Non ci sono lanciate sfide che ti riguardano.",
	'pcc_status_open_challenges'		=> "Sfide lanciate",
	'pcc_status_open_challenges_none'	=> "Non ci sono lanciate sfide.",

	'add_form_help_text'				=> "'Inserisci le mosse usando la notazione algebrica, coordinate di partenza - coordinate di arrivo. Ad esempio, e2-e4.\\n\\n' +
		 'Cliccando nella cassa di partenza e poi cliccando nella cassa di arrivo, genera la notazione corretta nella casella della mossa.\\n\\n' +
		 'Per fare l'arrocco, inserisci la cassa di partenza del Re e poi la cassa di arrivo. Ad esempio, e1-g1 or e1-c1. Tutte le regole dell'arrocco sono rispettate.\\n\\n' +
		 'Per catturare un pedone en-passant, inserisci la cassa del pedone della partenza e poi la cassa di arrivo. Ad esempio, e4-f3.\\n\\n' +
		 'Pedoni saranno promossi a livello di Donna in modo automatico se non &egrave; specificato altro. Ad esempio, e7-e8 A avra come risultato la promozione del pedone a livello di Alfiere. Devi scrivere D, A, T, C. ' +
		 'E obbligatorio lasciare uno spazio tra cassa di arrivo ed il pezzo desiderato.\\n\\n' +
		 'Scrivi DRAW per proporre o accettare il risultato di parit&agrave;. Non esiste nessun' altra via per annullare una proposta di patta, una volta gi&agrave; fatta.\\n\\n'+
		 'Scrivi RESIGN per abbandono. Non si pu&ograve; annullare un abbandono una volta fatto.'",


	'end'								=> "fine"
);

$pcc_lang_pgn_find = array(
    "K",  //Re (R)
    "Q",  //Donna (D)
    "R",  //Torre (T)
    "B",  //Alfiere (A)
    "N"); //Cavallo (C)

$pcc_lang_pgn_replace = array(
    "K",  //Re
    "Q",  //Donna
    "R",  //Torre
    "B",  //Alfiere
    "N"); //Cavallo
?>