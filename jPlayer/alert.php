<? 
include($_SERVER['DOCUMENT_ROOT'] . '/globals/constants.php');
include($_SERVER['DOCUMENT_ROOT'] . '/globals/session.php');

$query = "select * from user_playlist_songs";
$result=mysql_query($query);
$row = mysql_fetch_row($result);
    var_dump($row);

?>
