<? 
include($_SERVER['DOCUMENT_ROOT'] . '/globals/constants.php');
include($_SERVER['DOCUMENT_ROOT'] . '/globals/session.php');

if(!$_SESSION['id'])
	die("No user ID.");
	
$playlist_query = mysql_query("SELECT playlist_id,title FROM user_playlists WHERE user_id = " . $_SESSION['id']);
if(mysql_num_rows($playlist_query) == 0)
{
	?>
	You do not have any saved playlists.	
    <?
}
else {
?>
	<select multiple="multiple" id="add_select" title="Select a playlist">
		<?
			while ($row = mysql_fetch_array($playlist_query)) {
				$p_title = $row['title'];
				$p_id = $row['playlist_id'];
				?>
					<option value="<? echo $p_id; ?>"> <? echo $p_title ?> </option>
				<?
			}
		?>
		</select>
		<input type="button" name="add_button" value="Add to Playlist" onclick="addPlaylist()" />
<? } ?>