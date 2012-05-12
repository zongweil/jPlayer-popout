<?  	
include($_SERVER['DOCUMENT_ROOT'] . '/globals/constants.php'); 
include($_SERVER['DOCUMENT_ROOT'] . '/globals/session.php');

// Get the location of the calling page, as well as the user id
$location = $_POST['location'];
$id = $_SESSION['id'];
if(!$location)
	die();

switch($location)
{
	case "test1":
		// Get all songs by the artist Miaow
		$song_query = mysql_query("SELECT id,title,artist FROM songs WHERE artist='Miaow' ORDER BY title ASC");
		break;
	case "test2":
		// Placeholder until we set up test2.php
		break;
}

// For each song, check if it is liked
while($row = mysql_fetch_array($song_query))
{
	$song_id = $row['id'];
	$like_query = mysql_query("SELECT user_id FROM song_likes WHERE user_id='{$_SESSION['id']}' AND song_id='$song_id'");
	if(mysql_num_rows($like_query) == 1) {
	?>
    	<? // Make the like button pressed ?>
		$('.song-like-button-<? echo $song_id; ?>').addClass("song-like-pressed");
	<? } ?>
    	<? // Create an event listener that will send an AJAX request when the button is pressed ?>
		$('.song-like-<? echo $song_id; ?>').ajaxForm( { 
        	<? // Check if the user is logged in first ?>
			beforeSubmit: logged_in,
			success: function() {
            	<? // If the song was liked, unlike it ?>
				if($('.song-like-button-<? echo $song_id; ?>').hasClass("song-like-pressed"))
				{
					$('.song-like-button-<? echo $song_id; ?>').removeClass("song-like-pressed");
				}
                <? // Otherwise, like the song ?>
				else
				{
					$('.song-like-button-<? echo $song_id; ?>').addClass("song-like-pressed");
				}
				return false;
			}
		});
<? 
	}		
?>