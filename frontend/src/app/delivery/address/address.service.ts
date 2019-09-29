import {AddressEntityInterface} from "./address.entity";
import {AddressFetcher} from "./address.fetcher";
import {Injectable} from "@angular/core";
import {ToastService} from "../../common/toast.service";
import {CreateAddressDto, UpdateAddressDto} from "./address.dto";

export interface AddressServiceInterface {
  saveNew(addressDto: CreateAddressDto): Promise<boolean>;

  saveUpdate(clientId: number, addressDto: UpdateAddressDto): Promise<boolean>;

  delete(clientId: number, addressId: number): Promise<boolean>;

  findAddressesByClientId(clientId: number): Promise<AddressEntityInterface[]>;

  setDefaultAddressByClientIdAndAddressId(clientId: number, addressId: number): Promise<boolean>;
}

@Injectable({providedIn: "root"})
export class AddressService implements AddressServiceInterface {
  private addressFetcher: AddressFetcher;
  private toast: ToastService;

  constructor(addressFetcher: AddressFetcher, toast: ToastService) {
    this.addressFetcher = addressFetcher;
    this.toast = toast;
  }

  findAddressesByClientId(clientId: number): Promise<AddressEntityInterface[]> {
    return this.addressFetcher.getAddressesByClientId(clientId);
  }

  setDefaultAddressByClientIdAndAddressId(clientId: number, addressId: number): Promise<boolean> {
    return this.addressFetcher.setDefaultAddressByClientIdAndAddressId(clientId, addressId).then(success => {
      if (success) {
        this.toast.showSuccess('Set default address: SUCCESS');
      } else {
        this.toast.showDanger('Set default address: FAIL');
      }

      return success;
    });
  }

  delete(clientId: number, addressId: number): Promise<boolean> {
    return this.addressFetcher.deleteAddressByClientIdAndAddressId(clientId, addressId).then(success => {
      if (success) {
        this.toast.showSuccess('Delete address: SUCCESS');
      } else {
        this.toast.showDanger('Delete address: FAIL');
      }
      return success;
    });
  }

  saveNew(addressDto: CreateAddressDto): Promise<boolean> {
    return this.addressFetcher.createAddressByClientIdAndDTO(addressDto).then(success => {
      if (success) {
        this.toast.showSuccess('Create address: SUCCESS');
      } else {
        this.toast.showDanger('Create address: FAIL');
      }
      return success;
    });
  }

  saveUpdate(clientId: number, addressDto: UpdateAddressDto): Promise<boolean> {
    return this.addressFetcher.updateAddressByClientIdAndDTO(clientId, addressDto).then(success => {
      if (success) {
        this.toast.showSuccess('Update address: SUCCESS');
      } else {
        this.toast.showDanger('Update address: FAIL');
      }

      return success;
    });
  }
}
