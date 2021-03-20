<template>
    <div class="col-lg-4">
        <b-button class="mb-4" type="submit" variant="outline-primary" @click="$router.go(-1)">Voltar</b-button>
        <b-form @submit="onSubmit" @reset="onReset" v-if="show">
            <b-form-group
                id="input-group-1"
                label="Descrição:"
                label-for="input-1"
                description="Insira uma descrição para a sua tarefa"
            >
                <b-form-input
                    id="input-1"
                    v-model="form.description"
                    type="text"
                    placeholder="Descrição"
                    required
                ></b-form-input>
            </b-form-group>

            <b-form-group id="input-group-2" label="Tipo de tarefa:" label-for="input-2">
                <b-form-select
                    id="input-2"
                    v-model="form.task_types_id"
                    :options="task_types"
                    text-field="name"
                    value-field="id"
                    required
                ></b-form-select>
                <router-link to="register-type">Cadastrar nova Categoria</router-link>
            </b-form-group>

            <b-form-group
                id="input-group-3"
                label="Data limite:"
                label-for="input-3"
            >
                <b-form-datepicker
                    id="input-3"
                    v-model="form.due"
                    :min="minDate"
                    :initial-date="minDate"
                    :hide-header="true"
                    class="mb-2"
                    placeholder="Selecione uma data"
                    required
                ></b-form-datepicker>
            </b-form-group>


            <b-button type="submit" variant="primary" :disabled="!form.due">Salvar</b-button>
            <b-button type="reset" variant="danger">Limpar</b-button>
        </b-form>
    </div>
</template>

<script>
export default {
    name: "TMTaskForm",
    data() {
        return {
            form: {
                description: '',
                task_types_id: '',
                due: '',
            },
            show: true,
            task_types: [],
        }
    },
    computed: {
        minDate: function () {
            let now = new Date()
            return now.getFullYear() + '-' + (now.getMonth() + 1) + '-' + now.getDate()
        }
    },
    methods: {
        onSubmit(event) {
            event.preventDefault()
            axios({
                method: this.$route.params.id ? 'PUT' : 'POST',
                url: '/tasks' + (this.$route.params.id ? '/' + this.$route.params.id : ''),
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
            // Reset our form values
            this.form.description = ''
            this.form.task_types_id = ''
            this.form.due = ''
            // Trick to reset/clear native browser form validation state
            this.show = false
            this.$nextTick(() => {
                this.show = true
            })
        }
    },
    async created() {
        this.task_types =
            await axios.get('/task-types')
                .then( function (response) {
                return response.data
            })
                .catch(function (error) {
                    console.log(error);
            });
        if (this.$route.params.id) {
            this.form = await axios.get('../tasks/' + this.$route.params.id)
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
