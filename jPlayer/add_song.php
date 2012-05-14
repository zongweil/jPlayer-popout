<?
include($_SERVER['DOCUMENT_ROOT'] . '/globals/constants.php'); 

$type = $_POST['type'];
$songID = $_POST['songID'];
$song_query = mysql_query("SELECT title,artist FROM songs WHERE id=$songID");
while ($row = mysql_fetch_array($song_query)) {
	$title = $row['title'];
	$artist = $row['artist'];
	?> 
	pos = myPlaylist1.find(<? echo $songID; ?>);
	if(pos == -1) {
		myPlaylist1.add(
		{
			id:"<? echo $songID; ?>",
			title:"<? echo strtoupper($title); ?>",
			artist:"<? echo $artist; ?>",					
			mp3:"http://cs130.collegeroots.com/listen/<? echo $songID; ?>/"
		}, <? if ($type =="play"){	?> true <? } else { ?>false<? } ?>
		); 
	}
	else {
		<? if ($type =="play"){	?>
		myPlaylist1.play(pos);
		<? } ?>
	}
<? }
?>