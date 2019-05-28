<template>
    <div
        v-if="processing"
        :class="center ? 'mx-auto' : ''"
    >
        <a href="#">
            <img :width="size ? size : ''" src="/images/preloader.gif" />
        </a>
    </div>
</template>

<script>
    export default {
        name: "preloader",
        props: ['processing', 'size', 'center']
    }
</script>
