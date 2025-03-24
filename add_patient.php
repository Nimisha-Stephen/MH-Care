<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'mh_care');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $conn->prepare("INSERT INTO patients (first_name, last_name, gender, dob, address, city, province, postal_code, phone, email, medications, allergies, referring_doctor) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param(
        "sssssssssssss",
        $_POST['first_name'], $_POST['last_name'], $_POST['gender'], $_POST['dob'], $_POST['address'], $_POST['city'],
        $_POST['province'], $_POST['postal_code'], $_POST['phone'], $_POST['email'], $_POST['medications'],
        $_POST['allergies'], $_POST['referring_doctor']
    );
    $stmt->execute();
    header('Location: dashboard.php');
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Add Patient</title>
</head>
<body>
    <header>Add New Patient</header>
    <div class="container">
        <form method="POST">
            <input type="text" name="first_name" placeholder="First Name" required>
            <input type="text" name="last_name" placeholder="Last Name" required>
            <select name="gender" required>
                <option value="">Select Gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
            </select>
            <label for="date">DOB</label>
            <input type="date" name="dob" required >
            <textarea name="address" placeholder="Address" required></textarea>
            <input type="text" name="city" placeholder="City" required>
            <input type="text" name="province" placeholder="Province" required>
            <input type="text" name="postal_code" placeholder="Postal Code" required>
            <input type="text" name="phone" placeholder="Phone" required>
            <input type="email" name="email" placeholder="Email" required>
            <textarea name="medications" placeholder="List of Medications"></textarea>
            <textarea name="allergies" placeholder="List of Allergies"></textarea>
            <input type="text" name="referring_doctor" placeholder="Referring Doctor">
            <button type="submit">Add Patient</button>
        </form>
       <a href="dashboard.php"><button style="margin-top: 15px;">Back to Dashboard</button></a>   
    </div>
</body>
</html>
