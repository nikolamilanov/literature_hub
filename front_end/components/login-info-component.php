<?php

if (isset($_GET['error'])) {
    if ($_GET['error'] == 'emptyfields') {
        echo '<p style="color: red;" class="message">Please fill in all fields.</p>';
    } elseif ($_GET['error'] == 'invalidlogin') {
        echo '<p style="color: red;" class="message">Invalid username or password.</p>';
    }
}
if (isset($_GET['info'])) {
    if ($_GET['info'] == 'createdaccount') {
        echo '<p style="color: green;" class="message">Successfully created an account!</p>';
    }
}

