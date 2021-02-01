 $(document).ready(function () {
    cartload();
        $('.add-to-cart-btn').click(function (e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var prdID = $(this).data('id');
            // alert($prdID);
            var product_id = $('.product_id'+prdID+'').val();
            var quantity = $('.qty-input'+prdID+'').val();
            $.ajax({
                "type": "POST",
                "url": "add-to-cart",
                "data": {
                    'quantity': quantity,
                    'product_id': product_id,
                },
                "dataType": "json",
                success: function (response) {
                    toastr.success(response.status);
                    cartload();
                },
            });
        });
        //quantity management
         $('.increment-btn').click(function (e) {
            e.preventDefault();
            var prdID = $(this).data('id');
            var incre_value = $('#qtyinput'+prdID+'').val();
            var value = parseInt(incre_value, 10);
            value = isNaN(value) ? 0 : value;
            if(value<10){
                value++;
                $('#qtyinput'+prdID+'').val(value);
            }
        });

        $('.decrement-btn').click(function (e) {
            e.preventDefault();
            var prdID = $(this).data('id');
            var decre_value = $('#qtyinput'+prdID+'').val();
            var value = parseInt(decre_value, 10);
            value = isNaN(value) ? 0 : value;
            if(value>1){
                value--;
                $('#qtyinput'+prdID+'').val(value);

            }
        });
        //update cart with value and qty
        $('.changeQuantity').click(function (e) {
            e.preventDefault();
            var prdID = $(this).data('id');
            var quantity = $('#qtyinput'+prdID+'').val();
            var product_id = $('#prdid'+prdID+'').val();
            // alert(quantity);
            var data = {
                '_token': $('input[name=_token]').val(),
                'quantity':quantity,
                'product_id':product_id,
            };

            $.ajax({
                "method": 'POST',
                "url": "update-to-cart",
                "data": data,
                success: function (response) {
                    toastr.success(response.status);
                    window.location.reload();
                    // var qty = response.qty;
                    // $('#grandtotal'+prdID+'').text(qty * price);
                }
            });
        });
        $('.delete_cart_data').click(function (e) {
            e.preventDefault();
            var prdID = $(this).data('id');
            var product_id = $('#prdid'+prdID+'').val();

            var data = {
                '_token': $('input[name=_token]').val(),
                "product_id": product_id,
            };

            // $(this).closest(".cartpage").remove();

            $.ajax({
                "type": 'DELETE',
                "url": 'delete-from-cart',
                "data": data,
                "dataType": 'json',
                success: function (response) {
                    window.location.reload();
                }
            });
        });
        $('.clear_cart').click(function (e) {
            e.preventDefault();

            $.ajax({
                "method": 'GET',
                "url": 'clear-cart',
                success: function (response) {
                    toastr.success(response.status);
                    window.location.reload();
                }
            });
        });
        $('#checkoutBtn').on('click',function(e){
            e.preventDefault();
            $.ajax({
                "type":"POST",
                "url":"checkout",
                "data":$("#userDetails").serialize(),
                "dataType":"JSON",
                success: function (response) {
                    toastr.success(response.status);
                    window.location.reload();
                    $.ajax({
                        "method": 'GET',
                        "url": 'clear-cart',
                        success: function (response) {
                            toastr.success(response.status);
                            window.location.reload();
                        }
                    });
                },
                error: function(response){
                    console.log(response);
                    toastr.error(response.responseJSON['message']);
                }
            });
        });
    });
    
function cartload()
    {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            "type": "GET",
            "url": "load-cart-data",
            "dataType": "json",
            success: function (response) {
                console.log(response);
                $('#lblCartCount').html('');
                // var parsed = jQuery.parseJSON(response)
                // var value = parsed; //Single Data Viewing
                $('#lblCartCount').append( response.totalcart );
                
            },
            error : function(e) {
                        console.info("Error");
                    }
        });
    }