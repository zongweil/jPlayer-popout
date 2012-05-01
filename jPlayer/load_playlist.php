<? 	
include($_SERVER['DOCUMENT_ROOT'] . '/globals/constants.php'); 
include($_SERVER['DOCUMENT_ROOT'] . '/globals/session.php');

// Get the location of the calling page
$location = $_POST['location'];
switch($location) {
	case "test1":
		?>
    	var myPlaylist1 = new jPlayerPlaylist({
		jPlayer: "#jquery_jplayer_1",
		cssSelectorAncestor: "#jp_container_1"
	}, [
    
	<? 
			// Get all songs by the artist Miaow
	 		$top_song_query = mysql_query("SELECT id,title,artist FROM songs WHERE artist='Miaow' ORDER BY title ASC");
				
				for($i=0;$row = mysql_fetch_array($top_song_query);$i++)
				{
					$song_id = $row['id'];
					$title = $row['title'];
					$artist = $row['artist'];
					if($title){
					?> 
					{
						id:"<? echo $song_id; ?>",
						title:"<? echo strtoupper($title); ?>",
						artist:"<? echo $artist; ?>",					
						mp3:"http://cs130.collegeroots.com/listen/<? echo $song_id; ?>/"
					},
                  	 <? 
					}
				}
		break;
	case "test2":
		break;
}
?>
], {
		swfPath: "../../jPlayer/js/Jplayer.swf",	<? // Location of flash file ?>
		supplied: "mp3",
		wmode: "window",
		solution: "flash, html",	<? // Flash with HTML5 fallback ?>
        ready: function() {
        	<? // Use AJAX to load song likes ?>
			$.ajax( {
				type: "POST",
				url: '../../jPlayer/like/load_song_likes.php',
				data: {location: '<? echo $location; ?>'},
				success: function(message) {
                	<? // Execute the resulting javascript code; avoid use of eval() ?>
					var tempFunction = new Function(message);	
                    tempFunction();				
				}
			});
		}
	});