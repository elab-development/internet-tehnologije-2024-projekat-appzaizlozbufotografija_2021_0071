import React from 'react';
import { Routes, Route } from 'react-router-dom';
import Navbar from './components/Navbar'; // Navigacioni meni
import Pocetna from './pages/Pocetna';
import Izlozbe from './pages/Izlozbe';
import DetaljiIzlozbe from './pages/DetaljiIzlozbe';
import PrijavaNaIzlozbu from './pages/PrijavaNaIzlozbu';
import ONama from './pages/ONama';
import Greska from './pages/Greska';

function App() {
  return (
    <div>
      <Navbar />
      <Routes>
        <Route path="/" element={<Pocetna />} />
        <Route path="/izlozbe" element={<Izlozbe />} />
        <Route path="/izlozba/:id" element={<DetaljiIzlozbe />} />
        <Route path="/prijava/:id" element={<PrijavaNaIzlozbu />} />
        <Route path="/o-nama" element={<ONama />} />
        <Route path="*" element={<Greska />} />
      </Routes>
    </div>
  );
}

export default App;