$(document).ready(function() {
    $('.quantity').change(function() {
        var quantity = $(this).val();
        var action = $(this).data('action');
        var detail_id = $(this).data('detail_id');
        $.ajax({
            url: action,
            type: 'PATCH',
            data: {
                'detail_id': detail_id,
                'quantity': quantity,
                '_token': $('input[name="_token"]').val()
            },
            success: function(response) {
                if (response.error) {
                    toastr.error(response.error);
                    $('#quantity' + response.id).val(response.quantity);
                }else{
                    var total = $('#total' + response.id).text(formatPrice(response.total));
                    $('#totalCart').text(formatPrice(response.totalCart));
                }

            }
        });
    });
    $('.delete').click(function() {
        var action = $(this).data('action');
        $.ajax({
            url: action,
            type: 'DELETE',
            data: {
                '_token': $('input[name="_token"]').val()
            },
            success: function(response) {
                $('#totalCart').text(formatPrice(response.totalCart));
                $('#product-' + id).remove();
            }
        });
    });
    function formatPrice(price){
        return Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(price)
    }
});