export class UI{
    constructor(){
        this.location = document.getElementById('weather-location');
        this.description = document.getElementById('weather-description');
        this.string = document.getElementById('weather-string');
        this.humidity = document.getElementById('weather-humidity');
        this.wind = document.getElementById('weather-wind');
        this.tempmin = document.getElementById('weather-tempmin');
        this.tempmax = document.getElementById('weather-tempmax');
    }
    
    render(weather){
        this.location.textContent = weather.name + '/' + weather.sys.country;
        this.description.textContent = weather.weather[0]['description'];
        this.string.textContent = weather.main.temp + '°C';
        this.humidity.textContent = 'Humedad:'+ '/' + weather.main.humidity+'%';
        this.wind.textContent = 'Viento:' +'/'+ weather.wind.speed + 'm/s';
        this.tempmin.textContent = 'Temperatura min: '+weather.main.temp_min + ' C°';
        this.tempmax.textContent = 'Temperatura max: '+weather.main.temp_max + ' C°';
}
}