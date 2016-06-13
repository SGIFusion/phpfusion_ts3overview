<?php
/*-------------------------------------------------------+
| PHP-Fusion Content Management System
| Copyright © 2002 - 2016 Nick Jones
| http://www.php-fusion.co.uk/
+--------------------------------------------------------+
| Name: SGI Fusion TS3 Viewer (für v7.02.xx)
| Filename: ts3_info.php
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

include INFUSIONS."ts3_panel/infusion_db.php";
require_once(INFUSIONS."ts3_panel/data/tsstatus.php");

echo "<link rel='stylesheet' type='text/css' href='".INFUSIONS."ts3_panel/data/ts3.css' media='screen'>\n";
echo "<script type='text/javascript' src='".INFUSIONS."ts3_panel/data/ts3.class.js'></script>\n";

$res_db = dbquery("SELECT * FROM ".DB_TS3_SET."");
	while($data = dbarray($res_db)) {
		$host = $data['host'];
		$query_port = $data['query_port'];
		$server_id = $data['server_id'];
		$timeout = $data['timeout'];
		$admin_login = $data['admin_login'];
		$admin_passw = $data['admin_passw'];
		$hide_nick = $data['hide_nick'];
		$show_pass = $data['show_pass'];
		$decode_utf = $data['decode_utf'];
	}


$tsstatus = new TSStatus($host, $query_port, $server_id);
$tsstatus->imagePath = INFUSIONS."ts3_panel/images/";
$tsstatus->showNicknameBox = $hide_nick;
$tsstatus->showPasswordBox = $show_pass;
$tsstatus->decodeUTF8 = $decode_utf;
$tsstatus->timeout = $timeout;
$tsstatus->setLoginPassword($admin_login, $admin_passw);
echo $tsstatus->render();
echo $ts3_panel_show;

?>