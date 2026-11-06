
<html>
<head>
    <title>Factorial of a number</title>
</head>
<body style="text-align:center;">

    <h2>Factorial of a number</h2>

    <form method="POST">
        Enter a Number:
     
<input type="number" name="num" required>

        <input type="submit" name="submit" value="CHECK">
    </form>

    <?php
    if(isset($_POST['submit']))
    {
        $n = $_POST['num'];
        $fact = 1;
        for ($i=1; $i<=$n;$i++)
        {
        	$fact = $fact * $i;
        }
        echo  "<h3>factorial of $n is $fact</h3>";
}


    ?>

</body>
</html>

