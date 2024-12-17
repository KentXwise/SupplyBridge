<ul class="account-nav">
            <li><a href="{{route('cart.index')}}" class="menu-link menu-link_us-s">Cart</a></li>
            <li><a href="{{route('user.orders')}}" class="menu-link menu-link_us-s">Orders</a></li>
            <li><a href="{{route('wishlist.index')}}" class="menu-link menu-link_us-s">Wishlist</a></li>

            <li>
                <form method="POST" action="{{route('logout')}}" id="logout-form">
                @csrf
                  <a href="{{route('logout')}}" class="menu-link menu-link_us-s" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
                </form>
            </li>
          </ul>