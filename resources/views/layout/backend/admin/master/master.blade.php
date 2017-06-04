@if(sentinel_check_role_admin())
    {{--*/ $include_partial_notification_tasks = 'layout.backend.admin.partial.user_notifications' /*--}}
    {{--*/ $include_partial_notification_messages = 'layout.backend.admin.partial.notification_messages' /*--}}
    {{--*/ $include_partial_notification_alerts = 'layout.backend.admin.partial.notification_alerts' /*--}}
    {{--*/ $include_partial_sidebar_right = 'layout.backend.admin.partial.sidebar_right' /*--}}
    {{--*/ $route_profile = 'admin-profile' /*--}}
    {{--*/ $route_logout = 'admin-logout' /*--}}
    {{--*/ $route_dashboard = 'admin-dashboard' /*--}}
    {{--*/ $role_area = user_info('role')->name /*--}}
    {{--*/ $title = '  Web Admin' /*--}}
@else
    {{--*/ $include_partial_notification_tasks = 'layout.frontend.member.partial.user_notifications' /*--}}
    {{--*/ $include_partial_notification_messages = 'layout.frontend.member.partial.notification_messages' /*--}}
    {{--*/ $include_partial_notification_alerts = 'layout.frontend.member.partial.notification_alerts' /*--}}
    {{--*/ $include_partial_sidebar_right = 'layout.frontend.member.partial.sidebar_right' /*--}}
    {{--*/ $route_profile = 'member-profile' /*--}}
    {{--*/ $route_logout = 'logout-member' /*--}}
    {{--*/ $route_dashboard = 'admin-dashboard-member' /*--}}
    {{--*/ $role_area = user_info('role')->name /*--}}
    {{--*/ $title = '  Web Member' /*--}}
@endif
<!DOCTYPE html>
<html>
    <head>
        {!! Html::meta(null, null, ['charset' => 'UTF-8']) !!}
        {!! Html::meta('robots', 'noindex, nofollow') !!}
        {!! Html::meta('product', env('APP_WEB_ADMIN_NAME', $title)) !!}
        {!! Html::meta('description', env('APP_WEB_ADMIN_NAME', $title)) !!}
        {!! Html::meta('author', ' ') !!}
        {!! Html::meta('viewport', 'width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no') !!}

        <title>{{ env('APP_WEB_ADMIN_NAME', $title) }} - @yield('title')</title>

        <!-- Web Fonts  -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <!-- Vendor CSS -->
        {!! Html::style( $pathp.'assets/backend/porto-admin/vendor/simple-line-icons/css/simple-line-icons.css') !!}
        {!! Html::style( $pathp.'assets/backend/porto-admin/vendor/bootstrap/css/bootstrap.css') !!}
        {!! Html::style( $pathp.'assets/backend/porto-admin/vendor/magnific-popup/magnific-popup.css') !!}
        {!! Html::style( $pathp.'assets/backend/porto-admin/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css') !!}
        {!! Html::style( $pathp.'assets/backend/porto-admin/vendor/jquery-ui/jquery-ui.css') !!}
        {!! Html::style( $pathp.'assets/backend/porto-admin/vendor/jquery-ui/jquery-ui.theme.css') !!}

        {!! Html::style( $pathp.'assets/backend/porto-admin/vendor/select2/css/select2.css') !!}
        {!! Html::style( $pathp.'assets/backend/porto-admin/vendor/select2-bootstrap-theme/select2-bootstrap.css') !!}
        {!! Html::style( $pathp.'assets/plugins/HoldOn/HoldOn.min.css') !!}
        <!-- {!! Html::style( $pathp.'assets/plugins/pace/pace.min.css') !!} -->
        {!! Html::style( $pathp.'assets/plugins/sweetalert/sweetalert.css') !!}

        {!! Html::style( $pathp.'assets/plugins/bootstrap-switch/bootstrap-switch.min.css') !!}
        {!! Html::style( $pathp.'assets/plugins/bootstrap-switch/bootstrap-switch.min.css') !!}
        {!! Html::style( $pathp.'assets/backend/porto-admin/vendor/pnotify/pnotify.custom.css') !!}

        <!-- Specific Page Vendor CSS -->
        {!! Html::style( $pathp.'assets/backend/porto-admin/vendor/bootstrap-tagsinput/bootstrap-tagsinput.css') !!}
        {!! Html::style( $pathp.'assets/plugins/summernote/summernote.css') !!}

        {!! Html::style( $pathp.'assets/backend/porto-admin/stylesheets/theme.css') !!}
        {!! Html::style( $pathp.'assets/backend/porto-admin/stylesheets/theme-custom.css') !!}
        {!! Html::style( $pathp.'assets/backend/porto-admin/stylesheets/theme.css') !!}
        {!! Html::style( $pathp.'assets/backend/porto-admin/stylesheets/skins/default.css') !!}
        {!! Html::style( $pathp.'assets/plugins/croppie/demo.css') !!}
        {!! Html::style( $pathp.'assets/plugins/croppie/croppie.css') !!}


        <!-- General CSS -->
        {!! Html::style( $pathp.'assets/general/css/loader.css') !!}
        {!! Html::style( $pathp.'assets/general/library/bootstrap-file-input/bootstrap-file-input.css') !!}

        {!! Html::script( $pathp.'assets/backend/porto-admin/vendor/modernizr/modernizr.js') !!}

        <link rel="shortcut icon" type="image/png" href="{{ asset( $pathp.'assets/general/images/identity/favicon.png')}}"/>


        @yield('header')
        <style type="text/css">
        .borderless td, .borderless th {
            border: none !important;
        }
        .full-width{
            width : 100% !important;
        }
        .text-white{
            color : #ffffff !important;
        }
        .cursor-pointer{
            cursor: pointer !important;
        }
        .steps-active{
            background-color: #0099E6 !important;
            border: 1px solid #0099E6;
            color:#fff;
        }
        div.scrollmenu {
            overflow: auto;
            white-space: nowrap;
        }

        div.scrollmenu a {
            display: inline-block;
            text-align: center;
        }

        div.scrollmenu a:hover {
        }
        </style>
    </head>

    <body>
        <div class="loader loader-body">
            <div class="loader-progress">
                <div class="smt1"></div>
                <div class="smt2"></div>
                <div class="smt3"></div>
                <div class="smt4"></div>
                <div class="smt5"></div>
            </div>
        </div>
        <section class="body">
            <!-- start: header -->
            <header class="header">
                <div class="logo-container">
                    <a href="{{ route($route_dashboard) }}" class="logo">

                        <img src="{{ asset($pathp.'assets/general/images/identity/web.png') }}" height="55" alt="{{ env('APP_WEB_ADMIN_NAME', '  Web Admin') }}" />
                        <!-- <h4>{{ env('APP_WEB_ADMIN_NAME', $title) }}</h4> -->
                    </a>
                    <div class="visible-xs toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
                        <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
                    </div>
                </div>

                <!-- start: search & user box -->
                <div class="header-right">

                    <form action="pages-search-results.html" class="search nav-form" style="display:none">
                        <div class="input-group input-search">
                            <input type="text" class="form-control" name="q" id="q" placeholder="Search...">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </form>

                    <span class="separator" style="display:none"></span>

                    <ul class="notifications" id="box-badge-user-notif">
                        @include($include_partial_notification_tasks)
                    </ul>&nbsp;&nbsp;&nbsp;

                    <ul class="notifications" id="box-badge-notif">
                        @include($include_partial_notification_messages)
                    </ul>&nbsp;&nbsp;&nbsp;
                @if(!sentinel_check_role_admin())
                    <ul class="notifications" id="box-badge-alert">
                        @include($include_partial_notification_alerts)
                    </ul>
                @endif
                    <span class="separator"></span>

                    <div id="userbox" class="userbox">
                        <a href="#" data-toggle="dropdown">

                            <figure class="profile-picture">
                                <img src="{{ user_info('avatar_path') }}" style="width: 35px; height: 35px"alt="{{ user_info('full_name') }}" class="img-circle" data-lock-picture="{{ user_info('avatar_path') }}" />
                            </figure>
                            <div class="profile-info" data-lock-name="{{ user_info('full_name') }}" data-lock-email="{{ user_info('email') }}">
                                <span class="name">{{ user_info('full_name') }}</span>
                                    <span class="role">{{ $role_area }}</span>
                            </div>

                            <i class="fa custom-caret"></i>
                        </a>

                        <div class="dropdown-menu">
                            <ul class="list-unstyled">
                                <li class="divider"></li>
                                @if(sentinel_check_role_admin())
                                    <li>
                                        <a role="menuitem" tabindex="-1" href="{!! route($route_profile) !!}"><i class="fa fa-user"></i> My Profile</a>
                                    </li>
                                @else
                                    <li>
                                        <a role="menuitem" tabindex="-1" href="{!! route($route_profile) !!}"><i class="fa fa-user"></i> My Profile</a>
                                    </li>
                                @endif
                                <!-- <li class="display-none">
                                    <a role="menuitem" tabindex="-1" href="#" data-lock-screen="true"><i class="fa fa-lock"></i> Lock Screen</a>
                                </li> -->
                                <li>
                                    <a role="menuitem" tabindex="-1" href="{!! route($route_logout) !!}"><i class="fa fa-power-off"></i> Logout</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- end: search & user box -->
            </header>
            <!-- end: header -->

            <div class="inner-wrapper">
                <!-- start: sidebar -->
                <aside id="sidebar-left" class="sidebar-left">

                    <div class="sidebar-header">
                        <div class="sidebar-title">
                            Navigation
                        </div>
                        <div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
                            <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
                        </div>
                    </div>

                    <div class="nano">
                        <div class="nano-content">
                            <nav id="menu" class="nav-main" role="navigation">
                                @include('layout.backend.admin.partial.side_menu')
                            </nav>
                        </div>

                        <script>
                            // Preserve Scroll Position
                            if (typeof localStorage !== 'undefined') {
                                if (localStorage.getItem('sidebar-left-position') !== null) {
                                    var initialPosition = localStorage.getItem('sidebar-left-position'),
                                        sidebarLeft = document.querySelector('#sidebar-left .nano-content');

                                    sidebarLeft.scrollTop = initialPosition;
                                }
                            }
                        </script>

                    </div>

                </aside>
                <!-- end: sidebar -->

                <section role="main" class="content-body">
                    <header class="page-header">
                        <h2>@yield('page-header')</h2>

                        <div class="right-wrapper pull-right">
                            @yield('breadcrumb')
                            &nbsp;&nbsp;

                        </div>
                    </header>

                    <!-- start: page -->
                    @yield('content')
                    <!-- end: page -->
                </section>
            </div>

            <aside id="sidebar-right" class="sidebar-right">
                <div class="nano">
                    <div class="nano-content">
                        <a href="#" class="mobile-close visible-xs">
                            Collapse <i class="fa fa-chevron-right"></i>
                        </a>

                        <div class="sidebar-right-wrapper">

                        </div>
                    </div>
                </div>
            </aside>
        </section>
  <div class="modal fade modal-getstart" id="modalUserNotification" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title-user-notification modalUserNotificationName" id="myModalLabel">Notification</h4>
        </div>
        <div class="modal-body modalUserNotificationBody">

        </div>
      </div>
    </div>
  </div>
        <!-- Vendor -->
        {!! Html::script( $pathp.'assets/backend/porto-admin/vendor/jquery/jquery.js') !!}
        {!! Html::script( $pathp.'assets/backend/porto-admin/vendor/jquery-browser-mobile/jquery.browser.mobile.js') !!}
        {!! Html::script( $pathp.'assets/backend/porto-admin/vendor/bootstrap/js/bootstrap.js') !!}
        {!! Html::style( $pathp.'assets/backend/porto-admin/vendor/font-awesome/css/font-awesome.css') !!}
        {!! Html::script( $pathp.'assets/backend/porto-admin/vendor/nanoscroller/nanoscroller.js') !!}
        {!! Html::script( $pathp.'assets/backend/porto-admin/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js') !!}
        {!! Html::script( $pathp.'assets/backend/porto-admin/vendor/magnific-popup/jquery.magnific-popup.js') !!}
        {!! Html::script( $pathp.'assets/backend/porto-admin/vendor/jquery-placeholder/jquery-placeholder.js') !!}
        {!! Html::script( $pathp.'assets/plugins/HoldOn/HoldOn.min.js') !!}
        <!-- {!! Html::script( $pathp.'assets/plugins/pace/pace.min.js') !!} -->
        {!! Html::script( $pathp.'assets/plugins/croppie/prism.js') !!}
        {!! Html::script( $pathp.'assets/plugins/sweetalert/sweetalert.min.js') !!}
        {!! Html::script( $pathp.'assets/plugins/tinymce/tinymce.min.js') !!}


        {!! Html::script( $pathp.'assets/backend/porto-admin/vendor/select2/js/select2.js') !!}
        {!! Html::script( $pathp.'assets/plugins/bootstrap-switch/bootstrap-switch.min.js') !!}
        {!! Html::script( $pathp.'assets/backend/porto-admin/vendor/ios7-switch/ios7-switch.js') !!}

        {!! Html::script( $pathp.'assets/backend/custom/jquery.form/jquery.form.js') !!}
        {!! Html::script( $pathp.'assets/general/js/jquery.ajax-cross-origin.min.js') !!}

        {!! Html::script( $pathp.'assets/backend/porto-admin/vendor/pnotify/pnotify.custom.js') !!}
        {!! Html::script( $pathp.'assets/backend/porto-admin/vendor/bootstrap-typeahead/typeahead.bundle.js') !!}
        {!! Html::script( $pathp.'assets/backend/porto-admin/vendor/bootstrap-tagsinput/bootstrap-tagsinput.js') !!}

        {!! Html::script( $pathp.'assets/plugins/summernote/summernote.js') !!}

        <!-- Theme Base, Components and Settings -->
        {!! Html::script( $pathp.'assets/backend/porto-admin/javascripts/theme.js') !!}

        <!-- Theme Custom -->
        {!! Html::script( $pathp.'assets/backend/porto-admin/javascripts/theme.custom.js') !!}

        <!-- Theme Initialization Files -->
        {!! Html::script( $pathp.'assets/backend/porto-admin/javascripts/theme.init.js') !!}

        {!! Html::script( $pathp.'assets/general/library/bootstrap-file-input/bootstrap-file-input.js') !!}

        {!! Html::script( $pathp.'assets/plugins/croppie/croppie.js') !!}

        {!! Html::script( $pathp.'assets/plugins/croppie/exif.js') !!}

        <script type="text/javascript">

                    jQuery(function ($) {
              $('.jquery-form-edit-avatar').ajaxForm({
                  success: function(response) {
                    $('#editProfileAvatar').modal('hide');
                    if(response.indexOf('success_edit_avatar') >= 0){

                      var myStack = {"dir1":"down", "dir2":"right", "push":"top"};
                      new PNotify({
                          title: "Success",
                          text: "Registration Success",
                        type: 'success',
                          addclass: "stack-custom",
                          stack: myStack
                      });
                          $.magnificPopup.close();
                      setTimeout(function(){
                         window.location.reload(1);
                      }, 2);

                    }
                  },
                  beforeSend: function() {
                      $('.has-error').html('');
                  },
                  error: function(response){
                      if (response.status === 422) {
                          var data = response.responseJSON;
                          $.each(data,function(key,val){
                              $('.'+key).html(val);
                          });
                      } else {
                          $('.error').addClass('alert alert-danger').html(response.responseJSON.message);
                      }
                  }
              });
            });
        </script>


        @yield('scripts')
        @yield('partial-scripts')
        <!-- {!! Html::script( $pathp.'assets/backend/porto-admin/vendor/socket-io/1.5.0/socket.io.min.js') !!} -->
        <script type="text/javascript">

            /* Socket Notification */
            var socket = io("{{ env('NODE_SERVER_HOST') }}", {secure: true});
            socket.on(" -channel:App\\Events\\Backend\\Notif", function(message){

                checkNotification(message.data);
            });



            $('a.btn-notif').on('click', function() {
                var user_id = $(this).data('user');
                setRead(user_id);
            });

            $('a.btn-alert').on('click', function() {
                var user_id = $(this).data('user');
                setReadAnnouncement(user_id);
            });

            $('a.btn-user-notif').on('click', function() {
                var user_id = $(this).data('user');
                setReadUserNotification(user_id);
            });


        </script>

        <script>
        $.fn.modal.Constructor.prototype.enforceFocus = function() {};
        $('.loader-body').hide();
        jQuery(function ($) {
            var loading = $('.loader-body').hide();
            $(document)
            .ajaxStart(function () {
                loading.show();
            })
            .ajaxStop(function () {
                loading.hide();
            });
        });
        </script>
    </body>
</html>
