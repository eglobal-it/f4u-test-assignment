export interface ClientEntityInterface {
  getId(): number

  getFirstName(): string;

  getLastName(): string;
}

export interface HttpResponseInterface {
  code: string;
  data?: any | DataList;
  message?: string;
  errors?: object;
}

export const RESPONSE_CODE_SUCCESS = 'SUCCESS';
export const RESPONSE_CODE_VALIDATE_ERROR = 'VALIDATE_ERROR';
export const RESPONSE_CODE_INTERNAL_ERROR = 'INTERNAL_ERROR';
export const RESPONSE_CODE_NOT_FOUND = 'NOT_FOUND';
export const RESPONSE_CODE_NO_CONTENT = 'NO_CONTENT';
export const RESPONSE_CODE_CREATED = 'CREATED';

export interface DataList {
  list: [];
}
