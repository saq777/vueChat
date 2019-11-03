<template>
<div class="container">
    <div class="mt-5">
        <div class="row">
            <div class="col-md-4">
                <p>
                    <i class="fas fa-envelope mainColor"></i>
                    <em>
                        <strong>
                            Email Notifications
                        </strong>
                    </em>
                </p>
            </div>
            <div class="col-md-4">
                <label class="switch">
                    <input type="checkbox" class="inputSwitch" :checked="emailChecked" @change="notification">
                    <span class="slider round"></span>
                </label>
            </div>
        </div>
    </div>
    <vue-phone-number-input v-model="yourValue"></vue-phone-number-input>
</div>

</template>

<script>
    export default {
        props: ['settings'],
        name: "SettingsComponent",
        data() {
            return {
                emailChecked: "",
                yourValue: ""
            }
        },
        mounted() {
            this.checkSettings();
            console.log(this.settings.notification);
        },

        methods: {
            notification() {
                axios.put("settings/notification").then(response => {
                    console.log(response);
                })
            },
            checkSettings() {
                if(this.settings.notification == false) {
                    this.emailChecked = "";
                } else {
                    this.emailChecked = "checked";
                }
            }
        }
    }
</script>

<style scoped>
    body {
        font-family: "Nunito", sans-serif !important;
        font-size: 17px  !important;
    }
</style>