<?php

	if (!$authenticated){
		if (isset($register_error)){
		$login_output.="
			<FONT color=#ff0000>$register_error</FONT>
			<b><a href = 'email_password.html?login=$login'>Forget your password?</b></a><BR>";
		}
	
		$login_output.="<TABLE WIDTH=166 HEIGHT=53 CELLSPACING=0 CELLPADDING=0 BORDER=0>
		<TR>
			<TD width=65 align=right class=smallText>
			<form action='$action_of' method=post>
				<font size=1>Login:</font></TD>
				<td width=2></td>
			<TD width=83><input type=hidden name=log_action value='commit'>
			<input type=hidden name=done_link value='$done_link'><input type=text size=12 name=login value='$login' style='font-size: 8px; font-family: MS Sans Serif, sans-serif;'></TD>
			<TD width=22 rowspan=2><input type=image src=images/enter_button.jpg border=0 align=ABSMIDDLE title='Enter' alt='Enter'></TD>
			</TD>
		</TR>
		<TR>
			<TD width=65 align=right class=smallText><font size=1>Password:</font></TD>
			<td width=2></td>
			<TD width=83><input type=password size=12 name=the_password value='' style='font-size: 8px; font-family: MS Sans Serif, sans-serif;'></TD>
		</TR></form>
		</TABLE>";
	}
	else{
		$login_output.= "<TABLE WIDTH=166 HEIGHT=53 CELLSPACING=0 CELLPADDING=0 BORDER=0>
		<TR>
			<TD width=40 align=right class=smallText>
				<font size=1>User:</font></TD>
				<td width=2></td>
			<TD width=108 class=smallText><font size=1><B>$user_name</B></font></TD>
			<TD width=22 rowspan=3 class=smallText><a href=$index_file?log_action=logout&language=$language&done_link=$index_file><img src=images/exit_button.jpg border=0 align=ABSMIDDLE title='Exit' alt='Exit'></a></TD>
			</TD>
		</TR>
		<TR>
			<TD width=40 align=right class=smallText><font size=1>Level:</font></TD>
			<td width=2></td>
			<TD width=108 class=smallText><font size=1><B>$user_level</B></font></TD>
		</TR>
		<TR>
			<TD width=40 align=right class=smallText><font size=1>Profile:</font></TD>
			<td width=2></td>
			<TD width=108 class=smallText><font size=1>[ <b><a href=profile.php?user=$user_id>view</a></B> ]&nbsp;&nbsp;[ <B><a href=$index_file?area=$hr_area&load=edit_profile>edit</a></B> ]</font></TD>
		</TR></form>
		</TABLE>";
		
		}
	
	
	
	
	

$login_output.= "
";





?>
