<template>
    <div>
        <div class="container">
            <div class="row">
                <div class="col-md-2">
                    <img
                        src="http://www.bitrebels.com/wp-content/uploads/2011/02/Original-Facebook-Geek-Profile-Avatar-1.jpg"
                        alt="profile_picture" width="300px" class=" img-responsive">
                </div>
                <div class="col-md-3">
                    <div>
                        Name: {{ guestInfo.name }}
                    </div>
                    <div>
                        Email: {{guestInfo.email}}
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
              files: ''
          }
        },
        mounted() {
            this.files = this.guestInfo.files
        }
    }
</script>

<style scoped>

</style>
