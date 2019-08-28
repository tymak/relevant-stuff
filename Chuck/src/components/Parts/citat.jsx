import React from "react";

const Citat = ({ citat, setCitat, setDisplay, activeCategory }) => {
  const refresh = () => {
    fetch(`https://api.chucknorris.io/jokes/random?category=${activeCategory}`)
      .then(resp => resp.json())
      .then(data => {
        setCitat(data.value);
      });
  };

  return (
    <>
      <div>
        <div className="monoCitat">{citat}</div>
        <div className="buttons">
          <button
            onClick={() => {
              setDisplay(false);
            }}
          >
            Close
          </button>
          <button onClick={refresh}>One more</button>
        </div>
      </div>
    </>
  );
};
export default Citat;
