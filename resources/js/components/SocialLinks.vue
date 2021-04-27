<template>
    <div class="social-links">
        <a
            class="social-links__link"
            v-for="link in links"
            :href="link.url"
        >
            <div class="social-links__ico">
                <img :src="link.img" alt="">
            </div>
            <div class="social-links__name">
                {{ link.name }}
            </div>
        </a>
    </div>
</template>

<script>
export default {
    name: "SocialLinks",
    data : () => ({
        links :
        [
            {
                'name' : 'facebook',
                'url' : 'https://www.facebook.com',
                'img' : '/img/facebook.png'
            },
            {
                'name' : 'instagram',
                'url' : 'https://www.instagram.com',
                'img' : '/img/insta.png'
            },
            {
                'name' : 'telegram channel',
                'url' : 'https://t.me/myshoptelegram',
                'img' : '/img/telegram.png'
            },
        ]
    }),
    methods : {

    }
}
</script>

<style scoped>
.social-links{
    padding: 20px;
    display: flex;
    justify-content: center;
    align-items: center;
}
.social-links__link{
    margin: 15px;
    display: block;
    transition:all 0.2s;

}
.social-links__name{
    text-align: center;
}
.social-links__ico{
    width: 60px;
    margin:0 auto;
}
.social-links__link:hover{
    transform: scale(1.1);
}
.social-links__ico>img{
    display: block;
    width: 100%;
}
</style>
