<?php
include 'db.php';

if (isset($_POST['submit'])){
  
  $sportName = ucwords(strtolower($conn->real_escape_string($_POST['addSport'])));
  $teamName = ucwords(strtolower($conn->real_escape_string($_POST['teamName'])));
  $teamMascot = ucwords(strtolower($conn->real_escape_string($_POST['teamMascot'])));

  $query = "INSERT INTO teams (teamName, teamMascot, teamNameAndMascot, sport) 
            VALUES ('$teamName', '$teamMascot', '$teamName $teamMascot' , '$sportName')";
            
  $result = $conn->query($query);
  
  if ($result) {
    $message = "Records added Succesfully";
  }
  
  else {
    $message =  "ERROR:". $conn->error;
  }
}

elseif (isset($_POST['delete'])) {
  $sportName = ucwords(strtolower($conn->real_escape_string($_POST['addSport'])));
  $teamName = ucwords(strtolower($conn->real_escape_string($_POST['teamName'])));
  $teamMascot = ucwords(strtolower($conn->real_escape_string($_POST['teamMascot'])));
  
  $query = "DELETE FROM teams 
            WHERE teamNameandMascot = '$teamName $teamMascot' and sport = '$sportName'";
  
  $result = $conn->query($query);
  
    if($result) {
      $message = "Record Delete Succesfully";
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
  <link rel='stylesheet' type='text/css' href='collector.css'>
</head>
<body>
  <?php include 'pageLayout.php'; ?>  
  <p> <?php $message ?> </p>
  <form action = '' method = 'POST'>
    <table class = 'formTable'>
      <tbody>
        <tr class = 'formData'>
          <td class = 'formLabel'>Sport:</td>
          <td class = 'formInput'>
            <select name = 'addSport'>
              <option name = 'Select One' Value = '' Disabled selected = 'selected'>-SELECT ONE-
              <?php
              
              $query = "SELECT * FROM Sports";
              $result = $conn->query($query);

              while($row = $result->fetch_assoc()){
                ?>
                
                <option name = '<?php echo $row['sport']; ?>' Value = '<?php echo $row['sport']; ?>'> <?php echo $row['sport']
                ;?>
                
              <?php } ?>
            </select>
          </td>
        </tr>
        <tr class = 'formData'>
          <td class = 'formLabel'>Team Name:</td>
          <td class = 'formInput'><input type = 'text' autocomplete = 'off' name = 'teamName'></td>
        </tr>
        <tr class = 'formData'>
          <td class = 'formLabel'>Team Mascot:</td>
          <td class = 'formInput'><input type = 'text' autocomplete = 'off' name = 'teamMascot'></td>
        </tr>
        <tr class = 'formSubmit'>
          <td colspan = 2><input type = 'submit' name = 'submit' value = 'submit'>
          <input type = 'submit' name = 'delete' value = 'delete'></td>
        </tr>
      </tbody>
    </table>
  </form>
  <br>
  <br>
  <?php
  
  $query = "SELECT * FROM teams";
  $result = $conn->query($query);
  
  if($result->num_rows > 0) {
    ?>
     
    <table id = 'teamsTable'>
      <tr><th>Team</th><th>Mascot</th><th>Sport</th></tr>
      <tbody>
        <?php
        while($row = $result->fetch_assoc()) {
          ?><tr>
            <td class = 'tableData'> <?php echo $row['teamName']; ?> </td> 
            <td class = 'tableData'> <?php echo $row['teamMascot']; ?> </td>
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
