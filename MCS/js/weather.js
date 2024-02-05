const APIKEY = '80c6df2396bdae543220371a1b167d93';
const api = `https://api.openweathermap.org/data/2.5/weather?q=Manassas,us&APPID=${APIKEY}`;
const weather = {};
const KELVIN = 273;

weather.temperature = {
  unit: 'celsius'
}

function getWeather(){
    fetch(api)
        .then(function(response){
            let data = response.json();
            return data;
        })
        .then(function(data){
            weather.temperature.value = Math.floor(data.main.temp - KELVIN);
            weather.temperature.value = Math.floor(((weather.temperature.value * (9/5)) + 32));
            weather.description = data.weather[0].description;
            weather.iconId = data.weather[0].icon;
            weather.city = data.name;
            weather.country = data.sys.country;
        })
        .then(function(){
            Display();
        });
}

function Display(){
  $(".weather-image").attr("src", `library/icons/${weather.iconId}.png`);
  $(".temp").text(`${weather.temperature.value}℉`);
}
getWeather();
