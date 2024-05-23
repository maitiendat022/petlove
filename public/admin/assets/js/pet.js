document.addEventListener("DOMContentLoaded", function () {
    var selectedPetId = document.getElementById("pet_id").value;

    var parentSelect = document.getElementById("parent_id");

    showRelatedCategories(selectedPetId);
    document.getElementById("pet_id").addEventListener("change", function () {
        var selectedPetId = this.value;

        parentSelect.selectedIndex = 0;
        showRelatedCategories(selectedPetId);
    });
    function showRelatedCategories(selectedPetId) {
        var parentOptions = document.getElementById("parent_id").options;

        for (var i = 0; i < parentOptions.length; i++) {
            var petId = parentOptions[i].getAttribute("data-pet");
            if (selectedPetId == petId || selectedPetId == 0) {
                parentOptions[i].style.display = "block";
            } else {
                parentOptions[i].style.display = "none";
            }
            parentOptions[0].style.display = "block";
        }
    }
});
