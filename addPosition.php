<?php

include 'db.php';

if (isset($_POST['Submit'])) {
  $sportName = ucwords(strtolower($conn->real_escape_string($_POST['addSport'])));
  $positionName = strtoupper($conn->real_escape_string($_POST['addPosition']));
  
  $query = "INSERT INTO positions (sport, position) 
            VALUES ('$sportName', '$positionName')";
  $result = $conn->query($query);
  
  if ($result) {
    $message = "Records Added Succesfully";
  }
  else {
    $message = "ERROR" . $conn->error;
  }   
}

elseif (isset($_POST['Delete'])) {
  
  $sportName = ucwords(strtolower($conn->real_escape_string($_POST['addSport'])));
  $positionName = strtoupper($conn->real_escape_string($_POST['addPosition']));
  
  $query = "DELETE FROM positions WHERE sport = '$sportName' AND position = '$positionName'";
  $result = $conn->query($query);
  
  if($result) {
    $message = "Record Deleted Succesfully";
  }
  else {
    $message = "ERROR" . $conn->error;
  }
}
?>

<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 strict//EN'
'http://www.w3.org/TR/zhtml1/DTD/html1-strict.dtd'>

<html>
<head>
  <link rel = 'stylesheet' type = 'text/css' href = 'collector.css'>
  <script type = 'text/javascript' src = 'jquery-1.12.3.js'></script>
  
</head>
<body>
<?php
include 'pageLayout.php';
echo "<p>".$message."</p>"
?>
<form method = 'POST'>
  <table class = 'formTable'>
    <tbody>
    <tr class = 'formData'>
      <td class = 'formLabel'>Sport:</td>
      <td class = 'formInput'>
        <select name = 'addSport' id = 'addSport'>
          <option name = 'Select One' value = '' disabled selected = 'selected'>-SELECT ONE-
          <?php
          
          $query = "SELECT * FROM sports";
          $result = $conn->query($query);
          
          while ($row = $result->fetch_assoc()) {
            ?>
          
            <option name = '<?php echo $row['sport']; ?>' value = '<?php echo $row['sport']; ?>'> <?php echo $row['sport']
            ; ?>
          
          <?php } ?>
          
        </select>
      </td>
    </tr>      
    <tr class = 'formData'>
      <td class = 'formLabel'>Position:</td>
      <td class = 'formInput'>
        <input type = 'text' name = 'addPosition' autocomplete = 'off' size = 20>
      </td>
    </tr>
    <tr class = 'formSubmit'>
      <td class = 'formSubmit' colspan = 2>
        <input type = 'submit' name = 'Submit' value = 'Submit'>
        <input type = 'submit' name = 'Delete' value = 'Delete'>
      </td>
    </tr>
    </tbody>
  </table>
</form>

<?php

$query = "SELECT * FROM positions";
$result = $conn->query($query);

if($result->num_rows > 0) {
  ?>
  
  <table id = 'manuTable'>
    <tr>
      <th>Position</th>
      <th>Sport</th>
    </tr>
    <tbody>
    <?php
    while ($row = $result->fetch_assoc()) {
      ?>
      
      <tr>
        <td class = 'tableData'><?php echo $row['position']; ?></td>
        <td class = 'tableData'><?php echo $row['sport']; ?></td>
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