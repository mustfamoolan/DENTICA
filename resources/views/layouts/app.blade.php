<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'نظام إدارة عيادات الأسنان')</title>
    <!-- Bootstrap RTL CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        :root {
            --primary-color: #22577A;
            --secondary-color: #22577A;
            --light-bg: #f8f9fa;
            --sidebar-width: 118px;
            --sidebar-bg-top: #22577A;
            --sidebar-bg-bottom: #1d5f70;
            --sidebar-accent: #38A3A5;
        }

        body {
            background-color: #f0f2f5;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
        }

        .app-container {
            display: flex;
            min-height: 100vh;
            position: relative;
        }

        .sidebar {
            width: var(--sidebar-width);
            background: linear-gradient(180deg, var(--sidebar-bg-top) 0%, var(--sidebar-bg-bottom) 100%);
            color: white;
            position: fixed;
            top: 10px;
            right: 10px;
            border-radius: 10px;
            height: 1280px;
            z-index: 1000;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 0;
            overflow: hidden;
        }

        .logo-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 15px;
            margin-bottom: 15px;
        }

        .sidebar-logo {
            width: 60px;
            height: 70px;
            margin-bottom: 80px;
        }

        .user-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid white;
            margin-bottom: 150px;
        }

        .sidebar-accent {
            position: relative;
            background-color: transparent;
            width: 100%;
            padding-top: 0;
            padding-right: 10px;
            padding-bottom: 100px;
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: auto;
        }

        .sidebar-accent::before {
            content: '';
            position: absolute;
            top: -50px;
            right: 10px;
            width: 100%;
            height: 100px;
            background-color: var(--sidebar-accent);
            border-radius: 0 100% 0 0;
            z-index: -1;
        }

        .sidebar-accent-middle {
            position: absolute;
            top: 50px;
            right: 10px;
            width: 100%;
            height: calc(100% - 100px);
            background-color: var(--sidebar-accent);
            z-index: -2;
        }

        .sidebar-accent::after {
            content: '';
            position: absolute;
            bottom: -50px;
            right: 10px;
            width: 100%;
            height: 100px;
            background-color: var(--sidebar-accent);
            border-radius: 0 0 100% 0;
            z-index: -1;
        }

        .menu-item {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background-color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 15px 0;
            color: var(--primary-color);
            text-decoration: none;
            transition: all 0.3s;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            z-index: 2;
        }

        .menu-item:hover {
            transform: scale(1.1);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .menu-icon {
            font-size: 35px;
        }

        .sidebar-bottom {
            margin-top: auto;
            margin-bottom: 15px;
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .bottom-icon {
            color: white;
            font-size: 20px;
            margin: 10px 0;
            cursor: pointer;
            transition: all 0.3s;
        }

        .bottom-icon:hover {
            transform: scale(1.1);
        }

        .main-content {
            flex: 1;
            margin-right: calc(var(--sidebar-width) + 20px);
            margin-left: 320px;
            padding: 20px;
            transition: all 0.3s;
        }

        .side-slider {
            width: 300px;
            background-color: #22577A;
            color: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            padding: 20px;
            position: fixed;
            top: 10px;
            left: 10px;
            bottom: 10px;
            overflow-y: auto;
            z-index: 999;
        }

        .card {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            border: none;
            margin-bottom: 20px;
            overflow: hidden;
        }

        .card-header {
            background-color: #f8f9fa;
            padding: 15px 20px;
            border-bottom: 1px solid #e0e0e0;
            font-weight: 600;
        }

        .card-body {
            padding: 20px;
        }

        .stats-card {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            position: relative;
            margin-bottom: 20px;
        }

        .stats-value {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .stats-label {
            font-size: 0.9rem;
            opacity: 0.8;
        }

        .stats-sublabel {
            font-size: 0.8rem;
            opacity: 0.7;
        }

        .stats-icon {
            position: absolute;
            top: 20px;
            left: 20px;
            font-size: 2rem;
            opacity: 0.2;
        }

        .action-button {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background-color: var(--primary-color);
            color: white;
            border-radius: 10px;
            padding: 20px;
            height: 100%;
            text-decoration: none;
            transition: all 0.3s;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .action-button:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .action-button i {
            font-size: 2rem;
            margin-bottom: 10px;
        }

        .table {
            margin-bottom: 0;
        }

        .table th {
            border-top: none;
            font-weight: 600;
            color: #555;
        }

        .table td {
            vertical-align: middle;
        }

        .patient-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }

        .action-icon {
            color: #777;
            margin: 0 5px;
            font-size: 1.1rem;
        }

        .action-icon:hover {
            color: var(--primary-color);
        }

        .menu-toggle {
            display: none;
            background: none;
            border: none;
            color: #777;
            font-size: 1.5rem;
            cursor: pointer;
        }

        @media (max-width: 1200px) {
            .main-content {
                margin-left: 0;
            }

            .side-slider {
                display: none;
            }
        }

        @media (max-width: 768px) {
            .main-content {
                margin-right: 0;
                padding: 15px;
            }

            .sidebar {
                transform: translateX(60px);
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .menu-toggle {
                display: block;
            }
        }
    </style>
    @yield('styles')
</head>
<body>
    <div class="app-container">
        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Logo and Brand -->
            <div class="logo-container">
                <img src="{{ asset('images/dental-logo.png') }}" alt="Logo" class="sidebar-logo">
            </div>

            <!-- User Avatar -->
            <img src="{{ asset('images/11.png') }}" alt="User" class="user-avatar">

            <!-- Accent Section with Menu Items -->
            <div class="sidebar-accent">
                <div class="sidebar-accent-middle"></div>

                <a href="#" class="menu-item">
                    <i class="fas fa-bell menu-icon"></i>
                </a>
                <a href="#" class="menu-item">
                    <i class="fas fa-user-md menu-icon"></i>
                </a>
                <a href="#" class="menu-item">
                    <i class="fas fa-calendar-alt menu-icon"></i>
                </a>
                <a href="#" class="menu-item">
                    <i class="fas fa-briefcase-medical menu-icon"></i>
                </a>
            </div>

            <!-- Bottom Icons -->
            <div class="sidebar-bottom">
                <a href="#" class="bottom-icon">
                    <i class="fas fa-moon"></i>
                </a>
                <a href="#" class="bottom-icon">
                    <i class="fas fa-cog"></i>
                </a>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="bottom-icon">
                    <i class="fas fa-info-circle"></i>
                </a>
            </div>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>

        <!-- Side Slider (فارغ) -->
        <div class="side-slider">
            <!-- هنا يمكن إضافة محتوى السلايدر الجانبي حسب الحاجة -->
            @yield('side_slider')
        </div>

        <!-- Main Content -->
        <div class="main-content">
            @yield('content')
        </div>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle sidebar on mobile
        document.addEventListener('DOMContentLoaded', function() {
            const menuToggle = document.querySelector('.menu-toggle');
            const sidebar = document.querySelector('.sidebar');

            if (menuToggle) {
                menuToggle.addEventListener('click', function() {
                    sidebar.classList.toggle('active');
                });
            }
        });

        // تحميل التنبيهات
        $(document).ready(function() {
            // تحميل عدد التنبيهات غير المقروءة
            function loadUnreadCount() {
                $.ajax({
                    url: "{{ route('notifications.unread-count') }}",
                    method: "GET",
                    success: function(response) {
                        const count = response.count;
                        const badge = $('#notification-badge');

                        if (count > 0) {
                            badge.text(count).show();
                        } else {
                            badge.hide();
                        }
                    }
                });
            }

            // تحميل آخر التنبيهات
            function loadLatestNotifications() {
                $.ajax({
                    url: "{{ route('notifications.latest') }}",
                    method: "GET",
                    success: function(response) {
                        const notifications = response.notifications;
                        const container = $('#notifications-container');

                        container.empty();

                        if (notifications.length > 0) {
                            notifications.forEach(notification => {
                                const isRead = notification.is_read ? 'read' : 'unread';
                                const typeClass = notification.type === 'info' ? 'info' : (notification.type === 'warning' ? 'warning' : 'danger');

                                container.append(`
                                    <a href="#" class="dropdown-item notification-item ${isRead}" data-id="${notification.id}">
                                        <div class="notification-icon ${typeClass}">
                                            <i class="fas fa-${notification.type === 'info' ? 'info-circle' : (notification.type === 'warning' ? 'exclamation-triangle' : 'exclamation-circle')}"></i>
                                        </div>
                                        <div class="notification-content">
                                            <div class="notification-title">${notification.title}</div>
                                            <div class="notification-text">${notification.content}</div>
                                            <div class="notification-time">${moment(notification.created_at).fromNow()}</div>
                                        </div>
                                    </a>
                                `);
                            });
                        } else {
                            container.append(`
                                <div class="text-center p-3">
                                    <p class="mb-0">لا توجد تنبيهات</p>
                                </div>
                            `);
                        }

                        // إضافة مستمع الأحداث للتنبيهات
                        $('.notification-item').on('click', function(e) {
                            e.preventDefault();

                            const id = $(this).data('id');

                            // تحديث حالة قراءة التنبيه
                            $.ajax({
                                url: `/notifications/${id}/mark-as-read`,
                                method: "POST",
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                success: function() {
                                    // تحديث عدد التنبيهات غير المقروءة
                                    loadUnreadCount();

                                    // تحديث قائمة التنبيهات
                                    loadLatestNotifications();
                                }
                            });
                        });
                    }
                });
            }

            // تحميل التنبيهات عند تحميل الصفحة
            loadUnreadCount();

            // تحميل التنبيهات عند فتح القائمة المنسدلة
            $('#notificationsDropdown').on('click', function() {
                loadLatestNotifications();
            });

            // تحديد جميع التنبيهات كمقروءة
            $('#mark-all-read').on('click', function(e) {
                e.preventDefault();
                e.stopPropagation();

                $.ajax({
                    url: "{{ route('notifications.mark-all-as-read') }}",
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function() {
                        // تحديث عدد التنبيهات غير المقروءة
                        loadUnreadCount();

                        // تحديث قائمة التنبيهات
                        loadLatestNotifications();

                        // عرض رسالة نجاح
                        toastr.success('تم تحديد جميع التنبيهات كمقروءة');
                    }
                });
            });

            // تحديث التنبيهات كل دقيقة
            setInterval(function() {
                loadUnreadCount();
            }, 60000);
        });
    </script>
    @yield('scripts')
</body>
</html>
