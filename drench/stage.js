class Stage {
  constructor(weight, height, value) {
    this.weight = weight;
    this.height = height;
    this.value = value;
  }
  mount(parent) {
    parent.appendChild(this.inicializace());
  }
  random() {
    return Math.floor(Math.random() * 6 + 1);
  }

  inicializace(reset = null) {
    this.value = [];
    for (let i = 0; i < this.weight; i++) {
      this.value[i] = [];
      for (let j = 0; j < this.height; j++) {
        this.value[i][j] = [];
        const color_index = Math.floor(Math.random() * 6 + 1);
        this.value[i][j][0] = [color_index]; //color
        this.value[i][j][1] = [1]; //uvodni aktivace
        this.value[i][j][2] = [this.weight * i + j]; //id
        this.value[i][j][3] = 0; //moznost prebarveni
        if (!reset) {
          this.element = document.createElement("div");
        } else {
          this.element = document.querySelector(`#id${this.value[i][j][2]}`);
        }

        // this.element.textContent=this.value[i][j][0];

        this.element.className = `class${color_index}`;
        this.element.id = `id${this.value[i][j][2]}`;
        document.querySelector(".stage").appendChild(this.element);
      }
    }
  }
}
