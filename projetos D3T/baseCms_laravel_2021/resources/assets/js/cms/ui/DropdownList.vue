<template>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <slot name="toggle"></slot>
        </a>
        <ul class="dropdown-menu">
            <li
                v-for="item in items"
                :role="{separator : item.role == 'separator'}"
                :class="{divider : item.role == 'separator'}"
                >

                <a :href="item.url" v-if="item.role != 'separator'">
                    <i :class="item.icon"></i> {{item.text}}
                </a>
            </li>
        </ul>
    </li>
</template>

<script>
    export default {
        props: ['items']
    }
</script>
