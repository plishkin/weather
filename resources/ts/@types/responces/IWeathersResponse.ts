import { IResponse } from './IResponse';
import { IWeather } from '../models/IWeather';

export interface IWeathersResponse extends IResponse {
  weathers: IWeather[];
}
