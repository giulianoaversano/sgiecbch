

<?php
session_start();
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: index.php");
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
        $sql = "SELECT id, username, nombres, apellido_paterno, apellido_materno, password, nivel, compania FROM Users WHERE username = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            $param_username = $username;

            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);

                if(mysqli_stmt_num_rows($stmt) == 1){
                    mysqli_stmt_bind_result($stmt, $id, $username, $nombres, $apellido_paterno, $apellido_materno, $hashed_password, $nivel, $compania);
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
                            $_SESSION["compania"] = $compania;


                            header("location: index.php");
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
    <?php include('includes/title.inc');?>
    <link rel="stylesheet" href="style.css">
    <style>
        body{ font-family: Verdana; }
    </style>

    <style>
        .center{
            text-align: center;


        }
        body{
            background-image: url('img/logo_cuerpo.png');
            background-repeat: no-repeat;
            background-position: center;
            background-position-x: center;
            background-position-y: center;
            alignment: center;


        }
    </style>

</head>
<body>
<div class="container">
<table style="width: 100%"  border="0">
    <tbody>
    <tr>
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
<br>
    <p></p>

    <?php
    if(!empty($login_err)){
        echo '<div class="alert alert-danger">' . $login_err . '</div>';
    }
    ?>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group">
            <label style="font-size: 24px"><b>Usuario</b></label>
            <input style="font-size: 24px" type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
            <span class="invalid-feedback"><?php echo $username_err; ?></span>
        </div><br><br>
        <div class="form-group">
            <label style="font-size: 24px"><b>Contraseña</b></label>
            <input style="font-size: 24px" type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
            <span class="invalid-feedback"><?php echo $password_err; ?></span>
        </div><br><br>
        <div class="form-group">
            <input style="font-size: 24px; color: #4CAF50; text-decoration: #3d3e47" type="submit" class="btn btn-primary" value="Ingresar">
        </div>

    </form>
</div>
</div>
</body>
</html>