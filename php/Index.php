<?php
// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if file was uploaded without errors
    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
        $allowed_extensions = array("jpg", "jpeg", "png", "gif");
        $filename = $_FILES["image"]["name"];
        $file_extension = pathinfo($filename, PATHINFO_EXTENSION);

        // Check if the file extension is allowed
        if (in_array($file_extension, $allowed_extensions)) {
            // Set destination directory for uploads
            $upload_dir = "uploads/";

            // Generate a unique filename to prevent overwriting
            $unique_filename = uniqid() . "." . $file_extension;

            // Move the uploaded file to the destination directory
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $upload_dir . $unique_filename)) {
                echo "File uploaded successfully.";
            } else {
                echo "Error uploading file.";
            }
        } else {
            echo "Invalid file extension. Allowed extensions are jpg, jpeg, png, and gif.";
        }
    } else {
        echo "Error: " . $_FILES["image"]["error"];
    }
}

    // database details
    $host = "localhost";
    $username = "root";
    $password = "";
    $dbname = "despark";

    // creating a connection
    $con = mysqli_connect($host, $username, $password, $dbname);

    // to ensure that the connection is made
    if (!$con)
    {
        die("Connection failed!" . mysqli_connect_error());
    }

    // using sql to create a data entry query
    $sql = "INSERT INTO accounts (username, pass) VALUES ('$uname', '$pass')";
  
    // send query to the database to add values and confirm if successful
    $rs = mysqli_query($con, $sql);
    if($rs)
    {
        echo "Entries added!";
    }
  
    // close connection
    mysqli_close($con);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Image Upload</title>
</head>
<body>
    <h2>Upload an Image</h2>
    <form method="post" enctype="multipart/form-data">
        <input type="file" name="image">
        <button type="submit" name="submit">Upload</button>
    </form>
</body>
</html>




