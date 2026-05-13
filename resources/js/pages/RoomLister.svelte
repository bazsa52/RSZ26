<script lang="ts">
    import Label from '@/components/ui/label/Label.svelte';
    import Input from '@/components/ui/input/Input.svelte';
    import Button from '@/components/ui/button/Button.svelte';
    import {
        Card,
        CardContent,
        CardAction,
        CardDescription,
        CardFooter,
        CardHeader,
        CardTitle,
    } from '@/components/ui/card/index';
    import { dashboard } from '@/routes';
    import type { BreadcrumbItem } from '@/types';
    import { UserRound } from 'lucide-svelte';
    import SearchBar from '@/components/SearchBar.svelte';
    import { changeTheme, getPlaceholderBg } from '@/actions/theme.ts';

    const breadcrumbs: BreadcrumbItem[] = [
        {
            title: 'Dashboard',
            href: dashboard(),
        },
    ];

    let search = new URLSearchParams(window.location.search);
    let from = search.get('f') == null ? '0000.00.01' : search.get('f')!;
    let to = search.get('t') == null ? '0000.00.02' : search.get('t')!;
    let count = search.get('c') == null ? 0 : +search.get('c')!;
    changeTheme(window.location.search);
    let tmpbg = getPlaceholderBg();

    let selected = undefined;

    function parseDate(dateStr): Date {
        const [year, month, day] = dateStr.split('-').map(Number);
        return new Date(year, month - 1, day);
    }

    function daysBetween(d1Str, d2Str) {
        const msPerDay = 1000 * 60 * 60 * 24;

        const d1 = parseDate(d1Str);
        const d2 = parseDate(d2Str);

        let delta = Math.abs(Math.round((d2 - d1) / msPerDay));

        return delta == 0 ? 1 : delta;
    }

    async function getRooms() {
        let data = JSON.stringify({
            from: from,
            to: to,
            capacity: count,
        });
        return await fetch('api/room/available', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                Accept: 'application/json',
            },
            body: data,
        }).then((data) => data.json());
    }
</script>

<main>
    <SearchBar />

    <div
        id="rooms"
        class=" mt-8 mx-20 grid gap-y-10 gap-x-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-4"
    >
        {#await getRooms() then y}
            {#each y as data}
                <Card class="-my-4 w-fit max-w-sm">
                    <CardContent>
                        <div class="flex flex-col gap-6">
                            <img
                                src={data.pictures[0].image_path}
                                onerror={() => {
                                    this.src = tmpbg;
                                }}
                                alt="room"
                            />
                        </div>
                    </CardContent>
                    <CardFooter class="flex-col gap-2">
                        <div class="flex flex-row">
                            <div class="flex flex-col">
                                <div>{data.name}</div>
                                <div>{data.description}</div>
                            </div>
                            <div class="flex flex-col">
                                <div class="text-end">
                                    {data.price_per_night *
                                        daysBetween(from, to)} Ft
                                </div>
                                <div class="row-span-2 text-end mt-2">
                                    <Button
                                        onclick={() => {
                                            window.location.replace(
                                                `../details?f=${from}&t=${to}&i=${data.room_id}&c=${count}`,
                                            );
                                        }}>Megtekintés</Button
                                    >
                                </div>
                            </div>
                        </div>
                    </CardFooter>
                </Card>
            {/each}
        {/await}
    </div>
</main>
