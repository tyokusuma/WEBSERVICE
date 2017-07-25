<template>
    <div class="navbar-custom-menu" id="markasread">
        <ul class="nav navbar-nav">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" onclick="">
                    <i class="fa fa-5-large fa-bell-o sBell"></i>
                    @if (count($notifs))
                        <span class="label label-warning sBadge">{{ unreads.length }}</span>
                    @endif
                </a>
                <ul class="dropdown-menu notif">
                    @forelse ($notifs as $notif)
                        <li class="divider menu"></li>
                        <li><a></a></li>
                        <li class="divider menu"></li>
                    @empty
                        <li class="divider menu"></li>
                        <li class="noNotif">No new notifications</li>
                        <li class="divider menu"></li>
                    @endforelse
                </ul>
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        props: ['unreads', 'userid'],
        mounted() {
            console.log('Component mounted.')
            Echo.private('App.User.' + this.userid)
                .notification((notification) => {
                    console.log(notification);
                });
        }
    }
</script>
