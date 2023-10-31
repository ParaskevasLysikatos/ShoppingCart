<!DOCTYPE html>
<html lang="en">

@include('layouts.head')

@include('layouts.css')

<body>
    @include('layouts.navbar')

    <div class="container">
        <h1>Welcome {{ (session('user')) }} to our store (supports 3 products)</h1>

    </div>

    @include('layouts.success-error')

    <h3 class="container">List of Products </h3>
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
                            <input autocomplete="off" onchange="changeValue('{{ $pr->name }}');" type="number"
                                name="{{ $pr->name }}" id="number_{{ $pr->name }}" value="0" />
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
                    <input onchange="alreadyUser()" type="checkbox" id="user_exists" name="user_exists" value="1">
                    <label for="user_exists"> Already a user?(email only){{ '( your email: '.session('email').' )'}}</label>
                    <div id="user_info">
                        <br>
                        <label for="name"><i class="fa fa-user"></i>Name:</label>
                        <input type="text" id="name" name="name" placeholder="John M. Doe">
                        <br>
                        <label for="address"><i class="fa fa-address-card-o"></i> Address:</label>
                        <input type="text" id="address" name="address" placeholder="542 W. 15th Street">
                        <br>
                        <label for="phone"><i class="fa fa-institution"></i>Phone:</label>
                        <input type="text" id="phone" name="phone" placeholder="+30 69X...">
                    </div>
                    <br>
                    <label for="email"><i class="fa fa-envelope"></i> Email:</label>
                    <input type="text" id="email" name="email" placeholder="john@example.com">
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


@include('scripts')

</html>
