<template>
    <span>
       <div v-for="(item, index) in items" :key="index" class="checkbox">
            <label :for="label + '_' + index">
                <input type="checkbox" :name="name + '[]'" :value="item.value" :id="'cb_' + index" :checked="item.checked || false">
                {{item.label}}
            </label>
        </div>
    </span>
</template>

<script>
    export default {
        props: ['items', 'name', 'label']
    }
</script>
