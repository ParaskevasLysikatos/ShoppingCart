<style>
    ul {
      list-style-type: none;
      margin: 0;
      padding: 0;
      overflow: hidden;
      background-color: #333;
    }

    li {
      float: left;
    }

    li a {
      display: block;
      color: white;
      text-align: center;
      padding: 14px 16px;
      text-decoration: none;
    }

    li a:hover:not(.active) {
      background-color: #111;
    }

    .active {
      background-color: #04AA6D;
    }
    </style>


<ul>
    <li><a class="{{ (request()->is('/')) ? 'active' : '' }}" href="{{ url('') }}">Home</a></li>

    @if(Session::get('user'))
    <li><a class="{{ (request()->is('discount_codes')) ? 'active' : '' }}" href="{{ url('discount_codes') }}">My discount codes</a></li>
    @endif

    @if(Session::get('user'))
        <li><a class="{{ (request()->is('history')) ? 'active' : '' }}" href="{{ url('history') }}">My history of orders</a></li>
    @endif


    @if(Session::get('user'))
    <form id="logout-form" method="post" action="{{ url('logout') }}">
        <li><a onclick="logout()" href="#logout">Logout</a></li>
    </form>

    @endif


    @if(!Session::get('user'))
    <form style="margin:0.5%; " id="login" method="post" action="{{ url('login') }}">
        <li style="margin-left:5%;"><input style="width: 250px;" type="email" name='login_email' value="" placeholder="Your email"></li>
        <li><button style="margin-left:5%;width: 150px;" type="submit">login</button></li>
    </form>
    @endif

  </ul>

