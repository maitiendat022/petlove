document.addEventListener("DOMContentLoaded", function () {
    var parentSelect = document.getElementById("parent_id");
    var categorySelect = document.getElementById("category_id");

    var selectedPetId = document.getElementById("pet_id").value;
    var selectedParentId = document.getElementById("parent_id").value;
    showRelatedOptions(selectedPetId, selectedParentId);
    document.getElementById("pet_id").addEventListener("change", function () {
        var selectedPetId = this.value;
        parentSelect.selectedIndex = 0;
        categorySelect.selectedIndex = 0;

        showRelatedOptions(selectedPetId, 0);
    });
    document.getElementById("parent_id").addEventListener("change", function () {
        var selectedParentId = this.value;
        var selectedPetId = document.getElementById("pet_id").value;
        categorySelect.selectedIndex = 0;
        showRelatedOptions(selectedPetId, selectedParentId);
    });
    function showRelatedOptions(selectedPetId, selectedParentId) {
        var parentOptions = document.getElementById("parent_id").options;
        var categoryOptions = document.getElementById("category_id").options;
        for (var i = 0; i < parentOptions.length; i++) {
            var petId = parentOptions[i].getAttribute("data-pet");

            if (selectedPetId == petId || selectedPetId == 0) {
                parentOptions[i].style.display = "block";
            } else {
                parentOptions[i].style.display = "none";
            }
            parentOptions[0].style.display = "block";
        }
        for (var i = 0; i < categoryOptions.length; i++) {
            categoryOptions[i].style.display = "block";
        }
        for (var i = 0; i < categoryOptions.length; i++) {
            var petId_Child = categoryOptions[i].getAttribute("data-pet_id");
            var parent_id = categoryOptions[i].getAttribute("data-parent_id");

            if ((selectedPetId != petId_Child && selectedPetId != 0) || (selectedParentId != parent_id && selectedParentId != 0)) {
                categoryOptions[i].style.display = "none";
            }
            categoryOptions[0].style.display = "block";
        }
    }
});

