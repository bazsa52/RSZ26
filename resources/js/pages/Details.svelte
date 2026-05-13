<script lang="ts">
    import Button from '@/components/ui/button/Button.svelte';
    import Input from '@/components/ui/input/Input.svelte';
    import Label from '@/components/ui/label/Label.svelte';
    import { page } from '@inertiajs/svelte';

    let search = new URLSearchParams(window.location.search);
    let f = search.get('f');
    let t = search.get('t');
    let c = search.get('c');
    let roomId = search.get('i');
    let user = $derived($page.props.auth.user);
    console.table(user);
</script>

<main>
    <div class="m-auto h-fit w-fit outline rounded-md">
        {#await fetch(`/api/room/${roomId}`).then((data) => data.json()) then y}
            {console.table(y)}
            <img
                class="max-h-96"
                src={y[0].pictures[0].image_path}
                onerror={() => {
                    this.src = '/media/miku.webp';
                }}
                alt="room"
            />
            <p>{y[0].name}</p>
            <p>{y[0].description}</p>
            <p>{y[0].price_per_night}</p>
            <Label for="comment">Megjegyzés:</Label>
            <Input id="comment" type="text" palceholder="comment" />
            <Button
                variant="secondary"
                onclick={() => {
                    window.location.replace(`../search?c=${c}&f=${f}&t=${t}`);
                }}>Vissza</Button
            >
            <Button
                onclick={() => {
                    let data = {
                        room_id: roomId,
                        user_id: user.user_id,
                        start_date: f,
                        end_date: t,
                        comment: (
                            document.getElementById(
                                'comment',
                            ) as HTMLInputElement
                        ).value,
                        extra_services: [],
                    };
                    fetch('/api/reservation/create', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            Accept: 'application/json',
                        },
                        body: JSON.stringify(data),
                    }).then((data) => {
                        if (data.status == 201) {
                            alert('Sikeres foglalás');
                            window.location.replace('../bookings');
                        } else {
                            alert('Sikertelen foglalás');
                            window.location.replace('../');
                        }
                    });
                }}>Foglalás</Button
            >
        {/await}
    </div>
</main>
