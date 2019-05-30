import 'ol/ol.css';
import {fromLonLat} from 'ol/proj';
import {Map, View} from 'ol';
import {Vector as VectorLayer, Tile as TileLayer} from 'ol/layer';
import XYZSource from 'ol/source/XYZ';
import {Vector as VectorSource} from 'ol/source';
import Feature from 'ol/Feature';
import Point from 'ol/geom/Point';
import {transform} from 'ol/proj.js';

import Overlay from 'ol/Overlay';

import {Icon, Style} from 'ol/style';

const sourcePowerStations = new VectorSource();

const renderPowerStations = new XMLHttpRequest();
renderPowerStations.open('GET', 'data/power1.csv');
renderPowerStations.onload = function() {
  const csv = renderPowerStations.responseText;
  const features = [];
  let prevIndex = csv.indexOf('\n') + 1; // scan past the header line
  let curIndex;
  while ((curIndex = csv.indexOf('\n', prevIndex)) != -1) {
    const line = csv.substr(prevIndex, curIndex - prevIndex).split(',');
    prevIndex = curIndex + 1;
    const coords = fromLonLat([parseFloat(line[1]), parseFloat(line[2])]);
    if (isNaN(coords[0]) || isNaN(coords[1])) {
      // guard against bad data
      continue;
    }
    const iconFeature = new Feature({
      name: line[0] || 0,
      geometry: new Point(coords),
      type: 'grid'
    });
    const iconStyle = new Style({
      image: new Icon({
        anchor: [0.5, 0.5],
        anchorXUnits: 'fraction',
        anchorYUnits: 'fraction',
        src: 'data/markerRed.png',
        size: [47, 47],
        scale: 0.5
      })
    });
    iconFeature.setStyle(iconStyle);
    features.push(iconFeature);
  }
  sourcePowerStations.addFeatures(features);
};
renderPowerStations.send();

const sourceChargePoint = new VectorSource();
const renderChargePoints = new XMLHttpRequest();
renderChargePoints.responseType = 'json';
renderChargePoints.open('GET', 'data/chargepoints.json');
renderChargePoints.onload = function() {
  const json = renderChargePoints.response;
  const features = [];
  json.map(chargePt => {
    const coords = fromLonLat([
      parseFloat(chargePt.AddressInfo.Longitude),
      parseFloat(chargePt.AddressInfo.Latitude)
    ]);
    const iconFeature = new Feature({
      name: chargePt.AddressInfo.Title || 0,
      geometry: new Point(coords),
      type: 'charge'
    });
    const iconStyle = new Style({
      image: new Icon({
        anchor: [0.5, 0.5],
        anchorXUnits: 'fraction',
        anchorYUnits: 'fraction',
        src: 'data/markerYellow.png',
        size: [47, 47],
        scale: 0.5
      })
    });
    iconFeature.setStyle(iconStyle);
    features.push(iconFeature);
  });
  sourceChargePoint.addFeatures(features);
};
renderChargePoints.send();

const layerPowerStations = new VectorLayer({
  source: sourcePowerStations
});
const layerChargePoints = new VectorLayer({
  source: sourceChargePoint
});

// Elements that make up the popup.
const container = document.getElementById('popup');
const content = document.getElementById('popup-content');
const closer = document.getElementById('popup-closer');
const overlay = new Overlay({
  element: container,
  autoPan: true,
  autoPanAnimation: {
    duration: 250
  }
});
closer.onclick = function() {
  overlay.setPosition(undefined);
  closer.blur();
  return false;
};

const map = new Map({
  target: 'map-container',
  layers: [
    new TileLayer({
      source: new XYZSource({
        url: 'http://tile.stamen.com/terrain/{z}/{x}/{y}.jpg'
      })
    }),
    layerPowerStations,
    layerChargePoints
  ],
  overlays: [overlay],
  view: new View({
    center: transform([103.8, 1.6], 'EPSG:4326', 'EPSG:3857'),
    zoom: 11
  })
});

map.on('singleclick', function(evt) {
  const features = [];
  map.forEachFeatureAtPixel(evt.pixel, function(feature, layer) {
    features.push(feature);
  });

  const type = features[0] ? features[0].values_.type : null;

  if (type == 'charge') {
    const coord = features[0].getGeometry().getCoordinates();
    content.innerHTML = '<p>You clicked here</code>';
    overlay.setPosition(coord);
  }
});
