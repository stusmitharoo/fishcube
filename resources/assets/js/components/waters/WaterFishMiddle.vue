<template>
    <div>
        <h5 v-if="fish">
            <p class="words">
                {{ fish.name | capitalize }}
            </p>
        </h5>
    </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex'
import Vue2Filters from 'vue2-filters'

    export default {
        props: [
            'fish',
        ]
    }
</script>