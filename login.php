<?php
    session_start();
    require_once "pdo.php";
    if (isset($_POST["email"]) && isset($_POST["password"])){
        $sql = "SELECT * FROM users WHERE email = :email AND password = :password";
        if (strpos($_POST["email"], '@') == false)
        {
            $error = "Insert a valid email fromat";
            error_log($error);
        }else{
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array(":email"=>$_POST["email"],":password"=>$_POST["password"]));
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row !== false) {
                $_SESSION['id'] = $row['id'];
                header("Location: autos.php");
                error_log("Login success ".$_POST['email']);
                return;
            } else {
                $error = "Incorrect email or password.";
                error_log($error);
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fouad Azar</title>
</head>
<body>
    <h1>Please Login</h1>
    <?php
        if (isset($error)) {
            echo '<p style="color: red;">'.htmlentities($error).'</p>';
        }
    ?>
    <form method="post">
        <p>Email: <input type="text" name="email" size="40"></p>
        <p>Password: <input type="password" name="password" size="40"></p>
        <p><input type="submit" value="Log In"></p>
    </form>
    
</body>
</html>