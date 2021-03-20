<template>
    <div class="initial-menu col-lg-6">
        <b-card-group deck>
            <b-card no-body header="Gerenciador de Tarefas" class="card-wrapper">
                <b-row no-gutters>
                    <b-col md="6" class="d-flex">
                        <b-card-img
                            src="images/logo-pulses.svg"
                            alt="Pulses"
                            class="rounded-0 w-50 align-self-center ml-auto mr-auto"
                        ></b-card-img>
                    </b-col>
                    <b-col md="6">
                        <b-card-body>
                            <b-card-title>
                                Bem vindo ao seu gerenciador de tarefas pessoal.
                            </b-card-title>
                            <b-card-sub-title sub-title="Selecione uma opção para prosseguir">
                            </b-card-sub-title>
                        </b-card-body>

                        <b-list-group flush class="mb-4">
                            <b-list-group-item>
                                <router-link to="tasks-list">Listar tarefas</router-link>
                            </b-list-group-item>
                            <b-list-group-item>
                                <router-link to="register">Cadastrar tarefas</router-link>
                            </b-list-group-item>
                        </b-list-group>
                    </b-col>
                </b-row>
            </b-card>
        </b-card-group>
    </div>
</template>

<script>
export default {
    name: "TMInitialMenu"
}
</script>

<style lang="scss" scoped>

</style>
