<header>
    <div id="header">
      <div class="container">
        <div class="logo"><img src="{{ URL::asset($asset_path.'images/'.$admin_logo) }}"></div>
        <div class="user-menu">
            <span>Welcome, Admin</span> | 
            <a class="sign_logout" href="{{ URL::to('_admin/logout') }}">Logout</a> | 
            <a class="sign_home" href="{{ URL::to('')}}" target="_blank">View Home</a>
        </div>
      </div>
    </div>
    <div id="menu">
        <div class="container">
            <div id="fade-menu" class="pull-left">
                <ul class="nav navbar-nav dropdown">
                    
                    <!--<li class="dropdown{{ $page == 'dashboard' ? ' active': '' }}"><a href="{{ URL::route('admin_dashboard') }}">Dashboard</a></li>-->
                    
                    
                    <li class="dropdown" {{ $page == "homepage" ? "class='active'" : '' }}>
                        <a href="{{ URL::route('admin_dashboard') }}">Home Page</a>
                        <ul>
                            <li><a href="{{ URL::route('admin_slideshow') }}">Manage Home Slideshow</a></li>
                            <li><a href="{{ URL::route('admin_header_link') }}">Manage Header Link</a></li>
                            <li><a href="{{ URL::route('admin_banner') }}">Manage Banner</a></li>
                            <li><a href="{{ URL::route('admin_home_video') }}">Manage Home Video</a></li>
                            <li><a href="{{ URL::route('admin_footer') }}">Manage Footer</a></li>
                        </ul>
                    </li>
                    
                <li class="dropdown" {{ $page == 'catalog' ? 'active': '' }}"><a href="{{ URL::route('admin_product') }}">Product</a>
                        <ul>
                            <li><a href="{{ URL::route('admin_product') }}">Manage Products</a></li>
                            <li><a href="{{ URL::route('admin_brands') }}">Manage Brand</a></li>
                            <li><a href="{{ URL::route('admin_categories') }}">Manage Category</a></li>
                        </ul>
                    </li>
                    
                    
                    <!--    <li class="dropdown" {{ $page == "static_pages" ? "class='active'" : '' }}>-->
                    <!--    <a href="{{ URL::route('admin_product') }}">Manage Static Pages</a>-->
                    <!--    <ul>-->
                    <!--        <li><a href="{{ URL::route('admin_static_pages') }}">Manage Page Header</a></li>-->
                    <!--        <li><a href="{{ URL::route('admin_about') }}">Manage About</a></li>-->
                    <!--        <li><a href="{{ URL::route('admin_industrial_line') }}">Manage Industrial Line</a></li>-->
                    <!--        <li><a href="{{ URL::route('admin_why_choose_us') }}">Manage Why Choose Us</a></li>-->
                    <!--        <li><a href="{{ URL::route('admin_meet_our_suppliers') }}">Manage Meet Our Suppliers</a></li>-->
                    <!--        <li><a href="{{ URL::route('admin_upcoming_events') }}">Manage Upcoming Event</a></li>-->
                    <!--    </ul>-->
                    <!--</li>-->
                    
                    
                    <li class="dropdown{{ $page == 'pages' ? ' active': '' }}"><a href="{{ URL::route('admin_pages') }}">Manage Pages</a></li>
                    <li class="dropdown" {{ $page == "contact" ? "class='active'" : '' }}>
                        <a href="{{ URL::route('admin_contact_address') }}">Contact</a>
                        <ul>
                            <li><a href="{{ URL::route('admin_contact_message') }}">Manage Contact Message</a></li>
                            <li><a href="{{ URL::route('admin_contact_address') }}">Manage Contact Address</a></li>
                        </ul>
                    </li>
                    
                    <!--NEWSLETTER SEO-->
                    <li class="dropdown{{ $page == 'page' ? 'active': ''}}"
                    ><a href="#SEO">Newsletter (SEO)</a></li>
                    <li class="dropdown" {{ $page == "newsletter" ? "class='active'" : ''}}>

                    
                    <!--<li class="dropdown" {{ $page == "system" ? "class='active'" : '' }}>-->
                    <!--    <a href="#">System</a>-->
                    <!--    <ul>-->
                    <!--        <li><a href="{{ URL::route('admin_newsletter') }}">Manage Newsletter</a></li>-->
                    <!--        <li><a href="{{ URL::route('admin_social_link') }}">Manage Social Link</a></li>-->
                    <!--        <li><a href="{{ URL::route('admin_seo') }}">Manage SEO</a></li>-->
                    <!--        <li><a href="{{ URL::route('admin_administrator') }}">Manage Administrator</a></li>-->
                    <!--        <li><a href="{{ URL::route('admin_ga') }}">Manage Google Analytics</a></li>-->
                    <!--        <li><a href="{{ URL::route('admin_setting') }}">Email Config</a></li>-->
                    <!--    </ul>-->
                    <!--</li>-->
                </ul>
            </div>
        </div>
    </div>
</header>