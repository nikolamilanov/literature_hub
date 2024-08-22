<?php

if (isset($_GET['error'])) {
    if ($_GET['error'] == 'emptyfields') {
        echo '<p style="color: red;" class="message">Please fill in all fields!</p>';
    } elseif ($_GET['error'] == 'passwordsmatch') {
        echo '<p style="color: red;" class="message">The passwords dont match!</p>';
    } elseif ($_GET['error'] == 'userexists') {
        echo '<p style="color: red;" class="message">The username is already taken!</p>';
    }
}
