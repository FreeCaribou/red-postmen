import { Component, inject, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, ReactiveFormsModule, Validators } from '@angular/forms';
import { IonContent } from '@ionic/angular/standalone';
import { LoginService } from 'src/app/services/api/login.service';
import { IonInput, IonInputPasswordToggle, IonItem, IonButton, IonList, IonIcon } from '@ionic/angular/standalone';
import { LocalStorageEnum } from 'src/app/shared/enum/localStorage.enum';

@Component({
  selector: 'app-options',
  templateUrl: 'options.page.html',
  imports: [IonContent, ReactiveFormsModule, IonInputPasswordToggle, IonInput, IonItem, IonButton, IonList, IonIcon]
})
export class OptionsPage implements OnInit {

  private readonly loginService: LoginService = inject(LoginService);

  private readonly formBuilder: FormBuilder = inject(FormBuilder);

  loginForm!: FormGroup;

  get isLogged(): boolean {
    return !!localStorage.getItem(LocalStorageEnum.AuthToken);
  }

  ngOnInit(): void {
    this.loginForm = this.formBuilder.group({
      username: ['', Validators.required],
      password: ['', Validators.required]
    });
  }

  // TODO show success or error and loader
  onLogin() {
    this.loginService.login(this.loginForm.value).subscribe();
  }

  onLogout() {
    localStorage.removeItem(LocalStorageEnum.AuthToken);
  }

}
