const vypis = () => {
  const kroky = document.querySelector(".kroky");
  kroky.innerHTML = `Pocet tahů: ${k}`;
  k++;
};

const akce = (plocha, x, y, color = 10) => {
  plocha.value[x][y][0] = color;

  const zmena = document.querySelector(`#id${plocha.value[x][y][2]}`);
  zmena.className = `class${plocha.value[x][y][0]}`;
  plocha.value[x][y][3] = 1;
  plocha.value[x][y][1] = 0;

  // console.log(((plocha.value[x+1][y][0]==plocha.value[x][y][0]) || (plocha.value[x+1][y][3]==1 )))
  // console.log(plocha.value[x+1][y][0]);
  // console.log(plocha.value[x][y][0]);
  // ;console.log(plocha.value[x+1][y][3]==1 );

  if (
    x < plocha.weight - 1 &&
    plocha.value[x + 1][y][1] == 1 &&
    (plocha.value[x + 1][y][0] == plocha.value[x][y][0] ||
      plocha.value[x + 1][y][3] == 1)
  ) {
    akce(plocha, x + 1, y, color);
  }
  if (
    x > 0 &&
    plocha.value[x - 1][y][1] == 1 &&
    (plocha.value[x - 1][y][0] == plocha.value[x][y][0] ||
      plocha.value[x - 1][y][3] == 1)
  ) {
    akce(plocha, x - 1, y, color);
  }
  if (
    y < plocha.height - 1 &&
    plocha.value[x][y + 1][1] == 1 &&
    (plocha.value[x][y + 1][0] == plocha.value[x][y][0] ||
      plocha.value[x][y + 1][3] == 1)
  ) {
    akce(plocha, x, y + 1, color);
  }
  if (
    y > 0 &&
    plocha.value[x][y - 1][1] == 1 &&
    (plocha.value[x][y - 1][0] == plocha.value[x][y][0] ||
      plocha.value[x][y - 1][3] == 1)
  ) {
    akce(plocha, x, y - 1, color);
  }
};

const reaktivace = plocha => {
  for (let i = 0; i < plocha.weight; i++) {
    for (let j = 0; j < plocha.height; j++) {
      plocha.value[i][j][1] = 1;
    }
  }
};
