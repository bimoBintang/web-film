<form action="upload.php" method="POST" enctype="multipart/form-data">
    <label for="title">Judul Film:</label>
    <input type="text" name="title" id="title" required><br>

    <label for="video">Upload Video:</label>
    <input type="file" name="video" id="video" accept="video/*" required><br>

    <button type="submit">Upload</button>
</form>
