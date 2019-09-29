import {Component, EventEmitter, Input, OnInit, Output} from "@angular/core";
import {AddressService} from "../../address.service";
import {AddressEntityInterface} from "../../address.entity";
import {UpdateAddressDto} from "../../address.dto";

@Component({
  selector: 'delivery-address-edit',
  templateUrl: './edit.component.html',
  providers: [AddressService]
})

export class EditAddressComponent implements OnInit {
  @Input() @Output() clientId: number;
  @Input() @Output() address: AddressEntityInterface;
  @Output() dto: object;

  @Output() onSubmitForm: EventEmitter<object> = new EventEmitter<object>();
  @Output() onCloseForm: EventEmitter<object> = new EventEmitter<object>();

  constructor(private addressService: AddressService) {
  }

  ngOnInit(): void {
    this.createDto();
  }


  private createDto() {
    this.dto = new UpdateAddressDto(
      this.address.getId(),
      this.address.getZipCode(),
      this.address.getCountry(),
      this.address.getCity(),
      this.address.getStreet()
    );
  }

  public onSubmit(dto: UpdateAddressDto) {
    this.onSubmitForm.emit(this.dto);
  }

  public onClose() {
    this.onCloseForm.emit(this.dto);
  }
}
