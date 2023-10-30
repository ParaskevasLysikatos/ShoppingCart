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


        <h3 class="container">Shopping History</h3>


</body>

<Script>

</Script>


</html>
