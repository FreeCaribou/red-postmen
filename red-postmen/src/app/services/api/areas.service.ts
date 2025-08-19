import { HttpClient } from "@angular/common/http";
import { inject, Injectable } from "@angular/core";
import { map, Observable, tap } from "rxjs";
import { LocalStorageEnum } from "src/app/shared/enum/localStorage.enum";
import { environment } from "src/environments/environment";

@Injectable({
    providedIn: 'any'
})
export class AreasService {

    baseUrl = environment.apiUrl;

    private readonly httpClient: HttpClient = inject(HttpClient);

    getAllAreas(): Observable<any[]> {
        return this.httpClient.get<any[]>(
            `${this.baseUrl}areas`,
            { headers: { Authorization: localStorage.getItem(LocalStorageEnum.AuthToken) || '' } }
        );
    }

}