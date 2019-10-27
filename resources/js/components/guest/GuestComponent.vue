<template>
    <div>
        <div class="container">
            <div class="row">
                <div class="col-md-2">
                    <img :src="imagePath" width="150px" class=" img-responsive">
                </div>
                <div class="col-md-3">
                    <div>
                        Name: {{ guestInfo.name }}
                    </div>
                    <div>
                        Email: {{guestInfo.email}}
                    </div>
                </div>
                <div class="col-md-4">
                    <div v-if="checkFollow">
                        <button class="btn btn-danger" @click="unFollow()">
                            UnFollow
                        </button>
                    </div>
                    <div v-else>
                        <button class="btn btn-success" @click="follow()">
                            Follow
                        </button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div v-for="(file, key) in files" class="col-md-2">
                    <a :href="'/home/files/'+file.id">
                        <div>
                            <img src="/images/folder.png" alt="">
                        </div>
                        <div>
                            name: <span>{{ file.name }}</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "GuestComponent",
        props: ['guestInfo'],
        data() {
          return {
              files: '',
              imagePath: '',
              checkFollow: false
          }
        },
        mounted() {
            this.files = this.guestInfo.files;
            if(this.guestInfo.avatar == null) {
                this.imagePath = "/images/avatar.png";
            } else {
                this.imagePath = '/images/profile/'+this.guestInfo.id+'/'+this.guestInfo.avatar
            }
            this.userCheckFollow()
        },
        methods: {
            userCheckFollow() {
                if(this.guestInfo.follower !== null) {
                    this.checkFollow = true;
                }
            },
            unFollow() {
                axios.post("/user/unFollow/"+this.guestInfo.follower.id).then(response => {
                    console.log(response);
                    this.checkFollow = false;
                })
            },
            follow() {
                axios.post("/user/follow/"+this.guestInfo.id).then(response => {
                    console.log(response);
                    this.checkFollow = true;
                })
            }
        }
    }
</script>

<style scoped>

</style>
