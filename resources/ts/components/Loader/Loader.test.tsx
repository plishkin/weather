import React from 'react';
import { act, render } from '@testing-library/react';
import '@testing-library/jest-dom';
import Loader from './Loader';

describe('Loader', () => {
  it('renders the Loader component', async () => {
    let container: HTMLElement = null;
    await act(async () => {
      container = render(<Loader />).container;
    });
    expect(container.getElementsByClassName('loader-cont').length).toBe(1);
    expect(container.getElementsByClassName('loader').length).toBe(1);
  });
});
