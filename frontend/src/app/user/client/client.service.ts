import {Injectable} from "@angular/core";
import {ClientEntityInterface} from "./client.entity";
import {ClientFetcher} from "./client.fetcher";

export interface ClientServiceInterface {
  findClients(): Promise<ClientEntityInterface[]>;

  getClientById(clientId: number): Promise<ClientEntityInterface>;
}

@Injectable({providedIn: "root"})
export class ClientService implements ClientServiceInterface {
  private clientFetcher: ClientFetcher;

  constructor(clientFetcher: ClientFetcher) {
    this.clientFetcher = clientFetcher;
  }

  findClients(): Promise<ClientEntityInterface[]> {
    return this.clientFetcher.getClients();
  }

  getClientById(clientId: number): Promise<ClientEntityInterface> {
    return this.clientFetcher.getClientById(clientId);
  }
}
