<div class="user-container">
    <div class="user-profile-content">
        <div class="user-img">
            <img src="{{asset('images/admin.jpg')}}" alt="" srcset="">
        </div>
        <h5 id="user-name">{{Auth::user()->name}}</h5>
        <div class="user-stats">
            <div class="stat">
                <span>Total Sales</span><br>
                <span>120</span>
            </div>
            <div class="stat">
                <span>Total Sales</span><br>
                <span>120</span>
            </div>
        </div>
        <div>
            <a href="/logout" id="logout">Logout</a>
        </div>
    </div>
</div>