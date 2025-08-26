import { AfterViewInit, Component, inject, Input } from '@angular/core';
import { icon, MapOptions } from 'leaflet';
import { MapService } from 'src/app/services/map.service';
import * as L from 'leaflet';

@Component({
    selector: 'app-map',
    templateUrl: 'map.component.html',
    imports: [],
    standalone: true,
})
export class MapComponent implements AfterViewInit {

    @Input() area: any;

    private map!: L.Map;

    private readonly mapService: MapService = inject(MapService);

    mapOptions!: MapOptions;

    ngAfterViewInit(): void {
        // Kind of bug when we need to be realy sur that the DOM is ready to have the map, so we make the setTimeout
        setTimeout(() => {
            const polygonDelimitation: L.LatLngExpression[] = this.area.delimitation.map((d: { lat: any; lng: any; }) => [Number(d.lat), Number(d.lng)]);
            const middleLat = this.area.delimitation.map((d: { lat: any; lng: any; }) => Number(d.lat)).reduce((acc: any, val: any) => acc + val, 0) / this.area.delimitation.length;
            const middleLng = this.area.delimitation.map((d: { lat: any; lng: any; }) => Number(d.lng)).reduce((acc: any, val: any) => acc + val, 0) / this.area.delimitation.length;

            this.mapOptions = this.mapService.getOptionsMap(middleLat, middleLng);
            // TODO for the zoom, if polygon, try to guess how large is it and zoom depending of that
            this.map = L.map('map-' + this.area.id, this.mapOptions);
            if (polygonDelimitation.length > 1) {
                L.polygon(polygonDelimitation).addTo(this.map);
            } else {
                L.marker(polygonDelimitation[0], {
                    icon: icon({
                        iconSize: [25, 41],
                        iconUrl: 'leaflet/marker-icon.png',
                    })
                }).addTo(this.map);
            }
            this.map.invalidateSize();
        }, 0);

    }

}
