<div class="sidebar">
    <!-- start with head -->
    @php
         $data = DB::table('settings')->orderBy('id','DESC')->first();

    @endphp
    <div class="head">
      <div class="logo">
        @if(isset($data))
        <img  width="100" height="100px" src="{{url($data->logo)}}" alt="">
        @endif
      </div>
      @if(isset($data))
      <a href="#" class="btn btn-danger">{{$data->company_name}}</a>
      @endif
    </div>
    <!-- end with head -->
    <!-- start the list -->
    <div id="list">
      <ul class="nav flex-column">


        @php
        $user_data = Auth::guard('admin')->user();

        @endphp
      @if($user_data->admin == 1)



        @php $expenseActive = request()->routeIs('Admin.expensename') || request()->routeIs('Admin.expense'); @endphp
        <li class="nav-item">
            <a href="#menu3" class="nav-link {{ $expenseActive ? 'active' : 'collapsed' }}" data-toggle="collapse"><i class="fa fa-fire"></i>Expense<span class="sub-ico"><i class="fa fa-angle-down"></i></span></a>
        </li>
        <li class="sub collapse {{ $expenseActive ? 'show' : '' }}" id="menu3">
            <a href="{{route('Admin.expensename')}}" class="nav-link {{ request()->routeIs('Admin.expensename') ? 'active' : '' }}" data-parent="#menu3">Expense Name</a>
            <a href="{{route('Admin.expense')}}" class="nav-link {{ request()->routeIs('Admin.expense') ? 'active' : '' }}" data-parent="#menu3">Expense Add</a>

        </li>



        @php $earningActive = request()->routeIs('Admin.earningname') || request()->routeIs('Admin.earning'); @endphp
        <li class="nav-item">
            <a href="#menu4" class="nav-link {{ $earningActive ? 'active' : 'collapsed' }}" data-toggle="collapse"><i class="fa fa-dollar-sign"></i>Earning<span class="sub-ico"><i class="fa fa-angle-down"></i></span></a>
        </li>
        <li class="sub collapse {{ $earningActive ? 'show' : '' }}" id="menu4">
            <a href="{{route('Admin.earningname')}}" class="nav-link {{ request()->routeIs('Admin.earningname') ? 'active' : '' }}" data-parent="#menu4">Earning Name</a>
            <a href="{{route('Admin.earning')}}" class="nav-link {{ request()->routeIs('Admin.earning') ? 'active' : '' }}" data-parent="#menu4">Earning</a>

        </li>

        <li class="nav-item"><a href="{{route('Admin.settings')}}" class="nav-link {{ request()->routeIs('Admin.settings') ? 'active' : '' }}"><i class="fa fa-cog"></i>Settings</a></li>
        {{-- <li class="nav-item"><a href="{{route('Admin.branch')}}" class="nav-link"><i class="fa fa-cog"></i>Branch Setup</a></li> --}}
        @php
            $websiteSetupRoutes = ['Admin.home_settings.edit','Admin.about_settings.edit','Admin.our_services.index','Admin.ongoing_activities.index','Admin.photo_gallery.index','Admin.upcoming_events.index','Admin.teams.index'];
            $websiteSetupActive = false;
            foreach($websiteSetupRoutes as $r){ if(request()->routeIs($r)){ $websiteSetupActive = true; break; } }
        @endphp
        <li class="nav-item">
            <a href="#websiteSetupMenu" class="nav-link {{ $websiteSetupActive ? 'active' : 'collapsed' }}" data-toggle="collapse">
                <i class="fa fa-cogs"></i> WebsiteSetup <span class="sub-ico"><i class="fa fa-angle-down"></i></span>
            </a>
        </li>
        <li class="sub collapse {{ $websiteSetupActive ? 'show' : '' }}" id="websiteSetupMenu">
            <a href="{{ route('Admin.home_settings.edit') }}" class="nav-link {{ request()->routeIs('Admin.home_settings.edit') ? 'active' : '' }}" data-parent="#websiteSetupMenu">
                <i class="fa fa-image"></i> Home Settings
            </a>
            <a href="{{ route('Admin.about_settings.edit') }}" class="nav-link {{ request()->routeIs('Admin.about_settings.edit') ? 'active' : '' }}" data-parent="#websiteSetupMenu">
                <i class="fa fa-info-circle"></i> About Settings
            </a>
            <a href="{{ route('Admin.our_services.index') }}" class="nav-link {{ request()->routeIs('Admin.our_services.index') ? 'active' : '' }}" data-parent="#websiteSetupMenu">
                <i class="fa fa-th"></i> Our Services
            </a>
            <a href="{{ route('Admin.ongoing_activities.index') }}" class="nav-link {{ request()->routeIs('Admin.ongoing_activities.index') ? 'active' : '' }}" data-parent="#websiteSetupMenu">
                <i class="fa fa-tasks"></i> Ongoing Activities
            </a>
            <a href="{{ route('Admin.photo_gallery.index') }}" class="nav-link {{ request()->routeIs('Admin.photo_gallery.index') ? 'active' : '' }}" data-parent="#websiteSetupMenu">
                <i class="fa fa-picture-o"></i> Photo Gallery
            </a>
            <a href="{{ route('Admin.upcoming_events.index') }}" class="nav-link {{ request()->routeIs('Admin.upcoming_events.index') ? 'active' : '' }}" data-parent="#websiteSetupMenu">
                <i class="fa fa-calendar"></i> Upcoming Events
            </a>
            <a href="{{ route('Admin.teams.index') }}" class="nav-link {{ request()->routeIs('Admin.teams.index') ? 'active' : '' }}" data-parent="#websiteSetupMenu">
                <i class="fa fa-users"></i> Team
            </a>
        </li>


        @endif
        <li class="nav-item"><a href="{{url('admin/adminlogout')}}" class="nav-link"><i class="fa fa-logout"></i>Logout</a></li>
      </ul>
    </div>
    <!-- end the list -->
  </div>
