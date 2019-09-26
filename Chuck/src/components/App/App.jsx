import React, { useState, useEffect } from "react";
import CategoryList from "../Parts/category.jsx";
import Citaty from "../Parts/citaty.jsx";
import Citat from "../Parts/citat.jsx";
import CvicneMenu from "../Parts/cvicneMenu.jsx";

const App = () => {
  const [listCategory, setListCategory] = useState([]);
  const [citaty, setCitaty] = useState([]);
  const [search, setSearch] = useState("");
  const [display, setDisplay] = useState(false);
  const [citat, setCitat] = useState("");
  const [activeCategory, setActiveCategory] = useState("");

  useEffect(() => {
    fetchApi();
  }, []);

  // ******input form***************
  const handleTyping = e => {
    setSearch(e.target.value);
  };

  const handleSubmit = () => {
    fetch(`https://api.chucknorris.io/jokes/search?query=${search}`)
      .then(resp => resp.json())
      .then(data => {
        const seznamCitatu = data.result.slice(0, 25);
        setSearch("");
        setCitaty(
          seznamCitatu.map(e => {
            return e.value;
          })
        );
      })
      .catch(error => console.log(error));
  };

  // ************uvodni api call categorie
  const fetchApi = () => {
    fetch(`https://api.chucknorris.io/jokes/categories`)
      .then(resp => resp.json())
      .then(data => {
        setListCategory(data);
      });
  };
  // ********************api call random citatu
  const handleClick = e => {
    fetch(`https://api.chucknorris.io/jokes/random?category=${e}`)
      .then(resp => resp.json())
      .then(data => {
        setCitat(data.value);
        setDisplay(true);
        setActiveCategory(e);
      });
  };

  return (
    <>
      <h1>Chuck</h1>
      <h2>listen to the stories of the Chuck</h2>
      <div className="containerCitaty">
        <div className="categoryList">
          <h2>Check, how Chuck deal with all this stuff</h2>
          <CategoryList list={listCategory} handleClick={handleClick} />
        </div>
        <div className="monoCitatContainer">
          {display && (
            <Citat
              citat={citat}
              setCitat={setCitat}
              setDisplay={setDisplay}
              handleClick={handleClick}
              activeCategory={activeCategory}
            />
          )}{" "}
        </div>
      </div>
      <h2>Full search for Chuck awesomness</h2>
      <div className="input">
        <input type="text" action="" value={search} onChange={handleTyping} />
        <button onClick={handleSubmit}>Give me more wisdom</button>
      </div>
      <div>
        <Citaty citaty={citaty} />
      </div>

      <div>
        <CvicneMenu />
      </div>
    </>
  );
};

export default App;
