import React, { useEffect, useState } from "react";
import axios from "axios";

const MojeFotografije = () => {
  const [fotografije, setFotografije] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState("");

  useEffect(() => {
    const fetchFotografije = async () => {
      try {
        const token = localStorage.getItem("token");
        const response = await axios.get("/api/moje-fotografije", {
          headers: {
            Authorization: `Bearer ${token}`,
          },
        });

        console.log("API odgovor:", response.data.data);

        setFotografije(response.data.data); // Laravel resource kolekcija
      } catch (error) {
        console.error("Greška prilikom učitavanja fotografija", error);
        setError("Greška pri učitavanju fotografija.");
      } finally {
        setLoading(false);
      }
    };

    fetchFotografije();
  }, []);

  return (
    <div className="container mt-4">
      <h2 className="mb-4">Moje fotografije</h2>

      {loading && <p>Učitavanje...</p>}
      {error && <div className="alert alert-danger">{error}</div>}

      {fotografije.length === 0 && !loading ? (
        <p>Nema fotografija za prikaz.</p>
      ) : (
        <div className="row">
          {fotografije.map((fotografija) => (
            <div key={fotografija.id} className="col-md-4 mb-3">
              <div className="card h-100">
                <img
                  src={fotografija.slika}
                  alt={fotografija.naziv}
                  className="card-img-top"
                />
                <div className="card-body">
                  <h5 className="card-title">{fotografija.naziv}</h5>
                  <p className="card-text">{fotografija.opis}</p>
                  <p className="text-muted">
                    Tehnika: {fotografija.tehnika} | Datum: {fotografija.datum_kreiranja}
                  </p>
                </div>
              </div>
            </div>
          ))}
        </div>
      )}
    </div>
  );
};

export default MojeFotografije;



