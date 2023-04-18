<!DOCTYPE html>
<html>
<head>
    <title>File Upload Example</title>
</head>
<body>
    <h1>File Upload Example</h1>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <label for="file">Select file:</label>
        <input type="file" name="file" id="file">
        <input type="file" name="file2" id="file">
        <input type="submit" value="Upload" name="submit">
    </form>
</body>
</html>
