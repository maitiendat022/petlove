let sizeAttributes = ["null"];
let colorAttributes = ["null"];

var createDetail = document.getElementById('createDetail');
function showInput() {
    var selectOption = document.getElementById("selectOption");
    var outputContainer = document.getElementById("outputContainer");

    if (selectOption.value !== "add") {
        var attributeDiv = document.createElement("div");
        attributeDiv.className = "output-item";

        var attributeNameSpan = document.createElement("em");
        attributeNameSpan.textContent =
            selectOption.options[selectOption.selectedIndex].text + ": ";
        attributeNameSpan.id = selectOption.value;
        attributeNameSpan.style.width = "10%";
        attributeDiv.appendChild(attributeNameSpan);

        var inputElement = document.createElement("input");
        inputElement.placeholder =
            "Nhập " +
            selectOption.options[selectOption.selectedIndex].text.toLowerCase();
        inputElement.type = "text";
        attributeDiv.appendChild(inputElement);

        var deleteButton = document.createElement("a");
        deleteButton.className = "delete-button text-danger";
        deleteButton.textContent = "Xóa";
        deleteButton.onclick = function () {
            deleteAttribute(attributeDiv, selectOption, attributeNameSpan);
        };
        attributeDiv.appendChild(deleteButton);

        inputElement.addEventListener("keydown", function (event) {
            if (event.key === "Enter") {
                event.preventDefault();
                moveInputData(attributeDiv, attributeNameSpan);
            }
        });

        outputContainer.appendChild(attributeDiv);

        selectOption.options[selectOption.selectedIndex].disabled = true;
        selectOption.value = "add";
    }
}

function moveInputData(attributeDiv, attributeNameSpan) {
    var inputValue = attributeDiv.querySelector("input").value.trim();
    if (inputValue !== "") {
        var dataSpan = document.createElement("span");
        dataSpan.textContent = inputValue;
        attributeDiv.appendChild(dataSpan);

        if (attributeNameSpan.id === "size") {
            sizeAttributes.push(dataSpan.textContent);
        } else if (attributeNameSpan.id === "color") {
            colorAttributes.push(dataSpan.textContent);
        }
        attributeDiv.querySelector("input").value = "";
    }
}

function deleteAttribute(attributeDiv, selectOption, attributeNameSpan) {
    attributeDiv.remove();

    for (var i = 0; i < selectOption.options.length; i++) {
        if (selectOption.options[i].value === attributeNameSpan.id) {
            selectOption.options[i].disabled = false;
            if (attributeNameSpan.id === "size") {
                sizeAttributes = ["null"];
            }
            if (attributeNameSpan.id === "color") {
                colorAttributes = ["null"];
            }
            break;
        }
    }
}

function createVariants() {

    var tableContainer = document.getElementById("variantTable");
    if (createDetail) {
        createDetail.value  = 'true';
    }
    // Xóa các dòng trong bảng hiện tại
    while (tableContainer.firstChild) {
        tableContainer.removeChild(tableContainer.firstChild);
    }
    if (sizeAttributes.length > 1) {
        sizeAttributes = sizeAttributes.filter((item) => item !== "null");
    }
    if (colorAttributes.length > 1) {
        colorAttributes = colorAttributes.filter((item) => item !== "null");
    }
    // Tạo tiêu đề cho bảng
    var tableHeader = document.createElement("tr");
    tableHeader.innerHTML =
        "<th width='12%'>Kích thước</th><th width='10%'>Màu sắc</th><th width='20%'>Giá</th><th width='10%'>Số lượng</th>";
    tableContainer.appendChild(tableHeader);

    // Tạo các dòng cho từng biến thể
    for (var i = 0; i < sizeAttributes.length; i++) {
        for (var j = 0; j < colorAttributes.length; j++) {
            var variant = {
                size: sizeAttributes[i],
                color: colorAttributes[j],
                quantity: "",
                price: "",
            };

            var tableRow = document.createElement("tr");

            tableRow.innerHTML =
                "<td><input hidden name = 'size[]' type='text' value = '" +variant.size +"'>" +
                variant.size +
                "</td><td><input hidden name = 'color[]' type='text' value = '" + variant.color +"'>" +
                variant.color +
                "</td><td><input name = 'price[]' type='text' placeholder='Nhập giá'>" +
                variant.price +
                "</td><td><input name = 'quantity[]' type='text' placeholder='Nhập số lượng'>" +
                variant.quantity +
                "</td>";
            tableContainer.appendChild(tableRow);
        }
    }
}

$(document).ready(function() {
    $('#image-input').change(function(e) {
        // Hiển thị ảnh đã chọn
        displaySelectedImages(this.files);
    });

    function displaySelectedImages(files) {
        // Xóa nội dung của #selected-images
        $('#selected-images').html('');

        // Hiển thị từng ảnh đã chọn
        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            const reader = new FileReader();

            // Đọc file và hiển thị ảnh
            reader.onload = function (e) {
                const imgElement = $('<img class="img-fluid" style="width:100px; margin-right: 5px;">');
                imgElement.attr('src', e.target.result);
                $('#selected-images').append(imgElement);
            };

            // Đọc file như là một định dạng dữ liệu URL
            reader.readAsDataURL(file);
        }
    }
    const existingImages = $('#existing-images').find('img');
        if (existingImages.length > 0) {
            $('#selected-images').append(existingImages);
        }
});

$(document).ready(function() {
    $('#description').summernote({
        height: 200,
        placeholder: 'Nhập mô tả chi tiết sản phẩm...'
    });
});

$(document).ready(function() {
    $('.image-input').change(function(e) {
        var key = $(this).data('key');
        var imagePreview = $("#imagePreview" + key);

        imagePreview.attr("src", URL.createObjectURL(e.target.files[0]));
        imagePreview.show();
        $("#imageIcon" + key).hide();
    });
});
window.onload = function(){
    if(createDetail){
        createDetail.value = "";
    }
}
