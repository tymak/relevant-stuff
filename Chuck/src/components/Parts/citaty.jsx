import React from "react";

const Citaty = ({ citaty }) => {
  const vystup = citaty.map((e, index) => {
    return <li key={index}>{e}</li>;
  });

  return (
    <>
      <ul>{vystup}</ul>
    </>
  );
};
export default Citaty;
