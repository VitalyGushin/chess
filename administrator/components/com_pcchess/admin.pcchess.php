<?php
// PCChess Component//
/**
* @ Copyright (C) 2010 by Hartmut Eilers, Marian Tanase.
* @ All rights reserved
**/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

global $css;

// add stylesheet
	$css = JURI::root(true).'/administrator/components/com_pcchess/css/pcchess_admin.css';
	$mainframe = JFactory::getApplication();
	$mainframe->addCustomHeadTag( '<link rel="stylesheet" type="text/css" media="all" href="'.$css.'" />' );
	
	$document =& JFactory::getDocument();
	
// make preferences editable
	JToolBarHelper::preferences( 'com_pcchess' );

// e.g. for the core Content component, you would use JToolBarHelper::preferences( 'com_content' );
	JToolBarHelper::title( JText::_( 'PCChess' ) );
	JToolBarHelper::deleteList();
	JToolBarHelper::editListX();
	JToolBarHelper::addNewX();
?>

<div id="cpanel">
	<div id="container">
		<img class="logo" src="../components/com_pcchess/images/pcchess-logo.png" alt="Play PCChess" title="Play PCChess">
		<h1>PCChess Control Panel</h1>
		<h3>Welcome to PCChess !</h3>
		<p>PCChess is a native Joomla! component, allowing you to play chess games by correspondence(email).</p>
		<h4>Configuration</h4>
		<ol>
			<li>You must first create a new menu item linked to PCChess component;</li>
			<li>Register as a new user (or login if exist);</li>
			<li>Create a NEW GAME;</li>
			<li>Enjoy !</li></ol>
		<h4>Support</h4>
		<ul>
			<li>To report bugs, use this link : <a href="http://www.pcchess.net/index.php/support/free-support-forum/5-report-bugs.html" target="self">/report-bugs/</a></li>
			<li>Feature request link : <a href="http://www.pcchess.net/index.php/support/free-support-forum/6-feature-requests.html" target="self">/feature-request/</a></li>
			<li>General Discussion : <a href="http://www.pcchess.net/index.php/support/free-support-forum/4-general-support.html" target="self">/general-support/</a></li>
		</ul>
	</div>
	<div id="version"><strong>Installed version : <a href="#">PCChess 1.0.1</a></strong> | Copyright &copy; 2010<br />
	<a href="http://www.pcchess.net/index.php/download.html" target="self">Check for new versions !</a></div>
</div>