<!-- Header -->
<header>
    <nav class="navbar navbar-expand-lg">
      <div class="container">
        <a class="navbar-brand" href="/"><h2>Nusantara <em>Shop</em></h2></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="/">Home
                <span class="sr-only">(current)</span>
              </a>
            </li> 
            <li class="nav-item">
              <a class="nav-link {{ Request::is('products*') ? 'active' : '' }}" href="/products">Products</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('posts*') ? 'active' : '' }}" href="/posts">Blog</a>
              </li>
            <li class="nav-item">
              <a class="nav-link {{ Request::is('about') ? 'active' : '' }}" href="/about">About</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('contact') ? 'active' : '' }}" href="/contact">Contact</a>
            </li>
            
            @auth
            <li class="nav-item">
              <?php
                $main_order = \App\Models\Order::where('user_id', Auth::user()->id)->where('status', 0)->first();
                if(!empty($main_order))
                {
                  $notif = \App\Models\OrderDetails::where('order_id', $main_order->id)->count();
                }
              ?>
              <a class="nav-link {{ Request::is('check_out') ? 'active' : '' }}" href="{{ url('check_out') }}">Cart 
                @if (!empty($notif))
                  <span class="badge badge-danger">{{ $notif }}</span>
                @endif
              </a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link {{ Request::is('user*') ? 'active' : '' }} dropdown-toggle" href="/user" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  {{ auth()->user()->username }}
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="/user">Profile</a></li>
                    <li><a class="dropdown-item" href="{{ url('user/history') }}">Order History</a></li>

                    @canany(['admin', 'seller'])
                    <li><a class="dropdown-item" href="/dashboard">Dashboard</a></li>
                    @endcanany
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form action="/logout" method="post">
                            @csrf
                            <button type="submit" class="dropdown-item" style="outline: 0" onclick="return confirm('Are you sure?')">Logout</button>
                        </form>
                    </li>
                </ul>
              </li>
            @else
            <li class="nav-item"><a href="/login" class="nav-link {{ Request::is('login') ? 'active' : '' }}">Login</a></li>
            <li class="nav-item"><a href="/register" class="nav-link {{ Request::is('register') ? 'active' : '' }}">Register</a></li>
            @endauth
        </ul>   
        </div>
      </div>
    </nav>
  </header>