<? 	
include($_SERVER['DOCUMENT_ROOT'] . '/globals/constants.php'); 
include($_SERVER['DOCUMENT_ROOT'] . '/globals/session.php');

?>

<? if($_POST['location'] == "playlist") { ?>
myPlaylist1 = new jPlayerPlaylist({
	jPlayer: "#jquery_jplayer_1",
	cssSelectorAncestor: "#jp_container_1"
	}, [
		<?  $songID = $_SESSION['initialSongID'];
			$song_query = mysql_query("SELECT id,title,artist FROM songs WHERE id='$songID'");
			$row = mysql_fetch_array($song_query);
			$song_id = $row['id'];
			$title = $row['title'];
			$artist = $row['artist'];
		?>
        {
			id:"<? echo $song_id; ?>",
			title:"<? echo strtoupper($title); ?>",
			artist:"<? echo $artist; ?>",					
			mp3:"http://cs130.collegeroots.com/listen/<? echo $song_id; ?>/"
		}
	], {
		swfPath: "../../jPlayer/js/Jplayer.swf",	<? // Location of flash file ?>
		supplied: "mp3",
		wmode: "window",
		solution: "flash, html",	<? // Flash with HTML5 fallback ?>
        ready: function() {
        	<? // Use AJAX to load song likes ?>
			$.ajax({
				type: "POST",
				url: '../../jPlayer/like/load_song_likes.php',
				data: {location: 'test1'},
				success: function(message) {
                	<? // Execute the resulting javascript code; avoid use of eval() ?>
					var tempFunction = new Function(message);	
                    tempFunction();				
				}
			});         
        	<? // Play the song once loaded ?>
	    	myPlaylist1.play();
		}
	});
    <? } ?>