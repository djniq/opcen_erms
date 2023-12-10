<template>
      <!-- rendering the map on the page -->
      <Transition>
        <GMapMap
        ref="map"
        :center="coords" :zoom="15"
        map-type-id="roadmap"
        style="width: 100%; height: 70vh;"
        class="mb-4"
        >

        <!-- Marker to display the searched location -->
        <GMapMarker :key="markerDetails.id" :position="markerDetails.position" :clickable="true" :draggable="false"
            @click="openMarker(markerDetails.id)">
            <!-- InfoWindow to display the searched location details -->
            <GMapInfoWindow v-if="locationDetails.address != ''" :closeclick="true" @closeclick="openMarker(null)"
                :opened="openedMarkerID === markerDetails.id" :options="{
                    pixelOffset: {
                        width: 10,
                        height: 0
                    },
                    maxWidth: 320,
                    maxHeight: 320
                }">
                <div class="location-details">
                    <h3>Location Details</h3>
                    <p>Address: {{ locationDetails.address }}</p>
                    <p>
                        URL: <a :href="locationDetails.url" target="_blank"> {{ locationDetails.url }}</a>
                    </p>
                </div>
            </GMapInfoWindow>

        </GMapMarker>
    </GMapMap>
  </Transition>
</template>

<script setup lang="ts">
import { PropType, computed, onMounted, ref, watch } from 'vue';

const props = defineProps({
  incident: {
    type: Object as PropType<any>,
    default: null
  }
});

// Location variables
const transportFrom = ref<google.maps.Map|null>(null);
const transportTo = ref<google.maps.Map|null>(null);

// Setting the default coordinates
const coords = ref({ lat: 51.5072, lng: 0.1276 })
// Marker Details
const markerDetails = ref({
    id: 1,
    position: coords.value
})
const openedMarkerID = ref(null)

// Places Details
const locationDetails = ref({
    address: '',
    url: ''
})

const map = ref<any>(null);

interface PathPoint {
    lat: number;
    lng: number;
}

const path = ref<PathPoint[]>([]);

// Open the marker info window
const openMarker = (id) => {
    openedMarkerID.value = id
}

// Get users current location using the browser's geolocation API
const getUserLocation = () => {
    // Check if Geolocation is supported by the browser
    const isSupported = 'navigator' in window && 'geolocation' in navigator
    if (isSupported) {
        // Retrieve the user's current position
        navigator.geolocation.getCurrentPosition((position) => {
            coords.value.lat = position.coords.latitude
            coords.value.lng = position.coords.longitude
        })
    }
}

const setPath = () => {
    path.value = [];
    if (transportFrom.value && transportTo.value) {
        path.value = [
            {lat: transportFrom.value?.geometry.location.lat, lng: transportFrom.value?.geometry.location.lng},
            {lat: transportTo.value?.geometry.location.lat, lng: transportTo.value?.geometry.location.lng}
        ]
        setDirection();
    }
}

const directionsService = computed<any>(() => typeof google != 'undefined' ? new google.maps.DirectionsService : null);
const directionsDisplay = computed<any>(() => typeof google != 'undefined' ? new google.maps.DirectionsRenderer : null);

const setDirection = () => {
  calculateAndDisplayRoute(path.value[0], path.value[1]);
}

//google maps API's direction service
const calculateAndDisplayRoute = (start, destination) => {
    directionsDisplay.value.setMap(null);
    directionsService.value.route({
        origin: start,
        destination: destination,
        travelMode: 'DRIVING'
    }, function(response, status) {
        if (status === 'OK') {
            directionsDisplay.value.setMap(map.value!.$mapObject);
            directionsDisplay.value.setDirections(response);
        } else {
            window.alert('Directions request failed due to ' + status);
        }
    });
}

onMounted(() => {
  getUserLocation();
  if (props.incident) {
    transportFrom.value = props.incident.origin;
    transportTo.value = props.incident.destination;
    setTimeout(() => {
      setPath();
    }, 1000);
  }
});

</script>

<style scoped>

</style>