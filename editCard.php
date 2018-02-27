<?php
  
  include 'db.php';
  
  $cardId = $_POST['cardId'];
  

  $findCard = "SELECT * FROM cards WHERE cardID = '$cardId'";
  $cardInfo = $conn->query($findCard);
  $cardAttribute = $cardInfo->fetch_assoc();
  
  $serialNumberArray = !empty($cardAttribute['cardSerialNumber']) ? explode( "/" , $cardAttribute['cardSerialNumber']) : array("","");


  if ($cardAttribute['playerName4'] != NULL) {
    $playerNum = 4;
  }
  elseif ($cardAttribute['playerName3'] != NULL) {
    $playerNum = 3;
  }
  elseif ($cardAttribute['playerName2'] != NULL) {
    $playerNum = 2;
  }
  else {
    $playerNum = 1;
  }

  
  
?>
<script>

function changeSelectedEdit (toChange) {
      var addSport = document.getElementById("addSportEdit").value;
      var addTeam = document.getElementById("addTeamEdit").value;
      var addManu = document.getElementById("addManuEdit").value;
      var addCardSet = document.getElementById("addCardSetEdit").value;
      var addInsertType = document.getElementById("addInsertEdit").value;
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

    $("#addSportEdit").change(function() {
      
        changeSelectedEdit("addManuEdit");
        changeSelectedEdit("addTeamEdit");
        changeSelectedEdit("addTeam2Edit");
        changeSelectedEdit("addTeam3Edit");
        changeSelectedEdit("addTeam4Edit");
        changeSelectedEdit("addPositionEdit");
        changeSelectedEdit("addPosition2Edit");
        changeSelectedEdit("addPosition3Edit");
        changeSelectedEdit("addPosition4Edit");

        disableSelect("addCardSetEdit");
        disableSelect("addInsertEdit");
        enableSelect("numOfPlayersEdit");
        enableSelect("addTeamEdit");
        enableSelect("addPositionEdit");

        $("#numOfPlayersEdit").val('1');
        $(".player2Edit").hide();
        $(".player3Edit").hide();
        $(".player4Edit").hide();
        $("#addPlayerEdit").val('');
        $("#addPlayer2Edit").val('');
        $("#addPlayer3Edit").val('');
        $("#addPlayer4Edit").val('');
        $("#addCardSetEdit").val('');
        $("#addInsertEdit").val('');
      });  
    
      $("#addManuEdit").change(function(){
        
        changeSelectedEdit("addCardSetEdit");
        changeSelectedEdit("addInsertEdit");

        enableSelect("addCardSetEdit");
        disableSelect("addInsertEdit");  
      });
      
      $("#addCardSetEdit").change(function(){
        changeSelectedEdit("addInsertEdit"); 

        enableSelect("addInsertEdit"); 
      });

$("#numOfPlayersEdit").change(function(){
       if ($(this).val() === "1"){
         
         $("#addPosition2Edit").val('');
         $("#addPlayer2Edit").val('');
         $("#addTeam2Edit").val('');
         $(".player2Edit").hide();
      
         $("#addPosition3Edit").val('');
         $("#addPlayer3Edit").val('');
         $("#addTeam3Edit").val('');
         $(".player3Edit").hide();

         $("#addPosition4Edit").val('');
         $("#addPlayer4Edit").val('');
         $("#addTeam4Edit").val('');
         $(".player4Edit").hide();
        
       }  
       else if ($(this).val() === "2") {
        
         $(".player2Edit").show();

         $("#addPosition3Edit").val('');
         $("#addPlayer3Edit").val('');
         $("#addTeam3Edit").val('');
         $(".player3Edit").hide();

         $("#addPosition4Edit").val('');
         $("#addPlayer4Edit").val('');
         $("#addTeam4Edit").val('');
         $(".player4Edit").hide();
      
       }
       else if ($(this).val() === "3") {
         
         $(".player2Edit").show();
         $(".player3Edit").show();
         
         $("#addPosition4Edit").val('');
         $("#addPlayer4Edit").val(''); 
         $("#addTeam4Edit").val('');
         $(".player4Edit").hide();
          
       }
       else if ($(this).val() === "4") {
        
         $(".player2Edit").show();
         $(".player3Edit").show();
         $(".player4Edit").show();
       
       }
     }); 

</script>
 <form action = 'addCard.php' method = 'POST'>
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
                <select name = 'addSportEdit' id = 'addSportEdit' >
                  <option name = 'Select One' value = '' disabled>-SELECT ONE-
                  <?php
               
                  $query = "SELECT * FROM sports";
                  $result = $conn->query($query);
                  
              
                  while ($row=$result->fetch_assoc()) {
                    ?><option name = '<?php echo $row['sport']; ?>' value = '<?php echo $row['sport']; ?>' <?php if($row['sport'] == $cardAttribute['sport']){echo "selected = 'selected'";} ?>><?php echo $row['sport']
                    ;?>            
                  <?php } ?>
              
                </select>
              </td>
            </tr>
            <tr class = 'imbTable'>
              <td class = 'formLabel'># of Players</td>
              <td class = 'formInput'>
                <select name = 'numOfPlayersEdit' id = 'numOfPlayersEdit' value = '<?php echo $playerNum ?>'>
                  <?php 
                  $counter = 1;
                  while($counter < 5){
                   ?><option name = '<?php echo $counter ?>' value = '<?php echo $counter ?>' <?php if ($counter === $playerNum) {echo "selected = 'selected'";} ?> > <?php echo $counter; ?>
                  <?php
                  $counter = $counter + 1;
                  }
                  ?>
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
                <input type = 'text' id = 'addPlayerEdit' name = 'addPlayerEdit' autocomplete = 'off' size = 20 value = '<?php echo $cardAttribute['playerName']; ?>'>
                <br>
                <select name = 'addTeamEdit' id = 'addTeamEdit'>
                  <option name = 'Select One' value = '' disabled>-SELECT ONE-
                  <?php
              
                  $query = "SELECT * FROM teams ";
                  $result = $conn->query($query);
              
                  while ($row = $result->fetch_assoc()) {
                    ?><option  name = '<?php echo $row['teamNameAndMascot']; ?>' value = '<?php echo $row['teamNameAndMascot']; ?>'<?php if ($row['teamNameAndMascot'] === $cardAttribute['teamName']) {echo "selected = 'selected'";} ?> ><?php echo $row['teamNameAndMascot']
                    ;?>
                  <?php } ?>
              
                </select>
                <br>
                <select name = 'addPositionEdit' id = 'addPositionEdit'>
                  <option name = 'Select One' value = ''>-SELECT ONE-
                  <?php
                  
                  $query = "SELECT * FROM positions";
                  $result = $conn->query($query);
                  
                  while($row = $result->fetch_assoc()) {
                    ?>
                    
                    <option name = '<?php echo $row['position']; ?>' value = '<?php echo $row['position']; ?>' <?php if ($row['position'] === $cardAttribute['playerPosition']) {echo "selected = 'selected'";} ?>><?php echo $row['position']
                    ; ?>
                  <?php } ?>
                  
                </select>
              </td>
            </tr>
            <tr class = 'imbTable player2Edit' <?php if( $playerNum === 1) {echo "hidden";} ?>>
              <td class = 'formLabel'>Player 2 Name:
              <br>
              Team:
              <br>
              Position:
              </td>
              <td class = 'formInput'>
                <input type = 'text' id = 'addPlayer2Edit' name = 'addPlayer2Edit' autocomplete = 'off' size = 20 <?php if ($cardAttribute['playerName2'] != NULL) { echo "value = '" . $cardAttribute['playerName2']."'";} ?> >
                <br>
                <select name = 'addTeam2Edit' id = 'addTeam2Edit'>
                  <option name = 'Select One' value = ''>-SELECT ONE-
                  <?php
              
                  $query = "SELECT * FROM teams ";
                  $result = $conn->query($query);
              
                  while ($row = $result->fetch_assoc()) {
                    ?><option name = '<?php echo $row['teamNameAndMascot']; ?>' value = '<?php echo $row['teamNameAndMascot']; ?>' <?php if($row['teamNameAndMascot'] === $cardAttribute['teamName2']) {echo "selected = 'selected'";} ?>><?php echo $row['teamNameAndMascot']
                    ;?>
                  <?php } ?>
              
                </select>
              <br>
              <select name = 'addPosition2Edit' id = 'addPosition2Edit'>
                  <option name = 'Select One' value = '' disabled selected = 'selected'>-SELECT ONE-
                  <?php
                  
                  $query = "SELECT * FROM positions";
                  $result = $conn->query($query);
                  
                  while($row = $result->fetch_assoc()) {
                    ?>
                    
                    <option name = '<?php echo $row['position']; ?>' value = '<?php echo $row['position']; ?>' <?php if( $row['position'] === $cardAttribute['playerPosition2']) {echo 'selected = "selected"';} ?> ><?php echo $row['position']
                    ; ?>
                  <?php } ?>
                  
              </select>
            </td>
          </tr>
          <tr class = 'imbTable player3Edit' <?php if($playerNum === 1 || $playerNum === 2) {echo "hidden";} ?> >
            <td class = 'formLabel'>Player 3 Name:
              <br>
              Team:
              <br>
              Position:
            </td>
              <td class = 'formInput'>
                <input type = 'text' id = 'addPlayer3Edit' name = 'addPlayer3Edit' autocomplete = 'off' size = 20 <?php if($cardAttribute['playerName3'] != NULL) { echo "value = '" . $cardAttribute['playerName3'] . "'";} ?>>
                <br>
                <select name = 'addTeam3Edit' id = 'addTeam3Edit'>
                  <option name = 'Select One' value = '' disabled selected = selected>-SELECT ONE-
                  <?php
              
                  $query = "SELECT * FROM teams ";
                  $result = $conn->query($query);
              
                  while ($row = $result->fetch_assoc()) {
                    ?><option name = '<?php echo $row['teamNameAndMascot']; ?>' value = '<?php echo $row['teamNameAndMascot']; ?>' <?php if($row['teamNameAndMascot'] === $cardAttribute['teamName3']) {echo 'selected = "selected"';} ?> ><?php echo $row['teamNameAndMascot']
                    ;?>
                  <?php } ?>
              
                </select>
                <br>
                <select name = 'addPosition3Edit' id = 'addPosition3Edit'>
                  <option name = 'Select One' value = '' disabled selected = 'selected'>-SELECT ONE-
                  <?php
                  
                  $query = "SELECT * FROM positions";
                  $result = $conn->query($query);
                  
                  while($row = $result->fetch_assoc()) {
                    ?>
                    
                    <option name = '<?php echo $row['position']; ?>' value = '<?php echo $row['position']; ?>' <?php if($row['position'] === $cardAttribute['playerPosition3']) { echo 'selected = "selected"';} ?> ><?php echo $row['position']
                    ; ?>
                  <?php } ?>
                  
                </select>
              </td>
            </tr>
            
        
            <tr class = 'imbTable player4Edit' <?php if($playerNum === 1 || $playerNum === 2 || $playerNum === 3) {echo "hidden";} ?> >
              <td class = 'formLabel'>Player 4 Name:
                <br>
                Team:
                <br>
                Position:
              </td>
              <td class = 'formInput'>
                <input type = 'text' id = 'addPlayer4Edit' name = 'addPlayer4Edit' autocomplete = 'off' size = 20 <?php if ($cardAttribute['playerName4'] != NULL) { echo "value = '" . $cardAttribute['playerName4'] . "'";} ?>>
                <br>
                <select name = 'addTeam4Edit' id = 'addTeam4Edit'>
                  <option name = 'Select One' value = '' disabled selected = selected>-SELECT ONE-
                  <?php
              
                  $query = "SELECT * FROM teams ";
                  $result = $conn->query($query);
              
                  while ($row = $result->fetch_assoc()) {
                    ?><option name = '<?php echo $row['teamNameAndMascot']; ?>' value = '<?php echo $row['teamNameAndMascot']; ?>' <?php if($row['teamNameAndMascot'] === $cardAttribute['teamName4']) {echo "selected = 'selected'";} ?>><?php echo $row['teamNameAndMascot']
                    ;?>
                  <?php } ?>
              
                </select>
                <br>
                <select name = 'addPosition4Edit' id = 'addPosition4Edit'>
                  <option name = 'Select One' value = '' disabled selected = 'selected'>-SELECT ONE-
                  <?php
                  
                  $query = "SELECT * FROM positions";
                  $result = $conn->query($query);
                  
                  while($row = $result->fetch_assoc()) {
                    ?>
                    
                    <option name = '<?php echo $row['position']; ?>' value = '<?php echo $row['position']; ?>' <?php if($row['position'] === $cardAttribute['playerPosition4']) {echo "selected = 'selected'";} ?>><?php echo $row['position']
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
                <select name = 'addManuEdit' id = 'addManuEdit'>
                  <option name = 'Select One' value = '' disabled selected = 'selected'>-SELECT ONE-
                  <?php
                            
                  $query = "SELECT * FROM cardManufacturers";
                  $result = $conn->query($query);
                            
                  while ($row = $result->fetch_assoc()) {
                    ?><option name = '<?php echo $row['cardManufacturer']; ?>' value = '<?php echo $row['cardManufacturer']; ?>' <?php if ($row['cardManufacturer'] == $cardAttribute['cardManufacturer']) {echo "selected = 'selected'";} ?>> <?php echo $row['cardManufacturer']
                    ;?>   
                  <?php } ?>   
                </select>
              </td>
            </tr>
            <tr class = 'imbTable'>
              <td class = 'formLabel'>Card Set:</td>
              <td class = 'formInput'>
                <select name = 'addCardSetEdit' id = 'addCardSetEdit'>
                  <option name = 'Select One' value = '' disabled selected = selected>-SELECT ONE-
                  <?php
                  
                  $query = "SELECT * FROM cardSets";
                  $result = $conn->query($query);
                  
                  while ($row = $result->fetch_assoc()) {
                    ?><option name = '<?php echo $row['cardSet']; ?>' value = '<?php echo $row['cardSet']; ?>' <?php if ($row['cardSet'] == $cardAttribute['cardSet']){ echo "selected = 'selected'";} ?> ><?php echo $row['cardSet']
                    ;?> 
                  <?php } ?>
                </select>
              </td>
            </tr>
            <tr class = 'imbTable'>
              <td class = 'formLabel'>Insert Type:</td>
              <td class = 'formInput'>
                <select name = 'addInsertEdit' id = 'addInsertEdit'>
                  <option name = 'Select One' value = '' disabled selected = selected>-SELECT ONE-
                  <?php
                  
                  $query = "SELECT * FROM inserttype";
                  $result = $conn->query($query);
                  
                  while ($row = $result->fetch_assoc()) {
                  ?><option name = '<?php echo $row['insertType']; ?>' value = '<?php echo $row['insertType']; ?>' <?php if ($row['insertType'] == $cardAttribute['insertType']){echo "selected = 'selected'";} ?> ><?php echo $row['insertType']
                  ;?>
                  <?php } ?>
                  
                </select>
              </td>
            </tr>
            <tr class = 'imbTable'>
              <td class = 'formLabel'>Year:</td>
              <td class = 'formInput'>
                <input type = 'text' name = 'addYearEdit' autocomplete = 'off' size = 4 maxlength = 4 value = '<?php echo $cardAttribute['cardYear'] ?>'>
              </td>
            </tr>
            <tr class = 'imbTable'>
              <td class = 'formLabel'>Card #:</td>
              <td class = 'formInput'>
                <input type = 'text' name = 'addNumberEdit' autocomplete = 'off' size = 10 maxlength = 10 value = '<?php echo $cardAttribute['cardNumber']; ?>'>
              </td>
            </tr>
            <tr class = 'imbTable'>
              <td class = 'formLabel'>Serial #:</td>
              <td class = 'formInput'>
                <input type = 'text' name = 'addSerialEdit' size = 4 maxlength = 10 value = '<?php echo $serialNumberArray[0]; ?>'> of 
                <input type = 'text' name = 'addOutOfEdit' size = 4 maxlength = 10 value = '<?php echo $serialNumberArray[1]; ?>'>
              </td>
            </tr>
            <tr class = 'imbTable'>
              <td class = 'formLabel'># of Cards:</td>
              <td class = 'formInput'>
                <input type = 'text' name = 'addNumOfCardsEdit' autocomplete = 'off' size = 5 maxlength = 3 value = '<?php echo $cardAttribute['numberOfCards']; ?>'>
              </td>
            </tr>
            <tr class = 'imbTable'>
              <td class = 'formLabel'>Price:</td>
              <td class = 'formInput'>
                <input type = 'text' name = 'addPriceEdit' autocomplete = 'off' size = 6 maxlength = 10 value = '<?php echo $cardAttribute['price']; ?>'>
              </td>
            </tr>
            <tr class = 'imbTable'>
              <td class = 'formLabel'>Location:</td>
              <td class = 'formInput'>
                <input type = 'text' name = 'addLocationEdit' autocomplete = 'off' size = 20 maxlength = 20 value = '<?php echo $cardAttribute['location']; ?>'>
              </td>
            </tr> 
          </tbody>
        </table>  
      </td>
    </tr>  
    <tr class = 'formSubmit'>
      <td colspan = 2>
        <input type = 'hidden' name = 'cardIdEdit' value = <?php echo $cardId ?> >
        <input type = 'submit' name = 'Update' value = 'Update'>
        <input type = 'submit' onClick = 'return confirm("Do you really want to Delete this card? This action can not be undone");' id = 'Delete' name = 'Delete' value = 'Delete'>
        
      </td>
    </tr>  
  </tbody>
  </table>
  </form>