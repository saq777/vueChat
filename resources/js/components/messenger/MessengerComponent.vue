<template>

    <div>
        <div class="container-fluid h-100">
            <div class="row justify-content-center h-100">
                <div class="col-md-4 col-xl-3 chat">
                    <div class="card mb-sm-3 mb-md-0 contacts_card">
                        <div class="card-header">
                            <div class="input-group">
                                <input type="text" placeholder="Search..." name="" class="form-control search"
                                       @keyup="searchUser" v-model="userName">
                                <div class="input-group-prepend">
                                    <span class="input-group-text search_btn"><i class="fas fa-search"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="card-body contacts_body">
                            <ul class="contacts">
                                <li class="active" v-for="friend in friends" v-show="first"  v-if="friend.id != myInfo.id">
                                    <div>
                                        <div class="d-flex bd-highlight" @click="selectUser(friend)">
                                            <div class="img_cont">
                                                <div v-if="friend.avatar == null">
                                                    <img
                                                        src="https://www.svgimages.com/svg-image/s5/man-passportsize-silhouette-icon-256x256.png"
                                                        class="rounded-circle" width="70px">
                                                    <span class="online_icon"></span>
                                                </div>
                                                <div v-else>
                                                    <img
                                                        :src="'/images/profile/'+friend.id+'/'+friend.avatar"
                                                        class="rounded-circle" width="70px" height="70px">
                                                    <span class="online_icon"></span>
                                                </div>

                                            </div>
                                            <div class="user_info">
                                                <span>{{friend.name}}</span>
                                                <p>{{friend.name}} is online</p>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                            </ul>
                            <ul class="contacts">
                                <li class="active" v-for="user in users" v-show="second">
                                    <div class="d-flex bd-highlight" @click="selectUser(user)">
                                        <div class="img_cont">
                                            <div v-if="user.avatar == null">
                                                <img
                                                    src="https://www.svgimages.com/svg-image/s5/man-passportsize-silhouette-icon-256x256.png"
                                                    class="rounded-circle" width="70px">
                                                <span class="online_icon"></span>
                                            </div>
                                            <div v-else>
                                                <img
                                                    :src="'/images/profile/'+user.id+'/'+user.avatar"
                                                    class="rounded-circle" width="70px" height="70px">
                                                <span class="online_icon"></span>
                                            </div>
                                        </div>
                                        <div class="user_info">
                                            <span>{{user.name}}</span>
                                            <p>{{user.name}} is online</p>
                                        </div>
                                    </div>
                                </li>

                            </ul>
                        </div>
                        <div class="card-footer"></div>
                    </div>
                </div>
                <div class="col-md-8 col-xl-6 chat" v-if="partner.id != null">
                    <div class="card">
                        <div class="card-header msg_head">
                            <div class="d-flex bd-highlight">
                                <div class="img_cont">
                                    <div v-if="partner.avatar == null">
                                        <a :href="'/home/guest/'+partner.id">
                                            <img
                                                src="https://www.svgimages.com/svg-image/s5/man-passportsize-silhouette-icon-256x256.png"
                                                class="rounded-circle" width="70px">
                                            <span class="online_icon"></span>
                                        </a>
                                    </div>
                                    <div v-else>
                                        <a :href="'/home/guest/'+partner.id">
                                            <img
                                                :src="'/images/profile/'+partner.id+'/'+partner.avatar"
                                                class="rounded-circle" width="70px" height="70px">
                                            <span class="online_icon"></span>
                                        </a>
                                    </div>
                                </div>
                                <div class="user_info">
                                    <span>Chat with {{ partner.name }}</span>
                                    <p>{{ partner.length }}</p>
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
                                    <div class="img_cont_msg" v-if="partner.avatar == null">
                                        <a :href="'/home/guest/'+message.from_id">
                                            <img src="https://www.svgimages.com/svg-image/s5/man-passportsize-silhouette-icon-256x256.png"
                                                 class="rounded-circle user_img_msg">
                                        </a>
                                    </div>
                                    <div v-else>
                                        <img
                                            :src="'/images/profile/'+partner.id+'/'+partner.avatar"
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
                                          placeholder="Type your message..." v-on:keyup.enter="SendMessage" v-model="inputValue"></input>
                                <div class="input-group-append">
                                    <span class="input-group-text send_btn" v-on:click="SendMessage"><i class="fas fa-location-arrow"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div v-else>
                    <profile-picture-component
                        v-bind:user-info="myInfo"
                        v-bind:part="part"
                    ></profile-picture-component>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "MessengerComponent",
        props: [ 'myInfo', 'part'],
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
            }
        },
        mounted() {
            // this.getMessages();
            this.friends = this.part
            // this.getPartners(this.partner)
        },
        // created() {
        //     this.fetchMessages();
        // },
        methods: {

            // fetchMessages() {
            //
            //     if(this.partner == []) {
            //         return false;
            //     } else {
            //         if(this.lastInsertMessageId != '') {
            //             var lastMessageId = {
            //                 'id' : this.lastInsertMessageId,
            //                 'from_id': this.myInfo.id,
            //                 'to_id': this.partner.id
            //             };
            //         } else {
            //             var lastMessageId = {
            //                 'id' : this.messages[this.messages.length - 1].id,
            //                 'from_id': this.myInfo.id,
            //                 'to_id':   this.partner.id
            //             };
            //
            //         }
            //         axios.post('/home/getLastMessages', lastMessageId).then(response => {
            //             for(let i = 0; i < response.data.length; i ++) {
            //
            //                 this.messages.push(response.data[i])
            //                 this.lastInsertMessageId = response.data[i].id;
            //                 $("#scrollTop").animate({scrollTop:$(document).height()}, 'slow');
            //             }
            //         })
            //     }
            // },
            SendMessage() {

                // let newMessage = {
                //     'message' : this.inputValue,
                //     'user' : this.myInfo,
                //     'to_id' : this.myInfo.id,
                //     'from_id' : this.partner.id
                // };
                let newMessageFromMe = {
                    'message' : this.inputValue,
                    'user' : this.myInfo,
                    'from_id' : this.myInfo.id,
                    'to_id' : this.partner.id
                };

                window.scrollTo(0,document.body.scrollHeight);
                this.$emit('messagesent', newMessageFromMe);
                Echo.private('chat').listen('MessageSent', (e) => {
                    this.messages.push({
                        'message': e.message.message,
                        'from_id': e.message.from_id,
                        'to_id': e.message.to_id,
                        'user' : this.partner
                    });
                    console.log(e);
                    return false;
                });
                axios.post('/home/addMessages', newMessageFromMe).then(response => {
                    this.messages.push(newMessageFromMe);
                    this.inputValue = '';
                    this.lastInsertMessageId = response.data.id;
                })



            },
            // getMessages() {
            //
            //     this.polling = setInterval(() => {
            //         if(this.partner == []) {
            //             return false;
            //         } else {
            //             if(this.lastInsertMessageId != '') {
            //                 var lastMessageId = {
            //                     'id' : this.lastInsertMessageId,
            //                     'from_id': this.myInfo.id,
            //                     'to_id': this.partner.id
            //                 };
            //             } else {
            //                 var lastMessageId = {
            //                     'id' : this.messages[this.messages.length - 1].id,
            //                     'from_id': this.myInfo.id,
            //                     'to_id':   this.partner.id
            //                 };
            //             }
            //
            //             axios.post('/home/getLastMessages', lastMessageId).then(response => {
            //                 for(let i = 0; i < response.data.length; i ++) {
            //
            //                     this.messages.push(response.data[i])
            //                     this.lastInsertMessageId = response.data[i].id;
            //                     $("#scrollTop").animate({scrollTop:$(document).height()}, 'slow');
            //                 }
            //             })
            //         }
            //
            //     }, 5000)
            //
            // },
            searchUser() {
                this.first = false;
                this.second = true;
                if(this.userName.length < 1) {
                    this.users = []

                    this.first = true;
                    this.second = false;
                    return false;
                }
                axios.post('/getUsers', {
                    name: this.userName
                }).then(response => {
                    if(response.data.length == 0) {
                        alert("User "+this.userName+ "not found")
                    } else {
                        this.users = response.data;
                    }
                })
            },
            selectUser(user) {
                this.messages = [];
                this.partner = user;
                let info = {
                    'from_id': this.myInfo.id,
                    'to_id': user.id
                };

                axios.post('/get/messages', info).then(response => {
                    this.messages = response.data;
                    // this.getMessages();
                    this.fetchMessages();
                })
            },
            // getPartners(partner) {
            //
            //     // this.polling = setInterval(() => {
            //     //     console.log(Object.keys(this.part).length, 'this part length');
            //     //     // if(Object.keys(this.part).length != 0) {
            //     //     //     for(let i = 0; i < this.part.length; i++) {
            //     //     //         if(this.part[i].id != this.myInfo.id) {
            //     //     //             this.partnerId.push(this.friends[i].id)
            //     //     //             alert();
            //     //     //         }
            //     //     //     }
            //     //     // }
            //     //     // console.log(this.part);
            //     // }, 500);
            // }
        }
    }
</script>

<style scoped>

</style>
