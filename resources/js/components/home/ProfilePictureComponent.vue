<template>
    <div class="card">
        <div class="profile chat">
            <div class="row">
                <div class="col-md-4 col-xs-12 col-sm-6 col-lg-4 pl-5">
                    <div>
                        <div class="rounded-circle">
                            <img :src="src" width="122px"/>
                        </div>
                    </div>
                    <div class="mt-5">
                        <label for="images-upload">
                            <span class="btn-primary btn">CHOOSE FILE</span>
                            <input
                                type="file"
                                multiple
                                id="images-upload"
                                class="d-none"
                                @change="fileChange">
                        </label>
                    </div>
                </div>
                <div class="col-md-8 col-xs-12 col-sm-6 col-lg-8">
                    <div class="container" style="border-bottom:1px solid black">
                        <h2>{{ userInfo.name }}</h2>
                    </div>
                    <hr>
                    <ul class="container details">
                        <li><p><span class="glyphicon glyphicon-envelope one" style="width:50px;"></span>{{ userInfo.email }}</p></li>
                        <li><p><span class="glyphicon glyphicon-map-marker one" style="width:50px;"></span>Hyderabad</p></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ProfilePictureComponent",
        props: ['userInfo', 'part'],
        data() {
            return {
                attachment: null,
                form: new FormData,
                user: '',
                avatar: true,
                src: ''
            }
        },
        mounted() {
            this.user = this.userInfo;
          this.profilePicture();
            console.log(this.part);
        },
        methods: {
            profilePicture() {
                if(this.userInfo.avatar == null) {
                    this.avatar = true;
                } else {
                    this.src = this.userInfo.avatar;
                    this.avatar = false;
                }
            },
            fileChange(e) {
                let selectedFile = e.target.files[0]

                this.attachment = selectedFile;
                this.form.append('pic', selectedFile);
                console.log(this.form)

                axios.post('update/profile/picture', this.form).then(response => {
                    this.user = response.data;
                    this.src = response.data.avatar;
                    this.avatar = false;
                })
            },
        }
    }
</script>

<style scoped>
    .details li {
        list-style: none;
    }
    li {
        margin-bottom:10px;

    }
    .profile {
        width: 800px;
        color: #fff;
    }
</style>
