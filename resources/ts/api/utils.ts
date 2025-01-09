import axios from 'axios';
import IResponse from '../@types/responces/IResponse';
import IRequestParams from '../@types/responces/IRequestParams';
import IFailResponse from '../@types/responces/IFailResponse';

export const sendPostRequest = (params: IRequestParams) => {
  return axios
    .post(params.url, params.data)
    .then(resp => resp.data as IResponse);
};
