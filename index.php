<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <base href="http://localhost/brawijaya/">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        .weather-icon {
            width: 50px;
            height: auto;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        Weather Information
                        <small>
                            <b>
                                Maulida Khairunisa, S.Kom
                            </b>
                        </small>
                    </div>
                    <div class="card-body">
                        <?php
                            require_once 'class/WeatherApp.php';
                            $weatherApp = new WeatherApp('https://mgm.ub.ac.id/weather.json');
                            $weatherInfo = $weatherApp->fetchWeather();
                            if ($weatherInfo) {
                                ?>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">Longitude: <?php echo $weatherInfo['coord']['lon']; ?></li>
                                    <li class="list-group-item">Latitude: <?php echo $weatherInfo['coord']['lat']; ?></li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span>Weather: <?php echo $weatherInfo['weather']['main']; ?></span>
                                        <img class="weather-icon" draggable="false" src="<?php echo $weatherInfo['weather']['icon']; ?>" alt="Weather Icon">
                                    </li>
                                    <li class="list-group-item">Description: <?php echo $weatherInfo['weather']['description']; ?></li>
                                    <li class="list-group-item">Temperature: <?php echo $weatherInfo['temp']; ?></li>
                                    <li class="list-group-item">Feels Like: <?php echo $weatherInfo['feels_like']; ?></li>
                                    <li class="list-group-item">Sunrise: <?php echo $weatherInfo['sys']['sunrise']; ?></li>
                                    <li class="list-group-item">Sunset: <?php echo $weatherInfo['sys']['sunset']; ?></li>
                                </ul>
                                <?php
                            } else {
                                echo "Failed to fetch weather data.";
                            }
                        ?>
                        <hr>
                        <div class="container">
                            <center>
                                <small>
                                    Weather Information &copy; Brawjiaya University, 2024.
                                </small>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
