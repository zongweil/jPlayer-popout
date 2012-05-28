<? 
include($_SERVER['DOCUMENT_ROOT'] . '/globals/constants.php');
include($_SERVER['DOCUMENT_ROOT'] . '/globals/session.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Test Page 1</title>
<link rel="stylesheet" type="text/css" href="jPlayer/skin/blue.monday/jplayer.blue.monday.css"/>
<link rel="stylesheet" type="text/css" href="jPlayer/like/like.css"/>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript" src="jPlayer/js/jquery.jplayer.js"></script>
<script type="text/javascript" src="jPlayer/js/jplayer.playlist.js"></script>
<script type="text/javascript" src="jPlayer/dragdrop/jquery-ui-1.8.20.custom.min.js"></script>
<script type="text/javascript" src="globals/include/js/ajax_form/jquery.form.js"></script>
<script type="text/javascript" src="http://yui.yahooapis.com/3.3.0/build/yui/yui-min.js"></script>
<script type="text/javascript">
$().ready(function(){
	$.ajax({
		type: "POST",
		url: "alert.php"
		}
	});
});


</script>
</head>
<body>
<?
if(isset($_POST['play_title'])){
	$title = $_POST['play_title'];
}
if(isset($_POST['id_arr'])){
	$str_arr = $_REQUEST['id_arr'];
    $saved_arr = explode( " ", $str_arr);
}

if (!$title) {
	//print "You didn't enter a title. Try again. <br>";
	exit(1);
}

// Get Session ID for user_id - needs to actually have a user database later
$id = $_SESSION['id'];

// Add playlist to database
$query = "INSERT INTO user_playlists (user_id, title, time_created, time_modified) VALUES(";
$query = $query . "\"" . $id . "\", \"" . $title . "\", CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";

$result = mysql_query($query);
if ($result) {
	//print "Successfully added playlist.<br>";
}

// Get id of playlist that was just created
$id_query = "SELECT LAST_INSERT_ID()";
$result = mysql_query($id_query);
$row = mysql_fetch_row($result);
$playlist_id = $row[0];
$order = 1;
	foreach ($id as $saved_arr) {
		mysql_query("INSERT INTO user_playlist_songs VALUES($playlist_id, $id, $order)");
		$order++;
	}


?>

</body>
</html>
