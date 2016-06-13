<?php
/*-------------------------------------------------------+
| PHP-Fusion Content Management System
| Copyright © 2002 - 2016 Nick Jones
| http://www.php-fusion.co.uk/
+--------------------------------------------------------+
| Name: SGI Fusion TS3 Viewer (für v7.02.xx)
| Filename: ts3_view.php
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
require_once THEMES."templates/header.php";

include INFUSIONS."ts3_panel/infusion_db.php";
require_once("framework/libraries/TeamSpeak3/TeamSpeak3.php");
require("includes/ts3admin.class.php");

opentable("Teamspeak 3 Viewer");
echo '<style type="text/css">
	#blocker{
		clear:both;
	}
	#links{
		background: transparent;
		width: 55%;
	}
	#rechts{
		float: right;
		width: 45%;
		background: transparent;
	}
</style>';

echo '
	<div id="rechts">';

//DATABASE START
$res_db1 = dbquery("SELECT * FROM ".DB_TS3_SET."");
	while($data = dbarray($res_db1)) {
		$host = $data['host'];
		$query_port = $data['query_port'];
		$port = $data['port'];
		$admin_login = $data['admin_login'];
		$admin_passw = $data['admin_passw'];
		//DATABASE END

try
{
  // connect to server, authenticate and grab info
  $ts3 = TeamSpeak3::factory("serverquery://".$admin_login.":".$admin_passw."@".$host.":".$query_port."/?server_port=".$port."");
  $serverInfo = $ts3->version();
  
  
  // show server as online
  echo "<span style=\"font-size: 9px\"><img src='".$ts3['virtualserver_hostbanner_gfx_url']."' width='345' height='44' ⁄></span><br /><br />";
  
  echo "<span style=\"font-size: 9px\">Server Status: Online</span><br />\n";
  echo "<span style=\"font-size: 9px\">Server Name: <em>" . $ts3->virtualserver_name . "</em></span><br />";
  echo "<span style=\"font-size: 9px\">Server IP: <em>" . $ts3->getAdapterHost() . ":" . $ts3->virtualserver_port . "</em></span><br />";
  echo "<span style=\"font-size: 9px\">Erstellt am: <em>".date('d.m.Y', $ts3['virtualserver_created'])."</em></span><br /><br />";
  echo "<span style=\"font-size: 9px\">Server Uptime: <em>" . TeamSpeak3_Helper_Convert::seconds($ts3->virtualserver_uptime) . "</em></span><br />";
  echo "<span style=\"font-size: 9px\">Platform: <em>" . $serverInfo['platform'] . '</em></span><br /><br />';
  echo "<span style=\"font-size: 9px\">Total Slots: <em>" . $ts3->virtualserver_maxclients . "</em></span><br />";
  echo "<span style=\"font-size: 9px\">Total Channels: <em>" . $ts3["virtualserver_channelsonline"] . '</em></span><br /><br />';
  echo "<span style=\"font-size: 9px\">Teamspeak&sup3; Version: <em>" . $serverInfo["version"] . "</em></span><br /><br />";
  echo "<span style=\"font-size: 9px\">&bull;&gt;&gt; VOICE &lt;&lt;&bull;</span> <br />";
  echo "<span style=\"font-size: 9px\">Download: <em>" . TeamSpeak3_Helper_Convert::bytes($ts3["connection_bytes_received_total"]) . "</em></span><br />";
  echo "<span style=\"font-size: 9px\">Upload: <em>" . TeamSpeak3_Helper_Convert::bytes($ts3["connection_bytes_sent_total"]) . "</em></span><br /><br />";
  echo "<span style=\"font-size: 9px\">&bull;&gt;&gt; FILE &lt;&lt;&bull;</span> <br />";
  echo "<span style=\"font-size: 9px\">Download: <em>" . TeamSpeak3_Helper_Convert::bytes($ts3["connection_filetransfer_bytes_received_total"]) . "</em></span><br />";
  echo "<span style=\"font-size: 9px\">Upload: <em>" . TeamSpeak3_Helper_Convert::bytes($ts3["connection_filetransfer_bytes_sent_total"]) . "</em></span><br /><br />";
  echo "<span style=\"font-size: 9px\">&bull;&gt;&gt; TOTAL &lt;&lt;&bull;</span> <br />";
  echo "<span style=\"font-size: 9px\">Download: <em>" . TeamSpeak3_Helper_Convert::bytes($ts3["connection_filetransfer_bytes_received_total"] + $ts3["connection_bytes_received_total"]) . "</em></span><br />";
  echo "<span style=\"font-size: 9px\">Upload: <em>" . TeamSpeak3_Helper_Convert::bytes($ts3["connection_filetransfer_bytes_sent_total"] + $ts3["connection_bytes_sent_total"]) . "</em></span><br /><br />";

}
catch(Exception $e)
{
  // grab errors and show server as offline
  echo "Server Status: OFFLINE<br />\n";
}

############################################ANDROID VERBINDUNG ANFANG
// connect to local server, authenticate and spawn an object for the virtual server on port 9987
$ts3_VirtualServer = TeamSpeak3::factory("serverquery://".$admin_login.":".$admin_passw."@".$host.":".$query_port."/?server_port=".$port."");
// query clientlist from virtual server and filter by platform
$arr_ClientList = $ts3_VirtualServer->clientList(array("client_platform" => "Android"));
// walk through list of clients
foreach($arr_ClientList as $ts3_Client)
{
 echo $ts3_Client ." benutzt ".$ts3_Client["client_platform"]."<br />\n";
}
############################################ANDROID VERBINDUNG ENDE
	}
#echo 'Ein Inhalt Two';

echo '</div>
	<div id="links">';

//DATABASE START
$ts3ssv = dbquery("SELECT * FROM ".DB_TS3_SET."");
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
$ts3ssv = new ts3ssv("$host", $query_port);
$ts3ssv->useServerPort($port);
$ts3ssv->imagePath = "statusviewer/img/default/";
$ts3ssv->timeout = 2;
$ts3ssv->setLoginPassword("$admin_login", "$admin_passw");
$ts3ssv->setCache(60, "statusviewer/ts3ssv.php.cache");
$ts3ssv->hideEmptyChannels = false;
$ts3ssv->hideParentChannels = false;
$ts3ssv->showNicknameBox = false;
$ts3ssv->showPasswordBox = false;
echo $ts3ssv->render();
	}
#echo 'CONTENT ONE';

echo '</div>
	<div id="blocker"></div>';
closetable();

echo "<br />";
opentable("Liste unserer Server");
$res_db3 = dbquery("SELECT * FROM ".DB_TS3_SET."");
	while($data = dbarray($res_db3)) {
		$ts3_ip = $data['host'];
		$ts3_queryport = $data['query_port'];
		#$port = $data['port'];
		$ts3_user = $data['admin_login'];
		$ts3_pass = $data['admin_passw'];
		//DATABASE END

#build a new ts3admin object
$tsAdmin = new ts3admin($ts3_ip, $ts3_queryport);

if($tsAdmin->getElement('success', $tsAdmin->connect())) {
	#login as serveradmin
	$tsAdmin->login($ts3_user, $ts3_pass);
	
	#get serverlist
	$servers = $tsAdmin->serverList();
	
	#set output var
	$output = '';
	
	#generate table codes for all servers
	foreach($servers['data'] as $server) {
		$output .= '<tr>';
		$output .= '<td width="50px" align="center">#'.$server['virtualserver_id'].'</td>';
		$output .= '<td width="300px">&nbsp;&nbsp;'.htmlspecialchars($server['virtualserver_name']).'</td>';
		$output .= '<td width="100px" align="center">'.$server['virtualserver_port'].'</td>';
		if(isset($server['virtualserver_clientsonline'])) {
			$clients = $server['virtualserver_clientsonline'] . '/' . $server['virtualserver_maxclients'];
		}else{
			$clients = '-';
		}
		$output .= '<td width="200px" align="center">'.$clients.'</td>';
		$output .= '<td width="100px" align="center">'.$server['virtualserver_status'].'</td>';
		if(isset($server['virtualserver_uptime'])) {
			$uptime = $tsAdmin->convertSecondsToStrTime(($server['virtualserver_uptime']));
		}else{
			$uptime = '-';
		}
		$output .= '<td width="150px" align="center">'.$uptime.'</td>';
	}
}else{
	echo 'Connection could not be established.';
}

if(count($tsAdmin->getDebugLog()) > 0) {
	foreach($tsAdmin->getDebugLog() as $logEntry) {
		echo '<script>alert("'.$logEntry.'");</script>';
	}
}
	}
echo '<table cellpadding="5" cellspacing="1" width="100%" border="0" align="center">
        	<tr>
            	<td width="10%" align="center"><b>ID<b></td>
                <td width="25%" align="center"><b>Servername<b></td>
            	<td width="10%" align="center"><b>Port<b></td>
            	<td width="15%" align="center"><b>Current clients<b></td>
                <td width="10%" align="center"><b>Status<b></td>
                <td width="25%" align="center"><b>Uptime<b></td>
            </tr>';
			echo $output;
echo '</table>';
closetable();

require_once THEMES."templates/footer.php";
?>
