<div class="navslide navwrap">
    <div class="ui menu icon borderless grid" data-color="inverted white">
        <a class="item labeled openbtn">
            <i class="ion-navicon-round big icon"></i>
        </a>
        <a class="item labeled expandit" onclick="toggleFullScreen(document.body)">
            <i class="ion-arrow-expand big icon"></i>
        </a>
        <div class="item ui colhidden">
            <div class="ui icon input">
                <input type="text" placeholder="Search...">
                <i class="search icon"></i>
            </div>
        </div>
        <div class="right menu colhidden">
            <div class="ui dropdown item labeled icon">
                <i class="bell icon"></i>
                <div class="ui red label small circular">6</div>
                <div class="menu" id="stock-notification">
                    <div class="header">
                        ទំនិញមិនទាន់មាន ឬអស់ពីស្តុក
                    </div>
                    <div class="item">
                        <img class="ui avatar image" src="{{asset('sigware/img/avatar/people/enid.png')}}" alt="label-image" />
                        អាវប្រេន (បារកូដ: 3948398343 ទំហំ: M)
                    </div>
                    <div class="ui divider"></div>
                    <a class="item" href="">បង្ហាញទាំអស់</a>
                </div>
            </div>
            <div class="ui dropdown item">
                <img class="ui mini circular image" src="{{asset('sigware/img/avatar/people/enid.png')}}" alt="label-image" />
                <div class="menu">
                    <a class="item" href="mail.html">Inbox</a>
                    <a class="item" href="profile.html">Profile</a>
                    <a class="item" href="settings.html">Settings</a>
                    <div class="ui divider"></div>
                    <a class="item">Need Help?</a>
                    <a class="item" href="login.html">Sign Out</a>
                </div>
            </div>
        </div>
    </div>
</div>
