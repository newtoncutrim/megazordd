<template>
    <section class="content-header">
        <h1>
            {{headers.title}}
            <small v-if="headers.subtitle">{{headers.subtitle}}</small>
        </h1>
        <ol class="breadcrumb">
            <li v-for="(bcrumb,index) in headers.breadcrumb" v-bind:class="{'active' : index == headers.breadcrumb.length - 1}">
                <a v-if="bcrumb.url" v-bind:href="bcrumb.url">
                    <i v-if="bcrumb.icon" v-bind:class="bcrumb.icon"></i> {{bcrumb.title}}
                </a>
                
                <span v-if="!bcrumb.url">
                    <i v-if="bcrumb.icon" v-bind:class="bcrumb.icon"></i> {{bcrumb.title}}
                </span>
            </li>
        </ol>

    </section>
</template>

<script>
    export default {
        props: ['headers']
    }
</script>
