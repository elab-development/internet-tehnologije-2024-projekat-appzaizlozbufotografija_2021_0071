import React from 'react';
import { Link } from 'react-router-dom';

function Navbar() {
  return (
    <nav className="container">
      <ul style={{ display: 'flex', gap: '20px', listStyle: 'none' }}>
        <li><Link to="/">Početna</Link></li>
        <li><Link to="/izlozbe">Izložbe</Link></li>
        <li><Link to="/o-nama">O nama</Link></li>
      </ul>
    </nav>
  );
}

export default Navbar;