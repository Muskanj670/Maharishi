<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    function createSlug($string) {
        return strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $string), '-'));
    }

    $name = $_POST['name'];
    $slug = createSlug($name);
    $title = htmlspecialchars($_POST['title'], ENT_QUOTES, 'UTF-8');
    $description = nl2br(mysqli_real_escape_string($conn, $_POST['description']));// Store safely with encoding

    // Upload image
    $image = $_FILES['image']['name'];
    $target = "images/" . basename($image);
    move_uploaded_file($_FILES['image']['tmp_name'], $target);

    $sql = "INSERT INTO maharishis (name, slug, title, description, image) VALUES ('$name', '$slug', '$title', '$description', '$image')";
    if ($conn->query($sql) === TRUE) {
        header("Location: admin.php");
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Maharishi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body class="container mt-4">

    <h2>Add Maharishi</h2>
    <!-- Form with a textarea supporting HTML -->
<form action="add.php" method="post" enctype="multipart/form-data">
    <label>Name:</label>
    <input type="text" name="name" required><br>

    <label>Title:</label>
    <input type="text" name="title" required><br>

    <label>Description:</label>
    <textarea name="description" required></textarea><br>

    <label>Image:</label>
    <input type="file" name="image" required><br>

    <button type="submit">Add Maharishi</button>
</form>

</body>

</html>