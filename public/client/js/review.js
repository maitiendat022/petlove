document.addEventListener('DOMContentLoaded', function () {
    const ratingInputs = document.querySelectorAll('.rating input');
    const selectedLabel = document.getElementById('selectedLabel');
    const lable = [
        { 'class': 'text-danger', 'text': 'Rất tệ' },
        { 'class': 'text-secondary', 'text': 'Không hài lòng' },
        { 'class': 'text-secondary', 'text': 'Bình thường' },
        { 'class': 'text-primary', 'text': 'Hài lòng' },
        { 'class': 'text-primary', 'text': 'Tuyệt vời' },
    ];
    const checkedInput = document.querySelector('.rating input:checked');
    if (checkedInput) {
        const selectedValue = parseInt(checkedInput.value) - 1;
        selectedLabel.textContent = lable[selectedValue]['text'];
        selectedLabel.className = lable[selectedValue]['class'];
    }
    ratingInputs.forEach(input => {
        input.addEventListener('change', function () {
            const selectedValue = parseInt(this.value) - 1;
            selectedLabel.textContent = lable[selectedValue]['text'];
            selectedLabel.className = lable[selectedValue]['class'];
        });
    });
});
$(document).ready(function () {
    $("#image").change(function (e) {
        $("#show-image").attr("src", URL.createObjectURL(e.target.files[0]));
    });
});
