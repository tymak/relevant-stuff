import React from "react";

const ListItem = ({ prvek, index, polozka, handlePolozka }) => {
  const activated = index => {
    let text = null;
    if (polozka === index) {
      text = "Yup";
    }
    return text;
  };

  return (
    <>
      <li>
        <div>{prvek}</div>
        <div>
          <button
            onClick={() => {
              handlePolozka(index);
            }}
          >
            Aktivovat
          </button>
          <button
            onClick={() => {
              handlePolozka(null);
            }}
          >
            Deaktivovat
          </button>
        </div>

        <div>{activated(index)}</div>
      </li>
    </>
  );
};
export default ListItem;
