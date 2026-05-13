<script lang="ts">
    import { UserRound } from "lucide-svelte";
    import Button from "./ui/button/Button.svelte";
    import Input from "./ui/input/Input.svelte";
    import Label from "./ui/label/Label.svelte";

    onload = ()=>{
        let search = new URLSearchParams(window.location.search);
        let from = search.get('f');
        let to = search.get('t');
        let count = parseInt(search.get('c') == null ? "0" : search.get('c')!);
        
        let t = (document.getElementById('to') as HTMLInputElement)
        let f = (document.getElementById('from') as HTMLInputElement)
        let c = (document.getElementById('no') as HTMLInputElement)

        f.value = to == null ? "" : from;
        t.value = from == null ? "" : to;
        c.value = count == null ? "" : count;

        let btn = document.getElementById('search') as HTMLButtonElement
        btn.addEventListener('click', ()=>{
            window.location.replace(`/search?t=${t.value}&f=${f.value}&c=${c.value}`)
        })

        let profile = document.getElementById('profile') as HTMLButtonElement
        profile.addEventListener('click', ()=>{
            window.location.replace("../settings")
        })
    }
</script>

<div id="top-bar" class="w-full mx-auto flex flex-col md:flex-row items-center justify-center sticky top-0 p-2 rounded-b-md bg-gray-300 dark:bg-gray-600 backdrop-blur-2xl z-80">
        <div class="flex flex-2 flex-col md:flex-row items-center">
            <div class="mr-4 flex flex-row flex-1 items-center">
                <Label class="tb" for="from">Mettől: </Label>
                <Input type="date" name="" id="from" />
            </div>
            <div class="mr-4 flex flex-row flex-1 items-center">
                <Label for="to">Meddig:</Label>
                <Input type="date" name="" id="to" />
            </div>
            <div class="mr-4 flex flex-row flex-1 items-center">
                <Label for="no">Személyek száma: </Label>
                <Input type="number" name="" id="no" min="0" max="10" value="0" />
            </div>
            <div>
                <Button id="search">Keresés</Button>
            </div>
        </div>
        <div class="flex flex-1"></div>
        <div class="flex flex-row">
            <Button id="profile">
                <UserRound />
                Profil
            </Button>
        </div>
    </div>