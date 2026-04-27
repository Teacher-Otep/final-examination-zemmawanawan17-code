<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Operations</title>
    <link   rel="stylesheet" href="style.css">
</head>
<body>
    <nav class="navbar">
            <img src="../images/northhub.svg" id="logo" onclick="goHome()">
            <button class="navbarbuttons" onclick="showSection('create')"> Create </button>
            <button class="navbarbuttons" > Read </button>
            <button class="navbarbuttons" > Update </button>
            <button class="navbarbuttons" > Delete </button>
    </nav>
    <section id="home" class="homecontent"> 
        <h1 class="splash">Welcome to Student Management System</h1>
        <h2 class="splash">A Project in Integrative Programming Technologies</h2>
    </section>
    
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

<br/><br/><br/><br/>

   <section id="read" class="content">
    <h1 class="contenttitle"> View Students </h1>

    <?php include '../includes/read.php'; ?>
</section>

    <section id="update" class="content">
    <h1 class="contenttitle"> Update Student </h1>

    <form action="../includes/update.php" method="POST">

        <label>ID</label>
        <input type="number" name="id" required><br>

        <label>Name</label>
        <input type="text" name="name"><br>

        <label>Surname</label>
        <input type="text" name="surname"><br>

        <button type="submit">Update</button>

    </form>
</section>
    
<section id="delete" class="content">
    <h1 class="contenttitle"> Delete Student </h1>

    <form action="../includes/delete.php" method="POST">

        <label>Student ID</label>
        <input type="number" name="id" required><br>

        <button type="submit">Delete</button>

    </form>
</section>



    <script src="script.js"></script>
</body>
</html>