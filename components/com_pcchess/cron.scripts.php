<?php
// PCChess Component//
// ��������� ��� � ������!

//define( '_JEXEC', 1 );
defined( '_JEXEC' ) or die( 'Restricted access' ); // ������ �� ������� ������ �����
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

// ����������� ���� ������ �������� ������� � ���� ����� ������� (� ����� ����), �� ������ ������������� (�������� ������)
$querry0 = mysql_query ("SELECT id as 'thistournid' FROM chess_tournaments ORDER BY id DESC LIMIT 1");
$querr0 = mysql_fetch_assoc($querry0); // ���������� id �������� �������
$thistournid = $querr0['thistournid'];
$querry1 = mysql_query("SELECT begintourndate FROM chess_tournaments WHERE id = '$thistournid'");
$querr1 = mysql_fetch_assoc($querry1);
$begin = date('YmdHis', strtotime($querr1['begintourndate'])); // ���� � ����� ������ �������� �������
$querry2 = mysql_query("SELECT NOW() as now"); // ���� � ����� ������
$querr2 = mysql_fetch_assoc($querry2);
$seychas = date('YmdHis', strtotime($querr2['now'])); // ������ � �������� �������
$raznost = $begin - $seychas;
$querry3 = mysql_query("SELECT COUNT('game_id') as 'count_games' FROM chess_chess_game WHERE tourn_id = '$thistournid'");
$querr3 = mysql_fetch_assoc($querry3); // ���� �� � ���� ������� ��������� ����? ���� ���� �� �� ������������ ������.
$count_games = $querr3['count_games'];
//echo $count_games; echo "<br>";
//echo $potom; echo "<br>";
//echo $seychas; echo "<br>";
//echo $raznost; echo "<br>";
if (($raznost < 0) AND ($count_games = 0)) // ������ ������������� � ����������� ���� ������� (���� ��� ��� ������ ���������!)
  	{
   	pcc_NewRaspr();
    pcc_TeamRaspr();
    $querry21 = mysql_query("UPDATE chess_tournaments SET begin = '1' WHERE id = '$thistournid'"); // ������������� ����� ��� ������ ������� - ������������� ���������.
    // ��� �������� ���� ������� ��������� ��� ������ �������.
    //JUtility::sendMail($mailfrom, $fromname, $email, $subject, $message);
	//JUtility::sendMail('email-�����������', '��������� �� ����', 'email ����������', '���� ������', '����� ������', false);
	$subject = 'Started the tournament';
	$message = 'Attention! Dear members, started a chess tournament. Produced by the distribution of first round games.';
    $querry22 = mysql_query ("SELECT id as 'min_id' FROM chess_users WHERE team <> '0' OR app <> '0' ORDER BY id ASC LIMIT 1"); // ������� ������ �������� ������� � ����������� ID
	$querry23 = mysql_query ("SELECT id as 'max_id' FROM chess_users WHERE team <> '0' OR app <> '0' ORDER BY id DESC LIMIT 1");// ������� ������ �������� ������� � ������������ ID
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

// ������ �������� �� ���������� ���� ������ ����
$querry4 = mysql_query ("SELECT winner_id FROM chess_tournaments ORDER BY id DESC LIMIT 1");
$querr4 = mysql_fetch_assoc($querry4); // ���������� id ���������� �������� �������
$winner_id = $querr4['winner_id'];
$querry5 = mysql_query ("SELECT team_winner_id FROM chess_tournaments ORDER BY id DESC LIMIT 1");
$querr5 = mysql_fetch_assoc($querry5); // ���������� id �������-���������� �������� �������
$team_winner_id = $querr5['team_winner_id'];
if (($raznost < 0) AND ($winner_id == 0)) // ���� ������ ������� � ���������� �� ���������
	{
	pcc_Proverka(); // ��������� �������� ���������� � ������ ���������� � ���� �� ��������� - ������������ ��������� ���
	}
if (($raznost < 0) AND ($team_winner_id == 0)) // ���� ������ ������� � �������-���������� �� ����������
	{
	pcc_TeamProverka(); // ��������� �������� ���������� � ��������� ���������� � ���� �� ��������� - ������������ ��������� ���
	}

// ����� ��� ������ ���� ����
$querry6 = mysql_query ("SELECT steptime FROM chess_tournaments ORDER BY id DESC LIMIT 1");
$querr6 = mysql_fetch_assoc($querry6); // ���������� ������������ ����� ���� �������� ������� (24 hours)
$steptime = $querr6['steptime'];
$querry7 = mysql_query ("SELECT partytime FROM chess_tournaments ORDER BY id DESC LIMIT 1");
$querr7 = mysql_fetch_assoc($querry7); // ���������� ������������ ����� ������ �������� ������� (30 days)
$partytime = $querr6['partytime'];
$querry8 = mysql_query ("SELECT game_id as 'min_id' FROM chess_chess_game WHERE tourn_id = '$thistournid' ORDER BY game_id ASC LIMIT 1"); // ������� ���� �������� ������� � ����������� ID
$querry9 = mysql_query ("SELECT game_id as 'max_id' FROM chess_chess_game WHERE tourn_id = '$thistournid' ORDER BY game_id DESC LIMIT 1");
$querr8 = mysql_fetch_assoc($querry8);
$querr9 = mysql_fetch_assoc($querry9);
$min_id = $querr8['min_id'];
$max_id = $querr9['max_id'];
for ($i = $min_id; $i <= $max_id; $i++) // $i - id ��������� ����
	{	$subject = 'The events of the tournament';

	// ������������ ������������ ����� ����
    $querry10 = mysql_query("SELECT move_no FROM chess_chess_move WHERE game_id = '$i' ORDER BY move_no DESC LIMIT 1");// ���������� ����� ���������� ���� � ������� ����
    $querry17 = mysql_query("SELECT delay FROM chess_chess_move WHERE game_id = '$i' ORDER BY move_no DESC LIMIT 1");
    $query17 = mysql_fetch_assoc($querry17); // ���������� ���������� �������� �� ��������� ����
    $delay = $query17['delay'];
    if (mysql_num_rows($querry10) == 0) // ���� ����� �� ���� � ���� ���� - ��������� ����� ������ ����
    	{
     	$querry18 = mysql_query("SELECT black_delay FROM chess_chess_game WHERE game_id = '$i'"); // ���������� �������� ������� ������
    	$query18 = mysql_fetch_assoc($querry18);
    	$black_delay = $query18['black_delay'];
    	if ($black_delay == 0) // ���� � ������� �� ���� ��������, �� � ��� �� ���� � ���� ����
    		{        	$querry14 = mysql_query ("SELECT start + INTERVAL '$steptime' HOUR as 'end' FROM chess_chess_game WHERE game_id = '$i'");
        	}
        	elseif ($black_delay == 1) // ���� � ������� ���� ��������, �� ��� �� ������� ����
        	{        	$querry14 = mysql_query ("SELECT start + INTERVAL '$steptime' + '$steptime' HOUR as 'end' FROM chess_chess_game WHERE game_id = '$i'");        	}
        $querr14 = mysql_fetch_assoc($querry14);
        $end = date('YmdHis', strtotime($querr14['end'])); // ������� ���� � ����� ��������� ����
        $color = 1; // ������� ����� �����    	}
    	else // ���� ���� ���� - ��������� ����� ���������� ����
    	{
    	if ($delay == 0) // ���� �� ��������� ���� �� ���� ��������, �� ����������� ���� ��������
    		{
     		$querry15 = mysql_query("SELECT entered + INTERVAL '$steptime' HOUR as 'end' FROM chess_chess_move WHERE game_id = '$i' ORDER BY move_no DESC LIMIT 1");
     		}
     		elseif ($delay == 1) // ���� �������� ���� �� ��������� ����, �� ��� ��������� �������
     		{     		$querry15 = mysql_query("SELECT entered + INTERVAL '$steptime' + '$steptime' HOUR as 'end' FROM chess_chess_move WHERE game_id = '$i' ORDER BY move_no DESC LIMIT 1");     		}
        $querr15 = mysql_fetch_assoc($querry15);
        $end = date('YmdHis', strtotime($querr15['end'])); // ������� ���� � ����� ��������� ����
        $querry13 = mysql_query("SELECT color FROM chess_chess_move WHERE game_id = '$i' ORDER BY move_no DESC LIMIT 1");
    	$query13 = mysql_fetch_assoc($querry13); // ���������� ���� ���������� ���������� ������ � ������� ����
    	$color = $query13['color'];    	}
    $raznost1 = $end - $seychas;
    if ($raznost1 < 0) // ���� ����� �����
    	{ // ����� ����������� ��������, ���� ��� �� ������ - ������������ ��������, ���� ��� ���� ���� - ������������� ���������, � �� ��� � �������������
        if ($color == 1) // ������ ��������� �����
        	{         	$querry11 = mysql_query("SELECT white_delay FROM chess_chess_game WHERE game_id = '$i'"); // ���������� �������� ������ ������
    		$query11 = mysql_fetch_assoc($querry11);
    		$white_delay = $query11['white_delay'];
            if ($white_delay == 0) // ���� �������� ��� �� ���� - ����������� ������ �������� ������ (����� ������ ��� ��� ����� ����� ���������� ��� ����)
            	{            	$querrry16 = mysql_query("SELECT complete FROM chess_chess_game WHERE game_id = '$i'");
            	$querr16 = mysql_fetch_assoc($querrry16);
            	$complete = $querr16['complete'];
            	$querrry17 = mysql_query("SELECT game_id FROM chess_chess_game WHERE game_id = '$i'");
            	$querr17 = mysql_fetch_assoc($querrry17);
            	$game_id = $querr17['game_id'];
            	if (($complete == 0) AND ($game_id <> 0))
            		{                	$querry16 = mysql_query("UPDATE chess_chess_game SET white_delay = '1' WHERE game_id = '$i'"); // ������ � ������������� �����
                	$querry18 = mysql_query("UPDATE chess_chess_move SET delay = '1' WHERE game_id = '$i' ORDER BY move_no DESC LIMIT 1"); // �������� ��� ���������
                	// ����� ���������� ������ ������ - ��� ��� ��������� ������ �������� � ��� ��������� �������� ����� �������� � ������� - ��� ��� ��������� �� �������
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
            	elseif ($white_delay == 1) // ���� �������� ��� ���� - ����������� ��������� ������
            	{
              	$querrry16 = mysql_query("SELECT complete FROM chess_chess_game WHERE game_id = '$i'");
            	$querr16 = mysql_fetch_assoc($querrry16);
            	$complete = $querr16['complete'];
            	$querrry17 = mysql_query("SELECT game_id FROM chess_chess_game WHERE game_id = '$i'");
            	$querr17 = mysql_fetch_assoc($querrry17);
            	$game_id = $querr17['game_id'];
            	if (($complete == 0) AND ($game_id <> 0))
            		{            		$querry16 = mysql_query("UPDATE chess_chess_game SET complete = '1' AND result = '0' WHERE game_id = '$i'"); // ������ � ������������� �����
             		// result = '0' - ����� ������� �������
                	// ����� ���������� ������ ������� - ��� �� �������, � ������ - ��� �� ��� ��������� ��������� ���� ��������� �������� ������� ����
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
        	elseif ($color == 0) // ����� ��������� �����
        	{         	$querry12 = mysql_query("SELECT black_delay FROM chess_chess_game WHERE game_id = '$i'"); // ���������� �������� ������� ������
    		$query12 = mysql_fetch_assoc($querry12);
    		$black_delay = $query12['black_delay'];
     		if ($black_delay == 0) // ���� �������� ��� �� ���� - ����������� ������ �������� �������
            	{
              	$querrry16 = mysql_query("SELECT complete FROM chess_chess_game WHERE game_id = '$i'");
            	$querr16 = mysql_fetch_assoc($querrry16);
            	$complete = $querr16['complete'];
            	$querrry17 = mysql_query("SELECT game_id FROM chess_chess_game WHERE game_id = '$i'");
            	$querr17 = mysql_fetch_assoc($querrry17);
            	$game_id = $querr17['game_id'];
            	if (($complete == 0) AND ($game_id <> 0))
            		{              		$querry16 = mysql_query("UPDATE chess_chess_game SET black_delay = '1' WHERE game_id = '$i'"); // ������ � ������������� �����
                	$querry18 = mysql_query("UPDATE chess_chess_move SET delay = '1' WHERE game_id = '$i' ORDER BY move_no DESC LIMIT 1"); // �������� ��� ���������
                	// ����� ���������� ������ ������� - ��� ��� ��������� ������ �������� � ��� ��������� �������� ����� �������� � ������ - ��� ��� ��������� �� �������
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
            	elseif ($black_delay == 1) // ���� �������� ��� ���� - ����������� ��������� �������
            	{
              	$querrry16 = mysql_query("SELECT complete FROM chess_chess_game WHERE game_id = '$i'");
            	$querr16 = mysql_fetch_assoc($querrry16);
            	$complete = $querr16['complete'];
            	$querrry17 = mysql_query("SELECT game_id FROM chess_chess_game WHERE game_id = '$i'");
            	$querr17 = mysql_fetch_assoc($querrry17);
            	$game_id = $querr17['game_id'];
            	if (($complete == 0) AND ($game_id <> 0))
            		{            		$querry16 = mysql_query("UPDATE chess_chess_game SET complete = '1' AND result = '1' WHERE game_id = '$i'"); // ������ � ������������� �����
             		// result = '1' - ������ ������� ������
                	// ����� ���������� ������ ������ - ��� �� �������, � ������� - ��� �� ��� ��������� ��������� ���� ��������� �������� ������� ����
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

	// ������������ ������������ ����� ����� ������
	// ���� ����� ������ ����� - ���������� result = '6' - ����������� ���������, � � ������� ����������������� �������� ����� ���� � ������ ������ ���������
    $querry19 = mysql_query ("SELECT start + INTERVAL '$partytime' DAY as 'end' FROM chess_chess_game WHERE game_id = '$i'");
    $querr19 = mysql_fetch_assoc($querry19);
    $part_end = date('YmdHis', strtotime($querr19['end'])); // ������� ���� � ����� ��������� ������
    $raznost2 = $part_end - $seychas;
    if ($raznost2 < 0) // ���� ����� �����
   		{   		$querrry16 = mysql_query("SELECT complete FROM chess_chess_game WHERE game_id = '$i'");
     	$querr16 = mysql_fetch_assoc($querrry16);
        $complete = $querr16['complete'];
        $querrry17 = mysql_query("SELECT game_id FROM chess_chess_game WHERE game_id = '$i'");
        $querr17 = mysql_fetch_assoc($querrry17);
        $game_id = $querr17['game_id'];
        if (($complete == 0) AND ($game_id <> 0))
        	{        	$querry20 = mysql_query("UPDATE chess_chess_game SET complete = '1' AND result = '6' WHERE game_id = '$i'");
        	// ����� �������� ������ ������ - ��� ��������� ���� ��������� ���������� �������, � ������� - ��� �� ���� �������� � ����� ����� �����
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
        	$querry34 = mysql_query("SELECT email FROM chess_users WHERE usertype = 'Super Administrator' ORDER BY id DESC LIMIT 1"); // ���� ������������������������ ������
        	$querr34 = mysql_fetch_assoc($querry34);
        	$email = $querr34['email'];
        	JUtility::sendMail($mailfrom, $fromname, $email, $subject, $message);
        	}    	}
    // ����� ����� ��� ������ ����.
	}

}

//  echo date('Y-m-d H:i:s',  strtotime($quer['now']));

//pcc_FirstFunc();

?>