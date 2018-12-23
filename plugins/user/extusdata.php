<?php
/**
 * @package        Joomla
 * @copyright    Copyright (C) 2009 Tushov Leonid
 * @license        GNU/GPL, see LICENSE.php
 */

defined('_JEXEC') or die( 'Restricted access' );

jimport('joomla.plugin.plugin');

class plgUserExtUsData extends JPlugin {

    function onAfterStoreUser($user, $isnew, $success, $msg)
    {
        if ($isnew) {
            $db =& JFactory::getDBO();
            $registry = new JRegistry();
            $registry->loadArray($_POST['params']);
            $params = $registry->toString();
            $db->setQuery("UPDATE #__users SET params = '" .  $db->getEscaped($params) . "' WHERE id = " . $user['id']);
            $db->query();            
        }
    }
}