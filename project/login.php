<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === 'admin' && $password === 'admin123') {
        $_SESSION['user'] = $username;
        header('Location: pages/dashboard.php');
        exit;
    } else {
        $error = "Invalid username or password!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/output.css">
    <title>Login</title>
</head>
<body class="bg-gray-900 flex justify-center items-center h-screen">
    <form method="POST" class="bg-gray-800 p-6 rounded shadow-md text-white w-96">
        <h2 class="text-xl font-bold mb-4 text-center">Login Admin</h2>
        <input type="text" name="username" placeholder="Username" class="w-full p-2 mb-4 border border-gray-700 rounded bg-gray-700 text-white" required>
        <input type="password" name="password" placeholder="Password" class="w-full p-2 mb-4 border border-gray-700 rounded bg-gray-700 text-white" required>
        <button type="submit" class="bg-blue-600 w-full py-2 rounded hover:bg-blue-700">Login</button>
        <?php if (isset($error)) echo "<p class='text-red-500 mt-4'>$error</p>"; ?>
    </form>
</body>
</html>
