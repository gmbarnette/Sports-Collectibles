<?php 

include 'db.php';

$addSport = $_POST['addSport'];
$addManu = $_POST['addManu'];
$addTeam = $_POST['addTeam'];
$addCardSet = $_POST['addCardSet'];
$addInsertType = $_POST['addInsertType'];
$toChange = $_POST['toChange'];

if ($toChange === "addManu" || $toChange === "addManuEdit") {
    $query = "SELECT * FROM cardManufacturers WHERE sport = '$addSport'";
    $toChange = "cardManufacturer";
}

else if ($toChange === "addPosition" || $toChange === "addPosition2" || $toChange === "addPosition3" || $toChange === "addPosition4" ||
         $toChange === "addPositionEdit" || $toChange === "addPosition2Edit" || $toChange === "addPosition3Edit" || $toChange === "addPosition4Edit") {
    $query = "SELECT * FROM positions WHERE sport = '$addSport'";
    $toChange = "position";
}
else if ($toChange === "addTeam" || $toChange === "addTeam2" || $toChange === "addTeam3" || $toChange === "addTeam4" ||
         $toChange === "addTeamEdit" || $toChange === "addTeam2Edit" || $toChange === "addTeam3Edit" || $toChange === "addTeam4Edit") {
    $query = "SELECT * FROM teams WHERE sport = '$addSport'";
    $toChange = "teamNameAndMascot";
}
else if ($toChange === "addCardSet" || $toChange === "addCardSetEdit") {
    $query = "SELECT * FROM cardSets WHERE sport = '$addSport' AND cardManufacturer = '$addManu'";
    $toChange = "cardSet";
}
else if ($toChange === "addInsert" || $toChange === "addInsertEdit") {
    $query = "SELECT * FROM inserttype WHERE sport = '$addSport' AND cardManufacturer = '$addManu' AND cardSet = '$addCardSet'";
    $toChange = "insertType";
}



$result = $conn->query($query);
?>
<option name = 'Select One' value = '' disabled selected = 'selected'>-SELECT ONE-
<?php
while ($row=$result->fetch_assoc()) {
    ?>
    <option name = '<?php echo $row[$toChange]; ?>' value = '<?php echo $row[$toChange]; ?>' ><?php echo $row[$toChange];
}
?>

