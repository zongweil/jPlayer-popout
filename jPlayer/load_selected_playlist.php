<? 
include($_SERVER['DOCUMENT_ROOT'] . '/globals/constants.php');
include($_SERVER['DOCUMENT_ROOT'] . '/globals/session.php');
?>
<?
if(isset($_POST['sel_title'])){
	$title = trim($_POST['sel_title']);
}
if (!$title) {
	//print "You didn't enter a title. Try again. <br>";
	exit(1);
}

// Escape string for query
$title = mysql_real_escape_string($title);

// Get Session ID for user_id - needs to actually have a user database later
$id = $_SESSION['id'];

$playlist_query = mysql_query("SELECT playlist_id FROM user_playlists WHERE user_id='$id' AND title='$title'");

$playlist_result = mysql_fetch_array($playlist_query);
$playlist_id = $playlist_result['playlist_id'];


// Add playlist to database
$query = "SELECT song_id FROM user_playlist_songs WHERE playlist_id = '$playlist_id' ORDER BY song_order";

$result = mysql_query($query);
if ($result) {
	//print "Successfully loaded playlist.<br>";?>
	myPlaylist1.setPlaylist([
	<?
	while( $row = mysql_fetch_array($result)){
		$song = $row['song_id'];
		$query1 = "SELECT title,artist FROM songs WHERE id=$song";
		$result1 = mysql_query($query1);
		$row1 = mysql_fetch_array($result1);
		$title1 = $row1['title'];
		$artist = $row1['artist'];?>
		{	
			id:"<? echo $song;?>",
			title:"<? echo strtoupper($title1); ?>",
			artist:"<? echo $artist; ?>",					
			mp3:"http://cs130.collegeroots.com/listen/<? echo $song; ?>/"
		},
		<?	
		}?>
	]);
<?
}

?>

