<?
include($_SERVER['DOCUMENT_ROOT'] . '/globals/constants.php'); 

$type = $_POST['type'];
$songID = $_POST['songID'];
$song_query = mysql_query("SELECT title,artist FROM songs WHERE id=$songID");
while ($row = mysql_fetch_array($song_query)) {
	$title = $row['title'];
	$artist = $row['artist'];
	?> 
    myPlaylist1.add( <?php //load_playlist.php'de initialize edildi.?>
    {
		id:"<? echo $songID; ?>",
		title:"<? echo strtoupper($title); ?>",
		artist:"<? echo $artist; ?>",					
		mp3:"http://cs130.collegeroots.com/listen/<? echo $songID; ?>/"
	}, <? if ($type =="play"){	?> true <? } else { ?>false<? } ?>  <?php //If type is quuee, set false, don't play?>
    ); 
<? }
?>