const apiKey="e33a1fcad46b83cf3f516ccef5c3898e";
const apiUrl="https://api.openweathermap.org/data/2.5/weather?units=metric&q=zamboanga";
const weatherIcon=document.querySelector(".weather-icon");

async function checkWeather() {
    const response = await fetch(apiUrl+`&appid=${apiKey}`);
    var data = await response.json();

    console.log(data);

    document.querySelector(".city").innerHTML=data.name;
    document.querySelector(".temp").innerHTML= Math.round(data.main.temp) + "°C";
    document.querySelector(".humidity").innerHTML=data.main.humidity + "%";
    document.querySelector(".wind").innerHTML=data.wind.speed + "km/h";

    if(data.weather[0].main=="Clouds"){
        weatherIcon.src="weather-icons/cloudy (1).png";
    }
    else if(data.weather[0].main=="Clear"){
        weatherIcon.src="weather-icons/sunny.png";
    }
    else if(data.weather[0].main=="Rain"){
        weatherIcon.src="weather-icons/heavy-rain.png";
    }
    else if(data.weather[0].main=="Drizzle"){
        weatherIcon.src="weather-icons/cloudy-lightrain.png";
    }
    else if(data.weather[0].main=="Thunderstorm"){
        weatherIcon.src="weather-icons/storm.png";
    }
}
checkWeather();