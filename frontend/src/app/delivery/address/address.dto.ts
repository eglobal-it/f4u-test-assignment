export class CreateAddressDto {
  private clientId: number;
  private zipCode: string;
  private country: string;
  private city: string;
  private street: string;

  constructor(clientId: number, zipCode?: string, country?: string, city?: string, street?: string) {
    this.clientId = clientId;
    this.zipCode = zipCode;
    this.country = country;
    this.city = city;
    this.street = street;
  }

  getClientId(): number {
    return this.clientId;
  }

  getZipCode(): string {
    return this.zipCode;
  }

  getCountry(): string {
    return this.country;
  }

  getCity(): string {
    return this.city;
  }

  getStreet(): string {
    return this.street;
  }
}

export class UpdateAddressDto {
  private addressId: number;
  private zipCode: string;
  private country: string;
  private city: string;
  private street: string;

  constructor(addressId: number, zipCode: string, country: string, city: string, street: string) {
    this.addressId = addressId;
    this.zipCode = zipCode;
    this.country = country;
    this.city = city;
    this.street = street;
  }

  getAddressId(): number {
    return this.addressId;
  }

  getZipCode(): string {
    return this.zipCode;
  }

  getCountry(): string {
    return this.country;
  }

  getCity(): string {
    return this.city;
  }

  getStreet(): string {
    return this.street;
  }
}
