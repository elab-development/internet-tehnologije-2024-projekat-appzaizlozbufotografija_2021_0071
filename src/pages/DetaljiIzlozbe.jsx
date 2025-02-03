import React from 'react';
import { useParams } from 'react-router-dom';

function DetaljiIzlozbe() {
  const { id } = useParams();
  return (
    <div className="container">
      <h1>Detalji izložbe</h1>
      <p>ID izložbe: {id}</p>
    </div>
  );
}

export default DetaljiIzlozbe;