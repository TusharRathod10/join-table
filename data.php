<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body class="p-3 m-0 border-0 bd-example">
    <h3 class="display-5">Data</h3>
    <p id="success" style="color:green; font-weight: bold;"></p>
    <p id="error" style="color:red; font-weight: bold;"></p>
    <form action="" method="post" id='form'>

        <label for="country" class="my-2" style='font-weight :600;'>Country : </label><br>
        <select name="country" id="country" class="form-control" style='width:25%'>
            <option value="" hidden selected> Select Country</option>
            <?php
            $con = mysqli_connect('localhost', 'root', '', 'country_state_city') or die('Connection Failed !');
            $query = "select * from countries order by name ASC";
            $result = mysqli_query($con, $query);
            while ($row = mysqli_fetch_array($result)) { ?>
                <option value="<?php echo $row['id']; echo ','.$row['name'];?>"><?php echo $row['name'] ?></option>
            <?php } ?>
        </select>
        <p id="country_err" style="color:red; font-weight: bold;"></p>

        <label for="state" class="my-2" id="state1" style='font-weight :600;'>State : </label><br>
        <select name="state" class="form-control" id="state" style='width:25%'>
            <option value="" hidden selected> Select state</option>
        </select>
        <p id="state_err" style="color:red; font-weight: bold;"></p>

        <label for="city" class="my-2" id="city1" style='font-weight :600;'>City : </label><br>
        <select name="city" id="city" ng-model="city" class="form-control" style='width:25%'>
            <option value="" hidden selected> Select city</option>
        </select>
        <p id="city_err" style="color:red; font-weight: bold;"></p>

        <button type="submit" name='submit' value="submit" id="submit" class='btn btn-primary'>Submit</button>
    </form>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
        $(document).ready(function () {

            $("#country").change(function () {
                var country_id = this.value;
                $.ajax({
                    url: "fetchdata.php",
                    type: "POST",
                    data: {
                        country_id: country_id
                    },
                    cache: false,
                    success: function (result) {
                        $("#state").html(result);
                    }
                });
            });
            $("#state").change(function () {
                var state_id = this.value;
                $.ajax({
                    url: "fetchdata.php",
                    type: "POST",
                    data: {
                        state_id: state_id
                    },
                    cache: false,
                    success: function (result) {
                        $("#city").html(result);
                    }
                });
            });
        });

        $('#form').submit(function (e) {
            e.preventDefault();
            $.ajax({
                url: 'ins.php',
                type: 'POST',
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function (response) {
                    $('#country_err').text("");
                    $('#state_err').text("");
                    $('#city_err').text("");
                    $('#error').text("");
                    var x = JSON.parse(response);
                    if (x.status == 400) {
                        $('#country_err').text(x.country_err);
                        $('#state_err').text(x.state_err);
                        $('#city_err').text(x.city_err);
                        $('#error').text(x.error);
                    } else if (x.status == 200) {
                        $('#success').text(x.success);
                        $('#form')[0].reset();
                    }
                }
            })
        })
    </script>
</body>

</html>