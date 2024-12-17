<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather</title>
    <link rel="stylesheet" href="./CSS/weather.css">
</head>
<style>
    /* General Reset */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: Arial, sans-serif;
    }

    /* Container Styling */
    .weather-container {
        text-align: center;
        margin: 20px auto;
        max-width: 50%;
        background-color: #f5f5f5;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        padding: 20px;
    }

    .weather-container h3 {
        color: #333;
        margin-bottom: 15px;
        font-size: 1.5rem;
    }

    /* Card Design */
    .card {
        background-color: #ffffff;
        border-radius: 10px;
        padding: 15px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    /* Main Weather Section */
    .main-weather {
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
    }

    .weather-icon {
        width: 80px;
        height: 80px;
        margin-right: 15px;
    }

    .weather-info .temp {
        font-size: 2.5rem;
        color: #333;
    }

    .weather-info .city {
        font-size: 1.25rem;
        color: #666;
    }

    /* Weather Details */
    .details {
        display: flex;
        justify-content: space-around;
        gap: 10px;
    }

    .detail-item {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .icon {
        width: 40px;
        height: 40px;
    }

    .value {
        font-size: 1.2rem;
        color: #333;
        font-weight: bold;
    }

    .label {
        font-size: 0.9rem;
        color: #777;
    }

</style>
<body>
    <header class="header-top">
        <h1 style="color: white; padding-left: 12px; padding-bottom: 15px;">AguaThink</h1>
        <nav class="navigation">
            <a href="homePage.php">Home</a>
            <a href="evacuationSite.php">Evacuation Site</a>
        </nav>
    </header>
    <div class="weather-container">
        <h3>Zamboanga City Current Weather Update</h3>
        <div class="card">
            <div class="weather">
                <div class="main-weather">
                    <img src="weather-icons/cloudy-lightrain.png" alt="Weather Icon" class="weather-icon">
                    <div class="weather-info">
                        <h1 class="temp">28°C</h1>
                        <h2 class="city">Zamboanga City</h2>
                    </div>
                </div>
                <div class="details">
                    <div class="detail-item">
                        <img src="weather-icons/humidity.png" alt="Humidity Icon" class="icon">
                        <div>
                            <p class="value humidity">50%</p>
                            <p class="label">Humidity</p>
                        </div>
                    </div>
                    <div class="detail-item">
                        <img src="weather-icons/wind.png" alt="Wind Icon" class="icon">
                        <div>
                            <p class="value wind">15 km/h</p>
                            <p class="label">Wind Speed</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="./weather.js"></script>
</body>
</html>

