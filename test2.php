<? 
include($_SERVER['DOCUMENT_ROOT'] . '/globals/constants.php');
include($_SERVER['DOCUMENT_ROOT'] . '/globals/session.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Test Page 2</title>
<link rel="stylesheet" type="text/css" href="test.css"/>
<link rel="stylesheet" type="text/css" href="jPlayer/like/like.css"/>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript" src="jPlayer/js/jquery.jplayer.js"></script>
<script type="text/javascript" src="jPlayer/js/jplayer.playlist.js"></script>
<script type="text/javascript" src="globals/include/js/ajax_form/jquery.form.js"></script>
<script src="http://yui.yahooapis.com/3.3.0/build/yui/yui-min.js"></script>
<script type="text/javascript">
YUI({}).use("node-base", function (Y) {
    var CHILD_WINDOW_NAME = "jPlayer Popout", // It's important to have a consistent name.
        CHILD_WINDOW_URL  = "jPlayer-pop.php",
        CHILD_WINDOW_ATTRS = "width=800,height=600",
        win = null;
	
	<? // Handle plays ?>
	var handlePlayClick =function (e){
        // Window object is existing.
		var node= e.currentTarget;
		var initialSongID = node.get("parentNode").get("id");
        if (win) {
            if (!win.closed) {
                // Do nothing because child window is open.
                
                win.addSong('play',node.get("parentNode").get("id"));
            win.focus();
            } else {
                // Open child window again.
				win = null;
                win = window.open(CHILD_WINDOW_URL, CHILD_WINDOW_NAME, CHILD_WINDOW_ATTRS);
				$(win).ready(function() {$(win).focus();});
				
				$.ajax( {
					type: "POST",
					url: 'jPlayer/initial_song.php',
					data: {id: initialSongID}
				});
            }
        } else {
				$.ajax( {
					type: "POST",
					url: 'jPlayer/initial_song.php',
					data: {id: initialSongID}
				});
            // Trick - Try to reconnect to child window if it really has.
            // This works in major browsers.
            win = window.open("", CHILD_WINDOW_NAME, CHILD_WINDOW_ATTRS);
            if (win.location.href === "about:blank") {
                win = window.open(CHILD_WINDOW_URL, CHILD_WINDOW_NAME, CHILD_WINDOW_ATTRS);  
            } else {
				win.addSong('play',node.get("parentNode").get("id"));
                win.focus();
            }
        }

        // Learned - You can get some attributes immediately after window.open() execution.
        // You don't have to wait use setTimeout.
  
    };
	
	<? // Handle queues ?>
	var handleQueueClick =function (e){
        // Window object is existing.
		var node= e.currentTarget;
		var initialSongID = node.get("parentNode").get("id");
        if (win) {
            if (!win.closed) {
                // Do nothing because child window is open.
                
                win.addSong('queue',node.get("parentNode").get("id"));
            win.focus();
            } else {
                // Open child window again.
                win = window.open(CHILD_WINDOW_URL, CHILD_WINDOW_NAME, CHILD_WINDOW_ATTRS);
				$(win).ready(function() {$(win).focus();});
				
				$.ajax( {
					type: "POST",
					url: 'jPlayer/initial_song.php',
					data: {id: initialSongID}
				});
            }
        } else {
			
			$.ajax( {
					type: "POST",
					url: 'jPlayer/initial_song.php',
					data: {id: initialSongID}
				});
            // Trick - Try to reconnect to child window if it really has.
            // This works in major browsers.
            win = window.open("", CHILD_WINDOW_NAME, CHILD_WINDOW_ATTRS);
            if (win.location.href === "about:blank") {
                win = window.open(CHILD_WINDOW_URL, CHILD_WINDOW_NAME, CHILD_WINDOW_ATTRS);  
            } else {
                win.addSong('queue',node.get("parentNode").get("id"));
                win.focus();
            }
        }

        // Learned - You can get some attributes immediately after window.open() execution.
        // You don't have to wait use setTimeout.
  
    };
	
	Y.all(".play").on('click', handlePlayClick);
	
	Y.all(".queue").on('click', handleQueueClick);
});

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

<h2>Page 2</h2>
<ul class="song_table">
	<? 
	$songs_query = mysql_query("SELECT id, title, artist FROM songs WHERE artist='Classical Music'");
	while($row = mysql_fetch_array($songs_query))
	{
		$song_id = $row['id'];
		$title = $row['title'];
		$artist = $row['artist'];
		?>
        <li id="<? echo $song_id; ?>" class="song">
        	<div class="title" ><? echo $title; ?></div>
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

<a href="test1.php">Navigate to another page</a>

</body>
</html>
