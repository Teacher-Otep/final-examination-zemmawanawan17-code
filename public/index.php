<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CRUD Operations</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
 
<?php require_once '../includes/db.php'; ?>
 
<!-- ═══════════ NAV ═══════════ -->
<nav>
  <!-- Logo: replace logo.svg with your own SVG file in /images/ -->
  <div class="logo-wrap" id="logo" title="Click to hide/show sections">
    <img src="../images/logo.svg" alt="Logo">
  </div>
 
  <button id="btn-create" onclick="showSection('create')">Create</button>
  <button id="btn-read"   onclick="showSection('read')">Read</button>
  <button id="btn-update" onclick="showSection('update')">Update</button>
  <button id="btn-delete" onclick="showSection('delete')">Delete</button>
</nav>
 
<!-- ═══════════ HOME ═══════════ -->
<section id="home" class="visible">
  <h1>Welcome to Student Management System</h1>
  <h2>A Project in Integrative Programming Technologies</h2>
</section>
 
<!-- ═══════════ CREATE ═══════════ -->
<section id="create" class="content">
  <h2>Insert New Student</h2>
  <div id="create-msg" class="msg">
    <?php
      if (isset($_GET['status']) && $_GET['status'] === 'inserted') {
        echo '<div class="msg success">Student saved successfully!</div>';
      }
    ?>
  </div>
  <form action="../includes/insert.php" method="POST">
    <div class="form-grid">
      <label>Surname</label>
      <input type="text" name="surname" id="c-surname" required>
 
      <label>Name</label>
      <input type="text" name="name" id="c-name" required>
 
      <label>Middle name</label>
      <input type="text" name="midname" id="c-midname">
 
      <label>Address</label>
      <input type="text" name="address" id="c-address">
 
      <label>Mobile Number</label>
      <input type="text" name="mobile" id="c-mobile">
    </div>
    <div class="btn-row">
      <button type="button" class="btn" onclick="clearCreate()">Clear Fields</button>
      <button type="submit" class="btn btn-primary">Save</button>
    </div>
  </form>
</section>
 
<!-- ═══════════ READ ═══════════ -->
<section id="read" class="content">
  <h2>Student Records</h2>
  <?php
  $result = $conn->query("SELECT * FROM students ORDER BY id ASC");
    if ($result && $result->num_rows > 0):
  ?>
  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Surname</th>
        <th>Name</th>
        <th>Middle Name</th>
        <th>Address</th>
        <th>Mobile Number</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = $result->fetch_assoc()): ?>
      <tr>
        <td><?= htmlspecialchars($row['id']) ?></td>
        <td><?= htmlspecialchars($row['surname']) ?></td>
        <td><?= htmlspecialchars($row['name']) ?></td>
        <td><?= htmlspecialchars($row['midname']) ?></td>
        <td><?= htmlspecialchars($row['address']) ?></td>
        <td><?= htmlspecialchars($row['mobile']) ?></td>
      </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
  <?php else: ?>
  <p id="no-records" style="display:block;">No student records yet. Use the Create section to add students.</p>
  <?php endif; ?>
</section>
 
<!-- ═══════════ UPDATE ═══════════ -->
<section id="update" class="content">
  <h2>Update Student Record</h2>
  <div id="update-msg" class="msg">
    <?php
      if (isset($_GET['status']) && $_GET['status'] === 'updated') {
        echo '<div class="msg success">Student record updated successfully!</div>';
      }
    ?>
  </div>
 
  <!-- Step 1: Select student by ID -->
  <div class="select-row">
    <label>Select Student by ID:</label>
    <select id="u-select" onchange="loadStudentAjax(this.value)">
      <option value="">-- Select --</option>
      <?php
        $res = $conn->query("SELECT id, surname, name FROM students ORDER BY id ASC");
        while ($row = $res->fetch_assoc()):
      ?>
      <option value="<?= $row['id'] ?>"><?= $row['id'] ?> – <?= htmlspecialchars($row['surname']) ?>, <?= htmlspecialchars($row['name']) ?></option>
      <?php endwhile; ?>
    </select>
  </div>
 
  <!-- Step 2: Edit form (populated via JS) -->
  <form action="../includes/update.php" method="POST" id="update-form" style="display:none;">
    <input type="hidden" name="id" id="u-id">
    <div class="form-grid">
      <label>Surname</label>      <input type="text" name="surname"  id="u-surname" required>
      <label>Name</label>         <input type="text" name="name"     id="u-name"    required>
      <label>Middle Name</label>  <input type="text" name="midname"  id="u-midname">
      <label>Address</label>      <input type="text" name="address"  id="u-address">
      <label>Mobile Number</label><input type="text" name="mobile"   id="u-mobile">
    </div>
    <div class="btn-row">
      <button type="button" class="btn" onclick="clearUpdate()">Clear Fields</button>
      <button type="submit" class="btn btn-primary">Update</button>
    </div>
  </form>
</section>
 
<!-- ═══════════ DELETE ═══════════ -->
<section id="delete" class="content">
  <h2>Delete Student</h2>
  <div id="delete-msg" class="msg">
    <?php
      if (isset($_GET['status']) && $_GET['status'] === 'deleted') {
        echo '<div class="msg success">Student deleted successfully.</div>';
      }
    ?>
  </div>
 
  <div class="select-row">
    <label>Select Student by ID:</label>
    <select id="d-select" onchange="loadDeleteInfo(this.value)">
      <option value="">-- Select --</option>
      <?php
        $res2 = $conn->query("SELECT id, surname, name FROM students ORDER BY id ASC");
        while ($row = $res2->fetch_assoc()):
      ?>
      <option value="<?= $row['id'] ?>"><?= $row['id'] ?> – <?= htmlspecialchars($row['surname']) ?>, <?= htmlspecialchars($row['name']) ?></option>
      <?php endwhile; ?>
    </select>
  </div>
 
  <div id="delete-info"></div>
 
  <form action="../includes/delete.php" method="POST" id="delete-form" style="display:none;">
    <input type="hidden" name="id" id="d-id">
    <div class="btn-row">
      <button type="submit" class="btn btn-danger">Delete Student</button>
      <button type="button" class="btn" onclick="cancelDelete()">Cancel</button>
    </div>
  </form>
</section>
 
<script src="script.js"></script>
</body>
</html>
