<?php
/*-------------------------------------------------------+
| PHP-Fusion Content Management System
| Copyright © 2002 - 2016 Nick Jones
| http://www.php-fusion.co.uk/
+--------------------------------------------------------+
| Name: SGI Fusion TS3 Viewer (für v7.02.xx)
| Filename: ts3_panel.php
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
if (!defined("IN_FUSION")) { die("Access Denied"); }
include INFUSIONS."ts3_panel/infusion_db.php";

openside("Teamspeak 3");
/*
//DATABASE START
$ts3ssvpanel = dbquery("SELECT * FROM ".DB_TS3_SET."");
	while($data = dbarray($ts3ssv)) {
		$host = $data['host'];
		$query_port = $data['query_port'];
		$port = $data['port'];
		$admin_login = $data['admin_login'];
		$admin_passw = $data['admin_passw'];
		//DATABASE END
require_once("statusviewer/ts3ssv.php");
echo '<link rel="stylesheet" type="text/css" href="statusviewer/ts3ssv.css" />
<script type="text/javascript" src="statusviewer/ts3ssv.js"></script>';
$ts3ssvpanel = new ts3ssv("$host", $query_port);
$ts3ssvpanel->useServerPort($port);
$ts3ssvpanel->imagePath = "statusviewer/img/default/";
$ts3ssvpanel->timeout = 2;
$ts3ssvpanel->setLoginPassword("$admin_login", "$admin_passw");
$ts3ssvpanel->setCache(60, "statusviewer/ts3ssv.php.cache");
$ts3ssvpanel->hideEmptyChannels = false;
$ts3ssvpanel->hideParentChannels = false;
$ts3ssvpanel->showNicknameBox = false;
$ts3ssvpanel->showPasswordBox = false;
echo $ts3ssvpanel->render();
	}
#echo 'CONTENT ONE';
*/
closeside();

?>