<script lang="ts">
    import UserController from '@/actions/App/Http/Controllers/UserController';
    import AppHead from '@/components/AppHead.svelte';
    import PlaceholderPattern from '@/components/PlaceholderPattern.svelte';
    import Button from '@/components/ui/button/Button.svelte';
    import Checkbox from '@/components/ui/checkbox/Checkbox.svelte';
    import AppLayout from '@/layouts/AppLayout.svelte';
    import { dashboard } from '@/routes';
    import type { BreadcrumbItem } from '@/types';
    import { page } from '@inertiajs/svelte';

    const breadcrumbs: BreadcrumbItem[] = [
        {
            title: 'Dashboard',
            href: dashboard(),
        },
    ];
    let user = $derived($page.props.auth.user);
</script>

<AppHead title="Dashboard" />

<AppLayout {breadcrumbs}>
    <div
        class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4"
    >
        {#await fetch(`api/reservation/${user.user_id}/all`).then( (data) => data.json(), ) then y}
            {console.table(y)}
            {#each y as data}
                <div>
                    {#await fetch(`/api/room/${data.room_id}`).then( (r) => r.json(), )}
                        <p>Room name</p>
                    {:then room}
                        {console.table(room)}
                        <p>{room[0].name}</p>
                    {/await}
                    <p>{data.start_date}</p>
                    <p>{data.end_date}</p>
                    {#if data.receipt == null}
                        {#await fetch(`/api/room/${data.room_id}/services`).then( (ser) => ser.json(), ) then se}
                            <form
                                method="POST"
                                action={`/api/reservation/${data.reservation_id}/add`}
                                onsubmit={(event) => {
                                    event.preventDefault();
                                    fetch(event.target.action, {
                                        method: 'POST',
                                        body: new URLSearchParams(
                                            new FormData(event.target),
                                        ),
                                    }).then((resp) => {
                                        if (resp.ok) {
                                            alert(
                                                'Extra szolgáltatás(ok) sikeresen megrendelve!',
                                            );
                                            window.location.reload();
                                        } else {
                                            alert(
                                                'Extra szolgáltatás(ok) megrendelése sikertelen!',
                                            );
                                            window.location.reload();
                                        }
                                    });
                                }}
                            >
                                {#each se as s}
                                    {console.log(s)}
                                    <span>{s.name}</span>
                                    <input
                                        type="checkbox"
                                        name="extra[]"
                                        value={s.extra_service_id}
                                    />
                                {/each}
                                <Button type="submit">Order</Button>
                            </form>
                        {/await}
                    {:else}
                        <p>data.receipt</p>
                    {/if}
                </div>
            {/each}
        {/await}
    </div>
</AppLayout>
