<template>
    <div class="feed" ref="feed">
        <ul v-if="contact">
            <li v-for="message in messages" :class="`message${message.to == contact.id ? ' sent' : ' received'}`" :key="message.id">
                <div class="avatar">
                    <img :src="message.to == contact.id ? user.profile_image : contact.profile_image">
                </div>
                <div class="text">
                    {{message.text}}
                </div>
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    props:{
        contact:{
            type: Object
        },
        user:{
            type: Object
        },
        messages:{
            type:Array,
            required:true
        }
    },
    methods:{
        scrollToBottom(){
            setTimeout(()=>{
                this.$refs.feed.scrollTop = this.$refs.feed.scrollHeight - this.$refs.feed.clientHeight;
            }, 50);
        }
    },
    watch:{
        contact(contact){
            this.scrollToBottom();
        },
        messages(messages){
            this.scrollToBottom();
        }
    }
}
</script>

<style lang="scss" scoped>
.feed{
    background: rgb(238, 238, 238);
    height: 100%;
    max-height: 360px;
    min-height: 300px;
    overflow: scroll;

    ul{
        list-style-type: none;
        padding: 5px;

        li{
            .avatar img{
                width:35px;
                border-radius: 50%;
            }
            &.message{
                margin: 10px 0;
                width: 100%;
                display: flex;

                .text{
                    max-width: 200px;
                    border-radius: 5px;
                    padding: 12px;
                    display: inline-block;
                    font-size: 12px;
                }

                &.received{
                    flex-direction: row-reverse;

                    .text{
                        background: lightgray;
                    }
                }
                &.sent{
                    .text{
                        background: rgb(200, 199, 223);
                    }
                }
            }
        }
    }
}
</style>