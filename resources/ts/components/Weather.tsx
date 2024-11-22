import React from 'react';
import { createRoot } from 'react-dom/client';
import WeatherLayoutBlock from './WeatherLayoutBlock/WeatherLayoutBlock';

const container = document.getElementById('root');
if (container) {
  const root = createRoot(container);
  root.render(<WeatherLayoutBlock />);
}
