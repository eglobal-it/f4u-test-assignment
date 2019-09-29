export interface AddressEntityInterface {
  getId(): number;

  getZipCode(): string;

  getCountry(): string;

  getCity(): string;

  getStreet(): string;

  isDefault(): boolean;
}

export class AddressEntity implements AddressEntityInterface {
  private _id: number;
  private _zipCode: string;
  private _country: string;
  private _city: string;
  private _street: string;
  private _isDefault: boolean;

  constructor(id: number, zipCode: string, country: string, city: string, street: string, isDefault: boolean) {
    this._id = id;
    this._zipCode = zipCode;
    this._country = country;
    this._city = city;
    this._street = street;
    this._isDefault = isDefault;
  }

  getId(): number {
    return this._id;
  }

  getZipCode(): string {
    return this._zipCode;
  }

  getCountry(): string {
    return this._country;
  }

  getCity(): string {
    return this._city;
  }

  getStreet(): string {
    return this._street;
  }

  isDefault(): boolean {
    return this._isDefault;
  }
}
