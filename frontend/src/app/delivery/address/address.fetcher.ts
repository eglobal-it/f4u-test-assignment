import {Injectable} from "@angular/core";
import {BaseFetcher} from "../../common/fetcher.service";
import {AddressEntity, AddressEntityInterface} from "./address.entity";
import {CreateAddressDto, UpdateAddressDto} from "./address.dto";
import {RESPONSE_CODE_CREATED, RESPONSE_CODE_SUCCESS} from "../../common/common.entity";

@Injectable()
export class AddressFetcher extends BaseFetcher {

  public getAddressesByClientId(clientId: number): Promise<AddressEntityInterface[]> {
    return this.getList(`client/${clientId}/address`).toPromise().then(response => {
      if (response.code == RESPONSE_CODE_SUCCESS) {
        return response.data.list.map(function (item: any) {
          return new AddressEntity(item.id, item.zip_code, item.country, item.city, item.street, item.is_default);
        })
      }
      return [];
    }, error => {
      this.errorHandler(error);

      return [];
    });
  }

  public setDefaultAddressByClientIdAndAddressId(clientId: number, addressId: number): Promise<boolean> {
    return this.update(`client/${clientId}/address/${addressId}/default`, {'is_default': true})
      .toPromise().then(response => {
        return response.code == RESPONSE_CODE_SUCCESS;
      }, error => {
        this.errorHandler(error);

        return false;
      });
  }

  public createAddressByClientIdAndDTO(address: CreateAddressDto): Promise<boolean> {
    const clientId = address.getClientId();
    const data = {
      'zip_code': address.getZipCode(),
      'country': address.getCountry(),
      'city': address.getCity(),
      'street': address.getStreet(),
    };
    return this.create(`client/${clientId}/address`, data)
      .toPromise().then(response => {
        return response.code == RESPONSE_CODE_CREATED;
      }, error => {
        this.errorHandler(error);

        return false;
      });
  }

  public updateAddressByClientIdAndDTO(clientId: number, address: UpdateAddressDto): Promise<boolean> {
    const addressId = address.getAddressId();
    const data = {
      'zip_code': address.getZipCode(),
      'country': address.getCountry(),
      'city': address.getCity(),
      'street': address.getStreet(),
    };
    return this.update(`client/${clientId}/address/${addressId}`, data).toPromise().then(
      response => {
        return response.code == RESPONSE_CODE_SUCCESS;
      }, error => {
        this.errorHandler(error);

        return false;
      }
    );
  }

  public deleteAddressByClientIdAndAddressId(clientId: number, addressId: number): Promise<boolean> {
    return this.delete(`client/${clientId}/address/${addressId}`)
      .toPromise().then(response => {
        return true;
      }, error => {
        this.errorHandler(error);

        return false;
      });
  }
}
