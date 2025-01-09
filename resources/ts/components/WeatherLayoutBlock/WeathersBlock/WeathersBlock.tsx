import './WeathersBlock.scss';
import React from 'react';
import WeatherBlock from './WeatherBlock/WeatherBlock';
import IWeather from '../../../@types/models/IWeather';

interface CurrenciesBlockBlockProps {
  weathers: IWeather[];
}

const WeathersBlock: React.FunctionComponent<CurrenciesBlockBlockProps> = (
  props: CurrenciesBlockBlockProps
) => {
  return (
    <div className="weathers-container">
      <table className="table table-bordered weathers-table">
        <thead>
          <tr>
            <td>Datetime</td>
            <td>Min temp</td>
            <td>Max temp</td>
            <td>Wind speed</td>
          </tr>
        </thead>
        <tbody>
          {props.weathers.map((weather, idx) => (
            <WeatherBlock weather={weather} idx={idx} key={idx} />
          ))}
        </tbody>
      </table>
    </div>
  );
};

export default WeathersBlock;
