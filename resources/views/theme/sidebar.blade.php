<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link" href="/dashboard">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                <div class="sb-sidenav-menu-heading">Interface</div>
                <a class="nav-link" href="/categories">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Categories
                </a>
                <a class="nav-link" href="/subcategories">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Subcategories
                </a>
                <a class="nav-link" href="/blog">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Blogs
                </a>
                <a class="nav-link" href="/users">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Users
                </a>
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as: {{session('name')}}</div>
            
        </div>
    </nav>
</div>
