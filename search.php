<?php include "db.php"; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Search Items</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Search Lost & Found</h2>
    <form method="get">
        <input type="text" name="q" placeholder="Enter keyword...">
        <select name="category">
            <option value="">All</option>
            <option value="Lost">Lost</option>
            <option value="Found">Found</option>
        </select>
        <button type="submit">Search</button>
    </form>
    <hr>

    <?php
    if (isset($_GET['q']) || isset($_GET['category'])) {
        $q = $_GET['q'];
        $cat = $_GET['category'];

        $sql = "SELECT * FROM items WHERE 
                (title LIKE '%$q%' OR description LIKE '%$q%' OR location LIKE '%$q%')";
        if ($cat != "") {
            $sql .= " AND category='$cat'";
        }

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div class='item-box'>";
                echo "<h3>" . $row['title'] . " (" . $row['category'] . ")</h3>";
                echo "<p><strong>Description:</strong> " . $row['description'] . "</p>";
                echo "<p><strong>Location:</strong> " . $row['location'] . "</p>";
                echo "<p><strong>Contact:</strong> " . $row['contact'] . "</p>";

                // ✅ Claim button
                echo "<a href='apply.php?item_id=" . $row['id'] . "' class='claim-btn'>Claim Item</a>";

                echo "</div><hr>";
            }
        } else {
            echo "<p>No results found.</p>";
        }

        echo "<a href='index.php' class='back-btn'>⬅ Back to Home</a>";
    }
    mysqli_close($conn);
    ?>
</body>
</html>
