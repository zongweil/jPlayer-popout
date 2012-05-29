<? 
include($_SERVER['DOCUMENT_ROOT'] . '/globals/constants.php');
include($_SERVER['DOCUMENT_ROOT'] . '/globals/session.php');
?>
<?
if(isset($_POST['playlist_id'])){
	$playlist_id = $_POST['playlist_id'];
}
if (!$playlist_id) {
	exit(1);
}

// Add playlist to database
$query = "SELECT song_id FROM user_playlist_songs WHERE playlist_id = '$playlist_id' ORDER BY song_order";

$result = mysql_query($query);
if ($result) {
	?>
    myPlaylist1.option("autoPlay", true);
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

