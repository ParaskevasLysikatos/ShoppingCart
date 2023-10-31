<!DOCTYPE html>
<html lang="en">

@include('layouts.head')

@include('layouts.css')

<body>
    @include('layouts.navbar')

    <div class="container">
        <h1>Welcome {{ Session::get('user') }} History & user details</h1>

    </div>


    @include('layouts.success-error')


    <h3 class="container">User information</h3>
    <div class="container">
        <table>
            <tr>
                <th>User name</th>
                <th>User email</th>
                <th>User address</th>
                <th>User phone</th>
            </tr>
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->address }}</td>
                <td>{{ $user->phone }}</td>

            </tr>
        </table>
    </div>
    <br>

    <h3 class="container">Shopping History</h3>
    <br>

    <div class="container">
        <table>

            @foreach ($shopping_carts as $shc)
            <tr>
                <th>Shopping cart id</th>
                <th>User</th>
                <th>Discount code</th>
                <th>Payment</th>
                <th>Final payment</th>
            </tr>

            <tr>
                <td>{{ $shc['id'] }}</td>
                <td>{{ $shc['user'] }}</td>
                <td>{{ $shc['discount_code'] }}</td>
                <td>{{ $shc['payment'] }}€</td>
                <td>{{ $shc['final_payment'] }}€</td>
            </tr>

            <tr>
                <td colspan="5" style="text-align: center;color:green;">Order for shopping cart with id  {{ $shc['id'] }} </td>
            </tr>

            <tr>
                <th>Order id</th>
                <th>Cart id</th>
                <th>Product</th>
                <th>Amount</th>
                <th>Total cost</th>
            </tr>

            @foreach ($shc['orders'] as $order )

            <tr>
                <td>{{ $order['id'] }}</td>
                <td>{{ $order['shopping_cart_id'] }}</td>
                <td>{{ $order['product'] }}</td>
                <td>{{ $order['amount'] }}</td>
                <td>{{ $order['total_cost'] }}€</td>
            </tr>

            @endforeach

            @endforeach

        </table>
    </div>

</body>

<Script></Script>


</html>
