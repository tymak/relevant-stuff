let k = 1; //global step counter

document.addEventListener("DOMContentLoaded", () => {
  const plocha = new Stage(14, 14);

  plocha.inicializace();
  barva = document.querySelector("#id0");
  uvodniBarva = barva.className[barva.className.length - 1];

  akce(plocha, 0, 0, uvodniBarva);
  reaktivace(plocha);

  for (let i = 1; i < 7; i++) {
    const cudlik = document.querySelector(`#button${i}`);
    cudlik.addEventListener("click", () => {
      akce(plocha, 0, 0, i);
      reaktivace(plocha);
      vypis();
    });
  }

  const cudlik = document.querySelector(`#button7`);
  cudlik.addEventListener("click", () => {
    plocha.inicializace(1);
    barva = document.querySelector("#id0");
    uvodniBarva = barva.className[barva.className.length - 1];
    k = 0;
    akce(plocha, 0, 0, uvodniBarva);
    reaktivace(plocha);
    vypis();
  });
});
