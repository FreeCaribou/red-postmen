import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/react';
import { useEffect } from 'react';
import L, { LatLngExpression, LatLngTuple } from 'leaflet';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'My Points',
        href: '/my-points',
    },
];

export default function MyPostmen() {

    useEffect(() => {
        const map = L.map('map').setView([50.84879846958948, 4.3456910267578825], 17);
        L.marker([50.84879846958948, 4.3456910267578825]).addTo(map);
        const polygonCoords: LatLngTuple[] = [
            [50.84869861829053, 4.3457505579357285],
            [50.8479873202758, 4.345845388342124],
            [50.848791020861405, 4.34756360986613],
        ];
        L.polygon(polygonCoords, {}).addTo(map);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        return () => {
            map.remove();
        };
    }, []);

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="My points" />
            <div className="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
                <div id="map" style={{ height: '100%', width: '100%' }}>
                </div>
            </div>
        </AppLayout>
    );
}
