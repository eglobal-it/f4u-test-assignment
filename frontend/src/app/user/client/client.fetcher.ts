import {Injectable} from "@angular/core";
import {Client, ClientEntityInterface} from "./client.entity";
import {BaseFetcher} from "../../common/fetcher.service";

@Injectable()
export class ClientFetcher extends BaseFetcher {

  public getClients(): Promise<ClientEntityInterface[]> {
    return this.getList('client').toPromise().then(response => {
      return response.data.list.map(function (item: any) {
        return new Client(item.id, item.first_name, item.last_name);
      })
    }, error => {
      this.errorHandler(error);

      return [];
    });
  }

  public getClientById(clientId: number): Promise<ClientEntityInterface> {
    return this.getOne(`client/${clientId}`).toPromise().then(response => {
      return new Client(response.data.id, response.data.first_name, response.data.last_name);
    }, error => {
      this.errorHandler(error);

      return null;
    });
  }
}
