<? 
include($_SERVER['DOCUMENT_ROOT'] . '/globals/constants.php'); 
include($_SERVER['DOCUMENT_ROOT'] . '/globals/session.php');

// Get the song ID
$song_id = $_GET['sid'];

// Get the song info of that ID
$query = mysql_query("SELECT title,song_link FROM songs WHERE id='$song_id'");
$row = mysql_fetch_array($query);
$title = $row['title'];
$song_link = $row['song_link'];
$song_file = SRV_ROOT . $song_link;	

// Read the song file
smartReadFile($song_file,$title,'audio/mpeg');
 
?>