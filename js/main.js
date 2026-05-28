document.addEventListener("DOMContentLoaded", () => {
    const filterButtons = document.querySelectorAll(".filter-btn")
    const galeryItems = document.querySelectorAll(".item")

    filterButtons.forEach(btn => {
        btn.addEventListener("click", () => {
            const filterValue = btn.getAttribute("data-filter")

            galeryItems.forEach(item => {
                if(filterValue === "semua" || item.classList.contains(filterValue)) {
                    item.style.display = "block";
                } else {
                    item.style.display = "none";
                }
            })
        })
    })
})