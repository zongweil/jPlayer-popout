<?
$songID = $_POST['song'];
$song_query = mysql_query("SELECT title,artist FROM songs WHERE id=$songID");
while ($row = mysql_fetch_assoc($song_query)) {
	$title = $row['title'];
	$artist = $row['artist'];
	?> 
    myPlaylist1.add(
    {
		id:"<? echo $songID; ?>",
		title:"<? echo strtoupper($title); ?>",
		artist:"<? echo $artist; ?>",					
		mp3:"http://cs130.collegeroots.com/listen/<? echo $songID; ?>/"
	}, <? if ($location =="play"){	?> true <? } else { ?>false<? } ?>
    ); 
<? }
?>