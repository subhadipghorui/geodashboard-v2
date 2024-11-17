import React, { useEffect, useRef } from 'react';
import mapboxgl from 'mapbox-gl';

import 'mapbox-gl/dist/mapbox-gl.css';

const MapboxExample = () => {
  const mapContainerRef = useRef();
  const mapRef = useRef(null);

  useEffect(() => {
    // TO MAKE THE MAP APPEAR YOU MUST
    // ADD YOUR ACCESS TOKEN FROM
    // https://account.mapbox.com
    mapboxgl.accessToken = 'pk.eyJ1Ijoic3ViaGFkaXBnaG9ydWkiLCJhIjoiY2xzem5zNGZkMG4xcjJybzVoeTJtMTExaSJ9.eD6JCnaHoU2mKpXiRnP3cg';


    mapRef.current = new mapboxgl.Map({
      container: mapContainerRef.current,
      style: 'mapbox://styles/mapbox/light-v11',
      zoom: 10,
      center: [-87.622088, 41.878781]
    });

    mapRef.current.on('load', () => {
      mapRef.current.addSource('mapillary', {
        type: 'vector',
        tiles: [
          'https://tiles.mapillary.com/maps/vtp/mly1_public/2/{z}/{x}/{y}?access_token=MLY|4142433049200173|72206abe5035850d6743b23a49c41333'
        ],
        minzoom: 6,
        maxzoom: 14
      });
      mapRef.current.addLayer(
        {
          id: 'mapillary',
          type: 'line',
          source: 'mapillary',
          'source-layer': 'sequence',
          layout: {
            'line-cap': 'round',
            'line-join': 'round'
          },
          paint: {
            'line-opacity': 0.6,
            'line-color': 'rgb(53, 175, 109)',
            'line-width': 2
          }
        },
        'road-label-simple'
      );
    });

    mapRef.current.addControl(new mapboxgl.NavigationControl());

    return () => {
      if (mapRef.current) {
        mapRef.current.remove();
      }
    }
  }, []);

  return <div id="map" ref={mapContainerRef} style={{ height: '60vh', width: '100%'}} />;
};

export default MapboxExample;