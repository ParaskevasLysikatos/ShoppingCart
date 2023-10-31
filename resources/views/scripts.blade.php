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
        var a_mob = document.getElementById('number_mobile_phone').value;
        var a_lap = document.getElementById('number_laptop').value;
        var a_tab = document.getElementById('number_tablet').value;
        var formData = {
            mobile_phone: a_mob,
            laptop: a_lap,
            tablet: a_tab
        }
        // $.ajax({
        //     url: "{{ url('detailProductAmount') }}",
        //     type: "POST",
        //     data: formData,
        //     success: function(data, textStatus, jqXHR) {
        //         document.getElementById('detail-product-amount').innerHTML = '';
        //         document.getElementById('detail-product-amount').innerHTML = data;
        //     },
        //     error: function(jqXHR, textStatus, errorThrown) {
        //         alert(textStatus + ': ' + errorThrown);
        //     }
        // });

        let xhr = new XMLHttpRequest();
        let url = "{{ url('detailProductAmount') }}";
        let post = JSON.stringify(formData);
        xhr.open('POST', url, true);
        xhr.setRequestHeader('Content-type', 'application/json; charset=UTF-8');
        xhr.send(post);
        xhr.onload = function() {
            if (xhr.status === 200) {
                document.getElementById('detail-product-amount').innerHTML = '';
                document.getElementById('detail-product-amount').innerHTML = xhr.response;
            }
            else{
                alert(xhr.responseText);
            }
        }


        // finalPayment
        // $.ajax({
        //     url: "{{ url('finalPayment') }}",
        //     type: "POST",
        //     data: formData,
        //     success: function(data, textStatus, jqXHR) {
        //         $('#final_payment').html('');
        //         $('#final_payment').append(data);
        //         $('#f_payment').val(data);
        //     },
        //     error: function(jqXHR, textStatus, errorThrown) {
        //         alert(textStatus + ': ' + errorThrown);
        //     }
        // });

        let xhr2 = new XMLHttpRequest();
        let url2 = "{{ url('finalPayment') }}";
        let post2= JSON.stringify(formData);
        xhr2.open('POST', url2, true);
        xhr2.setRequestHeader('Content-type', 'application/json; charset=UTF-8');
        xhr2.send(post2);
        xhr2.onload = function() {
            if (xhr2.status === 200) {
                document.getElementById('final_payment').innerHTML='';
                document.getElementById('final_payment').innerHTML=xhr2.response;
                document.getElementById('f_payment').value=xhr2.response;
            }
            else{
                alert(xhr2.responseText);
            }
        }
    }

    function checkout() {
        var final_payment =  document.getElementById('f_payment').value;
        if (final_payment == 0) {
            alert('Please add something to the cart');
            return false;
        }

        var name =  document.getElementById('name').value;
        var email =  document.getElementById('email').value;
        var address =  document.getElementById('address').value;
        var phone =  document.getElementById('phone').value;

        if ((name == '' || email == '' || address == '' || phone == '') &&  document.getElementById("user_exists").checked == false) {
            alert('Please fill all the fields ');
            return false;
        }

        document.getElementById('checkout-form').submit();
    }

    function logout() {
        document.getElementById('logout-form').submit();
    }

    function alreadyUser() {
        if (document.getElementById("user_exists").checked == true) {
            document.getElementById("user_info").style.display = 'none';
        } else {
            document.getElementById("user_info").style.display = 'block';
        }
    }
</Script>
