

let map = ymaps.ready(function() {

	let myMap = new ymaps.Map("map", {
        center: [52.599504, 39.632270],
        zoom: 12
    });

    for (traffic in traffics) {

    	let preset = traffics[traffic].status == 'working' ? "islands#greenIcon" : "islands#redIcon";

	    var myPlacemark = new ymaps.Placemark([traffics[traffic].location_x, traffics[traffic].location_y],
	    {
    		hintContent: traffics[traffic].id,
            balloonContent: traffics[traffic].address
	    },
	    {
		    preset: preset,
		});


		myMap.geoObjects.add(myPlacemark);
    }


});



