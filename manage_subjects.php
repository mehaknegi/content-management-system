<?php
require_once('db.php');
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$subjects_query = "SELECT * FROM subjects";
$subjects_result = mysqli_query($conn, $subjects_query);

// Add/Edit/Delete operations go here
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Subjects</title>
</head>
<body>
    <h1>Manage Subjects</h1>
    <a href="add_subject.php">Add New Subject</a>
    <ul>
        <?php while ($subject = mysqli_fetch_assoc($subjects_result)): ?>
            <li>
                <?php echo $subject['name']; ?>
                <a href="edit_subject.php?id=<?php echo $subject['id']; ?>">Edit</a>
                <a href="delete_subject.php?id=<?php echo $subject['id']; ?>">Delete</a>
            </li>
        <?php endwhile; ?>
    </ul>
</body>
</html>
