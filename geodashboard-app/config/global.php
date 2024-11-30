<?php

return [
  "G_Layer_Config" => '{
    "source": {
      "id": "admin_state_boundary",
      "source": {
        "type": "vector",
        "minzoom": 3,
        "maxzoom": 18,
        "tiles": [
          "http://192.168.122.15:8000/mvt?x={x}&y={y}&z={z}&schema=india&table_slug=STATE_BOUNDARY&projection=3857&geom_column=geom&columns=state,shape_area,shape_leng,state_lgd"
        ]
      }
    },
    "layers": [
      {
        "style": {
          "id": "admin_state_boundary_fill",
          "type": "fill",
          "source": "admin_state_boundary",
          "source-layer": "default",
          "minzoom": 3,
          "maxzoom": 22,
          "layout": {
            "visibility": "none"
          },
          "paint": {
            "fill-color": "#87ffa1",
            "fill-opacity": [
              "case",
              [
                "boolean",
                [
                  "feature-state",
                  "hover"
                ],
                false
              ],
              1,
              0.7
            ]
          }
        }
      },
      {
        "style": {
          "id": "admin_state_boundary_line",
          "type": "line",
          "source": "admin_state_boundary",
          "source-layer": "default",
          "minzoom": 3,
          "maxzoom": 22,
          "layout": {
            "visibility": "visible"
          },
          "paint": {
            "line-opacity": 0.75,
            "line-width": 1,
            "line-color": "#0a40bf"
          }
        }
      },
      {
        "style": {
          "id": "admin_state_boundary_labels",
          "type": "symbol",
          "source": "admin_state_boundary",
          "source-layer": "default",
          "minzoom": 3,
          "maxzoom": 22,
          "layout": {
            "text-field": [
              "get",
              "state"
            ],
            "text-font": [
              "Open Sans Bold",
              "Arial Unicode MS Bold"
            ],
            "text-size": 12,
            "text-anchor": "center",
            "visibility": "visible"
          },
          "paint": {
            "text-color": "#000000",
            "text-halo-color": "#ffffff",
            "text-halo-width": 1.5,
            "text-halo-blur": 0.5
          }
        }
      }
    ],
    "onHover": {
      "enabled": true,
      "hoveredId": "id",
      "layers": [
        "admin_state_boundary_fill"
      ]
    },
    "toolTip": {
      "enabled": true,
      "type": "html",
      "content": "<p><b>State</b>: {{state}}</p><p><b>Area</b>: {{shape_area}}</p>"
    },
    "onClick": {
      "enabled": true,
      "type": "table",
      "content": null
    },
    "legend": {
      "title": "Particelle",
      "visible": true,
      "body": [
        {
          "symbol": {
            "type": "color",
            "value": "#87ffa1"
          },
          "label": "Other"
        }
      ]
    }
  }'
];
