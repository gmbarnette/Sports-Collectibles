

<?php

include 'db.php';

if (isset($_POST['Submit'])) {
    
    $sportName = ucwords(strtolower($conn->real_escape_string($_POST['addSport'])));
    $manuName = ucwords(strtolower($conn->real_escape_string($_POST['addManu'])));
    $setName = ucwords(strtolower($conn->real_escape_string($_POST['addCardSet'])));
    $insertName = ucwords(strtolower($conn->real_escape_string($_POST['insertType'])));
    
    $query = "INSERT INTO inserttype (sport, cardManufacturer, cardSet, insertType) 
              VALUES ('$sportName', '$manuName', '$setName', '$insertName')";
      
    $result = $conn->query($query);
    
    if ($result) {
        $messsage = "Record Added Succesfully";
    }
    
    else {
        $message = "ERROR" . $conn->error;
    }
}

elseif (isset($_POST['Delete'])) {
    
    $sportName = ucwords(strtolower($conn->real_escape_string($_POST['addSport'])));
    $manuName = ucwords(strtolower($conn->real_escape_string($_POST['addManu'])));
    $setName = ucwords(strtolower($conn->real_escape_string($_POST['addCardSet'])));
    $insertName = ucwords(strtolower($conn->real_escape_string($_POST['insertType'])));
    
    $query = "DELETE FROM inserttype
              WHERE inserttype = '$insertName' AND sport = '$sportName'AND cardmanufacturer = '$manuName'";
    
    $result = $conn->query($query);
    
    if ($result) {
        $message = "Record Deleted Succesfully";
    }
    else {
        $message = "ERROR" . $conn->error;
    }
}
?>

<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 strict//EN'
'http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd'>

<html>
<head>
  <link rel = 'stylesheet' type = 'text/css' href = 'collector.css'>
  <script type = 'text/javascript' src = 'jquery-1.12.3.js'></script>
  <script>
    
    function enableSelect (selectID) 
      { document.getElementById(selectID).disabled=false;}
    
    function disableSelect (selectID) 
      { document.getElementById(selectID).disabled=true;}
    
    function changeSelected (entered, toChange) {
      var sel = "#" + entered;
      var newSel = "#" + toChange;
      var cardChange = $(sel).val();
      var dataString = "selected=" + cardChange + "&toChange=" + toChange + "&selected1=" + entered;
     
        $.ajax({
          type:"POST",
          url: "changeSelect.php",
          data: dataString, 
          success: function(data) {
        
            $(newSel).html(data);
          }
        });
    }
    
    $(document).ready(function(){
      $("#addSport").change(function() {
        changeSelected("addSport","addManu");
        enableSelect("addManu");
        disableSelect("addCardSet");
          
      });
      
      $("#addManu").change(function(){
  
        changeSelected("addManu","addCardSet");
        enableSelect("addCardSet");
        
      });
      
    });
     
  </script>
  
</head>

<body>
  <?php include 'pageLayout.php'; ?>  
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
          <td class = 'formLabel'>Card Manufacturer</td>
          <td class = 'formInput'>
            <select disabled name = 'addManu' id = 'addManu'>
              <option name = 'Select One' value = '' disabled selected = 'selected'>-SELECT ONE-
              <?php
                            
              $query = "SELECT * FROM cardManufacturers";
              $result = $conn->query($query);
                            
              while ($row = $result->fetch_assoc()) {
                ?><option name = '<?php echo $row['cardManufacturer']; ?>' value = '<?php echo $row['cardManufacturer']; ?>'> <?php echo $row['cardManufacturer']
                ; ?>
                
              <?php } ?>
              
            </select>
          </td>
        </tr>
        <tr class = 'formData'>
          <td class = 'formLabel'>Card Set:</td>
          <td class = 'formInput'>
            <select disabled name = 'addCardSet' id = 'addCardSet'>
              <option name = 'select one' value = '' disable selected = 'selected'>-SELECT ONE-              
              <?php
                            
              $query = "SELECT * FROM cardsets";
              $result = $conn->query($query);
                            
              while ($row = $result->fetch_assoc()) {
                ?><option name = '<?php echo $row['cardSet']; ?>' value = '<?php echo $row['cardSet']; ?>'> <?php echo $row['cardSet']
                ; ?>
                
              <?php } ?>
              
            </select>
          </td>
        </tr>
        <tr class = 'formData'>
          <td class = 'formLabel'>Insert Type:</td>
          <td class = 'formInput'>
            <input type = 'text' name = 'insertType' size = 30 autocomplete = 'off'>
          </td>
        </tr>
        <tr class = 'formSubmit'>
          <td colspan = 2>
            <input type = 'Submit' name = 'Submit' value = 'Submit'>
            <input type = 'Submit' name = 'Delete' value = 'Delete'>
          </td>
        </tr>
      </tbody>
    </table>
  </form>
  <br>
  <br>
    
  <?php
    
  $query = "SELECT * FROM inserttype";
  $result = $conn->query($query);
    
  if ($result->num_rows > 0) {
    ?>
    <table id = 'insertTable'>
      <tr>
        <th>Insert Type</th>
        <th>Card Set</th>
        <th>Card Manufacturer</th>
        <th>Sport</th>
      </tr>
      <tbody>
            
      <?php
    
      While ($row = $result->fetch_assoc()) {
        ?>
        
        <tr class = 'cardData'>
          <td class = 'tableData'> <?php echo $row['insertType']; ?></td>
          <td class = 'tableData'> <?php echo $row['cardSet']; ?></td>
          <td class = 'tableData'> <?php echo $row['cardManufacturer']; ?></td>
          <td class = 'tableData'> <?php echo $row['sport']; ?></td>
        </tr>
               
      <?php } ?>
            
      </tbody>
    </table>
           
  <?php } 
  else {
    ?>
    <p> 0 results </p>
  <?php } ?>
</body>
</html>

<?php
$conn->close();
?>