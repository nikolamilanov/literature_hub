<?php

if (!isset($_SESSION['userId'])) {
    function displayAction()
    {
        echo "<p>Please log in or register in order to contribute to the table!</p>";
    }
} else {
    require_once "../../back_end/database-handler.inc.php";

    // Fetch writers data
    $sqlSelectWriters = "SELECT * FROM writers;";
    $stmt = $pdo->prepare($sqlSelectWriters);
    $stmt->execute();

    $writersData = $stmt->fetchAll();

    // Prepare options for the writer select input
    $writerOptions = '';
    foreach ($writersData as $value) {
        $writerOptions .= '<option value="' . $value['writer_id'] . '">'
            . $value['writer_name'] . '</option>';
    }

    // Fetch creations data
    $sqlSelectCreations = "SELECT * FROM creations WHERE is_deleted = 0;";
    $stmt = $pdo->prepare($sqlSelectCreations);
    $stmt->execute();

    $creationsData = $stmt->fetchAll();

    // Prepare options for the creation select input
    $creationOptions = '';
    foreach ($creationsData as $value) {
        $creationOptions .= '<option value="' . $value['creation_id'] . '">'
            . $value['creation_name'] . '</option>';
    }

    $userRole = $_SESSION['userRole'];
    switch ($userRole) {
        //User role
        case "user":
            function displayAction($writerOptions, $creationOptions)
            {
                //User create form
                echo <<<HTML
                <div class="form-wrapper">
                    <button class="user-create-button">Add a new record</button>
                    <div id="user-create-form" class="form-content">
                        <form method="post" action="" class="user-create-form">
                            <label for="creation">creation</label><br>
                            <input type="text" name="creation"><br>
                    
                            <label for="genre">genre</label><br>
                            <input type="text" name="genre"><br>
                    
                            <label for="writer">writer</label><br>
                            <select name="writer">                               
                                $writerOptions
                            </select><br>
                    
                            <label for="date">date</label><br>
                            <input type="date" name="date">

                            <input type="submit">
                        </form>
                    </div>
                </div>
                HTML;
            }
            break;
        //Teacher role    
        case "teacher":
            function displayAction($writerOptions, $creationOptions)
            {
                //Teacher create form
                echo <<<HTML
                <div class="form-wrapper">
                    <button class="admin-create-button">Add a new record</button>
                    <div id="admin-create-form" class="form-content">
                        <form method="post" action="/literature_hub/back_end/table_management/admin-create-form-handler.php" class="admin-create-form">
                            <label for="creation">creation</label><br>
                            <input type="text" name="creation"><br>
                    
                            <label for="genre">genre</label><br>
                            <input type="text" name="genre"><br>
                    
                            <label for="writer">writer</label><br>
                            <select name="writer">
                                $writerOptions
                            </select><br>
                    
                            <label for="date">date</label><br>
                            <input type="date" name="date">

                            <input type="submit">
                        </form>
                    </div>
                </div>
                HTML;

                //Teacher update form
                echo <<<HTML
                <div class="form-wrapper">
                    <button class="admin-update-button">Update a record</button>
                    <div id="admin-update-form" class="form-content">
                        <form method="post" action="/literature_hub/back_end/table_management/admin-update-form-handler.php" class="admin-update-form">
                            <label for="creation-id">creation to update</label><br>
                                <select name="creation-id">
                                    $creationOptions
                                </select><br>
                            <label for="creation">creation</label><br>
                            <input type="text" name="creation"><br>
                    
                            <label for="genre">genre</label><br>
                            <input type="text" name="genre"><br>
                    
                            <label for="writer">writer</label><br>
                            <select name="writer">
                                $writerOptions
                            </select><br>
                    
                            <label for="date">date</label><br>
                            <input type="date" name="date">

                            <input type="submit">
                        </form>
                    </div>
                </div>
                HTML;

            }
            break;
        //Admin role
        case "admin":
            function displayAction($writerOptions, $creationOptions)
            {
                //Admin create form
                echo <<<HTML
                <div class="form-wrapper">
                    <button class="admin-create-button">Add a new record</button>
                    <div id="admin-create-form" class="form-content">
                        <form method="post" action="/literature_hub/back_end/table_management/admin-create-form-handler.php" class="admin-create-form">
                            <label for="creation">creation</label><br>
                            <input type="text" name="creation"><br>
                    
                            <label for="genre">genre</label><br>
                            <input type="text" name="genre"><br>
                    
                            <label for="writer">writer</label><br>
                            <select name="writer">
                                $writerOptions
                            </select><br>
                    
                            <label for="date">date</label><br>
                            <input type="date" name="date">

                            <input type="submit">
                        </form>
                    </div>
                </div>
                HTML;

                //Admin update form
                echo <<<HTML
                <div class="form-wrapper">
                    <button class="admin-update-button">Update a record</button>
                    <div id="admin-update-form" class="form-content">
                        <form method="post" action="/literature_hub/back_end/table_management/admin-update-form-handler.php" class="admin-update-form">
                            <label for="creation-id">creation to update</label><br>
                            <select name="creation-id">
                                $creationOptions
                            </select><br>
                       
                            <label for="creation">creation</label><br>
                            <input type="text" name="creation"><br>
                    
                            <label for="genre">genre</label><br>
                            <input type="text" name="genre"><br>
                    
                            <label for="writer">writer</label><br>
                            <select name="writer">
                                $writerOptions
                            </select><br>
                    
                            <label for="date">date</label><br>
                            <input type="date" name="date">

                            <input type="submit">                            
                        </form>
                    </div>
                </div>
                HTML;

                //Admin delete form
                echo <<<HTML
                <div class="form-wrapper">
                    <button class="admin-delete-button">Delete a record</button>
                    <div id="admin-delete-form" class="form-content">
                        <form method="post" action="/literature_hub/back_end/table_management/admin-delete-form-handler.php" class="admin-delete-form">
                            <label for="creation-id">creation to delete</label><br>
                            <select name="creation-id">
                                $creationOptions
                            </select><br>

                            <input type="submit">
                        </form>
                    </div>
                </div>
                HTML;
            }
            break;
        default:
            function displayAction()
            {
                echo "<p>Error: Invalid user role. Please contact the system administrator.</p>";
            }
            break;
    }
}
?>

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
    <?php
    if (isset($_SESSION['userId'])) {

        displayAction($writerOptions, $creationOptions);
    } else {
        displayAction();
    }
    ?>

</div>