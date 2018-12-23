<?php
//pc_chess Component//
/**
* Content code
* @package PCChess
* @Copyright (C) 2005 Robert Prince
* @ All rights reserved
* @ PCChess is Free Software
* @ Released under GNU/GPL License : http://www.gnu.org/copyleft/gpl.html
* @ Version 1.0
**/
// no direct access
defined('_JEXEC') or die('Restricted access');

function com_install() {
  echo "<img src=".JPATH_SITE.DS."/components/com_pcchess/images/pcchess1.png> Thank you for using the PCChess Game.";
  echo "<br>Please check the <a href=\"http://www.pcchess.net\">PCChess website</a> for more information or check on the <a href=\"http://pcchess.eilers.net\">Hartmut Eilers website</a>.";
}
?>