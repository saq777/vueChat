<template>
    <div class="card">
        <div class="card-header msg_head">
            <div class="d-flex bd-highlight">
                <div class="img_cont">
                    <div v-if="part.avatar == null">
                        <a :href="'/home/guest/'+part.id">
                            <img
                                src="https://www.svgimages.com/svg-image/s5/man-passportsize-silhouette-icon-256x256.png"
                                class="rounded-circle" width="70px">
                            <span class="online_icon"></span>
                        </a>
                    </div>
                    <div v-else>
                        <a :href="'/home/guest/'+part.id">
                            <img
                                :src="'/images/profile/'+part.id+'/'+part.avatar"
                                class="rounded-circle" width="70px" height="70px">
                            <span class="online_icon"></span>
                        </a>
                    </div>
                </div>
                <div class="user_info">
                    <span>Chat with {{ part.name }}</span>
                    <p>{{ part.length }}</p>
                </div>
                <div class="video_cam">
                    <span><i class="fas fa-video"></i></span>
                    <span><i class="fas fa-phone"></i></span>
                </div>
            </div>
            <span id="action_menu_btn"><i class="fas fa-ellipsis-v"></i></span>
            <div class="action_menu">
                <ul>
                    <li><i class="fas fa-user-circle"></i> View profile</li>
                    <li><i class="fas fa-users"></i> Add to close friends</li>
                    <li><i class="fas fa-plus"></i> Add to group</li>
                    <li><i class="fas fa-ban"></i> Block</li>
                </ul>
            </div>
        </div>
        <div class="card-body msg_card_body" >
            <div v-for="(message, key) in messages">
                <div class="d-flex justify-content-end mb-4" v-if="message.from_id == myInfo.id">
                    <div class="msg_cotainer_send">
                        <p>{{message.message}}</p>
                    </div>
                    <div class="img_cont_msg" v-if="myInfo.avatar == null">
                        <img
                            src="https://www.svgimages.com/svg-image/s5/man-passportsize-silhouette-icon-256x256.png"
                            class="rounded-circle user_img_msg">
                    </div>
                    <div class="img_cont_msg" v-else>
                        <img
                            :src="'/images/profile/'+myInfo.id+'/'+myInfo.avatar"
                            class="rounded-circle user_img_msg">
                    </div>
                </div>
                <div class="d-flex justify-content-start mb-4" v-else>
                    <div class="img_cont_msg" v-if="part.avatar == null">
                        <a :href="'/home/guest/'+message.from_id">
                            <img src="https://www.svgimages.com/svg-image/s5/man-passportsize-silhouette-icon-256x256.png"
                                 class="rounded-circle user_img_msg">
                        </a>
                    </div>
                    <div v-else>
                        <div class="badge badge-pill badge-primary" v-show="typing">typing...</div>
                        <img
                            :src="'/images/profile/'+part.id+'/'+part.avatar"
                            class="rounded-circle user_img_msg">
                    </div>
                    <div class="msg_cotainer">
                        {{message.message}}
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="input-group">
                <div class="input-group-append">
                    <span class="input-group-text attach_btn"><i class="fas fa-paperclip"></i></span>
                </div>
                <input name="" class="form-control type_msg"
                       placeholder="Type your message..." v-on:keyup.enter="SendMessage" v-model="inputValue">
                <div class="input-group-append">
                    <span class="input-group-text send_btn" v-on:click="SendMessage"><i class="fas fa-location-arrow"></i></span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Chat",
        props: [ 'myInfo', 'part', 'mess'],
        data() {
            return {
                ImagePath: 'http://www.bitrebels.com/wp-content/uploads/2011/02/Original-Facebook-Geek-Profile-Avatar-1.jpg',
                messages: [],
                inputValue: '',
                newMessage: [],
                lastInsertMessageId: '',
                // lastMessageId: '',
                polling: null,
                userName: '',
                users: '',
                partner: '',
                friends: '',
                first: true,
                second: false,
                partnerId: [],
                typing: false,
            }
        },
        watch: {
            mess(newVal) {
                this.messages = newVal;
            }
        },
        mounted() {
            this.friends = this.part;
            this.partner = this.friends;


            let user1 = this.myInfo.id;
            let user2 = this.friends.id;
            if (user1 > user2)
            {
                user1 = this.friends.id;
                user2 = this.myInfo.id;
            }
            console.log(this.mess, this.friends);
            Echo.private(`chat.${user1}_${user2}`).listen('MessageSent', (e) => {
                let arr = {
                    'message': e.message.message,
                    'from_id': e.message.from_id,
                    'to_id': e.message.to_id,
                    'user' : this.part
                };
                this.messages.push(arr);
                console.log(e);

            }).listenForWhisper('typing', (e) => {
                this.typing = e.typing;
                setTimeout(function() {
                    this.typing = false;
                }, 5000);
            })
                .listenForWhisper('deleting', (e) => {
                    this.typing = false;
                    this.deleting = e.deleting;
                    setTimeout(function() {
                        _this.typing = false;
                        _this.deleting = false;
                    }, 5000);
                })
        },
        methods: {


            SendMessage() {

                let newMessageFromMe = {
                    'message' : this.inputValue,
                    'user' : this.myInfo,
                    'from_id' : this.myInfo.id,
                    'to_id' : this.part.id
                };
                console.log(newMessageFromMe, 'newMessageFromMe');
                window.scrollTo(0,document.body.scrollHeight);


                axios.post('/home/addMessages', newMessageFromMe).then(response => {
                    this.messages.push(newMessageFromMe);
                    this.inputValue = '';
                    this.lastInsertMessageId = response.data.id;
                    return false;
                })



            },
        }
    }
</script>

<style scoped>

</style>
