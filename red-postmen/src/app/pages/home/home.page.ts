import { Component, inject } from '@angular/core';
import { IonContent, IonCard, IonCardHeader, IonCardContent, IonCardSubtitle, IonCardTitle, IonList, IonItem, IonListHeader, IonLabel } from '@ionic/angular/standalone';
import { MapOptions } from 'leaflet';
import { PostmenService } from 'src/app/services/api/postmen.service';
import { LocalStorageEnum } from 'src/app/shared/enum/localStorage.enum';
import { MapComponent } from 'src/app/shared/components/map.component';

@Component({
  selector: 'app-home',
  templateUrl: 'home.page.html',
  imports: [IonContent, IonCard, IonCardHeader, IonCardContent, IonCardSubtitle, IonCardTitle, IonList, IonItem, IonListHeader, IonLabel, MapComponent],
})
export class HomePage {

  private readonly postmenService: PostmenService = inject(PostmenService);

  postmen: { id: number, name: string, city: string, areas: any[] }[] = [];

  mapOptions!: MapOptions;

  ionViewDidEnter(): void {
    // TODO make a user store
    if (!!localStorage.getItem(LocalStorageEnum.AuthToken)) {
      this.postmenService.getAllPostmen().subscribe(data => {
        this.postmen = data;
      });
    }
  }

}
