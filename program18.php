<html>
	<body>
		<h2 align ='center'>Student Form</h2>
		
		<form method = "POST">
			<table border='1' align="center" >
				<tr>
					<td> Name  </td> 
					<td> <input type="text"  name="name"></td>
				</tr>
				<tr>
					<td>Email ID </td>
					<td><input type="email"  name="mail"></td>
				</tr>
				<tr>
					<td>Address  </td>
					<td><input type="text"  name="address"></td>	
				</tr>
				<tr>
					<td>Gender  </td>
					<td><input type="radio"  name="gender" value="male">  male
					<input type="radio"  name="gender" value="female">  Female</td>
				</tr>
				<tr>
					<td>Date Of Birth  </td>
					<td><input type="date" name="dob" ></td>
				</tr>
				<tr>
					<td colspan="2">
						<input type="submit" name="submit" value="submit">
					</td>
				</tr>
	
			</table>
		</form>
		
               		<?php
				if(isset($_REQUEST['submit']))
				{
					echo   "<h3 align ='center'> Student Details </h3>";
					echo "<table border='1' align='center'>";
					
					echo  "<tr><td> Name </td><td>". $_REQUEST['name']. "</td></tr>";
					echo "<tr><td>Email ID </td><td>" . $_REQUEST['mail']. "</td></tr>";
					echo "<tr><td>Address </td><td> " .$_REQUEST['address']."</td></tr>";
					echo "<tr><td>Gender </td><td> ".$_REQUEST['gender']."</td></tr>";
					echo "<tr><td>Date Of Birth </td><td> " .$_REQUEST['dob']."</td></tr>";
					
					echo "</table>";
					
					
				}
		?>
			
	</body>
</html>
			
