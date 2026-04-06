<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forms Examples</title>
</head>
<body>
    <h1>Forms Examples</h1>
    <h2>GET Method Form</h2>
    <form action="process_form.php" method="get">
        Name: <input type="text" name="name"><br>
        Email: <input type="email" name="email"><br>
        <input type="submit" value="Submit GET">
    </form>

    <h2>POST Method Form</h2>
    <form action="process_form.php" method="post">
        Name: <input type="text" name="name"><br>
        Email: <input type="email" name="email"><br>
        <input type="submit" value="Submit POST">
    </form>

    <h2>File Upload Form</h2>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        Select file: <input type="file" name="fileToUpload"><br>
        <input type="submit" value="Upload File">
    </form>
</body>
</html>