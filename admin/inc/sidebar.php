<!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar position-fixed" data-sidebarbg="skin5">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav" class="p-t-30">
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="index.php" aria-expanded="false">
                                <i class="mdi mdi-view-dashboard"></i>
                                <span class="hide-menu">Dashboard</span>
                            </a>
                        </li>
                        <li class="sidebar-item <?= $page == 'manage_job.php' || $page == 'free_trial_job.php' || $page == 'free_quote_job.php' || $page == 'quick_query.php' || $page == 'contact_mail.php' ? 'selected' : ''; ?>">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link <?= $page == 'manage_job.php' || $page == 'free_trial_job.php' || $page == 'free_quote_job.php' || $page == 'quick_query.php' || $page == 'contact_mail.php' ? 'active' : ''; ?>" href="job_details.php" aria-expanded="false">
                                <i class="mdi mdi-pencil"></i>
                                <span class="hide-menu">Job Details</span>
                            </a>
                        </li>
                        <?php 
                        if (Session::get('admin_type') == 'Super Admin') {
                        ?>
                        
                        <li class="sidebar-item <?= $page == 'main_services.php' || $page == 'additional_services.php' || $page == 'delivery_time.php' || $page == 'file_format.php' || $page == 'admin_user_management.php' ? 'selected' : ''; ?>">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link <?= $page == 'main_services.php' || $page == 'additional_services.php' || $page == 'delivery_time.php' || $page == 'file_format.php' || $page == 'admin_user_management.php' ? 'active' : ''; ?>" href="settings.php" aria-expanded="false">
                                <i class="mdi mdi-pencil"></i>
                                <span class="hide-menu">Settings</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="manage_user.php" aria-expanded="false">
                                <i class="mdi mdi-format-list-bulleted"></i>
                                <span class="hide-menu">Register User Management</span>
                            </a>
                        </li>
                        <?php
                        }
                        ?>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="change_password.php" aria-expanded="false">
                                <i class="mdi mdi-account"></i>
                                <span class="hide-menu">Change Password</span>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->