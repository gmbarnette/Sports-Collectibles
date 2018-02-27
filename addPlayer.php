<?php

include 'db.php';

if (isset($_POST['Submit'])){

  $sportName = ucwords(strtolower($conn->real_escape_string($_POST['addSport'])));
  $firstName = ucwords(strtolower($conn->real_escape_string($_POST['firstName'])));
  $lastName = ucwords(strtolower($conn->real_escape_string($_POST['lastName'])));
  
  $query = "INSERT INTO playerList (firstName, lastName, fullName, sport)
            VALUES ('$firstName', '$lastName', '$firstName $lastName','$sportName')";
  $result = $conn->query($query);
  
  if ($result) {
    $message = "Record Added Succesfully";
  }
  
  else {
    $message = "ERROR:" . $conn->error;
  }    
}

elseif (isset($_POST['Delete'])) {
  
  $sportName = ucwords(strtolower($conn->real_escape_string($_POST['addSport'])));
  $firstName = ucwords(strtolower($conn->real_escape_string($_POST['firstName'])));
  $lastName = ucwords(strtolower($conn->real_escape_string($_POST['lastName'])));
  
  $query = "DELETE FROM playerList 
            WHERE fullName = '$firstName $lastName' AND sport = '$sportName'";
  $result = $conn->query($query);
  
  if ($result) {
    $message = "Record Deleted Succesfully";
  }
  
  else {
    $message = "ERROR:" . $conn->error;
  }    
}

?>

<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 strict//EN'
'http://www.w3.org/TR/xhtml1/DTD/xhtml1-stricct.dtd'>

<html>
<head>
  <link rel = 'stylesheet' type = 'text/css' href = 'collector.css'>
</head>
<body>
<?php include 'pageLayout.php'; ?>  
  <p><?php echo $message; ?></p>  
  <form action = '' method = 'POST'>
    <table class = 'formTable'>
      <tbody>
        <tr class = 'formData'>
          <td class = 'formLabel'>
            Sport
          </td>
          <td class = 'formInput'>
            <select name = 'addSport'>
              <option name = 'Select One' value = '' disable selected = 'selected'>-SELECT ONE-
              <?php
              
              $query = "SELECT * FROM sports";
              $result = $conn->query($query);
              
              while ($row = $result->fetch_assoc()) {
                ?>
                
                <option name = '<?php echo $row['sport']; ?>'value = '<?php echo $row['sport']; ?>'> <?php echo $row['sport']
                ; 
              }?>
            </select>
          </td>
        </tr>
        <tr class = 'formData'>
          <td class = 'formLabel'>
            First Name:
          </td>
          <td class = 'formInput'>
            <input type = 'text' name = 'firstName' autocomplete = 'off' size = 20>
          </td>
        </tr>
        <tr class = 'formData'>
          <td class = 'formLabel'>
            Last Name:
          </td> 
          <td class = 'formInput'>
            <input type = 'text' name = 'lastName' autocomplete = 'off' size = 20>
          </td>
        </tr>
        <tr class = 'formSubmit'>
          <td colspan = 2>
            <input type = 'submit' name = 'Submit' value = 'Submit'>
            <input type = 'submit' name = 'Delete' value = 'Delete'>
          </td>
        </tr>
                    
      </tbody>
    </table>
  </form>
  
  <?php 
  
  $query = "SELECT * FROM playerList";
  $result = $conn->query($query);
  
  if ($result->num_rows > 0) {
    ?>
    
    <table id = 'playerTable'>
      <tr>
        <th>Player Name</th>
        <th>Sport</th>
      </tr>
      <tbody>
      
      <?php 
      
      while ($row = $result->fetch_assoc()) {
        ?>
        
        <tr>
          <td class = 'tableData'> <?php echo $row['fullName']; ?></td>
          <td class = 'tableData'> <?php echo $row['sport']; ?></td>
        </tr>
      
      <?php } ?>
      
      </tbody>
    </table>
      
  <?php }
  else {
    ?>
    
    <p>0 results</p>
  <?php } ?>
  
</body>
</html>

<?php
$conn->close();
?>