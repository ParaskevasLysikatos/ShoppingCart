<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Welcome to Shopping</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<style>
    .container {
        margin: 0.5%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 60%;
    }

    td,
    th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }

    tr:nth-child(even) {
        background-color: #dddddd;
    }

    .value-button {
        display: inline-block;
        border: 1px solid #ddd;
        margin: 0px;
        width: 40px;
        height: 20px;
        text-align: center;
        vertical-align: middle;
        padding: 11px 0;
        background: #eee;
        -webkit-touch-callout: none;
        -webkit-user-select: none;
        -khtml-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }

    .value-button:hover {
        cursor: pointer;
    }

    input[type=number] {
        text-align: center;
        border: none;
        border-top: 1px solid #ddd;
        border-bottom: 1px solid #ddd;
        margin: 0px;
        width: 40px;
        height: 40px;
    }

    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    .row {
        display: flex;
    }

    /* Create two equal columns that sits next to each other */
    .column {
        flex: 33%;
        /* Should be removed. Only for demonstration */
    }

    span.price {
        margin-left: 2%;
        color: grey;
    }

    input[type=text] {
        margin-bottom: 2px;
        padding: 4px;
        border: 1px solid #ccc;
        border-radius: 3px;
    }

    .btn {
        background-color: #04AA6D;
        color: white;
        padding: 12px;
        margin: 10px 0;
        border: none;
        width: 30%;
        border-radius: 3px;
        cursor: pointer;
        font-size: 17px;
    }

    .btn:hover {
        background-color: #45a049;
    }
</style>

<body>
    @include('navbar')

    <div class="container">
        <h1>Welcome to our store (supports 3 products)</h1>

    </div>

    @include('success-error')

    <h3 class="container">List of Products</h3>
    <form id="checkout-form" method="post" action="{{ url('checkout') }}">
        @csrf
        <div class="container">
            <table>
                <tr>
                    <th>Product name</th>
                    <th>Product image</th>
                    <th>Product price</th>
                    <th>Product stock amount</th>
                </tr>

                @foreach ($products as $pr)
                    <tr>
                        <td>{{ $pr->name }}</td>
                        <td><img src="{{ asset('storage/' . $pr->image . '') }}" width="120" height="60"></td>
                        <td>{{ $pr->price }}€</td>
                        <td>{{ $pr->stock_amount }}</td>
                        <td>
                            <div class="value-button" id="decrease_{{ $pr->name }}"
                                onclick="decreaseValue('{{ $pr->name }}');">-
                            </div>
                            <input autocomplete="off" onchange="changeValue('{{ $pr->name }}');" type="number" name="{{ $pr->name }}" id="number_{{ $pr->name }}"
                                value="0" />
                            <div class="value-button" id="increase_{{ $pr->name }}"
                                onclick="increaseValue('{{ $pr->name }}');">+
                            </div>
                        </td>
                    </tr>
                @endforeach

            </table>
        </div>


        <h3 class="container">Shopping Cart</h3>


        <div class="row container">
            <div class="column">
                <div class="container" id='detail-product-amount'>
                    {{-- will be filled by ajax-detailProductAmount --}}
                </div>
            </div>
            <div class="column">
                <div id='user-details'>
                    <h3>User Details</h3>
                    <br>
                    <label for="name"><i class="fa fa-user"></i>Name:</label>
                    <input type="text" id="name" name="name" placeholder="John M. Doe">
                    <br>
                    <label for="email"><i class="fa fa-envelope"></i> Email:</label>
                    <input type="text" id="email" name="email" placeholder="john@example.com">
                    <br>
                    <label for="address"><i class="fa fa-address-card-o"></i> Address:</label>
                    <input type="text" id="address" name="address" placeholder="542 W. 15th Street">
                    <br>
                    <label for="phone"><i class="fa fa-institution"></i>Phone:</label>
                    <input type="text" id="phone" name="phone" placeholder="+30 69X...">
                </div>
                <br>
                <div id='discount-fpayment'>
                    <label for="discount_code">Discount Code:</label>
                    <input type="text" id="discount_code" name="discount_code" placeholder="#12345ZA">

                    <p>Final payment: <span class="price" style="color:black"><b
                                id='final_payment'>{{ $final_payment }}€</b></span></p>
                    <input type="hidden" id="f_payment" name="f_payment" value={{ $final_payment }}>
                </div>
            </div>
            <div class="column">
                <input type="button" value="Checkout" onclick="checkout()" class="btn">
            </div>
        </div>

    </form>




</body>

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

        if (name == '' || email == '' || address == '' || phone == '') {
            alert('Please fill all the fields ');
            return false;
        }

        $('#checkout-form').submit();
    }

    function logout() {
       $('#logout-form').submit();
    }
</Script>


</html>
