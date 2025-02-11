/***************************************************
 *              Layer Panel Tool
 *
 * Global Variable Object:-
 *
 * appConfig - Global Scope
 *
 ****************************************************/

/***************************************************
 * Functions:-
 *
 * fetchMapConfig() - Fetch All Layer and return layer array
 * loadLayerList(layersArray[]) - Creat the layer list items
 * addAllLayersToMap(layersArray[]) - Add all the fetch layers data to Map object
 * addOnClickPopup(layersArray[])
 * addOnHoverToolTip(layersArray[])
 * initMap() -  fetch layers and added to map
 *
 ****************************************************/

// Generate legend
const renderLegend = (legendConfig) => {
    let legendHtml = "";
    if (legendConfig) {
        legendHtml = `<div class="legend"><p>Legend</p>`;
        legendConfig.body.forEach((e) => {
            legendHtml += `<div class="l_item d-flex mb-2">`;
            if (e.symbol.type == "color") {
                legendHtml += `<div style="background-color:${e.symbol.value};width: 24px; height:24px;  margin-right: 16px;"></div>`;
            } else {
                legendHtml += `<div style="margin-right: 16px;"><img src="${e.symbol.value}" alt="${e.label}" width="24px"/></div>`;
            }
            legendHtml += `<div>${e.label}</div>`;
            legendHtml += `</div>`;
        });
        legendHtml += `</div>`;
    }

    return legendHtml;
};

// Seach Attribute in layer
let searchCall;
function seachInLayer(ele) {
    clearTimeout(searchCall);
    searchCall = setTimeout(async () => {
        const params = new URLSearchParams({
            q: ele.value,
            table_slug: ele.attributes["searchTable"].value,
            schema: ele.attributes["searchSchema"].value,
            columns: ele.attributes["searchColumns"].value,
            columns: ele.attributes["searchColumns"].value,
            zoom: ele.attributes["searchZoom"].value,
        });

        const resData = await fetch(
            `${ele.attributes["searchApi"].value}?${params.toString()}`
        )
            .then((res) => res.json())
            .catch((err) => err);

        if (ele.value !== "" && !resData.error) {
            $(`#${ele.attributes["searchResultDiv"].value}`).show();
            // console.log(resData.data);
            let searchResult = "";
            resData.data?.search.forEach((e) => {
                searchResult += ` <li class="dropdown-item text-wrap-search" onclick=" appConfig.mapObj.flyTo({center: [${
                    e.lng
                }, ${e.lat}], zoom: ${e.zoom},});">${
                    e[ele.attributes["searchLabel"].value]
                }</li>`;
            });

            $(`#${ele.attributes["searchResultDiv"].value}`).html(searchResult);
        } else {
            $(`#${ele.attributes["searchResultDiv"].value}`).html("");
            $(`#${ele.attributes["searchResultDiv"].value}`).hide();
        }
    }, 1000);
}
// Create HTML Layer List Items
const loadLayerList = (layersArray = []) => {
    $("#layerList").html(null);
    let layerListHtml = "";
    layersArray.forEach((layerGrp, i, arrGrp) => {
        layerListHtml += `
            <label for="base_layer" class="form-label">${layerGrp.group_name}</label>
            <div class="accordion accordion-flush">
            `;
        layerGrp.layers.forEach((layer, i, arr) => {
            const legendConfig = layer.g_layer_config.legend ?? null;
            const legendHtml = renderLegend(legendConfig);
            const searchConfig = layer.g_style?.search ?? null;

            // layer status
            const visibility = layer.checked ? "checked" : "";
            layerListHtml += `
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-${layer.g_slug}">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#${layer.g_slug}" aria-expanded="false"
                        aria-controls="${layer.g_slug}">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="${layer.g_slug}" id="toggle_${layer.g_slug}" value="${layer.g_layer_config.source.id}"
                                onchange="handleLayerVisibility(this.value)" ${visibility}>
                            <label for="${layer.g_slug}">
                                ${layer.g_label}
                            </label>
                        </div>
                    </button>
                </h2>
                <div id="${layer.g_slug}" class="accordion-collapse collapse"
                    aria-labelledby="flush-${layer.g_slug}">
                    <div class="accordion-body">
                        <div class="row mb-3">
                            <div class="list-group" id="list-tab" role="tablist">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                    <a class="nav-link active" role="tab" id="list-legend-${layer.g_slug}-list" data-bs-toggle="list" href="#list-legend-${layer.g_slug}" role="tab" aria-controls="list-legend-${layer.g_slug}">Legend</a>
                                    </li>
                                    <li class="nav-item">
                                    <a class="nav-link" role="tab" id="list-search-${layer.g_slug}-list" data-bs-toggle="list" href="#list-search-${layer.g_slug}" role="tab" aria-controls="list-search-${layer.g_slug}">Search</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="row">
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="list-legend-${layer.g_slug}" role="tabpanel" aria-labelledby="list-legend-${layer.g_slug}-list">${legendHtml}</div>
                                <div class="tab-pane fade" id="list-search-${layer.g_slug}" role="tabpanel" aria-labelledby="list-search-${layer.g_slug}-list">
                                    <div class="row px-0">
                                        <input class="form-control form-control" type="search" placeholder="Search by attribute..." searchSchema="${searchConfig?.schema}" searchTable="${searchConfig?.table_slug}" searchApi="${searchConfig?.search_api}" searchColumns="${searchConfig?.columns}" onkeydown="seachInLayer(this)"  onsearch="seachInLayer(this)" searchResultDiv="${layer.g_slug}-search-result" searchLabel="${searchConfig?.label}" searchZoom="${searchConfig?.zoom}">
                                        <div class="px-0">
                                            <ul id="${layer.g_slug}-search-result" class="dropdown-menu w-75">
                                                
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    `;
        });
        layerListHtml += `</div></div>`;
    });
    $("#layerList").append(layerListHtml);
};

// Create HTML Base Map List Items
const loadBaseMapList = (baseMapListArray = [], defaultMap) => {
    $("#base_map").html(null);
    let htmlEle = ` <select class="form-select" aria-label="Default select example"
    onchange="handleChangeBaseMap(this.value)">`;
    Object.keys(baseMapListArray).forEach((map, i, arr) => {
        htmlEle += `<option value="${baseMapListArray[map]}">${map}</option>`;
    });
    htmlEle += ` </select>`;
    $("#base_map").append(htmlEle);
};

// Load all the layers to mapbox object
const addAllLayersToMap = async (layersArray = []) => {
    let mapSources = appConfig.mapObj.getStyle().sources;
    if (
        !Object.keys(mapSources).filter((el, i, arr) => el === "composite")
            .length > 0
    ) {
        setTimeout(() => {
            addAllLayersToMap();
        }, 200);
        return;
    }

    let mapSourcesArray = [];
    let mapLayersArray = [];
    Object.keys(appConfig.mapObj.getStyle().sources).forEach((ele) => {
        mapSourcesArray.push(ele);
    });
    appConfig.mapObj.getStyle().layers.forEach((ele) => {
        mapLayersArray.push(ele.id);
    });

    // console.log(mapSourcesArray);
    // console.log(layersArray);
    // Custom MVT layers.
    layersArray.forEach((layer, i, arr) => {
        if (!mapSourcesArray.includes(layer.g_slug)) {
            layer.layers.forEach((lyr) => {
                // Add Source
                if (!mapSourcesArray.includes(lyr.g_layer_config.source.id)) {
                    appConfig.mapObj.addSource(
                        lyr.g_layer_config.source.id,
                        lyr.g_layer_config.source.source
                    );
                }
                // Add Layers Style
                lyr.g_layer_config.layers.forEach((ele) => {
                    if (!mapLayersArray.includes(ele.style.id)) {
                        ele.style.layout.visibility = lyr.checked ? 'visible' : 'none';
                        appConfig.mapObj.addLayer(ele.style);
                    }
                });
            });

            return Promise.resolve(true);
        }
    });
};

// // Add onclick popup on layers
const addOnClickPopup = (layersArray = []) => {
    // const mapLayersSourceIdArray = layersArray.map((e) => e.g_slug);
    const mapLayersSourceIdArray = [];
    layersArray.forEach((lyrGrp) => {
        lyrGrp.layers.forEach((lyr) =>
            lyr.g_layer_config?.onClick?.enabled == true
                ? mapLayersSourceIdArray.push(lyr.g_layer_config.source.id)
                : null
        );
    });

    const mapLayersStylesIdArray = appConfig.mapObj
        .getStyle()
        .layers.filter((e) => mapLayersSourceIdArray.includes(e.source))
        .map((e) => e.id);

    appConfig.mapObj.on("click", (e) => {
        const features = appConfig.mapObj.queryRenderedFeatures(e.point);
        // console.log(features);

        // Unique Events by source
        let uniqueStyleObj = new Map();
        features.forEach((obj) => uniqueStyleObj.set(obj.source, obj));
        let uniqueEventFeatures = Array.from(uniqueStyleObj.values());
        // Popup HTML
        let tempLayerFeatureList = [];

        $("#popup-modal-content").html("");

        uniqueEventFeatures.forEach((feature) => {
            if (!mapLayersStylesIdArray.includes(feature.layer.id)) {
                // Skip processing this feature and continue with the next iteration
                return;
            }
            if (!tempLayerFeatureList.includes(feature.layer.id)) {
                // Push to temp layer feature list
                tempLayerFeatureList.push(feature.layer.id);

                // Add layer title
                let popup_html = `<div class="my-2"><h4>${feature.layer.id}</h4></div>`;

                // Create table
                // Create header element
                let attributesTableHeader = `<tr><th scope="col">Attribute</th><th scope="col">Value</th></tr>`;
                popup_html += `<div class="table-responsive"  class="mb-3""><table class="table table-striped table-bordered"><thead class="thead-dark">${attributesTableHeader}</thead><tbody id="popup-modal-table-${feature.layer.id}"></tbody></table></div>`;

                // Mount table
                $("#popup-modal-content").append(popup_html);
            }

            // Append rows in the tbody
            let attributesVlaues = feature.properties;
            let attributesTableBody = "";
            Object.keys(attributesVlaues).forEach((key) => {
                attributesTableBody += `<tr>`;
                if (!key.includes('geom'))
                    attributesTableBody += `<td>${key}</td><td>${attributesVlaues[key]}</td>`;
                attributesTableBody += `</tr>`;
            });

            $(`#popup-modal-table-${feature.layer.id}`).append(
                attributesTableBody
            );

            $("#popup-modal").modal("toggle");
        });
    });
};

// // Add hover popup
let hoveredPolygonId = null;
const addOnHoverToolTip = (layersArray = []) => {
    const mapLayersArray = [];
    layersArray.forEach((lyrGrp) => {
        lyrGrp.layers.forEach((lyr) =>
            lyr.g_layer_config?.onHover?.enabled == true
                ? mapLayersArray.push(lyr)
                : null
        );
    });
    // Create a popup, but don't add it to the map yet.
    const popup = new mapboxgl.Popup({
        closeButton: false,
        closeOnClick: false,
    });
    mapLayersArray.forEach((lyr) => {
        const layerStyles = appConfig.mapObj
            .getStyle()
            .layers.filter((e) => e.source === lyr.g_layer_config.source.id)
            .map((e) => e.id);

        // select all inside config
        layerStyles.forEach((layerId) => {
            if (
                lyr.g_layer_config?.onHover?.enabled &&
                lyr.g_layer_config?.onHover?.layers.includes(layerId)
            ) {
                const layerConf = {
                    source: lyr.g_layer_config.source.id,
                    id: hoveredPolygonId,
                };
                if (lyr.g_layer_config.source.source.type == "vector")
                    layerConf["sourceLayer"] = layerId;

                appConfig.mapObj.on("mousemove", layerId, (e) => {
                    // Change the cursor style as a UI indicator.
                    appConfig.mapObj.getCanvas().style.cursor = "pointer";

                    if (e.features.length > 0) {
                        if (hoveredPolygonId !== null) {
                            // console.log("cs", appConfig.mapObj.getFeatureState(layerConf));
                            appConfig.mapObj.setFeatureState(layerConf, {
                                hover: false,
                            });
                        }
                        hoveredPolygonId = e.features[0].id;
                        layerConf["id"] = e.features[0].id;
                        appConfig.mapObj.setFeatureState(layerConf, {
                            hover: true,
                        });
                    }

                    // Copy coordinates array.
                    const coordinates = e.lngLat;
                    // console.log(e.features[0].properties)
                    let description = `<h5>${
                        lyr.g_label
                    }</h5><p><b>Lat-Long</b>: ${e.lngLat.lat.toFixed(
                        4
                    )},${e.lngLat.lng.toFixed(4)}</p>`;
                    if(lyr.g_layer_config?.toolTip){
                        toolTipContent =
                        lyr.g_layer_config.toolTip.content.replace(
                            /\{\{(.*?)\}\}/g,
                            (match, key) =>
                                e.features[0].properties[key] || match
                        );
                    description += toolTipContent;
                    // Populate the popup and set its coordinates based on the feature found.
                    lyr.g_layer_config.toolTip.enabled
                        ? popup
                              .setLngLat(coordinates)
                              .setHTML(description)
                              .addTo(appConfig.mapObj)
                        : null;
                    }
                    
                });
                appConfig.mapObj.on("mouseleave", layerId, (e) => {
                    if (hoveredPolygonId !== null) {
                        appConfig.mapObj.setFeatureState(layerConf, {
                            hover: false,
                        });
                        // console.log("mouseleave cs", appConfig.mapObj.getFeatureState(layerConf));
                    }
                    hoveredPolygonId = null;

                    appConfig.mapObj.getCanvas().style.cursor = "";
                    popup.remove();
                });
            }
        });
    });
};

// Initializa map
const initLayer = async () => {
    $("#map_container").append(`
    <div id="map_layers_panel" class="sidemenu map_layers_panel container px-3">
    <!-- Header -->
    <div class="d-flex justify-content-between py-3">
        <h3 id="map_label"><!-- Map lable --></h3>
        <button class="btn" onclick="handleMapLayersPanel()">
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-x-square"
                viewBox="0 0 16 16">
                <path
                    d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z" />
                <path
                    d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708" />
            </svg>
        </button>
    </div>
    <!-- ./Header -->

    <!-- Basemap -->
    <div class="row">
        <label for="base_map" class="form-label">Base Map</label>
        <div class="mb-3" id="base_map"></div>
    </div>
    <!-- ./Basemap -->

    <!-- Layers -->
    <div id="layerList">
        <div class="row mt-3" >
            <label for="base_layer" class="form-label">Layers</label>
            <div class="accordion accordion-flush" id="layer-list-items"></div>
        </div>
    </div>
    <!-- ./Layers -->
</div>
    `);
    loadBaseMapList(
        appConfig.mapConfig.g_meta.baseMaps.layers,
        appConfig.mapConfig.g_meta.baseMaps.defaultBaseMap
    );
    loadLayerList(appConfig.mapConfig.g_layers);
    addAllLayersToMap(appConfig.mapConfig.g_layers);

    // // Set Map Label
    $("#map_label").text(appConfig.mapConfig.g_label);

    addOnClickPopup(appConfig.mapConfig.g_layers);
    addOnHoverToolTip(appConfig.mapConfig.g_layers);
};

// Initializa map on load
appConfig.mapObj.on("load", () => {
    initLayer();
});

/***************************************************
 *          Layer Panel Tool Actions
 *
 * handleChangeBaseMap() - change base map style
 * handleLayerVisibility() - control the layer visibility
 *
 ****************************************************/
// change base map style
const handleChangeBaseMap = function (value) {
    appConfig.mapObj.setStyle(value);
    appConfig.mapObj.on("styledata", () => {
        addAllLayersToMap(appConfig.layersArray);
    });
};

// control the layer visibility
const handleLayerVisibility = function (value) {
    const layerStyles = appConfig.mapObj
        .getStyle()
        .layers.filter((e) => e.source === value);

    // Update layersArray state
    appConfig.layersArray = [...appConfig.layersArray].map((lyrGrp) => {
        lyrGrp.layers = lyrGrp.layers.map((lyr) => {
            lyr.g_layer_config.layers.map((style) => {
                if (style.style.source == value) {
                    style.style.layout.visibility =
                        style.style.layout.visibility === "visible"
                            ? "none"
                            : "visible";
                }
                return style;
            });
            lyr.checked = !lyr.checked
            return lyr;
        });
        return lyrGrp;
    });

    layerStyles.forEach((style) => {
        const visibility = appConfig.mapObj.getLayoutProperty(
            style.id,
            "visibility"
        );
        const newState = visibility === "visible" ? "none" : "visible";
        appConfig.mapObj.setLayoutProperty(style.id, "visibility", newState);
    });
};
