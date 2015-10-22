<nav id="topbar" role="navigation" class="navbar navbar-default container pln prn">
    <div class="container-fluid pln prn">
        <div id="topbar-menu" class="navbar-collapse pln prn">
            <ul class="nav navbar-nav logo-wrapper">
                <li class="btn-menu-toggle">
                    <div id="menu-toggle" class="show-collapsed visible-sm visible-xs"><i class="fa fa-bars"></i></div>
                </li>
                <li class="pull-left"><a id="logo" href="main.php" class="pan"><img class="main-logo" src="assets/images/logo.png"/></a></li>
            </ul>
            <ul class="nav navbar-nav navbar-left topbar-nav">
                <!-- <li class="dropdown">
                	<a data-toggle="dropdown" href="#" class="dropdown-toggle">
                		<i class="icon-bell"></i>
                		<span data-pulsate="{parent:true,onClick:'stop',border:false,speed:800,reach: 20,delay:5000}" class="badge badge-success">2</span>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                        <li><p>You have 2 new notifications</p></li>
                        <li>
                            <div class="dropdown-slimscroll">
                                <ul>
                                    <li class="unread"><a href="extra-user-list.html" target="_blank"><span
                                        class="label label-info"><i class="fa fa-comment"></i></span>New
                                        Comment<span class="pull-right text-muted small">4 mins ago</span></a>
                                    </li>
                                    <li class="unread"><a href="extra-user-list.html" target="_blank"><span
                                        class="label label-success"><i class="fa fa-twitter"></i></span>3
                                        New Followers<span
                                        class="pull-right text-muted small">12 mins ago</span></a></li>
                                        <li><a href="extra-user-list.html" target="_blank"><span
                                            class="label label-warning"><i class="fa fa-envelope"></i></span>Message
                                            Sent<span class="pull-right text-muted small">15 mins ago</span></a>
                                        </li>
                                        <li><a href="extra-user-list.html" target="_blank"><span
                                            class="label label-success"><i class="fa fa-tasks"></i></span>New
                                            Task<span class="pull-right text-muted small">18 mins ago</span></a>
                                        </li>
                                        <li><a href="extra-user-list.html" target="_blank"><span
                                            class="label label-danger"><i class="fa fa-upload"></i></span>Server
                                            Rebooted<span class="pull-right text-muted small">19 mins ago</span></a>
                                        </li>
                                        <li><a href="extra-user-list.html" target="_blank"><span
                                            class="label label-success"><i class="fa fa-tasks"></i></span>New
                                            Task<span class="pull-right text-muted small">2 days ago</span></a></li>
                                            <li><a href="extra-user-list.html" target="_blank"><span
                                                class="label label-warning"><i class="fa fa-envelope"></i></span>Message
                                                Sent<span class="pull-right text-muted small">5 days ago</span></a></li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li class="last"><a href="extra-user-list.html" class="text-right">See all alerts</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="hidden-sm hidden-xs">
                                <div id="note-app-toggle" class="btn btn-info btn-xs mlm"><i class="icon-note mrs"></i>Add
                                    note
                                </div>
                                <div id="note-app-wrapper">
                                    <div class="note-app-tools"><i data-hover="tooltip" title="New" class="icon-note"></i><i
                                        data-hover="tooltip" title="Import" class="fa fa-sign-in"></i><i
                                        data-hover="tooltip" title="Save" class="fa fa-save"></i><i data-hover="tooltip"
                                        title="Close"
                                        class="icon-close"></i><input
                                        id="note-app-file" type="file" style="display: none;"/></div>
                                        <div class="note-app-list"></div>
                                        <div class="note-app-data"><input type="text" placeholder="Enter note title..."
                                          class="note-app-title"/><textarea
                                          placeholder="Enter note description here..."
                                          class="note-app-content"></textarea></div>
                                      </div>
                                  </li>  -->
                              </ul>
                              <ul class="nav navbar-nav navbar-right">
                                <li class="dropdown"><a data-toggle="dropdown" href="#" class="dropdown-toggle"><i
                                    class="icon-user"></i>&nbsp;<span class="caret"></span></a>
                                    <ul class="dropdown-menu dropdown-user pull-right">
                                        <li>
                                            <div class="navbar-content">
                                                <div class="row">
                                                    <div class="col-md-5 col-xs-5">
                                                        <img src="<?php echo PROJECT_UPLOAD_BO_URL.$_SESSION['us_img']?>" alt="" class="img-responsive" style="width:60px"/>
                                                    </div>
                                                    <div class="col-md-7 col-xs-5"><span><?php echo $_SESSION['us_fname'].' '.$_SESSION['us_lname'];?></span>
                                                        <p class="text-muted small"><?php echo $_SESSION['us_email'];?></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="navbar-footer">
                                                <div class="navbar-footer-content">
                                                    <div class="row">
                                                        <div class="col-md-6 col-xs-6"><a href="chgPassForm.php">
                                                            <button class="btn btn-default btn-sm">Change Password</button>
                                                        </a></div>
                                                        <div class="col-md-6 col-xs-6"><a href="login.php?cAction=Logout">
                                                            <button class="btn btn-info btn-sm pull-right">Sign Out</button>
                                                        </a></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>

                <style>

                .main-logo
                {
                    height: 45px;
                    padding-top: 10px;
                    padding-left: 10px;
                }

                </style>