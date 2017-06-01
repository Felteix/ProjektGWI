<!DOCTYPE HTML>
<html>
<head>
    <style>
        .error {color: #FF0000;}
    </style>
</head>
<body>

<?php
// define variables and set to empty values
$usernameErr = $emailErr = $pass1Err = $pass2Err = "";
$username = $email = $pass1 = $pass2 = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"])) {
        $usernameErr = "Eingabe vom Benutzername ist pflicht!";
    } else {
        $name = test_input($_POST["name"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
            $usernameErr = "Only letters and white space allowed";
        }
    }
    if ($pass1 != $pass2)
    {
        echo "Die beiden Passwörter stimmen nicht überein!";
    }
    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }
    }
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<h2>Registrierung</h2>
<p><span class="error">* Pflichtfelder.</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    Benutzername: <input type="text" name="username">
    <span class="error">* <?php echo $usernameErr;?></span>
    <br><br>
    E-mail: <input type="text" name="email">
    <span class="error">* <?php echo $emailErr;?></span>
    <br><br>
    Passwort: <input type="password" name="pass1">
    <span class="error"><?php echo $pass1Err;?></span>
    <br><br>
    Passwort bestätigen: <input type="password" name="pass2">
    <span class="error"><?php echo $pass2Err;?></span>
    <br><br>


    <input type="submit" name="submit" value="Abschicken">
</form>

<?php
echo "<h2><u>Deine Eingabe:</u></h2>";
echo $username;
echo "<br>";
echo $email;
echo "<br>";
echo $pass1;
echo "<br>";
echo $pass2;
echo "<br>";
?>

</body>
</html>