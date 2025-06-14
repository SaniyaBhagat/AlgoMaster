
async function merge(ele, low, mid, high) {
    const left = [], right = [];
    for (let i = low; i <= mid; i++) left.push(ele[i].innerText);
    for (let i = mid + 1; i <= high; i++) right.push(ele[i].innerText);

    let i = 0, j = 0, k = low;
    while (i < left.length && j < right.length) {
        await new Promise(resolve => setTimeout(resolve, 100));
        if (parseInt(left[i]) <= parseInt(right[j])) {
            ele[k].innerText = left[i++];
        } else {
            ele[k].innerText = right[j++];
        }
        ele[k].style.background = "lightgreen";
        k++;
    }

    while (i < left.length) {
        await new Promise(resolve => setTimeout(resolve, 100));
        ele[k].innerText = left[i++];
        ele[k].style.background = "lightgreen";
        k++;
    }

    while (j < right.length) {
        await new Promise(resolve => setTimeout(resolve, 100));
        ele[k].innerText = right[j++];
        ele[k].style.background = "lightgreen";
        k++;
    }
}

async function mergeSort(ele, l, r) {
    if (l >= r) return;
    const mid = Math.floor((l + r) / 2);
    await mergeSort(ele, l, mid);
    await mergeSort(ele, mid + 1, r);
    await merge(ele, l, mid, r);
    if (r - l === ele.length - 1) {
        for (let i = l; i <= r; i++) ele[i].style.background = "green";
    }
}

document.querySelector(".mergeSort").addEventListener("click", async () => {
    const ele = document.querySelectorAll(".bar");
    await mergeSort(ele, 0, ele.length - 1);
});
