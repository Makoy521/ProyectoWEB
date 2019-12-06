(function(){
	const initMap = function() {
		mapboxgl.accessToken = 'pk.eyJ1Ijoianp1bmlnYXVhYmNzIiwiYSI6ImNrMzgyaHY5bDA1NTYzaHAxaXMzN2Z4ODAifQ.-E42F-52lBA19Yk989dU8A';
		let map = new mapboxgl.Map({
			container: 'map',
			style: 'mapbox://styles/mapbox/streets-v11',
			center: [-110.316120, 24.102782], 
			zoom: 15,
		})
		let marker = undefined;

		const onAddMarker= function(e) {
			if(typeof marker === 'undefined') {
				marker = new mapboxgl.Marker({
					draggable: true
				})
				.setLngLat(e.lngLat.wrap())
				.addTo(map)

				marker.on('dragend', onDrageEnd)
				document.querySelector('#lng').value = e.lngLat.wrap().lng
				document.querySelector('#lat').value = e.lngLat.wrap().lat
			}
		}

		const onDrageEnd = function() {
			const lngLat = marker.getLngLat();
			document.querySelector('#lng').value = lngLat.lng
			document.querySelector('#lat').value = lngLat.lat
		}

		const getAllMarkers = function() {
			$.ajax({
				type: 'GET',
				url: 'marcaController.php',
			})
			.done(function(data){
				debugger
				data.markers.forEach(function(m) {
					new mapboxgl.Marker()
					.setLngLat({lat: m.lat, lng: m.lng})
					.addTo(map)
				})
			})
			.fail(function(jqXHR, textStatus, errorThrown){
				console.err('Ocurrió un error al intentar cargar las marcas')
			})
		}
		getAllMarkers()
		map.on('click', onAddMarker)
	}

	const mapContainer = document.querySelector('.mapContainer')
	if(mapContainer) {
		initMap()
	}

})()