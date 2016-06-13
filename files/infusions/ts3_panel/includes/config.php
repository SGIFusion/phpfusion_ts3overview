<?php
/*-------------------------------------------------------+
| PHP-Fusion Content Management System
| Copyright © 2002 - 2016 Nick Jones
| http://www.php-fusion.co.uk/
+--------------------------------------------------------+
| Name: SGI Fusion TS3 Viewer (für v7.02.xx)
| Filename: config.php
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
#require_once "../../maincore.php";
include INFUSIONS."ts3_panel/infusion_db.php";
include INFUSIONS."ts3_panel/includes/config.inc.php";
#require("includes/config.inc.php");
####################################################################################################################DB START
#$sgifts3 = dbquery("SELECT * FROM ".DB_TS3_SET."");
	#while($data = dbarray($sgifts3)){
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
// Place of the CSS File
#$ts3['config']['css'] = './style.css/';
$ts3['config']['css'] = '/includes/style.css';

// Imagefolder
#$ts3['config']['img_dir'] = './images/';
$ts3['config']['img_dir'] = '/images/';

// Cachefolder (folder + files must have CHMOD 777)
#$ts3['config']['cache_dir'] = './cache/';
$ts3['config']['cache_dir'] = './cache/';

// Server IP (without Port)
#$ts3['config']['ip'] = '84.xxx.xxx.xx';
$ts3['config']['ip'] = '$ip';

// Server Port (default: 9987)
#$ts3['config']['port'] = '9987';
$ts3['config']['port'] = '$port';

// Query Port (default: 10011)
#$ts3['config']['qport'] = '10011';
$ts3['config']['qport'] = '$query';

// Use caching for the TS Viewer (Value in seconds, 0 = off)
$ts3['config']['cache'] = '20';

// Value for auto-refresh (Value in seconds)
$ts3['config']['refresh'] = '30';

// Possibility to cut channel's name (0 = off)
$ts3['config']['chancut'] = '35';

// Possibility to cut players's name (0 = off)
$ts3['config']['nickcut'] = '25';

// Shows groupinfo (0 = off, 1 = on)
$ts3['config']['showgroups'] = '1';

// Show information box - global switch (0 = off, 1 = on)
$ts3['config']['stats'] = '1';

// Show current players / max. players / reserved slots (0 = off, 1 = on)
#$ts3['config']['serverinfo']['virtualserver_clientsonline']['show'] = '1'; 
$ts3['config']['serverinfo']['virtualserver_clientsonline']['show'] = '$player'; 
$ts3['config']['serverinfo']['virtualserver_clientsonline']['label'] = 'Players';

// Show the IP:Port from the server (0 = off, 1 = on)
#$ts3['config']['serverinfo']['virtualserver_ip']['show'] = '1'; 
$ts3['config']['serverinfo']['virtualserver_ip']['show'] = '$ipport'; 
$ts3['config']['serverinfo']['virtualserver_ip']['label'] = 'Host';

// Show the server uptime since the last restart (0 = off, 1 = on)
#$ts3['config']['serverinfo']['virtualserver_uptime']['show'] = '1'; 
$ts3['config']['serverinfo']['virtualserver_uptime']['show'] = '$uptime'; 
$ts3['config']['serverinfo']['virtualserver_uptime']['label'] = 'Uptime';

// Show the server traffic (0 = off, 1 = on)
#$ts3['config']['serverinfo']['connection_bytes_total']['show'] = '1'; 
$ts3['config']['serverinfo']['connection_bytes_total']['show'] = '$traffic'; 
$ts3['config']['serverinfo']['connection_bytes_total']['label'] = 'Traffic (in / out)';

// Show on wich OS TS3 run (0 = off, 1 = on)
#$ts3['config']['serverinfo']['virtualserver_platform']['show'] = '1'; 
$ts3['config']['serverinfo']['virtualserver_platform']['show'] = '$osts3'; 
$ts3['config']['serverinfo']['virtualserver_platform']['label'] = 'Server OS';

// Show the TS3 server version (0 = off, 1 = on)
#$ts3['config']['serverinfo']['virtualserver_version']['show'] = '1'; 
$ts3['config']['serverinfo']['virtualserver_version']['show'] = '$versionts3'; 
$ts3['config']['serverinfo']['virtualserver_version']['label'] = 'Version';

// Server Icon
$ts3['config']['serverimg'] = 'sgif_ts3.png';

// Server Groups - Just feed this array with the existing groups / icons / names, to display all in the viewer
// SERVER GROUPS ID ICONS ### Edit By Beginner ! Rookie ? Support on http://www.septron.de or http://phpfusion-deutschland.de
$ts3['config']['sgroup'][9]['n'] = 'Server Admin';
$ts3['config']['sgroup'][9]['p'] = '19_genarm.png';

$ts3['config']['sgroup'][6]['n'] = 'Co Admin';
$ts3['config']['sgroup'][6]['p'] = '17_ltgen.png';

$ts3['config']['sgroup'][12]['n'] = 'V.I.P.';
$ts3['config']['sgroup'][12]['p'] = '14_col.png';

$ts3['config']['sgroup'][7]['n'] = 'Member';
$ts3['config']['sgroup'][7]['p'] = '12_maj.png';

$ts3['config']['sgroup'][13]['n'] = 'Trial Member';
$ts3['config']['sgroup'][13]['p'] = '03_crp.png';

$ts3['config']['sgroup'][8]['n'] = 'Guest';
$ts3['config']['sgroup'][8]['p'] = '01_pfc.png';

// Channel Groups - Just feed this array with the existing groups / icons / names, to display all in the viewer
// CHANNEL GROUP ID ICONS ### Edit By Beginner ! Rookie ? Support on http://www.septron.de or http://phpfusion-deutschland.de
$ts3['config']['cgroup'][5]['n'] = 'Channel Admin';
$ts3['config']['cgroup'][5]['p'] = '11_cpt.png';

$ts3['config']['cgroup'][6]['n'] = 'Operator';
$ts3['config']['cgroup'][6]['p'] = '09_2lt.png';

$ts3['config']['cgroup'][7]['n'] = 'Voice';
$ts3['config']['cgroup'][7]['p'] = '02_lcrp.png';

// Channel Icons - Just feed this array with the existing ID's / icons, to display all in the viewer
// LEGEND ### Edit By Beginner ! Rookie ? Support on http://www.septron.de or http://phpfusion-deutschland.de
$ts3['config']['icons'][2] = 'flag_de.png';
$ts3['config']['icons'][25] = 'rom.png';
$ts3['config']['icons'][26] = 'db.png';
$ts3['config']['icons'][21] = 'headset.png';
$ts3['config']['icons'][82] = 'wow.png';
	#}
####################################################################################################################DB END
?>
