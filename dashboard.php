<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Dashboard</title>
</head>
<body>
    <header>MH-Care Dashboard</header>
    <div class="container">
        <h2>Welcome, <?php echo $_SESSION['user']; ?>!</h2>
        <a href="add_patient.php"><button>Add Patient</button></a>
        <a href="view_patients.php"><button>View Patients</button></a>
        <a href="logout.php"><button>Logout</button></a>
    </div>
</body>
</html>
