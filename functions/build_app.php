<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: ../index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize the app name to avoid issues with spaces or special characters
    $appName = preg_replace('/[^A-Za-z0-9_]/', '_', $_POST['appName']);
    $username = $_SESSION['user'];
    $userAppDir = "../user_apps/$username/";
    $appDir = $userAppDir . $appName . "/";

    // Ensure user directory exists
    if (!is_dir($userAppDir)) {
        mkdir($userAppDir, 0777, true);
    }

    // Create a new Flutter project using the flutter create command
    if (!is_dir($appDir)) {
        $cmd = "flutter create --project-name $appName " . escapeshellarg($appDir);
        shell_exec($cmd);
    }

    // Path to the external gradle-wrapper.properties file
    $externalGradlePropertiesPath = '../flutter_template/gradle-wrapper.properties';

    // Read content from the external file
    $gradlePropertiesContent = file_get_contents($externalGradlePropertiesPath);

    if ($gradlePropertiesContent === false) {
        echo "Error: Unable to read the external gradle-wrapper.properties file.";
        exit;
    }

    // Path to the gradle-wrapper.properties file in the Flutter project
    $gradlePropertiesPath = $appDir . 'android/gradle/wrapper/gradle-wrapper.properties';

    // Write content to the gradle-wrapper.properties file
    if (file_put_contents($gradlePropertiesPath, $gradlePropertiesContent) === false) {
        echo "Error: Unable to update gradle-wrapper.properties.";
        exit;
    }

    // Modify the main.dart in the newly created Flutter project
    $mainDartPath = "$appDir/lib/main.dart";
    
    if (file_exists($mainDartPath)) {
        $flutterCode = file_get_contents($mainDartPath);
        $flutterCode = str_replace('Flutter Demo Home Page', $appName, $flutterCode);
        file_put_contents($mainDartPath, $flutterCode);
    } else {
        echo "Error: Unable to find main.dart.";
        exit;
    }

    // Build the APK
    $apkDir = "../build_apks/";
    if (!is_dir($apkDir)) {
        mkdir($apkDir, 0777, true);
    }
    $outputApk = "{$apkDir}{$username}_{$appName}_app.apk";
    
    // Use 'flutter build apk --release' and log the output
    $buildCommand = "cd " . escapeshellarg($appDir) . " && flutter build apk --release 2>&1";
    $output = shell_exec($buildCommand);

    // Log the output for debugging purposes
    file_put_contents("../logs/build_log.txt", $output);

    // Check if APK exists and move it
    $builtApkPath = "$appDir/build/app/outputs/flutter-apk/app-release.apk";
    if (file_exists($builtApkPath)) {
        copy($builtApkPath, $outputApk);
        header("Location: ../builder.php?apk={$username}_{$appName}_app.apk");
        exit;
    } else {
        echo "APK build failed. Please try again.";
    }
}
?>

