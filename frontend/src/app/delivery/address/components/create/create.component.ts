import {Component, EventEmitter, Input, OnInit, Output} from "@angular/core";
import {AddressService} from "../../address.service";
import {CreateAddressDto} from "../../address.dto";

@Component({
  selector: 'delivery-address-create',
  templateUrl: './create.component.html',
  providers: [AddressService]
})

export class CreateAddressComponent implements OnInit {
  @Input() @Output() clientId: number;
  @Output() dto: object;

  @Output() onSubmitForm: EventEmitter<object> = new EventEmitter<object>();
  @Output() onCloseForm: EventEmitter<object> = new EventEmitter<object>();

  constructor(private addressService: AddressService) {
  }

  ngOnInit(): void {
    this.createDto();
  }


  private createDto() {
    this.dto = new CreateAddressDto(this.clientId);
  }

  public onSubmit(dto: CreateAddressDto) {
    this.onSubmitForm.emit(this.dto);
  }

  public onClose() {
    this.onCloseForm.emit(this.dto);
  }
}
