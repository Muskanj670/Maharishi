<?php
include 'db.php';
$result = $conn->query("SELECT * FROM maharishis");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Learn about the legendary sage Agastya, his contributions, and his spiritual significance.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maharishis</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>List of Maharishis</h1>
    <div class="container">
        <?php while ($row = $result->fetch_assoc()) { ?>
            <div class="card">
                <img src="images/<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>">
                <h2><?php echo $row['name']; ?></h2>
                <p><?php echo substr(html_entity_decode($row['description']), 0, 100); ?>...</p>
                <a href="/<?php echo $row['slug']; ?>">Read More</a>
            </div>
        <?php } ?>
    </div>
</body>

</html>