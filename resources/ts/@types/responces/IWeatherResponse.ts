import { IResponse } from './IResponse';
import { IWeather } from '../models/IWeather';

export interface IWeatherResponse extends IResponse {
  success: boolean;
  weathers: IWeather[];
}
