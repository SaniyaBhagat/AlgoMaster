
async function partition(ele, low, high) {
    let pivot = parseInt(ele[high].innerText);
    let i = low - 1;
    ele[high].style.background = "orange";

    for (let j = low; j < high; j++) {
        ele[j].style.background = "yellow";
        await new Promise(resolve => setTimeout(resolve, 100));
        if (parseInt(ele[j].innerText) < pivot) {
            i++;
            let temp = ele[i].innerText;
            ele[i].innerText = ele[j].innerText;
            ele[j].innerText = temp;
            ele[i].style.background = "red";
            ele[j].style.background = "red";
        }
        ele[j].style.background = "lightblue";
    }
    i++;
    let temp = ele[i].innerText;
    ele[i].innerText = ele[high].innerText;
    ele[high].innerText = temp;

    ele[i].style.background = "green";
    ele[high].style.background = "lightblue";

    return i;
}


async function quickSort(ele, low, high) {
    if (low < high) {
        let pi = await partition(ele, low, high);
        await quickSort(ele, low, pi - 1);
        await quickSort(ele, pi + 1, high);
    } else if (low >= 0 && high >= 0 && low < ele.length && high < ele.length) {
        ele[low].style.background = "green";
        ele[high].style.background = "green";
    }
}

document.querySelector(".quickSort").addEventListener("click", async () => {
    const ele = document.querySelectorAll(".bar");
    await quickSort(ele, 0, ele.length - 1);
});
