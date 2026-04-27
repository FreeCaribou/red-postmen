import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem } from '@/types';
import { Head, Link } from '@inertiajs/react';
import { useEffect, useState } from 'react';
import L from 'leaflet';
import { useTranslation } from 'react-i18next';
import { Button } from '@/components/ui/button';
import { MoveRightIcon } from 'lucide-react';

export default function MyAreas({ areas = [] }: { areas: any[] }) {

    const { t } = useTranslation();

    const breadcrumbs: BreadcrumbItem[] = [
        {
            title: t('menu.my-areas'),
            href: '/my-areas',
        },
    ];

    const [maps, setMaps] = useState<L.Map[]>([]);

    // TODO Type all here, make it in another function for generic, verify error, check if we can deezome if needed when big zone
    useEffect(() => {
        maps.forEach((map) => map.remove());
        setMaps([]);

        const newMaps = areas.filter(a => a.delimitation).map((area) => {
            /**
             * To know the middle of the map, we need to make an avarage of the lat and the lng
             * But we don't take the first corner of the polygone because it will be the same as the last and will diform the middle
             * The zoom of 17 show +/- 400 meter
             */
            const coordinates = area?.delimitation?.coordinates;
            const polygonDelimitation: L.LatLngExpression[] = coordinates;
            const middleLat = coordinates[0].slice(1).map((c: any) => c[0]).reduce((acc: any, val: any) => acc + val, 0) / (coordinates[0].length - 1);
            const middleLng = coordinates[0].slice(1).map((c: any) => c[1]).reduce((acc: any, val: any) => acc + val, 0) / (coordinates[0].length - 1);

            const map = L.map(`map-${area.id}`).setView([middleLat, middleLng], 17);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
            }).addTo(map);
            L.polygon(polygonDelimitation, {
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
            <Head title={t('menu.my-areas')} />
            <div className='flex justify-end'><Link href='/my-areas/new-area'>
                <Button variant="link" data-icon="inline-end">{t('area.make-new-area')} <MoveRightIcon></MoveRightIcon></Button>
            </Link></div>
            <div className="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
                {areas.length === 0 ? (
                    <p>{t('area.noZoneAvalaible')}</p>
                ) : (
                    areas.map((area) => (
                        (area.delimitation && (
                            <div key={area.id} className="border rounded-lg overflow-hidden">
                                <h3 className="p-2 text-secondary-foreground bg-secondary">{area.label}</h3>
                                <div id={`map-${area.id}`} style={{ height: '400px', width: '100%' }} />
                            </div>
                        ))
                    ))
                )}
            </div>
        </AppLayout>
    );
}
