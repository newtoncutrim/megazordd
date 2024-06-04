<template>
    <span>
       <div v-for="(item, index) in items" class="radio">
            <label :for="name + '_' + index">
                <input type="radio" :name="name + '[]'" :value="item.value" :id="name + '_' + index" :checked="item.checked || false">
                {{item.label}}
            </label>
        </div>
    </span>
</template>

<script>
    export default {
        props: ['items', 'name']
    }
</script>
