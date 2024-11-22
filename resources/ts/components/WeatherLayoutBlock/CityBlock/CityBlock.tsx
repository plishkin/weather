import './CityBlock.scss';
import React from 'react';
import { saveWeather } from '../../../api/api';
import { IWeather } from '../../../@types/models/IWeather';
import { IAlert } from '../../Alert/Alert';

interface CityBlockProps {
  weathers: IWeather[];
  setLoading: (b: boolean) => void;
  setAlert: (alert: IAlert) => void;
}

const CityBlock: React.FunctionComponent<CityBlockProps> = (
  props: CityBlockProps
) => {
  const firstWeather = props.weathers[0];
  const lastWeather = props.weathers[props.weathers.length - 1];
  const cityName = firstWeather.city_name;
  const start = new Date(firstWeather.timestamp_dt * 1000).toLocaleString();
  const end = new Date(lastWeather.timestamp_dt * 1000).toLocaleString();

  return (
    <div className="border border-gray-200 p-3 mb-4 city-block">
      <h1>{cityName}</h1>
      <h3>Period</h3>
      <h6>Starts at {start}</h6>
      <h6>Ends at {end}</h6>
      <div className="mt-3">
        <span
          className="btn btn-success"
          onClick={() => {
            props.setLoading(true);
            saveWeather(firstWeather)
              .then(resp => {
                props.setLoading(false);
                if (resp.success) {
                  props.setAlert({
                    text: 'Saved successfully',
                    type: 'success',
                    dismissible: true
                  });
                } else {
                  props.setAlert({
                    text: 'There were error saving weather',
                    type: 'danger',
                    dismissible: true
                  });
                }
              })
              .catch(er => {
                props.setAlert({
                  text: String(er),
                  type: 'danger',
                  dismissible: true
                });
              });
          }}
        >
          Save forecast
        </span>
      </div>
    </div>
  );
};

export default CityBlock;
