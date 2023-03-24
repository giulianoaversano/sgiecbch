<head>
    <meta charset="UTF-8">
    <?php include('../includes/title.inc');?>
    <?php
    include ('../clock.php')
    ?>
</head>
<?php
include ('../dbconnection.php');
require_once "config.php";

session_start();
$compania='Comandancia';
include ('../header.php');


if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

$user = "SELECT compania FROM Users where username='$_SESSION[username]'";
if ($resuser = $conn->query($user)) {
    while ($ruser = $resuser->fetch_assoc()) {
        $usrcia = $ruser['compania'];
    }
}



if(!isset($_SESSION["nivel"]) || ($_SESSION["nivel"] < 3 AND $usrcia != $compania)) {
    echo '<script> alert("Tu usuario no cuenta con el permiso para acceder a esta página");window.location = "../index.php";  </script>';
    exit;
}

if(!isset($_SESSION["nivel"]) || ($_SESSION["nivel"] = 3)) {


    $username = $password = $confirm_password = "";
    $username_err = $password_err = $confirm_password_err = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (empty(trim($_POST["username"]))) {
            $username_err = "Please enter a username.";
        } else {
            $sql = "SELECT id FROM Users WHERE username = ?";

            if ($stmt = mysqli_prepare($link, $sql)) {
                mysqli_stmt_bind_param($stmt, "s", $param_username);

                $param_username = trim($_POST["username"]);

                if (mysqli_stmt_execute($stmt)) {
                    mysqli_stmt_store_result($stmt);

                    if (mysqli_stmt_num_rows($stmt) == 1) {
                        $username_err = "This username is already taken.";
                    } else {
                        $username = trim($_POST["username"]);
                    }
                } else {
                    echo "Oops! Something went wrong. Please try again later.1";
                }
                mysqli_stmt_close($stmt);
            }
        }

        if (empty(trim($_POST["password"]))) {
            $password_err = "Please enter a password.";
        } elseif (strlen(trim($_POST["password"])) < 6) {
            $password_err = "Password must have atleast 6 characters.";
        } else {
            $password = trim($_POST["password"]);
        }

        if (empty(trim($_POST["confirm_password"]))) {
            $confirm_password_err = "Please confirm password.";
        } else {
            $confirm_password = trim($_POST["confirm_password"]);
            if (empty($password_err) && ($password != $confirm_password)) {
                $confirm_password_err = "Password did not match.";
            }
        }

        if (empty($username_err) && empty($password_err) && empty($confirm_password_err)) {

            $sql = "INSERT INTO Users (username, password, nombres, apellido_paterno, apellido_materno, email, nivel,compania) VALUES (?, ?, ?, ?, ?, ?, ?,?)";

            if ($stmt = mysqli_prepare($link, $sql)) {
                mysqli_stmt_bind_param($stmt, "ssssssss", $param_username, $param_password, $param_nombres, $param_apaterno, $param_amaterno, $param_email, $param_nivel, $param_compania);

                $param_username = $username;
                $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
                $param_nombres = $_POST["nombres"];
                $param_apaterno = $_POST["apaterno"];
                $param_amaterno = $_POST["amaterno"];
                $param_email = $_POST["email"];
                $param_nivel = $_POST["nivel"];
                $param_compania = $_POST["compania"];
                if (mysqli_stmt_execute($stmt)) {
                    header("location: login.php");
                } else {
                    echo "Oops! Something went wrong. Please try again later.2";
                }
                mysqli_stmt_close($stmt);
            }
        }
        mysqli_close($link);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CBCH - Nuevo Usuario</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
<h1 align="center">Registrar Nuevo Admin</h1>
<h2 align="center"><p>Complete la información a continuación.</p></h2>
<div class="wrapper">

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group">
            <label>RUT (Formato: 12345678)</label>
            <input type="text" maxlength="8" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
            <span class="invalid-feedback"><?php echo $username_err; ?></span>

        </div>
        <div class="form-group">
            <label>Nombres</label>
            <input type="text" name="nombres" class="form-control">
        </div>
        <div class="form-group">
            <label>Apellido Paterno</label>
            <input type="text" name="apaterno" class="form-control">
        </div>
        <div class="form-group">
            <label>Apellido Materno</label>
            <input type="text" name="amaterno" class="form-control">
        </div>
        <div class="form-group">
            <label>e-Mail</label>
            <input type="text" name="email" class="form-control">
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
            <span class="invalid-feedback"><?php echo $password_err; ?></span>
        </div>
        <div class="form-group">
            <label>Confirm Password</label>
            <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
            <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
        </div>        <div class="form-group">
            <label>Nivel</label>
            <select  name="nivel" id="nivel">
                <optgroup label="Seleccione">
                    <option value="1">Básico</option>
                    <option value="2">Gestor</option>
                    <option value="3">Admin</option>
                </optgroup>
            </select>
        </div>

        <?php
        $companias = $conn -> query ("SELECT * FROM companias");

        echo '
<table><tr>
<td><b>Compañía</b></td></tr><tr>
   	<td><h1><select style="height: 30px; font-size: 16px" name="compania">
  		<optgroup label="Seleccione">
  		<option selected=""></option>
	    ';
while ($setcia = mysqli_fetch_array($companias)) {
    echo '<option value="' . $setcia["compania"] . '">' . $setcia["compania"] . '</option>';
}
echo '
    <option value="CAT">CAT</option>;
		  </optgroup>
			</select></h1>
			    </td>
			        </tr>
			            </table>';


        ?>


        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Submit">
            <input type="reset" class="btn btn-secondary ml-2" value="Reset">
        </div>
    </form>
</div>
</body>
</html>