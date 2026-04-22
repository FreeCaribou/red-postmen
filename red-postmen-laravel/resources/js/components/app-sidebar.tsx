import { NavFooter } from '@/components/nav-footer';
import { NavMain } from '@/components/nav-main';
import { NavUser } from '@/components/nav-user';
import { Sidebar, SidebarContent, SidebarFooter, SidebarHeader, SidebarMenu, SidebarMenuButton, SidebarMenuItem } from '@/components/ui/sidebar';
import { type NavItem } from '@/types';
import { Link } from '@inertiajs/react';
import { FolderGit, LayoutGrid, Mailbox, MapPin } from 'lucide-react';
import Footer from '@/layouts/footer';
import AppLogoIcon from './app-logo-icon';

const mainNavItems: NavItem[] = [
    {
        title: 'Dashboard',
        url: '/dashboard',
        icon: LayoutGrid,
    },
    {
        title: 'My Postmen',
        url: '/my-postmen',
        icon: Mailbox,
    },
    {
        title: 'My Points',
        url: '/my-points',
        icon: MapPin,
    },
];

const footerNavItems: NavItem[] = [
    {
        title: 'Repository',
        url: 'https://github.com/FreeCaribou/red-postmen',
        icon: FolderGit,
    },
];

export function AppSidebar() {
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
