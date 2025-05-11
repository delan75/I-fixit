<div x-data="notificationDropdown()" class="relative">
    <!-- Notification Bell Icon -->
    <button @click="toggleDropdown" class="p-1 rounded-full text-gray-500 hover:text-gray-700 focus:outline-none relative">
        <span class="sr-only">View notifications</span>
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
        </svg>
        <span x-show="unreadCount > 0" x-text="unreadCount > 9 ? '9+' : unreadCount" class="absolute -top-1 -right-1 flex items-center justify-center h-5 w-5 rounded-full bg-red-500 text-white text-xs font-bold"></span>
    </button>

    <!-- Notification Dropdown -->
    <div x-show="isOpen" @click.away="isOpen = false" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute right-0 mt-2 w-80 bg-white rounded-md shadow-lg overflow-hidden z-50" style="display: none;">
        <div class="py-2">
            <div class="px-4 py-2 text-xs font-semibold text-gray-500 uppercase tracking-wider bg-gray-50 border-b border-gray-200 flex justify-between items-center">
                <span>{{ __('Notifications') }}</span>
                <span x-show="unreadCount > 0">
                    <button @click="markAllAsRead" class="text-indigo-600 hover:text-indigo-900 text-xs">
                        {{ __('Mark all as read') }}
                    </button>
                </span>
            </div>
            
            <div class="max-h-64 overflow-y-auto" id="notification-list">
                <template x-if="notifications.length === 0">
                    <div class="px-4 py-6 text-center text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                        </svg>
                        <p>{{ __('No notifications') }}</p>
                    </div>
                </template>
                
                <template x-for="notification in notifications" :key="notification.id">
                    <div :class="{ 'bg-blue-50': !notification.is_read, 'hover:bg-gray-50': notification.is_read }" class="border-b border-gray-200 last:border-b-0">
                        <div class="px-4 py-3">
                            <div class="flex justify-between items-start">
                                <h4 class="text-sm font-medium text-gray-900" x-text="notification.title"></h4>
                                <span class="text-xs text-gray-500" x-text="formatDate(notification.created_at)"></span>
                            </div>
                            <p class="mt-1 text-xs text-gray-600" x-text="notification.message"></p>
                            <div class="mt-2 flex justify-between items-center">
                                <template x-if="notification.link">
                                    <a :href="notification.link" class="text-xs text-indigo-600 hover:text-indigo-900">
                                        {{ __('View Details') }}
                                    </a>
                                </template>
                                <template x-if="!notification.is_read">
                                    <button @click="markAsRead(notification.id)" class="text-xs text-gray-600 hover:text-gray-900">
                                        {{ __('Mark as Read') }}
                                    </button>
                                </template>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
            
            <div class="px-4 py-2 bg-gray-50 text-center border-t border-gray-200">
                <a href="{{ route('notifications.index') }}" class="text-xs text-indigo-600 hover:text-indigo-900 font-medium">
                    {{ __('View All Notifications') }}
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
            
            init() {
                this.fetchNotifications();
                
                // Set up Echo to listen for new notifications
                if (window.Echo) {
                    window.Echo.private(`App.Models.User.{{ auth()->id() }}`)
                        .listen('.new.notification', (e) => {
                            this.notifications.unshift(e);
                            this.unreadCount++;
                        });
                }
                
                // Refresh notifications every minute
                setInterval(() => {
                    this.fetchNotifications();
                }, 60000);
            },
            
            toggleDropdown() {
                this.isOpen = !this.isOpen;
                if (this.isOpen) {
                    this.fetchNotifications();
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
