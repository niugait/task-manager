<template>
    <div class="col-md-8">
        <b-button class="mb-4" type="submit" variant="outline-primary" @click="$router.go(-1)">Voltar</b-button>
        <b-button class="mb-4 float-right" type="submit" variant="primary" @click="$router.push({ name: 'register-task-type'})"><font-awesome-icon icon="plus"/> Criar tipo</b-button>
        <b-table
            striped
            hover
            :fields="fields"
            :items="task_types"
            sort-by="name"
        >
            <template #cell(edit)="data">
                <b-button class="float-right" variant="light" @click="$router.push({ name: 'edit-task-type', params: { id: data.item.id } })" :disabled="data.item.finished_at != null">Editar</b-button>
            </template>
            <template #cell(delete)="data">
                <b-button class="float-right" variant="danger" @click="deleteTask(data.item.id)" :disabled="data.item.finished_at != null">Excluir</b-button>
            </template>
        </b-table>
    </div>
</template>

<script>
export default {
    name: "TMTaskTypeList",
    data() {
        return {
            filter: '',
            fields: [
                { key: 'name', label: '' },
                { key: 'edit', label: '' },
                { key: 'delete', label: '' },
            ],
            row_selected: false,
            tasks: [],
            task_types: [],
        }
    },
    methods: {
        deleteTask(id) {
            this.$swal({
                title: 'Exclusão de tarefa',
                text: 'Deseja realmente excluir essa tarefa?',
                icon: 'error',
                confirmButtonText: 'Excluir',
                showCancelButton: true,
                cancelButtonText: 'Voltar',
                confirmButtonColor: '#EA3E3E'
            }).then(result => {
                if (result.isConfirmed) {
                    axios.delete('task-types/' + id)
                        .then(() => {
                            this.getTaskType();
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                }
            });
        },
        async getTaskType() {
            this.task_types = await axios.get('task-types')
                .then( function (response) {
                    return response.data
                })
                .catch(function (error) {
                    console.log(error);
                });
        }
    },
    async created() {
        await this.getTaskType();
    }
}
</script>

<style scoped>

</style>
