
<?php
// 1. Database Connection Configuration
// Change these credentials to match your main database connection settings
$host = "localhost"; 
$user = "root"; 
$pass = ""; 
$dbname = "your_existing_healthcare_db"; 

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) { 
    die("Connection failed: " . $conn->connect_error); 
}

// 2. Handle Form Submission (Saving a Healthcare Outreach Project)
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['save_project'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $status = $_POST['status'];
    $start_date = $_POST['start_date'];
    $end_date = !empty($_POST['end_date']) ? $_POST['end_date'] : NULL;
    $location = !empty($_POST['location']) ? $_POST['location'] : NULL;

    // Securely insert text data into the projects table
    $stmt = $conn->prepare("INSERT INTO projects (title, description, status, start_date, end_date, location) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $title, $description, $status, $start_date, $end_date, $location);
    
    if ($stmt->execute()) {
        $project_id = $conn->insert_id;
        
        // Handle a default placeholder image string for easy testing
        $dummy_url = "uploads/default-project.jpg";
        $img_stmt = $conn->prepare("INSERT INTO project_images (project_id, image_url) VALUES (?, ?)");
        $img_stmt->bind_param("is", $project_id, $dummy_url);
        $img_stmt->execute();
        
        echo "<script>alert('Project Saved Successfully!'); window.location='manage.php';</script>";
    }
}

// 3. Handle Project Deletion
if (isset($_GET['delete_id'])) {
    $del_id = $_GET['delete_id'];
    $del_stmt = $conn->prepare("DELETE FROM projects WHERE id = ?");
    $del_stmt->bind_param("i", $del_id);
    
    if ($del_stmt->execute()) {
        echo "<script>alert('Project Removed Successfully!'); window.location='manage.php';</script>";
    }
}

// 4. Fetch All Existing Projects for the Admin View List
$list_result = $conn->query("SELECT * FROM projects ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage Healthcare Projects</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background-color: #f4f7f6; color: #333; }
        .wrapper { max-width: 600px; margin: auto; }
        .box { background: white; padding: 20px; border-radius: 8px; box-shadow: 0px 4px 6px rgba(0,0,0,0.05); margin-bottom: 25px; }
        h2, h3 { margin-top: 0; color: #0d6efd; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; font-weight: bold; margin-bottom: 5px; }
        .form-group input, .form-group textarea, .form-group select { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        .btn { background-color: #0d6efd; color: white; padding: 12px; border: none; border-radius: 4px; cursor: pointer; width: 100%; font-weight: bold; font-size: 1rem; }
        .btn:hover { background-color: #0b5ed7; }
        
        /* List View Styles */
        .project-item { display: flex; justify-content: space-between; align-items: center; padding: 12px 0; border-bottom: 1px solid #eee; }
        .project-item:last-child { border-bottom: none; }
        .project-info h4 { margin: 0 0 5px 0; font-size: 1.1rem; }
        .badge { display: inline-block; padding: 3px 8px; border-radius: 12px; font-size: 0.75rem; font-weight: bold; }
        .Ongoing { background-color: #fff3cd; color: #856404; }
        .Completed { background-color: #d4edda; color: #155724; }
        .Upcoming { background-color: #cce5ff; color: #004085; }
        .delete-btn { color: #dc3545; text-decoration: none; font-weight: bold; font-size: 0.9rem; border: 1px solid #dc3545; padding: 5px 10px; border-radius: 4px; }
        .delete-btn:hover { background-color: #dc3545; color: white; }
    </style>
</head>
<body>

<div class="wrapper">

    <div class="box">
        <h2>Add New Healthcare Initiative</h2>
        <form action="" method="POST">
            <div class="form-group">
                <label>Project Title</label>
                <input type="text" name="title" placeholder="e.g., Vitamin Deficiency Screening Drive" required>
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea name="description" rows="4" placeholder="Describe the objectives and impact of this initiative..." required></textarea>
            </div>
            <div class="form-group">
                <label>Status</label>
                <select name="status">
                    <option value="Ongoing">Ongoing</option>
                    <option value="Completed">Completed</option>
                    <option value="Upcoming">Upcoming</option>
                </select>
            </div>
            <div class="form-group">
                <label>Start Date</label>
                <input type="date" name="start_date" required>
            </div>
            <div class="form-group">
                <label>End Date</label>
                <input type="date" name="end_date">
            </div>
            <div class="form-group">
                <label>Location</label>
                <input type="text" name="location" placeholder="e.g., North Bengaluru Clinic (Optional)">
            </div>
            <button type="submit" name="save_project" class="btn">Save Project</button>
        </form>
    </div>

    <div class="box">
        <h3>Existing Initiatives</h3>
        <?php if ($list_result && $list_result->num_rows > 0): ?>
            <?php while($row = $list_result->fetch_assoc()): ?>
                <div class="project-item">
                    <div class="project-info">
                        <h4><?php echo htmlspecialchars($row['title']); ?></h4>
                        <span class="badge <?php echo $row['status']; ?>"><?php echo $row['status']; ?></span>
                    </div>
                    <a href="?delete_id=<?php echo $row['id']; ?>" class="delete-btn" onclick="return confirm('Are you sure you want to permanently delete this project record?')">Delete</a>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p style="color: #777; text-align: center; margin: 10px 0 0 0;">No outreach records found in the database system.</p>
        <?php endif; ?>
    </div>

</div>

</body>
</html>
