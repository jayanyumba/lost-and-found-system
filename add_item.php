<?php include "db.php"; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Lost/Found Item</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="container">
        <h2>Report Lost or Found Item</h2>

        <?php
        if (isset($_POST['submit'])) {
            $title   = $_POST['title'];
            $desc    = $_POST['description'];
            $cat     = $_POST['category'];
            $loc     = $_POST['location'];
            $contact = $_POST['contact'];

            $sql = "INSERT INTO items (title, description, category, location, contact)
                    VALUES ('$title', '$desc', '$cat', '$loc', '$contact')";

            if (mysqli_query($conn, $sql)) {
                echo "<p style='color:green; font-weight:bold;'>✅ Item successfully reported!</p>";
                echo "<a href='index.php' class='back-btn'>⬅ Back to Home</a>";
            } else {
                echo "<p style='color:red;'>Error: " . mysqli_error($conn) . "</p>";
                echo "<a href='add_item.php' class='back-btn'>🔄 Try Again</a>";
            }
        } else {
        ?>

        <form action="" method="post">
            <label>Title:</label><br>
            <input type="text" name="title" required><br><br>

            <label>Description:</label><br>
            <textarea name="description" required></textarea><br><br>

            <label>Category:</label><br>
            <select name="category" required>
                <option value="Lost">Lost</option>
                <option value="Found">Found</option>
            </select><br><br>

            <label>Location:</label><br>
            <input type="text" name="location" required><br><br>

            <label>Contact Info:</label><br>
            <input type="text" name="contact" required><br><br>

            <button type="submit" name="submit">Submit</button>
        </form>

        <?php } ?>
    </div>
</body>
</html>
