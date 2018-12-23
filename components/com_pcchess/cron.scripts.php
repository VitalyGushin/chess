<?php
// PCChess Component//
// Запускать раз в минуту!

//define( '_JEXEC', 1 );
defined( '_JEXEC' ) or die( 'Restricted access' ); // Защита от прямого вызова файла
//include(JPATH_SITE.DS. '/components/com_pcchess/smf.pcchess.com.php');
include_once(JPATH_SITE.DS. '/components/com_pcchess/include.pcchess.php');
//include_once('C:/WebServers/home/localhost/www/chess/components/com_pcchess/include.pcchess.php');
//include_once(JPATH_SITE.DS. '/components/com_pcchess/exportpgn.php');
//include(JPATH_SITE.DS.'administrator/components/com_pcchess/language/pcc.lang.us.php');
//include_once(JPATH_SITE.DS.'/components/com_pcchess/chess.inc.php');

//$user = &JFactory::getUser();
//$userid = $user->get('id');
//$myusername = pcc_GetUserName($userid);

function pcc_FirstFunc() {
//$querrrrry0 = mysql_query ("UPDATE chess_teams SET team_count = team_count+1 WHERE id = '4'");
jimport('joomla.utilities.utility');
$mailfrom = 'wit-89@mail.ru';
$fromname = 'Chess Tournament Site';

// Проверяется дата начала текущего турнира и если время настало (в минус ушло), то делаем распределение (начинаем турнир)
$querry0 = mysql_query ("SELECT id as 'thistournid' FROM chess_tournaments ORDER BY id DESC LIMIT 1");
$querr0 = mysql_fetch_assoc($querry0); // Запоминаем id текущего турнира
$thistournid = $querr0['thistournid'];
$querry1 = mysql_query("SELECT begintourndate FROM chess_tournaments WHERE id = '$thistournid'");
$querr1 = mysql_fetch_assoc($querry1);
$begin = date('YmdHis', strtotime($querr1['begintourndate'])); // Дата и время начала текущего турнира
$querry2 = mysql_query("SELECT NOW() as now"); // Дата и время сейчас
$querr2 = mysql_fetch_assoc($querry2);
$seychas = date('YmdHis', strtotime($querr2['now'])); // Сейчас в числовом формате
$raznost = $begin - $seychas;
$querry3 = mysql_query("SELECT COUNT('game_id') as 'count_games' FROM chess_chess_game WHERE tourn_id = '$thistournid'");
$querr3 = mysql_fetch_assoc($querry3); // Есть ли в этом турнире созданные игры? Если есть то не распределяем больше.
$count_games = $querr3['count_games'];
//echo $count_games; echo "<br>";
//echo $potom; echo "<br>";
//echo $seychas; echo "<br>";
//echo $raznost; echo "<br>";
if (($raznost < 0) AND ($count_games = 0)) // Делаем распределение и информируем всех игроков (один раз это должно произойти!)
  	{
   	pcc_NewRaspr();
    pcc_TeamRaspr();
    $querry21 = mysql_query("UPDATE chess_tournaments SET begin = '1' WHERE id = '$thistournid'"); // Устанавливаем метку что турнир начался - распределение произошло.
    // Тут отсылать всем игрокам сообщение что турнир начался.
    //JUtility::sendMail($mailfrom, $fromname, $email, $subject, $message);
	//JUtility::sendMail('email-отправителя', 'Заголовок от кого', 'email получателя', 'Тема письма', 'Текст письма', false);
	$subject = 'Started the tournament';
	$message = 'Attention! Dear members, started a chess tournament. Produced by the distribution of first round games.';
    $querry22 = mysql_query ("SELECT id as 'min_id' FROM chess_users WHERE team <> '0' OR app <> '0' ORDER BY id ASC LIMIT 1"); // Выбрать игрока текущего турнира с минимальным ID
	$querry23 = mysql_query ("SELECT id as 'max_id' FROM chess_users WHERE team <> '0' OR app <> '0' ORDER BY id DESC LIMIT 1");// Выбрать игрока текущего турнира с максимальным ID
    $querr22 = mysql_fetch_assoc($querry22);
    $querr23 = mysql_fetch_assoc($querry23);
    $min_id = $querr22['min_id'];
    $max_id = $querr23['max_id'];
    for ($i = $min_id; $i <= $max_id; $i++)
    	{    	$querry24 = mysql_query ("SELECT id as 'next_id' FROM chess_users WHERE id = '$i' AND (team <> '0' OR app <> '0')");
    	$querr24 = mysql_fetch_assoc($querry24);
    	$next_id = $querr24['next_id'];
    	if ($next_id <> 0)
    		{    		$querry25 = mysql_query("SELECT email FROM chess_users WHERE id = '$i'");
    		$querr25 = mysql_fetch_assoc($querry25);
    		$email = $querr25['next_id'];
    		JUtility::sendMail($mailfrom, $fromname, $email, $subject, $message);    		}    	}
   	}

// Делаем проверку на победителя если турнир идет
$querry4 = mysql_query ("SELECT winner_id FROM chess_tournaments ORDER BY id DESC LIMIT 1");
$querr4 = mysql_fetch_assoc($querry4); // Запоминаем id победителя текущего турнира
$winner_id = $querr4['winner_id'];
$querry5 = mysql_query ("SELECT team_winner_id FROM chess_tournaments ORDER BY id DESC LIMIT 1");
$querr5 = mysql_fetch_assoc($querry5); // Запоминаем id команды-победителя текущего турнира
$team_winner_id = $querr5['team_winner_id'];
if (($raznost < 0) AND ($winner_id == 0)) // Если турнир начался и победитель не определен
	{
	pcc_Proverka(); // Выполняем проверку победителя в личном первенстве и если не определен - распределяем следующий тур
	}
if (($raznost < 0) AND ($team_winner_id == 0)) // Если турнир начался и команда-победитель не определена
	{
	pcc_TeamProverka(); // Выполняем проверку победителя в командном первенстве и если не определен - распределяем следующий тур
	}

// Далее для каждой игры цикл
$querry6 = mysql_query ("SELECT steptime FROM chess_tournaments ORDER BY id DESC LIMIT 1");
$querr6 = mysql_fetch_assoc($querry6); // Запоминаем максимальное время хода текущего турнира (24 hours)
$steptime = $querr6['steptime'];
$querry7 = mysql_query ("SELECT partytime FROM chess_tournaments ORDER BY id DESC LIMIT 1");
$querr7 = mysql_fetch_assoc($querry7); // Запоминаем максимальное время партии текущего турнира (30 days)
$partytime = $querr6['partytime'];
$querry8 = mysql_query ("SELECT game_id as 'min_id' FROM chess_chess_game WHERE tourn_id = '$thistournid' ORDER BY game_id ASC LIMIT 1"); // Выбрать игру текущего турнира с минимальным ID
$querry9 = mysql_query ("SELECT game_id as 'max_id' FROM chess_chess_game WHERE tourn_id = '$thistournid' ORDER BY game_id DESC LIMIT 1");
$querr8 = mysql_fetch_assoc($querry8);
$querr9 = mysql_fetch_assoc($querry9);
$min_id = $querr8['min_id'];
$max_id = $querr9['max_id'];
for ($i = $min_id; $i <= $max_id; $i++) // $i - id очередной игры
	{	$subject = 'The events of the tournament';

	// Отрабатывает максимальное время хода
    $querry10 = mysql_query("SELECT move_no FROM chess_chess_move WHERE game_id = '$i' ORDER BY move_no DESC LIMIT 1");// Запоминаем номер последнего хода в текущей игре
    $querry17 = mysql_query("SELECT delay FROM chess_chess_move WHERE game_id = '$i' ORDER BY move_no DESC LIMIT 1");
    $query17 = mysql_fetch_assoc($querry17); // Запоминаем количество задержек на последнем ходе
    $delay = $query17['delay'];
    if (mysql_num_rows($querry10) == 0) // Если ходов не было в этой игре - считываем время начала игры
    	{
     	$querry18 = mysql_query("SELECT black_delay FROM chess_chess_game WHERE game_id = '$i'"); // Запоминаем задержку черного игрока
    	$query18 = mysql_fetch_assoc($querry18);
    	$black_delay = $query18['black_delay'];
    	if ($black_delay == 0) // Если у черного не было задержки, то её еще не было в этой игре
    		{        	$querry14 = mysql_query ("SELECT start + INTERVAL '$steptime' HOUR as 'end' FROM chess_chess_game WHERE game_id = '$i'");
        	}
        	elseif ($black_delay == 1) // Если у черного была задержка, то она на текущем ходе
        	{        	$querry14 = mysql_query ("SELECT start + INTERVAL '$steptime' + '$steptime' HOUR as 'end' FROM chess_chess_game WHERE game_id = '$i'");        	}
        $querr14 = mysql_fetch_assoc($querry14);
        $end = date('YmdHis', strtotime($querr14['end'])); // Крайняя дата и время окончания хода
        $color = 1; // Сначала белый ходит    	}
    	else // Если ходы были - считываем время последнего хода
    	{
    	if ($delay == 0) // Если на последнем ходе не было задержек, то добавляется один интервал
    		{
     		$querry15 = mysql_query("SELECT entered + INTERVAL '$steptime' HOUR as 'end' FROM chess_chess_move WHERE game_id = '$i' ORDER BY move_no DESC LIMIT 1");
     		}
     		elseif ($delay == 1) // Если задержка была на последнем ходе, то два интервала берется
     		{     		$querry15 = mysql_query("SELECT entered + INTERVAL '$steptime' + '$steptime' HOUR as 'end' FROM chess_chess_move WHERE game_id = '$i' ORDER BY move_no DESC LIMIT 1");     		}
        $querr15 = mysql_fetch_assoc($querry15);
        $end = date('YmdHis', strtotime($querr15['end'])); // Крайняя дата и время окончания хода
        $querry13 = mysql_query("SELECT color FROM chess_chess_move WHERE game_id = '$i' ORDER BY move_no DESC LIMIT 1");
    	$query13 = mysql_fetch_assoc($querry13); // Запоминаем цвет последнего сходившего игрока в текущей игре
    	$color = $query13['color'];    	}
    $raznost1 = $end - $seychas;
    if ($raznost1 < 0) // Если время вышло
    	{ // Далее считывается задержка, если ход не зделал - отправляется задержка, если уже была одна - засчитывается поражение, и всё это с уведомлениями
        if ($color == 1) // Черный последний ходил
        	{         	$querry11 = mysql_query("SELECT white_delay FROM chess_chess_game WHERE game_id = '$i'"); // Запоминаем задержку белого игрока
    		$query11 = mysql_fetch_assoc($querry11);
    		$white_delay = $query11['white_delay'];
            if ($white_delay == 0) // Если задержек еще не было - засчитываем первую задержку белому (нужно учесть что ему после этого выделяется еще день)
            	{            	$querrry16 = mysql_query("SELECT complete FROM chess_chess_game WHERE game_id = '$i'");
            	$querr16 = mysql_fetch_assoc($querrry16);
            	$complete = $querr16['complete'];
            	$querrry17 = mysql_query("SELECT game_id FROM chess_chess_game WHERE game_id = '$i'");
            	$querr17 = mysql_fetch_assoc($querrry17);
            	$game_id = $querr17['game_id'];
            	if (($complete == 0) AND ($game_id <> 0))
            		{                	$querry16 = mysql_query("UPDATE chess_chess_game SET white_delay = '1' WHERE game_id = '$i'"); // Только в незавершенных играх
                	$querry18 = mysql_query("UPDATE chess_chess_move SET delay = '1' WHERE game_id = '$i' ORDER BY move_no DESC LIMIT 1"); // Помечаем ход задержкой
                	// Далее отправляем письмо белому - что ему засчитана первая задержка и при повторной задержке будет пичалька и черному - что его оппоненту не повезло
                	$querry30 = mysql_query("SELECT white_user_id FROM chess_chess_game WHERE game_id = '$i'");
                	$querr30 = mysql_fetch_assoc($querry30);
                	$white_user_id = $querr30['white_user_id'];
                	$querry31 = mysql_query("SELECT email FROM chess_users WHERE id = '$white_user_id'");
	                $querr31 = mysql_fetch_assoc($querry31);
                	$email = $querr31['email'];
                	$message = 'You counted the first time delay. When the delay time again you will be forfeited!';
                	JUtility::sendMail($mailfrom, $fromname, $email, $subject, $message);
                	$querry32 = mysql_query("SELECT black_user_id FROM chess_chess_game WHERE game_id = '$i'");
                	$querr32 = mysql_fetch_assoc($querry32);
                	$black_user_id = $querr32['black_user_id'];
                	$querry33 = mysql_query("SELECT email FROM chess_users WHERE id = '$black_user_id'");
                	$querr33 = mysql_fetch_assoc($querry33);
                	$email = $querr33['email'];
                	$message = 'Credited to your opponent first time delay. In re the delay time it will be forfeited.';
                	JUtility::sendMail($mailfrom, $fromname, $email, $subject, $message);
                	}            	}
            	elseif ($white_delay == 1) // Если задержка уже есть - засчитываем поражение белому
            	{
              	$querrry16 = mysql_query("SELECT complete FROM chess_chess_game WHERE game_id = '$i'");
            	$querr16 = mysql_fetch_assoc($querrry16);
            	$complete = $querr16['complete'];
            	$querrry17 = mysql_query("SELECT game_id FROM chess_chess_game WHERE game_id = '$i'");
            	$querr17 = mysql_fetch_assoc($querrry17);
            	$game_id = $querr17['game_id'];
            	if (($complete == 0) AND ($game_id <> 0))
            		{            		$querry16 = mysql_query("UPDATE chess_chess_game SET complete = '1' AND result = '0' WHERE game_id = '$i'"); // Только в незавершенных играх
             		// result = '0' - Белый победил черного
                	// Далее отправляем письмо черному - что он победил, и белому - что он ему засчитано поражение изза повторной задержки времени хода
                	$querry30 = mysql_query("SELECT white_user_id FROM chess_chess_game WHERE game_id = '$i'");
                	$querr30 = mysql_fetch_assoc($querry30);
                	$white_user_id = $querr30['white_user_id'];
                	$querry31 = mysql_query("SELECT email FROM chess_users WHERE id = '$white_user_id'");
                	$querr31 = mysql_fetch_assoc($querry31);
                	$email = $querr31['email'];
                	$message = 'You forfeited in this game because of the delay time again!';
                	JUtility::sendMail($mailfrom, $fromname, $email, $subject, $message);
                	$querry32 = mysql_query("SELECT black_user_id FROM chess_chess_game WHERE game_id = '$i'");
                	$querr32 = mysql_fetch_assoc($querry32);
                	$black_user_id = $querr32['black_user_id'];
                	$querry33 = mysql_query("SELECT email FROM chess_users WHERE id = '$black_user_id'");
                	$querr33 = mysql_fetch_assoc($querry33);
                	$email = $querr33['email'];
                	$message = 'Forfeited to your opponent in this game because of repeated delays of time. You have won this game.';
                	JUtility::sendMail($mailfrom, $fromname, $email, $subject, $message);
                	}            	}        	}
        	elseif ($color == 0) // Белый последний ходил
        	{         	$querry12 = mysql_query("SELECT black_delay FROM chess_chess_game WHERE game_id = '$i'"); // Запоминаем задержку черного игрока
    		$query12 = mysql_fetch_assoc($querry12);
    		$black_delay = $query12['black_delay'];
     		if ($black_delay == 0) // Если задержек еще не было - засчитываем первую задержку черному
            	{
              	$querrry16 = mysql_query("SELECT complete FROM chess_chess_game WHERE game_id = '$i'");
            	$querr16 = mysql_fetch_assoc($querrry16);
            	$complete = $querr16['complete'];
            	$querrry17 = mysql_query("SELECT game_id FROM chess_chess_game WHERE game_id = '$i'");
            	$querr17 = mysql_fetch_assoc($querrry17);
            	$game_id = $querr17['game_id'];
            	if (($complete == 0) AND ($game_id <> 0))
            		{              		$querry16 = mysql_query("UPDATE chess_chess_game SET black_delay = '1' WHERE game_id = '$i'"); // Только в незавершенных играх
                	$querry18 = mysql_query("UPDATE chess_chess_move SET delay = '1' WHERE game_id = '$i' ORDER BY move_no DESC LIMIT 1"); // Помечаем ход задержкой
                	// Далее отправляем письмо черному - что ему засчитана первая задержка и при повторной задержке будет пичалька и белому - что его оппоненту не повезло
                	$querry30 = mysql_query("SELECT white_user_id FROM chess_chess_game WHERE game_id = '$i'");
                	$querr30 = mysql_fetch_assoc($querry30);
                	$white_user_id = $querr30['white_user_id'];
                	$querry31 = mysql_query("SELECT email FROM chess_users WHERE id = '$white_user_id'");
                	$querr31 = mysql_fetch_assoc($querry31);
                	$email = $querr31['email'];
                	$message = 'Credited to your opponent first time delay. In re the delay time it will be forfeited.';
                	JUtility::sendMail($mailfrom, $fromname, $email, $subject, $message);
                	$querry32 = mysql_query("SELECT black_user_id FROM chess_chess_game WHERE game_id = '$i'");
                	$querr32 = mysql_fetch_assoc($querry32);
                	$black_user_id = $querr32['black_user_id'];
                	$querry33 = mysql_query("SELECT email FROM chess_users WHERE id = '$black_user_id'");
                	$querr33 = mysql_fetch_assoc($querry33);
                	$email = $querr33['email'];
                	$message = 'You counted the first time delay. When the delay time again you will be forfeited!';
                	JUtility::sendMail($mailfrom, $fromname, $email, $subject, $message);
                	}
            	}
            	elseif ($black_delay == 1) // Если задержка уже есть - засчитываем поражение черному
            	{
              	$querrry16 = mysql_query("SELECT complete FROM chess_chess_game WHERE game_id = '$i'");
            	$querr16 = mysql_fetch_assoc($querrry16);
            	$complete = $querr16['complete'];
            	$querrry17 = mysql_query("SELECT game_id FROM chess_chess_game WHERE game_id = '$i'");
            	$querr17 = mysql_fetch_assoc($querrry17);
            	$game_id = $querr17['game_id'];
            	if (($complete == 0) AND ($game_id <> 0))
            		{            		$querry16 = mysql_query("UPDATE chess_chess_game SET complete = '1' AND result = '1' WHERE game_id = '$i'"); // Только в незавершенных играх
             		// result = '1' - Черный победил белого
                	// Далее отправляем письмо белому - что он победил, и черному - что он ему засчитано поражение изза повторной задержки времени хода
                	$querry30 = mysql_query("SELECT white_user_id FROM chess_chess_game WHERE game_id = '$i'");
                	$querr30 = mysql_fetch_assoc($querry30);
                	$white_user_id = $querr30['white_user_id'];
                	$querry31 = mysql_query("SELECT email FROM chess_users WHERE id = '$white_user_id'");
                	$querr31 = mysql_fetch_assoc($querry31);
                	$email = $querr31['email'];
                	$message = 'Forfeited to your opponent in this game because of repeated delays of time. You have won this game.';
                	JUtility::sendMail($mailfrom, $fromname, $email, $subject, $message);
                	$querry32 = mysql_query("SELECT black_user_id FROM chess_chess_game WHERE game_id = '$i'");
                	$querr32 = mysql_fetch_assoc($querry32);
                	$black_user_id = $querr32['black_user_id'];
                	$querry33 = mysql_query("SELECT email FROM chess_users WHERE id = '$black_user_id'");
                	$querr33 = mysql_fetch_assoc($querry33);
                	$email = $querr33['email'];
                	$message = 'You forfeited in this game because of the delay time again!';
                	JUtility::sendMail($mailfrom, $fromname, $email, $subject, $message);
                	}
            	}        	}    	}

	// Отрабатывает максимальное время одной партии
	// Если время партии вышло - выставляем result = '6' - неизвестный результат, а в разделе администрирования выводить такие игры и админу письмо присылать
    $querry19 = mysql_query ("SELECT start + INTERVAL '$partytime' DAY as 'end' FROM chess_chess_game WHERE game_id = '$i'");
    $querr19 = mysql_fetch_assoc($querry19);
    $part_end = date('YmdHis', strtotime($querr19['end'])); // Крайняя дата и время окончания партии
    $raznost2 = $part_end - $seychas;
    if ($raznost2 < 0) // Если время вышло
   		{   		$querrry16 = mysql_query("SELECT complete FROM chess_chess_game WHERE game_id = '$i'");
     	$querr16 = mysql_fetch_assoc($querrry16);
        $complete = $querr16['complete'];
        $querrry17 = mysql_query("SELECT game_id FROM chess_chess_game WHERE game_id = '$i'");
        $querr17 = mysql_fetch_assoc($querrry17);
        $game_id = $querr17['game_id'];
        if (($complete == 0) AND ($game_id <> 0))
        	{        	$querry20 = mysql_query("UPDATE chess_chess_game SET complete = '1' AND result = '6' WHERE game_id = '$i'");
        	// Далее высылаем письмо админу - что появились игры требующие судейского решения, и игрокам - что их игра окончена и исход решит судья
        	$querry30 = mysql_query("SELECT white_user_id FROM chess_chess_game WHERE game_id = '$i'");
        	$querr30 = mysql_fetch_assoc($querry30);
        	$white_user_id = $querr30['white_user_id'];
        	$querry31 = mysql_query("SELECT email FROM chess_users WHERE id = '$white_user_id'");
        	$querr31 = mysql_fetch_assoc($querry31);
        	$email = $querr31['email'];
        	$message = 'Time one of your games left. The game is over. The decision to result in the near future will judge.';
        	JUtility::sendMail($mailfrom, $fromname, $email, $subject, $message);
        	$querry32 = mysql_query("SELECT black_user_id FROM chess_chess_game WHERE game_id = '$i'");
        	$querr32 = mysql_fetch_assoc($querry32);
        	$black_user_id = $querr32['black_user_id'];
        	$querry33 = mysql_query("SELECT email FROM chess_users WHERE id = '$black_user_id'");
        	$querr33 = mysql_fetch_assoc($querry33);
        	$email = $querr33['email'];
        	JUtility::sendMail($mailfrom, $fromname, $email, $subject, $message);
        	$querry34 = mysql_query("SELECT email FROM chess_users WHERE usertype = 'Super Administrator' ORDER BY id DESC LIMIT 1"); // Майл свежезарегистрированного админа
        	$querr34 = mysql_fetch_assoc($querry34);
        	$email = $querr34['email'];
        	JUtility::sendMail($mailfrom, $fromname, $email, $subject, $message);
        	}    	}
    // Конец цикла для каждой игры.
	}

}

//  echo date('Y-m-d H:i:s',  strtotime($quer['now']));

//pcc_FirstFunc();

?>