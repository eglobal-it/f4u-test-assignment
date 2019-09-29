import {HttpClient, HttpErrorResponse, HttpHeaders} from "@angular/common/http";
import {Injectable} from "@angular/core";
import {Observable} from "rxjs";
import {environment} from "../../environments/environment";
import {map} from "rxjs/operators";
import {ToastService} from "./toast.service";
import {
  HttpResponseInterface,
  RESPONSE_CODE_CREATED,
  RESPONSE_CODE_INTERNAL_ERROR,
  RESPONSE_CODE_NO_CONTENT,
  RESPONSE_CODE_NOT_FOUND,
  RESPONSE_CODE_SUCCESS,
  RESPONSE_CODE_VALIDATE_ERROR
} from "./common.entity";
import {NgxSpinnerService} from "ngx-spinner";

export interface FetcherServiceInterface {

}

@Injectable()
export abstract class BaseFetcher implements FetcherServiceInterface {
  private apiUrl = `${environment.apiUrl}/`;

  private httpOptions = {
    headers: new HttpHeaders({'Content-Type': 'application/json'})
  };

  constructor(private http: HttpClient, private toast: ToastService, private spinner: NgxSpinnerService) {
  }

  public getOne(url: string): Observable<HttpResponseInterface> {
    this.spinner.show();

    return this.http.get(this.apiUrl + url, this.httpOptions).pipe(map(data => {
      return this.successHandler(data as HttpResponseInterface);
    }));
  }

  public getList(url: string): Observable<HttpResponseInterface> {
    this.spinner.show();

    return this.http.get(this.apiUrl + url, this.httpOptions).pipe(map(data => {
      return this.successHandler(data as HttpResponseInterface);
    }));
  }

  public update(url: string, data: any): Observable<HttpResponseInterface> {
    this.spinner.show();

    return this.http.put(this.apiUrl + url, data, this.httpOptions).pipe(map(data => {
      return this.successHandler(data as HttpResponseInterface);
    }));
  }

  public create(url: string, data: any): Observable<HttpResponseInterface> {
    this.spinner.show();

    return this.http.post(this.apiUrl + url, data, this.httpOptions).pipe(map(data => {
      return this.successHandler(data as HttpResponseInterface);
    }));
  }

  public delete(url: string): Observable<HttpResponseInterface> {
    this.spinner.show();

    return this.http.delete(this.apiUrl + url, this.httpOptions).pipe(map(data => {
      return this.successHandler(data as HttpResponseInterface);
    }));
  }

  public successHandler(response: HttpResponseInterface): HttpResponseInterface {
    if (response != null) {
      let index = [RESPONSE_CODE_SUCCESS, RESPONSE_CODE_CREATED, RESPONSE_CODE_NO_CONTENT].indexOf(response.code);
      if (index == -1) {
        this.errorResponseHandler(response);
        return response;
      }
    }

    this.spinner.hide();

    return response;
  }

  public errorResponseHandler(error: HttpResponseInterface) {
    let errorText = 'Error';

    switch (error.code) {
      case RESPONSE_CODE_VALIDATE_ERROR:
        errorText = 'Validation error';
        break;
      case RESPONSE_CODE_NOT_FOUND:
        errorText = 'Not Found';
        break;
      case RESPONSE_CODE_INTERNAL_ERROR:
        errorText = error.message;
        break;
    }
    this.spinner.hide();
    this.toast.showDanger(errorText);
  }

  public errorHandler(error: HttpErrorResponse) {
    return this.errorResponseHandler(error.error);
  }
}
