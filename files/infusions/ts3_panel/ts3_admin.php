<?php
/*-------------------------------------------------------+
| PHP-Fusion Content Management System
| Copyright © 2002 - 2016 Nick Jones
| http://www.php-fusion.co.uk/
+--------------------------------------------------------+
| Name: SGI Fusion TS3 Viewer (für v7.02.xx)
| Filename: ts3_admin.php
| Author: Dennis Kaiser (Septron)
| Support Website: http://www.septron.de
|				   http://www.septron.eu
|				   http://www.septron.net
|				   http://www.septron.org
|				   http://www.septron.info
|				   http://phpfusion-deutschland.de
+--------------------------------------------------------+
| This program is released as free software under the
| Affero GPL license. You can redistribute it and/or
| modify it under the terms of this license which you
| can read by viewing the included agpl.txt or online
| at www.gnu.org/licenses/agpl.html. Removal of this
| copyright header is strictly prohibited without
| written permission from the original author(s).
+--------------------------------------------------------*/
require_once "../../maincore.php";
require_once THEMES."templates/admin_header.php";

include INFUSIONS."ts3_panel/infusion_db.php";

if (!checkrights("TS3A") || !defined("iAUTH") || $_GET['aid'] != iAUTH) { redirect("../../index.php"); }

if(isset($_POST['save_data'])) {
	
	$host = stripinput($_POST['host']);
	$query_port = stripinput($_POST['query_port']);
	$port = stripinput($_POST['port']);
	$server_id = stripinput($_POST['server_id']);
	$timeout = stripinput($_POST['timeout']);
	$admin_login = stripinput($_POST['admin_login']);
	$admin_passw = stripinput($_POST['admin_passw']);
	$hide_nick = stripinput($_POST['hide_nick']);
	$show_pass = stripinput($_POST['show_pass']);
	$decode_utf = "true";
	
	$result = dbquery("UPDATE ".DB_TS3_SET." SET host='".$host."', query_port='".$query_port."', port='".$port."', server_id='".$server_id."', timeout='".$timeout."', admin_login='".$admin_login."', admin_passw='".$admin_passw."', hide_nick='".$hide_nick."', show_pass='".$show_pass."', decode_utf='".$decode_utf."'");
	redirect(FUSION_SELF.$aidlink);

} else {
	
	opentable("Teamspeak 3 Einstellungen");
	echo "<table align='center' cellspacing='1' cellpadding='2' width='100%' class='tbl-border'>\n";
	
	$res_db = dbquery("SELECT * FROM ".DB_TS3_SET."");
	while($data = dbarray($res_db)) {
	
		echo "<form name='ts3_settings' action='".FUSION_SELF.$aidlink."' method='post'>\n";
		
		echo "<tr>\n";
			echo "<td align='left' width='130px' class='tbl'><strong>Host:</strong></td>";
			echo "<td align='left' width='300px' class='tbl'><input type='text' class='textbox' name='host' style='width:200px;' value='".$data['host']."'></td>";
			echo "<td align='left' class='tbl'><em>... der TS3 Server Hostname, bzw. die Server IP..</em></td>";
		echo "</tr>\n";
		
		echo "<tr>\n";
			echo "<td align='left' width='130px' class='tbl'><strong>Query Port:</strong></td>";
			echo "<td align='left' width='300px' class='tbl'><input type='text' class='textbox' name='query_port' style='width:200px;' value='".$data['query_port']."'></td>";
			echo "<td align='left' class='tbl'><em>... der TS3 Query Port, z.b. 10011..</em></td>";
		echo "</tr>\n";
		
		echo "<tr>\n";
			echo "<td align='left' width='130px' class='tbl'><strong>Port:</strong></td>";
			echo "<td align='left' width='300px' class='tbl'><input type='text' class='textbox' name='port' style='width:200px;' value='".$data['port']."'></td>";
			echo "<td align='left' class='tbl'><em>... der TS3 Port, z.b. 9987..</em></td>";
		echo "</tr>\n";
		
		echo "<tr>\n";
			echo "<td align='left' width='130px' class='tbl'><strong>Server ID:</strong></td>";
			echo "<td align='left' width='300px' class='tbl'><input type='text' class='textbox' name='server_id' style='width:200px;' value='".$data['server_id']."'></td>";
			echo "<td align='left' class='tbl'><em>... die TS3 Server ID..</em></td>";
		echo "</tr>\n";
		
		echo "<tr>\n";
			echo "<td align='left' width='130px' class='tbl'><strong>Timeout:</strong></td>";
			echo "<td align='left' width='300px' class='tbl'><input type='text' class='textbox' name='timeout' style='width:200px;' value='".$data['timeout']."'></td>";
			echo "<td align='left' class='tbl'><em>... Timeout aller Aktionen in Sekunden..</em></td>";
		echo "</tr>\n";
		
		echo "<tr>\n";
			echo "<td align='left' width='130px' class='tbl'><strong>Admin Name:</strong></td>";
			echo "<td align='left' width='300px' class='tbl'><input type='text' class='textbox' name='admin_login' style='width:200px;' value='".$data['admin_login']."'></td>";
			echo "<td align='left' class='tbl'><em>... der ServerQuery Adminloginname..</em></td>";
		echo "</tr>\n";
		
		echo "<tr>\n";
			echo "<td align='left' width='130px' class='tbl'><strong>Admin Passwort:</strong></td>";
			echo "<td align='left' width='300px' class='tbl'><input type='text' class='textbox' name='admin_passw' style='width:200px;' value='".$data['admin_passw']."'></td>";
			echo "<td align='left' class='tbl'><em>... das ServerQuery Adminpasswort..</em></td>";
		echo "</tr>\n";
	
		/*
		echo "<tr>\n";
			echo "<td align='left' width='130px' class='tbl'><strong>Nickname Box:</strong></td>";
			echo "<td align='left' width='300px' class='tbl'>";
				echo "<select name='hide_nick' style='width:200px;' class='textbox'>";
					
					if($data['hide_nick'] == "false") {
						echo "<option selected value='false'>verstecken</option>";
						echo "<option value='true'>anzeigen</option>";
					} else {
						echo "<option selected value='true'>anzeigen</option>";
						echo "<option value='false'>verstecken</option>";
					}
					
				echo "</select></td>";
			echo "<td align='left' class='tbl'><em>... soll das Nicknamefenster angezeigt werden?..</em></td>";
		echo "</tr>\n";
	
		echo "<tr>\n";
			echo "<td align='left' width='130px' class='tbl'><strong>Passwort Box:</strong></td>";
			echo "<td align='left' width='300px' class='tbl'>";
				echo "<select name='show_pass' style='width:200px;' class='textbox'>";
					
					if($data['show_pass'] == "false") {
						echo "<option selected value='false'>verstecken</option>";
						echo "<option value='true'>anzeigen</option>";
					} else {
						echo "<option selected value='true'>anzeigen</option>";
						echo "<option value='false'>verstecken</option>";
					}
					
				echo "</select></td>";
			echo "<td align='left' class='tbl'><em>... soll das Passwortfeld angezeigt werden?..</em></td>";
		echo "</tr>\n";
		*/
		
		echo "<tr>\n<td colspan='3' align='left' class='tbl'><input type='submit' name='save_data' value='Speichern' class='button'></td></tr>\n";

		echo "</form>\n";
		
	}
	
	echo "</table>\n";
	closetable();
}	


require_once THEMES."templates/footer.php";
?>