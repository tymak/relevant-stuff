import React, { useState, useEffect } from "react";
import ListItem from "./ListItem.jsx";

const CvicneMenu = () => {
  let menu = ["Toto", "Je", "testovací", "Text"];
  const [polozka, setPolozka] = useState(null);

  const handlePolozka = i => {
    setPolozka(i);
    console.log(i);
  };

  let vnitrek = menu.map((e, index) => {
    return (
      <ListItem
        key={index}
        prvek={e}
        index={index}
        polozka={polozka}
        handlePolozka={handlePolozka}
      />
    );
  });
  return (
    <>
      <ul>{vnitrek}</ul>
    </>
  );
};
export default CvicneMenu;
