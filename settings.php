<?php
//place this code in the pages, which you need to authenticate
session_start();
if (!isset($_SESSION['username'])) {
	header("location:index.php");
}
$username = $_SESSION['username'];
?>

<?php
	include ('header.php');
?>

<?php
$update = $_GET['update'];
$first_name = $_POST['full_name'];
$first_name = strip_tags($first_name);
$last_name = $_POST['last_name'];
$last_name = strip_tags($last_name);
$gender = $_POST['email'];

if ($update == 1 && !empty($_POST))// Checks if the form is submitted or not
{
	$success_update = mysql_query("UPDATE users SET firstname='$first_name', lastname='$last_name', email='$email' WHERE username='$username' ");
	if ($success_update) {
		echo '
<div class="alert alert-success">
Account Successfully updated!
</div>
';
	} else {
		echo '
<div class="alert">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
Failed to update
</div>
';

	}

}

$document_get = mysql_query("SELECT * FROM users WHERE username='$username'");
$match_value = mysql_fetch_array($document_get);
$firstname = $match_value['firstname'];
$lastname = $match_value['lastname'];
$email = $match_value['email'];
?>
<br/>

<div style="float:right">
	<a class="btn btn-info" href="dashboard.php" > Account </a><a class="btn btn-danger logout" href="logout.php" > Logout</a>
</div>

<fieldset>
	<legend>
		Welcome <?php echo $username; ?>,
	</legend>

	<br/>
	<br/>
	<form action="settings.php?update=1" method="post" name="myForm" onsubmit="return(validate());">
		<fieldset>
			<legend>
				Settings
			</legend>

			<label>First Name *</label>
			<input name="full_name" type="text" placeholder="Type something…" value="<?php echo $firstname; ?>" >
			<br/>
			<label>Last Name </label>
<<<<<<< HEAD
			<input name="last_name" type="text" placeholder="Type something…" value="<?php echo $lastname; ?>">
=======
			<input name="location" type="text" placeholder="Type something…" value="<?php echo $lastname; ?>">
>>>>>>> 88fbfe516f60ffee25b6b6e4f4f042446cb1386f
			<br/>
			<label>Email </label>
			<input name="email" type="text" placeholder="Type something…" value="<?php echo $email; ?>">
		

			<br/>
			<button type="submit" class="btn">
				Update
			</button>
		</fieldset>
	</form>
</fieldset>

<!--
Similarly you can also add password change field, I suggest to create separate form for this,
just make sure your encrypt the password using md5 before you save to database.

-->

<script>
	function validate() {

		if (document.myForm.full_name.value == "") {
			alert("Please provide your first name!");
			document.myForm.full_name.focus();
			return false;
		}

		return (true );
	}


	$('.logout').click(function() {
		return confirm("Are you sure you want to Logout?");
	})
</script>
<?php
	include ('footer.php');
 ?>
