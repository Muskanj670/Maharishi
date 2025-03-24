<?php
include 'db.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid Access!");
}

$id = intval($_GET['id']);

// Fetch Maharishi details
$stmt = $conn->prepare("SELECT * FROM maharishis WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if (!$row) {
    die("Maharishi not found!");
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $title = $conn->real_escape_string($_POST['title']);
    $description = nl2br(mysqli_real_escape_string($conn, $_POST['description']));
    
    $image = $row['image']; // Default to existing image

    if (!empty($_FILES['image']['name'])) {
        $file_name = $_FILES['image']['name'];
        $file_tmp = $_FILES['image']['tmp_name'];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $allowed_ext = ['jpg', 'jpeg', 'png', 'gif'];

        if (!in_array($file_ext, $allowed_ext)) {
            die("Invalid file type! Only JPG, JPEG, PNG, and GIF are allowed.");
        }

        $image = time() . "_" . $file_name; // Rename to avoid overwriting
        $target = "images/" . $image;
        move_uploaded_file($file_tmp, $target);
    }

    // Update record
    $update_stmt = $conn->prepare("UPDATE maharishis SET name=?, title=?, description=?, image=? WHERE id=?");
    $update_stmt->bind_param("ssssi", $name, $title, $description, $image, $id);
    $update_stmt->execute();

    header("Location: admin.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Maharishi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body class="container mt-4">

    <h2>Edit Maharishi</h2>
    <form action="edit.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($row['name']); ?>" required>
        </div>
        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" class="form-control" value="<?php echo htmlspecialchars($row['title']); ?>" required>
        </div>
        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control" required><?php echo htmlspecialchars($row['description']); ?></textarea>
        </div>
        <div class="mb-3">
            <label>Image</label>
            <input type="file" name="image" class="form-control">
            <img src="images/<?php echo htmlspecialchars($row['image']); ?>" width="100" class="mt-2">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="admin.php" class="btn btn-secondary">Back</a>
    </form>

</body>

</html>
<?php
include 'db.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid Access!");
}

$id = intval($_GET['id']);

// Fetch Maharishi details
$stmt = $conn->prepare("SELECT * FROM maharishis WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if (!$row) {
    die("Maharishi not found!");
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $title = $conn->real_escape_string($_POST['title']);
    $description = nl2br(mysqli_real_escape_string($conn, $_POST['description']));
    
    $image = $row['image']; // Default to existing image

    if (!empty($_FILES['image']['name'])) {
        $file_name = $_FILES['image']['name'];
        $file_tmp = $_FILES['image']['tmp_name'];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $allowed_ext = ['jpg', 'jpeg', 'png', 'gif'];

        if (!in_array($file_ext, $allowed_ext)) {
            die("Invalid file type! Only JPG, JPEG, PNG, and GIF are allowed.");
        }

        $image = time() . "_" . $file_name; // Rename to avoid overwriting
        $target = "images/" . $image;
        move_uploaded_file($file_tmp, $target);
    }

    // Update record
    $update_stmt = $conn->prepare("UPDATE maharishis SET name=?, title=?, description=?, image=? WHERE id=?");
    $update_stmt->bind_param("ssssi", $name, $title, $description, $image, $id);
    $update_stmt->execute();

    header("Location: admin.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Maharishi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body class="container mt-4">

    <h2>Edit Maharishi</h2>
    <form action="edit.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($row['name']); ?>" required>
        </div>
        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" class="form-control" value="<?php echo htmlspecialchars($row['title']); ?>" required>
        </div>
        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control" required><?php echo htmlspecialchars($row['description']); ?></textarea>
        </div>
        <div class="mb-3">
            <label>Image</label>
            <input type="file" name="image" class="form-control">
            <img src="images/<?php echo htmlspecialchars($row['image']); ?>" width="100" class="mt-2">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="admin.php" class="btn btn-secondary">Back</a>
    </form>

</body>

</html>
