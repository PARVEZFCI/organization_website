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
            <a href="{{route('Admin.expensename')}}" class="nav-link {{ request()->routeIs('Admin.expensename') ? 'active' : '' }}" data-parent="#menu3"><i class="fa fa-list"></i> Expense Name</a>
            <a href="{{route('Admin.expense')}}" class="nav-link {{ request()->routeIs('Admin.expense') ? 'active' : '' }}" data-parent="#menu3"><i class="fa fa-plus-circle"></i> Expense Add</a>

        </li>



        @php $earningActive = request()->routeIs('Admin.earningname') || request()->routeIs('Admin.earning'); @endphp
        <li class="nav-item">
            <a href="#menu4" class="nav-link {{ $earningActive ? 'active' : 'collapsed' }}" data-toggle="collapse"><i class="fa fa-dollar-sign"></i>Earning<span class="sub-ico"><i class="fa fa-angle-down"></i></span></a>
        </li>
        <li class="sub collapse {{ $earningActive ? 'show' : '' }}" id="menu4">
            <a href="{{route('Admin.earningname')}}" class="nav-link {{ request()->routeIs('Admin.earningname') ? 'active' : '' }}" data-parent="#menu4"><i class="fa fa-list"></i> Earning Name</a>
            <a href="{{route('Admin.earning')}}" class="nav-link {{ request()->routeIs('Admin.earning') ? 'active' : '' }}" data-parent="#menu4"><i class="fa fa-plus-circle"></i> Earning</a>

        </li>

        <li class="nav-item"><a href="{{route('Admin.settings')}}" class="nav-link {{ request()->routeIs('Admin.settings') ? 'active' : '' }}"><i class="fa fa-cog"></i>Settings</a></li>

        {{-- Content Management --}}
        @php
            $contentRoutes = ['Admin.home_settings.edit','Admin.about_settings.edit','Admin.photo_gallery.index','Admin.leadership_messages.index'];
            $contentActive = false;
            foreach($contentRoutes as $r){ if(request()->routeIs($r)){ $contentActive = true; break; } }
        @endphp
        <li class="nav-item">
            <a href="#contentMenu" class="nav-link {{ $contentActive ? 'active' : 'collapsed' }}" data-toggle="collapse">
                <i class="fa fa-file-alt"></i> Content Management <span class="sub-ico"><i class="fa fa-angle-down"></i></span>
            </a>
        </li>
        <li class="sub collapse {{ $contentActive ? 'show' : '' }}" id="contentMenu">
            <a href="{{ route('Admin.home_settings.edit') }}" class="nav-link {{ request()->routeIs('Admin.home_settings.edit') ? 'active' : '' }}" data-parent="#contentMenu">
                <i class="fa fa-home"></i> Home Page
            </a>
            <a href="{{ route('Admin.about_settings.edit') }}" class="nav-link {{ request()->routeIs('Admin.about_settings.edit') ? 'active' : '' }}" data-parent="#contentMenu">
                <i class="fa fa-info-circle"></i> About Page
            </a>
            <a href="{{ route('Admin.photo_gallery.index') }}" class="nav-link {{ request()->routeIs('Admin.photo_gallery.index') ? 'active' : '' }}" data-parent="#contentMenu">
                <i class="fa fa-images"></i> Photo Gallery
            </a>
            <a href="{{ route('Admin.leadership_messages.index') }}" class="nav-link {{ request()->routeIs('Admin.leadership_messages.*') ? 'active' : '' }}" data-parent="#contentMenu">
                <i class="fa fa-comment-alt"></i> Leadership Messages
            </a>
        </li>

        {{-- Services & Events --}}
        @php
            $servicesActive = request()->routeIs('Admin.our_services.index') || request()->routeIs('Admin.ongoing_activities.index') || request()->routeIs('Admin.upcoming_events.index');
        @endphp
        <li class="nav-item">
            <a href="#servicesMenu" class="nav-link {{ $servicesActive ? 'active' : 'collapsed' }}" data-toggle="collapse">
                <i class="fa fa-calendar-check"></i> Services & Events <span class="sub-ico"><i class="fa fa-angle-down"></i></span>
            </a>
        </li>
        <li class="sub collapse {{ $servicesActive ? 'show' : '' }}" id="servicesMenu">
            <a href="{{ route('Admin.our_services.index') }}" class="nav-link {{ request()->routeIs('Admin.our_services.index') ? 'active' : '' }}" data-parent="#servicesMenu">
                <i class="fa fa-concierge-bell"></i> Our Services
            </a>
            <a href="{{ route('Admin.ongoing_activities.index') }}" class="nav-link {{ request()->routeIs('Admin.ongoing_activities.index') ? 'active' : '' }}" data-parent="#servicesMenu">
                <i class="fa fa-tasks"></i> Ongoing Activities
            </a>
            <a href="{{ route('Admin.upcoming_events.index') }}" class="nav-link {{ request()->routeIs('Admin.upcoming_events.index') ? 'active' : '' }}" data-parent="#servicesMenu">
                <i class="fa fa-calendar-alt"></i> Upcoming Events
            </a>
        </li>

        {{-- Organization Structure --}}
        @php
            $organizationActive = request()->routeIs('Admin.teams.index') || request()->routeIs('Admin.committee.index') || request()->routeIs('Admin.past-committee-periods.*') || request()->routeIs('Admin.past-committee-members.*') || request()->routeIs('Admin.advisors.index');
        @endphp
        <li class="nav-item">
            <a href="#organizationMenu" class="nav-link {{ $organizationActive ? 'active' : 'collapsed' }}" data-toggle="collapse">
                <i class="fa fa-sitemap"></i> Organization <span class="sub-ico"><i class="fa fa-angle-down"></i></span>
            </a>
        </li>
        <li class="sub collapse {{ $organizationActive ? 'show' : '' }}" id="organizationMenu">
            <a href="{{ route('Admin.teams.index') }}" class="nav-link {{ request()->routeIs('Admin.teams.index') ? 'active' : '' }}" data-parent="#organizationMenu">
                <i class="fa fa-users"></i> Team Members
            </a>
            <a href="{{ route('Admin.committee.index') }}" class="nav-link {{ request()->routeIs('Admin.committee.index') ? 'active' : '' }}" data-parent="#organizationMenu">
                <i class="fa fa-user-tie"></i> Executive Committee
            </a>
            <a href="{{ route('Admin.past-committee-periods.index') }}" class="nav-link {{ request()->routeIs('Admin.past-committee-periods.*') || request()->routeIs('Admin.past-committee-members.*') ? 'active' : '' }}" data-parent="#organizationMenu">
                <i class="fa fa-history"></i> Past Leaders
            </a>
            <a href="{{ route('Admin.advisors.index') }}" class="nav-link {{ request()->routeIs('Admin.advisors.index') ? 'active' : '' }}" data-parent="#organizationMenu">
                <i class="fa fa-user-shield"></i> Advisory Council
            </a>
        </li>

        {{-- Membership Management --}}
        @php
            $membershipActive = request()->routeIs('Admin.membership.index') || request()->routeIs('Admin.membership_fees.*') || request()->routeIs('Admin.monthly_payments.*');
        @endphp
        <li class="nav-item">
            <a href="#membershipMenu" class="nav-link {{ $membershipActive ? 'active' : 'collapsed' }}" data-toggle="collapse">
                <i class="fa fa-id-card"></i> Membership <span class="sub-ico"><i class="fa fa-angle-down"></i></span>
            </a>
        </li>
        <li class="sub collapse {{ $membershipActive ? 'show' : '' }}" id="membershipMenu">
            <a href="{{ route('Admin.membership.index') }}" class="nav-link {{ request()->routeIs('Admin.membership.index') ? 'active' : '' }}" data-parent="#membershipMenu">
                <i class="fa fa-user-check"></i> Members List
            </a>
            <a href="{{ route('Admin.membership_fees.index') }}" class="nav-link {{ request()->routeIs('Admin.membership_fees.*') ? 'active' : '' }}" data-parent="#membershipMenu">
                <i class="fa fa-dollar-sign"></i> Fee Management
            </a>
            <a href="{{ route('Admin.monthly_payments.index') }}" class="nav-link {{ request()->routeIs('Admin.monthly_payments.*') ? 'active' : '' }}" data-parent="#membershipMenu">
                <i class="fa fa-calendar-check"></i> Monthly Payments
            </a>
        </li>

        {{-- Documents --}}
        <li class="nav-item">
            <a href="{{ route('Admin.bylaws.edit') }}" class="nav-link {{ request()->routeIs('Admin.bylaws.edit') ? 'active' : '' }}">
                <i class="fa fa-book"></i> Constitution & Bylaws
            </a>
        </li>


        @endif
        <li class="nav-item"><a href="{{url('admin/adminlogout')}}" class="nav-link"><i class="fa fa-sign-out"></i> Logout</a></li>
      </ul>
    </div>
    <!-- end the list -->
  </div>
