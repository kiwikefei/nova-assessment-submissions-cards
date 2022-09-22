<template>
    <Card>
        <div class="flex items-center justify-between px-8">
            <div v-for="(data) in card.counts" class="text-center px-2 py-3">
                <a :href="lensUrl(data.urikey)" class="no-underline text-90 font-semibold">{{ data.title }} ({{ data.count }})</a>
            </div>
        </div>
    </Card>
</template>

<script>
export default {
    props: [
        'card',
    ],

    mounted() {
    },

    methods: {
        lensUrl: function (urikey) {
            const baseUrl = '/nova/resources/assessment-submissions';

            if (urikey === 'all') {
                return baseUrl;
            }

            return baseUrl + '/lens/' + urikey;
        }
    }
}
</script>
