<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
      <ul class="nav flex-column">
        <li class="nav-item">
          <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" aria-current="page" href="/dashboard">
            <span data-feather="home"></span>
            Dashboard
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('dashboard/products*') ? 'active' : '' }}" href="/dashboard/products">
            <span data-feather="shopping-cart"></span>
            Products
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('dashboard/history*') ? 'active' : '' }}" href="/dashboard/history">
            <span data-feather="package"></span>
            Orders
          </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Request::is('dashboard/posts*') ? 'active' : '' }}" href="/dashboard/posts">
              <span data-feather="file-text"></span>
              Posts
            </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('dashboard/messages*') ? 'active' : '' }}" href="/dashboard/messages">
            <span data-feather="mail"></span>
            Messages
          </a>
        </li>
      </ul>

      @can('admin')
      <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
        <span>Administrator</span>
      </h6>
      <ul class="nav flex-column">
        <li class="nav-item">
          <a class="nav-link {{ Request::is('dashboard/users*') ? 'active' : '' }}" href="/dashboard/users">
            <span data-feather="users"></span>
            Users
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('dashboard/product_categories*') ? 'active' : '' }}" href="/dashboard/product_categories">
            <span data-feather="grid"></span>
            Product Categories
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('dashboard/post_categories*') ? 'active' : '' }}" href="/dashboard/post_categories">
            <span data-feather="grid"></span>
            Post Categories
          </a>
        </li>
      </ul>
      @endcan
    </div>
  </nav>