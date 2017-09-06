<template>
  <!-- <div class="container">
    <div class="row">
      <div class="col-sm-6 col-sm-offset-3">
        <div class="form-group">
          <label for="title">Post Title</label>
          <input v-model="newPostTitle" id="title" type="text" class="form-control">
        </div>
        <div class="form-group">
          <label for="description">Post Description</label>
          <textarea v-model="newPostDesc" id="description" rows="8" class="form-control"></textarea>
        </div>
        <button @click="addPost(newPostTitle, newPostDesc)" 
          :class="{disabled: (!newPostTitle || !newPostDesc)}"
          class="btn btn-block btn-primary">Submit</button>
      </div>
    </div>
  </div> -->
</template>

<script>
  export default {
    created() {
      this.listenForChanges();
    },
    methods: {
      listenForChanges() {
        Echo.private('admin')
          .listen('AdminNotificationEvent', isi => {
            if (! ('Notification' in window)) {
              alert('Web Notification is not supported');
              return;
            }

            Notification.requestPermission( permission => {
              let notification = new Notification('New Notification!', {
                body: isi.message, // content for the alert
                icon: "https://pusher.com/static_logos/320x320.png" // optional image url
              });

              // link to page on clicking the notification
              // notification.onclick = () => {
              //   window.open(window.location.href);
              // };
            });
          })
        }
      } 
    }
</script>
