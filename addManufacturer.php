<?php

include 'db.php';

if (isset($_POST['Submit'])) {
  
  $manuName = ucwords(strtolower($conn->real_escape_string($_POST['cardManu'])));
  $sportName = ucwords(strtolower($conn->real_escape_string($_POST['addSport'])));
    
  $query = "INSERT INTO cardManufacturers (cardManufacturer,sport) VALUES ('$manuName','$sportName')";
  $result = $conn->query($query);
    
  if ($result) {
    $message = "Records Added Succesfully";
  }
  else {
    $message = "ERROR" . $conn->error;
  }
}

elseif (isset($_POST['Delete'])) {
  
  $manuName = ucwords(strtolower($conn->real_escape_string($_POST['cardManu'])));
  $sportName = ucwords(strtolower($conn->real_escape_string($_POST['addSport'])));
    
  $query = "DELETE FROM cardManufacturers WHERE cardManufacturer = '$manuName' AND sport = '$sportName'";
  $result = $conn->query($query);
    
  if($result) {
    $message = "Record Deleted Succesfully";
  }
  
  else {
    $message = "ERROR:" . $conn->error;
  }
}

?>

<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 strict//EN'
'http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd'>
 
<html>
  <head>
    <link rel = 'stylesheet' type = 'text/css' href = 'collector.css'>
  </head>
  
<body>
  <?php include 'pageLayout.php'; ?>  
<p> <?php echo $message; ?></p>
<form action = '' method = 'POST'>
  <table class = 'formTable'>
    <tbody>
      <tr class = 'formData'>
        <td class = 'formLabel'>Sport:</td> 
        <td class = 'formInput'>
          <select name = 'addSport' id = 'addSport'>
            <option name = 'Select One' Value = '' disabled selected = 'selected'>-SELECT ONE-
            <?php
                           
            $query = "SELECT * FROM sports";       
            $result = $conn->query($query);  
                        
            while ($row = $result->fetch_assoc()) {
              ?><option name = '<?php echo $row['sport']; ?>'  value = '<?php echo $row['sport']; ?>'> <?php echo $row['sport']
              ; ?>
                                        
            <?php } ?>
              
          </select>
        </td>
      </tr>
      <tr class = 'formData'>
        <td class = 'formLabel'>
            Card Manufacturer:
        </td>
        <td class = 'formInput'>
            <input type = 'text' name = 'cardManu' size = 15 autocomplete = 'off'>
        </td>    
      </tr>
      <tr class = 'formSubmit'><td colspan = 2>
        <input type = 'submit' name = 'Submit' value = 'Submit'>
        <input type = 'submit' name = 'Delete' value = 'Delete'>
      </tr>
    </tbody>
  </table>
</form>
         
<?php

$query = "SELECT * FROM cardManufacturers";
$result = $conn->query($query);

if($result->num_rows > 0) {
  ?>
  
  <table id = 'manuTable'>
    <tr>
      <th>Card Manufacturers</th>
      <th>Sport</th>
    </tr>
    <tbody>
    <?php
    while ($row = $result->fetch_assoc()) {
      ?>
      
      <tr>
        <td class = 'tableData'><?php echo $row['cardManufacturer']; ?></td>
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




  