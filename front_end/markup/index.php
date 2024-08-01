<!DOCTYPE html>
<html lang="en">
    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="../style/navbar.css">
    <link rel="stylesheet" href="../style/reset.css">
    <script src="../script/redirect.js" defer></script>
    <script src="../script/fetch-data.js" defer></script>
</head>

<body>
    <?php require_once "../components/navbar-component.php" ?>

    <form id="filter">

        <label for="filter-type">Filter by:</label>
        <select name="filter-type" id="filter-type">
            <option value="genre">Genre</option>
            <option value="writer">Writer</option>
            <option value="creation">Creation</option>
        </select>

        <input type="text" name="filter-value" id="filter-value" placeholder="Search">
        <input type="submit">
    </form>

    <div id="table-container"></div>

</body>

</html>