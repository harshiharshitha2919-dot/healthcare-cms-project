<?php
// 1. Database Connection (Make sure this matches your database credentials)
$host = "localhost"; 
$user = "root"; 
$pass = ""; 
$dbname = "your_existing_healthcare_db"; 

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }

// 2. Handle Status Filter
$status_filter = isset($_GET['status']) ? $_GET['status'] : 'All';

// 3. Fetch Projects based on filter selection
if ($status_filter != 'All') {
    $stmt = $conn->prepare("SELECT p.*, i.image_url FROM projects p LEFT JOIN project_images i ON p.id = i.project_id WHERE p.status = ? GROUP BY p.id ORDER BY p.id DESC");
    $stmt->bind_param("s", $status_filter);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $result = $conn->query("SELECT p.*, i.image_url FROM projects p LEFT JOIN project_images i ON p.id = i.project_id GROUP BY p.id ORDER BY p.id DESC");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Healthcare NGO Initiatives</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin: 0; padding: 0; background-color: #f4f7f6; color: #333; }
        
        /* Our Projects Header Section */
        .hero-section { background-color: #0d6efd; color: white; text-align: center; padding: 40px 20px; }
        .hero-section h1 { margin: 0; font-size: 2.5rem; }
        .hero-section p { margin: 10px 0 0 0; font-size: 1.1rem; opacity: 0.9; }
        
        /* Filter Navigation Buttons */
        .filter-container { text-align: center; margin: 30px 0; }
        .filter-btn { background-color: white; border: 2px solid #0d6efd; color: #0d6efd; padding: 8px 16px; margin: 0 5px; border-radius: 20px; cursor: pointer; font-weight: bold; text-decoration: none; display: inline-block; }
        .filter-btn.active, .filter-btn:hover { background-color: #0d6efd; color: white; }
        
        /* Project Display Grid Box Layout */
        .grid-container { max-width: 1200px; margin: auto; padding: 0 20px; display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 25px; }
        .project-card { background: white; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.1); display: flex; flex-direction: column; }
        .project-img { width: 100%; height: 200px; object-fit: cover; background-color: #e9ecef; display: flex; align-items: center; justify-content: center; color: #6c757d; font-style: italic; }
        .card-content { padding: 20px; flex-grow: 1; display: flex; flex-direction: column; }
        .card-title { font-size: 1.3rem; margin: 0 0 10px 0; color: #222; }
        .card-desc { font-size: 0.95rem; color: #555; line-height: 1.5; margin: 0 0 15px 0; flex-grow: 1; }
        .status-badge { display: inline-block; padding: 4px 10px; border-radius: 12px; font-size: 0.8rem; font-weight: bold; margin-bottom: 10px; width: fit-content; }
        .Ongoing { background-color: #fff3cd; color: #856404; }
        .Completed { background-color: #d4edda; color: #155724; }
        .Upcoming { background-color: #cce5ff; color: #004085; }
        .learn-more-btn { display: block; text-align: center; background-color: #0d6efd; color: white; text-decoration: none; padding: 10px; border-radius: 4px; font-weight: bold; margin-top: auto; }
        
        /* Our Impact Metric Row Section */
        .impact-section { background-color: #e6f2ff; padding: 40px 20px; text-align: center; margin-top: 50px; }
        .impact-section h2 { margin: 0 0 10px 0; font-size: 2rem; color: #0d6efd; }
        .impact-section p { margin: 0 0 30px 0; font-size: 1.1rem; color: #555; }
        .impact-grid { max-width: 1000px; margin: auto; display: flex; justify-content: space-around; flex-wrap: wrap; gap: 20px; }
        .impact-box { background: #0d6efd; color: white; padding: 20px; border-radius: 8px; min-width: 200px; flex: 1; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        .impact-number { font-size: 2.2rem; font-weight: bold; margin-bottom: 5px; }
        .impact-label { font-size: 1rem; opacity: 0.9; }
    </style>
</head>
<body>

<div class="hero-section">
    <h1>Our Projects</h1>
    <p>Making a difference through our initiatives</p>
</div>

<div class="filter-container">
    <a href="?status=All" class="filter-btn <?php echo $status_filter == 'All' ? 'active' : ''; ?>">All</a>
    <a href="?status=Ongoing" class="filter-btn <?php echo $status_filter == 'Ongoing' ? 'active' : ''; ?>">Ongoing</a>
    <a href="?status=Completed" class="filter-btn <?php echo $status_filter == 'Completed' ? 'active' : ''; ?>">Completed</a>
    <a href="?status=Upcoming" class="filter-btn <?php echo $status_filter == 'Upcoming' ? 'active' : ''; ?>">Upcoming</a>
</div>

<div class="grid-container">
    <?php if ($result->num_rows > 0): ?>
        <?php while($row = $result->fetch_assoc()): ?>
            <div class="project-card">
                <?php if(!empty($row['image_url'])): ?>
                    <img src="<?php echo $row['image_url']; ?>" alt="Project Image" class="project-img">
                <?php else: ?>
                    <div class="project-img">Project Image Placeholder</div>
                <?php endif; ?>
                
                <div class="card-content">
                    <span class="status-badge <?php echo $row['status']; ?>"><?php echo $row['status']; ?></span>
                    <h3 class="card-title"><?php echo htmlspecialchars($row['title']); ?></h3> <p class="card-desc"><?php echo htmlspecialchars($row['description']); ?></p> <a href="detail.php?id=<?php echo $row['id']; ?>" class="learn-more-btn">Learn More</a> </div>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p style="text-align: center; grid-column: 1/-1; color: #666;">No healthcare outreach projects available at this moment.</p>
    <?php endif; ?>
</div>

<div class="impact-section">
    <h2>Our Impact</h2>
    <p>See how we are changing lives with your support</p>
    <div class="impact-grid">
        <div class="impact-box">
            <div class="impact-number">500+</div>
            <div class="impact-label">People Helped</div>
        </div>
        <div class="impact-box">
            <div class="impact-number">300+</div>
            <div class="impact-label">Volunteers Engaged</div>
        </div>
        <div class="impact-box">
            <div class="impact-number">$50,000+</div>
            <div class="impact-label">Funds Raised</div>
        </div>
    </div>
</div>

</body>
</html>
