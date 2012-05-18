<? 
include($_SERVER['DOCUMENT_ROOT'] . '/globals/constants.php');
include($_SERVER['DOCUMENT_ROOT'] . '/globals/session.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Test Page 1</title>
<link rel="stylesheet" type="text/css" href="jPlayer/skin/blue.monday/jplayer.blue.monday.css"/>
<link rel="stylesheet" type="text/css" href="jPlayer/like/like.css"/>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript" src="jPlayer/js/jquery.jplayer.js"></script>
<script type="text/javascript" src="jPlayer/js/jplayer.playlist.js"></script>
<script type="text/javascript" src="jPlayer/dragdrop/jquery-ui-1.8.20.custom.min.js"></script>
<script type="text/javascript" src="globals/include/js/ajax_form/jquery.form.js"></script>
<script type="text/javascript" src="http://yui.yahooapis.com/3.3.0/build/yui/yui-min.js"></script>
<script type="text/javascript">
var old_index=0, new_index=0;
var old_array, new_array; //arrats of songid's before and after the dragdrop done.

YUI().use("node-base", function (Y) {
    var _openerUrl = window.opener.location.href;

    // Monitoring...
    Y.later(5000, null, function () {
        Y.log("checkClosed() is executed.");
        if (window.opener && window.opener.closed) {
            alert("Opener window is closed.");
        } else {
            try {
                if (_openerUrl !== window.opener.location.href) {
                    Y.log("Opener has go to different page.", "warn");
                } else {
                    Y.log("Opener is at the original page.");
                }
            } catch (e) {
                Y.log("Opener has go to different page and it's a different domain.", "warn");
            }
            Y.log("Opener window URL: ");
            Y.log(window.opener.location);
            Y.later(5000, null, arguments.callee);
        }
    });    
});

<? // When the page is ready, load the playlist into jPlayer using AJAX ?>
$().ready(function(){
	$.ajax({
		type: "POST",
		url: "jPlayer/load_playlist.php",
		data: {location: "playlist"},
		success: function(message) {
			<? // Execute the resulting javascript code; avoid use of eval() ?>
			var tempFunction = new Function(message);
			tempFunction();
		}
	});
});

<? // Function to check if the user is logged in?>
function logged_in(formData, jqForm, options) { 
	<? 
	if(!$_SESSION['id']) {
	?> 
		alert("Log in please!");
		return false;
	<? }?>
}

<? // Adds the song, given the type and songID ?>
function addSong(type, songID)
{  	
	$.ajax({
		type: "POST",
		url: "jPlayer/add_song.php",
		data: {type: type, songID: songID},
		success: function(message) {
			<? // Execute the resulting javascript code; avoid use of eval() ?>
			var tempFunction = new Function(message);
			tempFunction();
		}
	});
}

$(function() {
	$( "#sortable" ).sortable();
	$( "#sortable" ).disableSelection();
	$( "#sortable" ).bind("sortstop", function(event, ui) {
		
		new_index = $("#nested_2 ul li.jp-playlist-current").index();
		new_array = $( "#sortable" ).sortable('toArray');
		myPlaylist1.updateDragDropList(old_index, new_index, old_array, new_array);		
	});
});






function findOldIndexCurrent()
{
	old_array = $( "#sortable" ).sortable('toArray');
	old_index = $("#nested_2 ul li.jp-playlist-current").index();	
}



</script>
</head>

<body>

<? // HTML structure for jPlayer; actual playlist info will be dynamically loaded in ?>

<div id="jquery_jplayer_1" class="jp-jplayer"></div>
<div id="jp_container_1" class="jp-audio">
	<div id="nested_1" class="jp-type-playlist">
		<div class="jp-gui jp-interface">
			<ul class="jp-controls">
				<li><a href="javascript:;" class="jp-previous" tabindex="1">previous</a></li>
				<li><a href="javascript:;" class="jp-play" tabindex="1">play</a></li>
				<li><a href="javascript:;" class="jp-pause" tabindex="1">pause</a></li>
				<li><a href="javascript:;" class="jp-next" tabindex="1">next</a></li>
				<li><a href="javascript:;" class="jp-mute" tabindex="1">mute</a></li>
				<li><a href="javascript:;" class="jp-unmute" tabindex="1">unmute</a></li>
			</ul>
			<div class="jp-progress">
				<div class="jp-seek-bar">
					<div class="jp-play-bar"></div>
				</div>
			</div>
			<div class="jp-volume-bar">
				<div class="jp-volume-bar-value"></div>
			</div>
			<div class="jp-current-time"></div>
			<div class="jp-duration"></div>
       		<ul class="jp-toggles">
				<li><a href="javascript:;" class="jp-shuffle" tabindex="1">shuffle</a></li>
				<li><a href="javascript:;" class="jp-shuffle-off" tabindex="1">shuffle off</a></li>
			</ul>
		</div>
		<div id="nested_2"  class="jp-playlist">
			<ul id="sortable" onmousedown="findOldIndexCurrent()" ">
				<li></li>
			</ul>
		</div>
		<div class="jp-no-solution">
			<span>Update Required</span>
			To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.
		</div>
	</div>
</div>

</body>
</html>
