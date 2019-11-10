function f2()
{
  navigator.geolocation.getCurrentPosition(success,error);

    function success(pos)
    {
      var lat = pos.coords.latitude;
      var long = pos.coords.longitude;
      weather(lat,long);
    }

    function error()
    {
      toastr["error"]("Both data are required!");
    }

    function weather(lat,long) 
    {
        var url = `https://fcc-weather-api.glitch.me/api/current?lat=${lat}&lon=${long}`;
        $.getJSON(url, function(data) {
            f2(data);
        });
    }

    function f2(data) 
    {
        var city = data.name;
        var temp = Math.round(data.main.temp_max);
        var desc = data.weather[0].description;
        var src = data.weather[0].icon;

        $('#city').html(city);
        $('#temp').html(temp);
        $('#desc').html(desc);
        $('#icon').attr('src',src);
    }
}
