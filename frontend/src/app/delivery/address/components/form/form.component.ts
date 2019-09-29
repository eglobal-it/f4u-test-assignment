import {Component, EventEmitter, Input, OnInit, Output} from "@angular/core";
import {AddressService} from "../../address.service";
import {NgForm} from "@angular/forms";
import {ToastService} from "../../../../common/toast.service";

@Component({
  selector: 'delivery-address-form',
  templateUrl: './form.component.html',
  styles: [`
      input.ng-touched.ng-invalid {border:solid red 2px;}
      input.ng-touched.ng-valid {border:solid green 2px;}
  `],
  providers: [AddressService]
})

export class FormAddressComponent implements OnInit {
  @Input() clientId: number;
  @Input() addressId?: number;
  @Input() dto: object;

  @Output() onSubmitForm: EventEmitter<object> = new EventEmitter<object>();
  @Output() onCloseForm: EventEmitter<any> = new EventEmitter<any>();

  constructor(private toast: ToastService) {
  }

  ngOnInit(): void {
  }

  public onSubmit(ngForm: NgForm) {
    if (!ngForm.invalid) {
      this.onSubmitForm.emit(this.dto);
    } else {
      this.toast.showDanger('Invalid form');
    }
  }

  public onClose() {
    this.onCloseForm.emit(this.dto);
  }
}
