var API_KEY = "J7VsOvy8ZpaM6tsgzjXdY78qAXBSUfL29WOn6gvd";

var lat, long;
lat = "47.64";
long = "26.26";

var soilTemperature, soilMoisture;

getSoilData(lat, long);
console.log(soilTemperature);
console.log(soilMoisture);

function celsiusToFahrenheit(tempCelsius){
    return (tempCelsius - 32) * (5 / 9);
}

function getSoilData(latSoil, longSoil){
    var url = "https://api.ambeedata.com/soil/latest/by-lat-lng?lat=" + latSoil + "&lng=" + longSoil;
    const settings = {
        "async": true,
        "crossDomain": true,
        "url": url,
        "method": "GET",
        "headers": {
            "x-api-key": API_KEY,
            "Content-type": "application/json"
        }
    };
    $.ajax(settings).done(function (response) {
        soilTemperature = celsiusToFahrenheit(response.data[0]['soil_temperature']);
        soilMoisture = response.data[0]['soil_moisture'];
    });
}
