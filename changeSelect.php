<?php

include 'db.php';

$toSelect = $_POST['selected'];
$toSelect1 = $_POST['selected1'];
$toChange = $_POST['toChange'];


if ($toChange == "addTeam" && $toSelect1 == "addSport" || $toChange == "addTeamEdit" && $toSelect1 == "addSportEdit") {
  $query = "SELECT * FROM  teams WHERE sport = '$toSelect'";
  $result = $conn->query($query); ?>
  
  <option name = 'Select One' Value = '' disabled selected = 'selected'>-SELECT ONE-
  
  <?php
  while($row = $result->fetch_assoc()) {
    ?>
  
    <option name = '<?php echo $row['teamNameAndMascot']; ?>' value = '<?php echo $row['teamNameAndMascot']; ?>'> <?php echo $row['teamNameAndMascot'];
  }
}

elseif ($toChange == "addManu" && $toSelect1 == "addSport") {
  $query = "SELECT * FROM cardManufacturers WHERE sport = '$toSelect'";
  $result = $conn->query($query); ?>
  
  <option name = 'Select One' Value = '' disabled selected = 'selected'>-SELECT ONE-
  
  <?php
  while($row = $result->fetch_assoc()) {
    ?>
  
    <option name = '<?php echo $row['cardManufacturer']; ?>' value = '<?php echo $row['cardManufacturer']; ?>'> <?php echo $row['cardManufacturer'];
  }
}

elseif ($toChange == "addCardSet" && $toSelect1 == "addManu") {
 
  $query = "SELECT * FROM cardSets WHERE cardManufacturer = '$toSelect'";
  $result = $conn->query($query); ?>
  
  <option name = 'Select One' Value = '' disabled selected = 'selected'>-SELECT ONE-
  
  <?php
  while($row = $result->fetch_assoc()) {
    ?>
  
    <option name = '<?php echo $row['cardSet']; ?>' value = '<?php echo $row['cardSet']; ?>'> <?php echo $row['cardSet'];
  } 
 } 
 
 elseif ($toChange == "addInsert" && $toSelect1 == "addManu") {
 
  $query = "SELECT * FROM inserttype WHERE cardManufacturer = '$toSelect'";
  $result = $conn->query($query); ?>
  
  <option name = 'Select One' Value = '' disabled selected = 'selected'>-SELECT ONE-
  
  <?php
  while($row = $result->fetch_assoc()) {
    ?>
  
    <option name = '<?php echo $row['insertType']; ?>' value = '<?php echo $row['insertType']; ?>'> <?php echo $row['insertType'];
  } 
 } 
 
 elseif ($toChange == "addInsert" && $toSelect1 == "addCardSet") {
 
  $query = "SELECT * FROM inserttype WHERE cardSet = '$toSelect'";
  $result = $conn->query($query); ?>
  
  <option name = 'Select One' Value = '' disabled selected = 'selected'>-SELECT ONE-
  
  <?php
  while($row = $result->fetch_assoc()) {
    ?>
  
    <option name = '<?php echo $row['insertType']; ?>' value = '<?php echo $row['insertType']; ?>'> <?php echo $row['insertType'];
  } 
 } 
 
  elseif ($toChange == "addPosition" && $toSelect1 == "addSport") {
  if ($toSelect === "null") {
    $query = "SELECT * FROM positions";
  }
  else {
    $query = "SELECT * FROM positions WHERE sport = '$toSelect'";
  }
  $result = $conn->query($query); ?>
  
  <option name = 'Select One' Value = '' disabled selected = 'selected'>-SELECT ONE-
  
  <?php
  while($row = $result->fetch_assoc()) {
    ?>
  
    <option name = '<?php echo $row['position']; ?>' value = '<?php echo $row['position']; ?>'> <?php echo $row['position'];
  } 
 } 
 
 elseif ($toChange == "addPosition2" && $toSelect1 == "addSport") {
 
  if ($toSelect === "null") {
    $query = "SELECT * FROM positions";
  }
  else {
    $query = "SELECT * FROM positions WHERE sport = '$toSelect'";
  }
  $result = $conn->query($query); ?>
  
  <option name = 'Select One' Value = '' disabled selected = 'selected'>-SELECT ONE-
  
  <?php
  while($row = $result->fetch_assoc()) {
    ?>
  
    <option name = '<?php echo $row['position']; ?>' value = '<?php echo $row['position']; ?>'> <?php echo $row['position'];
  } 
 } 
 
 elseif ($toChange == "addPosition3" && $toSelect1 == "addSport") {
 
  if ($toSelect === "null") {
    $query = "SELECT * FROM positions";
  }
  else {
    $query = "SELECT * FROM positions WHERE sport = '$toSelect'";
  }
  $result = $conn->query($query); ?>
  
  <option name = 'Select One' Value = '' disabled selected = 'selected'>-SELECT ONE-
  
  <?php
  while($row = $result->fetch_assoc()) {
    ?>
  
    <option name = '<?php echo $row['position']; ?>' value = '<?php echo $row['position']; ?>'> <?php echo $row['position'];
  } 
 } 
 
 elseif ($toChange == "addPosition4" && $toSelect1 == "addSport") {
 
  if ($toSelect === "null") {
    $query = "SELECT * FROM positions";
  }
  else {
    $query = "SELECT * FROM positions WHERE sport = '$toSelect'";
  }
  $result = $conn->query($query); ?>
  
  <option name = 'Select One' Value = '' disabled selected = 'selected'>-SELECT ONE-
  
  <?php
  while($row = $result->fetch_assoc()) {
    ?>
  
    <option name = '<?php echo $row['position']; ?>' value = '<?php echo $row['position']; ?>'> <?php echo $row['position'];
  } 
 } 
 $conn->close();
 
 ?>
