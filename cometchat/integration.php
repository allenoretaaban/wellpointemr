<?php
/* ADVANCED */
define('SET_SESSION_NAME','');   // Session name
define('DO_NOT_START_SESSION','0');  // Set to 1 if you have already started the session
define('DO_NOT_DESTROY_SESSION','1'); // Set to 1 if you do not want to destroy session on logout
//define('ADD_LAST_ACTIVITY', '1' );  // Do not touch
define('SWITCH_ENABLED','1');
define('INCLUDE_JQUERY','1');
define('FORCE_MAGIC_QUOTES','0');
/* DATABASE */
define('DB_SERVER','localhost');
define('DB_PORT','3306');
define('DB_USERNAME','root');
define('DB_PASSWORD','');
define('DB_NAME','wpemrdb');
define('TABLE_PREFIX','');
define('DB_USERTABLE','auth_profiles');
define('DB_USERTABLE_NAME','first_name');
define('DB_USERTABLE_USERID','user_id');
define('DB_USERTABLE_LASTACTIVITY','lastactivity');
define('DB_AVATARTABLE'," ");
define('DB_AVATARFIELD'," ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_USERID." ");
define('ADD_LAST_ACTIVITY',"1");



/*define('PHPFOX', true);
define('PHPFOX_DS', DIRECTORY_SEPARATOR);
define('PHPFOX_DIR', dirname(dirname(__FILE__)) . PHPFOX_DS);
define('PHPFOX_NO_SESSION', true);*/
/*require_once (dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR."include".DIRECTORY_SEPARATOR."setting".DIRECTORY_SEPARATOR."server.sett.php");
define('DB_SERVER',      $_CONF['db']['host']    );
define('DB_PORT',        "3306"          );
define('DB_USERNAME',   $_CONF['db']['root']     );
define('DB_PASSWORD',   $_CONF['db']['']     );
define('DB_NAME',        'wpemrdb']    );
define('TABLE_PREFIX',  $_CONF['db']['']   );
define('DB_USERTABLE',  "auth_users");
define('DB_USERTABLE_USERID',  "user_id"                );
define('DB_USERTABLE_NAME',   "first_name"                  );
define('DB_AVATARTABLE',          " "             );
//define('DB_AVATARFIELD',          " ".TABLE_PREFIX.DB_USERTABLE.".user_image ");
define('DB_AVATARFIELD'," ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_USERID." ");
//define('DB_USERTABLE_LASTACTIVITY', ""      );
define('DB_USERTABLE_LASTACTIVITY','lastactivity');
define('ADD_LAST_ACTIVITY',"1");*/
/* FUNCTIONS */
/*function getUserID() {
$userid = 0;
require_once PHPFOX_DIR . 'include' . PHPFOX_DS . 'init.inc.php';
$id = Phpfox::getUserBy('user_id');
if (!empty($id)) {
  $userid = $id;
}
return $userid;
}*/
function getUserID() {
    $userid = 0; // Return 0 if user is not logged in

    if (!empty($_SESSION['userid'])) {
        $userid = $_SESSION['userid'];
    }
    return $userid;
}

function getFriendsList($userid,$time) {
$sql = ("select DISTINCT ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_USERID." userid, ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_NAME." username, ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_LASTACTIVITY." lastactivity, ".TABLE_PREFIX.DB_USERTABLE.".user_image avatar, ".TABLE_PREFIX.DB_USERTABLE.".first_name link, ".TABLE_PREFIX.DB_USERTABLE.".status_log message, cometchat_status.status from  ".TABLE_PREFIX.DB_USERTABLE." left join cometchat_status on ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_USERID." = cometchat_status.userid where  ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_USERID." NOT IN (select ".TABLE_PREFIX."user_blocked.block_user_id from ".TABLE_PREFIX."user_blocked where user_id = '".mysql_real_escape_string($userid)."' UNION select ".TABLE_PREFIX."user_blocked.user_id from ".TABLE_PREFIX."user_blocked where block_user_id = '".mysql_real_escape_string($userid)."') AND ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_USERID." IN (select ".TABLE_PREFIX."friend.friend_user_id from ".TABLE_PREFIX."friend where ".TABLE_PREFIX."friend.user_id = '".mysql_real_escape_string($userid)."') AND ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_USERID." IN (select ".TABLE_PREFIX."friend.user_id from ".TABLE_PREFIX."friend where ".TABLE_PREFIX."friend.friend_user_id = '".mysql_real_escape_string($userid)."')  order by username asc");
if (defined('DISPLAY_ALL_USERS') && DISPLAY_ALL_USERS == 1) {
  $sql = ("select DISTINCT ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_USERID." userid, ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_NAME." username, ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_LASTACTIVITY." lastactivity, ".TABLE_PREFIX.DB_USERTABLE.".user_image avatar, ".TABLE_PREFIX.DB_USERTABLE.".first_name link, ".TABLE_PREFIX.DB_USERTABLE.".status_log message, cometchat_status.status from ".TABLE_PREFIX.DB_USERTABLE." left join cometchat_status on ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_USERID." = cometchat_status.userid where ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_USERID." <> '".mysql_real_escape_string($userid)."' and ('".$time."'-".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_LASTACTIVITY."<'".((ONLINE_TIMEOUT)*2)."') and   ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_USERID." NOT IN (select ".TABLE_PREFIX."user_blocked.block_user_id from ".TABLE_PREFIX."user_blocked where user_id = '".mysql_real_escape_string($userid)."' UNION select ".TABLE_PREFIX."user_blocked.user_id from ".TABLE_PREFIX."user_blocked where block_user_id = '".mysql_real_escape_string($userid)."') order by username asc");
}
return $sql;
}




function getAvatar($image) {
$image = str_replace('%s','_50',$image);
        if (is_file(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'file'.DIRECTORY_SEPARATOR.'pic'.DIRECTORY_SEPARATOR.'user'.DIRECTORY_SEPARATOR.$image)) {
                return BASE_URL.'../images/'.$image;
        } else {
	//put the default image here
                return BASE_URL.'../cometchat/images/default_large.png';
        }
}




function chatLogin($userName,$userPass){
    $userid = 0;
    if (filter_var($userName, FILTER_VALIDATE_EMAIL)) {
      $sql ="SELECT * FROM ".TABLE_PREFIX.DB_USERTABLE." WHERE email ='".$userName."'";
    } else {
      $sql ="SELECT * FROM ".TABLE_PREFIX.DB_USERTABLE." WHERE user_name ='".$userName."'";
    }
    $result=mysql_query($sql);
    $row = mysql_fetch_array($result);
    if($row['password']== md5(md5($userPass).md5($row['password_salt']))) {
      $userid = $row['user_id'];
    }
    return $userid;
}
/*function getFriendsList($userid,$time) {
$sql = ("select DISTINCT ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_USERID." userid, ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_NAME." username, ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_LASTACTIVITY." lastactivity, ".TABLE_PREFIX.DB_USERTABLE.".user_image avatar, ".TABLE_PREFIX.DB_USERTABLE.".user_name link, ".TABLE_PREFIX.DB_USERTABLE.".status message, cometchat_status.status from  ".TABLE_PREFIX.DB_USERTABLE." left join cometchat_status on ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_USERID." = cometchat_status.userid where  ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_USERID." NOT IN (select ".TABLE_PREFIX."user_blocked.block_user_id from ".TABLE_PREFIX."user_blocked where user_id = '".mysql_real_escape_string($userid)."' UNION select ".TABLE_PREFIX."user_blocked.user_id from ".TABLE_PREFIX."user_blocked where block_user_id = '".mysql_real_escape_string($userid)."') AND ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_USERID." IN (select ".TABLE_PREFIX."friend.friend_user_id from ".TABLE_PREFIX."friend where ".TABLE_PREFIX."friend.user_id = '".mysql_real_escape_string($userid)."') AND ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_USERID." IN (select ".TABLE_PREFIX."friend.user_id from ".TABLE_PREFIX."friend where ".TABLE_PREFIX."friend.friend_user_id = '".mysql_real_escape_string($userid)."')  order by username asc");
if (defined('DISPLAY_ALL_USERS') && DISPLAY_ALL_USERS == 1) {
  $sql = ("select DISTINCT ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_USERID." userid, ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_NAME." username, ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_LASTACTIVITY." lastactivity, ".TABLE_PREFIX.DB_USERTABLE.".user_image avatar, ".TABLE_PREFIX.DB_USERTABLE.".user_name link, ".TABLE_PREFIX.DB_USERTABLE.".status message, cometchat_status.status from ".TABLE_PREFIX.DB_USERTABLE." left join cometchat_status on ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_USERID." = cometchat_status.userid where ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_USERID." <> '".mysql_real_escape_string($userid)."' and ('".$time."'-".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_LASTACTIVITY."<'".((ONLINE_TIMEOUT)*2)."') and   ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_USERID." NOT IN (select ".TABLE_PREFIX."user_blocked.block_user_id from ".TABLE_PREFIX."user_blocked where user_id = '".mysql_real_escape_string($userid)."' UNION select ".TABLE_PREFIX."user_blocked.user_id from ".TABLE_PREFIX."user_blocked where block_user_id = '".mysql_real_escape_string($userid)."') order by username asc");
}

return $sql;
}*/
/*function getUserDetails($userid) {
$sql = ("select ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_USERID." userid, ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_NAME." username, ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_LASTACTIVITY." lastactivity,  ".TABLE_PREFIX.DB_USERTABLE.".user_name link,  ".DB_AVATARFIELD." avatar, ".TABLE_PREFIX.DB_USERTABLE.".status message, cometchat_status.status from ".TABLE_PREFIX.DB_USERTABLE." left join cometchat_status on ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_USERID." = cometchat_status.userid ".DB_AVATARTABLE." where ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_USERID." = '".mysql_real_escape_string($userid)."' and ".TABLE_PREFIX.DB_USERTABLE.".profile_page_id = '0'");
return $sql;
}*/
function getUserDetails($userid) {
$sql = ("select ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_USERID." userid, ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_NAME." username, ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_LASTACTIVITY." lastactivity,  ".TABLE_PREFIX.DB_USERTABLE.".user_name link,  ".DB_AVATARFIELD." avatar, ".TABLE_PREFIX.DB_USERTABLE.".status_log message, cometchat_status.status from ".TABLE_PREFIX.DB_USERTABLE." left join cometchat_status on ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_USERID." = cometchat_status.userid ".DB_AVATARTABLE." where ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_USERID." = '".mysql_real_escape_string($userid)."' and ".TABLE_PREFIX.DB_USERTABLE.".profile_page_id = '0'");
return $sql;
}



function updateLastActivity($userid) {
$sql = ("update `".TABLE_PREFIX.DB_USERTABLE."` set ".DB_USERTABLE_LASTACTIVITY." = '".getTimeStamp()."' where ".DB_USERTABLE_USERID." = '".mysql_real_escape_string($userid)."'");
return $sql;
}
/*function getUserStatus($userid) {
  $sql = ("select ".TABLE_PREFIX.DB_USERTABLE.".status message, cometchat_status.status from ".TABLE_PREFIX.DB_USERTABLE." left join cometchat_status on ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_USERID." = cometchat_status.userid where ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_USERID." = '".mysql_real_escape_string($userid)."'");
  return $sql;
}*/
function getUserStatus($userid) {
  $sql = ("select ".TABLE_PREFIX.DB_USERTABLE.".status_log message, cometchat_status.status from ".TABLE_PREFIX.DB_USERTABLE." left join cometchat_status on ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_USERID." = cometchat_status.userid where ".TABLE_PREFIX.DB_USERTABLE.".".DB_USERTABLE_USERID." = '".mysql_real_escape_string($userid)."'");
  return $sql;
}






function getLink($link) {
        return BASE_URL.'../index.php?do=/'.$link.'/';
}
/*function getAvatar($image) {
$image = str_replace('%s','_50',$image);
        if (is_file(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'file'.DIRECTORY_SEPARATOR.'pic'.DIRECTORY_SEPARATOR.'user'.DIRECTORY_SEPARATOR.$image)) {
                return BASE_URL.'../file/pic/user/'.$image;
        } else {
                return BASE_URL.'../theme/frontend/default/style/default/image/noimage/profile_50.png';
        }
}*/
function getTimeStamp() {
return time();
}
function processTime($time) {
return $time;
}
/* HOOKS */
function hooks_statusupdate($userid,$statusmessage) {
/* $sql = ("insert into ".TABLE_PREFIX."feed (type_id,user_id,item_id,content,time_stamp) values ('user_status','".mysql_real_escape_string($userid)."','2','".mysql_real_escape_string(sanitize_core($statusmessage))."','".getTimeStamp()."')");
$query = mysql_query($sql);
$sql = ("update ".TABLE_PREFIX.DB_USERTABLE." set status = '".mysql_real_escape_string(sanitize_core($statusmessage))."' where user_id = '".mysql_real_escape_string($userid)."'");
$query = mysql_query($sql);
*/
}
function hooks_forcefriends() {

}
function hooks_activityupdate($userid,$status) {
}
function hooks_message($userid,$unsanitizedmessage) {

}
$p_ = 4;