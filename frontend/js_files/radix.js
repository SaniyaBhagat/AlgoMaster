async function countingSort(ele, exp) {
    const n = ele.length;
    const output = new Array(n);
    const count = new Array(10).fill(0);
    const delay = 100;

    for (let i = 0; i < n; i++) {
        const index = Math.floor(parseInt(ele[i].innerText) / exp) % 10;
        ele[i].style.background = "blue";
        count[index]++;
        await new Promise(resolve => setTimeout(resolve, delay));
    }

    for (let i = 1; i < 10; i++) count[i] += count[i - 1];

    for (let i = n - 1; i >= 0; i--) {
        const index = Math.floor(parseInt(ele[i].innerText) / exp) % 10;
        output[count[index] - 1] = ele[i].innerText;
        count[index]--;
    }

    for (let i = 0; i < n; i++) {
        await new Promise(resolve => setTimeout(resolve, delay));
        ele[i].innerText = output[i];
        ele[i].style.background = "lightgreen";
    }
}

async function radixSort(ele) {
    const max = Math.max(...Array.from(ele, bar => parseInt(bar.innerText)));
    const delay = 100;

    for (let exp = 1; Math.floor(max / exp) > 0; exp *= 10) {
        await countingSort(ele, exp);
    }

    // Mark all elements as completely sorted (final state)
    for (let i = 0; i < ele.length; i++) {
        await new Promise(resolve => setTimeout(resolve, delay));
        ele[i].style.background = "green";
    }
}

document.querySelector(".radixSort").addEventListener("click", async () => {
    const ele = document.querySelectorAll(".bar");
    await radixSort(ele);
});
