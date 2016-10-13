<li class="nav-item dropdown">
    <a class="nav-link navbar-avatar" data-toggle="dropdown" href="#" aria-expanded="false"
       data-animation="scale-up" role="button">
              <span class="avatar avatar-online">
                  @if(Gravatar::exists(Auth::user()->email))
                      <img src="{{Gravatar::get(Auth::user()->email)}}"/>
                  @else
                      <i class="icon wb-bell" aria-hidden="true"></i>
                  @endif
              </span>
    </a>
    <div class="dropdown-menu" role="menu">
        {{ loadExtendableView("top_user_menu") }}
    </div>
</li>