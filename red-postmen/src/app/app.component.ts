import { Component } from '@angular/core';
import { IonApp, IonTabs, IonTabBar, IonTabButton, IonIcon, IonLabel } from '@ionic/angular/standalone';

@Component({
  selector: 'app-root',
  templateUrl: 'app.component.html',
  imports: [IonTabBar, IonTabs, IonApp, IonTabButton, IonIcon, IonLabel],
})
export class AppComponent {
  constructor() { }
}
