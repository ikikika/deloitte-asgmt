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

import Chart from 'chart.js';
import 'chartjs-plugin-zoom';

const sourcePowerStations = new VectorSource();
const renderPowerStations = new XMLHttpRequest();
renderPowerStations.open(
  'GET',
  'http://mapapi.jitooi.com/api/power_station/all'
);
renderPowerStations.onload = function() {
  const powerStations = JSON.parse(renderPowerStations.responseText).data;
  const features = [];
  powerStations.map(powerStn => {
    const coords = fromLonLat([
      parseFloat(powerStn.longitude),
      parseFloat(powerStn.latitude)
    ]);
    const iconFeature = new Feature({
      name: powerStn.name + ' (ID: ' + powerStn.id + ')',
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
  });
  sourcePowerStations.addFeatures(features);
};
renderPowerStations.send();

const sourceChargePoints = new VectorSource();
const renderChargePoints = new XMLHttpRequest();
renderChargePoints.open(
  'GET',
  'http://mapapi.jitooi.com/api/charging_station/all'
);
renderChargePoints.onload = function() {
  const chargePoints = JSON.parse(renderChargePoints.responseText).data;
  const features = [];
  chargePoints.map(chargePt => {
    const coords = fromLonLat([
      parseFloat(chargePt.longitude),
      parseFloat(chargePt.latitude)
    ]);
    const iconFeature = new Feature({
      name: chargePt.name,
      geometry: new Point(coords),
      type: 'charge',
      nearest_ps_id: chargePt.nearest_ps_id,
      nearest_ps_coord:
        '(' + chargePt.nearest_ps_long + ', ' + chargePt.nearest_ps_lat + ')'
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
  sourceChargePoints.addFeatures(features);
};
renderChargePoints.send();

const layerPowerStations = new VectorLayer({
  source: sourcePowerStations
});
const layerChargePoints = new VectorLayer({
  source: sourceChargePoints
});

// Elements that make up the popup.
const container = document.getElementById('popup');
const title = document.getElementById('popup-title');
const content = document.getElementById('popup-content');
const chartdiv = document.getElementById('popup-chart');
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
  generate_chart();
  if (type == 'charge') {
    const coord = features[0].getGeometry().getCoordinates();
    title.innerHTML =
      '<h4>Charging Station: ' + features[0].values_.name + '</h4>';
    chartdiv.style.display = 'block';
    content.innerHTML =
      '<p>Nearest Power Station at: ' +
      features[0].values_.nearest_ps_coord +
      '<br/>(ID: ' +
      features[0].values_.nearest_ps_id +
      ')</p>';
    overlay.setPosition(coord);
  } else if (type == 'grid') {
    const coord = features[0].getGeometry().getCoordinates();
    title.innerHTML = '<h4>' + features[0].values_.name + '</h4>';
    chartdiv.style.display = 'none';
    content.innerHTML = '';
    overlay.setPosition(coord);
  }
});
//generate_chart();
function generate_chart() {
  // Start generate chart
  const ctx = document.getElementById('myChart');
  // eslint-disable-next-line no-unused-vars
  const myChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: ['0', '200', '400', '600', '800', '1000', '1200', '1400'],
      datasets: [
        {
          label: 'Estimated Electric Vehicle Charging Load',
          data: [
            number_2dp(Math.random()),
            number_2dp(Math.random()),
            number_2dp(Math.random()),
            number_2dp(Math.random()),
            number_2dp(Math.random()),
            number_2dp(Math.random()),
            number_2dp(Math.random()),
            number_2dp(Math.random())
          ],
          borderColor: 'rgb(255, 99, 132)'
        }
      ]
    },
    options: {
      scales: {
        yAxes: [
          {
            scaleLabel: {
              display: true,
              labelString: 'Watt'
            }
          }
        ]
      },
      pan: {
        enabled: true,
        mode: 'xy'
      },
      zoom: {
        enabled: true,
        mode: 'xy'
      },
      tooltips: {
        callbacks: {
          label: function(tooltipItem, data) {
            return tooltipItem.yLabel;
          }
        }
      }
    }
  });
  // End generate chart
}

function number_2dp(number) {
  return parseFloat(number * 1000).toFixed(2);
}
