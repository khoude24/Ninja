<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <button
                                @click="initAddWord()" class="btn btn-primary btn-xs pull-right">
                            + Add New Word
                        </button>
                        Awesome words
                    </div>

                    <div class="panel-body">
                        <table class="table table-bordered table-striped table-responsive" v-if="words.length > 0">
                            <tbody>
                            <tr>
                                <th>
                                    No.
                                </th>
                                <th>
                                    Awesome word
                                </th>
                                <th>
                                    Ninja Name
                                </th>
                                <th>
                                   Pirate Name
                                </th>
                                <th>
                                    Action
                                </th>
                            </tr>
                            <tr v-for="(word, index) in words">
                                <td>{{index +1}}</td>
                                <td>
                                    {{word.word}}
                                </td>
                                <td>
                                    {{word.name}}
                                </td>
                                <td>
                                    {{word.pirate_name}}
                                </td>
                                <td>
                                    <button @click="initUpdate(index)" class="btn btn-success btn-xs">Edit</button>
                                    <button @click="deleteWord(index)" class="btn btn-danger btn-xs">Delete</button>                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" tabindex="-1" role="dialog" id="add_word_model">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Add New Word</h4>
                    </div>
                    <div class="modal-body">

                        <div class="alert alert-danger" v-if="errors.length > 0">
                            <ul>
                                <li v-for="error in errors">{{error}}</li>
                            </ul>
                        </div>

                        <div class="form-group">
                            <label for="word">Awesome word:</label>
                            <input type="text" name="name" id="word" placeholder="Awesome word" class="form-control" v-model="word.word">
                        </div>
                        <div class="form-group">
                            <label for="name">Ninja name:</label>
                            <input type="text" name="name" id="name" placeholder="Ninja name" class="form-control" v-model="word.name">
                        </div>
                        <div class="form-group">
                            <label for="name">Pirate name:</label>
                            <input type="text" name="pirate_name" id="pirate_name" placeholder="Pirate Name" class="form-control" v-model="word.pirate_name">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" @click="createWord" class="btn btn-primary">Submit</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <div class="modal fade" tabindex="-1" role="dialog" id="update_word_model">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Update Word</h4>
                    </div>
                    <div class="modal-body">

                        <div class="alert alert-danger" v-if="errors.length > 0">
                            <ul>
                                <li v-for="error in errors">{{error}}</li>
                            </ul>
                        </div>

                        <div class="form-group">
                            <label>Word:</label>
                            <input type="text" placeholder="Awesome word" class="form-control" v-model="update_word.word">
                        </div>
                        <div class="form-group">
                            <label for="name">Ninja name:</label>
                            <input type="text" placeholder="Ninja name" class="form-control" v-model="update_word.name"></input>
                        </div>
                        <div class="form-group">
                            <label for="name">Pirate name:</label>
                            <input type="text" placeholder="Pirate name" class="form-control" v-model="update_word.pirate_name"></input>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" @click="updateWord" class="btn btn-primary">Submit</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div><!-- /.modal -->

    </div>
</template>

<script>
    export default {
        data(){
            return {
                word: {
                    word: '',
                    name: '',
                    pirate_name: ''
                },
                errors: [],
                words: [],
                update_word: {}
            }
        },
        mounted()
        {
            this.readWords();
        },
        methods: {
            initAddWord()
            {
                $("#add_word_model").modal("show");
            },
            createWord()
            {
                axios.post('/words', {
                    word: this.word.word,
                    name: this.word.name,
                    pirate_name: this.word.pirate_name
                })
                    .then(response => {

                        this.reset();

                        this.word.push(response.data.word);

                        $("#add_word_model").modal("hide");

                    })
                    .catch(error => {
                        this.errors = [];
                        if (error.response.data.errors.word) {
                            this.errors.push(error.response.data.errors.word[0]);
                        }

                        if (error.response.data.errors.name) {
                            this.errors.push(error.response.data.errors.name[0]);
                        }

                        if (error.response.data.errors.pirate_name) {
                            this.errors.push(error.response.data.errors.pirate_name[0]);
                        }
                    });
            },
            reset()
            {
                this.word.word = '';
                this.word.name = '';
                this.word.pirate_name = '';
            },
            readWords()
            {
                axios.get('/words')
                    .then(response => {

                        this.words = response.data.words;

                    });
            },
            initUpdate(index)
            {
                this.errors = [];
                $("#update_word_model").modal("show");
                this.update_word = this.words[index];
            },
            updateWord()
            {
                axios.patch('/words/' + this.update_word.id, {
                    word: this.update_word.word,
                    name: this.update_word.name,
                    pirate_name: this.update_word.pirate_name,
                })
                    .then(response => {

                        $("#update_word_model").modal("hide");

                    })
                    .catch(error => {
                        this.errors = [];
                        if (error.response.data.errors.word) {
                            this.errors.push(error.response.data.errors.word[0]);
                        }

                        if (error.response.data.errors.word) {
                            this.errors.push(error.response.data.errors.word[0]);
                        }

                        if (error.response.data.errors.word) {
                            this.errors.push(error.response.data.errors.word[0]);
                        }
                    });
            },
            deleteWord(index)
            {
                let conf = confirm("Do you ready want to delete this word?");
                if (conf === true) {

                    axios.delete('/words/' + this.words[index].id)
                        .then(response => {

                            this.words.splice(index, 1);

                        })
                        .catch(error => {

                        });
                }
            }

        }
    }
</script>