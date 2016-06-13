<?php
/*-------------------------------------------------------+
| PHP-Fusion Content Management System
| Copyright © 2002 - 2016 Nick Jones
| http://www.php-fusion.co.uk/
+--------------------------------------------------------+
| Name: SGI Fusion TS3 Viewer (für v7.02.xx)
| Filename: functions_sgif.php
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
//error_reporting(E_ALL);
function sendCmd($fp, $cmd){
    $msg = '';
    fputs($fp, $cmd);
    while(strpos($msg, 'msg=') === false){
        $msg .= fread($fp, 8096);
    }
    if(!strpos($msg, 'msg=ok')){
        return false;
    }else{
        return $msg;
    }
    echo $msg;
}

function splitInfo($info){
    $info = trim(str_replace('error id=0 msg=ok', '', $info));
    $info = explode(' ', $info);
    foreach ($info as $var) {
        if(strpos($var, '=')=== FALSE){
            $return[$var] = '';
        }else{
            $b = trim(substr($var, 0, (strpos($var, '='))));
            $return[$b] = substr($var, (strpos($var, '=')+1));
        }
    }
    return $return;
}

function trimInfo($info){
    $info = trim(str_replace('error id=0 msg=ok', '', $info));
    $info = explode('|', $info);
    return $info;
}

function sortUsers($a, $b){
	if($a["client_talk_power"] != $b["client_talk_power"]){
		return ($a["client_talk_power"] > $b["client_talk_power"]) ? -1 : 1;
	}
	if($a["client_is_talker"] != $b["client_is_talker"]){
		return ($a["client_is_talker"] > $b["client_is_talker"]) ? -1 : 1;
	}
	return strcasecmp(strtolower($a["client_nickname"]), strtolower($b["client_nickname"]));
}

function sortRanks($a, $b){
	if($a["client_channel_group_id"] != $b["client_channel_group_id"]){
		return ($a["client_channel_group_id"] < $b["client_channel_group_id"]) ? -1 : 1;
	}
	return ($a['client_channel_group_id'] < $b['client_channel_group_id']) ? -1 : 1;
}

function convert_bytes($byte){
	if(!$byte or !is_numeric($byte) or $byte < 0) return false;
	$bz = array(" B", " kB", " MB", " GB", " TB");
	$count=0;
	while($byte > 1024) { $byte /= 1024; $count++; }
	return round($byte,2).$bz[$count];
}

function rep($var, $reverse = false){
	$search = array('\\\\', "\/", "\s", "\p", "\a", "\b", "\f", "\n", "\r", "\t", "\v");
	$replace = array(chr(92), chr(47), chr(32),	chr(124), chr(7), chr(8), chr(12), chr(10),	chr(3),	chr(9),	chr(11));
    if(!$reverse) return str_replace($search, $replace, htmlspecialchars($var));	
	return str_replace($replace, $search, htmlspecialchars($var));
}

function rep_spacer($var, $reverse = false){
	$search = array('\\\\', "\/", "\s", "\p", "\a", "\b", "\f", "\n", "\r", "\t", "\v");
	$replace = array(chr(92), chr(47), chr(32),	chr(124), chr(7), chr(8), chr(12), chr(10),	chr(3),	chr(9),	chr(11));
    if(!$reverse) return str_replace($search, $replace, $var);	
	return str_replace($replace, $search, $var);
}

function chancut($var,$ts3){
    if($ts3['config']['chancut'] >= '1'){
        $count = strlen($var);
        if($count > $ts3['config']['chancut']){
            $pos = $ts3['config']['chancut']-3;
            $var = substr($var, 0, $pos).'...';
        }
    }
    return $var;
}

function nickcut($var,$ts3){
    if($ts3['config']['nickcut'] >= '1'){
        $count = strlen($var);
        if($count > $ts3['config']['nickcut']){
            $pos = $ts3['config']['nickcut']-3;
            $var = substr($var, 0, $pos).'...';
        }
    }
    return $var;
}

function servergroups($ts3) {
    $return = '';
    if(isset($ts3['config']['showgroups']) && $ts3['config']['showgroups'] == '1'){
        $return .= "<div class=\"servergroups container\"><h3>Servergroups:</h3>\n";
        foreach ($ts3['config']['sgroup'] as $var){
            $return .= "  <div class=\"servergroups icon\"><img src=\"" . $ts3['config']['img_dir'] . "/" . $var['p'] . "\" alt=\"\" /></div>\n";
            $return .= "  <div class=\"servergroups rang\">" . $var['n'] . "</div>\n";
            $return .= "  <div style=\"clear:both\"></div>\n";
        }
        $return .= "</div>\n";
    }
    return $return;
}

function channelgroups($ts3) {
    $return = '';
    if(isset($ts3['config']['showgroups']) && $ts3['config']['showgroups'] == '1'){
        $return .= "<div class=\"channelgroups container\"><h3>Channelgroups:</h3>\n";
        foreach ($ts3['config']['cgroup'] as $var) {
            $return .= " <div class=\"channelgroups icon\"><img src=\"" . $ts3['config']['img_dir'] . "/" . $var['p'] . "\" alt=\"\" /></div>\n";
            $return .= " <div class=\"channelgroups rang\">" . $var['n'] . "</div>\n";
            $return .= " <div style=\"clear:both\"></div>\n";
        }
        $return .= "</div>\n";
    }
    return $return;
}

function stats($ts3){
    $return = '';
	$info_img = "<img class=\"status\" src=\"" . $ts3['config']['img_dir'] . "/status_info.png\" alt=\"\" />\n";
    if(isset($ts3['config']['stats']) && $ts3['config']['stats'] == 1){
		$return .= "\n<!-- Serverstatistik Anfang -->\n<div class=\"status\"><h3>Information:</h3></div>\n";
        $days = ($ts3['sinfo']['virtualserver_uptime']/60/60/24)%365;
        $hours = ($ts3['sinfo']['virtualserver_uptime']/60/60)%24;
        $minutes = ($ts3['sinfo']['virtualserver_uptime']/60)%60;
		$seconds = ($ts3['sinfo']['virtualserver_uptime'])%60;
        $ts3['sinfo']['virtualserver_uptime'] = (($days < 10) ? " " : "").$days."D ".(($hours < 10) ? ' ' : "").$hours.":".(($minutes < 10) ? '0' : "").$minutes.":".(($seconds < 10) ? '0' : "").$seconds;
		$ts3['sinfo']['virtualserver_version'] = preg_replace('/\[.*\]/', '', rep($ts3['sinfo']['virtualserver_version']));
		$ts3['sinfo']['virtualserver_clientsonline'] = $ts3['sinfo']['virtualserver_clientsonline'] - $ts3['sinfo']['virtualserver_queryclientsonline'].' / '.$ts3['sinfo']['virtualserver_maxclients'].' ('.$ts3['sinfo']['virtualserver_reserved_slots'].')';
		$ts3['sinfo']['virtualserver_ip'] = $ts3['config']['ip'].':'.$ts3['config']['port'];
		$ts3['sinfo']['connection_bytes_in'] = convert_bytes($ts3['sinfo']['connection_bytes_received_total']);
		$ts3['sinfo']['connection_bytes_out']  = convert_bytes($ts3['sinfo']['connection_bytes_sent_total']);
		$ts3['sinfo']['connection_bytes_total'] = $ts3['sinfo']['connection_bytes_in'].' / '.$ts3['sinfo']['connection_bytes_out'];
        $return .= "<div class=\"status\">\n";
        $return .= "<table>\n";
        foreach ($ts3['config']['serverinfo'] as $key => $var){
            if($var['show'] == 1){
                $return .= "<tr><td>" . $info_img . " " . $var['label'] . ":</td><td>" . rep($ts3['sinfo'][$key]) . "</td></tr>\n";
            }
        }
        $return .= "</table>\n";
        $return .= "</div>\n<!-- Serverstatistik Ende -->\n";
    }
    return $return;
}

function spacer($var){

	if(!preg_match("#\[(.*)spacer.*\](.*)#", $var)) return;

	$repeat = 100;
	
	$temp = explode("]", $var);
	
	switch(substr($temp[0], 1, 1)){

		case "*" :	
			$return .= "<div class=\"spacer_repeat\">\n" . str_repeat($temp[1], $repeat) . "\n</div>";
			break;
			
		case "l" :
			$return .= "<div class=\"spacer_left\">\n" . $temp[1] . "\n</div>";
			break;
			
		case "c" :
			$return .= "<div class=\"spacer_center\">\n" . $temp[1] . "\n</div>";
			break;
			
		case "r" :
			$return .= "<div class=\"spacer_right\">\n" . $temp[1] . "\n</div>";
			break;
	}	
	
	switch(substr($temp[1], 0, 3)){

		case "___" :	
			$return .= "<div class=\"spacer_repeat\">\n" . str_repeat("&#8212;", $repeat) . "\n</div>";
			break;

		case "---" :	
			$return .= "<div class=\"spacer_repeat\">\n" . str_repeat("&#8722;&#8722;&#8722;", $repeat) . "\n</div>";
			break;
			
		case "-.-" :
			$return .= "<div class=\"spacer_repeat\">\n" . str_repeat("&#8722;&#183;&#8722;", $repeat) . "\n</div>";
			break;
			
		case "-.." :
			$return .= "<div class=\"spacer_repeat\">\n" . str_repeat("&#8722;&#183;&#183;", $repeat) . "\n</div>";
			break;
			
		case "..." :	
			$return .= "<div class=\"spacer_repeat\">\n" . str_repeat("&#183;", $repeat) . "\n</div>";
			break;
	}
	return $return;
}

function tree($ts3,$csid){
    $return = "";
    if(isset($ts3['config']['ip']) && $ts3['config']['port'] && $csid == '0'){
		if($ts3['sinfo']["virtualserver_clientsonline"] - $ts3['sinfo']["virtualserver_queryclientsonline"] >= $ts3['sinfo']["virtualserver_maxclients"]) $return .= "<ul style=\"list-style-type:none;padding-left:0px;\"><li class=\"channel\"><img style=\"vertical-align: middle;\" src=\"" . $ts3['config']['img_dir'] . "/server_red.png\" alt=\"\" /> <a id=\"ip\" href=\"ts3server://" . $ts3['config']['ip'] . "?port=" . $ts3['config']['port'] . "\" />" . rep($ts3['sinfo']['virtualserver_name']) . "</a>\n";
		else if($ts3['sinfo']["virtualserver_flag_password"] == 1) $return .= "<ul style=\"list-style-type:none;padding-left:0px;\"><li class=\"channel\"><img style=\"vertical-align: middle;\" src=\"" . $ts3['config']['img_dir'] . "/server_yellow.png\" alt=\"\" /> <a id=\"ip\" href=\"ts3server://" . $ts3['config']['ip'] . "?port=" . $ts3['config']['port'] . "\" />" . rep($ts3['sinfo']['virtualserver_name']) . "</a>\n";
        else $return .= "<ul style=\"list-style-type:none;padding-left:0px;\"><li class=\"channel\"><img style=\"vertical-align: middle;\" src=\"" . $ts3['config']['img_dir'] . "/server_green.png\" alt=\"\" /> <a id=\"ip\" href=\"ts3server://" . $ts3['config']['ip'] . "?port=" . $ts3['config']['port'] . "\" >" . rep($ts3['sinfo']['virtualserver_name']) . "</a>\n";
		if($ts3['sinfo']["virtualserver_icon_id"] != 0 && $ts3['config']['serverimg'] != '') $return .= "<div class=\"iconcontainer\"><img class=\"channel flags server\" src=\"" . $ts3['config']['img_dir'] . "/" . $ts3['config']['serverimg'] . "\" alt=\"\" /></div>\n";
		else $return .= "";
	}
    $return .= "\n<!-- Channellist Anfang -->\n<ul class=\"channellist\">\n";
    foreach ($ts3['clist'] as $key => $var){
        if($var['pid'] == $csid){
            if(preg_match("#\[(.*)spacer.*\](.*)#", $var["channel_name"]) && !$var['pid']) $return .= "\n<!-- Spacer Anfang -->\n<li class=\"channel\">\n";
			else if($var["channel_maxclients"] > -1 && ($var["total_clients"] >= $var["channel_maxclients"])) $return .= "<li class=\"channel\"><img style=\"vertical-align: middle;\" src=\"" . $ts3['config']['img_dir'] . "/channel_red.png\" alt=\"\" />\n";
			else if($var["channel_maxfamilyclients"] > -1 && ($var["total_clients_family"] >= $var["channel_maxfamilyclients"])) $return .= "<li class=\"channel\"><img style=\"vertical-align: middle;\" src=\"" . $ts3['config']['img_dir'] . "/channel_red.png\" alt=\"\" />\n";
			else if($var["channel_flag_password"] == 1) $return .= "<li class=\"channel\"><img style=\"vertical-align: middle;\" src=\"" . $ts3['config']['img_dir'] . "/channel_yellow.png\" alt=\"\" />\n";
			else $return .= "<li class=\"channel\"><img style=\"vertical-align: middle;\" src=\"" . $ts3['config']['img_dir'] . "/channel_green.png\" alt=\"\" />\n";
			// Spacerchannel 			
            if(preg_match("#\[(.*)spacer.*\](.*)#", rep($var["channel_name"],$ts3)) && !$var['pid']){
				$var['channel_spacer_name'] .= spacer($var['channel_name']);
				$return .= rep_spacer($var['channel_spacer_name']) ."\n</li>\n<!-- Spacer Ende -->\n";
			}
			else $return .= chancut(rep($var['channel_name']),$ts3);
			$return .= "\n<!-- Icons Channel und Games Anfang -->\n<div class=\"iconcontainer\">\n";
			// Icons for Games 			
			if(array_key_exists($var['cid'], $ts3['config']['icons'])){
				$return .= "<img class=\"channel flags games\" src=\"" . $ts3['config']['img_dir'] . "/" . $ts3['config']['icons'][$var['cid']] . "\" alt=\"\" />\n";
			}		
			if($var["channel_flag_default"] == 1) $return .= "<img class=\"channel flags\" src=\"" . $ts3['config']['img_dir'] . "/channel_default.png\" alt=\"\" />\n";
			if($var["channel_needed_talk_power"] > 0) $return .= "<img class=\"channel flags\" src=\"" . $ts3['config']['img_dir'] . "/channel_moderated.png\" alt=\"\" />\n";
			if($var["channel_flag_password"] == 1) $return .= "<img class=\"channel flags\" src=\"" . $ts3['config']['img_dir'] . "/channel_locked.png\" alt=\"\" />\n";
			if($var["channel_codec"] == 3) $return .= "<img class=\"channel flags\" src=\"" . $ts3['config']['img_dir'] . "/channel_music.png\" alt=\"\" />\n";
			else $return .= "";
			$return .= "</div>\n<!-- Icons Channel und Games Ende -->\n";
            $return .= tree($ts3,$var['cid']);
            if($var['total_clients'] >= '1' && isset($ts3['plist'])){
            	$return .= "<!-- Playerlist Anfang -->\n<ul class=\"playerlist\">\n";
                foreach($ts3['plist'] as $u_key => $u_var){
                    if($u_var['cid'] == $var['cid']){
                        if($u_var['client_flag_talking']){
                            $p_img = 'player_talking.png';
						}
                        else if($u_var['client_flag_talking'] && $u_var['client_is_channel_commander']){
                            $p_img = 'player_commander_talking.png';
						}
                        else if($u_var['client_is_channel_commander']){
                            $p_img = 'player_commander.png';
						}
                        else if($u_var['client_away']){
                            $p_img = 'player_away.png';
                        }
                        else if($u_var['client_input_muted']){
                            $p_img = 'player_mic_muted.png';
                        }
                        else if(!$u_var['client_input_hardware']){
                            $p_img = 'player_mic_disabled.png';
                        }
                        else if($u_var['client_output_muted']){
                            $p_img = 'player_snd_muted.png';
                        }
                        else if(!$u_var['client_output_hardware']){
                            $p_img = 'player_snd_disabled.png';
                        }
						else $p_img = 'player_normal.png';
						$g_img = '';
                        $g_temp = '';
                        if(strpos($u_var['client_servergroups'], ',') !== FALSE){
                            $g_temp = explode(',', $u_var['client_servergroups']);
                        }else{
                            $g_temp[0] = $u_var['client_servergroups'];
                        }
                        if(isset($ts3['config']['cgroup'][$u_var['client_channel_group_id']]['p'])){
							$g_img .= "<img src=\"" . $ts3['config']['img_dir'] . "/" . $ts3['config']['cgroup'][$u_var['client_channel_group_id']]['p'] . "\" alt=\"\" />\n";
                        }
                        foreach ($g_temp as $sg_var) {
                            if(isset($ts3['config']['sgroup'][$sg_var]['p'])){
                                $g_img .= "<img src=\"" . $ts3['config']['img_dir'] . "/" . $ts3['config']['sgroup'][$sg_var]['p'] . "\" alt=\"\" />\n";
                            }
                        }
						if($u_var['client_is_priority_speaker']){
							$s_img = 'player_priority_speaker.png';
                            $img = "<img src=\"" . $ts3['config']['img_dir'] . "/" . $s_img . "\" alt=\"\" />\n";
						}
						else if($u_var['client_talk_power'] < $var['channel_needed_talk_power']){
							$s_img = 'player_mic_muted.png';
                            $img = "<img src=\"" . $ts3['config']['img_dir'] . "/" . $s_img . "\" alt=\"\" />\n";
						}
						else if($u_var['client_is_talker']){
							$s_img = 'player_is_talker.png';
                            $img = "<img src=\"" . $ts3['config']['img_dir'] . "/" . $s_img . "\" alt=\"\" />\n";
						}
                        $return .= "<li class=\"player\"><img style=\"vertical-align: middle;\" src=\"" . $ts3['config']['img_dir'] . "/" . $p_img . "\" alt=\"\" />";
                        $return .= nickcut(rep($u_var['client_nickname']),$ts3);
                        $return .= "<span style=\"float:right;\">" . $g_img . "</span>";
						if($u_var['client_is_priority_speaker']){
							$return .= "<span style=\"float:right;\">" . $img . "</span>";
						}
						else if($u_var['client_talk_power'] < $var['channel_needed_talk_power']){
							$return .= "<span style=\"float:right;\">" . $img . "</span>";
						}
						else if($u_var['client_is_talker']){
							$return .= "<span style=\"float:right;\">" . $img . "</span>";
						}
                        $return .= "</li>\n";
                    }
                }
                $return .= "</ul>\n<!-- Playerlist Ende -->\n";
            }
            $return .= "</li>\n";
        }
    }
    if(isset($ts3['config']['ip']) && $ts3['config']['port'] && $csid == '0'){
        $return .= "</ul></li>\n";
    }
    $return .= "</ul>\n<!-- Channellist Ende -->\n";
    return $return;
}

function show($ts3) {
    if($ts3['config']['cache'] >= '1'){
        if(!file_exists($ts3['config']['cache_dir'])){
            $ts3['error']['cache_dir'] = '<div class="error"><img style="vertical-align: middle;" src="'.$ts3['config']['img_dir'].'/warning.png" alt=""> Cache directory doesn\'t exist.</div>';
        }else{
            if(!is_readable($ts3['config']['cache_dir']) || !is_writable($ts3['config']['cache_dir'])){
                $ts3['error']['cache_dir'] = '<div class="error"><img style="vertical-align: middle;" src="'.$ts3['config']['img_dir'].'/warning.png" alt=""> Cache directory is not writeable or readable.</div>';
            }else{
                $ts3['cache_files']['time'] = $ts3['config']['cache_dir'].'/time.txt';
                $ts3['cache_files']['page'] = $ts3['config']['cache_dir'].'/page.txt';
                foreach ($ts3['cache_files'] as $value) {
                    if(!file_exists($value)){
                        $fp = fopen($value, 'w');
                        fwrite($fp, ' ');
                        fclose($fp);
                        $ts3['cache_neu'] = '1';
                    }
                }
                $fp = fopen($ts3['cache_files']['time'], 'r');
                $ts3['cache_time_a'] = fread($fp, filesize($ts3['cache_files']['time']));
                if($ts3['cache_time_a'] <= time()){
                    $ts3['cache_neu'] = '1';
                    fclose($fp);
                    $fp = fopen($ts3['cache_files']['time'], 'w');
                    $ts3['cache_time_b'] = time() + $ts3['config']['cache'];
                    fwrite($fp, $ts3['cache_time_b']);
                }
                fclose($fp);
            }
        }
    }else{
        $ts3['cache_neu'] = '1';
    }
    $ts3['echo'] = "<div id=\"body\">\n";
    if((isset($ts3['cache_neu']) &&  $ts3['cache_neu'] == '1')  || isset($ts3['error']['cache_dir'])){
		$fp = @fsockopen($ts3['config']['ip'], $ts3['config']['qport'], $errno, $errstr, 2);
		if($fp){
			$cmd = "use port=".$ts3['config']['port']."\n";
			if(!($select = sendCmd($fp, $cmd))){
				$ts3['error']['server_id'] = '<div class="error"><img style="vertical-align: middle;" src="'.$ts3['config']['img_dir'].'/server_offline.png" alt=""> Server offline</div>';
			}
			$cmd = "serverinfo\n";
			$ts3['sinfo'] = sendCmd($fp, $cmd);
			$ts3['sinfo'] = splitInfo($ts3['sinfo']);
			$cmd = "channellist -topic -flags -voice -limits\n";
			$ts3['clist_t'] = sendCmd($fp, $cmd);
			$ts3['clist_t'] = trimInfo($ts3['clist_t']);
			foreach ($ts3['clist_t'] as $var) {
				$ts3['clist'][] = splitInfo($var);
			}
			$cmd = "clientlist -uid -away -voice -groups\n";
			$ts3['plist_t'] = sendCmd($fp, $cmd);
			$ts3['plist_t'] = trimInfo($ts3['plist_t']);
			foreach ($ts3['plist_t'] as $var) {
				if(strpos($var, 'client_type=0') !== FALSE) {
					$ts3['plist'][] = splitInfo($var);
				}
			}
			if(isset($ts3['plist']) && is_array($ts3['plist'])) {
				foreach ($ts3['plist'] as $key => $var) {
					if(strpos($var['client_servergroups'], ',') !== FALSE){
						$t = strpos($var['client_servergroups'], ',');
						$ts3['plist'][$key]['nickname'] = substr($var['client_servergroups'], 0, $t);
					}else{
						$ts3['plist'][$key]['nickname'] = $var['client_servergroups'];
					}
				}
				uasort($ts3['plist'], "sortRanks");
				uasort($ts3['plist'], "sortUsers");
			}
			$cmd = "quit\n";
			fputs($fp, $cmd);
			fclose($fp);
		}else{
			$ts3['error']['ts_con'] = '<div class="error"><img style="vertical-align: middle;" src="'.$ts3['config']['img_dir'].'/error.png" alt=""> Can\'t connect to server.</div>';
		}
        if(isset($ts3['error'])){
            foreach ($ts3['error'] as $value) {
                $ts3['echo'] .= $value.'<br />';
            }
        }else{
            $ts3['echo'] .= tree($ts3,'0').servergroups($ts3).channelgroups($ts3).stats($ts3);
        }
    }else{
        $ts3['echo'] = file_get_contents($ts3['cache_files']['page']);
    }
    if($ts3['config']['cache'] >= '1' && isset($ts3['cache_neu']) && $ts3['cache_neu'] == '1'){
        $fp = fopen($ts3['cache_files']['page'], 'w');
        fwrite($fp, $ts3['echo']);
        fclose($fp);
    }
    /** Replace <ul></ul> von leeren Channels ohne Inhalt **/
    $ts3['echo'] = str_replace("<!-- Channellist Anfang -->\n<ul class=\"channellist\"></ul><!-- Channellist Ende -->\n", "", $ts3['echo']);
    $ts3['echo'] = str_replace("<!-- Playerlist Anfang -->\n<ul class=\"playerlist\">\n</ul>\n<!-- Playerlist Ende -->\n", "", $ts3['echo']);
    
    $ts3['echo'] = mb_convert_encoding($ts3['echo'], "ISO-8859-1", "UTF-8");
    return $ts3['echo'];
}

?>
