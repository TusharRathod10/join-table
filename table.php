<?php

$con = mysqli_connect('localhost', 'root', '', 'country_state_city') or die('Connection Failed !');

$select = "SELECT cities.id, countries.name as countryName, states.name as stateName, cities.name as cityName
FROM ((countries
INNER JOIN states ON states.country_id = countries.id)
INNER JOIN cities ON cities.state_id = states.id)";

$select_exe = mysqli_query($con, $select);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <title>join table</title>
</head>

<body>

    <table class="table table-light table-striped" style="width:99%; margin:10px;">

        <thead class="table-dark">
            <tr>
                <th>Id</th>
                <th>City</th>
                <th>State</th>
                <th>Country</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($data = mysqli_fetch_assoc($select_exe)) { ?>
                <tr>
                    <td>
                        <?php echo $data['id'] ?>
                    </td>
                    <td>
                        <?php echo $data['cityName'] ?>
                    </td>
                    <td>
                        <?php echo $data['stateName'] ?>
                    </td>
                    <td>
                        <?php echo $data['countryName'] ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>

    </table>
</body>

</html>