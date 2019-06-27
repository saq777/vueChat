<template>
    <div>

        <div class="input-group mb-3">
            <input type="text"
                   class="form-control"
                   placeholder="Repository Name"
                   aria-label="Recipient's username"
                   aria-describedby="basic-addon2"
                   @keyup.enter="createRepository"
                   v-model="fileName">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary"
                        type="button"
                        @click="createRepository">Create</button>
            </div>

        </div>

        <div class="row">
            <div class="col-md-3" v-for="(file, key) in filesArr">
                <div :id="'folder'+file.id">
                    <a :href="'/home/upload-images/'+file.id" class="float-left">
                        <div>
                            <img src="/images/folder.png" :alt="'folder'+key">
                        </div>
                        <div>
                            {{ file.name }}
                        </div>
                    </a>
                    <div class="float-right">
                        <button class="btn-danger btn"
                                @click="deleteFile(file.id)">DELETE</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "fileGroup",
        props: ['files', 'myInfo'],
        data() {
          return {
              fileName: '',
              filesArr: []
          }
        },
        mounted() {
            this.filesArr = this.files;
        },
        methods: {
            createRepository() {

                if(this.fileName == '') {
                    alert('Fill name');
                    return false;
                }

                let file = {
                    'name' : this.fileName,
                    'user_id' : this.myInfo.id
                }

                axios.post('/addRepository', file).then(response => {
                    this.filesArr.push(response.data);
                    this.fileName = ''
                })
            },
            deleteFile(filId) {
                let idName = "folder"+filId;
                console.log(idName);
                axios.post('/deleteRepository', {
                    file_id: filId
                }).then(response => {
                    $("#"+idName).remove()
                })
            }
        }
    }
</script>

<style scoped>

</style>
