<template>
    <div @click="closeDropdown">
        <div class="md-form mt-0">
            <input class="form-control"
                   type="text"
                   placeholder="Search"
                   aria-label="Search"
                   @keyup="searchUser"
                   v-model="userName">
        </div>

        <div class="overflow-auto max-height-200">
            <div class="mr-3 float-right "
                 v-show="closebtn"
            style="z-index:999;">
                <button class="btn-danger position-fixed"
                        @click="closeDropdown">
                    <i class="fa fa-times-circle"></i>
                </button>
            </div>
            <div v-for="(user, key) in usersArray" class="d-flex mt-5 border-bottom" data-show-subtext="true" data-live-search="true">
                <a :href="'home/guest/'+user.id">
                    <div class="col-md-4">
                        #{{ key +1 }} -
                    </div>
                    <div class="col-md-2">
                        <img src="https://image.flaticon.com/icons/svg/21/21104.svg" alt="">
                    </div>
                    <div class="col-md-4">
                        {{ user.name }}
                    </div>
                </a>
            </div>
        </div>
        <div>
            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.


        </div>
    </div>
   
</template>

<script>
    export default {
        name: "SearchUser",
        data() {
            return {
                userName: '',
                usersArray: [],
                closebtn: false
            }
        },
        methods: {
            searchUser() {
                if(this.userName.length <= 2) {
                    return false;
                }

                axios.post('/getUsers', {
                    'name' : this.userName
                }).then(response => {
                    this.closebtn = true;
                    this.usersArray = response.data;
                    if(response.data == '') {
                        this.closeDropdown()
                    }
                })
            },
            closeDropdown() {
                this.usersArray = []
                this.closebtn = false;
            }
        }
    }
</script>

<style scoped>

</style>
