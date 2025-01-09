import axios from 'axios';
import useBroadcast from '../hooks/useBroadcast';
import IWeather from '../@types/models/IWeather';
import IWeatherBroadcastResponse from '../@types/responces/IWeatherBroadcastResponse';
import IWeathersResponse from '../@types/responces/IWeathersResponse';
import { sendPostRequest } from './utils';

export const getApiWeather = async (
  cityName: string,
  broadcastHandler: (resp: IWeatherBroadcastResponse) => void
) => {
  const { listen } = useBroadcast();

  return sendPostRequest({
    url: '/weather/api',
    data: { cityName }
  }).then(response => {
    if (response.success) {
      listen('weather', 'WeatherBroadcastEvent', broadcastHandler);
    }
    return response;
  });
};

export const getDbWeather = (cityName: string) => {
  return sendPostRequest({
    url: '/weather/db',
    data: { cityName }
  }).then(resp => resp as IWeathersResponse);
};

export const saveWeather: (weather: IWeather) => Promise<IWeathersResponse> = (
  weather: IWeather
) => {
  return sendPostRequest({
    url: '/weather/save',
    data: { ...weather }
  }).then(resp => resp as IWeathersResponse);
};
