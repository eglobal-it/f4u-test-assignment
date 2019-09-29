import {Component, Input, OnInit} from '@angular/core';
import {ClientService} from "../../client.service";
import {ClientEntityInterface} from "../../client.entity";
import {Location} from "@angular/common";

@Component({
  selector: 'user-client-detail',
  templateUrl: './detail.component.html',
  providers: [ClientService]
})

export class ClientDetailComponent implements OnInit {

  public isLoading: boolean = false;

  @Input() clientId: number;

  public client: ClientEntityInterface;

  constructor(private userService: ClientService, private location: Location) {
  }

  ngOnInit(): void {
    this.loadClient();
  }

  loadClient(): void {
    this.isLoading = true;

    this.userService.getClientById(this.clientId).then(data => {
      if (data == null) {
        this.location.back();
      }

      this.client = data;

      this.isLoading = false;
    })
  }
}
