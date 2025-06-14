async function binarySearch() {
    const ele = document.querySelectorAll(".bar");
    const searchElement = parseInt(document.getElementById("searchElement").value);
    let left = 0;
    let right = ele.length - 1;
    let found = false;

    while (left <= right) {
        const mid = Math.floor((left + right) / 2);

       
        ele[mid].style.background = "yellow";
        await new Promise(resolve => setTimeout(resolve, 300));

        const midValue = parseInt(ele[mid].innerText);

        if (midValue === searchElement) {
            ele[mid].style.background = "green"; 
            found = true;
            break;
        } else if (midValue < searchElement) {
            for (let i = left; i <= mid; i++) {
                ele[i].style.background = "red"; 
            }
            left = mid + 1;
        } else {
            for (let i = mid; i <= right; i++) {
                ele[i].style.background = "red"; 
            }
            right = mid - 1;
        }
    }
    if (!found) {
        alert("Element not found in the array!");
    } else {
        alert("Element found in the array!");
    }

}

document.querySelector(".binarySearch").addEventListener("click", async () => {
    const ele = document.querySelectorAll(".bar");

    if (ele.length === 0) {
        alert("Generate an array first.");
        return;
    }

    const searchElement = document.getElementById("searchElement").value;
    if (searchElement === "") {
        alert("Enter an element to search.");
        return;
    }

    // Sort the array before performing Binary Search
    const arr = Array.from(ele).map(e => parseInt(e.innerText));
    arr.sort((a, b) => a - b);
    for (let i = 0; i < ele.length; i++) {
        ele[i].innerText = arr[i];
        ele[i].style.background = "lightblue";
    }

    await binarySearch();
});
