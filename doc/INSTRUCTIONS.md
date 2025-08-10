# ExpoIngenierias Website

A web application for managing engineering projects, with different portals for judges, students, and administrators. 

## Prerequisites

Before starting, it is important to have installed a local web server environment. In this case, XAMPP. You can download XAMPP in [its official website](https://www.apachefriends.org/es/index.html). Other options are WAMP or MAMP.

It is important that your local web server includes:

* Apache (Web Server)
* PHP
* MySQL/MariaDB (Database Server)
* phpMyAdmin (for database management)

## Setup Instructions

Follow these steps to get the project running on your local machine.

### 1. Place Project Files

1. Clone the project or download a `.zip` file. Then, unzip it.
2. Copy the entire `Web_ExpoIngenierias` folder into your web server's document root. While using XAMPP, follow the next path: `C:\xampp\htdocs\`

### 2. Database Setup

The project requires a database to store information about projects, users, and evaluations.

1. **Start Services**:

    * Launch your local web server (XAMPP) control panel.
    * Start the **Apache** and **MySQL** services.

2. **Create a Database**:

    * Open your web browser and navigate to `http://localhost/phpmyadmin`.
    * Click on the **"Databases"** tab at the top.
    * Under "Create database", enter a name for the database (like `expo_ingenierias`)
    * Click **"Create"**.

3. **Import Data**:

    * Click on the new database you just created in the left-hand sidebar.
    * Click on the **"Import"** tab at the top.
    * Click on **"Choose File"** and navigate to the project's directory. Select the `doc/database.sql` file.
    * Scroll to the bottom of the page and click **"Go"**. This will execute the script and create all the necessary database tables, based on the different portals needed.

### 3. Configure Database Connection

The PHP application needs to know how to connect to the database. Therefore, it is necessary to edit the credentials and variables.

1. You must update the database connection credentials in the project's PHP files. Navigate to the following files:

    * `inicioadmin/conexioninicio.php`
    * `inicioestudiante/conexioninicio.php`
    * `iniciojuez/conexioninicio.php`
    * `inicioprof/conexioninicio.php`

2. Open these file in a code editor. You will see code like this:

    ```php
    <?php
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "password";
    $dbname = "expo_ingenierias";
    
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    // ...
    ?>
    ```

3. **Edit the variables** to match your local database setup:
    * `$dbhost`: `localhost`, typically.
    * `$dbuser`: The username for your database. For XAMPP, this is typically `root`.
    * `$dbpass`: The password for your database user. For a default XAMPP install, this is an empty string (`""`).
    * `$dbname`: The name of the database you created in the previous step (in this case `expo_ingenierias`).

### 4. Run the Application

Once the files are in place and the database is configured, you can access the site.

1. Open your web browser.
2. Navigate to the project's URL on your local server. These are the following portals:

    * **Main Page**: `http://localhost/Web_ExpoIngenierias/`
    * **Admin**: `http://localhost/Web_ExpoIngenierias/inicioadmin/`
    * **Student**: `http://localhost/Web_ExpoIngenierias/inicioestudiante/`
    * **Judge**: `http://localhost/Web_ExpoIngenierias/iniciojuez/`
    * **Professor**: `http://localhost/Web_ExpoIngenierias/inicioprof/`

You should now see the login page for the respective section of the website.

You can test the site with the credentials located on [accounts.md](doc/accounts.md).
