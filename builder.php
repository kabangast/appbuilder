<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit;
}
?>
<html>
<head>
    <title>App Builder</title>
</head>
<body>
    <h1>App Builder</h1>
    
    <!-- Logout Link -->
    <a href="functions/logout.php">Logout</a>
    
    <!-- Build App Form -->
    <form action="functions/build_app.php" method="POST" enctype="multipart/form-data">
        <label for="appName">App Name:</label>
        <input type="text" id="appName" name="appName" placeholder="Enter App Name" required><br>

        <label for="appIcon">App Icon:</label>
        <input type="file" id="appIcon" name="appIcon" accept="image/*" required><br>

        <button type="submit">Build App</button>
    </form>
    
    <?php if (isset($_GET['apk'])): ?>
        <p>Your app is ready! <a href="functions/download_apk.php?apk=<?php echo $_GET['apk']; ?>">Download APK</a></p>
    <?php endif; ?>
</body>
</html>

