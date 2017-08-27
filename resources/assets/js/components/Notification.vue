<template>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-5-large fa-bell-o sBell"></i>
            <span class="label label-warning sBadge"{{ unreadNotifications.length }}</span> 
        </a>
        <ul class="dropdown-menu notif" id="notifs">
        </ul>
    </li>
</template>

<script>
    export default {
        props:['unreads', 'userid'],
        data() {
            return {
                unreadNotifications: this.unreads
            }
        },
        mounted() {
            console.log('Component mounted.');
            Echo.private('App.User.' + this.userid)
                .notification((notification) => {
                    // console.log(notification);
                    let newUnreadNotifications = {data: {message: notification.message, id: notification.id}};
                    console.log(newUnreadNotifications);
                    this.unreadNotifications.push(newUnreadNotifications);
                });
        }
    }
</script>
