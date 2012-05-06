<? 
include($_SERVER['DOCUMENT_ROOT'] . '/globals/constants.php');

// Start the session
session_start();

// Create an array to hold errors
$err = array();

// Get the email and password
if(isset($_POST['login_email'])){$email = $_POST['login_email'];}
if(isset($_POST['login_password'])){$password = $_POST['login_password'];}

// Simple validation
if(strlen($email) < 1)
{
	$err[] = "Please enter an email address.";	
}

if(strlen($password) < 1)
{
	$err[] = "Please enter a password.";
}

// Check if the user exists
$check_user = mysql_query("SELECT id,password FROM users WHERE email = '$email'");
$row = mysql_fetch_array($check_user);
$id = $row['id'];
$db_password = $row['password'];

if(!$id)
{
	$err[]= "That email address is not registered.";
}

if($password != $db_password){
	$err[] = "Incorrect password.";
}
	
// If there are no errors
if(!count($err))
{
	$_SESSION['id'] = $id;	
	$_SESSION['email'] = $email;
	?>
    
    <? // Display a success box ?>
	<div class="success">You are now logged in.</div>
    
    <? // Reload page after 1 second ?>
    <script type="text/javascript">
		setInterval("location.reload()", 1000);
	</script>
    <?
}
if(count($err))
{
	$errors = implode('<br />',$err);
	?>
    
    <? // Display a failure box ?>
    <div class="failure"><? echo $errors; ?></div><?
}
exit;