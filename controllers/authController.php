<?php
require_once '../config/dbconnect.php';
require_once '../models/User.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

class AuthController {
    private $userModel;

    public function __construct($db) {
        $this->userModel = new User($db);
    }

    public function register($username, $password) {
        return $this->userModel->register($username, $password);
    }

    public function login($username, $password) {
        $userId = $this->userModel->login($username, $password);
        if ($userId) {
            $_SESSION['user_id'] = $userId;
            $_SESSION['username'] = $username;
            return true;
        }
        return false;
    }

    public function logout() {
        session_unset();
        session_destroy();
        header('Location: ../views/login.php');
        exit();
    }
}

if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    $authController = new AuthController($connection);
    $authController->logout();
}
?>
