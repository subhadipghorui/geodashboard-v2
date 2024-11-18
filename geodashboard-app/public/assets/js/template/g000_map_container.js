/***************************************************
 *              Map Map Canvus
 *
 * appConfig - Globa State
 * map - Main map global object. Can be accessbale
 * from any tools modules
 *
 ****************************************************/
const appConfig = {};

const map_slug = window.location.pathname.split("/").slice(-1)[0];

const MAPBOX_TOKEN =
    "pk.eyJ1Ijoic3ViaGFkaXBnaG9ydWkiLCJhIjoiY2xzem5zNGZkMG4xcjJybzVoeTJtMTExaSJ9.eD6JCnaHoU2mKpXiRnP3cg";
mapboxgl.accessToken = MAPBOX_TOKEN;


appConfig.mapObj = new mapboxgl.Map({
    "container": "map",
    "style": "mapbox://styles/mapbox/light-v11",
    "zoom": 10,
    "center": [
      -87.622088,
      41.878781
    ],
    "pitch": 0,
    "bearing": 0,
    "projection": "mercator"
  });

// Fetch All Layers
const fetchMapConfig = async () => {
    try {
        // Make an asynchronous GET request
        const { data } = await axios.get(`/maps/${map_slug}`, {
            headers: {
                "X-CSRF-TOKEN": document.head.querySelector(
                    'meta[name="csrf-token"]'
                ).content,
            },
        });
        return data.data;
    } catch (error) {
        // Handle errors
        console.error("Error fetching data:", error.message);
    }
};

// Reset Map
const resetMapCenter = () => {
    appConfig.mapObj.setCenter(appConfig.mapConfig.g_meta.map.center ?? [0,0]);
    appConfig.mapObj.setZoom(appConfig.mapConfig.g_meta.map.zoom ?? 5);
};

// Handle one menu
const handleMapLayersPanel = () => {
    $("#map_layers_panel").toggle("slide", { direction: "left" }, 400);
    $("#map").toggleClass("map-layer-menu-margin");
};


const initMap = async () => {
    const mapConfigData = await fetchMapConfig();

    appConfig.mapConfig = mapConfigData;
    appConfig.layersArray = [];
    appConfig.mapConfig.g_layers.forEach((ele, i) => appConfig.layersArray.push(ele));

    appConfig.mapObj.setCenter(appConfig.mapConfig.g_meta.map.center ?? [0,0])
    appConfig.mapObj.setZoom(appConfig.mapConfig.g_meta.map.zoom ?? 5);
    map.setProjection(appConfig.mapConfig.g_meta.map.projection ?? "mercator");
    map.setPitch(appConfig.mapConfig.g_meta.map.pitch ?? 0);
    map.setBearing(appConfig.mapConfig.g_meta.map.bearing ?? 0);

    // Disable map rotation using right click + drag
    appConfig.mapObj.dragRotate.disable();

    // Disable map rotation using touch rotation gesture
    appConfig.mapObj.touchZoomRotate.disableRotation();

    appConfig.mapObj.addControl(
        new mapboxgl.ScaleControl({
            maxWidth: 80,
            unit: "meter",
        })
    );
    appConfig.mapObj.addControl(
        new mapboxgl.NavigationControl(),
        "bottom-right"
    );

    resetMapCenter();
    
};


initMap();