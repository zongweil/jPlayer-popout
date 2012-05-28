<? 
include($_SERVER['DOCUMENT_ROOT'] . '/globals/constants.php');
include($_SERVER['DOCUMENT_ROOT'] . '/globals/session.php');
?>
<?
if(isset($_POST['sel_title'])){
	$title = trim($_POST['sel_title']);
}
// Get Session ID for user_id - needs to actually have a user database later
$id = $_SESSION['id'];

// Get id of playlist that was just created
$playlist_query = mysql_query("SELECT playlist_id FROM user_playlists WHERE user_id='$id' AND title='$title'");
$playlist_result = mysql_fetch_array($playlist_query);
$play_id = $playlist_result['playlist_id'];
mysql_query("DELETE FROM user_playlist_songs WHERE playlist_id = '$play_id'");
mysql_query("DELETE FROM user_playlists WHERE playlist_id = '$play_id'");

?>

