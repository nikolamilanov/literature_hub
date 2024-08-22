<?php
session_start();
session_destroy();
header('Location: ../markup/index.php');
die();