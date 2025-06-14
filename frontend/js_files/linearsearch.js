async function linearSearch() {
    const ele = document.querySelectorAll(".bar");
    const target = parseInt(document.getElementById("searchElement").value);

    let found = false;

    for (let i = 0; i < ele.length; i++) {
        ele[i].style.background = "yellow"; 
        await new Promise(resolve => setTimeout(resolve, 200));

        if (parseInt(ele[i].innerText) === target) {
            ele[i].style.background = "green";
            found = true;
            break;
        } else {
            ele[i].style.background = "red"; 
        }
    }

    if (!found) {
        alert("Element not found in the array!");
    } else {
        alert("Element found in the array!");
    }

    for (let i = 0; i < ele.length; i++) {
        ele[i].style.background = "lightblue"; 
    }
}

document.querySelector(".linearSearch").addEventListener("click", async () => {
    await linearSearch();
});
