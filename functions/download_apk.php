<?php
if (isset($_GET['apk'])) {
    $apkFile = "../build_apks/" . basename($_GET['apk']);
    
    if (file_exists($apkFile)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($apkFile) . '"');
        header('Content-Length: ' . filesize($apkFile));
        readfile($apkFile);
        exit;
    } else {
        echo "APK not found.";
    }
} else {
    echo "No APK specified.";
}
?>
