import {Component, Input, OnInit, Output} from "@angular/core";
import {AddressService} from "../../address.service";
import {AddressEntityInterface} from "../../address.entity";
import {CreateAddressDto, UpdateAddressDto} from "../../address.dto";

@Component({
  selector: 'delivery-address-list',
  templateUrl: './list.component.html',
  providers: [AddressService]
})

export class ListAddressComponent implements OnInit {
  private addressList: AddressEntityInterface[];
  private editAddressId?: number;
  private createFormOpen: boolean;

  public isLoading: boolean = false;

  @Input() @Output() clientId: number;

  constructor(private addressService: AddressService) {
  }

  ngOnInit(): void {
    this.loadAddressed();
  }

  private loadAddressed(): void {
    this.isLoading = true;
    this.addressService.findAddressesByClientId(this.clientId).then(data => {
      this.addressList = data;
      this.isLoading = false;
    });
  }

  public setDefault(id: number): void {
    this.isLoading = true;
    this.addressService.setDefaultAddressByClientIdAndAddressId(this.clientId, id).then(success => {
      this.isLoading = false;
      if (success) {
        this.loadAddressed();
      }
    });
  }

  public openCreateAddressForm(): void {
    this.editAddressId = null;
    this.createFormOpen = true;
  }

  public openUpdateAddressForm(address: AddressEntityInterface): void {
    this.editAddressId = address.getId();
    this.createFormOpen = false;
  }

  public closeForms(): void {
    this.editAddressId = null;
    this.createFormOpen = false;
  }

  public saveAddress(dto: object): void {
    if (dto instanceof CreateAddressDto) {
      this.addressService.saveNew(dto).then(success => {
        this.after(success);
      });
    } else if (dto instanceof UpdateAddressDto) {
      this.addressService.saveUpdate(this.clientId, dto).then(success => {
        this.after(success);
      });
    }
  }

  public deleteAddressById(address: AddressEntityInterface): void {
    const addressText = `ZipCode: ${address.getZipCode()}, Country: ${address.getCountry()}, City: ${address.getCity()}, Street: ${address.getStreet()}`;

    if (confirm(`Are you sure you want to delete "${addressText}" profile?`)) {
      this.addressService.delete(this.clientId, address.getId()).then(success => {
        this.after(success);
      });
    }
  }

  private after(success: boolean) {
    if (success) {
      this.closeForms();
      this.loadAddressed();
    }
  }
}
