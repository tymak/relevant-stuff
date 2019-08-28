import React, { useState } from "react";
import Citat from "./citat.jsx";

const CategoryList = ({ list, handleClick }) => {
  const seznam = list.map((e, index) => {
    return (
      <li key={index} className="polozka">
        <div className="nadpis">{e}</div>
        <button
          className="categoryListButton"
          onClick={() => {
            handleClick(e);
          }}
        >
          {`Give me Chuck's wisdom about ${e}`}
        </button>
      </li>
    );
  });

  return (
    <>
      <ul>{seznam}</ul>
    </>
  );
};

export default CategoryList;
