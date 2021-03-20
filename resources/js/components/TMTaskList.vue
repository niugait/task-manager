<template>
    <div class="col-md-8">
        <b-button class="mb-4" type="submit" variant="outline-primary" @click="$router.go(-1)">Voltar</b-button>
        <b-form-group
            id="input-group-1"
            label="Filtrar:"
            label-for="input-1"
        >
            <b-form-select
                id="input-1"
                v-model="filter"
                :options="task_types"
                text-field="name"
                value-field="id"
                required
                class="col-md-3"
            ></b-form-select>
            <b-button :disabled="!filter" @click="filter = ''">Limpar filtro</b-button>
            <b-button class="mb-4 float-right" type="submit" variant="primary" @click="$router.push({ name: 'register'})"><font-awesome-icon icon="plus"/> Criar Tarefa</b-button>
            <b-button class="mb-4 float-right" type="submit" variant="outline-primary" @click="$router.push({ name: 'task-type-list'})">Tipos de tarefas</b-button>
        </b-form-group>
        <b-table
            striped
            hover
            :fields="fields"
            :items="tasks"
            :filter="filter.toString()"
            :filter-included-fields="['task_types_id']"
            sort-by="due"
        >
            <template #cell(finish)="data">
                <b-button
                    :variant="data.item.finished_at ? 'success' : 'light'"
                    @click="finishTask(data.item.id)"
                ><font-awesome-icon icon="check"/>
                </b-button>
            </template>
            <template #cell(due)="data">
                {{ formatDate(data.item.readable_date) }}
            </template>
            <template #cell(task_types_id)="data">
                {{ formatTaskType(data.item.task_types_id) }}
            </template>
            <template #cell(edit)="data">
                <b-button variant="light" @click="$router.push({ name: 'edit-task', params: { id: data.item.id } })" :disabled="data.item.finished_at != null">Editar</b-button>
            </template>
            <template #cell(delete)="data">
                <b-button variant="danger" @click="deleteTask(data.item.id)" :disabled="data.item.finished_at != null">Excluir</b-button>
            </template>
        </b-table>
    </div>
</template>

<script>
export default {
    name: "TMTaskList",
    data() {
        return {
            filter: '',
            fields: [
                { key: 'finish', label: '' },
                { key: 'due', label: '' },
                { key: 'task_types_id', label: '' },
                { key: 'description', label: '' },
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
                    axios.delete('tasks/' + id)
                        .then(() => {
                            this.getTasks();
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                }
            });
        },
        async finishTask (id) {
            await axios.post('tasks/' + id + '/finish')
                .then(() => {
                    this.getTasks();
                })
                .catch(function (error) {
                    console.log(error);
                });
        },
        formatDate (date) {
            let formatted = new Date(date)
            return formatted.getDate() + "/" + (formatted.getMonth() + 1) + "/" + formatted.getFullYear();
        },
        formatTaskType(id) {
            if (this.task_types.length > 0) {
                return this.task_types.find(
                    element => element.id === id
                ).name
            }
            return ''
        },
        async getTasks() {
            this.tasks = await axios.get('tasks')
                .then( function (response) {
                    return response.data
                })
                .catch(function (error) {
                    console.log(error);
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
        await this.getTasks();
        await this.getTaskType();
    }
}
</script>

<style scoped>

</style>
