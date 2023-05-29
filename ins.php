<?php
$con = mysqli_connect('localhost', 'root', '', 'country_state_city') or die('Connection Failed !');

$city = $_POST['city'];
$state = $_POST['state'];
$country = $_POST['country'];
$response = [];
if (empty($city)) {
    $response['city_err'] = "Please select city.";
    $response['status'] = 400;
}
if (empty($state)) {
    $response['state_err'] = "Please select state.";
    $response['status'] = 400;
}
if (empty($country)) {
    $response['country_err'] = "Please select country.";
    $response['status'] = 400;
}
if (empty($response)) {
    $country=explode(',',$country);
    $state=explode(',',$state);
    $city=explode(',',$city);
    $data_ins = mysqli_query($con, "INSERT INTO datatable (`city`,`state`,`country`) VALUES ('$city[1]','$state[1]','$country[1]')");
    $response['success'] = "Data inserted successfully.";
    $response['status'] = 200;
} else {
    $response['error'] = "Something went wrong.";
    $response['status'] = 400;
}

echo json_encode($response);
?>