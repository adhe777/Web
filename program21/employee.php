
<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();


$conn = new mysqli("localhost", "root", "", "employee_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = "";


if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    unset($_SESSION['message']);
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['save'])) {


    $id = $_POST['id'] ?? '';
    $name = trim($_POST['name'] ?? '');
    $age = $_POST['age'] ?? '';
    $gender = $_POST['gender'] ?? '';
    $salary = $_POST['salary'] ?? '';
    $email = trim($_POST['email'] ?? '');


    if (
        $id === '' ||
        $name === '' ||
        $age === '' ||
        $gender === '' ||
        $salary === '' ||
        $email === ''
    ) {

        $message = "Warning: Please fill in all fields!";

    } else {

     
        $check = $conn->prepare("SELECT id FROM employee WHERE id = ?");
        $check->bind_param("i", $id);
        $check->execute();
        $check->store_result();

        if ($check->num_rows > 0) {

            $message = "Warning: Employee ID already exists! Please enter a different ID.";

        } else {


            $sql = "INSERT INTO employee
            (id, name, age, gender, salary, email)
            VALUES (?, ?, ?, ?, ?, ?)";

            $stmt = $conn->prepare($sql);

            $stmt->bind_param(
                "isisss",
                $id,
                $name,
                $age,
                $gender,
                $salary,
                $email
            );

            if ($stmt->execute()) {

                $message = "Employee details saved successfully!";

            } else {

                $message = "Error: " . $stmt->error;

            }

            $stmt->close();
        }

        $check->close();
    }


    $_SESSION['message'] = $message;


    header("Location: employee.php");
    exit();
}

?>

<html>
<head>
    <title>Employee Management System</title>
</head>

<body>

<center>

<h3>EMPLOYEE REGISTRATION</h3>

<form method="POST" action="employee.php">

<table border="1" cellpadding="5">

<tr>
    <td>Employee ID</td>
    <td>
        <input type="number" name="id" required>
    </td>
</tr>

<tr>
    <td>Name</td>
    <td>
        <input type="text" name="name" required>
    </td>
</tr>

<tr>
    <td>Age</td>
    <td>
        <input type="number" name="age" required>
    </td>
</tr>

<tr>
    <td>Gender</td>
    <td>
        <input type="radio" name="gender" value="Male" required> Male
        <input type="radio" name="gender" value="Female" required> Female
    </td>
</tr>

<tr>
    <td>Salary</td>
    <td>
        <input type="number" name="salary" step="0.01" required>
    </td>
</tr>

<tr>
    <td>Email</td>
    <td>
        <input type="email" name="email" required>
    </td>
</tr>

<tr>
    <td colspan="2" align="center">
        <input type="submit" name="save" value="Save">
    </td>
</tr>

</table>

</form>


<h4>
<?php
echo htmlspecialchars($message);
?>
</h4>

<br>

<h3>EMPLOYEE DETAILS</h3>

<table border="1" cellpadding="5">

<tr>
    <th>Employee ID</th>
    <th>Name</th>
    <th>Age</th>
    <th>Gender</th>
    <th>Salary</th>
    <th>Email</th>
</tr>

<?php


$result = $conn->query("SELECT * FROM employee ORDER BY id");

if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {

        echo "<tr>";

        echo "<td>" . htmlspecialchars($row['id']) . "</td>";
        echo "<td>" . htmlspecialchars($row['name']) . "</td>";
        echo "<td>" . htmlspecialchars($row['age']) . "</td>";
        echo "<td>" . htmlspecialchars($row['gender']) . "</td>";
        echo "<td>" . htmlspecialchars($row['salary']) . "</td>";
        echo "<td>" . htmlspecialchars($row['email']) . "</td>";

        echo "</tr>";
    }

} else {

    echo "<tr>";
    echo "<td colspan='6'>No records found</td>";
    echo "</tr>";

}

$conn->close();

?>

</table>

</center>

</body>
</html>

