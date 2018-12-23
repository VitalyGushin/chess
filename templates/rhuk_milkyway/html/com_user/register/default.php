<?php // no direct access
defined('_JEXEC') or die('Restricted access'); ?>
<script type="text/javascript">
<!--
	Window.onDomReady(function(){
		document.formvalidator.setHandler('passverify', function (value) { return ($('password').value == value); }	);
	});
// -->
</script>

<?php
	if(isset($this->message)){
		$this->display('message');
	}
?>

<form action="<?php echo JRoute::_( 'index.php?option=com_user' ); ?>" method="post" id="josForm" name="josForm" class="form-validate">

<?php if ( $this->params->def( 'show_page_title', 1 ) ) : ?>
<div class="componentheading<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>"><?php echo $this->escape($this->params->get('page_title')); ?></div>
<?php endif; ?>

<table cellpadding="0" cellspacing="0" border="0" width="100%" class="contentpane">
<tr>
	<td height="40">
		<label id="usernamemsg" for="username">
			<?php echo JText::_( 'Name and surename' ); ?>:
		</label>
	</td>
	<td>
		<input type="text" id="username" name="username" size="40" value="<?php echo $this->escape($this->user->get( 'username' ));?>" class="inputbox required validate-username" maxlength="25" /> *
	</td>
</tr>

<tr>
	<td height="40">
		<label id="institutionmsg" for="institution">
			<?php echo JText::_( 'Institution' ); ?>:
		</label>
	</td>
	<td>
		<input type="text" id="institution" name="params[institution]" size="40" value="<?php echo $this->escape($this->user->get( 'institution' ));?>" class="inputbox required validate-institution" maxlength="75" list="inst" /> *
        <datalist id="inst">
		<?
		$querry22 = mysql_query ("SELECT id as 'min_id' FROM chess_users ORDER BY id ASC LIMIT 1"); // Выбрать игрока с минимальным ID
		$querry23 = mysql_query ("SELECT id as 'max_id' FROM chess_users ORDER BY id DESC LIMIT 1");
  		$querr22 = mysql_fetch_assoc($querry22);
  		$querr23 = mysql_fetch_assoc($querry23);
    	$min_id = $querr22['min_id'];
    	$max_id = $querr23['max_id'];
 		for ($i = $min_id; $i <= $max_id; $i++)
			{
            $zapros2 = mysql_query ("SELECT params FROM chess_users WHERE id = '$i'");
            $zapr2 = mysql_fetch_assoc($zapros2);
    		$params = trim($zapr2['params']);
            $inst_position = strpos($params, "institution");
			$page_title_position = strpos($params, "page_title");
			if ($page_title_position == 0)
				{
				$inst[$i] = substr($params,$inst_position+12,strlen($params)); // Получаем поле institution
				}
			   	else
			   	{
			   	$inst[$i] = substr($params,$inst_position+12,$page_title_position-$inst_position-13);
			   	}
            $label = 1;
            for ($j = $min_id; $j < $i; $j++)
            	{
   				if ($inst[$i] == $inst[$j])
   					{
                    $label = 0;
   					}
   				}
   			if ($inst[$i] == "")
   				{
   				$label = 0;
   				}
   	        if ($label == 1)
   	        	{
   	        	echo '<option value='.$inst[$i].'>'.$inst[$i].'</option>'; //Формируем новую строчку
   	        	}
			}
		?>
		</datalist>
	</td>
</tr>

<tr>
  <td>
  </td>
  <td>
   Please do not use different spelling of the institution, if it is present in the drop-down list!
  </td>
</tr>

<!--
<tr>
	<td height="40">
		<label id="memnummsg" for="memnum">
			<?php echo JText::_( 'IEEE Membership number' ); ?>:
		</label>
	</td>
	<td>
		<input type="text" id="memnum" name="params[memnum]" size="40" value="<?php echo $this->escape($this->user->get( 'memnum' ));?>" class="inputbox required validate-memnum" maxlength="15" /> *
	</td>
</tr>
-->

<tr>
	<td width="30%" height="40">
		<label id="namemsg" for="name">
			<?php echo JText::_( 'IEEE Membership number' ); ?>:
		</label>
	</td>
  	<td>
  		<input type="text" name="name" id="name" size="40" value="<?php echo $this->escape($this->user->get( 'name' ));?>" class="inputbox required" maxlength="50" /> *
  	</td>
</tr>
<tr>
	<td height="40">
		<label id="emailmsg" for="email">
			<?php echo JText::_( 'Email' ); ?>:
		</label>
	</td>
	<td>
		<input type="text" id="email" name="email" size="40" value="<?php echo $this->escape($this->user->get( 'email' ));?>" class="inputbox required validate-email" maxlength="100" /> *
	</td>
</tr>
<tr>
	<td height="40">
		<label id="pwmsg" for="password">
			<?php echo JText::_( 'Password' ); ?>:
		</label>
	</td>
  	<td>
  		<input class="inputbox required validate-password" type="password" id="password" name="password" size="40" value="" /> *
  	</td>
</tr>
<tr>
	<td height="40">
		<label id="pw2msg" for="password2">
			<?php echo JText::_( 'Verify Password' ); ?>:
		</label>
	</td>
	<td>
		<input class="inputbox required validate-passverify" type="password" id="password2" name="password2" size="40" value="" /> *
	</td>
</tr>
<tr>
	<td colspan="2" height="40">
		<?php echo JText::_( 'REGISTER_REQUIRED' );
		     // echo "<br>";
		     // echo "Please do not use different spelling of the institution, if it is present in the drop-down list!";
		 ?>
	</td>
</tr>
</table>
	<button class="button validate" type="submit"><?php echo JText::_('Register'); ?></button>
	<input type="hidden" name="task" value="register_save" />
	<input type="hidden" name="id" value="0" />
	<input type="hidden" name="gid" value="0" />
	<?php echo JHTML::_( 'form.token' ); ?>
</form>
