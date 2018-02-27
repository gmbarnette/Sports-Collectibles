<?php

include 'db.php';

if (isset($_POST['submit'])){
	
  $sportName =$conn->real_escape_string($_POST['addSport']);
  $sportName = strtolower($sportName);
  $sportName = ucwords($sportName);

  $query = "INSERT INTO sports (sport) VALUES ('$sportName')";
  $result = $conn->query($query);
	
  if($result) {
	
    $message = "Records added successfully";
	}
	
  else {
	$message =  "ERROR:". $conn->error;
	}
	
}
elseif (isset($_POST['delete'])){
	
  $sportName = $conn->real_escape_string($_POST['addSport']);

  $query = "DELETE FROM sports WHERE sport = '$sportName'";
  $result = $conn->query($query);

  if($result) {
    $message = "Record Deleted Succesfully";
  }
  else {
		$message = "ERROR:DELETION FAILED";
  }
	
}
?>
<!DOCTYPE html PUBLIC '-//W3C/DTD XHTML 1.0 strict//EN'
'http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd'>

<html>
  <head><link rel = 'stylesheet' type = 'text/css' href = 'collector.css'>
</head>

<body>
  <?php include 'pageLayout.php'; ?>  
<p> <?php echo $message; ?> </p>

  <form method = 'post'>
    <table class = 'formTable'>
      <tbody>
        <tr class = 'formData'>
		  <td class = 'formLabel'>Sport:</td>
		  <td class = 'formInput'><input type = 'text' autocomplete = 'off' name = 'addSport' size = 30></td>
		</tr>
        <tr class = 'formSubmit'>
		  <td class = 'formSubmit' colspan = 2>
	        <input type = 'submit' value = 'submit' name = 'submit'>
            <input type = 'submit' name = 'delete' value = 'delete'>
	      </td>
		</tr>
      </tbody>
    </table>
  </form>
  <br>
  <br>
 
 <?php
 
 $query = "SELECT * FROM Sports";
 $result = $conn->query($query);

 if($result->num_rows > 0){
   ?> 
   
   <table id = 'sportsTable'>
   <tr>
     <th>Sport</th>
   </tr>
     <tbody>
	   <?php
	   while($row = $result->fetch_assoc()){
	     ?>
		 
		 <tr>
		   <td class = 'tableData'> <?php echo $row['sport'] ?>
		   
		   </td> 
		 </tr>
	   <?php } 
 }
 else {
   ?>
   <p>0 results</p>
 <?php } ?>
 
     </tbody>
   </table>
</body>
</html>			  

<?php
$conn->close();
?>


  
