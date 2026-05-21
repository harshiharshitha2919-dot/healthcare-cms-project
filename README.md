# 🏥 CarePulse: Full-Stack Healthcare CMS Web Application

Welcome to the official repository for **CarePulse**, a responsive Healthcare Content Management System (CMS) designed specifically for community health drives, patient deficiency tracking, and medical support coordination.

---

## 🔗 Project Deliverables (Submission Links)
* 🌐 **Live Website Link:** [👉 https://harshiharshitha2919-dot.github.io/healthcare-cms-project/login.html)
* 📁 **Source Code Repository:** [👉https://github.com/harshiharshitha2919-dot/healthcare-cms-project]
*(Note: Please replace `YOUR_GITHUB_USERNAME` in the links above with your actual GitHub username so they work perfectly for the evaluators!)*

---

## 🛠️ System Overview 

CarePulse provides a unified, mobile-friendly interface built using the **Bootstrap 5 Framework**. It handles secure user session routing purely in the client layer to toggle between secure authentication pages and highly functional administrative interfaces seamlessly.

### Core Modules Developed:
1. **Authentication Gateway:** A modular panel containing an interactive registration form and a secure login gateway with form input validation.
2. **Role-Based Access Simulation:** Adjusts features automatically based on whether the logged-in user is a **Donor**, **Medical Volunteer/Doctor**, or **Healthcare Administrator**.
3. **Clinical Operations Dashboard:** A unified workspace displaying core tracking counters (Active Camps, Funds Raised, On-Duty Doctors, Patients Assisted) alongside an interactive data table displaying operational programs like Vitamin Drives and Vision screenings.

---

## 🗃️ Relational Database Schema Design
To support dynamic content management, user tracking, and administrative privileges, the following relational database structure has been designed for **MySQL**:

### Table Name: `users`
| Column Name | Data Type | Constraints / Attributes | Operational Description |
| :--- | :--- | :--- | :--- |
| `user_id` | `INT` | `PRIMARY KEY`, `AUTO_INCREMENT` | Unique identifier assigned to each user. |
| `full_name` | `VARCHAR(100)` | `NOT NULL` | The user's complete name. |
| `email` | `VARCHAR(100)` | `NOT NULL`, `UNIQUE` | Unique email string utilized as the account login ID. |
| `password_hash`| `VARCHAR(255)` | `NOT NULL` | Hashed password string for application security. |
| `role` | `VARCHAR(50)` | `NOT NULL`, `DEFAULT 'Donor'` | User classification parameters: `Admin`, `Doctor`, or `Donor`. |
| `status` | `ENUM` | `DEFAULT 'active'` | Operational status tracking: `active` or `inactive`. |
| `created_at` | `TIMESTAMP` | `DEFAULT CURRENT_TIMESTAMP` | Internal timestamp indicating when the profile was generated. |

---

## 🚀 Step-by-Step Testing Instructions

Follow these clear instructions directly on your mobile browser or computer to run a complete evaluation pass of the system:

1. **Access the Gateway:** Click the live web application hyperlink provided at the top of this documentation file.
2. **Execute Registration:** Fill out the **Create Account** module form. Select your target role (e.g., choose `Medical Volunteer / Doctor` or `Healthcare Content Administrator`) and tap **Get Started**.
3. **Portal Login:** The interface will process the payload and redirect you to the login screen. Type your email and password credentials, then tap **Secure Login**.
4. **Explore Workspace Features:** Upon verification, the authorization cards disappear, and your dynamic workspace workspace populates. 
   * *Notice Role Controls:* If you register as a **Donor**, the system automatically hides the **"New Camp"** action button because Donors lack data entry permissions. If you log in as a **Doctor** or **Admin**, the administrative action button becomes fully visible!
5. **Session Exit:** Tap the **Logout** button in the top right corner to clear your active dashboard view and safely return to the secure login card.

---

## 🗃️ Module 2: Home Page Management Schema Design

To support administrative dynamic text updates across the public healthcare landing components, the following database architecture handles configuration parameters and impact tracking metrics:

### Table 1: `configurations` (Stores Hero Banner values)
| Column Name | Data Type | Key Attributes | Field Description |
| :--- | :--- | :--- | :--- |
| `id` | `INT` | `PRIMARY KEY`, `AUTO_INCREMENT` | Unique configuration ID |
| `key_name` | `VARCHAR(50)` | `NOT NULL`, `UNIQUE` | Unique identifier key (e.g., `hero_title`) |
| `value_text` | `TEXT` | `NOT NULL` | The actual message payload displayed on the landing page |

### Table 2: `statistics` (Stores Landing Numbers Counters)
| Column Name | Data Type | Key Attributes | Field Description |
| :--- | :--- | :--- | :--- |
| `id` | `INT` | `PRIMARY KEY`, `AUTO_INCREMENT` | Unique entry key |
| `stat_value` | `VARCHAR(50)` | `NOT NULL` | The counter number string (e.g., `10,000+`) |
| `stat_label` | `VARCHAR(100)` | `NOT NULL` | The helper description label text |
| `status` | `VARCHAR(20)` | `DEFAULT 'Active'` | Tracks soft deletes (`Active` / `Inactive`) |
# CarePulse - Healthcare Content Management System Portal

An interactive, responsive Content Management System (CMS) designed for community healthcare organizations to track, update, and showcase medical initiatives dynamically.

---

## 🌐 Live Project Deployment Links
* **Live Hosted Application Website:** [Click here to view Live Site](https://yourusername.github.io/healthcare-cms-project/index.html)
* **GitHub Source Code Repository:** [Click here to view Code](https://github.com/yourusername/healthcare-cms-project)

---

## 📱 Application Modules & Architecture

### 1. Public Front-End Module
* **Homepage (`index.html`):** Renders the primary brand landing experience including a dynamic hero banner tagline, real-time impact metric counters, operational field drives, and verified NGO contact components.
* **About Us Module (`about.html`):** Renders the organizational narrative history timeline, an interactive core values matrix, and corporate profile cards of the executive leadership team.

### 2. Client-Side CMS Backend Management Module
Because this system is hosted on static servers (GitHub Pages), the server-side backend operations are completely simulated using **Client-Side JavaScript Event Listeners**.
* **Portal Gateway (`login.html`):** An authorized security gateway credential mask allowing simulated logins and role assignment verification (Donor, Doctor, Administrator).
* **Live Content Editor Panels:** Selecting the admin controls on the pages collapses the public layouts and dynamically opens text-area blocks, field arrays, and operational tables equipped with explicit **Edit** and **Delete** action triggers.

---

## 🗄️ Database Architecture Schema Designs
The system layout maps directly to the following relational database schemas designed for future SQL production migration:

### Module 1: Core Landing Tables
1. **`banners`**: Maps homepage slider elements, image paths, text strings, and display sorting order indicators.
2. **`statistic`**: Controls high-visibility counter numbers displaying public achievement metrics.

### Module 2: About Us Tables
1. **`our_story`**: Manages the multi-line rich text block containing the primary corporate historical overview.
2. **`core_values`**: Tracks individual rows representing structural virtues alongside matching graphical icon strings.
3. **`programs`**: Houses active community campaign names and summaries.
4. **`team_members`**: Manages the comprehensive internal workforce workforce matrix spreadsheet tracking Full Names, Assigned Designations, and Profile Media Path pointers.

---

## 🛠️ Technology Stack Used
* **Markup & Core Structure:** HTML5
* **Stuffs & Graphical Layout Layouts:** CSS3
* **Responsive Layout Utility Grid System:** Bootstrap 5.3
* **Dynamic Graphical Elements & Typography:** FontAwesome 6.4, Google Fonts
* **Simulated Content Engine Processing Rules:** Client-Side JavaScript (ES6+)
* **Hosting Platform:** GitHub Pages


