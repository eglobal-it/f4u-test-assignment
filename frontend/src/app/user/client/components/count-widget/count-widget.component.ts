import {Component, OnInit} from '@angular/core';
import {ClientService} from "../../client.service";

@Component({
  selector: 'user-client-widget',
  templateUrl: './count-widget.component.html',
  providers: [ClientService]
})

export class CountWidgetClientComponent implements OnInit {
  private userService: ClientService;

  public isLoading: boolean = false;
  public countClients: number;

  constructor(userService: ClientService) {
    this.userService = userService;
  }

  ngOnInit(): void {
    this.loadCountClients();
  }

  private loadCountClients(): void {
    this.isLoading = true;
    this.userService.findClients().then(data => {
      this.countClients = data.length;
      this.isLoading = false;
    });
  }
}
