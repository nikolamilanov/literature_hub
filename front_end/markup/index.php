<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="../style/navbar.css">
    <link rel="stylesheet" href="../style/table.css">
    <link rel="stylesheet" href="../style/reset.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="../script/navbar.js" defer></script>
    <script src="../script/fetch-data.js" defer></script>
</head>

<body>
    <?php require_once "../components/navbar-component.php" ?>
    <div class="table-wrapper">
        <form id="filter-form">

            <div class="filter-wrapper">
                <label for="filter-type">Filter by:</label>
                <select name="filter-type" id="filter-type">
                    <option value="genre">Genre</option>
                    <option value="writer">Writer</option>
                    <option value="creation">Creation</option>
                </select>
            </div>

            <input type="text" name="filter-value" id="filter-value" placeholder="Search">
            <button type=submit><i class="bi bi-search"></i></button>
        </form>

        <div id="table-container"></div>
    </div>

</body>

</html>