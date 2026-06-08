
const path = require('path');
const multer = require('multer'); // Handles file uploads

// --- KEEP ALL YOUR EXISTING "ABOUT US" & LOGIN CODE HERE ---

// Configure where uploaded project images are stored
const storage = multer.diskStorage({
    destination: (req, file, cb) => {
        cb(null, 'static/uploads/'); 
    },
    filename: (req, file, cb) => {
        cb(null, Date.now() + path.extname(file.originalname)); // Appends unique timestamp
    }
});
const upload = multer({ storage: storage });

// 1. PUBLIC API ROUTE: Fetch all projects with optional status filtering
app.get('/api/projects', (req, res) => {
    const statusFilter = req.query.status; // e.g., ?status=Ongoing
    
    // In practice, execute your database query here:
    // let sql = "SELECT * FROM projects";
    // if (statusFilter) sql += " WHERE status = ?";
    
    // Sample mockup array matching your schema attributes
    const mockProjects = [
        {
            id: 1,
            title: "Project Title 1",
            description: "A brief introductory description outlining project outcomes.",
            status: "Ongoing",
            image_url: "uploads/default.jpg"
        },
        {
            id: 2,
            title: "Project Title 2",
            description: "A brief introductory description outlining project outcomes.",
            status: "Completed",
            image_url: "uploads/default.jpg"
        }
    ];
    
    res.json(mockProjects);
});

// 2. ADMIN POST ROUTE: Receive dashboard form data and save a project
app.post('/admin/projects/add', upload.array('project_images', 5), (req, res) => {
    const { title, description, status, start_date, end_date, location } = req.body;
    
    // Grabs file paths of all uploaded images
    const imagePaths = req.files.map(file => `uploads/${file.filename}`);
    
    // DATABASE OPERATIONS GO HERE:
    // 1. INSERT INTO projects (title, description, status, start_date, end_date, location) VALUES (...)
    // 2. Get the new project's ID.
    // 3. Loop through imagePaths and INSERT INTO project_images (project_id, image_url) VALUES (...)

    console.log("Saving Project Text:", { title, description, status, location });
    console.log("Saving Image Files Paths:", imagePaths);

    // Redirect or respond with success
    res.send("Project successfully saved to backend database!");
});
