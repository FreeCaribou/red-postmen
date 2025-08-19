import { Component, inject, OnInit } from '@angular/core';
import { IonContent, IonText, IonCard, IonCardHeader, IonCardContent, IonCardSubtitle, IonCardTitle, IonList, IonItem, IonListHeader, IonLabel } from '@ionic/angular/standalone';
import { PostmenService } from 'src/app/services/api/postmen.service';
import { LocalStorageEnum } from 'src/app/shared/enum/localStorage.enum';

@Component({
  selector: 'app-home',
  templateUrl: 'home.page.html',
  imports: [IonContent, IonText, IonCard, IonCardHeader, IonCardContent, IonCardSubtitle, IonCardTitle, IonList, IonItem, IonListHeader, IonLabel],
})
export class HomePage implements OnInit {

  private readonly postmenService: PostmenService = inject(PostmenService);

  postmen: { id: number, name: string, city: string, areas: any[] }[] = [];

  ngOnInit(): void {
    // TODO make a user store
    if (!!localStorage.getItem(LocalStorageEnum.AuthToken)) {
      console.log('user is here')
      this.postmenService.getAllPostmen().subscribe(data => {
        console.log('data', data)
        this.postmen = data;
      });
    }
  }

}
