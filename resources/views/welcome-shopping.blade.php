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
        margin: 2%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 50%;
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
        flex: 50%;
        padding: 10px;
        height: 300px;
        /* Should be removed. Only for demonstration */
    }
</style>

<body>
    @include('navbar')

    <div class="container">
        <h1>Welcome to our store</h1>

    </div>

    <h3 class="container">List of Products</h3>

    <div class="container">
        <table>
            <tr>
                <th>Product name</th>
                <th>Product image</th>
                <th>Product stock amount</th>
            </tr>

            @foreach ($products as $pr)
                <tr>
                    <td>{{ $pr->name }}</td>
                    <td><img src="{{ asset('storage/' . $pr->image . '') }}" width="120" height="60"></td>
                    <td>{{ $pr->stock_amount }}</td>
                    <td>
                        <div class="value-button" id="decrease_{{ $pr->name }}"
                            onclick="decreaseValue('{{ $pr->name }}');">-
                        </div>
                        <input type="number" id="number_{{ $pr->name }}" value="0" />
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

            </div>
        </div>
        <div class="column">
            <div id='user-details'></div>

            <div id='discount-fpayment'></div>
        </div>
    </div>






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
    }
</Script>


</html>
