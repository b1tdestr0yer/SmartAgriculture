API_KEY = "c885f6eca6bc3774bb88fdae145a1004";

urlCurrent = "https://api.openweathermap.org/data/2.5/onecall?lat=" + lat + "&lon=" + long + "&units=metric&lang=ro&appid=" + API_KEY;

if(isPost == true){
    getWeather(urlCurrent);
}

async function getWeather(url){
    const response = await fetch(url);
    var data = await response.json();
    console.log(data.current.weather[0].description);
    temperature = data.current.temp;
    description = data.current.weather[0].description;
    pressure = data.current.pressure;
    humidity = data.current.humidity;
    windspeed = data.current.wind_speed;
    temperatureText = document.getElementById("temperature");
    temperatureDescription = document.getElementById("temperatureDescription");
    pressureText = document.getElementById("pressure");
    humidityText = document.getElementById("humidity");
    windspeedText = document.getElementById("windspeed");
    temperatureText.textContent = temperature + '\u2103';
    temperatureDescription.textContent = description;
    humidityText.textContent = humidity + "%";
    windspeedText.textContent = ((Number(windspeed) * 3.6).toPrecision(6)).toString() + " Km/h";
    pressureText.textContent = pressure + " hPa";    
}