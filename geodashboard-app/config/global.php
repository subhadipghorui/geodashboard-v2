<?php

return [
    "G_Layer_Config" => '{
  "source": {
    "id": "mapillary",
    "source": {
      "type": "vector",
      "tiles": [
        "https://tiles.mapillary.com/maps/vtp/mly1_public/2/{z}/{x}/{y}?access_token=MLY|4142433049200173|72206abe5035850d6743b23a49c41333"
      ],
      "minzoom": 6,
      "maxzoom": 14
    }
  },
  "layers": [
    {
      "style": {
        "id": "mapillary",
        "type": "line",
        "source": "mapillary",
        "source-layer": "sequence",
        "layout": {
          "visibility": "visible",
          "line-cap": "round",
          "line-join": "round"
        },
        "paint": {
          "line-opacity": 0.6,
          "line-color": "rgb(53, 175, 109)",
          "line-width": 2
        }
      }
    }
  ]
}'
];
