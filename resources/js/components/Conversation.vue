<template>
    <div class="conversation">
        <h1>{{contact ? contact.name : 'Select a contact'}}</h1>
        <MessagesFeed :contact="contact" :messages="messages" :user="user"/>
        <MessageComposer @send="sendMessage" />
    </div>
</template>

<script>
import MessagesFeed from './MessagesFeed';
import MessageComposer from './MessageComposer';
export default {
    props:{
        contact:{
            type:Object,
            default:null
        },
        user:{
            type:Object,
            default:null
        },
        messages:{
            type:Array,
            default:[]
        }
    },
    data(){
        return{
            api_token: this.$root.api_token
        };
    },
    methods:{
        sendMessage(text){
            if(!this.contact){
                return;
            }

            axios.post(`/api/conversation/send?api_token=${this.api_token}`,{
                contact_id:this.contact.id,
                text:text
            }).then((response)=>{
                this.$emit('new', response.data);
            });
        }
    },
    components:{MessagesFeed, MessageComposer}
}
</script>

<style lang="scss" scoped>
.conversation{
    flex: 5;
    display: flex;
    flex-direction: column;
    justify-content: space-between;

    h1{
        font-size: 15px;
        padding: 5px 10px;
        margin: 0;
        border-bottom: 1px lightgray dashed;
        text-align: right;
    }
}
</style>