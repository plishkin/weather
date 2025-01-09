import IResponse from './IResponse';
import IWeather from '../models/IWeather';

export default interface IWeathersResponse extends IResponse {
  weathers: IWeather[];
}
