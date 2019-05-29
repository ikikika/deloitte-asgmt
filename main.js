import 'ol/ol.css';
import {fromLonLat} from 'ol/proj';
import {Map, View} from 'ol';
import {Vector as VectorLayer, Tile as TileLayer} from 'ol/layer';
import XYZSource from 'ol/source/XYZ';
import {Vector as VectorSource} from 'ol/source';
import Feature from 'ol/Feature';
import Point from 'ol/geom/Point';
import {transform} from 'ol/proj.js';

const source = new VectorSource();

const client = new XMLHttpRequest();
client.open('GET', 'data/power1.csv');
client.onload = function() {
  const csv = client.responseText;
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

    features.push(
      new Feature({
        name: parseFloat(line[0]) || 0,
        // year: parseInt(line[2]) || 0,
        geometry: new Point(coords)
      })
    );
  }
  source.addFeatures(features);
};
client.send();

new Map({
  target: 'map-container',
  layers: [
    new TileLayer({
      source: new XYZSource({
        url: 'http://tile.stamen.com/terrain/{z}/{x}/{y}.jpg'
      })
    }),
    new VectorLayer({
      source: source
    })
  ],
  view: new View({
    center: transform([103.8, 1.6], 'EPSG:4326', 'EPSG:3857'),
    zoom: 11
  })
});
