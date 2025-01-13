import IResponse from './IResponse';
import IWeather from '../models/IWeather';

export default interface IWeatherBroadcastResponse extends IResponse {
  cityName: string;
  weathers: IWeather[];
  error: string;
}
