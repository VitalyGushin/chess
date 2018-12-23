<?php
// PCChess Component//
/**
* Content code
* @ Package PCChess
* @ Copyright (C) 2005 Robert Prince
* @ All rights reserved
* @ PCChess is Free Software
* @ Released under GNU/GPL License : http://www.gnu.org/copyleft/gpl.html
* @ version $Id: pcchess.php,v 2.0 2010-08-17 Marian Tanase http://www.tanase.it
* @ modified for Joomla 1.5 by Hartmut Eilers http://www.eilers.net/
**/
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
?>
<link href="<?php echo $this->baseurl; ?>components/com_pcchess/css/pcchess.css" rel="stylesheet" type="text/css" />
<div id="pcchess">

<script language="JavaScript" type="text/JavaScript">
<!--
function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
//-->
</script>
<?php
include(JPATH_SITE.DS. '/components/com_pcchess/smf.pcchess.com.php');
include_once(JPATH_SITE.DS. '/components/com_pcchess/include.pcchess.php');
include_once(JPATH_SITE.DS. '/components/com_pcchess/exportpgn.php');

include_once(JPATH_SITE.DS. '/components/com_pcchess/cron.scripts.php');

//echo "<div class=\"header-top\">";
//echo "<h1>" . $pcc_lang['title'] . "</h1>";
//echo "<p>" . $pcc_lang['component_title'] . "</p>";
//echo "</div>";

$hasgames = pcc_HasGames();
$request = JRequest::get( '_REQUEST');
if ($request['page']) {
	$page = $request['page'];
} else {
	$page = "allactivegames";
}
#echo "DBG: $page<br>";

// replacement for global $my variable
$user = &JFactory::getUser();
$userid = $user->get('id');

$myusername = pcc_GetUserName($userid);

$params = &JComponentHelper::getParams( 'com_pcchess' );	// get the language parameter
$pcchess_ShowShredder=$params->get('shredder');
$pcchess_ShowExercise=$params->get('exercise');

$post = JRequest::get( '_POST' );
if (!pcc_UseMamboMenus()) {

// New button styles where I used 2 png images. [Tanase]
 //echo "<div id=\"pcc_nav\">";
 //echo "<a class=\"pcc-button\" href=\"".JRoute::_("index.php?option=com_pcchess&Itemid=" . pcc_GetItemIdActiveGameMenuID() . "&page=allactivegames\"")."><span>" . $pcc_lang['toplink_activegames'] . "</span></a>";
 //echo "<a class=\"pcc-button\" href=\"" .JRoute::_("index.php?option=com_pcchess&Itemid=" . pcc_GetItemIdCompleteGameMenuID() . "&page=allcompletegames\"")."><span>" . $pcc_lang['toplink_completegames'] . "</span></a>";
 //echo "<a class=\"pcc-button\" href=\"" .JRoute::_("index.php?option=com_pcchess&Itemid=" . pcc_GetItemIdNewGameMenuID() . "&page=newgame\"")."><span>" . $pcc_lang['toplink_newgame'] . "</span></a>";
 //echo "<a class=\"pcc-button\" href=\"".JRoute::_("index.php?option=com_pcchess&Itemid=" . pcc_GetItemIdPlayersMenuID() . "&page=players\"")."><span>" . $pcc_lang['toplink_players'] . "</span></a>";
 //echo "</div>";
 }

switch ($page)
{
case 'aufgabe':
		$mainframe->setPageTitle($pcc_lang['toplink_aufgabe']);
		echo "<iframe width=\"410\" scrolling=\"no\" height=\"440\" frameborder=\"0\" src=\"http://www.shredderchess.com/online/playshredder/
gdailytactics.php?mylang=de&mysize=32\"></iframe>";
	break;

case 'shredder':
		$mainframe->setPageTitle($pcc_lang['toplink_shredder']);
		echo "<iframe id=\"blockrandom\" name=\"iframe\" src=\"http://play2.shredderchess.com/online/playshredder/playshredder.php?lang=en\" class=\"wrapper\" align=\"top\" scrolling=\"no\" frameborder=\"0\" height=\"440\" width=\"410\">This option will not work correctly.Unfortunately, your browser does not support Inline Frames</iframe>";
		echo "<a href=\"http://www.shredderchess.com\">Shredder Chess</a>\n";
	break;

case 'allactivegames':
	pcc_SetItemID(pcc_GetItemIdActiveGameMenuID());
	$mainframe->setPageTitle($pcc_lang['active_game_html_title']);
	echo "<h3>Active Games</h3><br>";
	if (empty($userid)) {
		$game_list = pcc_GetAllActiveGames();
		if (! empty($game_list)) {
			echo "<div class=\"activegames\"><h2>" . $pcc_lang['active_game_all'] . "</h2>\n";
			pcc_EchoGameList ($game_list);
			echo "</div>\n";
		} else {
			echo "<div class=\"avviso\">" . $pcc_lang['avviso'] . "</div>";
			echo "<p>" . $pcc_lang['active_game_no_games'] . "</p>";
		}
	} else {
		$game_list = pcc_GetAllGamesAwaitingAPlayer($userid);
		if (! empty($game_list)) {
			echo "<div class=\"activegames\"><h2>" . sprintf($pcc_lang['active_game_specific_challenges'], $myusername) . "</h2>\n";
			pcc_EchoNewGameList ($game_list);
			echo "</div>\n";
		}
		$game_list = pcc_GetMyActiveGamesMyMove();
		if (! empty($game_list)) {
			echo "<div class=\"you\"><h2>" . sprintf($pcc_lang['active_game_awaiting_move'], $myusername) . "</h2>\n";
			pcc_EchoGameList ($game_list);
			echo "</div>\n";
		} else {
			echo "<div class=\"you\">" . sprintf($pcc_lang['active_game_no_awaiting_move'], $myusername) . "</div>";
		}
		$game_list = pcc_GetMyActiveGamesNotMyMove();
		if (! empty($game_list)) {
			echo "<div class=\"you2\"><h2>" . sprintf($pcc_lang['active_game_opponents_move'], $myusername). "</h2>\n";
			pcc_EchoGameList ($game_list);
			echo "</div>\n";
		} else {
			echo "<div class=\"you2\">" . sprintf($pcc_lang['active_game_no_opponents_move'], $myusername) . "</div>";
		}
		$game_list = pcc_GetNotMyActiveGames();
		if (! empty($game_list)) {
			echo "<div class=\"activegames\"><h2>" . $pcc_lang['active_game_other'] . "</h2>\n";
			pcc_EchoGameList ($game_list);
			echo "</div>\n";
		} else {
			echo "<div>" . $pcc_lang['active_game_no_other'] . "</div>";
		}
	}
	break;

case 'participate':
 	$query2 = mysql_query ("UPDATE `chess`.`chess_users` SET app = 1 WHERE `chess_users`.`id` = '$userid'");
 	echo "<h2>Your application for participation in the tournament adopted</h2><br>";
 	echo "<br><a class=\"pcc-button\" href=\"" .JRoute::_("index.php?option=com_pcchess&page=allcompletegames\"")."><span>" . 'Ok, Go back' . "</span></a>";
	break;

case 'exittourn':
 	$myid = $user->get('id');
 	$query3 = mysql_query("UPDATE `chess`.`chess_users` SET app = 0 WHERE `chess_users`.`id` = '$userid'");

    // Отправляем письмо сопернику что его оппонент покинул турнир и что ему засчитана победа в этой игре
 	$query4 = mysql_query("SELECT game_id as 'min_id' FROM chess_chess_game WHERE white_user_id = '$myid' OR black_user_id = '$myid' ORDER BY game_id ASC LIMIT 1");
 	$query5 = mysql_query("SELECT game_id as 'max_id' FROM chess_chess_game WHERE white_user_id = '$myid' OR black_user_id = '$myid' ORDER BY game_id DESC LIMIT 1");
 	$quer4 = mysql_fetch_assoc($query4);
 	$quer5 = mysql_fetch_assoc($query5);
 	$min_id = $quer4['min_id'];
 	$max_id = $quer5['max_id'];
 	for($i = $min_id; $i <= $max_id; $i++)
 		{        $query6 = mysql_query ("SELECT white_user_id FROM chess_chess_game WHERE game_id = '$i'");
        $quer6 = mysql_fetch_assoc($query6);
        $white_user_id = $quer6['white_user_id'];
        $query7 = mysql_query ("SELECT black_user_id FROM chess_chess_game WHERE game_id = '$i'");
        $quer7 = mysql_fetch_assoc($query7);
        $black_user_id = $quer7['black_user_id'];
        $mailfrom = 'wit-89@mail.ru';
		$fromname = 'Chess Tournament Site';
        $subject = 'The events of the tournament';
        $message = 'Your opponent has left the tournament. You scored win in this game.';
        if ($white_user_id == $myid)
          	{           	$query8 = mysql_query ("SELECT email FROM chess_users WHERE id = '$black_user_id'");
            $quer8 = mysql_fetch_assoc($query8);
            $email = $quer8['email'];
            JUtility::sendMail($mailfrom, $fromname, $email, $subject, $message);           	}
        if ($black_user_id == $myid)
           	{
            $query8 = mysql_query ("SELECT email FROM chess_users WHERE id = '$white_user_id'");
            $quer8 = mysql_fetch_assoc($query8);
            $email = $quer8['email'];
            JUtility::sendMail($mailfrom, $fromname, $email, $subject, $message);
           	} 		}

 	$query1 = mysql_query("UPDATE chess_chess_game SET complete = '1' AND result = '0' WHERE black_user_id = '$myid'"); // И заносим поражение в незавершенных играх
 	$query2 = mysql_query("UPDATE chess_chess_game SET complete = '1' AND result = '1' WHERE white_user_id = '$myid'");

 	echo "<h2>Your refusal to participate in the tournament adopted</h2><br>";
 	echo "<br><a class=\"pcc-button\" href=\"" .JRoute::_("index.php?option=com_pcchess&page=allcompletegames\"")."><span>" . 'Ok, Go back' . "</span></a>";
	break;

case 'createnewteam':
	$query3 = mysql_query ("SELECT MAX(id) as 'max_id' FROM chess_teams");
	$quer3 = mysql_fetch_assoc($query3);
	$nextid = $quer3['max_id']+1;
	$myid = $user->get('id');
	//$this->user->get( 'institution' )
	$params = trim($user->get('params'));
	$inst_position = strpos($params, "institution");
	$page_title_position = strpos($params, "page_title");
	//echo $page_title_position; echo "<br>";
	if ($page_title_position == 0)
		{
		$inst = substr($params,$inst_position+12,strlen($params)); // Получаем поле institution
		}
	   	else
	   	{
	   	$inst = substr($params,$inst_position+12,$page_title_position-$inst_position-13);
	   	}
	//echo $inst; echo "<br>";
	$newteam = $_POST["newteam"];
	if ($newteam <> '')
	{
	$querry2 = mysql_query ("SELECT id as 'thistournid' FROM chess_tournaments ORDER BY id DESC LIMIT 1");
    $querr2 = mysql_fetch_assoc($querry2); // Запоминаем id текущего турнира (последний по счету, но не последний по важности=))))
   	$thistournid = $querr2['thistournid'];
    $query4 = mysql_query ("INSERT INTO `chess`.`chess_teams` ( `id` , `id_1` ,  `id_2` ,  `id_3` , `id_4` ,  `id_5` ,  `id_6` ,  `id_7` , `id_8` ,
                            `kol_members` , `name` ,  `institution` ,  `team_count` , `tourn_id`)  VALUES (  '$nextid', '$myid', '0', '0', '0', '0', '0', '0', '0',
                            '1', '$newteam', '$inst', '0','$thistournid');");
	$query9 = mysql_query ("SELECT team as 'team_old' FROM chess_users WHERE id = '$myid'"); // Запоминаем старую команду
	$quer9 = mysql_fetch_assoc($query9);
	$old_team = $quer9['team_old'];
	 for ($i = 1; $i < 8; $i++)//Ищем в старой команде свой id и обнуляем его
		 {
    		$query13 = mysql_query ("SELECT id_$i as 'oldid' FROM chess_teams WHERE id = '$old_team'");
			$quer13 = mysql_fetch_assoc($query13);
			$oldid = $quer13['oldid'];
			if ($oldid == $myid) {$query14 = mysql_query ("UPDATE chess_teams SET id_$i = 0 WHERE id = '$old_team'"); $i = 8;}
		 }
	$query10 = mysql_query ("UPDATE chess_teams SET kol_members = kol_members-1 WHERE id = '$old_team'"); // Уменьшаем количество участников в старой команде
 	$query6 = mysql_query ("UPDATE chess_users SET team = '$nextid' WHERE id = '$myid'");// Устанавливаем пользователю членство в новой команде
 	echo "<h2>The new team was created successfully</h2><br>";
 	echo "<br><a class=\"pcc-button\" href=\"" .JRoute::_("index.php?option=com_pcchess&page=allcompletegames\"")."><span>" . 'Ok, Go back' . "</span></a>";
 	}
 	else
 	{ 	echo "<h2>Please enter a valid name</h2><br>";
 	echo "<br><a class=\"pcc-button\" href=\"" .JRoute::_("index.php?option=com_pcchess&page=allcompletegames\"")."><span>" . 'Ok, Go back' . "</span></a>"; 	}
	break;

case 'selectnewteam':
	$team = $_POST["teams"]; // Запоминаем название выбранной команды
	//echo $team;
	$query4 = mysql_query ("SELECT id as 'team_id' FROM chess_teams WHERE name = '$team'"); // Запоминаем id выбранной команды
	$quer4 = mysql_fetch_assoc($query4);
	$teamid = $quer4['team_id'];
	//echo $teamid;
	$myid = $user->get('id'); // Запоминаем свой id
	// Проверка чтобы из того же института
   	$query15 = mysql_query ("SELECT params as 'params' FROM chess_users WHERE id = '$myid'"); // Запоминаем свой универ
	$quer15 = mysql_fetch_assoc($query15);
	$params = trim($quer15['params']);
	$inst_position = strpos($params, "institution");
	$page_title_position = strpos($params, "page_title");
	if ($page_title_position == 0)
		{
		$inst = substr($params,$inst_position+12,strlen($params)); // Получаем поле institution
		}
	    else
	    {
	    $inst = substr($params,$inst_position+12,$page_title_position-$inst_position-13);
	    }
	//echo "my inst:"; echo $inst; echo "<br>";
	$query16 = mysql_query ("SELECT institution as 'team_inst' FROM chess_teams WHERE id = '$teamid'"); // Запоминаем универ команды
	$quer16 = mysql_fetch_assoc($query16);
	$team_inst = trim($quer16['team_inst']);
    //echo "team inst:"; echo $team_inst; echo "<br>";
 	$query18 = mysql_query ("SELECT id as 'thistournid' FROM chess_tournaments ORDER BY id DESC LIMIT 1");
    $quer18 = mysql_fetch_assoc($query18); // Запоминаем id текущего турнира (последний по счету, но не последний по важности=))))
   	$thistournid = $quer18['thistournid'];
	$query17 = mysql_query ("SELECT member_count as 'member_count' FROM chess_tournaments WHERE id = '$thistournid'");
	$quer17 = mysql_fetch_assoc($query17); // Запоминаем количество участников команды в текущем турнире
	$member_count = $quer17['member_count'];

    if ($inst <> $team_inst)
    	{    	echo "<h2>You can not join the team selected</h2>";
    	echo "<br><a class=\"pcc-button\" href=\"" .JRoute::_("index.php?option=com_pcchess&page=allcompletegames\"")."><span>" . 'Ok, Go back' . "</span></a>";
    	break;
    	}
	$query7 = mysql_query ("SELECT kol_members as 'kol_memb' FROM chess_teams WHERE name = '$team'"); // Запоминаем количество участников выбранной команды
	$quer7 = mysql_fetch_assoc($query7);
	$kol_memb =  $quer7['kol_memb'];
    if ($kol_memb < $member_count)
    	{ // Если участников меньше установленного количества, то можно добавляться (Запоминаем поле, в которое пишем id)
    	for ($i = 1; $i <= $member_count; $i++)
    		{    		$query11 = mysql_query ("SELECT id_$i as 'nextid' FROM chess_teams WHERE id = '$teamid'");
			$quer11 = mysql_fetch_assoc($query11);
			$nextid = $quer11['nextid'];
			if ($nextid == 0) {$myfield = "id_$i"; $i = $member_count;}
			}
		}
    if ($kol_memb >= $member_count)
    	{    	echo "<h2>Too big amount participant. Please choose other command or create new.</h2>";
    	echo "<br><a class=\"pcc-button\" href=\"" .JRoute::_("index.php?option=com_pcchess&page=allcompletegames\"")."><span>" . 'Ok, Go back' . "</span></a>";
    	break;
    	}
    $query9 = mysql_query ("SELECT team as 'team_old' FROM chess_users WHERE id = '$myid'"); // Запоминаем старую команду
	$quer9 = mysql_fetch_assoc($query9);
	$old_team = $quer9['team_old'];
	 for ($i = 1; $i < 8; $i++)//Ищем в старой команде свой id и обнуляем его
		 {
    		$query13 = mysql_query ("SELECT id_$i as 'oldid' FROM chess_teams WHERE id = '$old_team'");
			$quer13 = mysql_fetch_assoc($query13);
			$oldid = $quer13['oldid'];
			if ($oldid == $myid) {$query14 = mysql_query ("UPDATE chess_teams SET id_$i = 0 WHERE id = '$old_team'"); $i = 8;}
		 }
	$query10 = mysql_query ("UPDATE chess_teams SET kol_members = kol_members-1 WHERE id = '$old_team'"); // Уменьшаем количество участников в старой команде
	$query5 = mysql_query ("UPDATE chess_teams SET $myfield = '$myid' WHERE id = '$teamid'"); // Добавляем id пользователя в команду
   	$query6 = mysql_query ("UPDATE chess_users SET team = '$teamid' WHERE id = '$myid'"); // Устанавливаем пользователю выбранную команду
   	$query8 = mysql_query ("UPDATE chess_teams SET kol_members = kol_members+1 WHERE id = '$teamid'"); // Увеличиваем количество участников
   	echo "<h2>You have successfully joined the team selected</h2><br>";
 	echo "<br><a class=\"pcc-button\" href=\"" .JRoute::_("index.php?option=com_pcchess&page=allcompletegames\"")."><span>" . 'Ok, Go back' . "</span></a>";
	break;

case 'notparticipate':
	$myid = $user->get('id'); // Запоминаем свой id
	$query9 = mysql_query ("SELECT team as 'team_old' FROM chess_users WHERE id = '$myid'"); // Запоминаем старую команду
	$quer9 = mysql_fetch_assoc($query9);
	$old_team = $quer9['team_old'];
	 for ($i = 1; $i < 8; $i++)//Ищем в старой команде свой id и обнуляем его
		 {
    	 $query13 = mysql_query ("SELECT id_$i as 'oldid' FROM chess_teams WHERE id = '$old_team'");
		 $quer13 = mysql_fetch_assoc($query13);
		 $oldid = $quer13['oldid'];
		 if ($oldid == $myid) {$query14 = mysql_query ("UPDATE chess_teams SET id_$i = 0 WHERE id = '$old_team'"); $i = 8;}
		 }
	$query10 = mysql_query ("UPDATE chess_teams SET kol_members = kol_members-1 WHERE id = '$old_team'"); // Уменьшаем количество участников в старой команде

    $querrry0 = mysql_query ("SELECT id as 'thistournid' FROM chess_tournaments ORDER BY id DESC LIMIT 1");
	$querrr0 = mysql_fetch_assoc($querrry0); // Запоминаем id текущего турнира
	$thistournid = $querrr0['thistournid'];
    $beginning1 = mysql_query("SELECT begin FROM chess_tournaments WHERE id = '$thistournid'");
    $beginning = mysql_fetch_assoc($beginning1); // Турнир начался?
    $begin = $beginning['begin'];
    if ($begin == 0)
    	{
   		$query6 = mysql_query ("UPDATE chess_users SET team = '0' WHERE id = '$myid'"); // Устанавливаем пользователю не участие в команде
        }
    if ($begin == 1)
    	{
   		$query6 = mysql_query ("UPDATE chess_users SET team_out = '1' WHERE id = '$myid'"); // Устанавливаем пользователю выход из команды
   		}

   	echo "<h2>Now you do not participate in team championship</h2><br>";
 	echo "<br><a class=\"pcc-button\" href=\"" .JRoute::_("index.php?option=com_pcchess&page=allcompletegames\"")."><span>" . 'Ok, Go back' . "</span></a>";
	break;

case 'allcompletegames':
// Your game
	pcc_SetItemID(pcc_GetItemIdCompleteGameMenuID());
	$mainframe->setPageTitle($pcc_lang['complete_game_html_title']);

$myid = $user->get('id'); // Запоминаем свой id
if ($myid <> 0)
 {
	// Далее выводится кнопка участвовать в турнире или отказа от участия в турнире
    echo "<h3>" . $myusername . "</h3><br>";
    echo "<h3>Individual championship:</h3>";

    // Далее показываем таблицу участников текущего турнира
    $query1 = mysql_query("SELECT COUNT('id') as 'kolmemb' FROM chess_users"); // Количество пользователей
    $quer1 = mysql_fetch_assoc($query1);
    $kolmemb = $quer1['kolmemb'];
    ?>
    <h2>Participants of this tournament:</h2>
    <table cellpadding="3" cellspacing="0" border="1" width="100%">
	<tr  style="background: #135cae; color: #fff;">
		<td>
           	Name
		</td>
		<td>
   		    Institution
		</td>
		<td>
           	E-mail
		</td>
		<td>
           	Individual championship
		</td>
		<td>
           	Command championship
		</td>
	</tr>
	<?
    $querry1 = mysql_query("SELECT id FROM chess_users WHERE app = '1' OR team <> '0' ORDER BY id ASC LIMIT 1"); // Выбрать id пользователя, подавшего заявку, с минимальным ID
	$querry2 = mysql_query("SELECT id FROM chess_users WHERE app = '1' OR team <> '0' ORDER BY id DESC LIMIT 1");
	$querr1 = mysql_fetch_assoc($querry1);
 	$querr2 = mysql_fetch_assoc($querry2);
 	$first_id = $querr1['id'];
 	$last_id = $querr2['id'];
	for ($i = $first_id; $i <= $last_id; $i++) // Строим таблицу, выводим участников текущего турнира
    {    $query5 = mysql_query("SELECT app FROM chess_users WHERE id = '$i'"); // Читаем поле заявки
    $quer5 = mysql_fetch_assoc($query5);
    $app = $quer5['app'];
    $query7 = mysql_query("SELECT team FROM chess_users WHERE id = '$i'"); // Читаем поле команды
    $quer7 = mysql_fetch_assoc($query7);
    $team = $quer7['team'];
    $query6 = mysql_query("SELECT id FROM chess_users WHERE id = '$i'"); // Читаем id
    $quer6 = mysql_fetch_assoc($query6);
    $id = $quer6['id'];
    if (($id > 0) AND (($app == 1) OR ($team > 0)))
    {
	?>
	<tr style="background: #f3f3f3;">
		<td>
  		<?
  		//echo $i; echo " ";
  		$query2 = mysql_query("SELECT username FROM chess_users WHERE id = '$i'");
  		$quer2 = mysql_fetch_assoc($query2);
  		$username = $quer2['username'];
        echo $username;
  		?>
		</td>
		<td>
  		<?
  		$query2 = mysql_query("SELECT params FROM chess_users WHERE id = '$i'");
  		$quer2 = mysql_fetch_assoc($query2);
  		$params = trim($quer2['params']);
		$inst_position = strpos($params, "institution");
		$page_title_position = strpos($params, "page_title");
		if ($page_title_position == 0)
			{
			$inst = substr($params,$inst_position+12,strlen($params)); // Получаем поле institution
			}
	    	else
	    	{
	    	$inst = substr($params,$inst_position+12,$page_title_position-$inst_position-13); // Если редактировалось
	    	}
        echo $inst;
  		?>
		</td>
		<td>
  		<?
  		$query2 = mysql_query("SELECT email FROM chess_users WHERE id = '$i'");
  		$quer2 = mysql_fetch_assoc($query2);
  		$email = $quer2['email'];
        echo $email;
  		?>
		</td>
		<td>
		<?
  		$query2 = mysql_query("SELECT app FROM chess_users WHERE id = '$i'");
  		$quer2 = mysql_fetch_assoc($query2);
  		$app = $quer2['app'];
        if ($app == 1)
        	{        	echo "YES";        	}
        	else
        	{        	echo "NO";        	}
  		?>
		</td>
		<td>
  		<?
  		$query2 = mysql_query("SELECT team FROM chess_users WHERE id = '$i'");
  		$quer2 = mysql_fetch_assoc($query2);
  		$team = $quer2['team'];
  		if ($team > 0)
        	{
        	echo "YES";
        	}
        	else
        	{
        	echo "NO";
        	}
  		?>
		</td>
 	</tr>
	<?
	}
	}
	?>
	</table>
    <?

    $query1 = mysql_query("SELECT app FROM chess_users WHERE id = '$userid'");
    $appl = mysql_fetch_assoc($query1);
    $app = $appl['app'];
    $querrry0 = mysql_query ("SELECT id as 'thistournid' FROM chess_tournaments ORDER BY id DESC LIMIT 1");
	$querrr0 = mysql_fetch_assoc($querrry0); // Запоминаем id текущего турнира
	$thistournid = $querrr0['thistournid'];
    $beginning1 = mysql_query("SELECT begin FROM chess_tournaments WHERE id = '$thistournid'");
    $beginning = mysql_fetch_assoc($beginning1);
    $begin = $beginning['begin'];
    if ($app == 0)
    	{
    	echo "<h2>Now you do not participate in the individual championship</h2>";
    	if ($begin == 0)
    		{
 			echo "<a class=\"pcc-button\" href=\"" .JRoute::_("index.php?option=com_pcchess&page=participate\"")."><span>" . 'Participate' . "</span></a>";
 			}
 		}
 		elseif ($app == 1)
 		{
 		echo "<h2>Now you are participating in the individual championship</h2>";
 		echo "<a class=\"pcc-button\" href=\"" .JRoute::_("index.php?option=com_pcchess&page=exittourn\"")."><span>" . 'Not participate' . "</span></a>";
 		}

	echo "<br><br><br>";
	echo "<h3>Command championship:</h3>";
	$myid = $user->get('id'); // Запоминаем свой id
	$query2 = mysql_query("SELECT team as 'team' FROM chess_users WHERE id = '$myid'"); // Дергаем id команды в которой состоим
	$quer2 = mysql_fetch_assoc($query2);
	$team = $quer2['team'];
	$query3 = mysql_query("SELECT name as 'name' FROM chess_teams WHERE id = '$team'"); // Дергаем название команды в которой состоим
	$quer3 = mysql_fetch_assoc($query3);
	$name = $quer3['name'];
	if ($team > 0) {echo "<h2>Now you are participating in the command championship<br><br>Your team is: " . $name; echo "<br></h2>";}
	else { echo "<h2>Now you do not participate in the command tournament<br><br>You can create new team OR join team<br></h2>";}

	// Далее показываем таблицу команд текущего турнира
    $query18 = mysql_query ("SELECT id as 'thistournid' FROM chess_tournaments ORDER BY id DESC LIMIT 1");
    $quer18 = mysql_fetch_assoc($query18); // Запоминаем id текущего турнира (последний по счету, но не последний по важности=))))
   	$thistournid = $quer18['thistournid'];

    $query1 = mysql_query("SELECT COUNT('id') as 'kolteams' FROM chess_teams"); // Количество команд
    $quer1 = mysql_fetch_assoc($query1);
    $kolteams = $quer1['kolteams'];
    ?>
    <h2>Commands of this tournament:</h2>
    <table cellpadding="3" cellspacing="0" border="1" width="100%">
	<tr style="background: #135cae; color: #fff;">
		<td>
           	Name
		</td>
		<td>
   		    Institution
		</td>
		<td>
           	Current number of participants
		</td>
		<td>
			Participants
		</td>
	</tr>
	<?
    $querry1 = mysql_query("SELECT id FROM chess_teams WHERE tourn_id = '$thistournid' ORDER BY id ASC LIMIT 1"); // Выбрать id команды текущего турнира с минимальным ID
	$querry2 = mysql_query("SELECT id FROM chess_teams WHERE tourn_id = '$thistournid' ORDER BY id DESC LIMIT 1");
	$querr1 = mysql_fetch_assoc($querry1);
 	$querr2 = mysql_fetch_assoc($querry2);
 	$first_id = $querr1['id'];
 	$last_id = $querr2['id'];
	for ($i = $first_id; $i <= $last_id; $i++) // Строим таблицу, выводим команды текущего турнира
    {
    $query5 = mysql_query("SELECT tourn_id FROM chess_teams WHERE id = '$i'"); // Читаем поле заявки
    $quer5 = mysql_fetch_assoc($query5);
    $tourn_id = $quer5['tourn_id'];
    if ($tourn_id == $thistournid)
    {
	?>
	<tr style="background: #f3f3f3;">
		<td>
  		<?
  		//echo $i; echo " ";
  		$query2 = mysql_query("SELECT name FROM chess_teams WHERE id = '$i'");
  		$quer2 = mysql_fetch_assoc($query2);
  		$name = $quer2['name'];
        echo $name;
  		?>
		</td>
		<td>
  		<?
  		$query2 = mysql_query("SELECT institution FROM chess_teams WHERE id = '$i'");
  		$quer2 = mysql_fetch_assoc($query2);
  		$institution = $quer2['institution'];
        echo $institution;
  		?>
		</td>
		<td>
  		<?
  		$query2 = mysql_query("SELECT kol_members FROM chess_teams WHERE id = '$i'");
  		$quer2 = mysql_fetch_assoc($query2);
  		$kol_members = $quer2['kol_members'];
        echo $kol_members;
  		?>
		</td>
		<td>
  		<?
  		for ($j = 1; $j <= 8; $j++)
  			{
    		$query2 = mysql_query("SELECT id_$j as 'next' FROM chess_teams WHERE id = '$i'");
  			$quer2 = mysql_fetch_assoc($query2);
  			$next = $quer2['next'];
  			if ($next <> 0)
  				{
                $query3 = mysql_query("SELECT username FROM chess_users WHERE id = '$next'");
                $quer3 = mysql_fetch_assoc($query3);
  				$username = $quer3['username'];
  				echo $username; echo "<br>";
  				}
  			}
  		?>
		</td>
 	</tr>
	<?
	}
	}
	?>
	</table>
	<br>
	<?

	if ($begin == 0) // Если турнир начался - не отображаем операции с командами
		{

	  ?>
	<h2>If you want to create a new team,<br><br>write the team name WITHOUT SPACES!</h2>
    <?

?>

<form action="index.php?option=com_pcchess&page=createnewteam" method="post">
<table cellpadding="5" cellspacing="0" border="0" width="100%">
<tr>
	<td>
		<label for="newteam">
			<?php echo JText::_( 'New team name' ); ?>:
		</label>
	</td>
	<td>
		<input type="text" name="newteam" value="" size="30" />
	</td>
	<td>
		<input type=submit value="Create new team">
	</td>
</tr>
</table>
<br>
</form>

<form action="index.php?option=com_pcchess&page=selectnewteam" method="post">
<table cellpadding="5" cellspacing="0" border="0" width="100%">
<tr>
	<td>
		<label for="teams">
			<?php echo JText::_( 'Select team' ); ?>:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		</label>
	</td>
	<td>
		<select name="teams" size = "1"  style = "width: 230px">
		<?
		$zapros1 = mysql_query ("SELECT COUNT('id') as 'id_count' FROM chess_teams");
  		$kol = mysql_fetch_assoc($zapros1);
    	$max_team = $kol['id_count'];
 		for ($i = 1; $i <= $max_team; $i++)
			{
            $zapros2 = mysql_query ("SELECT name as 'name' FROM chess_teams WHERE id = '$i'");
            $zapr2 = mysql_fetch_assoc($zapros2);
    		$name = $zapr2['name'];
    		$zapros3 = mysql_query("SELECT tourn_id FROM chess_teams WHERE id = '$i'");
    		$zapr3 = mysql_fetch_assoc($zapros3);
    		$tourn_id = $zapr3['tourn_id'];
    		if ($tourn_id == $thistournid)
    			{
   				echo '<option value='.$name.'>'.$name.'</option>'; //Формируем новую строчку
   				}
			}
		?>
 		</select>
 	</td>
 	<td>
    <input type=submit value="     Join team     ">
 	</td>
</tr>
</table>

<br>
</form>

<?php
		}

    if ($team <> 0)
    	{
    	echo "<a class=\"pcc-button\" href=\"" .JRoute::_("index.php?option=com_pcchess&page=notparticipate\"")."><span>" . 'Not participate' . "</span></a><br><br>";
    	}

    echo "<br><br>";

    /*
	if (empty($userid)) {
		$game_list = pcc_GetAllCompleteGames();
		if (! empty($game_list)) {
			echo "<div class=\"activegames\"><h2>" . $pcc_lang['complete_game_all'] . "</h2>\n";
			pcc_EchoGameList ($game_list);
			echo "</div>\n";
		} else {
			echo "<div>" . $pcc_lang['complete_game_no_games'] . "</div>";
		}
	} else {
		$game_list = pcc_GetMyCompleteGames();
		if (! empty($game_list)) {
			echo "<div class=\"activegames\"><h2>" . sprintf($pcc_lang['complete_game_player'], $myusername) . "</h2>\n";
			pcc_EchoGameList ($game_list);
			echo "</div>\n";
		} else {
			echo "<div>" . sprintf($pcc_lang['complete_game_no_player'], $myusername) . "</div>";
		}
		$game_list = pcc_GetNotMyCompleteGames();
		if (! empty($game_list)) {
			echo "<div class=\"activegames\"><h2>" . $pcc_lang['complete_game_other'] . "</h2>\n";
			pcc_EchoGameList ($game_list);
			echo "</div>\n";
		} else {
			echo "<div class=\"space\"></div>";
			echo "<div>" . $pcc_lang['complete_game_no_other'] . "</div>";
		}
	}      */
 }
	break;

case 'redistribute':
 	echo "<h2>You are assured?</h2><br>";
 	echo "<br><a class=\"pcc-button\" href=\"" .JRoute::_("index.php?option=com_pcchess&page=raspr\"")."><span>" . 'Yes' . "</span></a>";
 	echo "<br><br><br><a class=\"pcc-button\" href=\"" .JRoute::_("index.php?option=com_pcchess&page=administration\"")."><span>" . 'No, Go back' . "</span></a>";
	break;

case 'newtournament':
    $mainframe->setPageTitle("Add new tournament");
   	// И потОм сделать чтобы вся инфа бралась из ПОСЛЕДНЕГО турнира
   	echo "<h3>Please enter information about new tournament</h3><br>";

   	$myid = $user->get('id'); // Запоминаем свой id
    $query200 = mysql_query("SELECT usertype FROM chess_users WHERE id = '$myid'"); // Запоминаем свой тип
    $quer200 = mysql_fetch_assoc($query200);
    $usertype = $quer200['usertype'];
	if ($usertype == "Super Administrator")
  		{
?>
<form action="index.php?option=com_pcchess&page=createnewtournament" method="post">
<table cellpadding="5" cellspacing="0" border="0" width="100%">
<tr>
	<td>
		<label for="name">
			<?php echo JText::_( 'Name of the new tournament' ); ?>:
		</label>
	</td>
	<td>
		<input type="text" name="name" size="30" />
	</td>
</tr>
<tr>
	<td>
		<label for="begintourndate">
			<?php echo JText::_( 'BEGIN TOURNAMENT DATE' ); ?>:
		</label>
	</td>
	<td>
		<input type="text" name="begintourndate" value="0000-00-00 00:00:00" size="30" />
	</td>
	<td>
		<label>
		<?php echo JText::_( '(In format: YYYY-MM-DD HH:MM:SS)' ); ?>
		</label>
	</td>
</tr>
<tr>
	<td>
		<label for="partytime">
			<?php echo JText::_( 'Party time (Days)' ); ?>:
		</label>
	</td>
	<td>
		<input type="text" name="partytime" value="30" size="30" />
	</td>
	<td>
		<label>
		<?php echo JText::_( '(30 on default)' ); ?>
		</label>
	</td>
</tr>
<tr>
	<td>
		<label for="steptime">
			<?php echo JText::_( 'Step time (Hours)' ); ?>:
		</label>
	</td>
	<td>
		<input type="text" name="steptime" value="24" size="30" />
	</td>
	<td>
		<label>
		<?php echo JText::_( '(24 on default)' ); ?>
		</label>
	</td>
</tr>
<tr>
	<td>
		<label for="kolobyaztur">
			<?php echo JText::_( 'Number of mandatory tours in individual championship' ); ?>:
		</label>
	</td>
	<td>
		<input type="text" name="kolobyaztur" value="4" size="30" />
	</td>
	<td>
		<label>
		<?php echo JText::_( '(4 on default)' ); ?>
		</label>
	</td>
</tr>
<tr>
	<td>
		<label for="kolobyazteamtur">
			<?php echo JText::_( 'Number of mandatory tours in command championship' ); ?>:
		</label>
	</td>
	<td>
		<input type="text" name="kolobyazteamtur" value="4" size="30" />
	</td>
	<td>
		<label>
		<?php echo JText::_( '(4 on default)' ); ?>
		</label>
	</td>
</tr>
<tr>
	<td>
		<label for="member_count">
			<?php echo JText::_( 'The number of team members in command championship' ); ?>:
		</label>
	</td>
	<td>
		<input type="text" name="member_count" value="4" size="30" />
	</td>
	<td>
		<label>
		<?php echo JText::_( '(Even number, 4 on default - optimally)' ); ?>
		</label>
	</td>
</tr>
<tr>
	<td>
		<br><input type=submit value="Create NEW TOURNAMENT">
	</td>
</tr>
</table>
<br>
</form>
<?
echo "<br><a class=\"pcc-button\" href=\"" .JRoute::_("index.php?option=com_pcchess&page=administration\"")."><span>" . 'Go back' . "</span></a>";
  		}
	break;

case 'createnewtournament':
    $myid = $user->get('id'); // Запоминаем свой id
    $query200 = mysql_query("SELECT usertype FROM chess_users WHERE id = '$myid'"); // Запоминаем свой тип
    $quer200 = mysql_fetch_assoc($query200);
    $usertype = $quer200['usertype'];
if ($usertype == "Super Administrator")
 {
    $name = $_POST["name"]; // Запоминаем название нового турнира
    $begintourndate = $_POST["begintourndate"]; // Запоминаем начало нового турнира
    $partytime = $_POST["partytime"]; // Запоминаем время одной партии
    $steptime = $_POST["steptime"]; // Запоминаем время одного хода
    $kolobyaztur = $_POST["kolobyaztur"]; // Запоминаем количество обязательных туров в личном первенстве
    $kolobyazteamtur = $_POST["kolobyazteamtur"]; // Запоминаем количество обязательных туров в командном первенстве
    $member_count = $_POST["member_count"]; // Запоминаем количество членов команды в командном чемпионате
    $query1 = mysql_query ("INSERT INTO chess_tournaments (`name`,`partytime`,`steptime`,`begintourndate`,`kolobyaztur`,`kolobyazteamtur`,`member_count`)
    						VALUES ('$name','$partytime','$steptime','$begintourndate','$kolobyaztur','$kolobyazteamtur','$member_count');");

    // Далее зануляем всем пользователям добавленные поля
    $query2 = mysql_query("UPDATE chess_users SET tour = '0' , team_tour = '0' , dop = '0' , app = '0' , team = '0' , team_out = '0'");

    echo "<h2>The new tournament has been well created</h2><br>";
 	echo "<br><a class=\"pcc-button\" href=\"" .JRoute::_("index.php?option=com_pcchess&page=administration\"")."><span>" . 'Ok, Go back' . "</span></a>";
 }
    break;

case 'administration':
	$mainframe->setPageTitle("Administration");
    echo "<h3>" . Administration . "</h3><br>";

    $myid = $user->get('id'); // Запоминаем свой id
    $query200 = mysql_query("SELECT usertype FROM chess_users WHERE id = '$myid'"); // Запоминаем свой тип
    $quer200 = mysql_fetch_assoc($query200);
    $usertype = $quer200['usertype'];
if ($usertype == "Super Administrator")
 {

    // Кнопка новый турнир
    echo "<a class=\"pcc-button\" href=\"" .JRoute::_("index.php?option=com_pcchess&page=newtournament\"")."><span>" . 'New tournament' . "</span></a><br><br><br>";

   	// Кнопка распределить (Убрать когда затестим крон)
 	echo "<a class=\"pcc-button\" href=\"" .JRoute::_("index.php?option=com_pcchess&page=redistribute\"")."><span>" . 'Distribute' . "</span></a><br><br><br>";

    // Далее показываем таблицу турниров
    $query1 = mysql_query("SELECT COUNT('id') as 'koltourn' FROM chess_tournaments"); // Количество турниров
    $quer1 = mysql_fetch_assoc($query1);
    $koltourn = $quer1['koltourn'];    ?>
    <h2>All tournaments:</h2>
    <table cellpadding="3" cellspacing="0" border="1" width="100%">
	<tr style="background: #135cae; color: #fff;">
		<td>
           	ID
		</td>
		<td>
           	Name
		</td>
		<td>
           	M
		</td>
		<td>
   		    K
		</td>
		<td>
            Start Date
		</td>
		<td>
            N
		</td>
		<td>
            E
		</td>
		<td>
            L
		</td>
		<td>
            Winner (individual)
		</td>
		<td>
            Winner (command)
		</td>
	</tr>
	<?
	for ($i = 1; $i <= $koltourn; $i++) // Строим таблицу, выводим инфо о турнирах
    {
	?>
	<tr style="background: #f3f3f3;">
		<td>
  		<?
        echo $i;
  		?>
		</td>
		<td>
  		<?
  		$query2 = mysql_query("SELECT name FROM chess_tournaments WHERE id = '$i'");
  		$quer2 = mysql_fetch_assoc($query2);
  		$name = $quer2['name'];
        echo $name;
  		?>
		</td>
		<td>
  		<?
  		$query2 = mysql_query("SELECT partytime FROM chess_tournaments WHERE id = '$i'");
  		$quer2 = mysql_fetch_assoc($query2);
  		$partytime = $quer2['partytime'];
        echo $partytime;
  		?>
		</td>
		<td>
  		<?
  		$query2 = mysql_query("SELECT steptime FROM chess_tournaments WHERE id = '$i'");
  		$quer2 = mysql_fetch_assoc($query2);
  		$steptime = $quer2['steptime'];
        echo $steptime;
  		?>
		</td>
		<td>
  		<?
  		$query2 = mysql_query("SELECT begintourndate FROM chess_tournaments WHERE id = '$i'");
  		$quer2 = mysql_fetch_assoc($query2);
  		$begintourndate = $quer2['begintourndate'];
        echo $begintourndate;
  		?>
		</td>
		<td>
  		<?
  		$query2 = mysql_query("SELECT kolobyaztur FROM chess_tournaments WHERE id = '$i'");
  		$quer2 = mysql_fetch_assoc($query2);
  		$kolobyaztur = $quer2['kolobyaztur'];
        echo $kolobyaztur;
  		?>
		</td>
		<td>
  		<?
  		$query2 = mysql_query("SELECT kolobyazteamtur FROM chess_tournaments WHERE id = '$i'");
  		$quer2 = mysql_fetch_assoc($query2);
  		$kolobyazteamtur = $quer2['kolobyazteamtur'];
        echo $kolobyazteamtur;
  		?>
		</td>
		<td>
  		<?
  		$query2 = mysql_query("SELECT member_count FROM chess_tournaments WHERE id = '$i'");
  		$quer2 = mysql_fetch_assoc($query2);
  		$member_count = $quer2['member_count'];
        echo $member_count;
  		?>
		</td>
		<td>
  		<?
  		$query2 = mysql_query("SELECT winner_id FROM chess_tournaments WHERE id = '$i'");
  		$quer2 = mysql_fetch_assoc($query2);
  		$winner_id = $quer2['winner_id'];
  	  	$query3 = mysql_query("SELECT username FROM chess_users WHERE id = '$winner_id'");
  		$quer3 = mysql_fetch_assoc($query3);
  		$username = $quer3['username'];
        if ($winner_id <> 0)
        	{
        	echo $username;
        	}
        	else
        	{        	echo "Not defined";        	}
  		?>
		</td>
		<td>
  		<?
  		$query2 = mysql_query("SELECT team_winner_id FROM chess_tournaments WHERE id = '$i'");
  		$quer2 = mysql_fetch_assoc($query2);
  		$team_winner_id = $quer2['team_winner_id'];
  	  	$query3 = mysql_query("SELECT name FROM chess_teams WHERE id = '$team_winner_id'");
  		$quer3 = mysql_fetch_assoc($query3);
  		$name = $quer3['name'];
  		if ($team_winner_id <> 0)
        	{
        	echo $name;
        	}
        	else
        	{
        	echo "Not defined";
        	}
  		?>
		</td>
 	</tr>
	<?
	}
	?>
	</table><br>
	M - Round time (days)<br>
	K - Step time (hours)<br>
	N - Number of mandatory tours (individual)<br>
	E - Number of mandatory tours (command)<br>
	L - Number of team members<br>
    <?
    echo "<br><br>";// pcc_FirstFunc();

    // Далее выводятся игры текущего турнира, требующие судейского решения
    echo "<h2>Games that require judicial decisions:</h2>";
    $query103 = mysql_query ("SELECT id as 'thistournid' FROM chess_tournaments ORDER BY id DESC LIMIT 1");
    $quer103 = mysql_fetch_assoc($query103); // Запоминаем id текущего турнира (последний по счету, но не последний по важности=))))
   	$thistournid = $quer103['thistournid'];
    $query100 = mysql_query("SELECT game_id FROM chess_chess_game WHERE result = '6' ORDER BY game_id ASC LIMIT 1"); // Выбрать игру, требующую решения, с минимальным ID
	$query101 = mysql_query("SELECT game_id FROM chess_chess_game WHERE result = '6' ORDER BY game_id DESC LIMIT 1");
	$quer100 = mysql_fetch_assoc($query100);
 	$quer101 = mysql_fetch_assoc($query101);
    $min_id = $quer100['game_id'];
    $max_id = $quer101['game_id'];
    ?>
    <table cellpadding="3" cellspacing="0" border="1" width="100%">
	<tr style="background: #135cae; color: #fff;">
		<td>
		ID
		</td>
		<td>
		Players
		</td>
		<td>
		Championship
		</td>
		<td>
		Tour
		</td>
	</tr>
    	<?
    for ($i = $min_id; $i <= $max_id; $i++)
    	{
    	$query102 = mysql_query("SELECT result FROM chess_chess_game WHERE game_id = '$i' AND tourn_id = '$thistournid'");
    	$quer102 = mysql_fetch_assoc($query102);
    	$result = $quer102['result'];
    	if ($result == 6) // То выводим инфо об этой игре в табличке и три кнопки о принятии решения
    		{      		?>
			<tr style="background: #f3f3f3;">
                <td>
                <?
                echo $i;
                ?>
                </td>
				<td>
				<?
                $query104 = mysql_query("SELECT white_user_id FROM chess_chess_game WHERE game_id = '$i'");
                $quer104 = mysql_fetch_assoc($query104);
    			$white_user_id = $quer104['white_user_id'];
    			$query105 = mysql_query("SELECT username FROM chess_users WHERE id = '$white_user_id'");
                $quer105 = mysql_fetch_assoc($query105);
    			$white_user = $quer105['username'];
    			echo $white_user; echo " (white)<br>";
    			$query106 = mysql_query("SELECT black_user_id FROM chess_chess_game WHERE game_id = '$i'");
                $quer106 = mysql_fetch_assoc($query106);
    			$black_user_id = $quer106['black_user_id'];
    			$query107 = mysql_query("SELECT username FROM chess_users WHERE id = '$black_user_id'");
                $quer107 = mysql_fetch_assoc($query107);
    			$black_user = $quer107['username'];
    			echo $black_user; echo " (black)";
				?>
				</td>
				<td>
				<?
    			$query108 = mysql_query("SELECT type FROM chess_chess_game WHERE game_id = '$i'");
                $quer108 = mysql_fetch_assoc($query108);
    			$type = $quer108['type'];
    			if ($type == 0)
    				{    				echo "Individual";    				}
    				elseif ($type == 1)
    				{    				echo "Command";    				}
    			?>
				</td>
				<td>
				<?
    			$query109 = mysql_query("SELECT tour FROM chess_chess_game WHERE game_id = '$i'");
                $quer109 = mysql_fetch_assoc($query109);
    			$tour = $quer109['tour'];
    			echo $tour;
    			?>
    			</td>
   			</tr>
   			<?
            }
        }
     ?>
     </table><br>

    <form action="index.php?option=com_pcchess&page=solution" method="post">
	<?echo "ID: ";?>
	<select name="nextgame_id" size = "1" style = "width: 200px">
       <?
    for ($i = $min_id; $i <= $max_id; $i++)
    	{
    	$query102 = mysql_query("SELECT result FROM chess_chess_game WHERE game_id = '$i' AND tourn_id = '$thistournid'");
    	$quer102 = mysql_fetch_assoc($query102);
    	$result = $quer102['result'];
    	if ($result == 6)
    		{
			echo '<option value='.$i.'>'.$i.'</option>';
     		}
     	}
 		?>
   	</select>
   	&nbsp;&nbsp;<?echo " Solution: ";?>
 	<select name="solutions" size = "1" style = "width: 200px">
		<option value='0'>White won</option>
		<option value='1'>Black won</option>
		<option value='3'>Draw</option>
 	</select><br><br>
    	<input type=submit value="Make a decision">
			</form>
     		<?
 }
	break;

case 'alltournaments':
    $mainframe->setPageTitle("All Tournaments");
    // Далее показываем таблицу турниров
    $query1 = mysql_query("SELECT COUNT('id') as 'koltourn' FROM chess_tournaments"); // Количество турниров
    $quer1 = mysql_fetch_assoc($query1);
    $koltourn = $quer1['koltourn'];
    ?>
    <h3>All tournaments:</h3><br>
    <table cellpadding="3" cellspacing="0" border="1" width="100%">
	<tr style="background: #135cae; color: #fff;">
		<td>
           	ID
		</td>
		<td>
           	Name
		</td>
		<td>
           	M
		</td>
		<td>
   		    K
		</td>
		<td>
            Start Date
		</td>
		<td>
            N
		</td>
		<td>
            E
		</td>
		<td>
            L
		</td>
		<td>
            Winner (individual)
		</td>
		<td>
            Winner (command)
		</td>
	</tr>
	<?
	for ($i = 1; $i <= $koltourn; $i++) // Строим таблицу, выводим инфо о турнирах
    {
	?>
	<tr style="background: #f3f3f3;">
		<td>
  		<?
        echo $i;
  		?>
		</td>
		<td>
  		<?
  		$query2 = mysql_query("SELECT name FROM chess_tournaments WHERE id = '$i'");
  		$quer2 = mysql_fetch_assoc($query2);
  		$name = $quer2['name'];
        echo $name;
  		?>
		</td>
		<td>
  		<?
  		$query2 = mysql_query("SELECT partytime FROM chess_tournaments WHERE id = '$i'");
  		$quer2 = mysql_fetch_assoc($query2);
  		$partytime = $quer2['partytime'];
        echo $partytime;
  		?>
		</td>
		<td>
  		<?
  		$query2 = mysql_query("SELECT steptime FROM chess_tournaments WHERE id = '$i'");
  		$quer2 = mysql_fetch_assoc($query2);
  		$steptime = $quer2['steptime'];
        echo $steptime;
  		?>
		</td>
		<td>
  		<?
  		$query2 = mysql_query("SELECT begintourndate FROM chess_tournaments WHERE id = '$i'");
  		$quer2 = mysql_fetch_assoc($query2);
  		$begintourndate = $quer2['begintourndate'];
        echo $begintourndate;
  		?>
		</td>
		<td>
  		<?
  		$query2 = mysql_query("SELECT kolobyaztur FROM chess_tournaments WHERE id = '$i'");
  		$quer2 = mysql_fetch_assoc($query2);
  		$kolobyaztur = $quer2['kolobyaztur'];
        echo $kolobyaztur;
  		?>
		</td>
		<td>
  		<?
  		$query2 = mysql_query("SELECT kolobyazteamtur FROM chess_tournaments WHERE id = '$i'");
  		$quer2 = mysql_fetch_assoc($query2);
  		$kolobyazteamtur = $quer2['kolobyazteamtur'];
        echo $kolobyazteamtur;
  		?>
		</td>
		<td>
  		<?
  		$query2 = mysql_query("SELECT member_count FROM chess_tournaments WHERE id = '$i'");
  		$quer2 = mysql_fetch_assoc($query2);
  		$member_count = $quer2['member_count'];
        echo $member_count;
  		?>
		</td>
		<td>
  		<?
  		$query2 = mysql_query("SELECT winner_id FROM chess_tournaments WHERE id = '$i'");
  		$quer2 = mysql_fetch_assoc($query2);
  		$winner_id = $quer2['winner_id'];
  	  	$query3 = mysql_query("SELECT username FROM chess_users WHERE id = '$winner_id'");
  		$quer3 = mysql_fetch_assoc($query3);
  		$username = $quer3['username'];
        if ($winner_id <> 0)
        	{
        	echo $username;
        	}
        	else
        	{
        	echo "Not defined";
        	}
  		?>
		</td>
		<td>
  		<?
  		$query2 = mysql_query("SELECT team_winner_id FROM chess_tournaments WHERE id = '$i'");
  		$quer2 = mysql_fetch_assoc($query2);
  		$team_winner_id = $quer2['team_winner_id'];
  	  	$query3 = mysql_query("SELECT name FROM chess_teams WHERE id = '$team_winner_id'");
  		$quer3 = mysql_fetch_assoc($query3);
  		$name = $quer3['name'];
  		if ($team_winner_id <> 0)
        	{
        	echo $name;
        	}
        	else
        	{
        	echo "Not defined";
        	}
  		?>
		</td>
 	</tr>
	<?
	}
	?>
	</table><br>
	M - Round time (days)<br>
	K - Step time (hours)<br>
	N - Number of mandatory tours (individual)<br>
	E - Number of mandatory tours (command)<br>
	L - Number of team members<br>
    <?
    echo "<br><br>";
	break;

case 'solution':
// Решение о результате игры
    $myid = $user->get('id'); // Запоминаем свой id
    $query200 = mysql_query("SELECT usertype FROM chess_users WHERE id = '$myid'"); // Запоминаем свой тип
    $quer200 = mysql_fetch_assoc($query200);
    $usertype = $quer200['usertype'];
if ($usertype == "Super Administrator")
 {
	$nextgame_id = $_POST["nextgame_id"];
	$solution = $_POST["solutions"];
	//echo $solution;
	if ($solution == 0)
		{
    	$query = mysql_query("UPDATE chess_chess_game SET result = '0' WHERE game_id = '$nextgame_id'"); //White won
    	echo "<h2>Victory was credited with white</h2>";
    	//echo $solution;
    	}
    elseif($solution == 1)
    	{
        $query = mysql_query("UPDATE chess_chess_game SET result = '1' WHERE game_id = '$nextgame_id'"); //Black won
        echo "<h2>Victory was credited with black</h2>";
        //echo $solution;
        }
    elseif($solution == 3)
    	{
        $query = mysql_query("UPDATE chess_chess_game SET result = '3' WHERE game_id = '$nextgame_id'"); //Draw
        echo "<h2>There was nobody counted</h2>";
        //echo $solution;
        }
    echo "<br><a class=\"pcc-button\" href=\"" .JRoute::_("index.php?option=com_pcchess&page=administration\"")."><span>" . 'Ok, Go back' . "</span></a>";
 }
	break;

case 'schedule':
  	$mainframe->setPageTitle("Shedule");

  	$query21 = mysql_query ("SELECT id as 'thistournid' FROM chess_tournaments ORDER BY id DESC LIMIT 1");
    $quer21 = mysql_fetch_assoc($query21); // Запоминаем id текущего турнира (последний по счету, но не последний по важности=))))
   	$thistournid = $quer21['thistournid'];

  	echo "<h3>" . Schedule . "</h3><br>";
    $query1 = mysql_query("SELECT COUNT('id') as 'countid' FROM chess_chess_game WHERE game_id <> '0'"); // Количество созданных игр
    $quer1 = mysql_fetch_assoc($query1);
    $countid = $quer1['countid'];
    if ($countid <> 0)
    	{
		// Вывод расписания
   		$tour_id = pcc_GetMaxTour($thistournid);
		$tour = 1;
		echo "<div class=\"activegames\"><h1>INDIVIDUAL CHAMPIONSHIP.</h1></div>\n";
		pcc_Proverka(); // Перенести на крон

		    // Тут в случае если победитель в личном первенстве определен - сообщается об этом
		    $query17 = mysql_query ("SELECT winner_id as 'winner_id' FROM chess_tournaments WHERE  id = '$thistournid'");
            $win_id = mysql_fetch_assoc($query17);
           	$winner_id = $win_id['winner_id'];
           	if ($winner_id <> 0)
           	{
    		$query16 = mysql_query ("SELECT username as 'winner_name' FROM chess_users WHERE  id = '$winner_id'");
            $win = mysql_fetch_assoc($query16);
           	$winner = $win['winner_name'];
    		echo "<div class=\"activegames\"><h1>Attention! Completed all the games in the individual championship!<br>
    		<br>The WINNER in individual championship is " . $winner . "!<br><br>Congratulations!</h1></div><br>";
		    }

		while ($tour <= $tour_id)
			{
			$game_list = pcc_GetTourGames($tour);
			if (! empty($game_list))
				{
				echo "<div class=\"activegames\"><h1>" . $tour . " tour games:</h1></div>\n";
				pcc_EchoNewGameList ($game_list);
				}
			$tour = $tour + 1;
			}
		echo "<br>";
		echo "<div class=\"activegames\"><h1>COMMAND CHAMPIONSHIP.</h1></div>\n";
		pcc_TeamProverka(); // Перенести на крон

            // Тут в случае если победитель в командном первенстве определен - сообщается об этом
		    $query19 = mysql_query ("SELECT team_winner_id as 'winner_id' FROM chess_tournaments WHERE id = '$thistournid'");
            $win_idd = mysql_fetch_assoc($query19); // Запрашиваем id победителя
           	$winner_idd = $win_idd['winner_id'];
           	if ($winner_idd <> 0)
           	{
    		$query18 = mysql_query ("SELECT name as 'winner_name' FROM chess_teams WHERE id = '$winner_idd'");
            $winn = mysql_fetch_assoc($query18);
           	$winnerr = $winn['winner_name'];
    		echo "<div class=\"activegames\"><h1>Attention! Completed all the games in the team championship!<br>
    		<br>The WINNER in team championship is " . $winnerr . "!<br><br>Congratulations!</h1></div>";
		    }

        $team_tour_id = pcc_GetMaxTourTeam($thistournid);
        $team_tour = 1;
   		while ($team_tour <= $team_tour_id)
			{
			$game_list = pcc_GetTourGamesTeam($team_tour);
			if (! empty($game_list))
				{
				echo "<div class=\"activegames\"><h1>" . $team_tour . " tour games:</h1></div>\n";
				pcc_EchoNewGameList ($game_list);
				}
			$team_tour = $team_tour + 1;
			}
		}
	break;

case 'raspr':

      $myid = $user->get('id'); // Запоминаем свой id
    $query200 = mysql_query("SELECT usertype FROM chess_users WHERE id = '$myid'"); // Запоминаем свой тип
    $quer200 = mysql_fetch_assoc($query200);
    $usertype = $quer200['usertype'];
if ($usertype == "Super Administrator")
  {
	$mainframe->setPageTitle("Distribute");
    pcc_NewRaspr();
    pcc_TeamRaspr();
    $querry0 = mysql_query ("SELECT id as 'thistournid' FROM chess_tournaments ORDER BY id DESC LIMIT 1");
	$querr0 = mysql_fetch_assoc($querry0); // Запоминаем id текущего турнира
	$thistournid = $querr0['thistournid'];
    $querry21 = mysql_query("UPDATE chess_tournaments SET begin = '1' WHERE id = '$thistournid'"); // Устанавливаем метку что турнир начался - распределение произошло.

    echo "<br><a class=\"pcc-button\" href=\"" .JRoute::_("index.php?option=com_pcchess&page=administration\"")."><span>" . 'Ok, Go back' . "</span></a>";
  }
	break;

case 'completegames':
    $mainframe->setPageTitle("All Complete Games");
    echo "<h3>All Complete Games</h3><br>";
    $game_list = pcc_GetAllCompleteGames();
		if (! empty($game_list)) {
			echo "<div class=\"activegames\"><h2>" . $pcc_lang['complete_game_all'] . "</h2>\n";
			pcc_EchoGameList ($game_list);
			echo "</div>\n";
		} else {
			echo "<div>" . $pcc_lang['complete_game_no_games'] . "</div>";
		}
    break;

case 'showgame':
	if ($request['move']) {
		$move = $request['move'];
		#if ($request['color']) {
			$color = $request['color'];
		#} else {
		#	$color = "1";
		#}
	} else {
		$move = "100000";
		$color = "1";
	}
	#echo "DBG: showgame Game_id ". $post['game_id']." Move $move, color $color<br>";
	pcc_EchoGame($post['game_id'], $move, $color);
	break;

case 'submitmove':
	pcc_SetItemID(pcc_GetItemIdActiveGameMenuID());
	if (empty($post['game_id'])) {
		echo "<p>" . $pcc_lang['submit_move_corrupt'] . "</p>";
	} elseif (empty($post['pcc_Move'])) {
		pcc_EchoGame($post['game_id'], 1000, 1, $pcc_lang['submit_move_empty']);
	} elseif (strtoupper($post['pcc_Move']) == "RESIGN") {
		if (!($post['pcc_Move'] == "RESIGN")) {
			pcc_EchoGame($post['game_id'], 1000, 1, $pcc_lang['submit_move_resign_caps_warn'],
			 $pcc_move=$post['pcc_Move'], (($post['pcc_notify']=="1") ? 1 : 0), $post['pcc_comment']);
		} else {
			pcc_ResignGame($post['game_id'], $post['pcc_comment']);
		}
	} elseif (strtoupper($post['pcc_Move']) == "DRAW") {
		if (!($post['pcc_Move'] == "DRAW")) {
			pcc_EchoGame($post['game_id'], 1000, 1, $pcc_lang['submit_move_resign_caps_warn'],
			 $pcc_move=$post['pcc_Move'], (($post['pcc_notify']=="1") ? 1 : 0), $post['pcc_comment']);
		} else {
			pcc_DrawGame($post['game_id'], $post['pcc_comment']);
		}
	} else {
		pcc_ProcessMove($post['game_id'], $post['pcc_Move'], (($post['pcc_notify']=="1") ? 1 : 0), $post['pcc_comment']);
	}
	break;

case 'acceptdraw':
	pcc_SetItemID(pcc_GetItemIdActiveGameMenuID());
	pcc_ProcessAcceptDraw($post['game_id'], $post['accept']=="1");
	break;

case 'newgame':

$myid = $user->get('id'); // Запоминаем свой id
$query200 = mysql_query("SELECT usertype FROM chess_users WHERE id = '$myid'"); // Запоминаем свой тип
$quer200 = mysql_fetch_assoc($query200);
$usertype = $quer200['usertype'];
if ($usertype == "Super Administrator")
  {
	pcc_SetItemID(pcc_GetItemIdNewGameMenuID());
	$mainframe->setPageTitle($pcc_lang['new_game_html_title']);
	if (! empty($userid)) {
		$game_list = pcc_GetAllGamesAwaitingAPlayer($userid);
		if (! empty($game_list)) {
			echo "<div>" . $pcc_lang['new_game_specific'] . "</div>\n";
			pcc_EchoNewGameList ($game_list);
		} else {
			echo "<div class=\"you\">" . $pcc_lang['new_game_no_specific'] . "</div>";
		}
		$game_list = pcc_GetAllGamesIssuedByAPlayer($userid);
		if (! empty($game_list)) {
			echo "<div class=\"you2\"><h2>" . $pcc_lang['new_game_pending'] . "</h2>\n";
			pcc_EchoNewGameList ($game_list);
			echo "</div>\n";
		} else {
			echo "<div class=\"you\">" . $pcc_lang['new_game_no_pending'] . "</div>";
		}
		$game_list = pcc_GetAllGamesAwaitingAnyButOnePlayer($userid);
		if (! empty($game_list)) {
			echo "<div class=\"activegames\"><h2>" . $pcc_lang['new_game_open'] .  "</h2>\n";
			pcc_EchoNewGameList ($game_list);
			echo "</div>\n";
		} else {
			echo "<div class=\"activegames\">" . $pcc_lang['new_game_no_open'] . "</div>";

		}
		echo "<div class=\"activegames\">" . pcc_EchoNewGameForm() . "</div>\n";
	} else {
		$game_list = pcc_GetAllGamesAwaitingAnyPlayer($userid);
		if (! empty($game_list)) {
			pcc_EchoNewGameList ($game_list);
			echo "<div class=\"avviso\">" . $pcc_lang['avviso'] . "</div>";
			echo "<div>" . $pcc_lang['new_game_open_not_logged_in'] . "</div>\n";

		} else {

			echo "<div class=\"avviso\">" . $pcc_lang['avviso'] . "</div>";
			echo "<p>" . $pcc_lang['new_game_no_open'] . "<br/>";
			echo $pcc_lang['login_register'] . "</p>";

		}
	}
  }
	break;

case 'acceptchallenge':
	pcc_SetItemID(pcc_GetItemIdNewGameMenuID());
	pcc_ProcessAcceptGame($post['game_id'], $post['user_id'], $post['notify']);
	break;

case 'newchallenge':
	pcc_SetItemID(pcc_GetItemIdNewGameMenuID());
	pcc_ProcessNewGame($post['user_id'], $post['color'], $post['notify'], $post['comment'], $post['challenger_id']);
	break;

case 'declinechallenge':
	pcc_SetItemID(pcc_GetItemIdNewGameMenuID());
	pcc_ProcessDeclineGame($request['game_id']);
	break;

case 'revokechallenge':
	pcc_SetItemID(pcc_GetItemIdNewGameMenuID());
	pcc_RevokeChallenge($request['game_id']);
	break;

case 'forkgame':
	pcc_SetItemID(pcc_GetItemIdNewGameMenuID());
	if (!(($request['forkgame'] >= 1) && ($request['forkgame'] <= 4))) {
			pcc_EchoGame($request['game_id'], $request['move'], $request['color'], $pcc_lang['fork_game_no_player_selected']);
	} else {
		pcc_ProcessForkGame($post['game_id'], $request['move'], $request['color'], $request['forkgame'], $post['user_id']);
	}
	break;

case 'players':
	pcc_SetItemID(pcc_GetItemIdPlayersMenuID());
	echo "<h3>Statistics</h3>";
	if (empty($request['user_id'])) {
		$breakout = ($request['breakout'] == "1" ? 1 : 0);
		$mainframe->setPageTitle($pcc_lang['players_html_title']);
		//pcc_EchoPlayerList(pcc_GetAllPlayers(), $breakout);
		echo "<h2>In the individual championship:</h2>\n";
		pcc_EchoPlayerList(pcc_GetIndividualPlayers(), $breakout);
		echo "<h2>In the command championship:</h2>\n";
		pcc_EchoPlayerList(pcc_GetCommandPlayers(), $breakout);
	} else {
		$playeruserid = $request['user_id'];
		$playerusername = pcc_GetUserName($playeruserid);
		$mainframe->setPageTitle(sprintf($pcc_lang['player_html_title'], $playerusername));
		if (empty($playerusername)) {
			echo "<div>" . sprintf($pcc_lang['players_not_found'], $playeruserid) . "</div>\n";
		} else {
			$mainframe->appendPathWay($playerusername);
			$game_list = pcc_GetActiveGamesPlayersMove($playeruserid);
			if (! empty($game_list)) {
				echo "<div class=\"activegames\"><h2>" . sprintf($pcc_lang['active_game_awaiting_move'], $playerusername) . "</h2>\n";
				pcc_EchoGameList ($game_list);
				echo "</div>\n";
			} else {
				echo "<div class=\"activegames\">" . sprintf($pcc_lang['active_game_no_awaiting_move'], $playerusername) . "</div>";
			}
			$game_list = pcc_GetActiveGamesNotPlayersMove($playeruserid);
			if (! empty($game_list)) {
				echo "<div class=\"activegames\"><h2>" . sprintf($pcc_lang['active_game_opponents_move'], $playerusername) . "</h2>\n";
				pcc_EchoGameList ($game_list);
				echo "</div>\n";
			} else {
				echo "<div class=\"activegames\">" . sprintf($pcc_lang['active_game_no_opponents_move'], $playerusername) . "</div>";
			}
			$game_list = pcc_GetCompleteGamesOnePlayer($playeruserid);
			if (! empty($game_list)) {
				echo "<div class=\"activegames\"><h2>" . sprintf($pcc_lang['complete_game_player'], $playerusername) . "</h2>\n";
				pcc_EchoGameList ($game_list);
				echo "</div>\n";
			} else {
				echo "<div class=\"activegames\">" . sprintf($pcc_lang['complete_game_no_player'], $playerusername) . "</div>";
			}
		}
	}
	break;

case 'showallgames':
	$mainframe->setPageTitle($pcc_lang['all_games_html_title']);
	$mainframe->appendPathWay($pcc_lang['all_games_pathway']);
	pcc_SetItemID(pcc_GetItemIdMainMenuID());
	echo "<div>" . $pcc_lang['all_games_header'] . "</div>\n";
	pcc_EchoGameList(pcc_GetAllGames());
	break;

case 'exportgame':
	ExportGame();
	break;

default:
	pcc_SetItemID(pcc_GetItemIdMainMenuID());
	echo "<p>" . $pcc_lang['unknown_request'] . "</p>";
    break;

}
?>
</div>