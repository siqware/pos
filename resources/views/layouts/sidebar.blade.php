<div class="ui sidebar vertical left menu overlay  borderless visible sidemenu inverted  grey"
     style="-webkit-transition-duration: 0.1s; transition-duration: 0.1s;" data-color="grey">
    <a class="item logo" href="index.html">
        <img src="{{asset('sigware/img/logo.png')}}" alt="sigwarelogo"/><img
            src="{{asset('sigware/img/thumblogo.png')}}" alt="sigwarelogo" class="displaynone"/>
    </a>
    {{--menu item mobile--}}
    <a class="item {{request()->is('dashboard')? 'active':''}} popupHover" href="{{route('dashboard.index')}}" data-content="ផ្ទាំងគ្រប់គ្រង" data-position="right center">
        <i class="ion-speedometer icon"></i> <span class="colhidden">ផ្ទាំងគ្រប់គ្រង</span>
    </a>
    <div class="ui dropdown item displaynone scrolling popupHover"  data-content="ទំនិញ" data-position="right center">
        <span>ទំនិញ</span>
        <i class="cubes icon"></i>

        <div class="menu">
            <div class="header">
                ទំនិញ
            </div>
            <div class="ui divider"></div>
            <a class="item" href="{{route('product.index')}}">
                ទាំអស់
            </a>
            <a class="item" href="{{route('product.create')}}">
                បន្ថែម
            </a>
            {{--<a class="item" href="">
                ព្រីនស្ទិកគើ
            </a>--}}
        </div>
    </div>

    <a class="item popupHover {{request()->is('stock-import')? 'active':''}}" href="{{route('stock.import')}}" data-content="នាំទំនិញចូល" data-position="right center">
        <i class="ion-arrow-down-a icon"></i><span class="colhidden">នាំទំនិញចូល</span>
    </a>
    <a class="popupHover item" href="{{route('pos.index')}}" data-content="លក់ទំនិញ" data-position="right center">
        <i class="ion-android-cart icon"></i><span class="colhidden">លក់ទំនិញ</span>
    </a>
    <a class="item popupHover {{request()->is('media')? 'active':''}}" href="{{route('media.index')}}" href="#" data-content="មេឌៀ" data-position="right center">
        <i class="ion-images icon"></i><span class="colhidden">មេឌៀ</span>
    </a>
    <div class="ui accordion inverted">
        {{--Dropdown desktop--}}
        <a class="title item {{request()->is('product*')? 'active':''}}">
            <i class="cubes icon titleIcon"></i> ទំនិញ <i class="dropdown icon"></i>
        </a>
        <div class="content {{request()->is('product*')? 'active':''}}">
            <a class="item {{request()->is('product')? 'active':''}}" href="{{route('product.index')}}">
                ទាំអស់
            </a>
            <a class="item {{request()->is('product/create')? 'active':''}}" href="{{route('product.create')}}">
                បន្ថែម
            </a>
            {{--<a class="item" href="">
                ព្រីនស្ទិកគើ
            </a>--}}
        </div>
        {{--Dropdown desktop--}}
        <a class="title item {{request()->is('user*')? 'active':''}}">
            <i class="ion-android-people icon titleIcon"></i> អ្នកប្រើប្រាស់ <i class="dropdown icon"></i>
        </a>
        <div class="content {{request()->is('user*')? 'active':''}}">
            <a class="item {{request()->is('user')? 'active':''}}" href="{{route('user.index')}}">
                ទាំអស់
            </a>
            <a class="item {{request()->is('user/create')? 'active':''}}" href="{{route('user.create')}}">
                បន្ថែម
            </a>
        </div>
        <a class="title item {{request()->is('report*')? 'active':''}}">
            <i class="line chart icon titleIcon"></i> របាយការណ៍ <i class="dropdown icon"></i>
        </a>
        <div class="content {{request()->is('report*')? 'active':''}}">
            <a class="item {{request()->is('report/import-export')? 'active':''}}" href="{{route('report.import.export')}}">
                លក់ចេញ / ទិញចូល
            </a>
            <a class="item {{request()->is('report/income-expense')? 'active':''}}" href="{{route('report.income.expense')}}">
                ចំណូល / ចំណាយ
            </a>
            {{--<a class="item" href="">
                ពិនិត្យស្តុក
            </a>--}}
        </div>

    </div>
    {{--Dropdown mobile--}}
    <div class="ui dropdown item displaynone scrolling popupHover"  data-content="អ្នកប្រើប្រាស់" data-position="right center">
        <span>អ្នកប្រើប្រាស់</span>
        <i class="ion-android-people icon"></i>

        <div class="menu">
            <div class="header">
                អ្នកប្រើប្រាស់
            </div>
            <div class="ui divider"></div>
            <a class="item" href="{{route('user.index')}}">
                ទាំអស់
            </a>
            <a class="item" href="{{route('user.create')}}">
                បន្ថែម
            </a>
        </div>
    </div>
    <div class="ui dropdown item displaynone scrolling popupHover"  data-content="របាយការណ៍" data-position="right center">
        <span>របាយការណ៍</span>
        <i class="area chart icon"></i>

        <div class="menu">
            <div class="header">
                របាយការណ៍
            </div>
            <div class="ui divider"></div>
            <a class="item" href="{{route('report.import.export')}}">
                លក់ចេញ / ទិញចូល
            </a>
            <a class="item" href="{{route('report.income.expense')}}">
                ចំណូល / ចំណាយ
            </a>
            {{--<a class="item" href="">
                ពិនិត្យស្តុក
            </a>--}}
        </div>
    </div>
</div>
