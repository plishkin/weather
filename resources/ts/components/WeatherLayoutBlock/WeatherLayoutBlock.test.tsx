import { vi, describe, it } from 'vitest';
import React from 'react';
import { act, render } from '@testing-library/react';
import '@testing-library/jest-dom';
import WeatherLayoutBlock from './WeatherLayoutBlock';
import axios from 'axios';
import { IWeatherJson } from '../../models/IWeather';

vi.mock('axios');

describe('WeatherLayoutBlock', () => {
  it('renders the WeatherLayoutBlock component', async () => {
    vi.mocked(axios, true).get.mockResolvedValueOnce({
      data: { iso4217: [], weathers: [] } as IWeatherJson
    });

    let container: HTMLElement = null;
    await act(async () => {
      container = render(<WeatherLayoutBlock />).container;
    });
    // screen.debug(); // prints out the jsx in the App component unto the command line
    expect(container.getElementsByClassName('weathers-layout').length).toBe(1);
  });
});
