 <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav mx-auto" style="vertical-align: middle" id="sidebar-nav">
      
        <li class="nav-item">
            <a class="nav-link " href="{{url('/admin')}}">
              <i class="bi bi-grid"></i>
              <span>Trang chủ</span>
            </a>
          </li>
    
          <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#machine-nav" data-bs-toggle="collapse" href="#">
              <i class="bi bi-menu-button-wide"></i><span>Sản phẩm</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="machine-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
              <li>
                <a href="{{route('products.list')}}">
                  <i class="bi bi-circle"></i><span>Tất cả sản phẩm</span>
                </a>
              </li>
              <li>
                <a href="{{route('category.list')}}">
                  <i class="bi bi-circle"></i><span>Loại sản phẩm</span>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#user-nav" data-bs-toggle="collapse" href="#">
              <i class="bi bi-person-circle"></i><span>Quản lý người dùng</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="user-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
              <li>
                <a href="{{route('customer.list')}}">
                  <i class="bi bi-circle"></i><span>Danh sách người dùng</span>
                </a>
              </li>
            </ul>
          </li>

        </li>
        <li class="nav-item">
          <a class="nav-link collapsed" data-bs-target="#bill-nav" data-bs-toggle="collapse" href="#">
            <i class="fa-solid fa-money-bill"></i></i><span>Đơn hàng</span><i class="bi bi-chevron-down ms-auto"></i>
          </a>
          <ul id="bill-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
              <a href="{{route('bill.list')}}">
                <i class="bi bi-circle"></i><span>Tất cả đơn hàng</span>
              </a>
            </li>
          </ul>
        </li>

        </li>
        <li class="nav-item">
          <a class="nav-link collapsed" data-bs-target="#comment-nav" data-bs-toggle="collapse" href="#">
            <i class="fa-regular fa-comment"></i><span>Bình luận</span><i class="bi bi-chevron-down ms-auto"></i>
          </a>
          <ul id="comment-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
              <a href="{{route('comment.list')}}">
                <i class="bi bi-circle"></i><span>Tất cả bình luận</span>
              </a>
            </li>
          </ul>
        </li><!-- End Components Nav -->

      
    </ul>

  </aside>