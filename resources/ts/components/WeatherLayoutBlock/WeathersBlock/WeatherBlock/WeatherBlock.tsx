import './WeatherBlock.scss';
import React from 'react';
import IWeather from '../../../../@types/models/IWeather';

interface WeatherBlockProps {
  idx: number;
  weather: IWeather;
}

const WeatherBlock: React.FunctionComponent<WeatherBlockProps> = (
  props: WeatherBlockProps
) => {
  const w = props.weather;
  const localDate = new Date(w.timestamp_dt * 1000).toLocaleString();
  return (
    <tr className="weather-row" key={props.idx}>
      <td>
        <strong title={localDate}>{localDate}</strong>
      </td>
      <td>
        <strong title={String(w.min_tmp)}>{w.min_tmp}°C</strong>
      </td>
      <td>
        <strong title={String(w.max_tmp)}>{w.max_tmp}°C</strong>
      </td>
      <td>
        <strong title={String(w.wind_spd)}>{w.wind_spd}m/s</strong>
      </td>
    </tr>
  );
};

export default WeatherBlock;
