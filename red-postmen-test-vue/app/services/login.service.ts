import { LocalStorageEnum } from "~/utils/localStorage.enum";

export const login = async (username: string, password: string) => {
    const config = useRuntimeConfig();

    try {
        const response: { token: string } = await $fetch(`${config.public.apiUrl}login`, {
            method: 'POST',
            body: { username, password },
        });
        localStorage.setItem(LocalStorageEnum.AuthToken, response.token);
        return response;
    } catch (error) {
        throw error;
    }
}