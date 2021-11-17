export class Weather{

    //Es un metodo para la clase. este metodo se ejecuta apenas la clase es instanciada o creada
    constructor(city,countryCode){
        this.apikey = 'b5fab78a198e7e1c01ab85640679067a';
        this.city = city;
        this.countryCode = countryCode;
    }
     async getWeather(){
        
        const URI = `https://api.openweathermap.org/data/2.5/weather?q=${this.city},
        ${this.countryCode}&appid=${this.apikey}&units=metric`;
        //Permite hacer peticiones
        //await: le estamos diciendo que tomara tiempo en poder obtener los datos, y para que funcione se trabaja con nla funcion async
        const response = await fetch(URI);
        const data = await response.json();
        return data;
    }

    changeLocation(city, countryCode){
        this.city = city;
        this.countryCode = countryCode;
    }
}