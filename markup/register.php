<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="../style/login.css">
    <link rel="stylesheet" href="../style/navbar.css">
    <link rel="stylesheet" href="../style/reset.css">
    <script src="../script/navbar.js" defer></script>
</head>

<body>
    <?php require_once "../components/navbar.php" ?>

    <form method="post" action="../handlers/register-form.php">

        <?php require_once "../components/register-info.php" ?>

        <label for="email">E-mail</label><br>
        <input type="text" name="email"><br>

        <label for="username">Username</label><br>
        <input type="text" name="username"><br>

        <label for="password">Password</label><br>
        <input type="text" name="password"><br>

        <label for="conf-password">Confirm Password</label><br>
        <input type="text" name="conf-password"><br>

        <input type="submit" value="Register">

    </form>


</body>

</html>