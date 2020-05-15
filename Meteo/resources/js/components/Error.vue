<template>
    <div class="pt-3 sph-error">
        <div class="alert alert-dismissible alert-warning sph-warning">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <h4 class="alert-heading">Oupss! Belle erreur {{ excepts['code'] }}</h4>
            <p class="mb-0">{{ excepts['message'] }}</p>
            <a href="./" class="alert-link">Revenir à la page d'accueil</a>
        </div>
    </div>
</template>

<script>
export default {
    name : "Error",
    props : ['excepts']
}
</script>

<style scoped>
    .sph-error{
        font-weight : bold !important;
    }
</style>