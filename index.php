<?php include "db.php"; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Lost & Found Portal</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Campus Lost & Found Portal</h1>
    <div class="container">
        <a href="add_item.php">➕ Report Item</a> | 
        <a href="search.php">🔍 Search Items</a>
        <hr>

        <h2>Latest Posts</h2>
        <?php
        $sql = "SELECT * FROM items ORDER BY date_posted DESC LIMIT 10";
        $result = mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<div class='card'>";
            echo "<h3>" . $row['title'] . " (" . $row['category'] . ")</h3>";
            echo "<p>" . $row['description'] . "</p>";
            echo "<p><b>Location:</b> " . $row['location'] . "</p>";
            echo "<p><b>Contact:</b> " . $row['contact'] . "</p>";
            if ($row['image']) {
                echo "<img src='" . $row['image'] . "' width='150'>";
            }
            // Add Apply button with item ID
            echo "<br><a href='apply.php?id=" . $row['id'] . "' class='apply-btn'>Claim this Item</a>";
            echo "</div>";
        }
        ?>
    </div>
</body>

</html>
