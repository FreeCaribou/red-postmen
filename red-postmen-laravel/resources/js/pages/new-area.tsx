import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/react';
import { useEffect, useRef } from 'react';
import L, { Polygon } from 'leaflet';
import 'leaflet-editable';
import 'leaflet-path-drag';
import { useTranslation } from 'react-i18next';
import { Button } from '@/components/ui/button';

export default function NewArea({ }: {}) {

    const { t } = useTranslation();

    const mapRef = useRef<L.Map | null>(null);
    const polygonsRef = useRef<Polygon | null>(null);

    const breadcrumbs: BreadcrumbItem[] = [
        {
            title: t('menu.my-areas'),
            href: '/my-areas',
        },
        {
            title: t('menu.new-areas'),
            href: '/my-areas/new-area',
        },
    ];

    useEffect(() => {
        const baseMiddle = [50.84510438237964, 4.353180962846589]
        const middle: L.LatLngExpression = baseMiddle as L.LatLngExpression;
        /**
         * Here we calcul a kind of triangle of +/- 200 meter long
         */
        const firstCorner: L.LatLngExpression = [baseMiddle[0] + 0.001037, baseMiddle[1]];
        const secondCorner: L.LatLngExpression = [baseMiddle[0] + (0.001037 * Math.cos(120 * Math.PI / 180)), baseMiddle[1] + (0.001611 * Math.sin(120 * Math.PI / 180))];
        const thirdCorner: L.LatLngExpression = [baseMiddle[0] + (0.001037 * Math.cos(240 * Math.PI / 180)), baseMiddle[1] + (0.001611 * Math.sin(240 * Math.PI / 180))];
        const polygonDelimitation: L.LatLngExpression[] = [firstCorner, secondCorner, thirdCorner];
        const map = L.map('map', { editable: true }).setView(middle, 17);
        mapRef.current = map;

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        const newPolygon = L.polygon(polygonDelimitation, {
            draggable: true
        }).addTo(map);
        newPolygon.enableEdit();
        // TODO make an array of history coordinates so user can make kind of ctrl-z
        newPolygon.on('editable:vertex:dragend editable:vertex:deleted editable:vertex:new dragend', (e) => {
            const updatedCoordinates = newPolygon.getLatLngs();
            console.log("new coord :", updatedCoordinates);
        });
        polygonsRef.current = newPolygon;

        return () => {
            if (mapRef.current) {
                mapRef.current.remove();
            }
            if (polygonsRef.current) {
                polygonsRef.current.remove();
            }
        };
    }, []);

    const onClickSave = () => {
        console.log('param to save', polygonsRef.current?.getLatLngs())
    }

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title={t('menu.new-areas')} />
            <div className="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
                <div className="border rounded-lg overflow-hidden">
                    <h3 className="p-2 text-secondary-foreground bg-secondary">{t('area.new-area')}</h3>
                    <div id='map' style={{ height: '400px', width: '100%' }} />
                </div>
                <Button onClick={onClickSave}>{t('save')}</Button>
            </div>
        </AppLayout>
    );
}
