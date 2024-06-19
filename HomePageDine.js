const filterBtn = document.querySelector(".filter_btn"); 
const filterContainer = document.querySelector(".filter-container"); 
 
filterBtn.addEventListener("click", () => { 
    filterContainer.classList.toggle("open"); 
     
    if (filterContainer.classList.contains("open")) { 
        filterContainer.style.display = "block"; 
    } else { 
        filterContainer.style.display = "none"; 
    } 
});

document.addEventListener('DOMContentLoaded', function() {
            var findButton = document.getElementById('findButton');

            findButton.addEventListener('click', function(event) {
                event.preventDefault();

                var checkboxes = document.querySelectorAll('.checkbox');
                var selectedFilters = [];

                checkboxes.forEach(function(checkbox) {
                    if (checkbox.checked) {
                        selectedFilters.push(checkbox.id);
                    }
                });

                var queryString = selectedFilters.map(filter => `cuisine=${filter}`).join('&');
                findButton.href = 'cataloguepage.php?' + queryString;
                window.location.href = findButton.href;
            });
        });

