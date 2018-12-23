<?php

  # restrict access
  defined('_JEXEC') or die('Restricted access');


echo "Date begin following tournament is <br>";
$query = mysql_query("SELECT begintourndate FROM chess_tournaments ORDER BY id DESC LIMIT 1");
$quer = mysql_fetch_assoc($query);
echo date('Y-m-d H:i:s',  strtotime($quer['begintourndate']));

$begin = date('YmdHis', strtotime($quer['begintourndate'])); // Дата и время начала текущего турнира
$query2 = mysql_query("SELECT NOW() as now"); // Дата и время сейчас
$quer2 = mysql_fetch_assoc($query2);
$seychas = date('YmdHis', strtotime($quer2['now'])); // Сейчас в числовом формате
$raznost = $begin - $seychas;
       echo "<br>";
if ($raznost < 0) // Турнир начался
	{
	echo " (The tournament started)";
	}
  /*  else
    {
    $querry14 = mysql_query ("SELECT start - INTERVAL '$steptime' HOUR as 'end' FROM chess_chess_game WHERE game_id = '$i'");
    echo "Time left ";
    echo $days;
    echo " days.";
    }  */

?>
