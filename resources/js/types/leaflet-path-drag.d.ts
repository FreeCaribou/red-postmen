// So typescript understand the link with leaflet and the plugin
import * as L from 'leaflet';
declare module 'leaflet' {
    interface PathOptions {
        draggable?: boolean;
    }
}