

let map = ymaps.ready(function() {

	let myMap = new ymaps.Map("map", {
        center: [52.599504, 39.632270],
        zoom: 12
    });

    for (traffic in traffics) {

    	console.log(traffic);

    	let preset = traffics[traffic].isWork ? "islands#greenIcon" : "islands#redIcon";

	    var myPlacemark = new ymaps.Placemark([traffics[traffic].y, traffics[traffic].x], 
	    {
    		hintContent: traffics[traffic].id,
            balloonContent: traffics[traffic].name
	    },
	    {
		    preset: preset,
		});


		myMap.geoObjects.add(myPlacemark); 
    }


});



