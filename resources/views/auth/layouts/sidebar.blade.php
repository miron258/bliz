@section('sidebar')
<!-- Sidebar  -->
<nav id="sidebar">
    <div class="custom-menu">
        <button type="button" id="sidebarCollapse" class="btn btn-primary">
            <i class="fa fa-bars"></i>
            <span class="sr-only">Toggle Menu</span>
        </button>
    </div>
    <div class="p-4 pt-5">
<!--        <h1><a href="index.html" class="logo">Admin</a></h1>-->
        <ul class="list-unstyled components mb-5">
            <li class="active">
                <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Страницы</a>
                <ul class="collapse list-unstyled" id="pageSubmenu">
                    <li>
                        <a href="{{route('page.index')}}">Список страниц</a>
                    </li>
                    <li>
                        <a href="{{route('page.create')}}">Добавить страницу</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#catalogSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Каталоги</a>
                <ul class="collapse list-unstyled" id="catalogSubmenu">
                    <li>
                        <a href="#">Список каталогов</a>
                    </li>
                    <li>
                        <a href="#">Добавить каталог</a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="#productSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Товары</a>
                <ul class="collapse list-unstyled" id="productSubmenu">
                    <li>
                        <a href="#">Список товаров</a>
                    </li>
                    <li>
                        <a href="#">Добавить товар</a>
                    </li>
                </ul>
            </li>


        </ul>
<!--        <div class="mb-5">
            <h3 class="h6">Subscribe for newsletter</h3>
            <form action="#" class="colorlib-subscribe-form">
                <div class="form-group d-flex">
                    <div class="icon"><span class="icon-paper-plane"></span></div>
                    <input type="text" class="form-control" placeholder="Enter Email Address">
                </div>
            </form>
        </div>-->
<!--        <div class="footer">
            <p>
                Copyright &copy;<script type="cd342e15549a148012a31261-text/javascript">document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib.com</a>
            </p>
        </div>-->
    </div>
</nav>

<!-- End Sidebar -->
@endsection
