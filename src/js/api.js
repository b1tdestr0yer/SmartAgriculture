API_KEY = "c885f6eca6bc3774bb88fdae145a1004";

const fivedays = ( (new Date(2019,10,10,0,0,0,0).getTime()) - (new Date(2019,10,5,0,0,0,0).getTime()) ) / 1000;
const oneday = ( (new Date(2019,10,10,0,0,0,0).getTime()) - (new Date(2019,10,9,0,0,0,0).getTime()) ) / 1000;

urlCurrent = "https://api.openweathermap.org/data/2.5/onecall?lat=" + lat + "&lon=" + long + "&units=metric&appid=" + API_KEY;
urlFormer = "http://api.openweathermap.org/data/2.5/onecall/timemachine?lat=" + lat + "&lon=" + long + "&units=metric&appid=" + API_KEY;

if(isPost == true){
    getCurrentData(urlCurrent);
    getFormerData(urlFormer);
    setTimeout(processData, 2000);
}

dictionaryTranslate = {"Sunflower": "Floarea Soarelui", "Potato": "Cartofi", "Wheat" : "Grâu", "Rapeseed": "Rapiță", "Soy": "Soia", "Maize": "Porumb", "Grapes" : "Struguri", "Tomato" : "Rosii"};
var tempsAvg = [], humidityAvg = [], realMinTemp = 999, realMaxTemp = - 273;
var realMinHumidity = 999, realMaxHumidity = -999;

function changecolor(element, color){
    element.classList.add(color);
}

function processData(){
    for (var key in dictionary){
        maxTemp = dictionary[key]['maxTemp'];
        minTemp = dictionary[key]['minTemp'];
        optimalTemp = dictionary[key]['optimalTemp'];
        maxHumidity = dictionary[key]['maxHumidity'];
        minHumidity = dictionary[key]['minHumidity'];
        optimalHumidity = dictionary[key]['optimalHumidity'];
        temp = 0;
        for(var i = 0; i < tempsAvg.length; i++){
            temp += tempsAvg[i];
        }
        temp /= tempsAvg.length;
        if(temp > maxTemp){
            percentageTemperature = 0;
        }
        else
            if(temp < minTemp){
                percentageTemperature = 0;
            }
            else
                if(temp > optimalTemp){
                    percentageTemperature = ((temp - maxTemp ) / (optimalTemp - maxTemp));
                    percentageTemperature *= 100;
                    //console.log('Tempreture bar' + percentageTemperature);
                }
                else
                    if(temp < optimalTemp){
                        percentageTemperature = ((temp - minTemp ) / (optimalTemp - minTemp));
                        percentageTemperature *= 100;
                        //console.log('Tempreture bar' + percentageTemperature);
                    }
                    else
                        if(temp == optimalTemp){
                            percentageTemperature = 100;
                            //console.log('baga tati');
                        }
        humid = 0;
        for(var i = 0; i < humidityAvg.length; i++){
            humid += humidityAvg[i];
        }
        humid /= humidityAvg.length;
        //console.log('-----' + humid + '-----');
        if(humid > maxHumidity){
            percentageHumidity = 0;
        }
        else
            if(humid < minHumidity){
                percentageHumidity = 0;
            }
            else
                if(humid > optimalHumidity){
                    percentageHumidity = ((humid - maxHumidity) / (optimalHumidity - maxHumidity));
                    percentageHumidity *= 100;
                    //console.log('Humidity bar' + percentageHumidity);
                }
                else
                    if(humid < optimalHumidity){
                        percentageHumidity = ((humid - minHumidity) / (optimalHumidity - minHumidity));
                        percentageHumidity *= 100;
                        //console.log('Humidity bar' + percentageHumidity);
                    }
                    else
                        if(humid == optimalHumidity){
                            percentageHumidity = 100;
                            //console.log('baga tati');
                        }
        progressBar = document.getElementById(key);
        progressBarText = document.getElementById(key + "Text");
        ul = document.getElementById("tasks");
        percentage = (3 * percentageTemperature + percentageHumidity) / 4;
        progressBar.style = "width:" + percentage.toPrecision(4) + "%;"
        progressBarText.textContent = percentage.toPrecision(4) + "%";
        if(percentage < 30){
            ul.innerHTML += ('<li class="list-group-item"><div class="row align-items-center no-gutters"><div class="col"><h6 class="mb-0 text-dark"><strong>Nu este deloc o zi bună pentru ' + dictionaryTranslate[key] + '.' + '</strong></h6><span class="text-xs"></span></div></div></li>');
            changecolor(progressBar, 'red');
        }
        else
            if(percentage < 70){
                ul.innerHTML += ('<li class="list-group-item"><div class="row align-items-center no-gutters"><div class="col"><h6 class="mb-0 text-dark"><strong>Este o zi bună pentru ' + dictionaryTranslate[key] + '.' + '</strong></h6><span class="text-xs"></span></div></div></li>');
                changecolor(progressBar, 'yellow');
            } 
            else
                if(percentage <= 100){
                    ul.innerHTML += ('<li class="list-group-item"><div class="row align-items-center no-gutters"><div class="col"><h6 class="mb-0 text-dark"><strong>Este o zi superbă pentru ' + dictionaryTranslate[key] + '.' + '</strong></h6><span class="text-xs"></span></div></div></li>');
                    changecolor(progressBar, 'green');
                }
                    
    }
}

async function getFormerData(url){
    var ts = Math.round((new Date()).getTime() / 1000);
    ts = ts - fivedays;
    url = url + "&dt=";
    for(var i=0; i<=4; i++){
        const response = await fetch(url + ts);
        var data = await response.json();
        console.log(data);
        ts += oneday;
        temp = 0;
        humid = 0;
        for(var j = 0; j < data.hourly.length; j++){
            temp += data.hourly[j].temp;
            humid += data.hourly[j].humidity;
            //console.log(data.hourly[j]['temp']);
            realMaxTemp = Math.max(realMaxTemp, data.hourly[j].temp);
            realMinTemp = Math.min(realMinTemp, data.hourly[j].temp);
            realMaxHumidity = Math.max(realMaxHumidity, data.hourly[j].humidity);
            realMinHumidity = Math.min(realMinHumidity, data.hourly[j].humidity);
        }
        temp /= data.hourly.length;
        humid /= data.hourly.length;
        tempsAvg.push(temp);
        humidityAvg.push(humid);
    }
}

async function getCurrentData(url){
    const response = await fetch(url);
    var data = await response.json();
    for(var i = 0; i < data.daily.length; i++){
        temp = (data.daily[i].temp.day + data.daily[i].temp.eve + data.daily[i].temp.morn + data.daily[i].temp.night) / 4;
        tempsAvg.push(temp);
        humidityAvg.push(data.daily[i].humidity);
        //console.log(data.daily[i].temp.min);
        realMaxTemp = Math.max(realMaxTemp,  data.daily[i].temp.max);
        realMinTemp = Math.min(realMinTemp, data.daily[i].temp.min);
        realMaxHumidity = Math.max(realMaxHumidity, data.daily[i].humidity);
        realMinHumidity = Math.min(realMinHumidity, data.daily[i].humidity);
    }
}

//var lat = <?php echo json_encode($_POST['latitude'] ?? 47.63333) ?>;
//var long = <?php echo json_encode($_POST['longitude'] ?? 26.25) ?>;
//var dictionary = <?php echo json_encode($dictArray); ?>;
//var isPost = <?php echo $isPostPHP; ?>;