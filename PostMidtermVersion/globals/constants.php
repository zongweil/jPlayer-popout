<?

// Database constants

define("DB_SERVER", "localhost");
define("DB_USER", "colleg69_cs130");
define("DB_PASS", "CodeComplete");
define("DB_NAME", "colleg69_cs130");

$db_link = mysql_connect(DB_SERVER,DB_USER,DB_PASS) or die('Unable to establish a DB connection');
mysql_select_db(DB_NAME,$db_link);

// Function to read the audio file into jPlayer

if(!function_exists('smartReadFile')) {
	include('smartReadFile.php'); 
}
?>