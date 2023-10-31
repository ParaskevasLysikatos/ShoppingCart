<!DOCTYPE html>
<html lang="en">

@include('layouts.head')

@include('layouts.css')

<body>
    @include('layouts.navbar')

    <div class="container">
        <h1>Welcome {{ Session::get('user') }} to discount codes</h1>

    </div>


    @include('layouts.success-error')


    <h3 class="container">Your discount codes</h3>
    <div class="container">
        <table>
            <tr>
                <th>Discount id</th>
                <th>User</th>
                <th>Discount code</th>
                <th>Amount</th>
                <th>Used</th>
                <th>Cart id</th>
                <th>Cart payment</th>
                <th>Cart total payment</th>
            </tr>
            @foreach ($discount_codes as $d )
            <tr>
                <td>{{ $d['id'] }}</td>
                <td>{{ $d['user'] }}</td>
                <td>{{ $d['discount_code'] }}</td>
                <td>{{ $d['amount'] }}€</td>
                <td>{{ $d['used'] }}</td>

                <td>{{ $d['shopping_cart_id'] }}</td>
                <td>{{ $d['shopping_cart_payment'] }}€</td>
                <td>{{ $d['shopping_cart_final_payment'] }}€</td>
            </tr>
            @endforeach

        </table>
    </div>

</body>

<Script></Script>


</html>
