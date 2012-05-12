<? 
include($_SERVER['DOCUMENT_ROOT'] . '/globals/constants.php'); 
include($_SERVER['DOCUMENT_ROOT'] . '/globals/session.php');

// Get the id of the song and of the user
$post_id = $_POST['post_id'];
$user_id = $_SESSION['id'];
if(!$post_id || !$user_id)
	die("Illegal call of this page");

// Check if the song is liked
$like_check_query = mysql_query("SELECT user_id FROM song_likes WHERE user_id='$user_id' AND song_id='$post_id'");

$row = mysql_fetch_array($like_check_query);
if($row['user_id'])
	$like_exists = '1';

if($like_exists != '1') {
	$db_time = date('Y-m-d H:i:s');
	
	// Add the song like to the database
	$insert = mysql_query("INSERT INTO song_likes (user_id,song_id,time) VALUES ('$user_id','$post_id','$db_time')");
}
else
{
	// Remove the song like from the database
	$delete = mysql_query("DELETE FROM song_likes WHERE user_id='$user_id' AND song_id='$post_id'");
}
exit;
?>