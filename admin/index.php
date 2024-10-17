<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin panel</title>
    <link rel="stylesheet" href="../style/reset.css">
    <link rel="stylesheet" href="../style/navbar.css">
    <link rel="stylesheet" href="../style/admin-aside-menu.css">
    <script src="../script/navbar.js" defer></script>
    <script src="../script/admin-aside-menu.js" defer></script>

    
    <link rel="stylesheet" href="../style/table.css">
    <script src="../script/fetch-creations-table.js" defer></script>
    <script src="../script/forms.js" defer></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>

<body>
    <?php require_once "../components/navbar.php" ?>
    <?php require_once "../components/admin-aside-menu.php" ?>
    <main>
        <?php require_once "../components/creations-table.php" ?>
    </main>


</body>

</html>