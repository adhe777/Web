

<html>
<head>
    <title>Odd or Even</title>
</head>
<body style="text-align:center;">

    <h2>Check Odd or Even</h2>

    <form method="GET">
        Enter a Number:
     
<input type="number" name="num" required>

        <input type="submit" name="submit" value="CHECK">
    </form>

    <?php
    if(isset($_GET['submit']))
    {
        $n = $_GET['num'];

        if($n % 2 == 0)
        {
            echo "<h3>$n is EVEN</h3>";
        }
        else
        {
            echo "<h3>$n is ODD</h3>";
        }
    }
    ?>

</body>
</html>

