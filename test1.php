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
<script type="text/javascript" src="globals/include/js/ajax_form/jquery.form.js"></script>
<script type="text/javascript">
<? // When the page is ready, load the playlist into jPlayer using AJAX ?>
$().ready(function(){
	$.ajax({
		type: "POST",
		url: "jPlayer/load_playlist.php",
		data: {location: 'test1'},
		success: function(message) {
			<? // Execute the resulting javascript code; avoid use of eval() ?>
			var tempFunction = new Function(message);
			tempFunction();
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
	<? // HTML structure for jPlayer; actual playlist info will be dynamically loaded in ?>
	<div id="jquery_jplayer_1" class="jp-jplayer"></div>
		<div id="jp_container_1" class="jp-audio">
			<div class="jp-type-playlist">
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
				<div class="jp-playlist">
					<ul>
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