import React from 'react';
import { render, screen } from '@testing-library/react';
import '@testing-library/jest-dom';
import Alert from './Alert';

describe('Loader', () => {
  it('renders the Loader component', () => {
    render(<Alert />);

    // screen.debug(); // prints out the jsx in the App component unto the command line
  });
});
