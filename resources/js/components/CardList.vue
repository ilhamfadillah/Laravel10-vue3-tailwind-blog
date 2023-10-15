<template>
    <div>
        <div class="border-[1px] border-gray-300 hover:border-black transition delay-350 ease">
            <div class="p-[20px]">
                <h1 class="text-[30px] font-semibold">{{ title }}</h1>
                <div class="italic text-[12px]">
                    <p>Created at: {{ formatDate(created_at) }}</p>
                    <p>Created by: {{ author }}</p>
                    <p>Likes: {{ liked_count }}</p>
                </div>
                <div class="text-[16px] text-justify line-clamp-5 truncate" v-html="(content)"></div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: ['title', 'created_at', 'author', 'liked_count', 'content'],
    methods: {
        formatDate(createdAt) {
            const date = new Date(createdAt);
            return date.toLocaleDateString();
        }
    }
}

</script>