import {BrowserModule} from '@angular/platform-browser';
import {NgModule} from '@angular/core';
import {HttpClientModule} from '@angular/common/http';
import {FormsModule, ReactiveFormsModule} from '@angular/forms';
import {NgbModule} from '@ng-bootstrap/ng-bootstrap';
import {BrowserAnimationsModule} from '@angular/platform-browser/animations';
import {AppComponent} from './app.component';
import {AppRoutingModule} from './app-routing.module';
import {UserModule} from "./user/user.module";
import {ToastsContainer} from "./common/toast/toast-container.component";
import {ToastService} from "./common/toast.service";
import {DeliveryModule} from "./delivery/delivery.module";
import {DashboardIndexPageComponent} from "./pages/dashboard/index.component";
import {ClientsIndexPageComponent} from "./pages/clients/index.component";
import {ClientsDetailPageComponent} from "./pages/clients/detail/detail.component";
import {NgxSpinnerModule} from 'ngx-spinner';

@NgModule({
  declarations: [
    AppComponent,
    DashboardIndexPageComponent,
    ClientsIndexPageComponent,
    ClientsDetailPageComponent,
    ToastsContainer
  ],
  imports: [
    HttpClientModule,
    BrowserModule,
    BrowserAnimationsModule,
    FormsModule,
    ReactiveFormsModule,
    NgbModule,
    AppRoutingModule,
    UserModule,
    DeliveryModule,
    NgxSpinnerModule,
  ],
  providers: [
    ToastService
  ],
  bootstrap: [AppComponent],
  schemas: [],
})
export class AppModule {
}
