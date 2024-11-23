<?php
require_once('db.php');

// Fetch subjects from the database
$subjects_query = "SELECT * FROM subjects WHERE visible = 1 ORDER BY position ASC";
$subjects_result = mysqli_query($conn, $subjects_query);

$subject_id = isset($_GET['subject_id']) ? $_GET['subject_id'] : 1; // Default to the first subject

// Fetch pages for the selected subject
$pages_query = "SELECT * FROM pages WHERE subject_id = $subject_id AND visible = 1";
$pages_result = mysqli_query($conn, $pages_query);

// Fetch the content of the selected page
$page_id = isset($_GET['page_id']) ? $_GET['page_id'] : 1; // Default to the first page
$page_query = "SELECT * FROM pages WHERE id = $page_id";
$page_result = mysqli_query($conn, $page_query);
$page = mysqli_fetch_assoc($page_result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Widget Corp - Public Area</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <header>
            <h1>Widget Corp</h1>
            <nav>
                <ul>
                    <?php while($subject = mysqli_fetch_assoc($subjects_result)): ?>
                        <li><a href="?subject_id=<?php echo $subject['id']; ?>"><?php echo $subject['name']; ?></a></li>
                    <?php endwhile; ?>
                </ul>
            </nav>
        </header>

        <main>
            <h2><?php echo $page['title']; ?></h2>
            <p><?php echo nl2br($page['content']); ?></p>
        </main>
    </div>
</body>
</html>
