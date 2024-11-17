@extends('layouts.app')

@push('header')
    <link href="https://api.mapbox.com/mapbox-gl-js/v3.0.1/mapbox-gl.css" rel="stylesheet">
    <script src="https://api.mapbox.com/mapbox-gl-js/v3.0.1/mapbox-gl.js"></script>
    <style>
        #map {
            width: 100vw;
            height: 100%;
            z-index: 1;
        }
        #map_container{
            position: relative;
            flex: 1;
        }
        #map_overlay_wrapper {
            position: absolute;
            top: 1.0rem;
            left: 0;
            z-index: 3;
            width: 100%;
            margin: auto;
        }

        .mapboxgl-popup {
            max-width: 800px;
            font:
                12px/20px 'Helvetica Neue',
                Arial,
                Helvetica,
                sans-serif;
        }
    </style>
@endpush

@section('content')
    <main id="map_container">
        <div id="map"></div>
        {{-- Map overlay custome menu icons --}}
        <div id="map_overlay_wrapper" class="row justify-content-between">
            <div class="col-2 d-flex justify-content-start">
                <button id="layers_panel" class="btn btn-dark"
                    onclick="handleMapLayersPanel()">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-stack" viewBox="0 0 16 16">
                        <path
                            d="m14.12 10.163 1.715.858c.22.11.22.424 0 .534L8.267 15.34a.6.6 0 0 1-.534 0L.165 11.555a.299.299 0 0 1 0-.534l1.716-.858 5.317 2.659c.505.252 1.1.252 1.604 0l5.317-2.66zM7.733.063a.6.6 0 0 1 .534 0l7.568 3.784a.3.3 0 0 1 0 .535L8.267 8.165a.6.6 0 0 1-.534 0L.165 4.382a.299.299 0 0 1 0-.535z" />
                        <path
                            d="m14.12 6.576 1.715.858c.22.11.22.424 0 .534l-7.568 3.784a.6.6 0 0 1-.534 0L.165 7.968a.299.299 0 0 1 0-.534l1.716-.858 5.317 2.659c.505.252 1.1.252 1.604 0z" />
                    </svg>
                </button>
            </div>
            <div class="col-2 d-flex justify-content-end">
                <button id="reset" class="btn btn-dark" onclick="resetMapCenter()">Reset</button>
            </div>
        </div>
        {{-- ./Map overlay custome menu icons --}}

        {{-- Popup Modal --}}
        <div class="modal modal-lg fade" id="popup-modal" tabindex="-1" aria-labelledby="popup-modal-label"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="popup-modal-label">Feature Info</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="popup-modal-content">
                        {{-- Html --}}
                    </div>
                </div>
            </div>
        </div>
        {{-- ./Popup Modal --}}



        {{--  Map Container --}}
        <script src="{{asset('assets/js/template/g000_map_container.js')}}"></script>
        
        {{-- Map Tools - Layer panel --}}
        <script src="{{asset("assets/js/template/g001_layer_panel_tool.js")}}"></script>

    </main>
@endsection