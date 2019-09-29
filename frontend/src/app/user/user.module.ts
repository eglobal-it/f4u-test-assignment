import {NgModule} from '@angular/core';
import {CommonModule} from "@angular/common";
import {BrowserModule} from "@angular/platform-browser";
import {FormsModule} from "@angular/forms";
import {HttpClientModule} from "@angular/common/http";
import {RouterModule} from "@angular/router";
import {CountWidgetClientComponent} from "./client/components/count-widget/count-widget.component";
import {ClientListComponent} from "./client/components/list/list.component";
import {ClientDetailComponent} from "./client/components/detail/detail.component";
import {ClientService} from "./client/client.service";
import {ClientFetcher} from "./client/client.fetcher";

@NgModule({
  imports: [CommonModule, BrowserModule, FormsModule, HttpClientModule, RouterModule],
  exports: [CountWidgetClientComponent, ClientListComponent, ClientDetailComponent],
  declarations: [CountWidgetClientComponent, ClientListComponent, ClientDetailComponent],
  bootstrap: [],
  providers: [ClientService, ClientFetcher],
})

export class UserModule extends CommonModule {
}
