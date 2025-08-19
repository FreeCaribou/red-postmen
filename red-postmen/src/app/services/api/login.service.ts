import { HttpClient } from "@angular/common/http";
import { inject, Injectable } from "@angular/core";
import { map, Observable, tap } from "rxjs";
import { LocalStorageEnum } from "src/app/shared/enum/localStorage.enum";
import { environment } from "src/environments/environment";

@Injectable({
    providedIn: 'any'
})
export class LoginService {

    baseUrl = environment.apiUrl;

    private readonly httpClient: HttpClient = inject(HttpClient);

    login(body: { username: string, password: string }): Observable<string> {
        return this.httpClient.post<{ token: string, username: string }>(`${this.baseUrl}login`, body).pipe(
            map(data => data.token),
            tap(data => localStorage.setItem(LocalStorageEnum.AuthToken, data)),
        );
    }

}