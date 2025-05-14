🗂️ Personal Task Manager with Categories
A simple and effective personal task management web app built using PHP and MySQL. This application allows users to create, organize, and track their tasks by categories and due dates.

🌟 Features
✔️ Add, update, and delete tasks
🗃️ Organize tasks into categories
⏳ Set and manage due dates
🔍 Filter tasks by category or due date
💾 Persistent data storage using MySQL via XAMPP
🛠️ Technologies Used
Frontend: HTML, CSS, Bootstrap
Backend: PHP
Database: MySQL (via XAMPP)
Server: Apache (XAMPP)
📦 Installation & Setup
C:\xampp\htdocs\personal-task-manager Start Apache and MySQL using the XAMPP Control Panel.

Set up the database

Open http://localhost/phpmyadmin

Create a new database (e.g., task_manager)

Import the provided schema.sql file (if available) to create the tables.

Configure database connection

Open config.php (or wherever DB settings are defined)

Update with your MySQL credentials:

php Copy Edit $host = 'localhost'; $db = 'task_manager'; $user = 'root'; $pass = ''; Access the app

Open your browser and go to:

http://localhost/personal-task-manager/ 🧾 Project Structure

personal-task-manager/ │ ├── index.php ├── add_task.php ├── edit_task.php ├── delete_task.php ├── config.php ├── db/ │ └── schema.sql ├── includes/ │ └── header.php, footer.php ├── css/ │ └── styles.css └── README.md 🚧 Future Enhancements User login & authentication

Task prioritization

Notifications for upcoming deadlines
