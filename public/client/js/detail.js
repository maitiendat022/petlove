$(document).ready(function() {
    $('.size:checked + label, .color:checked + label').addClass('selected');
    if(detail[0].quantity < 1){
        $('.quantity').hide();
        $('.soldout').show();
        $('.add_cart').prop('disabled', true);
    }
    $('.size, .color').change(function(){
        updatePrice();
        var inputType = $(this).hasClass('size') ? 'size' : 'color';
        $('.' + inputType + ' + label').removeClass('selected');
        $(this).next('label').addClass('selected');
    });

    function updatePrice() {
        var selectedSize = $('.size:checked').data('size');
        var selectedColor = $('.color:checked').data('color');
        var selectedDetail = findSelectedDetail(selectedSize, selectedColor);

        if (selectedDetail) {
            $('#price').text(Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(selectedDetail.price));
            $('.detail_id').val(selectedDetail.id);
            if (selectedDetail.quantity > 0) {
                $('.quantity').show();
                $('.soldout').hide();
                $('.add_cart').prop('disabled', false);
            } else {
                $('.quantity').hide();
                $('.soldout').show();
                $('.add_cart').prop('disabled', true);
            }
        }
    }

    function findSelectedDetail(size, color) {
        for (var i = 0; i < detail.length; i++) {
            if ((detail[i].size === size || detail[i].size === "null") &&
                (detail[i].color === color || detail[i].color === "null")) {
                return detail[i];
            }
        }
    }
});
