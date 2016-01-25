    <div class="full-width header-minimal">
      <div class="row">
        <div class="small-1 columns right-sect">

          <div class="logo-wrapper">
              <a href="/"><img src="images/logo.png" alt=""></a>

          </div>
        </div>
        <div class="small-4 columns middle-sect">
          <p><i class="fi-telephone"></i> 1800 3000 4545 (Toll Free)</p>
        </div>
        <div class="small-7 columns right-sect">
          <div class="row">
            <div class="small-3 columns">
              <div class="row">
                <div class="small-3 columns">
                  <label class="right inline">City</label>
                </div>
                <div class="small-9 columns">
                  <select name="" id="">
                    <option value="">Trichy</option>
                    <option value="">Tanjore</option>
                    <option value="">Karur</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="small-6 columns">
              <div class="row">
                <div class="small-5 columns">
                  <label class="right inline">Delivery Time</label>
                </div>
                <div class="small-7 columns">
                  <select name="" id="">
                    <option value="">08:00-11:00 am</option>
                    <option value="">12:00-04:00 pm</option>
                    <option value="">05:00-08:00 pm</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="small-3 columns">
              <div class="row">
                <div class="small-12 columns">
                  <p class="text-right">
                    @if ($user = Sentinel::check())
                      <a data-dropdown="user-menu" data-options="is_hover:true; hover_timeout:3000" href="#"><i class="fa fa-user"></i> My Account <i class="fa fa-caret-down"></i></a>
                      <ul id="user-menu" class="tiny f-dropdown" data-dropdown-content>
                        <li><a href="#">Profile</a></li>
                        <li><a href="#">Orders</a></li>
                        <li><a href="#">Notifications</a></li>
                        <li><a href="/logout">Logout</a></li>
                      </ul>
                    @else

                      <a href="#" data-reveal-id="loginModal"><i class="fa fa-user"></i> Login / Signup</a>
                    @endif
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>