<template>
  <div class="message-notice">
    <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" href="./chat">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge unread_count">{{ unread_count }}</span>
        </a>
      </li>
  </div>
</template>

<script>
export default {
    props:{
      user:{
          type:Object,
          required:true
      }
    },
    data(){
        return{
            api_token: this.$root.api_token,
            unread_count: null
        };
    },
    mounted() {
        Echo.private(`messages.${this.user.id}`)
          .listen('NewMessage', (e) => {
              this.handleIncoming(e.message);
          });

        axios.get(`/api/messagecount?api_token=${this.api_token}`)
          .then((response) => {
            var count = response.data[0];
            this.unread_count = count['message_count'] > 0 ? count['message_count'] : null;
          });
    },
    methods:{
      handleIncoming(message){
        this.unread_count = this.unread_count + 1;
        //toastr.info('New message from '+message.from_contact['name']);
      },
    },
}
</script>
