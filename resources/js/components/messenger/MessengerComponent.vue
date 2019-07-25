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
                    <chat-component
                        v-bind:my-info="myInfo"
                        v-bind:part="partner"
                        v-bind:mess="messages"></chat-component>
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
                messagePart: ''
            }
        },
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
                this.partner = user;
                let info = {
                    'from_id': this.myInfo.id,
                    'to_id': user.id
                };

                axios.post('/get/messages', info).then(response => {
                    this.messages = response.data;
                    this.messagePart = this.messages;

                })

            },
        }
    }
</script>

<style scoped>

</style>
