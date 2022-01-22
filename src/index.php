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



<body>
    <a href="phpWeather.php" type="buttom" class="btn btn-sm btn-info">Go to PHP Page</a>

    <div class="text-center mt-2">
        <h1 class="m-0 m-auto p-3 titleCard text-white col-8 col-sm-7 col-md-6 col-lg-5 col-xl-4 col-xxl-3">Weather Application</h1>
    </div>

    <div class="container" style="margin-top: 120px;">
        <div class="m-auto col-11 col-sm-11 col-md-9 col-lg-7 col-xl-6">

            <form action="/" method="POST" class="d-flex flex-column weatherCard p-3">

                <div class="d-flex justify-content-evenly w-100">
                    <h4 class="align-self-center">Type the city:</h4>
                    <input class="form-control w-50" type="text" name="city" id="city">
                    <button class=" btn btn-success" type="submit">Find</button>  
                </div>

                <span id="error" class="text-center mt-2 bg-danger d-none" style="border-radius: 8px;"
                    >Somethin went wrong! Type the city's name correct.</span>
            </form>

        </div>

    </div>

    <div class="container" style="margin-top: 150px;">
        <div id="results">
        </div>
    </div>

</body>

<script>
    $("form").on("submit", function(e) {

        var city = document.getElementById('city').value;

        $.ajax({
            type: "POST",
            url: "http://api.weatherapi.com/v1/current.json?key=510eb7be47904818b8a174646202809&q=" + city + "&aqi=no",
            error: function(e) {
                document.getElementById('error').classList.remove('d-none');
            },
            success: function(response) {

                document.getElementById('error').classList.add('d-none');

                var fullDate = response.location.localtime.split(" ");
                var time = fullDate[1];

                var resultsJSON = `<div class="d-flex flex-column p-3 m-auto weatherCard col-11 col-sm-11 col-md-9 col-lg-7 col-xl-6">
                                        <div class="d-flex justify-content-between pb-4 border-bottom">
                                            <div class="d-flex align-items-end">
                                                <h3 class="m-0 me-3">${response.location.name}</h3>
                                                <h6 class="m-0 me-3">${response.location.region}</h6>
                                                <h6 class="m-0">${response.location.country}</h6>
                                            </div>
                                            <div class="align-self-end">
                                                <h4 class="m-0">${time}</h4>
                                            </div>
                                        </div>
                                        <div class="d-flex pt-3 align-items-center justify-content-between">
                                            <div class="d-flex">
                                                <h3 class="m-0 me-3">${response.current.temp_c} &#x2103;</h3>
                                                <div class="d-flex flex-column text-center">
                                                    <h6 class="m-0 tooltipEle" style="cursor: help;">${response.current.feelslike_c} &#x2103; 
                                                        <span class="tooltiptext">Feels Like</span></h6>
                                                    <h6 class="m-0 tooltipEle" style="cursor: help;">${response.current.humidity} % 
                                                        <span class="tooltiptext">Humidity</span></h6>
                                                </div>
                                            </div>
                                            <h4 class="m-0">${response.current.condition.text}</h4>
                                            <img src="${response.current.condition.icon}">
                                        </div>
                                    </div>`

                var cardResults = document.getElementById('results');

                cardResults.innerHTML = resultsJSON;

            }

        });

        e.preventDefault();
    });
</script>

</html>