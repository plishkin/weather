import './WeatherLayoutBlock.scss';
import React, { useState } from 'react';
import Loader from '../Loader/Loader';
import WeathersBlock from './WeathersBlock/WeathersBlock';
import { getApiWeather, getDbWeather } from '../../api/api';
import CityBlock from './CityBlock/CityBlock';
import { IWeather } from '../../@types/models/IWeather';
import Alert, { IAlert } from '../Alert/Alert';

const WeatherLayoutBlock: React.FunctionComponent = () => {
  const [loading, setLoading] = useState<boolean>(false);
  const [alert, setAlert] = useState<IAlert | null>(null);
  const [cityName, setCityName] = useState<string>('');
  const [weathers, setWeathers] = useState<IWeather[]>([]);

  const jacketClass = 'text-' + (weathers.length > 0 ? 'danger' : 'primary');

  return (
    <div>
      <h2 className="text-center fst-italic mb-4 mt-3">
        <span className={jacketClass}>Jacket </span>
        or no
        <span className={jacketClass}> Jacket</span>
      </h2>
      {loading && (
        <div className="weather-loader">
          <Loader height="100%" />
        </div>
      )}
      {!loading && (
        <div className="weathers-layout">
          <div className="row">
            <div className="col-md-6">
              <div className="mb-3">
                <input
                  type="text"
                  className="form-control"
                  placeholder="Enter city name (E.g. New York)"
                  defaultValue={cityName}
                  onChange={e => setCityName(e.target.value)}
                />
              </div>
            </div>
            <div className="col-md-3">
              <span
                className="btn btn-primary mb-3 w-100"
                onClick={() => {
                  setLoading(true);
                  getApiWeather(cityName).then(weathers => {
                    setLoading(false);
                    setWeathers(weathers);
                  });
                }}
              >
                Get from API
              </span>
            </div>
            <div className="col-md-3">
              <span
                className="btn btn-warning mb-3 w-100"
                onClick={() => {
                  setLoading(true);
                  getDbWeather(cityName).then(weathers => {
                    setLoading(false);
                    setWeathers(weathers);
                  });
                }}
              >
                Get from DB
              </span>
            </div>
          </div>
          {alert && <Alert {...alert} />}
          {weathers.length > 0 && (
            <>
              <hr />
              <CityBlock
                weathers={weathers}
                setLoading={setLoading}
                setAlert={setAlert}
              />
              <WeathersBlock weathers={weathers} />
            </>
          )}
        </div>
      )}
    </div>
  );
};

export default WeatherLayoutBlock;
