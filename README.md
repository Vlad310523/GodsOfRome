# GodsOfRome
## 📦 Installation Guide

### 1. Requirements

Before you begin, make sure your system has the following:

- A web server (e.g., Apache or Nginx)
- PHP 8.0 or higher
- MySQL 5.7 or higher
- Composer (optional, if you're using external PHP packages)

---

### 2. Clone the Repository

git clone https://github.com/yourusername/GodsOfRome.git
cd GodsOfRome

### 3. Import the Database
If the database does not yet exist, create it using MySQL:
CREATE DATABASE db_godsofrome CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

Then import the SQL dump:
mysql -u root -p gods_of_rome < database/db_godsofrome.sql

### 4. Configure Database Connection
Open the configuration file at classes/configdb.php and update the credentials.
$db = new mysqli('localhost', 'root', '', 'db_godsofrome');

### 5. Run the Project Locally
Use PHP's built-in server:
php -S localhost:8000

Then open your browser and go to:
http://localhost:8000
