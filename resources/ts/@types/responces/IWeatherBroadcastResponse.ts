import { IResponse } from './IResponse';
import { IWeather } from '../models/IWeather';

export interface IWeatherBroadcastResponse extends IResponse {
  weathers: IWeather[];
}
