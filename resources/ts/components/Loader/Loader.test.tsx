import React from 'react';
import { act, render, screen } from '@testing-library/react';
import '@testing-library/jest-dom';
import Loader from './Loader';
import WeatherLayoutBlock from '../WeatherLayoutBlock/WeatherLayoutBlock';

describe('Loader', () => {
  it('renders the Loader component', async () => {
    let container: HTMLElement = null;
    await act(async () => {
      container = render(<Loader />).container;
    });
    expect(container.getElementsByClassName('loader').length).toBe(1);
  });
});
