import {NgModule} from '@angular/core';
import {CommonModule} from "@angular/common";
import {BrowserModule} from "@angular/platform-browser";
import {FormsModule} from "@angular/forms";
import {HttpClientModule} from "@angular/common/http";
import {RouterModule} from "@angular/router";
import {AddressService} from "./address/address.service";
import {AddressFetcher} from "./address/address.fetcher";
import {NgxSpinnerModule} from "ngx-spinner";
import {CreateAddressComponent} from "./address/components/create/create.component";
import {FormAddressComponent} from "./address/components/form/form.component";
import {ListAddressComponent} from "./address/components/list/list.component";
import {EditAddressComponent} from "./address/components/edit/edit.component";
import {NgbModule} from "@ng-bootstrap/ng-bootstrap";

@NgModule({
  imports: [CommonModule, BrowserModule, FormsModule, HttpClientModule, RouterModule, NgxSpinnerModule, NgbModule],
  exports: [ListAddressComponent, CreateAddressComponent, EditAddressComponent, FormAddressComponent],
  declarations: [ListAddressComponent, CreateAddressComponent, EditAddressComponent, FormAddressComponent],
  bootstrap: [],
  providers: [AddressService, AddressFetcher],
})

export class DeliveryModule extends CommonModule {
}
