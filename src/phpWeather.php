<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Weather Application</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/custom.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>

</head>

<?php

if (!empty($_POST['city'])) {
    $url = 'http://api.weatherapi.com/v1/current.json?key=510eb7be47904818b8a174646202809&q=';
    $urlEnd = '&aqi=no';
    $city = $_POST['city'];

    $urlFull = $url . $city . $urlEnd;


    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $urlFull);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $result = curl_exec($ch);

    curl_close($ch);

    $array = json_decode($result, true);

    $timeSlpit = $array['location']['localtime'];
    $time = explode(" ", $timeSlpit);
}

?>

<body>
    <a href="/" type="buttom" class="btn btn-sm btn-info">Back to JS Page</a>

    <div class="text-center">
        <h1 class="m-0 col-3 m-auto bg-gradient p-3 titleCard">Weather Application</h1>
    </div>

    <div class="container" style="margin-top: 150px;">
        <div class="col-6 m-auto">

            <form action="phpWeather.php" method="POST" class="d-flex justify-content-evenly weatherCard p-3">
                <h4>Type the city:</h4>

                <input class="form-control w-50" type="text" name="city" id="city">
                <button class=" btn btn-success" type="submit">Find</button>

            </form>

        </div>
    </div>

    <?php if (!empty($_POST['city'])) { ?>

        <div class="container" style="margin-top: 150px;">
            <div class="d-flex flex-column p-3 m-auto weatherCard col-6">
                <div class="d-flex justify-content-between pb-4 border-bottom">
                    <div class="d-flex align-items-end">
                        <h3 class="m-0 me-3"><?= $array['location']['name'] ?></h3>
                        <h6 class="m-0 me-3"><?= $array['location']['region'] ?></h6>
                        <h6 class="m-0"><?= $array['location']['country'] ?></h6>
                    </div>
                    <div class="align-self-end">
                        <h4 class="m-0"><?= $time[1] ?></h4>
                    </div>
                </div>
                <div class="d-flex pt-3 align-items-center justify-content-between">
                    <div class="d-flex">
                        <h3 class="m-0 me-3"><?= $array['current']['temp_c'] ?> &#x2103;</h3>
                        <div class="d-flex flex-column text-center">
                            <h6 class="m-0 tooltipEle" style="cursor: help;"><?= $array['current']['feelslike_c'] ?> &#x2103; <span class="tooltiptext">Feels Like</span></h6>
                            <h6 class="m-0 tooltipEle" style="cursor: help;"><?= $array['current']['humidity'] ?> % <span class="tooltiptext">Humidity</span></h6>
                        </div>
                    </div>
                    <h4 class="m-0"><?= $array['current']['condition']['text'] ?></h4>
                    <img src="<?= $array['current']['condition']['icon'] ?>">
                </div>
            </div>
        </div>

    <?php } ?>

</body>

</html>