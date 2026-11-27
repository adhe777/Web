
<!DOCTYPE html>
<html>
<head>
    <title>Student Form</title>
</head>
<body>

    <h2 align="center">Student Form</h2>

    <form method="POST">
        <table border="1" align="center">

            <tr>
                <td>Name</td>
                <td><input type="text" name="name" required></td>
            </tr>

            <tr>
                <td>Email ID</td>
                <td><input type="email" name="mail" required></td>
            </tr>

            <tr>
                <td>Address</td>
                <td><input type="text" name="address" required></td>
            </tr>

            <tr>
                <td>Gender</td>
                <td>
                    <input type="radio" name="gender" value="Male" required> Male
                    <input type="radio" name="gender" value="Female"> Female
                </td>
            </tr>

            <tr>
                <td>Date Of Birth</td>
                <td><input type="date" name="dob" required></td>
            </tr>

            <tr>
                <td colspan="2" align="center">
                    <input type="submit" name="submit" value="Submit">
                </td>
            </tr>

        </table>
    </form>

    <?php

    if(isset($_POST['submit']))
    {
        $name = htmlspecialchars($_POST['name']);
        $mail = htmlspecialchars($_POST['mail']);
        $address = htmlspecialchars($_POST['address']);
        $gender = htmlspecialchars($_POST['gender']);
        $dob = htmlspecialchars($_POST['dob']);

        echo "<h3 align='center' style='color:green;'>
        Student Details Submitted Successfully!
        </h3>";

        echo "<h3 align='center'>Student Details</h3>";

        echo "<table border='1' align='center'>";

        echo "<tr><td>Name</td><td>$name</td></tr>";

        echo "<tr><td>Email ID</td><td>$mail</td></tr>";

        echo "<tr><td>Address</td><td>$address</td></tr>";

        echo "<tr><td>Gender</td><td>$gender</td></tr>";

        echo "<tr><td>Date Of Birth</td><td>$dob</td></tr>";

        echo "</table>";
    }

    ?>

</body>
</html>

