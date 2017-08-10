<template>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" onclick="">
            <i class="fa fa-5-large fa-bell-o sBell"></i>
            <span v-if="{{ unreadNotifications.length !== 0 }}" class="label label-warning sBadge"{{ unreadNotifications.length }}</span> <!-- show count of unread notification -->
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
                unreadNotifications:this.unreads
            }
        },
        mounted() {
            console.log('Component mounted.');
            Echo.channel('admin')
                .notification((notification) => {
                    console.log(notification);
                });
        }
    }
</script>
