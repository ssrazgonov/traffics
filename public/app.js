makeVisible(currentTrafficLightId);
ymaps.ready(function() {

	let myMap = new ymaps.Map("map", {
        center: [52.599504, 39.632270],
        zoom: 12
    });

    for (traffic in traffics) {

    	let preset = traffics[traffic].status == 'working' ? "islands#greenIcon" : "islands#redIcon";

	    var myPlacemark = new ymaps.Placemark([traffics[traffic].latitude, traffics[traffic].longitude],
	    {
    		hintContent: traffics[traffic].id,
            balloonContent: traffics[traffic].address,
            id: traffics[traffic].id
	    },
	    {
		    preset: preset,
		});

        myPlacemark.events.add('click', selectTrafficLight);


		myMap.geoObjects.add(myPlacemark);
    }


});

function selectTrafficLight(event)
{
    let trafficLightPoint = event.get('target');
    let fieldSet = document.getElementById('main-form');
    let hint = document.getElementById('hint');
    let hintSelected = document.getElementById('hint-selected');
    let formTrafficLightId = document.getElementById('form-traffic-light-id');

    fieldSet.disabled = false;
    hint.hidden = true;

    let address = trafficLightPoint.properties._data.balloonContent;

    hintSelected.innerHTML = 'Выбран светофор: ' + address;
    hintSelected.hidden = false;

    currentTrafficLightId = trafficLightPoint.properties._data.id;

    formTrafficLightId.value = currentTrafficLightId;
}

function makeVisible(id) {
    let fieldSet = document.getElementById('main-form');
    let hint = document.getElementById('hint');
    let hintSelected = document.getElementById('hint-selected');
    let formTrafficLightId = document.getElementById('form-traffic-light-id');

    let currentTraffic = traffics.filter(function (item) {
        return item.id === id;
    });

    console.log(currentTraffic);

    if (!currentTraffic.length) {
        return;
    }

    currentTraffic = currentTraffic[0];


    fieldSet.disabled = false;
    hint.hidden = true;

    let address = currentTraffic.address;

    hintSelected.innerHTML = 'Выбран светофор: ' + address;
    hintSelected.hidden = false;

    formTrafficLightId.value = currentTrafficLightId;
}


