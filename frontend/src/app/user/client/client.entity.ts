import {ClientEntityInterface as CommonClientEntityInterface} from "../../common/common.entity";

export interface ClientEntityInterface extends CommonClientEntityInterface {
}

export class Client implements ClientEntityInterface {
  private _id: number;
  private _firstName: string;
  private _lastName: string;

  constructor(id: number, firstName: string, lastName: string) {
    this._id = id;
    this._firstName = firstName;
    this._lastName = lastName;
  }

  getId(): number {
    return this._id;
  }

  getFirstName(): string {
    return this._firstName;
  }

  getLastName(): string {
    return this._lastName;
  }
}
