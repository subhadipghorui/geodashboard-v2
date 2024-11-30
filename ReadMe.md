# API Documentation

## 1. Overview

This is remake project inspired by <a href="https://github.com/piergiorgio-roveda/geodashboard-demo">piergiorgio-roveda/geodashboard-demo</a>, build by Piergiorgio Roveda. We started working on the Geodashboard-V2 project. Our main objective was to create eash application to share maps with custom layer configration, which can be configured from backend admin panel. So user do not need to touch database or re deploy the code every time they want to add layers to there maps.

## 2. Whats new in V2?

In V2 we build a user frindly admin panel with open source technology laravel php and filament admin panel to create a user fiendly UI to add layers and publish maps with layers.

- Users - Manage your organization users
- Layers - add layer configrations in json format
- Maps - add layers to the map and publish so that people can use it
- Reverse Proxy - We have also provide a `/tomcat-proxy` api access geoserver api without CORS issue. Add reverse proxy url in .env file `TOMCAT_APP_URL`
- MVT Layer API - if you have postgres database and spatial layers, then add in `DB_GIS_CONNECTION` and access the layers though `/mvt` api only.

## 2.2 Spatial Layer Database

Currently we are supporting only one data, which can be configured in the .env file.

```
DB_GIS_CONNECTION=sg_geoserver
DB_GIS_HOST=127.0.0.1
DB_GIS_PORT=5432
DB_GIS_DATABASE=geoserver_db
DB_GIS_USERNAME=root
DB_GIS_PASSWORD=root
```

---

## 3. Layers Config

Provide layer config as JSON format (Now only support mapbox).

```
{
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
}

```

---

### 3.1 source (*Required)

Map box Source with layer url

- **id**: layer source id `admin_state_boundary`
- **source**: mapbox layer source config

```
{
    "type": "vector",
    "minzoom": 3,
    "maxzoom": 18,
    "tiles": [
    "http://192.168.122.15:8000/mvt?x={x}&y={y}&z={z}&schema=india&table_slug=STATE_BOUNDARY&projection=3857&geom_column=geom&columns=state,shape_area,shape_leng,state_lgd"
    ]
}
```

### 3.2 layers (*Required)

 We can add multiple layer with different styles use the same source `admin_state_boundary`.

```

    [
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
    }
    ]

```

### 3.2.1 *style (ex. mapbox style configs)

- ***id**: layer source id `admin_state_boundary_fill`
- ***source**: mapbox layer source config
- ***layout**: `{"visibility": "none"}` this required for visbility changed


## 3.2.2 legend (Optional)

Define a JSON config for legend

```
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

```

## 3.2.3 onHover (Optional)

Define map iteraction. 

- **enabled**: feature enabled or not. `true or false`.
- **hoveredId**: hover feature primary key. default `id`.
- **layers**: array of layers or styles names. (hover style should be preconfigured in layer style config, like change opacity or fill color )

```
  "onHover": {
    "enabled": true,
    "hoveredId": "id",
    "layers": [
      "campobasso_zone_fill"
    ]
  }
```

## 3.2.4 toolTip (Optional)

Define on hover if there is a tool-tip open. 

- **enabled**: feature enabled or not. `true or false`.
- **type**: `html`.
- **content**: provide html format. `{{STATE_ID}}` feature property key, which is present in layer property

```
  "toolTip": {
    "enabled": true,
    "type": "html",
    "content": "<p><b>STATE_ID</b>: {{STATE_ID}}</p><p><b>STATE_NAME</b>: {{STATE_NAME}}</p>"
  }
```

## 3.2.5 onClick (Optional)

Define on click of feature interactions. 

- **enabled**: feature enabled or not. `true or false`.
- **type**: `table`.(comming soon `html`)
- **content**: if type is html the provide html format else nullable. 

```
  "onClick": {
    "enabled": true,
    "type": "table",
    "content": null
  }
```

---

## 4. MVT API Overview

The `/mvt` API generates Mapbox Vector Tiles (MVT) from spatial data stored in a database. The endpoint supports customization of parameters such as tile coordinates, schema, table slug, geometry column, and additional attributes to tailor the data served.

## Endpoint

**URL:**  
`https://example.com/mvt`

**Method:**  
`GET`

---

## Query Parameters

### Required Parameters

| Parameter | Type    | Description                   | Default Value |
| --------- | ------- | ----------------------------- | ------------- |
| `x`       | integer | The X-coordinate of the tile. | `0`           |
| `y`       | integer | The Y-coordinate of the tile. | `0`           |
| `z`       | integer | The zoom level of the tile.   | `0`           |

### Optional Parameters

| Parameter           | Type    | Description                                                               | Default Value | Example                                 |
| ------------------- | ------- | ------------------------------------------------------------------------- | ------------- | --------------------------------------- |
| `table_slug`        | string  | The database table from which the spatial data will be retrieved.         | `"demo"`      | `Administrative%20STATE_BOUNDARY`       |
| `schema`            | string  | The database schema containing the table.                                 | `"public"`    | `india`                                 |
| `projection`        | string  | The spatial reference system (SRID) used for the geometry.                | `"3857"`      | `3857`                                  |
| `geom_column`       | string  | The column containing geometry data in the table.                         | `"geom"`      | `geom`                                  |
| `pixel_size`        | integer | The pixel size of the tile in the generated MVT.                          | `4096`        | `4096`                                  |
| `source_layer`      | string  | The source layer name in the MVT.                                         | `"default"`   | `state_layer`                           |
| `max_feature_count` | integer | The maximum number of features included in the tile.                      | `100000`      | `50000`                                 |
| `columns`           | string  | Comma-separated list of column names to include as attributes in the MVT. | `""` (empty)  | `state,shape_area,shape_leng,state_lgd` |

## Validation

- **`columns` Validation:**
  - The `columns` parameter is validated using the pattern:  
    `^[a-zA-Z0-9_]+(?:,[a-zA-Z0-9_]+)*$`
  - If the `columns` value fails validation, the API returns:  
    **HTTP Status:** `400 Bad Request`  
    **Response Body:** `{"message": "Invalid columns"}`

---

## Example Request

### Request URL

```plaintext
https://example.com/mvt?x=23&y=14&z=5&schema=india&table_slug=Administrative%20STATE_BOUNDARY&projection=3857&columns=state,shape_area,shape_leng,state_lgd
```
