<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

#echo "<b>pcchess router.php called</b><br>";
function PcchessBuildRoute(&$query)
{
  #echo "<b> PcchessBuildRoute called</b>";
  $segments = array();
  
  if (isset($query['Itemid'])) {
    $segments[] = $query['Itemid'];
    unset($query['Itemid']);
  }
  
  if(isset($query['page'])) {
    $segments[] = $query['page'];
    unset($query['page']);
  }
  
  if(isset($query['user_id'])) {
    $segments[] = $query['user_id'];
    unset($query['user_id']);
  }

  if(isset($query['game_id'])) {
    $segments[] = $query['game_id'];
    unset($query['game_id']);
  }

  if(isset($query['move'])) {
    $segments[] = $query['move'];
    unset($query['move']);
  }

  if(isset($query['color'])) {
    $segments[] = $query['color'];
    unset($query['color']);
  }

return $segments;
}

function PcchessParseRoute($segments)
{
  #echo "<b> PcchessParseRoute called</b>";
  $vars = array();
  $vars['Itemid'] = $segments[0];
  $vars['page'] = $segments[1];
  if ( $segments[1] == 'showgame' ) {
      $vars['game_id'] = $segments[2];
      $vars['move'] = $segments[3];
      $vars['color'] = $segments[4];
  } else {
      $vars['user_id'] = $segments[2];
  }     
  #echo "Itemid=".$vars['Itemid'];
  #echo "page=".$vars['page'];
  #echo "user_id=".$vars['user_id'];
  #echo "game_id=".$vars['game_id'];
  #echo "move=".$vars['move'];
  #echo "color=".$vars['color'];
  return $vars;
}

?>