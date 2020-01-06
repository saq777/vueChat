<template>
    <div class="modal" id="myModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>
                        <div class="helper"></div>
                        <div class="drop display-inline align-center" @dragover.prevent @drop="onDrop">
                            <div class="helper"></div>
                            <label v-if="!image" class="btn display-inline" for="selectedImage">
                                <i class="far fa-images btn btn-primary"></i>
                                <input type="file" name="image" id="selectedImage" class="d-none"
                                       @change="onChange">
                            </label>
                            <div class="hidden display-inline align-center" v-else v-bind:class="{ 'image': true }">
                                <div align="center">
                                    <img :src="image" alt="" class="img"/>
                                </div>
                                <div>
                                    <label class="btn display-inline" for="selected">
                                        <i class="far fa-images btn btn-primary"></i>
                                        <input type="file" name="image" id="selected" class="d-none"
                                               @change="onChange">
                                    </label>
                                </div>
                            </div>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" @click="saveStory">Save story</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "StoryModal",
        data() {
            return {
                image: '',
                file: ''
            }
        },
        methods: {
            onDrop: function (e) {
                e.stopPropagation();
                e.preventDefault();
                var files = e.dataTransfer.files;
                this.createFile(files[0]);
            },
            onChange(e) {
                var files = e.target.files;
                this.file = files[0];
                this.createFile(files[0]);
            },
            createFile(file) {
                if (!file.type.match('image.*')) {
                    alert('Select an image');
                    return;
                }
                var img = new Image();
                var reader = new FileReader();
                var vm = this;

                reader.onload = function (e) {
                    vm.image = e.target.result;
                };
                reader.readAsDataURL(file);
            },
            saveStory() {
               const fd = new FormData();
               fd.append('image', this.file, this.file.name);
               axios.post("/uploadStory", fd).then(response => function() {
                   $('#myModal').modal('hide');
               })
            }
        }
    }
</script>

<style scoped>

</style>