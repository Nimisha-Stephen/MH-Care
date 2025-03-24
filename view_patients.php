<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'mh_care');

// Redirect if user is not logged in
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

// Fetch all patients alphabetically
$result = $conn->query("SELECT * FROM patients ORDER BY last_name ASC, first_name ASC");
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Patient List</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        a button {
            padding: 8px 12px;
            margin: 2px;
            border: none;
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }
        a button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <header>Alphabetized Patient List</header>
    <div class="content">     
        <h2>All Patients in the Practice</h2>
        <table>
            <thead>
                <tr>
                    <th>Patient ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Gender</th>
                    <th>DOB</th>
                    <th>Address</th>
                    <th>City</th>
                    <th>Province</th>
                    <th>Postal Code</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Medications</th>
                    <th>Allergies</th>
                    <th>Doctor</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['patient_id']; ?></td>
                    <td><?php echo $row['first_name']; ?></td>
                    <td><?php echo $row['last_name']; ?></td>
                    <td><?php echo $row['gender']; ?></td>
                    <td><?php echo $row['dob']; ?></td>
                    <td><?php echo $row['address']; ?></td>
                    <td><?php echo $row['city']; ?></td>
                    <td><?php echo $row['province']; ?></td>
                    <td><?php echo $row['postal_code']; ?></td>
                    <td><?php echo $row['phone']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['medications']; ?></td>
                    <td><?php echo $row['allergies']; ?></td>
                    <td><?php echo $row['referring_doctor']; ?></td>
                    
                
                    <td>
                        <a href="edit_patient.php?id=<?php echo $row['patient_id']; ?>"><button>Edit</button></a>
                        <a href="delete_patient.php?id=<?php echo $row['patient_id']; ?>" onclick="return confirm('Are you sure you want to delete this patient?');"><button>Delete</button></a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <br>
        <a href="dashboard.php"><button>Back to Dashboard</button></a>
    </div>

</body>
</html>
