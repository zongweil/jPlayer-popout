<? 
include($_SERVER['DOCUMENT_ROOT'] . '/globals/constants.php');
include($_SERVER['DOCUMENT_ROOT'] . '/globals/session.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Test Page 1</title>
<link rel="stylesheet" type="text/css" href="jPlayer/like/like.css"/>
<link rel="stylesheet" type="text/css" href="test.css"/>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript" src="globals/include/js/ajax_form/jquery.form.js"></script>
<script type="text/javascript">
$().ready(function(){
	<? // Load song likes ?>
	$.ajax( {
		type: "POST",
		url: '../../jPlayer/like/load_song_likes.php',
		data: {location: 'test1'},
		success: function(message) {
        	<? // Execute the resulting javascript code; avoid use of eval() ?>
			var tempFunction = new Function(message);	
            tempFunction();				
		}
	});
	$('#login_form').ajaxForm( { 
	 		target: '#login_output'
     }); 
	 $('#logout_form').ajaxForm( { 
	 		success: function() {
				location.reload();	
			}
     }); 
});

<? // Function to check if the user is logged in ?>
function logged_in(formData, jqForm, options) { 
	<? 
	if(!$_SESSION['id']) {
	?> 
		alert("Log in please!");
		return false;
	<? }?>
}
</script>
</head>

<body>

<ul class="song_table">
	<? 
	$songs_query = mysql_query("SELECT id, title, artist FROM songs WHERE artist='Miaow'");
	while($row = mysql_fetch_array($songs_query))
	{
		$song_id = $row['id'];
		$title = $row['title'];
		$artist = $row['artist'];
		?>
        <li id="song-<? echo $song_id; ?>" class="song">
        	<div class="title"><? echo $title; ?></div>
            <div class="artist"><? echo $artist; ?></div>
            <div class="play"></div>
            <div class="queue"></div>
            <div class="like">
            	<form class='song-like song-like-<? echo $song_id; ?>' method='post' action='../../jPlayer/like/toggle_like.php'>
                	<input type='hidden' name='post_id' value='<? echo $song_id; ?>' />
                    <button type='submit' name='submit' class='song-like-submit song-like-button-<? echo $song_id; ?>'></button>
                </form>
            </div>
        </li>
        <?
	}
	?>
</ul>	<? // Song table ul ?>


<? // Log in form if user is not logged in ?>

<? if($_SESSION['id'] == null) { ?>
<div id="login_output" class="output"></div>
<form id="login_form" action="../globals/login.php" method="post">
	<p>Email: <br /><input type="text" name="login_email" size="32" /></p>
	<p>Password: <br /><input type="password" name="login_password" size="32" /></p>
	<p><input type="submit" name="submit" value="Login" /></p>
    
</form>
<? } ?>

<? // User info if user is logged in ?>

<? if($_SESSION['id']){ ?>

	Hello <? echo $_SESSION['email']; ?>!
    
    <? // Logout form ?>
    <form id="logout_form" method="post" action="../globals/logout.php"><input type="submit" name="submit" value="Logout" /></form></div> 
    
<? } ?>

</body>

</html>