<? 
include($_SERVER['DOCUMENT_ROOT'] . '/globals/constants.php');
include($_SERVER['DOCUMENT_ROOT'] . '/globals/session.php');

if(isset($_POST['playlist'])){
	$playlist = $_POST['playlist'];
	$playlist = explode( " ", $playlist);
}
if(isset($_POST['song_id'])){
	$song_id = $_POST['song_id'];
}
if(!$playlist || !$song_id)
{		
	?>
    <div class="failure">Improper ID's sent.</div>
    <?
}
for($i = 0; $i < count($playlist); $i++)
{
	$playlist_id = $playlist[$i];
	$max_order_query = mysql_query("SELECT MAX(song_order) AS song_order FROM user_playlist_songs WHERE playlist_id=$playlist_id");
	$row = mysql_fetch_array($max_order_query);
	$song_order = $row['song_order'] + 1;

	mysql_query("INSERT INTO user_playlist_songs (playlist_id, song_id, song_order) VALUES ('$playlist_id','$song_id','$song_order')");
	
}
?>
<div class="success">Added!</div>