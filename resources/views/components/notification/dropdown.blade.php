<div x-data="notificationDropdown()" class="relative">
    <!-- Notification Bell Icon -->
    <button @click="toggleDropdown" class="p-1 rounded-full text-gray-500 hover:text-gray-700 focus:outline-none relative min-h-[44px] min-w-[44px] flex items-center justify-center" aria-label="View notifications">
        <span class="sr-only">View notifications</span>
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
        </svg>
        <span x-show="unreadCount > 0" x-text="unreadCount > 9 ? '9+' : unreadCount" class="notification-badge absolute -top-2 -right-2 flex items-center justify-center h-5 w-5 rounded-full bg-red-600 text-white text-xs font-bold shadow-sm"></span>
    </button>

    <!-- Notification Dropdown -->
    <div x-show="isOpen" @click.away="isOpen = false" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute right-0 mt-2 w-full sm:w-80 bg-white rounded-md shadow-xl overflow-hidden z-50 border border-gray-200 max-w-[calc(100vw-1rem)]" style="display: none;">
        <div class="py-2">
            <div class="px-4 py-3 text-sm font-semibold text-gray-700 bg-gray-50 border-b border-gray-200 flex justify-between items-center">
                <span class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                    {{ __('Notifications') }}
                </span>
                <span x-show="unreadCount > 0">
                    <button @click="markAllAsRead" class="text-green-600 hover:text-green-800 text-xs font-medium min-h-[44px] min-w-[44px] flex items-center justify-center">
                        {{ __('Mark all as read') }}
                    </button>
                </span>
            </div>

            <div class="max-h-72 overflow-y-auto" id="notification-list">
                <template x-if="notifications.length === 0">
                    <div class="px-4 py-8 text-center">
                        <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-gray-100 mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                            </svg>
                        </div>
                        <p class="text-gray-600 font-medium">{{ __('No notifications') }}</p>
                        <p class="text-gray-500 text-xs mt-1">{{ __('You\'re all caught up!') }}</p>
                    </div>
                </template>

                <template x-for="notification in notifications" :key="notification.id">
                    <div :class="{ 'bg-blue-50': !notification.is_read, 'hover:bg-gray-50': notification.is_read }" class="border-b border-gray-200 last:border-b-0 transition-colors duration-150">
                        <div class="px-4 py-3">
                            <div class="flex justify-between items-start">
                                <h4 class="text-sm font-medium break-words flex-1" :class="!notification.is_read ? 'text-blue-800' : 'text-gray-800'" x-text="notification.title"></h4>
                                <span class="text-xs text-gray-500 ml-2 whitespace-nowrap" x-text="formatDate(notification.created_at)"></span>
                            </div>
                            <p class="mt-1 text-xs break-words" :class="!notification.is_read ? 'text-blue-700' : 'text-gray-600'" x-text="notification.message"></p>
                            <div class="mt-2 flex justify-between items-center">
                                <template x-if="notification.link">
                                    <a :href="notification.link" class="text-xs font-medium text-green-600 hover:text-green-800 min-h-[44px] min-w-[44px] flex items-center">
                                        {{ __('View Details') }}
                                    </a>
                                </template>
                                <template x-if="!notification.link">
                                    <span></span>
                                </template>
                                <template x-if="!notification.is_read">
                                    <button @click="markAsRead(notification.id)" class="text-xs font-medium text-gray-600 hover:text-gray-900 min-h-[44px] min-w-[44px] flex items-center justify-center">
                                        {{ __('Mark as Read') }}
                                    </button>
                                </template>
                            </div>
                        </div>
                    </div>
                </template>
            </div>

            <div class="px-4 py-3 bg-gray-50 text-center border-t border-gray-200">
                <a href="{{ route('notifications.index') }}" class="inline-flex items-center justify-center text-sm text-green-600 hover:text-green-800 font-medium min-h-[44px] px-4 py-2">
                    {{ __('View All Notifications') }}
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function notificationDropdown() {
        return {
            isOpen: false,
            notifications: [],
            unreadCount: 0,
            isMobile: window.innerWidth < 768,

            init() {
                this.fetchNotifications();
                this.checkMobileStatus();

                // Set up Echo to listen for new notifications
                if (window.Echo) {
                    window.Echo.private(`App.Models.User.{{ auth()->id() }}`)
                        .listen('.new.notification', (e) => {
                            this.notifications.unshift(e);
                            this.unreadCount++;
                            // Show notification badge animation
                            this.animateNotificationBadge();
                        });
                }

                // Refresh notifications every minute
                setInterval(() => {
                    this.fetchNotifications();
                }, 60000);

                // Listen for window resize events to update mobile status
                window.addEventListener('resize', () => {
                    this.checkMobileStatus();
                });
            },

            checkMobileStatus() {
                this.isMobile = window.innerWidth < 768;
            },

            animateNotificationBadge() {
                // Add animation class to notification badge
                const badge = document.querySelector('.notification-badge');
                if (badge) {
                    badge.classList.add('animate-pulse');
                    setTimeout(() => {
                        badge.classList.remove('animate-pulse');
                    }, 2000);
                }
            },

            toggleDropdown() {
                this.isOpen = !this.isOpen;
                if (this.isOpen) {
                    this.fetchNotifications();
                    // If on mobile, add a body class to prevent scrolling
                    if (this.isMobile) {
                        document.body.classList.toggle('overflow-hidden', this.isOpen);
                    }
                } else {
                    // Remove the body class when closing
                    document.body.classList.remove('overflow-hidden');
                }
            },

            fetchNotifications() {
                fetch('{{ route('notifications.recent') }}')
                    .then(response => response.json())
                    .then(data => {
                        this.notifications = data.notifications;
                        this.unreadCount = data.unread_count;
                    })
                    .catch(error => console.error('Error fetching notifications:', error));
            },

            markAsRead(id) {
                fetch(`/notifications/${id}/mark-as-read`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        this.notifications = this.notifications.map(notification => {
                            if (notification.id === id) {
                                notification.is_read = true;
                            }
                            return notification;
                        });
                        this.unreadCount = Math.max(0, this.unreadCount - 1);
                    }
                })
                .catch(error => console.error('Error marking notification as read:', error));
            },

            markAllAsRead() {
                fetch('{{ route('notifications.mark-all-as-read') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        this.notifications = this.notifications.map(notification => {
                            notification.is_read = true;
                            return notification;
                        });
                        this.unreadCount = 0;
                    }
                })
                .catch(error => console.error('Error marking all notifications as read:', error));
            },

            formatDate(dateString) {
                const date = new Date(dateString);
                const now = new Date();
                const diffInSeconds = Math.floor((now - date) / 1000);

                if (diffInSeconds < 60) {
                    return 'Just now';
                }

                const diffInMinutes = Math.floor(diffInSeconds / 60);
                if (diffInMinutes < 60) {
                    return `${diffInMinutes}m ago`;
                }

                const diffInHours = Math.floor(diffInMinutes / 60);
                if (diffInHours < 24) {
                    return `${diffInHours}h ago`;
                }

                const diffInDays = Math.floor(diffInHours / 24);
                if (diffInDays < 7) {
                    return `${diffInDays}d ago`;
                }

                return date.toLocaleDateString();
            }
        };
    }
</script>
@endpush
