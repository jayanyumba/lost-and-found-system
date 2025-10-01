<?php include "db.php"; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Apply for Item</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Apply for Item</h2>
    <div class="container">
    <?php
    $id = isset($_GET['item_id']) ? $_GET['item_id'] : null;

    // If form is submitted
    if (isset($_POST['apply'])) {
        $name = $_POST['name'];
        $contact = $_POST['contact'];
        $reason = $_POST['reason'];

        $sql = "INSERT INTO applications (item_id, name, contact, reason) 
                VALUES ('$id', '$name', '$contact', '$reason')";

        if (mysqli_query($conn, $sql)) {
            echo "<p class='success-msg'>✅ Application submitted successfully!</p>";
            echo "<a href='index.php' class='back-btn'>⬅ Back to Home</a>";
        } else {
            echo "<p class='error-msg'>❌ Error: " . mysqli_error($conn) . "</p>";
            echo "<a href='index.php' class='back-btn'>⬅ Back to Home</a>";
        }
    } else {
        // Show item details + form
        if ($id) {
            $sql = "SELECT * FROM items WHERE id=$id";
            $result = mysqli_query($conn, $sql);
            $item = mysqli_fetch_assoc($result);

            if ($item) {
                echo "<h3>" . $item['title'] . " (" . $item['category'] . ")</h3>";
                echo "<p>" . $item['description'] . "</p>";
                echo "<p><b>Location:</b> " . $item['location'] . "</p>";
            }
        }
    ?>
        <form method="post">
            <label>Your Name:</label>
            <input type="text" name="name" required><br>

            <label>Your Email/Phone:</label>
            <input type="text" name="contact" required><br>

            <label>Why do you claim this item?</label>
            <textarea name="reason" required></textarea><br>

            <button type="submit" name="apply">Submit Application</button>
        </form>
    <?php } ?>
    </div>
</body>
</html>
