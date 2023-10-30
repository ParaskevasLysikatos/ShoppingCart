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
    <li><a class="active" href="#home">Home</a></li>
    <li><a href="#discountCode">Discount codes</a></li>
    <li><a href="#history">History of orders</a></li>
    @if(Session::get('user'))
    <form id="logout-form" method="post" action="{{ url('logout') }}">
        <li><a onclick="logout()" href="#logout">Logout</a></li>
    </form>

    @endif

  </ul>

