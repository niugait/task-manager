<template>
    <div class="col-lg-4">
        <b-button class="mb-4" type="submit" variant="outline-primary" @click="$router.go(-1)">Voltar</b-button>
        <b-form @submit="onSubmit" @reset="onReset" v-if="show">
            <b-form-group
                id="input-group-1"
                label="Nome do tipo de tarefa:"
                label-for="input-1"
            >
                <b-form-input
                    id="input-1"
                    v-model="form.name"
                    type="text"
                    required
                ></b-form-input>
            </b-form-group>

            <b-button type="submit" variant="primary">Salvar</b-button>
        </b-form>
    </div>
</template>

<script>
export default {
    name: "TMTaskTypeForm",
    data() {
        return {
            form: {
                name: '',
            },
            show: true
        }
    },
    methods: {
        onSubmit(event) {
            event.preventDefault()
            axios({
                method: this.$route.params.id ? 'PUT' : 'POST',
                url: '/task-types' + (this.$route.params.id ? '/' + this.$route.params.id : ''),
                data: this.form
            })
                .then(() => {
                    this.$router.go(-1)
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
        onReset(event) {
            event.preventDefault()
            this.form.name = ''
            // Trick to reset/clear native browser form validation state
            this.show = false
            this.$nextTick(() => {
                this.show = true
            })
        }
    },
    async created() {
        if (this.$route.params.id) {
            this.form = await axios.get('../task-types/' + this.$route.params.id)
                .then( function (response) {
                    return response.data
                })
                .catch(function (error) {
                    console.log(error);
                });
        }
    }
}
</script>
<style scoped>

</style>
