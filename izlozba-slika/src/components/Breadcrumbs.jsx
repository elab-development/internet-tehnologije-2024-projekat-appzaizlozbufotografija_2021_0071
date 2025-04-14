import React, { useEffect, useState } from 'react';
import { Link, useLocation } from 'react-router-dom';
import axios from 'axios';

function Breadcrumbs() {
  const location = useLocation();
  const pathnames = location.pathname.split('/').filter(x => x);

  const [nazivGalerije, setNazivGalerije] = useState(null);

  useEffect(() => {
    const galerijaIndex = pathnames.findIndex((segment, i) => segment === 'galerija' && pathnames[i + 1]);
    const galerijaId = galerijaIndex !== -1 ? pathnames[galerijaIndex + 1] : null;

    if (galerijaId) {
      const token = localStorage.getItem('token');
      axios.get(`http://localhost:8000/api/galerije/${galerijaId}`, {
        headers: { Authorization: `Bearer ${token}` }
      })
        .then(res => {
          const naziv = res.data.data?.naziv;
          if (naziv) setNazivGalerije(naziv);
        })
        .catch(err => console.error("Greška pri dohvaćanju naziva galerije:", err));
    }
  }, [location]);

  return (
    <nav aria-label="breadcrumb">
      <ol className="breadcrumb">
        <li className="breadcrumb-item">
          <Link to="/">Početna</Link>
        </li>

        {pathnames.map((segment, index) => {
          const routeTo = '/' + pathnames.slice(0, index + 1).join('/');
          const isLast = index === pathnames.length - 1;

          
          const isGalerijaId = pathnames[index - 1] === 'galerija' && !isNaN(segment);

          let displayName = decodeURIComponent(segment);
          if (isGalerijaId && nazivGalerije) {
            displayName = nazivGalerije;
          }

          // Veliko početno slovo
          displayName = displayName.charAt(0).toUpperCase() + displayName.slice(1);

          return (
            <li
              key={index}
              className={`breadcrumb-item ${isLast ? 'active' : ''}`}
              aria-current={isLast ? 'page' : undefined}
            >
              {isLast ? (
                displayName
              ) : (
                <Link to={routeTo}>{displayName}</Link>
              )}
            </li>
          );
        })}
      </ol>
    </nav>
  );
}

export default Breadcrumbs;




