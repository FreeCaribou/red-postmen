import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/react';
import { useEffect, useRef, useState } from 'react';
import L, { LatLngTuple } from 'leaflet';
import { useTranslation } from 'react-i18next';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'My Points',
        href: '/my-points',
    },
];

export default function MyPostmen({ areas = [] }: { areas: any[] }) {

    const { t } = useTranslation();

    const [maps, setMaps] = useState<L.Map[]>([]);

    useEffect(() => {
        maps.forEach((map) => map.remove());
        setMaps([]);

        const newMaps = areas.map((area) => {
            // TODO calculate the middle of the map + maybe the zoom
            const map = L.map(`map-${area.id}`).setView(
                area?.delimitation?.coordinates[0][0],
                17
            );
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
            }).addTo(map);
            L.polygon(area?.delimitation?.coordinates, {
            }).addTo(map);
            return map;
        }).filter(Boolean);
        setMaps(newMaps as L.Map[]);

        return () => {
            newMaps.forEach((map) => map?.remove());
        };
    }, [areas]);

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="My points" />
            <div className="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
                {areas.length === 0 ? (
                    <p>{t('area.noZoneAvalaible')}</p>
                ) : (
                    areas.map((area) => (
                        <div key={area.id} className="border rounded-lg overflow-hidden">
                            <h3 className="p-2 text-secondary-foreground bg-secondary">{area.label}</h3>
                            <div id={`map-${area.id}`} style={{ height: '400px', width: '100%' }} />
                        </div>
                    ))
                )}
            </div>
        </AppLayout>
    );
}
