async function insertion() {
    const ele = document.querySelectorAll(".bar");
    ele[0].style.background = "green";
    for (let i = 1; i < ele.length; i++) {
        let j = i - 1;
        let key = ele[i].innerText;
        ele[i].style.background = "blue";
        await new Promise(resolve => setTimeout(resolve, 100));
        while (j >= 0 && parseInt(ele[j].innerText) > parseInt(key)) {
            ele[j + 1].innerText = ele[j].innerText;
            j--;
        }
        ele[j + 1].innerText = key;
        for (let k = 0; k <= i; k++) {
            ele[k].style.background = "green";
        }
    }
}

document.querySelector(".insertionSort").addEventListener("click", async () => {
    await insertion();
});

