import { LocalStorageEnum } from "~/utils/localStorage.enum";

export const getAllAreas = async () => {
    const config = useRuntimeConfig();

    try {
        const response: { token: string } = await $fetch(`${config.public.apiUrl}areas`, {
            headers: {
                Authorization: localStorage.getItem(LocalStorageEnum.AuthToken) || '',
            },
            method: 'GET',
        });
        return response;
    } catch (error) {
        throw error;
    }
}