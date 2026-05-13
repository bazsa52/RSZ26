<script lang="ts">
    import SearchBar from '@/components/SearchBar.svelte';
    import { changeTheme, getMainBg } from '@/actions/theme.ts';

    changeTheme(window.location.search);
    var bg = getMainBg();
</script>

<main id="main" class="w-full" style="background-image: url({bg})">
    <SearchBar />
    <h1 class="text-5xl z-10 backdrop-blur-2xl p-4">
        Lorem ipsum dolor sit amet.
    </h1>
    <!--<img src="/media/bg.jpg" alt="background" loading="lazy" class="fixed top-0 -z-10" />-->
</main>

<style>
    main {
        background-position: center;
        background-size: cover;
        height: 100vh;
    }
    h1 {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: rgba(74, 85, 101, 0.2);
    }
</style>
