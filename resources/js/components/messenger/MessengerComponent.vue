<template>

    <div class="container">
        <div class="chatbody">
            <div class="panel panel-primary">
                <div class="panel-heading top-bar">
                    <div class="col-md-8 col-xs-8">
                        <h3 class="panel-title"><span class="glyphicon glyphicon-comment"></span> Chat - Miguel</h3>
                    </div>
                </div>
                <div class="panel-body msg_container_base">
                    <div v-for="(message, key) in messageInfo">
                        <div class="row msg_container base_sent" v-if="message.user.id == myInfo.id">
                            <div class="col-md-6 col-xs-6">
                                <div class="messages msg_sent">
                                    <p>{{myInfo.name}} (YOU)</p>
                                    <p>{{message.message}}</p>
                                    <time datetime="2009-11-13T20:00">Timothy • 51 min</time>
                                </div>
                            </div>
                            <div class="col-md-2 col-xs-1 avatar">
                                <img
                                    src="http://www.bitrebels.com/wp-content/uploads/2011/02/Original-Facebook-Geek-Profile-Avatar-1.jpg"
                                    class=" img-responsive ">
                            </div>
                        </div>
                        <div class="row msg_container base_receive" v-else>
                            <div class="col-md-2 col-xs-1 avatar ">
                                <img :src="ImagePath" class=" img-responsive ">
                            </div>
                            <div class="col-md-6 col-xs-6">
                                <div class="messages msg_receive">
                                    <p>{{message.user.name}}</p>
                                    <p>{{message.message}}</p>
                                    <time datetime="2009-11-13T20:00">Timothy • 51 min</time>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="panel-footer">
                    <div class="input-group">
                        <input id="btn-input" type="text" class="form-control send-mess-input input-sm chat_input"
                               v-model="inputValue"
                               placeholder="Write your message here..."
                               v-on:keyup.enter="SendMessage"/>
                        <span class="input-group-btn">
                                <button class="btn btn-primary btn-sm" id="btn-chat" v-on:click="SendMessage"><i class="fa fa-send fa-2x"
                                                                                        aria-hidden="true"></i></button>
                        </span>
                    </div>
                </div>
            </div>

        </div>
    </div>

</template>

<script>
    export default {
        name: "MessengerComponent",
        props: ['messages', 'myInfo'],
        data() {
            return {
                ImagePath: 'http://www.bitrebels.com/wp-content/uploads/2011/02/Original-Facebook-Geek-Profile-Avatar-1.jpg',
                messageInfo: [],
                inputValue: '',
                newMessage: [],
                lastInsertMessageId: '',
                // lastMessageId: '',
                polling: null
            }
        },
        mounted() {
            this.messageInfo = this.messages;
            this.getMessages();
        },
        methods: {
            makeChat(messageInfo) {
                console.log(this.myInfo);

            },
            SendMessage() {

                let newMessage = {
                    'message' : this.inputValue,
                    'user' : this.myInfo,
                    'user_id' : this.myInfo.id
                }


                axios.post('/home/addMessages', newMessage).then(response => {
                    this.messageInfo.push(newMessage);
                    this.inputValue = '';
                    this.lastInsertMessageId = response.data;
                    console.log(this.messageInfo.length);
                })



            },
            getMessages() {

                this.polling = setInterval(() => {

                    if(this.lastInsertMessageId != '') {
                        var lastMessageId = {
                            'id' : this.lastInsertMessageId
                        };
                    } else {
                        var lastMessageId = {
                            'id' : this.messageInfo[this.messages.length - 1].id
                        };
                    }

                    axios.post('/home/getLastMessages', lastMessageId).then(response => {
                        console.log(response);
                        for(let i = 0; i < response.data.length; i ++) {
                            this.messageInfo.push(response.data[i])
                            this.lastInsertMessageId = response.data[i].id;
                        }
                    })
                }, 5000)

            }
        }
    }
</script>

<style scoped>

</style>
