import {Component, OnInit} from '@angular/core';
import {ClientService} from "../../client.service";
import {ClientEntityInterface} from "../../client.entity";

@Component({
  selector: 'user-client-list',
  templateUrl: './list.component.html',
  providers: [ClientService]
})

export class ClientListComponent implements OnInit {

  public clients: ClientEntityInterface[];

  public isLoading: boolean = false;

  constructor(private userService: ClientService) {
    this.userService = userService;
  }

  ngOnInit(): void {
    this.loadClients();
  }

  private loadClients(): void {
    this.isLoading = true;
    this.userService.findClients().then(data => {
      this.clients = data;
      this.isLoading = false;
    });
  }
}
