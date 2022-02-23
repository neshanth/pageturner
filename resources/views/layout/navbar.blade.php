 <div class="site-navbar bg-white py-2">

     <div class="search-wrap">
         <div class="container">
             <a href="#" class="search-close js-search-close"><span class="icon-close2"></span></a>
             <form action="{{ route('search') }}">
                 <input type="text" name="query" class="form-control" placeholder="Search By book Name or Author" required>
             </form>
         </div>
     </div>
     <div class="container">
         <div class="d-flex align-items-center justify-content-between">
             <div class="logo">
                 <div class="site-logo">
                     <a href="/">
                         <img src="{{ asset('images/logo.png') }}" alt="Logo" width="50" />
                     </a>
                 </div>
             </div>
             <div class="main-nav d-none d-lg-block">
                 <nav class="site-navigation text-right text-md-center" role="navigation">
                     <ul class="site-menu js-clone-nav d-none d-lg-block">
                         <li class="has-children active">
                             <a href="#">Categories</a>
                             <ul class="dropdown">
                                 @foreach ($categories as $category)
                                 <li><a href={{ url("/category",[$category->id]) }}>{{ $category->name }}</a></li>
                                 @endforeach

                             </ul>
                         </li>
                         <li><a href="/genres">All Genres</a></li>
                         @auth
                         <li><a href="{{ route('dashboard') }}"> <span class="icon-user-o text--custom-primary"></span> My Profile</a></li>
                         @endauth
                     </ul>
                 </nav>
             </div>
             <div class="icons">
                 <a href="#" class="icons-btn d-inline-block js-search-open"><span class="icon-search"></span></a>
                 @guest
                 <a href="{{ route('login') }}" class="icons-btn d-inline-block"><span class="icon-user-o"></span></a>
                 @endguest
                 <a href="/cart/show" class="icons-btn d-inline-block bag">
                     <span class="icon-shopping-bag"></span>
                     <span class="number cart-count">0</span>
                 </a>
                 <a href="#" class="site-menu-toggle js-menu-toggle ml-3 d-inline-block d-lg-none"><span class="icon-menu"></span></a>
             </div>
         </div>
     </div>
 </div>