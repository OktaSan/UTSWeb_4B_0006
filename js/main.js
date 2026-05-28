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

const counters = document.querySelectorAll(".counter")
const speed = 200;

const observer = new IntersectionObserver((entries, observer) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            const counter = entry.target

            const updateCount = () => {
                const target = +counter.getAttribute("data-target")
                const count = +counter.innerText
                const increment = target / speed

                if (count < target) {
                    counter.innerText = Math.ceil(count + increment)
                    setTimeout(updateCount, 15)
                } else {
                    counter.innerText = target
                }
            }
            updateCount()
            observer.unobserve(counter)
        }
    })
}, { threshold: 0.5 })

counters.forEach(counters => {
    observer.observe(counters)
})