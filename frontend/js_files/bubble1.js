async function bubble() {
    const ele = document.querySelectorAll(".bar");
    for (let i = 0; i < ele.length - 1; i++) {
        for (let j = 0; j < ele.length - i - 1; j++) {
            ele[j].style.background = "blue";
            ele[j + 1].style.background = "blue";
            await new Promise(resolve => setTimeout(resolve, 100));
            if (parseInt(ele[j].innerText) > parseInt(ele[j + 1].innerText)) {
                let temp = ele[j].innerText;
                ele[j].innerText = ele[j + 1].innerText;
                ele[j + 1].innerText = temp;
            }
            ele[j].style.background = "lightblue";
            ele[j + 1].style.background = "lightblue";
        }
        ele[ele.length - i - 1].style.background = "green";
    }
    ele[0].style.background = "green";
}

document.querySelector(".bubbleSort").addEventListener("click", async () => {
    await bubble();
});

