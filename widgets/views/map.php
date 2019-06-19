<?php

use app\models\Show;
use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\layers\BicyclingLayer;
use dosamigos\google\maps\Map;
use dosamigos\google\maps\overlays\InfoWindow;
use dosamigos\google\maps\overlays\Marker;
use dosamigos\google\maps\overlays\PolylineOptions;
use dosamigos\google\maps\services\DirectionsRenderer;


/** @var $model Show */
$coords = $model->location;
$latitude = $coords && array_key_exists('latitude', $coords) ? $coords['latitude'] : 39.720089311812094;
$longitude = $coords && array_key_exists('longitude', $coords) ? $coords['longitude'] : 2.91165944519042;
?>
<?php $cord = new LatLng(['lat' => $latitude, 'lng' => $longitude]);

$map = new Map([
    'center' => $cord,
    'zoom' => 16,
]);

// Lets configure the polyline that renders the direction
$polylineOptions = new PolylineOptions([
    'strokeColor' => '#FFAA00',
    'draggable' => true
]);

// Now the renderer
$directionsRenderer = new DirectionsRenderer([
    'map' => $map->getName(),
    'polylineOptions' => $polylineOptions
]);

// Lets add a marker now
$marker = new Marker([
    'position' => $cord,
    'title' => $model->title,
]);

// Provide a shared InfoWindow to the marker
$marker->attachInfoWindow(
    new InfoWindow([
        'content' => "<p>$model->address</p>"
    ])
);

// Add marker to the map
$map->addOverlay($marker);

$bikeLayer = new BicyclingLayer(['map' => $map->getName()]);

$map->appendScript($bikeLayer->getJs());

echo $map->display();?>
