import IResponse from './IResponse';
import IWeather from '../models/IWeather';

export default interface IWeatherResponse extends IResponse {
  weather: IWeather;
  error: string;
}
