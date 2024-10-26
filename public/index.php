<?php
session_start();

if (isset($_SESSION['user_id'])) {
    if (!file_exists('../views/tasks.php')) {
        die("Error: tasks.php not found in views.");
    }
    header('Location: ../views/tasks.php');
} else {
    if (!file_exists('../views/login.php')) {
        die("Error: login.php not found in views.");
    }
    header('Location: ../views/login.php');
}
exit();
