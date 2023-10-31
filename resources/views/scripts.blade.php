<Script>
    function increaseValue(name) {
        var value = parseInt(document.getElementById('number_' + name).value, 10);
        value = isNaN(value) ? 0 : value;
        value++;
        document.getElementById('number_' + name).value = value;
        detailProductAmount();
    }

    function decreaseValue(name) {
        var value = parseInt(document.getElementById('number_' + name).value, 10);
        value = isNaN(value) ? 0 : value;
        value < 1 ? value = 1 : '';
        value--;
        document.getElementById('number_' + name).value = value;
        detailProductAmount();
    }

    function changeValue(name) {
        var value = parseInt(document.getElementById('number_' + name).value, 10);
        value = isNaN(value) ? 0 : value;

        document.getElementById('number_' + name).value = value;
        detailProductAmount();
    }


    function detailProductAmount() { // amount of each
        var a_mob = $('#number_mobile_phone').val();
        var a_lap = $('#number_laptop').val();
        var a_tab = $('#number_tablet').val();
        var formData = {
            mobile_phone: a_mob,
            laptop: a_lap,
            tablet: a_tab
        }
        $.ajax({
            url: "{{ url('detailProductAmount') }}",
            type: "POST",
            data: formData,
            success: function(data, textStatus, jqXHR) {
                $('#detail-product-amount').html('');
                $('#detail-product-amount').append(data);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert(textStatus + ': ' + errorThrown);
            }
        });

        // finalPayment
        $.ajax({
            url: "{{ url('finalPayment') }}",
            type: "POST",
            data: formData,
            success: function(data, textStatus, jqXHR) {
                $('#final_payment').html('');
                $('#final_payment').append(data);
                $('#f_payment').val(data);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert(textStatus + ': ' + errorThrown);
            }
        });
    }

    function checkout() {
        var final_payment = $('#f_payment').val();
        if (final_payment == 0) {
            alert('Please add something to the cart');
            return false;
        }

        var name = $('#name').val();
        var email = $('#email').val();
        var address = $('#address').val();
        var phone = $('#phone').val();

        if ((name == '' || email == '' || address == '' || phone == '') && $( "#user_exists" ).prop( "checked")==false) {
            alert('Please fill all the fields ');
            return false;
        }

        $('#checkout-form').submit();
    }

    function logout() {
        $('#logout-form').submit();
    }

    function alreadyUser(){
      if( $( "#user_exists" ).prop( "checked")==true){
        $( "#user_info" ).hide();
      }
      else{
        $( "#user_info" ).show();
      }
    }
</Script>
