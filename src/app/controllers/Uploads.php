<?php 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $targetDir = "uploads/videos/";
    $videoName = basename($_FILES['video']['name']);
    $targetFile = $targetDir . $videoName;

    
    if (move_uploaded_file($_FILES['video']['tmp_name'], $targetFile)) {
        
        $stmt = $conn->prepare("INSERT INTO movies (title, video) VALUES (?, ?)");
        $stmt->bind_param("ss", $title, $targetFile);

        if ($stmt->execute()) {
            echo "Video berhasil diunggah dan disimpan di database!";
        } else {
            echo "Gagal menyimpan ke database: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Gagal mengunggah video.";
    }
}

?>