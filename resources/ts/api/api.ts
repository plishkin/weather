import axios from 'axios';
import { useBroadcast } from '../hooks/useBroadcast';
import { IWeather } from '../@types/models/IWeather';
import { IWeatherBroadcastResponse } from '../@types/responces/IWeatherBroadcastResponse';
import { IWeathersResponse } from '../@types/responces/IWeathersResponse';
import { IResponse } from '../@types/responces/IResponse';

export const getApiWeather: (cityName: string) => Promise<IWeather[]> = (
  cityName: string
) => {
  const { listen } = useBroadcast();

  return new Promise((resolve, reject) => {
    axios.post('/weather/api', { cityName }).then(resp => {
      listen('weather', 'WeatherBroadcastEvent', (data: object) => {
        resolve((data as IWeatherBroadcastResponse).weathers);
      });
    });
  });
};

export const getDbWeather = (cityName: string) => {
  return axios
    .post('/weather/db', { cityName })
    .then(resp => (resp.data as IWeathersResponse).weathers);
};

export const saveWeather: (weather: IWeather) => Promise<IWeathersResponse> = (
  weather: IWeather
) => {
  return axios
    .post('/weather/save', { ...weather })
    .then(resp => resp.data as IWeathersResponse);
};
