async function bucketSort() {
    const ele = document.querySelectorAll(".bar");
    const n = ele.length;

    if (n <= 0) return;

    let buckets = Array.from({ length: 10 }, () => []);
    let max = -1;

    for (let i = 0; i < n; i++) {
        ele[i].style.background = "blue"; 
        max = Math.max(max, parseInt(ele[i].innerText));
        await new Promise(resolve => setTimeout(resolve, 100));
    }

    const bucketSize = Math.ceil((max + 1) / 10);
    for (let i = 0; i < n; i++) {
        const value = parseInt(ele[i].innerText);
        const bucketIndex = Math.floor(value / bucketSize);
        buckets[bucketIndex].push(value);

        ele[i].style.background = "orange"; 
        await new Promise(resolve => setTimeout(resolve, 100));
    }

    let index = 0;
    for (let i = 0; i < buckets.length; i++) {
        if (buckets[i].length === 0) continue;

        for (let j = 0; j < buckets[i].length; j++) {
            for (let k = 0; k < buckets[i].length - j - 1; k++) {
                if (buckets[i][k] > buckets[i][k + 1]) {
                    [buckets[i][k], buckets[i][k + 1]] = [buckets[i][k + 1], buckets[i][k]]; 
                }
                ele[index].innerText = buckets[i][k];
                await new Promise(resolve => setTimeout(resolve, 100));
            }
        }

        
        for (let j = 0; j < buckets[i].length; j++) {
            ele[index].innerText = buckets[i][j];
            ele[index].style.background = "lightgreen"; 
            await new Promise(resolve => setTimeout(resolve, 100));
            index++;
        }
    }
    for (let i = 0; i < n; i++) {
        ele[i].style.background = "green";
        await new Promise(resolve => setTimeout(resolve, 100));
    }
}

document.querySelector(".bucketSort").addEventListener("click", async () => {
    await bucketSort();
});
