<div class="sidebar-main sidebar">
    <div class="sidebar-collapse sidebar-scroll">
        <ul id="sidebar-main" class="nav">
            <li class="sidebar-hide"><h4 class="sidebar-title-section">Main</h4></li>
            <li class="active"><a href="main.php"><i class="icon-home"></i><span class="menu-title">Dashboard</span></a></li>
        <?php 
            if ($obj){
               $tmpuser = new tmp_user(false);
               if ($obj->IsConnected()){
                    $tmpuser->importConnection($obj);    
               }else{
                    $tmpuser->Open();
               }
            }else {
               $tmpuser = new tmp_user();
            }
            echo getMenu($tmpuser);
        ?>
	    </ul>
	</div>
</div>


<!--<div class="sidebar-main sidebar">
    <div class="sidebar-collapse sidebar-scroll">
        <ul id="sidebar-main" class="nav">
            <li class="sidebar-hide"><h4 class="sidebar-title-section">Main</h4></li>
            <li class="active"><a href="index.html"><i class="icon-home"></i><span class="menu-title">Dashboard</span></a>
            </li>
            <li><a href="page_profile.html"><i class="icon-user"></i><span class="menu-title">Profile</span><span class="badge badge-success">80%</span></a></li>
            <li><a href="page_calendar.html"><i class="icon-calendar"></i><span class="menu-title">Calendar</span><span class="badge badge-warning">2 events</span></a>
            </li>
            <li class="sidebar-hide"><h4 class="sidebar-title-section">All Components</h4></li>
            <li><a href="#"><i class="icon-screen-desktop"></i><span
                    class="menu-title">Quick Use</span><span class="arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="layout_full_width.html"><span class="submenu-title">Full width</span></a>
                    </li>
                    <li><a href="layout_boxed.html"><span class="submenu-title">Boxed</span></a></li>
                    <li class="hidden-sm"><a href="layout_sidebar_collapsed.html"><span
                            class="submenu-title">Sidebar Collapsed</span></a></li>
                    <li class="hidden-sm"><a href="layout_sidebar_fixed.html"><span class="submenu-title">Sidebar fixed</span></a>
                    </li>
                    <li class="hidden-sm"><a href="layout_sidebar_collapsed_fixed.html"><span
                            class="submenu-title">Sidebar collapsed & fixed</span></a></li>
                    <li><a href="layout_horizontal_menu.html"><span
                            class="submenu-title">Horizontal Menu</span></a></li>
                    <li><a href="layout_header_fixed.html"><span
                            class="submenu-title">Header Fixed</span></a></li>
                    <li><a href="layout_dark_style.html"><span class="submenu-title">Dark Style</span></a>
                    </li>
                    <li><a href="layout_light_style.html"><span class="submenu-title">Light Style</span></a>
                    </li>
                </ul>
            </li>
            <li><a href="#"><i class="icon-magic-wand"></i><span class="menu-title">UI Elements</span><span
                    class="arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="ui_general.html"><span class="submenu-title">General</span><span
                            class="badge badge-success">10</span></a></li>
                    <li><a href="ui_buttons.html"><span class="submenu-title">Buttons</span></a></li>
                    <li><a href="ui_typography.html"><span class="submenu-title">Typography</span></a></li>
                    <li><a href="ui_tabs_accordions.html"><span
                            class="submenu-title">Tabs & Accordions</span></a></li>
                    <li><a href="ui_modals.html"><span class="submenu-title">Modals</span></a></li>
                    <li><a href="ui_treeview.html"><span class="submenu-title">Tree view</span></a></li>
                    <li><a href="ui_icons.html"><span class="submenu-title">Icons</span></a></li>
                    <li><a href="ui_panels.html"><span class="submenu-title">Panels</span></a></li>
                    <li><a href="ui_nestable_list.html"><span class="submenu-title">Nestable List</span></a>
                    </li>
                    <li><a href="ui_toastr.html"><span class="submenu-title">Toastr Notifications</span></a>
                    </li>
                    <li><a href="ui_datepaginator.html"><span
                            class="submenu-title">Date Paginator</span></a></li>
                    <li><a href="ui_slider.html"><span class="submenu-title">Range 2D Slider</span></a></li>
                </ul>
            </li>
            <li><a href="#"><i class="icon-note"></i><span class="menu-title">Forms</span><span
                    class="arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="form_components.html"><span
                            class="submenu-title">Form Components</span><span
                            class="label label-info">8</span></a></li>
                    <li><a href="form_wizard.html"><span class="submenu-title">Form Wizard</span></a></li>
                    <li><a href="form_validation.html"><span
                            class="submenu-title">Form Validation</span></a></li>
                    <li><a href="form_select.html"><span class="submenu-title">Dropdown & Select</span></a>
                    </li>
                    <li><a href="form_picker.html"><span class="submenu-title">Picker</span></a></li>
                    <li><a href="form_editor.html"><span class="submenu-title">Editor</span></a></li>
                    <li><a href="form_dropzone.html"><span class="submenu-title">Dropzone File Upload</span></a>
                    </li>
                    <li><a href="form_multiple_file_upload.html"><span class="submenu-title">Multiple File Upload</span></a>
                    </li>
                </ul>
            </li>
            <li><a href="#"><i class="icon-grid"></i><span class="menu-title">Tables</span><span
                    class="arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="table_basic.html"><span class="submenu-title">Basic table</span></a></li>
                    <li><a href="table_responsive.html"><span class="submenu-title">Responsive table</span></a>
                    </li>
                    <li><a href="table_advanced.html"><span class="submenu-title">Advanced table</span></a>
                    </li>
                    <li><a href="table_treegrid.html"><span class="submenu-title">Treegrid table</span></a>
                    </li>
                </ul>
            </li>
            <li><a href="#"><i class="icon-book-open"></i><span class="menu-title">Pages</span><span
                    class="arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="page_gallery.html"><span class="submenu-title">Gallery</span></a></li>
                    <li><a href="page_mail.html"><span class="submenu-title">Mail Box</span><span
                            class="badge badge-primary">7</span></a></li>
                    <li><a href="page_invoice.html"><span class="submenu-title">Invoice</span></a></li>
                    <li><a href="page_pricing_table.html"><span
                            class="submenu-title">Pricing Table</span></a></li>
                    <li><a href="page_search.html"><span class="submenu-title">Search</span></a></li>
                    <li><a href="page_signin.html"><span class="submenu-title">Sign in</span></a></li>
                    <li><a href="page_signup.html"><span class="submenu-title">Sign up</span></a></li>
                    <li><a href="page_lock_screen.html"><span class="submenu-title">Lock screen</span></a>
                    </li>
                    <li><a href="page_404.html"><span class="submenu-title">Page 404</span></a></li>
                    <li><a href="page_500.html"><span class="submenu-title">Page 500</span></a></li>
                    <li><a href="page_timeline.html"><span class="submenu-title">Timeline</span></a></li>
                </ul>
            </li>
            <li><a href="#"><i class="icon-bar-chart"></i><span class="menu-title">Charts</span><span
                    class="arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="charts_chartjs.html"><span class="submenu-title">ChartJs</span></a></li>
                    <li><a href="charts_flot.html"><span class="submenu-title">Flot Charts</span></a></li>
                    <li><a href="charts_sparklines.html"><span
                            class="submenu-title">Sparklines Charts</span></a></li>
                </ul>
            </li>
            <li><a href="#"><i class="icon-compass"></i><span class="menu-title">Maps</span><span
                    class="arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="maps_gmaps.html"><span class="submenu-title">GMaps</span></a></li>
                    <li><a href="maps_vector.html"><span class="submenu-title">Vector maps</span></a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>-->
                                                        