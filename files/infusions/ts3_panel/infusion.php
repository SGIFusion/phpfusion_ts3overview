<?php
/*-------------------------------------------------------+
| PHP-Fusion Content Management System
| Copyright © 2002 - 2016 Nick Jones
| http://www.php-fusion.co.uk/
+--------------------------------------------------------+
| Name: SGI Fusion TS3 Viewer (für v7.02.xx)
| Filename: infusion.php
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

include INFUSIONS."ts3_panel/infusion_db.php";

$inf_title = "Teamspeak 3 Panel";
$inf_description = "Teamspeak 3 Panel";
$inf_version = "1.0";
$inf_developer = "Septron";
$inf_email = "support@septron.de";
$inf_weburl = "http://www.septron.de";
$inf_folder = "ts3_panel";

$inf_newtable[1] = DB_TS3_SET." (
id INT(10) NOT NULL AUTO_INCREMENT,
host VARCHAR(255) NOT NULL DEFAULT '',
query_port VARCHAR(255) NOT NULL DEFAULT '',
port VARCHAR(255) NOT NULL DEFAULT '',
server_id VARCHAR(255) NOT NULL DEFAULT '',
timeout VARCHAR(255) NOT NULL DEFAULT '',
admin_login VARCHAR(255) NOT NULL DEFAULT '',
admin_passw VARCHAR(255) NOT NULL DEFAULT '',
hide_nick VARCHAR(255) NOT NULL DEFAULT '',
show_pass VARCHAR(255) NOT NULL DEFAULT '',
decode_utf VARCHAR(255) NOT NULL DEFAULT '',
PRIMARY KEY (id)
) ENGINE=MyISAM;";

$inf_insertdbrow[1] = DB_TS3_SET." (host, query_port, port, server_id, timeout, admin_login, admin_passw, hide_nick, show_pass, decode_utf) VALUES('127.0.0.1', '10011', '9987', '1', '2', 'serveradmin', 'abcd1234', '1', '1', '1')";

$inf_droptable[1] = DB_TS3_SET;

$inf_adminpanel[1] = array(
	"title" => "Teamspeak 3",
	"image" => "sgif_ts3.png",
	"panel" => "ts3_admin.php",
	"rights" => "TS3A"
);

$inf_sitelink[1] = array(
	"title" => "Teamspeak 3",
	"url" => "ts3_view.php",
	"visibility" => "0" // 0 - Guest / 101 - Member / 102 - Admin / 103 - Super Admin.
);
?>

