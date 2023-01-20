<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
   <div class="sb-sidenav-menu">
      <div class="nav">
         <!-- link:dashboard -->
         <a class="nav-link" href="{{route('dashboard.index')}}">
            <div class="sb-nav-link-icon">
               <i class="fas fa-tachometer-alt"></i>
            </div>
            <!-- chuyen ngon ngu bang dieu khien  -->

            {{ trans('dashboard.link.dashboard') }}
         </a>

         <!-- menu đấng sáng tạo -->
         <div class="sb-sidenav-menu-heading">
         {{ trans('dashboard.menu.master') }}

         </div>
<!-- menu:posts -->

<a class="nav-link {{ set_active(['posts.index','posts.create']) }}"
          href="{{route('posts.index')}}">
            <div class="sb-nav-link-icon">
               <i class="far fa-newspaper"></i>
            </div>
            {{ trans('dashboard.link.posts') }}
         </a>
        
         <!-- menu:categories -->
         
         <!-- <a class="nav-link {{ set_active(['categories.index','categories.create','categories.edit','categories.show']) }}" href="{{route('categories.index')}}"> -->
         <a class="nav-link {{ set_active(['categories.index','categories.create','categories.edit','categories.show']) }}" href="{{route('categories.index')}}">

            <div class="sb-nav-link-icon">
               <i class="fas fa-bookmark"></i>
            </div>
            {{ trans('dashboard.link.categories') }}
         </a>
          <!-- menu:tags -->
        
         <a class="nav-link {{ set_active(['tags.index','tags.create', 'tags.edit']) }}" href="{{route('tags.index')}}">
            <div class="sb-nav-link-icon">
               <i class="fas fa-tags"></i>
            </div>
            {{ trans('dashboard.link.file_manager') }}

         </a>
         <!-- menu:user permision -->
         <div class="sb-sidenav-menu-heading">
         {{ trans('dashboard.menu.user_permission') }}
         </div>
         <a class="nav-link" href="#">
            <div class="sb-nav-link-icon">
               <i class="fas fa-user"></i>
            </div>
            {{ trans('dashboard.link.users') }}
         </a>
         <a class="nav-link" href="#">
            <div class="sb-nav-link-icon">
               <i class="fas fa-user-shield"></i>
            </div>
            {{ trans('dashboard.link.roles') }}
         </a>
         <!-- menu::setting -->
         <div class="sb-sidenav-menu-heading">
         {{ trans('dashboard.menu.setting') }}

         </div>
         <a class="nav-link" href="#">
            <div class="sb-nav-link-icon">
               <i class="fas fa-photo-video"></i>
            </div>
            {{ trans('dashboard.link.profile') }}
         </a>
      </div>
   </div>
   <div class="sb-sidenav-footer">
      <div class="small">Logged in as:</div>
      <!-- show username -->
      sidebar - {{Auth::user()->name}}
   </div>
</nav>