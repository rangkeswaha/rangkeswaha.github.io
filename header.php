<!-- BEGIN HEADER -->

<div class="header navbar navbar-inverse ">
    <!-- BEGIN TOP NAVIGATION BAR -->
    <div class="navbar-inner">
        <div class="header-seperation">
            <ul class="nav pull-left notifcation-center visible-xs visible-sm">
                <li class="dropdown">
                    <a href="#main-menu" data-webarch="toggle-left-side">
                        <i class="material-icons">menu</i>
                    </a>
                </li>
            </ul>
            <!-- BEGIN LOGO -->
            <a href="/skripsi/apps/index.php">
                <!-- <img src="/PTRutan/LEAPHRIS/kerjaan/assets/img/logo.png" class="logo" alt="" data-src="/PTRutan/LEAPHRIS/kerjaan/assets/img/logo.png"
                    data-src-retina="/PTRutan/LEAPHRIS/kerjaan/assets/img/logo2x.png" width="106" height="21" /> -->
                <!-- <img style="margin-top: -7%;" src="/PTRutan/LEAPHRIS/kerjaan/assets/img/ptrutan-logo.png" class="logo" alt="" data-src="/PTRutan/LEAPHRIS/kerjaan/assets/img/logo.png"
                    data-src-retina="/PTRutan/LEAPHRIS/kerjaan/assets/img/ptrutan-logo.png" width="106" height="106" /> -->
                    <!-- <strong style="color: white; font-size: 300%; margin-left: 5%; margin-top: 5%;">HRIS</strong> -->
                <strong style="color: white; font-size: 250%; margin-left: 5%; margin-top: 5%;">Artha Makmur</strong>
            </a>
            <!-- END LOGO -->
            <ul class="nav pull-right notifcation-center">
                <li class="dropdown visible-xs visible-sm">
                    <a href="#" id="refreshPage" >
                        <i class="material-icons">refresh</i>
                    </a>
                </li>
            </ul>
        </div>
        <!-- END RESPONSIVE MENU TOGGLER -->
        <div class="header-quick-nav">
            <!-- BEGIN TOP NAVIGATION MENU -->
            <div class="pull-left">
                <ul class="nav quick-section">
                    <li class="quicklinks">
                        <a href="#" class="" id="layout-condensed-toggle">
                            <i class="material-icons">menu</i>
                        </a>
                    </li>
                </ul>
                <ul class="nav quick-section">
                    <li class="quicklinks  m-r-10">
                        <a href="#" class="" id="refreshPage2">
                            <i class="material-icons">refresh</i>
                        </a>
                    </li>
                </ul>
            </div>
            <div id="notification-list" style="display:none">
                <div style="width:300px">
                    <!-- <div class="notification-messages info">
                        <div class="user-profile">
                            <img src="/PTRutan/LEAPHRIS/kerjaan/assets/img/profiles/d.jpg" alt="" data-src="/PTRutan/LEAPHRIS/kerjaan/assets/img/profiles/d.jpg"
                                data-src-retina="/PTRutan/LEAPHRIS/kerjaan/assets/img/profiles/d2x.jpg" width="35" height="35">
                        </div>
                        <div class="clearfix"></div>
                    </div> -->
                </div>
            </div>
            <!-- END TOP NAVIGATION MENU -->
            <!-- BEGIN CHAT TOGGLER -->
            <div class="pull-right">
                <!-- <div class="chat-toggler sm">
                    <div class="profile-pic">
                        <a class="profile-click" id="profile2" name="profile2"><img src="/PTRutan/LEAPHRIS/kerjaan/assets/img/profiles/avatar_small.jpg" alt=""
                            data-src="/PTRutan/LEAPHRIS/kerjaan/assets/img/profiles/avatar_small.jpg"
                            data-src-retina="/PTRutan/LEAPHRIS/kerjaan/assets/img/profiles/avatar_small2x.jpg" width="35" height="35" /></a>
                        <div class="availability-bubble online"></div>
                    </div>
                </div> -->
                <ul class="nav quick-section ">
                    <li class="quicklinks">
                        <!-- <a data-toggle="dropdown" class="dropdown-toggle  pull-right " href="#" id="user-options">
                            <i class="material-icons">tune</i>
                        </a> -->
                        <ul class="dropdown-menu  pull-right" role="menu" aria-labelledby="user-options">
                            <!-- <li class="divider"></li> -->
                            <li>
                                <a href="#" name="Logout" id="Logout"><i name="Logout" id="Logout" class="material-icons">power_settings_new</i>&nbsp;&nbsp;Log
                                    Out</a>
                            </li>
                        </ul>
                    </li>
                    <!-- <li class="quicklinks"> <span class="h-seperate"></span></li> -->
                </ul>
            </div>
            <!-- END CHAT TOGGLER -->
        </div>
        <!-- END TOP NAVIGATION MENU -->
    </div>
    <!-- END TOP NAVIGATION BAR -->
</div>
<!-- END HEADER -->

<script>
    $('#refreshPage').click(function(){
        location.reload(); 
        // console.log("masuk");
    });
    $('#refreshPage2').click(function(){
        location.reload(); 
        // console.log("masuk");
    });
</script>