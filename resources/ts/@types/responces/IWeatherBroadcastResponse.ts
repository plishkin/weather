import IResponse from './IResponse';
import IWeather from '../models/IWeather';

export default interface IWeatherBroadcastResponse extends IResponse {
  weathers: IWeather[];
}
