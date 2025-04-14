import React, { useState, useEffect } from "react";
import axios from "axios";

function DodajFotografiju() {
  const [formData, setFormData] = useState({
    naziv: "",
    opis: "",
    datum_kreiranja: "",
    tehnika: "",
    izlozba_id: "",
    slika: null,
  });
  const [poruka, setPoruka] = useState("");
  const [izlozbe, setIzlozbe] = useState([]);

  useEffect(() => {
    const token = localStorage.getItem("token");

    axios.get("/api/izlozbe", {
      headers: { Authorization: `Bearer ${token}` }
    })
    .then(res => setIzlozbe(res.data.data))
    .catch(() => setIzlozbe([]));
  }, []);

  const handleChange = (e) => {
    if (e.target.name === "slika") {
      setFormData({ ...formData, slika: e.target.files[0] });
    } else {
      setFormData({ ...formData, [e.target.name]: e.target.value });
    }
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    const token = localStorage.getItem("token");

    const podaci = new FormData();
    for (const key in formData) {
      podaci.append(key, formData[key]);
    }

    try {
      await axios.post("/api/fotografije", podaci, {
        headers: {
          "Content-Type": "multipart/form-data",
          Authorization: `Bearer ${token}`,
        },
      });
      setPoruka("Fotografija uspešno dodata!");
      setFormData({
        naziv: "",
        opis: "",
        datum_kreiranja: "",
        tehnika: "",
        izlozba_id: "",
        slika: null,
      });
    } catch (error) {
      console.error(error);
      setPoruka("Greška pri dodavanju fotografije!");
    }
  };

  return (
    <div className="container mt-5">
      <h2>Dodaj novu fotografiju</h2>
      {poruka && <div className="alert alert-info">{poruka}</div>}
      <form onSubmit={handleSubmit} encType="multipart/form-data">
        <div className="mb-3">
          <label className="form-label">Naziv</label>
          <input
            type="text"
            className="form-control"
            name="naziv"
            value={formData.naziv}
            onChange={handleChange}
            required
          />
        </div>

        <div className="mb-3">
          <label className="form-label">Opis</label>
          <textarea
            className="form-control"
            name="opis"
            value={formData.opis}
            onChange={handleChange}
            required
          ></textarea>
        </div>

        <div className="mb-3">
          <label className="form-label">Datum kreiranja</label>
          <input
            type="date"
            className="form-control"
            name="datum_kreiranja"
            value={formData.datum_kreiranja}
            onChange={handleChange}
            required
          />
        </div>

        <div className="mb-3">
          <label className="form-label">Tehnika</label>
          <input
            type="text"
            className="form-control"
            name="tehnika"
            value={formData.tehnika}
            onChange={handleChange}
            required
          />
        </div>

        <div className="mb-3">
          <label className="form-label">Izložba</label>
          <select
            className="form-select"
            name="izlozba_id"
            value={formData.izlozba_id}
            onChange={handleChange}
            required
          >
            <option value="">-- Izaberi izložbu --</option>
            {izlozbe.map((izl) => (
              <option key={izl.id} value={izl.id}>
                {izl.naziv}
              </option>
            ))}
          </select>
        </div>

        <div className="mb-4">
          <label className="form-label">Slika</label>
          <input
            type="file"
            className="form-control"
            name="slika"
            accept="image/*"
            onChange={handleChange}
            required
          />
        </div>

        <button type="submit" className="btn btn-success">Dodaj fotografiju</button>
      </form>
    </div>
  );
}

export default DodajFotografiju;
