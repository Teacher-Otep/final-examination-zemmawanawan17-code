<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Operations</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav class="navbar">
        <img src="../images/northhub.svg" id="logo" onclick="goHome()">
        <button class="navbarbuttons" onclick="showSection('create')"> Create </button>        
        <button class="navbarbuttons" onclick="showSection('read')"> Read </button>
        <button class="navbarbuttons" onclick="showSection('update')"> Update </button>
        <button class="navbarbuttons" onclick="showSection('delete')"> Delete </button>
    </nav>

    <!-- Home Section -->
    <section id="home" class="homecontent"> 
        <h1 class="splash">Welcome to Student Management System</h1>
    </section>
    
    <!-- Create Section -->
    <section id="create" class="content">
        <h1 class="contenttitle"> Insert New Student </h1>

        <form action="../includes/insert.php" method="POST">
            <label for="surname" class="label">Surname</label>
            <input type="text" name="surname" id="surname" class="field" required><br/>

            <label for="name" class="label">Name</label>
            <input type="text" name="name" id="name" class="field" required><br/>

            <label for="middlename" class="label">Middle name</label>
            <input type="text" name="middlename" id="middlename" class="field"><br/>

            <label for="address" class="label">Address</label>
            <input type="text" name="address" id="address" class="field"><br/>

            <label for="contact" class="label">Mobile Number</label>
            <input type="text" name="contact" id="contact" class="field"><br/>

            <div id="btncontainer">
                <button type="button" id="clrbtn" class="btns">Clear Fields</button><br/>
                <button type="submit" id="savebtn" class="btns">Save</button>
            </div>

            <div id="success-toast" class="toast-hidden">
                Registration Successful!
            </div>
        </form>   
    </section>

    <!-- Read Section (Display Students) -->
    <section id="read" class="content">
        <h1 class="contenttitle"> View Students </h1>
        
        <?php
        require_once '../includes/db.php'; // Include the database connection

        // Fetch students from the database
        $stmt = $pdo->query("SELECT * FROM students");

        // Check if there are any students
        if ($stmt->rowCount() > 0) {
            echo "<table border='1' cellpadding='10'>";
            echo "<tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Surname</th>
                    <th>Middle Name</th>
                    <th>Address</th>
                    <th>Contact</th>
                </tr>";

            // Display each student in a table row
            while($row = $stmt->fetch()) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['name']}</td>
                        <td>{$row['surname']}</td>
                        <td>{$row['middlename']}</td>
                        <td>{$row['address']}</td>
                        <td>{$row['contact_number']}</td>
                    </tr>";
            }

            echo "</table>";
        } else {
            echo "No students found.";
        }
        ?>
    </section>

    <!-- Update Section -->
    <section id="update" class="content">
        <h1 class="contenttitle"> Update Student </h1>

        <form action="../includes/update.php" method="POST">
            <label>Select Student</label>
            <select name="id" required>
                <option value="">Choose ID</option>

                <?php
                require '../includes/db.php';
                $stmt = $pdo->query("SELECT id,name,surname FROM students");

                while($row = $stmt->fetch()) {
                    echo "<option value='{$row['id']}'>
                            {$row['id']} - {$row['name']} {$row['surname']}
                          </option>";
                }
                ?>
            </select><br><br>

            <label>Name</label>
            <input type="text" name="name"><br>

            <label>Surname</label>
            <input type="text" name="surname"><br>

            <button type="submit">Update</button>
        </form>
    </section>
    
    <!-- Delete Section -->
    <section id="delete" class="content">
        <h1 class="contenttitle"> Delete Student </h1>

        <form action="../includes/delete.php" method="POST">
            <label>Select Student</label>
            <select name="id" required>
                <option value="">Choose ID</option>

                <?php
                $stmt = $pdo->query("SELECT id,name,surname FROM students");

                while($row = $stmt->fetch()) {
                    echo "<option value='{$row['id']}'>
                            {$row['id']} - {$row['name']} {$row['surname']}
                          </option>";
                }
                ?>
            </select><br><br>

            <button type="submit">Delete</button>
        </form>
    </section>

    <script src="script.js"></script>
</body>
</html>