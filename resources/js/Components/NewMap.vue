<!-- <template>
    <div ref="map" class="map"></div>
  </template>
  
  <script>
    import 'ol/ol.css'; // Import OpenLayers styles
    import { Map, View } from 'ol'; // Import core OpenLayers classes
    import TileLayer from 'ol/layer/Tile'; // Import a layer type (e.g., TileLayer)
    import OSM from 'ol/source/OSM'; // Import a source (e.g., OSM - OpenStreetMap)
    import VectorLayer from 'ol/layer/Vector.js';
    import VectorSource from 'ol/source/Vector.js';
    import {DragBox, Select} from 'ol/interaction.js';
    import {Fill, Stroke, Style} from 'ol/style.js';
    import {platformModifierKeyOnly} from 'ol/events/condition.js';
  
    export default {
        data(){
            return {
                map: null,
                selectedFeatures: null,
                isClient: false,
                svgContainer: null,
            }
        },
        mounted() {
            this.isClient = true;
            this.initializeMap();
        },
        methods: {
            setArea(area) {
                this.mapConfig.layers[0].options.sql =
                'select * from european_countries_e where area > ' + area;
            },
            initializeMap() {
                if (!this.isClient) return;
                this.map = new Map({
                    target: this.$refs.map,
                    layers: [
                        new TileLayer({
                            source: new OSM(),
                        }),
                        
                    ],
                    view: new View({
                        center: [0, 0],
                        zoom: 3,
                    }),
                });
                const selectedStyle = new Style({
                    fill: new Fill({
                        color: '#00ff00',
                    }),
                    stroke: new Stroke({
                        color: 'rgba(255, 255, 255, 0.7)',
                        width: 2,
                    }),
                });
                this.selectedFeatures = new Select({
                    condition: platformModifierKeyOnly,
                    style: (feature) => {
                        const color = feature.get('COLOR_BIO') || '#eeeeee';
                        selectedStyle.getFill().setColor(color);
                        console.log(feature);
                        return selectedStyle;
                    },
                });
                this.map.addInteraction(this.selectedFeatures);
                this.selectedFeatures.on(['add', 'remove'], () => {
                        const names = this.selectedFeatures.getArray().map((feature) => {
                        return feature.get('ECO_NAME');
                    });
                    const infoBox = document.getElementById('info');
                    if (names.length > 0) {
                        infoBox.innerHTML = names.join(', ');
                    } else {
                        infoBox.innerHTML = 'None';
                    }
                });
        // Add any additional configuration or interactions here
            },
            
        },
  };
  </script>
  
  <style>
  /* Add any custom styles for your map container */
  .map {
    height: 400px;
    background: #1a2b39;
  }
  </style>
   -->
   <!-- <template>
    <div>
      <div ref="map" class="map-container"></div>
    </div>
  </template>
  
  <script>
  import "ol/ol.css";
  import { Map, View } from "ol";
  import { Tile as TileLayer, Vector as VectorLayer } from "ol/layer";
  import { OSM, Vector as VectorSource } from "ol/source";
  import { GeoJSON } from "ol/format";
  import { Style, Fill, Stroke } from "ol/style";
  import {Select} from 'ol/interaction.js';
  
  export default {
    name: "InteractiveMap",
    data() {
      return {
            map: null,
            selectedFeatures: null,
            vectorLayer: null,
            defaultCountryStyle: new Style({
                fill: new Fill({
                    color: "transparent", // Change the color as desired
                }),
                stroke: new Stroke({
                        color: 'white',
                        width: 2,
                    }),
            }),
            clickedCountryStyle: new Style({
                fill: new Fill({
                    color: "red", // Change the color as desired
                }),
                
            }),
        };
    },
    mounted() {
      this.initMap();
    },
    methods: {
      initMap() {
        const vectorSource = new VectorSource({
          url: "other/countries.geojson", // Replace with the path to your GeoJSON file containing country boundaries
          format: new GeoJSON(),
        });
  
        this.vectorLayer = new VectorLayer({
          source: vectorSource,
          style: this.defaultCountryStyle,
        });

        const selectedStyle = new Style({
                    fill: new Fill({
                        color: 'red',
                    }),
                    /* stroke: new Stroke({
                        color: 'white',
                        width: 1,
                    }), */
                });

        this.selectedFeatures = new Select({
            
            //condition: platformModifierKeyOnly,
            style: (feature) => {
                const color = feature.get('COLOR_BIO') || 'red';
                selectedStyle.getFill().setColor(color);
                return selectedStyle;
            },
        });
  
        this.map = new Map({
          target: this.$refs.map,
          layers: [
            new TileLayer({
              source: new OSM(),
            }),
            this.vectorLayer,
          ],
          view: new View({
            center: [0, 0],
            zoom: 2,
          }),
        });
        this.map.addInteraction(this.selectedFeatures);
        
      },
    },
  };
  </script>
  
  <style>
  .map-container {
    /* width: 600px; */ /* Adjust the size as needed */
    height: 400px; /* Adjust the size as needed */
  }
  </style> -->
  

   <template>
    <div class="mt-5 flex gap-2">

      <l-map style="height: 500px; width: 100%;" :zoom="zoom" :center="center" ref="map" :use-global-leaflet="false">
        <l-tile-layer :url="tileLayerUrl"></l-tile-layer>
        <l-geo-json :geojson="countriesData" @click="onMapClick" :options-style="getDefaultStyle"></l-geo-json>
      </l-map>
      <div class="w-80">
        <div class="text-lg text-center border-b">Pays: {{ len }} / {{ countries.length }}</div>
        <div v-for="country in selectedCountries" class="flex items-center gap-2 py-1 pl-2">
          <div>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="blue" class="w-6 h-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
            </svg>

          </div>
          <div class="text-lg">{{ country.feature.properties.ADMIN }}</div>
        </div>
      </div>
    </div>
    <modal :show="should_repeat" @close="should_repeat=false">
      <div>
        essaye encore sans faire de fautes
      </div>
    </modal>
  </template>
  
  <script>
  import "leaflet/dist/leaflet.css";
    import {LMap, LTileLayer, LGeoJson} from '@vue-leaflet/vue-leaflet'
  //import { LMap, LTileLayer, LGeoJson } from "vue-leaflet";
  //import "leaflet/dist/leaflet.css";
  import axios from "axios";
import Modal from "./Modal.vue";
  
  export default {
    components: {
    LMap,
    LTileLayer,
    LGeoJson,
    Modal
},
    props: ['countries'],
    emits: ['validate'],
    data() {
      return {
        center: [0, 0],
        zoom: 2,
        tileLayerUrl: "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",
        countriesData: null,
        selectedCountry: null,
        wrongs: 0,
        selectedCountries: [],
        wrong_countries: [],
        should_repeat: false
      };
    },
    mounted() {
      this.fetchCountriesData();
      //console.log(this.countries.includes('Algeria'));
    },
    methods: {
      async fetchCountriesData() {
        const response = await axios.get("/other/countries.geojson");
        this.countriesData = response.data;
        //console.log(this.countriesData);
      },
      getDefaultStyle() {
        return {
          fillColor: "transparent",
          weight: 1,
          color: "transparent",
        };
      },
      onMapClick(event) {
        
        // Get the clicked layer
        const clickedLayer = event.layer;
        //console.log(clickedLayer.feature.properties.ADMIN);
        
        /* if (this.selectedCountry) {
          this.selectedCountry.setStyle(this.getDefaultStyle(this.selectedCountry.feature));
        } */
  
        if (clickedLayer) {
          if(this.countries.includes(clickedLayer.feature.properties.ADMIN) && !this.selectedCountries.includes(clickedLayer)){
            clickedLayer.setStyle({
              fillColor: "blue", // Replace with the desired color
              weight: 1,
              color: "blue", // Replace with the desired color for the border
            });
            this.selectedCountries.push(clickedLayer)
          }
          else if(!this.countries.includes(clickedLayer.feature.properties.ADMIN)) {
            clickedLayer.setStyle({
              fillColor: "rgba(255, 0, 0, 0.8)", // Replace with the desired color
              weight: 2,
              color: "#FF0000", // Replace with the desired color for the border
            });
            this.wrong_countries.push(clickedLayer)
            this.wrongs++
          }
          // Change the color of the clicked country
          
  
          this.selectedCountry = clickedLayer;
        }
      },
    },
    computed: {
      len(){
        return this.selectedCountries.length
      }
    },
    watch: {
      len(newValue){
        if(newValue ==this.countries.length){          
          if(this.wrong_countries.length){
            this.should_repeat=true
            this.wrong_countries.map(function(e){
              e.setStyle(this.getDefaultStyle());
            }, this)
            this.selectedCountries.map(function(e){
              e.setStyle(this.getDefaultStyle());
            }, this)
            this.selectedCountries= []
            this.wrong_countries= []
          }
            
          else
            this.$emit('validate')
        }
      }
    }
  };
  </script>
  
  <style>
  .map {
    width: 100%;
    height: 400px;
  }
  </style>
  