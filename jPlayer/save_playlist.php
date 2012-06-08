<? 
include($_SERVER['DOCUMENT_ROOT'] . '/globals/constants.php');
include($_SERVER['DOCUMENT_ROOT'] . '/globals/session.php');
?>
<?
if(isset($_POST['play_title'])){
	$title = mysql_real_escape_string(trim($_POST['play_title']));
}
if(isset($_POST['id_arr'])){
	$str_arr = $_POST['id_arr'];
    $saved_arr = preg_split('/ /', $str_arr, -1 , PREG_SPLIT_NO_EMPTY); ;
}

if (!$title) {
	exit(1);
}

// Get Session ID for user_id - needs to actually have a user database later
$id = $_SESSION['id'];

// Add playlist to database
$query_check = "SELECT * FROM user_playlists WHERE title = '$title'";
$result_check=mysql_query($query_check);
$num_results = mysql_num_rows($result_check); 
if($num_results > 0)
{
	?>$('#save_output').html('<div class="failure">Playlist "<? echo $title; ?>" already exists. Please choose a different name.</div>');<? 
}
else
{
	mysql_query("INSERT INTO user_playlists (user_id, title, time_created, time_modified) VALUES('$id', '$title', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)");


	// Get id of playlist that was just created
	$playlist_id = mysql_insert_id();
	$order = 1;
	foreach ($saved_arr as $vals) {
		mysql_query("INSERT INTO user_playlist_songs VALUES($playlist_id,$vals,$order)");
		$order++;
	}
	?>
    $('#save_output').html('<div class="success">Playlist successfully added!</div>');
    <?
}

?>
