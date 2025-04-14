import React, { useState } from "react";
import axios from "axios";
import { useNavigate } from "react-router-dom";

function UlogujSe() {
  const [formData, setFormData] = useState({
    email: "",
    lozinka: "",
  });
  const [poruka, setPoruka] = useState("");
  const navigate = useNavigate();

  const handleChange = (e) => {
    setFormData({ ...formData, [e.target.name]: e.target.value });
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    try {
      // API poziv za login
      const response = await axios.post("/api/login", formData);

      console.log("API odgovor:", response.data);

      // Provera da li uloga postoji u odgovoru API-ja
      if (!response.data.korisnik || !response.data.korisnik.uloga) {
        throw new Error("Greška: API nije vratio ulogu korisnika.");
      }

      // 🔹 Očisti ceo localStorage pre nego što postaviš novu ulogu
      localStorage.removeItem("role"); 

      // Sačuvaj JWT token i novu ulogu korisnika
      localStorage.setItem("token", response.data.token);
      localStorage.setItem("role", response.data.korisnik.uloga);

      console.log("Finalna vrednost u localStorage:", localStorage.getItem("role")); // Debugging

      

      // Pokreni event koji Navbar može da osluškuje i odmah osveži stanje
      window.dispatchEvent(new Event("storage"));

      setPoruka("Uspešno ste se prijavili!");

      // Redirekcija na osnovu uloge korisnika
      const role = response.data.korisnik.uloga;
      console.log("Uloga korisnika:", role);


      setTimeout(() => {
        if (role === "ADMINISTRATOR") {
          console.log("Administrator je ulogovan");
          navigate("/pregled-korisnika");
        } else if (role === "UMETNIK") {
          console.log("Umetnik je ulogovan");
          navigate("/umetnik/moje-fotografije");
        } else {
          console.log("Posetilac je ulogovan");
          navigate("/");
        }

        // 🔹 Ako problem i dalje postoji, osveži stranicu kako bi se `localStorage` učitao ispravno
        window.location.reload();

      }, 100); // Kratko kašnjenje da bi se osiguralo da se `localStorage` ažurira pre navigacije.

    } catch (error) {
      console.error("Greška pri prijavi:", error);
      setPoruka("Greška pri prijavi! Proverite email i lozinku.");
    }
  };

  return (
    <div className="container mt-5">
      <h2>Uloguj se</h2>
      {poruka && <div className="alert alert-info">{poruka}</div>}
      <form onSubmit={handleSubmit}>
        <div className="mb-3">
          <label className="form-label">Email</label>
          <input
            type="email"
            className="form-control"
            name="email"
            value={formData.email}
            onChange={handleChange}
            required
          />
        </div>
        <div className="mb-3">
          <label className="form-label">Lozinka</label>
          <input
            type="password"
            className="form-control"
            name="lozinka"
            value={formData.lozinka}
            onChange={handleChange}
            required
          />
        </div>
        <button type="submit" className="btn btn-primary">Prijavi se</button>
      </form>
      <p className="mt-3">
        Nemate nalog?{" "}
        <button
          className="btn btn-link"
          onClick={() => navigate("/registracija")}
        >
          Registrujte se
        </button>
      </p>
    </div>
  );
}

export default UlogujSe;

