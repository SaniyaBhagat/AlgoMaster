  document.addEventListener("DOMContentLoaded", () => { 
  const arraySizeInput = document.getElementById("arr_sz");
  const newArrayBtn = document.querySelector(".newArray");
  const barsContainer = document.getElementById("bars");

  function createNewArray(size) {
    barsContainer.innerHTML = '';
    for (let i = 0; i < size; i++) {
      const div = document.createElement("div");
      div.className = "bar";
      div.innerText = Math.floor(Math.random() * 100) + 1;
      div.style.background = "lightblue";
      div.style.margin = "5px";
      div.style.padding = "15px";
      div.style.borderRadius = "50%";
      div.style.display = "inline-block";
      div.style.fontWeight = "bold";
      barsContainer.appendChild(div);
    }
  }

  newArrayBtn.addEventListener("click", () => {
    const size = parseInt(arraySizeInput.value);
    if (size > 0 && size <= 100) {
      createNewArray(size);
    } else {
      alert("Please enter a number between 1 and 100.");
    }
  });

  arraySizeInput.addEventListener("keydown", (e) => {
    if (e.key === "Enter") {
      const size = parseInt(arraySizeInput.value);
      if (size > 0 && size <= 100) {
        createNewArray(size);
      } else {
        alert("Please enter a number between 1 and 100.");
      }
    }
  });
  let delay = 100;

  document.querySelector("#speed_input").addEventListener("input", (e) => {
      delay = 320 - parseInt(e.target.value); 
  });
  

  createNewArray(parseInt(arraySizeInput.value) || 10);
});
