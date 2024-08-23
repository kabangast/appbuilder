<?php
session_start();
if (isset($_SESSION['user'])) {
    header('Location: builder.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $users = json_decode(file_get_contents('users.json'), true);
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (isset($users[$username]) && $users[$username]['password'] == $password) {
        $_SESSION['user'] = $username;
        header('Location: builder.php');
    } else {
        $error = "Invalid credentials!";
    }
}
?>
<html>
<head><title>Login</title></head>
<body>
    <form method="POST">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
        <?php if(isset($error)) { echo "<p>$error</p>"; } ?>
    </form>
</body>
</html>

