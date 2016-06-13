<?php
/*-------------------------------------------------------+
| PHP-Fusion Content Management System
| Copyright © 2002 - 2016 Nick Jones
| http://www.php-fusion.co.uk/
+--------------------------------------------------------+
| Name: SGI Fusion TS3 Viewer (für v7.02.xx)
| Filename: config.inc.php
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
/* INCLUDE: Verbindung zur Text-Datenbank herstellen */
/*
$db_server = "localhost"; // Hostname
$db_user = "root"; // Benutzername
$db_pass = "root"; // Kennwort
$db_name = "sqltest"; // Name der Datenbank
*/
//DATABASE START
$viewts3 = dbquery("SELECT * FROM ".DB_TS3_SET."");
	while($data = dbarray($viewts3)) {
		$ip = $data['host'];
		$port = $data['port'];
		$query = $data['query'];
		$player = $data['player_show'];
		$ipport = $data['ipport_show'];
		$uptime = $data['uptime_show'];
		$traffic = $data['traffic_show'];
		$osts3 = $data['osts3_show'];
		$versionts3 = $data['versionts3_show'];
		$style = ''.INFUSIONS.'ts3_panel/includes/style.css';
		$imagefolder = ''.INFUSIONS.'ts3_panel/images/';
		$cachefolder = ''.INFUSIONS.'ts3_panel/cache/';
	}
//DATABASE END
/*		
$db_ts3_settings_host = $data['host'];
$db_ts3_settings_port = $data['port'];
$db_ts3_settings_query = $data['query'];
$db_ts3_settings_player_show = $data['player_show'];
$db_ts3_settings_ipport_show = $data['ipport_show'];
$db_ts3_settings_uptime_show = $data['uptime_show'];
$db_ts3_settings_traffic_show = $data['traffic_show'];
$db_ts3_settings_osts3_show = $data['osts3_show'];
$db_ts3_settings_versionts3_show = $data['versionts3_show'];
*/

/*
$ip = $data['host'];
$port = $data['port'];
$query = $data['query'];
$player = $data['player_show'];
$ipport = $data['ipport_show'];
$uptime = $data['uptime_show'];
$traffic = $data['traffic_show'];
$osts3 = $data['osts3_show'];
$versionts3 = $data['versionts3_show'];
$style = ''.INFUSIONS.'ts3_panel/includes/style.css';
$imagefolder = ''.INFUSIONS.'ts3_panel/images/';
$cachefolder = ''.INFUSIONS.'ts3_panel/cache/';
*/
?>