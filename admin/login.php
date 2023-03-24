<?php
session_start();
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: welcome.php");
    exit;
}

require_once "config.php";

$username = $password = "";
$username_err = $password_err = $login_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }

    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    if(empty($username_err) && empty($password_err)){
        $sql = "SELECT id, username, nombres, apellido_paterno, apellido_materno, password, nivel FROM Users WHERE username = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            $param_username = $username;

            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);

                if(mysqli_stmt_num_rows($stmt) == 1){
                    mysqli_stmt_bind_result($stmt, $id, $username, $nombres, $apellido_paterno, $apellido_materno, $hashed_password, $nivel, $estadoUser);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            session_start();
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;
                            $_SESSION["nombres"] = $nombres;
                            $_SESSION["apellido_paterno"] = $apellido_paterno;
                            $_SESSION["apellido_materno"] = $apellido_materno;
                            $_SESSION["nivel"] = $nivel;
                            $_SESSION["activo"] = $estadoUser;

                            header("location: welcome.php");
                        } else{
                            $login_err = "Invalid username or password.";
                        }
                    }
                } else{
                    $login_err = "Invalid username or password.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            mysqli_stmt_close($stmt);
        }
    }

    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <?php include('../includes/title.inc');?>
    <link rel="stylesheet" href="style.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
<table width="100%" border="0">
    <tbody>
    <tr>
        <td width="147"><img src="../img/logo_cuerpo.png" width="147" height="125" alt=""/></td>
        <td width="">
            <h2 align=center style=color:darkgray><b></b>CUERPO DE BOMBEROS DE CONCHALÍ-HUECHURABA<b></b></h2>
            <h3 align=center style=color:darkslategray><strong>AREA RESTRINGIDA</strong></h3>
        </td>

    </tr>
    </tbody>
</table>
<div class="wrapper">
    <h2>Login</h2>
    <p>Ingrese usuario y contraseña para identificarse.</p>
    <p>El acceso a este sitio se encuentra monitoreado. Su uso indebido será sancionado.</p>
    <?php echo 'IP - '. $_SERVER['REMOTE_ADDR']; ?>
    <p></p>

    <?php
    if(!empty($login_err)){
        echo '<div class="alert alert-danger">' . $login_err . '</div>';
    }
    ?>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
            <span class="invalid-feedback"><?php echo $username_err; ?></span>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
            <span class="invalid-feedback"><?php echo $password_err; ?></span>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Login">
        </div>

    </form>
</div>
</body>
</html>