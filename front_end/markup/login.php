<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../style/style.css">

</head>

<body>


    <form method="post" action="../../back_end/login-form-handler.inc.php">

        <?php require_once "../components/login-info-component.php" ?>

        <label for="email">E-mail</label><br>
        <input type="text" name="email"><br>

        <label for="password">Password</label><br>
        <input type="text" name="password"><br>

        <input type="submit" value="Login">

    </form>

</body>

</html>