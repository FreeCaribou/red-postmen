import { NavFooter } from '@/components/nav-footer';
import { NavMain } from '@/components/nav-main';
import { NavUser } from '@/components/nav-user';
import { Sidebar, SidebarContent, SidebarFooter, SidebarHeader, SidebarMenu, SidebarMenuButton, SidebarMenuItem } from '@/components/ui/sidebar';
import { type NavItem } from '@/types';
import { Link } from '@inertiajs/react';
import { FolderGit, LayoutGrid, Mailbox, MapPin } from 'lucide-react';
import Footer from '@/layouts/footer';
import AppLogoIcon from './app-logo-icon';
import { useTranslation } from 'react-i18next';

export function AppSidebar() {
    const { t } = useTranslation();

    const footerNavItems: NavItem[] = [
        {
            title: t('menu.repository'),
            url: 'https://github.com/FreeCaribou/red-postmen',
            icon: FolderGit,
        },
    ];

    const mainNavItems: NavItem[] = [
        {
            title: t('menu.dashboard'),
            url: '/dashboard',
            icon: LayoutGrid,
        },
        {
            title: t('menu.my-postmen'),
            url: '/my-postmen',
            icon: Mailbox,
        },
        {
            title: t('menu.my-areas'),
            url: '/my-areas',
            icon: MapPin,
        },
    ];

    return (
        <Sidebar collapsible="icon" variant="inset">
            <SidebarHeader>
                <SidebarMenu>
                    <SidebarMenuItem>
                        <SidebarMenuButton size="lg" asChild>
                            <Link href="/dashboard" prefetch>
                                <AppLogoIcon />
                            </Link>
                        </SidebarMenuButton>
                    </SidebarMenuItem>
                </SidebarMenu>
            </SidebarHeader>

            <SidebarContent>
                <NavMain items={mainNavItems} />
            </SidebarContent>

            <SidebarFooter>
                <NavFooter items={footerNavItems} className="mt-auto" />
                <NavUser />
                <Footer></Footer>
            </SidebarFooter>
        </Sidebar>
    );
}
