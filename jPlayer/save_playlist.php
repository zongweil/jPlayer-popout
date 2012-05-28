<? 
include($_SERVER['DOCUMENT_ROOT'] . '/globals/constants.php');
include($_SERVER['DOCUMENT_ROOT'] . '/globals/session.php');
?>
<?
if(isset($_POST['play_title'])){
	$title = trim($_POST['play_title']);
}
if(isset($_POST['id_arr'])){
	$str_arr = $_POST['id_arr'];
    $saved_arr = explode( " ", $str_arr);
}

if (!$title) {
	//print "You didn't enter a title. Try again. <br>";
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
	?>alert("Playlist '<?echo $title;?>' already exists. Please choose a different name.");<? 
}
else
{
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
foreach ($saved_arr as $vals) {
	mysql_query("INSERT INTO user_playlist_songs VALUES($playlist_id,$vals,$order)");
	$order++;
}
}

?>

