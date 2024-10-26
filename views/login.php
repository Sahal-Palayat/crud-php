<?php
session_start();
require_once '../config/dbconnect.php';
require_once '../controllers/AuthController.php';

if (isset($_SESSION['user_id'])) {
    header('Location: tasks.php');
    exit();
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $authController = new AuthController($connection);
    if ($authController->login($_POST['username'], $_POST['password'])) {
        header('Location: tasks.php');
        exit();
    } else {
        $error = 'Invalid username or password.';
    }
}

ob_start();
?>
<div class="flex justify-center items-center h-screen bg-gray-100">
    <div class="bg-white p-8 rounded-lg shadow-lg w-96">
        <h2 class="text-2xl font-bold mb-6 text-center">Login</h2>
        <form method="POST">
            <div class="mb-4">
                <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                <input type="text" name="username" id="username" required class="mt-1 block w-full">
            </div>
            <div class="mb-6">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" id="password" required class="mt-1 block w-full">
            </div>
            <button type="submit" class="w-full bg-blue-500 text-white">Login</button>
        </form>
        <?php if ($error): ?>
            <p class="text-red-500 text-center mt-4"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>
    </div>
</div>
<?php
$content = ob_get_clean();
include 'layout.php';
?>
