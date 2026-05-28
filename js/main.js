document.addEventListener("DOMContentLoaded", () => {
    const filterButtons = document.querySelectorAll(".filter-btn")
    const galeryItems = document.querySelectorAll(".item")

    filterButtons.forEach(btn => {
        btn.addEventListener("click", () => {
            filterButtons.forEach(b => b.classList.remove('active'))

            btn.classList.add("active")

            const filterValue = btn.getAttribute("data-filter")

            galeryItems.forEach(item => {
                if (filterValue === "semua" || item.classList.contains(filterValue)) {
                    item.style.display = "block";
                } else {
                    item.style.display = "none";
                }
            })
        })
    })
})