<div class="sidebar">
    <!-- start with head -->
    @php
         $data = DB::table('settings')->orderBy('id','DESC')->first();

    @endphp
    <div class="head">
      <div class="logo">
        @if(isset($data))
        <img style="margin-left:-78px" width="200" height="200px" src="{{url($data->logo)}}" alt="">
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



        <li class="nav-item"><a href="#menu3" class="nav-link collapsed" data-toggle="collapse"><i class="fa fa-fire"></i>Expense<span class="sub-ico"><i class="fa fa-angle-down"></i></span></a></li>
        <li class="sub collapse" id="menu3">
            <a href="{{route('Admin.expensename')}}" class="nav-link" data-parent="#menu3">Expense Name</a>
            <a href="{{route('Admin.expense')}}" class="nav-link" data-parent="#menu3">Expense Add</a>

        </li>



        <li class="nav-item"><a href="#menu4" class="nav-link collapsed" data-toggle="collapse"><i class="fa fa-dollar-sign"></i>Earning<span class="sub-ico"><i class="fa fa-angle-down"></i></span></a></li>
        <li class="sub collapse" id="menu4">
            <a href="{{route('Admin.earningname')}}" class="nav-link" data-parent="#menu4">Earning Name</a>
            <a href="{{route('Admin.earning')}}" class="nav-link" data-parent="#menu4">Earning</a>

        </li>

        <li class="nav-item"><a href="{{route('Admin.settings')}}" class="nav-link"><i class="fa fa-cog"></i>Settings</a></li>
        {{-- <li class="nav-item"><a href="{{route('Admin.branch')}}" class="nav-link"><i class="fa fa-cog"></i>Branch Setup</a></li> --}}
        <li class="nav-item">
            <a href="#websiteSetupMenu" class="nav-link collapsed" data-toggle="collapse">
                <i class="fa fa-cogs"></i> WebsiteSetup <span class="sub-ico"><i class="fa fa-angle-down"></i></span>
            </a>
        </li>
        <li class="sub collapse" id="websiteSetupMenu">
            <a href="{{ route('Admin.home_settings.edit') }}" class="nav-link" data-parent="#websiteSetupMenu">
                <i class="fa fa-image"></i> Home Settings
            </a>
            <a href="{{ route('Admin.our_services.index') }}" class="nav-link" data-parent="#websiteSetupMenu">
                <i class="fa fa-th"></i> Our Services
            </a>
            <a href="{{ route('Admin.ongoing_activities.index') }}" class="nav-link" data-parent="#websiteSetupMenu">
                <i class="fa fa-tasks"></i> Ongoing Activities
            </a>
            <a href="{{ route('Admin.photo_gallery.index') }}" class="nav-link" data-parent="#websiteSetupMenu">
                <i class="fa fa-picture-o"></i> Photo Gallery
            </a>
            <a href="{{ route('Admin.upcoming_events.index') }}" class="nav-link" data-parent="#websiteSetupMenu">
                <i class="fa fa-calendar"></i> Upcoming Events
            </a>
            <a href="{{ route('Admin.teams.index') }}" class="nav-link" data-parent="#websiteSetupMenu">
                <i class="fa fa-users"></i> Team
            </a>
        </li>


        @endif
        <li class="nav-item"><a href="{{url('admin/adminlogout')}}" class="nav-link"><i class="fa fa-logout"></i>Logout</a></li>
      </ul>
    </div>
    <!-- end the list -->
  </div>
