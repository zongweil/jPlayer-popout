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
	<select id="user_playlists">
    <?
		while($row = mysql_fetch_array($playlist_query))
		{
			$playlist_id = $row['playlist_id'];
			$title = $row['title'];
			?>
            <option value="<? echo $playlist_id; ?>"><? echo $title; ?></option>
        <?
		}
		?>
    </select>
	<input type="button" name="load_button" value="Load" onclick="loadPlaylist()" />
<? } ?>