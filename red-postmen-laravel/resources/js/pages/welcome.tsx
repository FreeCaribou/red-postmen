import AppLogoIcon from '@/components/app-logo-icon';
import Footer from '@/layouts/footer';
import { type SharedData } from '@/types';
import { Head, Link, usePage } from '@inertiajs/react';
import { useTranslation } from 'react-i18next';

export default function Welcome() {
    const { auth } = usePage<SharedData>().props;

    const { t } = useTranslation();

    return (
        <>
            <Head title="Welcome">
                <link rel="preconnect" href="https://fonts.bunny.net" />
                <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
            </Head>
            <div className="flex flex-col min-h-screen items-center bg-[#FDFDFC] text-[#1b1b18] md:justify-center">
                <div className="p-6 md:p-8 sm:w-4/5">
                    <header className="mb-6 w-full max-w-[335px] text-sm not-has-[nav]:hidden md:max-w-4xl">
                        <nav className="flex items-center justify-end gap-4">
                            {auth.user ? (
                                <Link
                                    href={route('dashboard')}
                                    className="inline-block rounded-sm border border-[#19140035] px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#1915014a]"
                                >
                                    {t('menu.dashboard')}
                                </Link>
                            ) : (
                                <>
                                    <Link
                                        href={route('login')}
                                        className="inline-block rounded-sm border border-transparent px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#19140035]"
                                    >
                                        {t('menu.login')}
                                    </Link>
                                </>
                            )}
                        </nav>
                    </header>
                    <div className="flex w-full items-center justify-center opacity-100 transition-opacity duration-750 md:grow starting:opacity-0">
                        <main className="flex w-full max-w-[335px] flex-col-reverse md:max-w-4xl md:flex-row">
                            <div className="flex-1 rounded-br-lg rounded-bl-lg bg-white p-6 pb-12 text-[13px] leading-[20px] shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)] md:rounded-tl-lg md:rounded-br-none md:p-20">
                                <AppLogoIcon></AppLogoIcon>
                                <h2 className='text-secondary text-lg'>{t('workProgress')}</h2>
                            </div>
                        </main>
                    </div>
                </div>
                <Footer></Footer>
            </div>
        </>
    );
}
