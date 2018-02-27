<?php 
//OPEN CONNECTION TO SPORTS COLLECTIBLE DATABASE AND STORE IN VARIABLE $conn
include 'db.php';
$message = "";

//PROCESS TO DO IF SUBMIT BUTTON WAS PRESSED
if (isset($_POST['Submit'])) {
  
  $sportName = ucwords(strtolower($conn->real_escape_string($_POST['addSport'])));
  
  //PLAYER NAME DECLARATIONS
  $playerName = ucwords(strtolower($conn->real_escape_string($_POST['addPlayer'])));
  $playerName2 = ucwords(strtolower($conn->real_escape_string($_POST['addPlayer2'])));
  $playerName2 = !empty($playerName2) ? "playerName2 = '$playerName2'" : "playerName2 is NULL";
  $playerName3 = ucwords(strtolower($conn->real_escape_string($_POST['addPlayer3'])));
  $playerName3 = !empty($playerName3) ? "playerName3 = '$playerName3'" : "playerName3 is NULL";
  $playerName4 = ucwords(strtolower($conn->real_escape_string($_POST['addPlayer4'])));
  $playerName4 = !empty($playerName4) ? "playerName4 = '$playerName4'" : "playerName4 is NULL";
  
  // Team Declarations
  //TEAM 1
  if (isset($_POST['addTeam'])) {$teamName = ucwords(strtolower($conn->real_escape_string($_POST['addTeam'])));}
  else {$teamName = "";}
  $teamName = !empty($teamName) ? "teamName = '$teamName'" : "teamName is NULL";
  
  
  //TEAM 2
  if (isset($_POST['addTeam2'])) {$teamName2 = ucwords(strtolower($conn->real_escape_string($_POST['addTeam2'])));}
  else { $teamName2 = "";}
  $teamName2 = !empty($teamName2) ? "teamName2 ='$teamName2'" : "teamName2 is NULL";
  
  //TEAM3
  if (isset($_POST['addTeam3'])) {$teamName3 = ucwords(strtolower($conn->real_escape_string($_POST['addTeam3'])));}
  else { $teamName3 = "";}
  $teamName3 = !empty($teamName3) ? "teamName3 = '$teamName3'" : "teamName3 is NULL";
  
  //TEAM4
  if (isset($_POST['addTeam4'])) {$teamName4 = ucwords(strtolower($conn->real_escape_string($_POST['addTeam4'])));}
  else {$teamName4 = "";}
  $teamName4 = !empty($teamName4) ? "teamName4 = '$teamName4'" : "teamName4 is NULL";
  
  //Position Declarations
  //POSITION 1
  if (isset($_POST['addPosition'])) {$positionName = $conn->real_escape_string($_POST['addPosition']);}
  else {$positionName = "";}
  $positionName = !empty($positionName) ? "playerPosition = '$positionName'" : "playerPosition is NULL";
  
  
  //POSITION2
  if (isset($_POST['addPosition2'])) {$positionName2 = $conn->real_escape_string($_POST['addPosition2']);}
  else { $playerPosition2 = "";}
  $positionName2 = !empty($positionName2) ? "playerPosition2 = '$positionName2'" : "playerPosition2 is NULL";
  
  //POSITION 3
  if(isset($_POST['addPosition3'])) {$positionName3 = $conn->real_escape_string($_POST['addPosition3']);}
  else {$positionName3 = "";}
  $positionName3 = !empty($positionName3) ? "playerPosition3 = '$positionName3'" : "playerPosition3 is NULL";
  
  //POSITION 4
  if(isset($_POST['addPosition4'])) {$positionName4 = $conn->real_escape_string($_POST['addPosition4']);}
  else {$positionName4 = "";}
  $positionName4 = !empty($positionName4) ? "playerPosition4 = '$positionName4'" : "playerPosition4 is NULL";
  
  //REST OF CARD VARIABLE DECLERATIONS
  $manuName = ucwords(strtolower($conn->real_escape_string($_POST['addManu'])));
  $cardSetName = ucwords(strtolower($conn->real_escape_string($_POST['addCardSet'])));
  $insertName = ucwords(strtolower($conn->real_escape_string($_POST['addInsert'])));
  $yearName = $_POST['addYear'];
  $cardNum = ucwords(strtolower($conn->real_escape_string($_POST['addNumber'])));
  $serialNum = $_POST['addSerial'];
  $outOfNum = $_POST['addOutOf'];
  $serialNum = $serialNum . "/".$outOfNum;
  
  //SET SERIAL NUMBER TO BLANK IF NO VALUES ENTERED
  if ($serialNum == "/") {
    $serialNum = "";
  }
  
  $numOfCards = $_POST['addNumOfCards'];
  $priceNum = number_format($_POST['addPrice'],2,".",",");
  $location = ucwords(strtolower($conn->real_escape_string($_POST['addLocation'])));
  
  //QUERY DATABASE TO SEE IF CARD ALREADY EXISTS
  $query = "SELECT * FROM cards WHERE sport = '$sportName' AND cardManufacturer = '$manuName' AND cardSet = '$cardSetName' AND cardYear = '$yearName' AND insertType = '$insertName' AND cardNumber = '$cardNum' 
            AND playerName = '$playerName'  AND $teamName AND $positionName AND cardSerialNumber = '$serialNum' AND location = '$location' AND $playerName2 AND $playerName3 AND $playerName4 AND $teamName2 AND 
            $teamName3 AND $teamName4 AND $positionName2 AND $positionName3 AND $positionName4";
  $result = $conn->query($query); 
  
  //IF CARD EXISTS ADD NUMBER OF CARDS TO EXISTING ENTRY
  if($result ->num_rows > 0) {
    $row = $result->fetch_assoc();
    $count = $row['numberOfCards']; 
    $count = $count + $numOfCards;
    $query = "UPDATE cards SET numberofCards = '$count' WHERE sport = '$sportName' AND cardManufacturer = '$manuName' AND cardSet = '$cardSetName' AND cardYear = '$yearName' AND insertType = '$insertName' AND cardNumber = '$cardNum' 
            AND playerName = '$playerName' AND $playerName2 AND $playerName3 AND $playerName4 AND $teamName AND $teamName2 AND 
            $teamName3 AND $teamName4 AND cardSerialNumber = '$serialNum' AND location = '$location'";
    $result = $conn->query($query);
    
    if($result) {$message = "Record Added Succesfully";}
    else {$message = "ERROR:" . $conn->error;}
  }  
  //IF CARD DOES NOT EXIST ADD IT TO DATABASE
  else {
    //SET PLAYER NAMES TO BE INSERTED INTO DATABASE
    $playerName2 = ucwords(strtolower($conn->real_escape_string($_POST['addPlayer2'])));
    $playerName2 = !empty($playerName2) ? "'$playerName2'" : "NULL";
    $playerName3 = ucwords(strtolower($conn->real_escape_string($_POST['addPlayer3'])));
    $playerName3 = !empty($playerName3) ? "'$playerName3'" : "NULL";
    $playerName4 = ucwords(strtolower($conn->real_escape_string($_POST['addPlayer4'])));
    $playerName4 = !empty($playerName4) ? "'$playerName4'" : "NULL";
    
    //SET TEAM NAMES TO BE INSERTED INTO DATABASE
    //TEAM1
    if (isset($_POST['addTeam'])) {$teamName = ucwords(strtolower($conn->real_escape_string($_POST['addTeam'])));}
    else {$teamName = "";}
    $teamName = !empty($teamName) ? "'$teamName'" : "NULL";
    
    //TEAM2
    if (isset($_POST['addTeam2'])) {$teamName2 = ucwords(strtolower($conn->real_escape_string($_POST['addTeam2'])));}
    else { $teamName2 = "";}
    $teamName2 = !empty($teamName2) ? "'$teamName2'" : "NULL";
    
    //TEAM3  
    if (isset($_POST['addTeam3'])) {$teamName3 = ucwords(strtolower($conn->real_escape_string($_POST['addTeam3'])));}
    else { $teamName3 = "";}
    $teamName3 = !empty($teamName3) ? "'$teamName3'" : "NULL";
    
    //TEAM4
    if (isset($_POST['addTeam4'])) {$teamName4 = ucwords(strtolower($conn->real_escape_string($_POST['addTeam4'])));}
    else {$teamName4 = "";}
    $teamName4 = !empty($teamName4) ? "'$teamName4'" : "NULL";
    
    //SET POSITIONS TO BE ADDED TO DATABASE
    //POSITION 1
    if(isset($_POST['addPosition'])) {$positionName = $conn->real_escape_string($_POST['addPosition']);}
    else {$positionName = "";}
    $positionName = !empty($positionName) ? "'$positionName'" : "NULL";
   
    //POSITION 2
    if (isset($_POST['addPosition2'])) {$positionName2 = $conn->real_escape_string($_POST['addPosition2']);}
    else { $positionName2 = "";}
    $positionName2 = !empty($positionName2) ? "'$positionName2'" : "NULL";
    
    
    //POSITION 3
    if(isset($_POST['addPosition3'])) {$positionName3 = $conn->real_escape_string($_POST['addPosition3']);}
    else {$positionName3 = "";}
    $positionName3 = !empty($positionName3) ? "'$positionName3'" : "NULL";
    
    //POSITION 4
    if(isset($_POST['addPosition4'])) {$positionName4 = $conn->real_escape_string($_POST['addPosition4']);}
    else {$positionName4 = "";}
    $positionName4 = !empty($positionName4) ? "'$positionName4'" : "NULL";
    
    //ADD CARD TO DATABASE
    $query = "INSERT INTO cards (sport, cardManufacturer, cardSet, cardYear, insertType, cardNumber, playerName, teamName, playerPosition, numberOfCards, cardSerialNumber, price, location, playerName2, playerName3, playerName4, teamName2, teamName3, teamName4, playerPosition2, playerPosition3,                playerPosition4)
              VALUES('$sportName', '$manuName', '$cardSetName', '$yearName', '$insertName', '$cardNum' , '$playerName', $teamName, $positionName, '$numOfCards', '$serialNum', '$priceNum', '$location', $playerName2, $playerName3 , $playerName4, $teamName2, $teamName3,$teamName4, $positionName2, $positionName3, $positionName4)";
    
     
    $result = $conn->query($query);
  
    if ($result) {$message = "Record Added Succesfully";}
    else {$message = "ERROR:".$conn->error;} 
  }
}

//PROCESS TO DO IF UPDATE BUTTON WAS CLICKED
elseif (isset($_POST['Update'])) {
  $sportName = ucwords(strtolower($conn->real_escape_string($_POST['addSportEdit'])));
  
  //PLAYER NAME DECLARATIONS
  $playerName = ucwords(strtolower($conn->real_escape_string($_POST['addPlayerEdit'])));
  $playerName2 = ucwords(strtolower($conn->real_escape_string($_POST['addPlayer2Edit'])));
  $playerName2 = !empty($playerName2) ? "playerName2 = '$playerName2'" : "playerName2 = NULL";
  $playerName3 = ucwords(strtolower($conn->real_escape_string($_POST['addPlayer3Edit'])));
  $playerName3 = !empty($playerName3) ? "playerName3 = '$playerName3'" : "playerName3 = NULL";
  $playerName4 = ucwords(strtolower($conn->real_escape_string($_POST['addPlayer4Edit'])));
  $playerName4 = !empty($playerName4) ? "playerName4 = '$playerName4'" : "playerName4 = NULL";
  
  // Team Declarations
  //TEAM 1
  if (isset($_POST['addTeamEdit'])) {$teamName = ucwords(strtolower($conn->real_escape_string($_POST['addTeamEdit'])));}
  else {$teamName = "";}
  $teamName = !empty($teamName) ? "teamName = '$teamName'" : "teamName = NULL";
  
  
  //TEAM 2
  if (isset($_POST['addTeam2Edit'])) {$teamName2 = ucwords(strtolower($conn->real_escape_string($_POST['addTeam2Edit'])));}
  else { $teamName2 = "";}
  $teamName2 = !empty($teamName2) ? "teamName2 ='$teamName2'" : "teamName2 = NULL";
  
  //TEAM3
  if (isset($_POST['addTeam3Edit'])) {$teamName3 = ucwords(strtolower($conn->real_escape_string($_POST['addTeam3Edit'])));}
  else { $teamName3 = "";}
  $teamName3 = !empty($teamName3) ? "teamName3 = '$teamName3'" : "teamName3 = NULL";
  
  //TEAM4
  if (isset($_POST['addTeam4Edit'])) {$teamName4 = ucwords(strtolower($conn->real_escape_string($_POST['addTeam4Edit'])));}
  else {$teamName4 = "";}
  $teamName4 = !empty($teamName4) ? "teamName4 = '$teamName4'" : "teamName4 = NULL";
  
  //Position Declarations
  //POSITION 1
  if (isset($_POST['addPositionEdit'])) {$positionName = $conn->real_escape_string($_POST['addPositionEdit']);}
  else {$positionName = "";}
  $positionName = !empty($positionName) ? "playerPosition = '$positionName'" : "playerPosition = NULL";
  
  
  //POSITION2
  if (isset($_POST['addPosition2Edit'])) {$positionName2 = $conn->real_escape_string($_POST['addPosition2Edit']);}
  else { $playerPosition2 = "";}
  $positionName2 = !empty($positionName2) ? "playerPosition2 = '$positionName2'" : "playerPosition2 = NULL";
  
  //POSITION 3
  if(isset($_POST['addPosition3Edit'])) {$positionName3 = $conn->real_escape_string($_POST['addPosition3Edit']);}
  else {$positionName3 = "";}
  $positionName3 = !empty($positionName3) ? "playerPosition3 = '$positionName3'" : "playerPosition3 = NULL";
  
  //POSITION 4
  if(isset($_POST['addPosition4Edit'])) {$positionName4 = $conn->real_escape_string($_POST['addPosition4Edit']);}
  else {$positionName4 = "";}
  $positionName4 = !empty($positionName4) ? "playerPosition4 = '$positionName4'" : "playerPosition4 = NULL";
  
  //REST OF CARD VARIABLE DECLERATIONS
  $manuName = ucwords(strtolower($conn->real_escape_string($_POST['addManuEdit'])));
  $cardSetName = ucwords(strtolower($conn->real_escape_string($_POST['addCardSetEdit'])));
  $insertName = ucwords(strtolower($conn->real_escape_string($_POST['addInsertEdit'])));
  $yearName = $_POST['addYearEdit'];
  $cardNum = ucwords(strtolower($conn->real_escape_string($_POST['addNumberEdit'])));
  $serialNum = $_POST['addSerialEdit'];
  $outOfNum = $_POST['addOutOfEdit'];
  $serialNum = $serialNum . "/".$outOfNum;
  
  //SET SERIAL NUMBER TO BLANK IF NO VALUES ENTERED
  if ($serialNum == "/") {
    $serialNum = "";
  }
  
  $numOfCards = $_POST['addNumOfCardsEdit'];
  $priceNum = number_format($_POST['addPriceEdit'],2,".",",");
  $location = ucwords(strtolower($conn->real_escape_string($_POST['addLocationEdit'])));
  $cardId = $_POST['cardIdEdit'];
  
  //QUERY DATABASE TO SEE IF CARD ALREADY EXISTS
  $query = "SELECT * FROM cards WHERE cardID = '$cardId'";
  $result = $conn->query($query); 
  
  //IF CARD EXISTS ADD NUMBER OF CARDS TO EXISTING ENTRY
  if($result ->num_rows > 0) {
    $row = $result->fetch_assoc();
    $count = $numOfCards;
    $query = "UPDATE cards SET sport = '$sportName', playerName = '$playerName', $playerName2, $playerName3, $playerName4, $teamName, 
                               $teamName2, $teamName3, $teamName4, $positionName, $positionName2, $positionName3, $positionName4, cardManufacturer = '$manuName' , 
                               cardSet = '$cardSetName', insertType = '$insertName', cardYear = '$yearName', cardNumber = '$cardNum', cardSerialNumber = '$serialNum', 
                               numberOfCards = '$count', price = '$priceNum', location = '$location' WHERE cardID = '$cardId'";
    $result = $conn->query($query);
    
    if($result) {$message = "Record Added Succesfully";}
    else {$message = "ERROR:" . $conn->error;}
  }  
  //IF CARD DOES NOT EXIST ADD IT TO DATABASE
  else {
    $message = "Card Does Not Exist";
  }
}

//PROCESS TO DO IF DELETE BUTTON WAS CLICKED
elseif (isset($_POST['Delete'])) {

   $cardId = $_POST['cardIdEdit'];

   $query = "DELETE FROM cards WHERE cardID = '$cardId'";
   $result = $conn->query($query);
   if($result) {$message = "Card Successfully Deleted";}
   else { $message = "ERROR:" . $conn->error;} 
  
}

?>

<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 strict//EN'
'http://www.w3.org/TR/zhtml1/DTD/html1-strict.dtd'>

<html>
<head>
  <link rel = 'stylesheet' type = 'text/css' href = 'collector.css'>
  <script type = 'text/javascript' src = 'jquery-1.12.3.js'></script>
  <script>
    
    function enableSelect (selectID) 
      { document.getElementById(selectID).disabled=false;}
    
    function disableSelect (selectID) 
      { document.getElementById(selectID).disabled=true;}

    //need to improve this function to adjust for sport and manufacturer type for cardset and insert type 
    function changeSelected (toChange) {
      var addSport = document.getElementById("addSport").value;
      var addTeam = document.getElementById("addTeam").value;
      var addManu = document.getElementById("addManu").value;
      var addCardSet = document.getElementById("addCardSet").value;
      var addInsertType = document.getElementById("addInsert").value;
      var dataString = "toChange=" + toChange + "&addSport=" + addSport + "&addTeam=" + addTeam + "&addManu=" + addManu + "&addCardSet=" + addCardSet + "&addInsertType=" + addInsertType;
      var newSel = "#" + toChange;    

      $.ajax({
          type:"POST",
          url: "changeSelect1.php",
          data: dataString, 
          success: function(data) {
        
            $(newSel).html(data);
          }
        });
    }

    

    function editCard (cardId) {
      var dataString = "cardId=" + cardId;
      $.ajax({
        type: "POST",
        url: "editCard.php",
        data: dataString,
        success: function(data) {
          $("#cardIdNum").html(data);
          
        }
      });
     
    }
    
    $(document).ready(function(){
      
      $("#reset").click(function(){
        $(".player2").hide();
        $(".player3").hide();
        $(".player4").hide();
      });
     
      $("#addSport").change(function() {
      
        changeSelected("addManu");
        changeSelected("addTeam");
        changeSelected("addTeam2");
        changeSelected("addTeam3");
        changeSelected("addTeam4");
        changeSelected("addPosition");
        changeSelected("addPosition2");
        changeSelected("addPosition3");
        changeSelected("addPosition4");

        disableSelect("addCardSet");
        disableSelect("addInsert");
        enableSelect("numOfPlayers");
        enableSelect("addTeam");
        enableSelect("addPosition");

        $("#numOfPlayers").val('1');
        $(".player2").hide();
        $(".player3").hide();
        $(".player4").hide();
        $("#addPlayer").val('');
        $("#addPlayer2").val('');
        $("#addPlayer3").val('');
        $("#addPlayer4").val('');
        $("#addCardSet").val('');
        $("#addInsert").val('');
      });  
    
      $("#addManu").change(function(){
        
        changeSelected("addCardSet");
        changeSelected("addInsert");
        enableSelect("addCardSet");
        disableSelect("addInsert");  
      });
      
      $("#addCardSet").change(function(){
        changeSelected("addInsert"); 
        enableSelect("addInsert"); 
      });

     

     $("#numOfPlayers").change(function(){
       if ($(this).val() === "1"){
         
         $("#addPosition2").val('');
         $("#addPlayer2").val('');
         $("#addTeam2").val('');
         $(".player2").hide();
      
         $("#addPosition3").val('');
         $("#addlayer3").val('');
         $("#addTeam3").val('');
         $(".player3").hide();

         $("#addPosition4").val('');
         $("#addPlayer4").val('');
         $("#addTeam4").val('');
         $(".player4").hide();
        
       }  
       else if ($(this).val() === "2") {
        
         $(".player2").show();

         $("#addPosition3").val('');
         $("#addPlayer3").val('');
         $("#addTeam3").val('');
         $(".player3").hide();

         $("#addPosition4").val('');
         $("#addPlayer4").val('');
         $("#addTeam4").val('');
         $(".player4").hide();
      
       }
       else if ($(this).val() === "3") {
         
         $(".player2").show();
         $(".player3").show();
         
         $("#addPosition4").val('');
         $("#addPlayer4").val(''); 
         $("#addTeam4").val('');
         $(".player4").hide();
          
       }
       else if ($(this).val() === "4") {
        
         $(".player2").show();
         $(".player3").show();
         $(".player4").show();
       
       }
     }); 
     
     $(".rowEdit").click(function(){
        var modal = document.getElementById('editModal');
        var cardId = this.name;

        editCard(cardId);
        modal.style.display = 'block';
        //editCard(cardId);
       
     //alert(this.name); 
     });


     
     $(".close").click(function() {
       var modal = document.getElementById('editModal');
       modal.style.display = 'none';
     })
    
    });
      
  //  }   
    //$(document).ready(function() {
      
      //$("#addManu").change(function() {
        
        //var cardChange = $(this).val();
        
        //$.ajax({
          //type: "POST",
          //url: "changeCardSet.php",
          //data: "cardset=" + cardChange,
          //success: function(data) {
            //$("#addCardSet").html(data);
          //}
        //});
      //});
    //});
  </script>
</head>

<body>
<?php include 'pageLayout.php'; ?>  
<p><?php echo $message ?></p>
  <form action = '' method = 'POST'>
  <table id = 'addCardTable' >
    <tr class = 'addCardTable'>
      <th class = 'addCardTable'>Player Info</th>
      <th>Card Info</th>
    </tr>
  <tbody>
    <tr class = 'formData'>
      <td class = 'addCardTable'>
        <table class = 'formTable'>
          <tbody>
            <tr class = 'imbTable'>
              <td class = 'formLabel'>Sport:</td>
              <td class = 'formInput'>
                <select name = 'addSport' id = 'addSport' >
                  <option name = 'Select One' value = '' disabled selected = selected>-SELECT ONE-
                  <?php
               
                  $query = "SELECT * FROM sports";
                  $result = $conn->query($query);
              
                  while ($row=$result->fetch_assoc()) {
                    ?><option name = '<?php echo $row['sport']; ?>' value = '<?php echo $row['sport']; ?>'><?php echo $row['sport']
                    ;?>              
                  <?php } ?>
              
                </select>
              </td>
            </tr>
            <tr class = 'imbTable'>
              <td class = 'formLabel'># of Players</td>
              <td class = 'formInput'>
                <select name = 'numOfPlayers' id = 'numOfPlayers' disabled>
                  <option name = '1' value = '1' selected = 'selected'>1
                  <option name = '2' value = '2'>2
                  <option name = '3' value = '3'>3
                  <option name = '4' value = '4'>4
                </select>
              </td>
            </tr>
            <tr class = 'imbTable'>
              <td class = 'formLabel'>Player Name:
              <br>
              Team:
              <br>
              Position
              </td>
              
              <td class = 'formInput'>
                <input type = 'text' name = 'addPlayer' autocomplete = 'off' size = 20 >
                <br>
                <select name = 'addTeam' id = 'addTeam' disabled>
                  <option name = 'Select One' value = '' disabled selected = selected>-SELECT ONE-
                  <?php
              
                  $query = "SELECT * FROM teams ";
                  $result = $conn->query($query);
              
                  while ($row = $result->fetch_assoc()) {
                    ?><option name = '<?php echo $row['teamNameAndMascot']; ?>' value = '<?php echo $row['teamNameAndMascot']; ?>'><?php echo $row['teamNameAndMascot']
                    ;?>
                  <?php } ?>
              
                </select>
                <br>
                <select name = 'addPosition' id = 'addPosition' disabled>
                  <option name = 'Select One' value = '' disabled selected = 'selected'>-SELECT ONE-
                  <?php
                  
                  $query = "SELECT * FROM positions";
                  $result = $conn->query($query);
                  
                  while($row = $result->fetch_assoc()) {
                    ?>
                    
                    <option name = '<?php echo $row['position']; ?>' value = '<?php echo $row['position']; ?>'><?php echo $row['position']
                    ; ?>
                  <?php } ?>
                  
                </select>
              </td>
            </tr>
            <tr class = 'imbTable player2' hidden>
              <td class = 'formLabel'>Player 2 Name:
              <br>
              Team:
              <br>
              Position:
              </td>
              <td class = 'formInput'>
                <input type = 'text' id = 'player2' name = 'addPlayer2' autocomplete = 'off' size = 20>
                <br>
                <select name = 'addTeam2' id = 'addTeam2'>
                  <option name = 'Select One' value = '' disabled selected = selected>-SELECT ONE-
                  <?php
              
                  $query = "SELECT * FROM teams ";
                  $result = $conn->query($query);
              
                  while ($row = $result->fetch_assoc()) {
                    ?><option name = '<?php echo $row['teamNameAndMascot']; ?>' value = '<?php echo $row['teamNameAndMascot']; ?>'><?php echo $row['teamNameAndMascot']
                    ;?>
                  <?php } ?>
              
                </select>
              <br>
              <select name = 'addPosition2' id = 'addPosition2'>
                  <option name = 'Select One' value = '' disabled selected = 'selected'>-SELECT ONE-
                  <?php
                  
                  $query = "SELECT * FROM positions";
                  $result = $conn->query($query);
                  
                  while($row = $result->fetch_assoc()) {
                    ?>
                    
                    <option name = '<?php echo $row['position']; ?>' value = '<?php echo $row['position']; ?>'><?php echo $row['position']
                    ; ?>
                  <?php } ?>
                  
              </select>
            </td>
          </tr>
          <tr class = 'imbTable player3' hidden>
            <td class = 'formLabel'>Player 3 Name:
              <br>
              Team:
              <br>
              Position:
            </td>
              <td class = 'formInput'>
                <input type = 'text' id = 'player3' name = 'addPlayer3' autocomplete = 'off' size = 20>
                <br>
                <select name = 'addTeam3' id = 'addTeam3'>
                  <option name = 'Select One' value = '' disabled selected = selected>-SELECT ONE-
                  <?php
              
                  $query = "SELECT * FROM teams ";
                  $result = $conn->query($query);
              
                  while ($row = $result->fetch_assoc()) {
                    ?><option name = '<?php echo $row['teamNameAndMascot']; ?>' value = '<?php echo $row['teamNameAndMascot']; ?>'><?php echo $row['teamNameAndMascot']
                    ;?>
                  <?php } ?>
              
                </select>
                <br>
                <select name = 'addPosition3' id = 'addPosition3'>
                  <option name = 'Select One' value = '' disabled selected = 'selected'>-SELECT ONE-
                  <?php
                  
                  $query = "SELECT * FROM positions";
                  $result = $conn->query($query);
                  
                  while($row = $result->fetch_assoc()) {
                    ?>
                    
                    <option name = '<?php echo $row['position']; ?>' value = '<?php echo $row['position']; ?>'><?php echo $row['position']
                    ; ?>
                  <?php } ?>
                  
                </select>
              </td>
            </tr>
            
        
            <tr class = 'imbTable player4' hidden>
              <td class = 'formLabel'>Player 4 Name:
                <br>
                Team:
                <br>
                Position:
              </td>
              <td class = 'formInput'>
                <input type = 'text' id = 'player4' name = 'addPlayer4' autocomplete = 'off' size = 20>
                <br>
                <select name = 'addTeam4' id = 'addTeam4'>
                  <option name = 'Select One' value = '' disabled selected = selected>-SELECT ONE-
                  <?php 
              
                  $query = "SELECT * FROM teams ";
                  $result = $conn->query($query);
              
                  while ($row = $result->fetch_assoc()) {
                    ?><option name = '<?php echo $row['teamNameAndMascot']; ?>' value = '<?php echo $row['teamNameAndMascot']; ?>'><?php echo $row['teamNameAndMascot']
                    ;?>
                  <?php } ?>
              
                </select>
                <br>
                <select name = 'addPosition4' id = 'addPosition4'>
                  <option name = 'Select One' value = '' disabled selected = 'selected'>-SELECT ONE-
                  <?php
                  
                  $query = "SELECT * FROM positions";
                  $result = $conn->query($query);
                  
                  while($row = $result->fetch_assoc()) {
                    ?>
                    
                    <option name = '<?php echo $row['position']; ?>' value = '<?php echo $row['position']; ?>'><?php echo $row['position']
                    ; ?>
                  <?php } ?>
                  
                </select>
              </td>
            </tr>
          </tbody>
        </table>
      </td>
      <td>
        <table class = 'formTable'>
          <tbody>
            <tr class = 'imbTable'>
              <td class = 'formLabel'>Card Manufacturer:</td>
              <td class = 'formInput'>
                <select name = 'addManu' class = 'addManu' id = 'addManu'>
                  <option name = 'Select One' value = '' disabled selected = 'selected'>-SELECT ONE-
                  <?php
                            
                  $query = "SELECT * FROM cardManufacturers";
                  $result = $conn->query($query);
                            
                  while ($row = $result->fetch_assoc()) {
                    ?><option name = '<?php echo $row['cardManufacturer']; ?>' value = '<?php echo $row['cardManufacturer']; ?>'> <?php echo $row['cardManufacturer']
                    ;?>   
                  <?php } ?>   
                </select>
              </td>
            </tr>
            <tr class = 'imbTable'>
              <td class = 'formLabel'>Card Set:</td>
              <td class = 'formInput'>
                <select disabled name = 'addCardSet' id = 'addCardSet'>
                  <option name = 'Select One' value = '' disabled selected = selected>-SELECT ONE-
                  <?php
                  
                  $query = "SELECT * FROM cardSets";
                  $result = $conn->query($query);
                  
                  while ($row = $result->fetch_assoc()) {
                    ?><option name = '<?php echo $row['cardSet']; ?>' value = '<?php echo $row['cardSet']; ?>'><?php echo $row['cardSet']
                    ;?> 
                  <?php } ?>
                </select>
              </td>
            </tr>
            <tr class = 'imbTable'>
              <td class = 'formLabel'>Insert Type:</td>
              <td class = 'formInput'>
                <select disabled name = 'addInsert' id = 'addInsert'>
                  <option name = 'Select One' value = '' disabled selected = selected>-SELECT ONE-
                  <?php
                  
                  $query = "SELECT * FROM inserttype";
                  $result = $conn->query($query);
                  
                  while ($row = $result->fetch_assoc()) {
                  ?><option name = '<?php echo $row['insertType']; ?>' value = '<?php echo $row['insertType']; ?>'><?php echo $row['insertType']
                  ;?>
                  <?php } ?>
                  
                </select>
              </td>
            </tr>
            <tr class = 'imbTable'>
              <td class = 'formLabel'>Year:</td>
              <td class = 'formInput'>
                <input type = 'text' name = 'addYear' autocomplete = 'off' size = 4 maxlength = 4>
              </td>
            </tr>
            <tr class = 'imbTable'>
              <td class = 'formLabel'>Card #:</td>
              <td class = 'formInput'>
                <input type = 'text' name = 'addNumber' autocomplete = 'off' size = 10 maxlength = 10>
              </td>
            </tr>
            <tr class = 'imbTable'>
              <td class = 'formLabel'>Serial #:</td>
              <td class = 'formInput'>
                <input type = 'text' name = 'addSerial' size = 4 maxlength = 10> of 
                <input type = 'text' name = 'addOutOf' size = 4 maxlength = 10>
              </td>
            </tr>
            <tr class = 'imbTable'>
              <td class = 'formLabel'># of Cards:</td>
              <td class = 'formInput'>
                <input type = 'text' name = 'addNumOfCards' autocomplete = 'off' size = 5 maxlength = 3 value = '1'>
              </td>
            </tr>
            <tr class = 'imbTable'>
              <td class = 'formLabel'>Price:</td>
              <td class = 'formInput'>
                <input type = 'text' name = 'addPrice' value = '0.00' autocomplete = 'off' size = 6 maxlength = 10>
              </td>
            </tr>
            <tr class = 'imbTable'>
              <td class = 'formLabel'>Location:</td>
              <td class = 'formInput'>
                <input type = 'text' name = 'addLocation' autocomplete = 'off' size = 20 maxlength = 20>
              </td>
            </tr> 
          </tbody>
        </table>  
      </td>
    </tr>  
    <tr class = 'formSubmit'>
      <td colspan = 2>
        <input type = 'submit' name = 'Submit' value = 'Add Card'>
        <input type = 'reset' id = 'reset' name = 'reset' value = 'Reset'>
      </td>
    </tr>  
  </tbody>
  </table>
  </form>
  <br>
  <br>
  
  <?php
  
  $query = "SELECT * FROM cards";
  $result = $conn->query($query);
  
  if ($result->num_rows > 0) {
    ?>
    
    <table id = 'cardTable'>
      <tr>
        <th width = 4%>Edit</th>
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
      
      
      while ($row=$result->fetch_assoc()) {
        ?>
        
        <tr class = 'cardData' >
          
          <td class = 'tableData'>
            <a class = 'rowEdit' name = '<?php echo $row['cardID']; ?>'>Edit</a> 
            
             <!--
            <form method = 'POST' action = 'editCard.php' class = 'inline rowEdit'>
              
              <input type = 'hidden' name = 'cardID'  value = '<?php echo $row['cardID']; ?>'>
              <input type = 'submit' name 'submitEdit' value = 'Edit' class = 'rowEdit'>
             <span class ='arrow'> &raquo</span>
            </form> -->
          </td>
          <td class = 'tableData'><?php echo $row['playerName']; ?>
            <?php if ($row['playerName2'] != NULL) { ?> <br><?php echo $row['playerName2']; } ?>
            <?php if ($row['playerName3'] != NULL) { ?> <br><?php echo $row['playerName3']; } ?>
            <?php if ($row['playerName4'] != NULL) { ?> <br><?php echo $row['playerName4']; } ?></td>
          <td class = 'tableData'><?php echo $row['playerPosition']; ?>
            <?php if ($row['playerPosition2'] != NULL) { ?> <br><?php echo $row['playerPosition2']; } ?>
            <?php if ($row['playerPosition3'] != NULL) { ?> <br><?php echo $row['playerPosition3']; } ?>
            <?php if ($row['playerPosition4'] != NULL) { ?> <br><?php echo $row['playerPosition4']; } ?></td>
          <td class = 'tableData'><?php echo $row['teamName']; ?>
            <?php if ($row['teamName2'] != NULL) { ?> <br><?php echo $row['teamName2']; } ?>
            <?php if ($row['teamName3'] != NULL) { ?> <br><?php echo $row['teamName3']; } ?>
            <?php if ($row['teamName4'] != NULL) { ?> <br><?php echo $row['teamName4']; } ?></td>
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
    <p> 0 results </p>
    
  <?php } ?>  
  <div id = 'editModal' class = 'modal'>
    <div class = 'modal-content'>
    <span class='close'>&times;</span>
      <br>
      <div id = 'cardIdNum'></div> 

      
    </div>
  </div>
  
</body>
</html>

<?php
$conn->close();
?>
     