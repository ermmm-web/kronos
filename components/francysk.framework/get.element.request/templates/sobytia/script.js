function initMap() {
    
    var offices_list = [
        {
            address: $('#jsConfig').attr("data-street"),
            coord: $("#jsConfig").attr("data-coord").split(",")
        }
    ];
    
    var map = new ymaps.Map('mapEvent', {
        center: [53.55, 27.33],
        zoom: 12,
        behaviors: ['default', 'scrollZoom'],
        controls: []
    });
    var myCollection = new ymaps.GeoObjectCollection();
    for (var i = 0; i < offices_list.length; ++i) {
        var placemark = new ymaps.Placemark(offices_list[i].coord, {},
                {
                    iconLayout: "default#image",
                    iconImageHref: '/local/frontend/build/images/icon-map.png',
                    iconImageSize: [32, 46]
                }
        );
        myCollection.add(placemark);
    }
    map.geoObjects.add(myCollection);
    var centerAndZoom = ymaps.util.bounds.getCenterAndZoom(
            myCollection.getBounds(),
            map.container.getSize(),
            map.options.get('projection')
            );
    map.setCenter([centerAndZoom.center[0], centerAndZoom.center[1]], 12);
}

ymaps.ready(initMap);