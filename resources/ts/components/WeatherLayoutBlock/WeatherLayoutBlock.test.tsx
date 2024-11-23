import { vi, describe, it } from 'vitest';
import React from 'react';
import { act, render } from '@testing-library/react';
import '@testing-library/jest-dom';
import WeatherLayoutBlock from './WeatherLayoutBlock';

vi.mock('axios');

describe('WeatherLayoutBlock', () => {
  it('renders the WeatherLayoutBlock component', async () => {
    let container: HTMLElement = null;
    await act(async () => {
      container = render(<WeatherLayoutBlock />).container;
    });
    expect(container.getElementsByClassName('weathers-layout').length).toBe(1);
  });
});
