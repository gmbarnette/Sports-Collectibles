<?php 

include 'db.php';

?>

<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 strict//EN'
'http://www.w3.org/TR/zhtml1/DTD/html1-strict.dtd'>

<html>
<head>
  <link rel = 'stylesheet' type = 'text/css' href = 'collector.css'>
  <script type = 'text/javascript' src = 'jquery-1.12.3.js'></script>
  <script>
    ('.advSearch').click(function() {
        
    })  
  </script>  
</head>

<?php include 'pageLayout.php'; ?>
<body>
  <form action = '' method = 'POST'>
  <table class = 'formTable'>
    <tr class = 'formData'>
      <td class = 'formLabel'>Search:</td>
      <td class = 'formInput'>
        <input type = 'text' name = 'searchInput' autocomplete = 'off' size = 20>
        
      </td>
    </tr>
    <tr id = 'advancedSearch'>
      <td>ADVANCE SEARCH OPTIONS GO HERE</td>
    </tr>
    <tr class = 'formSubmit'>
      <td colspan = 2>
        <div class = 'search2'><a id = 'advSearch' href = "">Adv Search <span class = 'arrow'>&raquo</span></a></div>
        <input type = 'submit' name = 'Search' value = 'Search'><br> 
      </td>
    </tr>
  </table>
  <br>
  <br>
  <?php
  
  if (isset($_POST['Search'])) {
  $searchInput = $_POST['searchInput'];
  $query = "SELECT * FROM cards 
            WHERE lower(playerName) LIKE lower('%$searchInput%')
            OR lower(playerName2) LIKE lower('%$searchInput%')
            OR lower(playerName3) LIKE lower('%$searchInput%')
            OR lower(playerName4) LIKE lower('%$searchInput%')
            OR lower(playerPosition) LIKE lower('%$searchInput%')
            OR lower(playerPosition2) LIKE lower('%$searchInput%')
            OR lower(playerPosition3) LIKE lower('%$searchInput%')
            OR lower(playerPosition4) LIKE lower('%$searchInput%')
            OR lower(teamName) LIKE lower('%$searchInput%')
            OR lower(teamName2) LIKE lower('%$searchInput%')
            OR lower(teamName3) LIKE lower('%$searchInput%')
            OR lower(teamName4) LIKE lower('%$searchInput%')
            OR lower(cardYear) LIKE lower('%$searchInput%')
            OR lower(cardManufacturer) LIKE lower('%$searchInput%')
            OR lower(cardSet) LIKE lower('%$searchInput%')
            OR lower(insertType) LIKE lower('%$searchInput%')
            OR lower(cardNumber) LIKE lower('%$searchInput%')
            OR lower(cardSerialNumber) LIKE lower('%$searchInput%')
            OR lower(numberofCards) LIKE lower('%$searchInput%')
            OR lower(price) LIKE lower('%$searchInput%')
            OR lower(location) LIKE lower('%$searchInput%')";
  
  $result = $conn->query($query);  
 
  if ($result->num_rows > 0 ){
    $numResults = $result->num_rows;
    echo "<p>".$numResults." results</p>";
    ?>
    
    <table id = 'cardTable'>
      <tr>
        <th>Player Name</th>
        <th>Position</th>
        <th>Team</th>
        <th>Year</th>
        <th>Card Manufacturer</th>
        <th>Card Set</th>
        <th>Insert Type</th>
        <th>Card #</th>
        <th>Serial #</th>
        <th># of Cards</th>
        <th>Price</th>
        <th>Location</th>
      </tr>
      <tbody>
          
  <?php
  
  while ($row = $result->fetch_assoc()) {
    ?>
    
    <tr class = 'cardData'>
      <td class = 'tableData'><?php echo $row['playerName']; ?>
            <?php if ($row['playerName2'] != NULL) { ?> <br><?php echo $row['playerName2']; } ?>
            <?php if ($row['playerName3'] != NULL) { ?> <br><?php echo $row['playerName3']; } ?>
            <?php if ($row['playerName4'] != NULL) { ?> <BR><?php echo $row['playerName4']; } ?></td>
          <td class = 'tableData'><?php echo $row['playerPosition']; ?>
            <?php if ($row['playerPosition2'] != NULL) { ?> <br><?php echo $row['playerPosition2']; } ?>
            <?php if ($row['playerPosition3'] != NULL) { ?> <br><?php echo $row['playerPosition3']; } ?>
            <?php if ($row['playerPosition4'] != NULL) { ?> <BR><?php echo $row['playerPosition4']; } ?></td>
          <td class = 'tableData'><?php echo $row['teamName']; ?>
            <?php if ($row['teamName2'] != NULL) { ?> <br><?php echo $row['teamName2']; } ?>
            <?php if ($row['teamName3'] != NULL) { ?> <br><?php echo $row['teamName3']; } ?>
            <?php if ($row['teamName4'] != NULL) { ?> <BR><?php echo $row['teamName4']; } ?></td>
      <td class = 'tableData'><?php echo $row['cardYear']; ?></td>
      <td class = 'tableData'><?php echo $row['cardManufacturer']; ?></td>
      <td class = 'tableData'><?php echo $row['cardSet']; ?></td>
      <td class = 'tableData'><?php echo $row['insertType']; ?></td>
      <td class = 'tableData'><?php echo $row['cardNumber']; ?></td>
      <td class = 'tableData'><?php echo $row['cardSerialNumber']; ?></td>
      <td class = 'tableData'><?php echo $row['numberOfCards']; ?></td>
      <td class = 'tableData'><?php echo $row['price']; ?></td>
      <td class = 'tableData'><?php echo $row['location']; ?></td>
    </tr>
  <?php } ?>
  
  </tbody>
  </table>
<?php }

else {
  ?>
  <p>0 results</p>
<?php }
} ?>

</form>
</body>
</html>

<?php 
$conn->close();
?>
  
  