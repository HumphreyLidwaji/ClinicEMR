{{-- filepath: resources/views/layouts/partials/header.blade.php --}}
<div class="header">
    <div class="header-left">
        <div class="menu-icon bi bi-list"></div>

    </div>
    <div class="header-right">
        <div class="dashboard-setting user-notification">

        </div>
        <div class="user-notification">
            <div class="dropdown">
                <a class="dropdown-toggle no-arrow" href="#" role="button" data-toggle="dropdown">
                    <i class="icon-copy dw dw-notification"></i>
                    <span class="badge notification-active"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <div class="notification-list mx-h-350 customscroll">
                        <ul>
                            <li>
                                <a href="#"><img src="{{ asset('vendors/images/img.jpg') }}" alt="" />
                                    <h3>John Doe</h3>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed...</p>
                                </a>
                            </li>
                            <li>
                                <a href="#"><img src="{{ asset('vendors/images/photo1.jpg') }}" alt="" />
                                    <h3>Lea R. Frith</h3>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed...</p>
                                </a>
                            </li>
                            <li>
                                <a href="#"><img src="{{ asset('vendors/images/photo2.jpg') }}" alt="" />
                                    <h3>Erik L. Richards</h3>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed...</p>
                                </a>
                            </li>
                            <li>
                                <a href="#"><img src="{{ asset('vendors/images/photo3.jpg') }}" alt="" />
                                    <h3>John Doe</h3>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed...</p>
                                </a>
                            </li>
                            <li>
                                <a href="#"><img src="{{ asset('vendors/images/photo4.jpg') }}" alt="" />
                                    <h3>Renee I. Hansen</h3>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed...</p>
                                </a>
                            </li>
                            <li>
                                <a href="#"><img src="{{ asset('vendors/images/img.jpg') }}" alt="" />
                                    <h3>Vicki M. Coleman</h3>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed...</p>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="user-info-dropdown">
            <div class="dropdown">
                <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                    <span class="user-icon">
                        <img src="{{ asset('vendors/images/photo1.jpg') }}" alt="" />
                    </span>
                   <span class="user-name">{{ Auth::user()?->name ?? 'Guest' }}</span>

                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                    <a class="dropdown-item" href="{{ route('settings.profile.edit') }}"><i class="dw dw-user1"></i>
                        Profile</a>
                    <a class="dropdown-item" href=""><i class="dw dw-settings2"></i> Setting</a>
                    <a class="dropdown-item" href="faq.html"><i class="dw dw-help"></i> Help</a>


                    <form method="POST" action="{{ route('logout') }}" class="d-block w-100">
                        @csrf
                        <button type="submit" class="btn btn-link dropdown-item text-dark">
                            <i class="dw dw-logout mr-2"></i> Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
      <!--  <div class="github-link">
            <a href="https://github.com/humphreylidwaji" target="_blank">
                <img src="{{ asset('vendors/images/github.svg') }}" alt="" />
            </a>
        </div> -->
    </div>
</div>
