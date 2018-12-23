<?php
/**
 * @version		$Id: CHANGELOG.php 1 2010-12-16 marian $
 * @category	Games
 * @package		PCChess
 * @copyright	Copyright (C) 2010 Marian Tanase. All rights reserved.
 * @license	    GNU GPLv2 <http://www.gnu.org/licenses/old-licenses/gpl-2.0.html>
 * @link     	http://www.tanase.it
 */
defined('_JEXEC') or die('Restricted access');
?>

Note: This changelog only contains the most important changes.

Legend:

* -> Security Fix
# -> Bug Fix
$ -> Language fix or change
+ -> Addition
^ -> Change
- -> Removed
! -> Note

-------------------- 1.0.1 Stable Release [ December 16, 2010] ------------------ 
# Fixed (inverted) chessboard black-white colors.


-------------------- 1.0 Stable Release [ August 15, 2010] ------------------ 
# Fixed #1 Correct CSS path in pcchess.php.
^ Include the moves into an iframe style div.
^ Change the board size.
^ Change the images for board pieces using alpha.ead.01 (45x45)
^ Changed exportpgn file to hide comments.
^ Correct "Round" field value from export PGN.