<html>
<body>

<?php
if ($_POST["USER"] && $_POST["API_KEY"]) {

# set up global variables
$USER = $_POST["USER"];
$API_KEY = $_POST["API_KEY"];

# make sure include_path contains cloudfiles
$old_path = ini_get("include_path");
if ($old_path) {
    ini_set("include_path", ".:..:".$old_path);
} else {
    ini_set("include_path", ".:..");
}

# fire off tests based on form input
require("tests.php");

} else {
?>

<form action="#" method="POST">
<p>See the README file included in the "tests" directory.</p>

<p>Enter Mosso username and API Access Key to run the tests:</p>
<ul>
<table border="0" cellpadding="1">
    <tr>
      <td>Username:</td>
      <td><input type="text" size="35" name="USER"
        value="<?php echo $_POST["USER"]; ?>" /></td>
    </tr>
    <tr>
      <td>API Key:</td>
      <td><input type="text" size="35" name="API_KEY"
        value="<?php echo $_POST["API_KEY"]; ?>" /></td>
    </tr>
</table>
</ul>
<br />
<input type="submit" value="Submit" />
<input type="reset" value="Reset" />
</form>

<?php
} // close: } else {
?>

</body>
</html>
