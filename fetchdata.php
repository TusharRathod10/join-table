<?php
$con = mysqli_connect('localhost', 'root', '', 'country_state_city') or die('Connection Failed !');

echo $country_id = $_POST['country_id'];
$query = "select * from states where country_id='" . $country_id . "' order by name ASC";
$result = mysqli_query($con, $query);

while ($row = mysqli_fetch_array($result)) {
    ?>
    <option value="" hidden selected> Select State</option>
    <option value='<?php echo $row['id'];echo ','.$row['name']; ?>'><?php echo $row['name']; ?></option>;
<?php }

$state_id = $_POST['state_id'];
$query = "select * from cities where state_id='" . $state_id . "' order by name ASC";
$result = mysqli_query($con, $query);

while ($row = mysqli_fetch_array($result)) {
    ?>
    <option value="" hidden selected> Select City</option>
    <option value='<?php echo $row['id'];echo ','.$row['name']; ?>'><?php echo $row['name']; ?></option>;
<?php }

?>