                    <div class="myaccount-tab-list nav myacc">
                        <a href="{{route('web.view_cart')}}"> Cart <i class="far fa-shopping-cart"></i></a>
                        <a href="{{route('web.order_history')}}"> Orders <i class="far fa-file-alt"></i></a>
                        <a href="{{route('web.wishlist')}}"> Wishlist <i class="far fa-heart"></i></a>
                        <a href="{{route('web.address')}}"> Address <i class="far fa-map-marker-alt"></i></a>
                        <a href="{{route('web.profile')}}"> Profile <i class="far fa-user"></i></a>
                        <a onclick="event.preventDefault();document.getElementById('logout-form').submit();"> Logout <i class="far fa-sign-out-alt"></i></a>
                        <form id="logout-form" action="{{ route('web.logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
