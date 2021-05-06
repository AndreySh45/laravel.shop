<template>
    <div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container" >
                <div class="navbar-nav">
                    <router-link class="nav-item nav-link" :to="{name: 'home'}">Главная</router-link>
                    <router-link class="nav-item nav-link" :to="{name: 'desks'}">Доски</router-link>
                </div>
            </div>
        </nav>
        <div>
            <router-view></router-view>
        </div>
    </div>
</template>
<script>
export default {

}
</script>
