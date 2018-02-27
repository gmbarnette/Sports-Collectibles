<?php

include 'db.php';

if (isset($_POST['Submit'])) {
    
  $sportName = ucwords(strtolower($conn->real_escape_string($_POST['addSport'])));
  $manuName = ucwords(strtolower($conn->real_escape_string($_POST['addManu'])));
  $cardSetName = ucwords(strtolower($conn->real_escape_string($_POST['addCardSet'])));
    
  $query = "INSERT INTO cardsets (sport, cardManufacturer, cardSet) 
            VALUES ('$sportName', '$manuName', '$cardSetName')";
  $result = $conn->query($query);
    
  if ($result) {
    $message = "Record Added Succesfully";
  }
   
  else {
    $message = "ERROR:" . $conn->error;
  }  
}

elseif ( isset($_POST['Delete'])) {
  $sportName = ucwords(strtolower($conn->real_escape_string($_POST['addSport'])));
  $manuName = ucwords(strtolower($conn->real_escape_string($_POST['addManu'])));
  $cardSetName = ucwords(strtolower($conn->real_escape_string($_POST['addCardSet'])));
    
  $query = "DELETE FROM cardSets
            WHERE cardSet = '$cardSetName'";
  $result = $conn->query($query);
    
  if ($result) {
    $message = "Record Deleted Succesfully";
  }
  
  else {
    $message = "ERROR:" . $conn->error;
  }
}
 
?>

<!DOCTYPE html PUBLIC '-//w3c/DTD XHTML 1.0 strict//EN'
'http://www.we.org/TR/xhtml1/DTD/xhtml1-strict.dtd'>

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
      });  
    }); 
  </script>
</head>
    
    
<body>
<?php include 'pageLayout.php'; ?>  
<p> <?php echo $message; ?></p>
  <form action = '' method = 'POST'>
    <table class = 'formTable'>
      <tbody>
        <tr class = 'formData'>
          <td class = 'formLabel'>
            Sport: 
          </td>
          <td class = 'formInput'>
            <select name = 'addSport' id = 'addSport'>
              <option name = 'Select One' Value = '' Disabled Selected = 'selected'>-SELECT ONE-
              <?php          
                 
              $query = "SELECT * FROM Sports";
              $result = $conn->query($query);
                        
              while ($row = $result->fetch_assoc()) {
                ?>
                
                <option name = '<?php echo $row['sport']; ?>' Value = '<?php echo $row['sport']; ?>'> <?php echo$row['sport']
                ;
              } ?>
                    
            </select>
          </td>
          </tr>        
          <tr class = 'formData'>
            <td class = 'formLabel'>
              Card Manufacturer:
            </td>
            <td class = 'formInput'>
              <select disabled name = 'addManu' id = 'addManu'>
                <option name = 'Select One' Value = '' Disable Selected = 'selected'>-SELECT ONE-           
                <?php 
                
                $query = "SELECT * FROM cardManufacturers";
                $result = $conn->query($query);
                            
                while ($row = $result->fetch_assoc()) {
                  ?>
                  
                  <option name = '<?php echo $row['cardManufacturer']; ?>' VALUE = '<?php echo $row['cardManufacturer']; ?>'> <?php echo $row['cardManufacturer']
                  ;
                } ?>
                              
              </select>
            </td>  
          </tr>
          <tr class = 'formData'>
            <td class = 'formLabel'>
              Card Set:
            </td>
            <td class = 'formInput'>
              <input type = 'text' name = 'addCardSet' size = 20 autocomplete = 'off'>
            </td>
          </tr>
          <tr class = 'formSubmit'>
            <td colspan = 2>
              <input type = 'submit' name = 'Submit' Value = 'Submit'>
              <input type = 'submit' name = 'Delete' Value = 'Delete'>
            </td>
          </tr>
        </tbody>
      </table>
    </form>
    <br>
    <br>
     
    <?php
         
    $query = "SELECT * FROM cardSets";
    $result = $conn->query($query);
         
    if ($result->num_rows > 0) {
      ?>
      
      <table id = 'cardSetsTable'>
      <tr>
        <th>Card Set</th>
        <th>Card Manuacturer</th>
        <th>Sport</th>
      </tr>
      <tbody>
      
      <?php
                    
      While ($row = $result->fetch_assoc()) {
        ?>
        
        <tr>
          <td class = 'tableData'><?php echo $row['cardSet']; ?></td>
          <td class = 'tableData'><?php echo $row['cardManufacturer']; ?></td>
          <td class = 'tableData'><?php echo $row['sport']; ?></td>
        </tr>
      <?php } ?>
             
      </tbody>
      </table>
               
    <?php }
    
    else { 
      ?> <p>0 results</p>
    <?php } ?>
         
         
    
</body>
</html>

<?php
$conn->close();
?>