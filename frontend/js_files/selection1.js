
async function selection() {
    const ele = document.querySelectorAll(".bar");
    for (let i = 0; i < ele.length; i++) {
        let min_index = i;
        ele[i].style.background = "orange";
        for (let j = i + 1; j < ele.length; j++) {
            ele[j].style.background = "red";
            await new Promise(resolve => setTimeout(resolve, 100));
            if (parseInt(ele[j].innerText) < parseInt(ele[min_index].innerText)) {
                if (min_index !== i) ele[min_index].style.background = "lightblue";
                min_index = j;
            }
            ele[j].style.background = "lightblue";
        }
        let temp = ele[min_index].innerText;
        ele[min_index].innerText = ele[i].innerText;
        ele[i].innerText = temp;
        ele[min_index].style.background = "lightblue";
        ele[i].style.background = "green";
    }
}

document.querySelector(".selectionSort").addEventListener("click", async () => {
    await selection();
});