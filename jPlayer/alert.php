<? 
include($_SERVER['DOCUMENT_ROOT'] . '/globals/constants.php');
include($_SERVER['DOCUMENT_ROOT'] . '/globals/session.php');

//$query = "select * from user_playlist_songs";
$query = "SELECT * FROM user_playlist_songs ORDER BY song_order";
$result=mysql_query($query);
/*while($table = mysql_fetch_array($result))
{
	Print "<b>PlayID:</b> ".$table['playlist_id'] . " "; 
	Print "<b>SongID:</b> ".$table['song_id'] . " <br>"; 
}*/
  while($table = mysql_fetch_array($result))
{
	Print "<b>SongID:</b> ".$table['song_id'] ."<b>Order:</b> ".$table['order'] ."<b>playlistID:</b> ".$table['playlist_id']  ." <br>"; 
}  
$query = "SELECT * FROM user_playlists";
$result=mysql_query($query);
/*while($table = mysql_fetch_array($result))
{
	Print "<b>PlayID:</b> ".$table['playlist_id'] . " "; 
	Print "<b>SongID:</b> ".$table['song_id'] . " <br>"; 
}*/
  while($table = mysql_fetch_array($result))
{
	Print "<b>UserID:</b> ".$table['user_id']."<b>playlistID:</b> ".$table['playlist_id']."<b>title:</b> ".$table['title']."<b>timeCreated:</b> ".$table['time_created']. " <br>"; 
} 
$id = 1;
$title = "fongson";
$query = "SELECT song_id FROM user_playlist_songs WHERE playlist_id = (SELECT playlist_id FROM user_playlists WHERE user_id = $id AND title = \"$title\")";
$result=mysql_query($query);
  while($table = mysql_fetch_array($result))
{
	//Print "<b>UserID:</b> ".$table['user_id']."<b>playlistID:</b> ".$table['playlist_id']."<b>title:</b> ".$table['title']."<b>timeCreated:</b> ".$table['time_created']. " <br>"; 
	Print "<b>SongID:</b> ".$table['song_id'] . " <br>";
} 
?>


<? print_r($_SESSION); ?>