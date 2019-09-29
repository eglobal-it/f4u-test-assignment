import {Component, OnInit} from '@angular/core';
import {ActivatedRoute} from "@angular/router";

@Component({
  selector: 'client-detail',
  templateUrl: './detail.component.html'
})

export class ClientsDetailPageComponent implements OnInit {
  public clientId;

  constructor(private route: ActivatedRoute) {
  }

  ngOnInit() {
    this.clientId = this.route.snapshot.paramMap.get('clientId');
  }
}
