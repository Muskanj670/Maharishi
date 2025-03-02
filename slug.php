<?php
include 'db.php';

// Check if slug is provided in the URL
if (!isset($_GET['slug'])) {
    die("Invalid Access!");
}

$slug = $conn->real_escape_string($_GET['slug']); // Prevent SQL injection

// Fetch the record by slug instead of ID
$result = $conn->query("SELECT * FROM maharishis WHERE slug = '$slug'");

if ($result->num_rows == 0) {
    die("Maharishi not found!");
}

$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $row['name']; ?> - Maharishi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 800px;
            margin-top: 50px;
        }
        .card {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        }
        .card img {
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            width: 100%;
            height: auto;
            object-fit: cover;
        }
        .card-body {
            padding: 20px;
        }
        h2 {
            color: #343a40;
        }
        .description {
            font-size: 1.1rem;
            line-height: 1.6;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="card">
        <img src="images/<?php echo htmlspecialchars($row['image']); ?>" alt="<?php echo htmlspecialchars($row['name']); ?>">
        <div class="card-body">
            <h2 class="text-center"><?php echo htmlspecialchars($row['name']); ?></h2>
            <hr>
            <div class="description">
            
                <?php echo html_entity_decode($row['title']); ?>
                <?php $description = stripslashes($row['description']);
echo nl2br($description);
 ?>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
