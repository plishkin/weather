import './WeatherLayoutBlock.scss';
import React, { useState } from 'react';
import Loader from '../Loader/Loader';
import WeathersBlock from './WeathersBlock/WeathersBlock';
import { getApiWeather, getDbWeather } from '../../api/api';
import CityBlock from './CityBlock/CityBlock';
import IWeather from '../../@types/models/IWeather';
import Alert, { IAlert } from '../Alert/Alert';
import IFailResponse from '../../@types/responces/IFailResponse';
import { failAlert } from '../_utils/alerts';

const WeatherLayoutBlock: React.FunctionComponent = () => {
  const [loading, setLoading] = useState<boolean>(false);
  const [alert, setAlert] = useState<IAlert | null>(null);
  const [cityName, setCityName] = useState<string>('');
  const [weathers, setWeathers] = useState<IWeather[]>([]);

  const jacketClass = 'text-' + (weathers.length > 0 ? 'danger' : 'primary');

  const setDismissibleAlert = (alert: IAlert) => {
    const al: IAlert = {
      dismissible: true,
      dismiss: () => setAlert(null),
      ...alert
    };
    setAlert(al);
  };
  return (
    <div>
      <h2 className="text-center fst-italic mb-4 mt-3">
        <span className={jacketClass}>Jacket </span>
        or no
        <span className={jacketClass}> Jacket</span>
      </h2>

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
                setAlert(null);
                setLoading(true);
                getApiWeather(cityName, resp => {
                  if (resp.error) {
                    setAlert({
                      text: resp.error,
                      type: 'danger'
                    });
                  }
                  if (resp.weathers?.length > 0) {
                    setWeathers(resp.weathers);
                    setAlert(null);
                  }
                  setLoading(false);
                })
                  .then(resp => {
                    if (resp.success)
                      setAlert({
                        text: 'Waiting for response from api',
                        type: 'info'
                      });
                  })
                  .catch(err => {
                    setLoading(false);
                    const a = failAlert(err.response.data as IFailResponse);
                    setAlert(a);
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
                setAlert(null);
                setLoading(true);
                getDbWeather(cityName)
                  .then(resp => {
                    if (resp.weather) {
                      setWeathers([resp.weather]);
                    }
                    if (resp.error) {
                      setAlert({
                        text: resp.error,
                        type: 'danger'
                      });
                    }
                  })
                  .catch(e => {
                    setAlert(failAlert(e.response.data as IFailResponse));
                  })
                  .finally(() => setLoading(false));
              }}
            >
              Get from DB
            </span>
          </div>
        </div>
        {alert && <Alert {...alert} />}
        {loading && (
          <div className="weather-loader">
            <Loader height="100%" />
          </div>
        )}
        {!loading && weathers.length > 0 && (
          <>
            <hr />
            <CityBlock
              weathers={weathers}
              setLoading={setLoading}
              setAlert={setDismissibleAlert}
              setWeathers={setWeathers}
            />
            <WeathersBlock weathers={weathers} />
          </>
        )}
      </div>
    </div>
  );
};

export default WeatherLayoutBlock;
