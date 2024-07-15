<i class="fa-solid fa-circle-up up"></i>

<header>
    <div class="main">
      <div class="header-holder">
          <img src="{{asset('imgs/logo.png')}}" onclick="window.location.href = '/'" alt="Logo" class="logo">
          <ul class="menu">
              <li class="sub-menu-link">
                <a href="#">
                    CERTIFICATIONS
                </a>
                <ul class="sub-menu">
                    <li>
                        <a href="/categories?t=s">
                            Simple Courses
                        </a>
                    </li>
                    <li>
                        <a href="/categories?t=l">
                            Advanced Courses
                        </a>
                    </li>
                    <li>
                        <a href="/categories">
                            Forms
                        </a>
                    </li>
                </ul>

              </li>
              <li>
                <a href="/about-us">
                    ABOUT US
                </a>
              </li>
              <li>
                <a href="/contact-us">
                    CONTACT US
                </a>
              </li>
          </ul>
      </div>
      <ul class="icons">
          <li class="icon">
              @if (Auth::user())
                <a href="/me">
                    <i class="fa-solid fa-user"></i>
                </a>
              @else
                <a href="/login">
                    <i class="fa-solid fa-user"></i>
                </a>
                  
              @endif
          </li>
      </ul>
    </div>
</header>
