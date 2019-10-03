<template>
    <div class="contacts-list">
        <ul>
            <li v-for="contact in sortedContacts" :key="contact.id" @click="selectContact(contact)" :class="{ 'selected' : contact == selected }">
                <div class="avatar">
                    <img :src="contact.profile_image" :alt="contact.name">
                </div>
                <div class="contact">
                    <p class="name">{{ contact.name }}</p>
                    <p :class="{ 'online' : contact.online }"></p>
                    <p class="email">{{ contact.email }}</p>
                </div>
                <span class="unread" v-if="contact.unread">{{ contact.unread }}</span>
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    props:{
        contacts:{
            type:Array,
            default:[]
        }
    },
    data(){
        return{
            selected: this.contacts.length ? this.contacts[0] : null
        }
    },
    methods:{
        selectContact(contact){
            this.selected = contact;

            this.$emit('selected', contact);
        }
    },
    computed: {
        sortedContacts() {
            return _.sortBy(this.contacts, [(contact) => {
                if (contact == this.selected) {
                    return Infinity;
                }

                return contact.unread;
            }]).reverse();
        }
    }
}
</script>

<style lang="scss" scoped>
.contacts-list{
    flex:2;
    max-height: 600px;
    overflow: scroll;
    border: 1px solid #a4a8a9;

    ul{
        list-style-type: none;
        padding-left: 0;
        
        li{
            display: flex;
            padding: 2px;
            border-bottom: 1px solid #bcbcbc;
            height: 50px;
            position: relative;
            cursor: pointer;

            &.selected{
                background: #ebecec;
            }

            span.unread {
                background: #dc3545;
                color: #fff;
                position: absolute;
                right: 11px;
                top: 20px;
                display: flex;
                font-weight: 700;
                min-width: 20px;
                justify-content: center;
                align-items: center;
                line-height: 20px;
                font-size: 12px;
                padding: 0 4px;
                border-radius: 3px;
            }

            .avatar{
                flex: 1;
                align-items: center;
                display: flex;

                img{
                    width: 40px;
                    border-radius: 50%;
                    margin:0 auto;
                }
            }
            .contact{
                flex:3;
                font-size:10px;
                overflow: hidden;
                display: flex;
                flex-direction: column;
                justify-content: center;

                p{
                    margin: 0;

                    &.name {
                        font-weight: bold;
                        display: flex;
                    }
                }
                
                .online{
                    width: 7px;
                    height: 7px;
                    background-color: #e86363;
                    position: absolute;
                    right: 15px;
                    top: 5px;
                    display: flex;
                    font-weight: 700;
                    min-width: 7px;
                    justify-content: center;
                    align-items: center;
                    line-height: 20px;
                    padding: 1px 1px;
                    border-radius: 4px;
                }
            }
        }

        li:hover{
            background-color: #e0f5fa;
        }
    }
}
</style>