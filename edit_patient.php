<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'mh_care');

// Redirect if user is not logged in
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

// Fetch patient details for editing
if (isset($_GET['id'])) {
    $stmt = $conn->prepare("SELECT * FROM patients WHERE patient_id = ?");
    $stmt->bind_param("i", $_GET['id']);
    $stmt->execute();
    $result = $stmt->get_result();
    $patient = $result->fetch_assoc();
}

// Update patient details
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $conn->prepare("UPDATE patients SET first_name = ?, last_name = ?, gender = ?, dob = ?, phone = ?, email = ?, address = ?, city = ?, province = ?, postal_code = ?, medications = ?, allergies = ?, referring_doctor = ? WHERE patient_id = ?");
    $stmt->bind_param(
        "sssssssssssssi",
        $_POST['first_name'], $_POST['last_name'], $_POST['gender'], $_POST['dob'], $_POST['phone'], 
        $_POST['email'], $_POST['address'], $_POST['city'], $_POST['province'], $_POST['postal_code'], 
        $_POST['medications'], $_POST['allergies'], $_POST['referring_doctor'], $_POST['patient_id']
    );
    $stmt->execute();
    header('Location: view_patients.php');
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Edit Patient</title>
</head>
<body>
    <header>Edit Patient Information</header>
    <div class="container">
        <form method="POST">
            <input type="hidden" name="patient_id" value="<?php echo $patient['patient_id']; ?>">
            <input type="text" name="first_name" value="<?php echo $patient['first_name']; ?>" required>
            <input type="text" name="last_name" value="<?php echo $patient['last_name']; ?>" required>
            <select name="gender" required>
                <option value="Male" <?php if ($patient['gender'] === 'Male') echo 'selected'; ?>>Male</option>
                <option value="Female" <?php if ($patient['gender'] === 'Female') echo 'selected'; ?>>Female</option>
                <option value="Other" <?php if ($patient['gender'] === 'Other') echo 'selected'; ?>>Other</option>
            </select>
            <label for="date">DOB</label>
            <input type="date" name="dob" value="<?php echo $patient['dob']; ?>" required>
            <input type="text" name="phone" value="<?php echo $patient['phone']; ?>" required>
            <input type="email" name="email" value="<?php echo $patient['email']; ?>" required>
            <textarea name="address"><?php echo $patient['address']; ?></textarea>
            <input type="text" name="city" value="<?php echo $patient['city']; ?>">
            <input type="text" name="province" value="<?php echo $patient['province']; ?>">
            <input type="text" name="postal_code" value="<?php echo $patient['postal_code']; ?>">
            <textarea name="medications"><?php echo $patient['medications']; ?></textarea>
            <textarea name="allergies"><?php echo $patient['allergies']; ?></textarea>
            <input type="text" name="referring_doctor" value="<?php echo $patient['referring_doctor']; ?>">
            <button type="submit">Save Changes</button>
        </form>
    </div>
</body>
</html>
