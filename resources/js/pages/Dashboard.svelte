<script lang="ts">
    import UserController from '@/actions/App/Http/Controllers/UserController';
    import AppHead from '@/components/AppHead.svelte';
    import PlaceholderPattern from '@/components/PlaceholderPattern.svelte';
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
    let user = $derived($page.props.auth.user)
    let loadAs: "User"|"Admin"|"Receptionist" = "User"
    fetch(UserController.roles.get(user.user_id as string).url).then(data=>data.json()).then(x=>{
        loadAs = x
        switch(loadAs){
            case 'User':{
                window.location.replace("../settings")
                break; 
            }
        }
    })

    async function getRole(): Promise<string> {
        let f = fetch(UserController.roles.get(user.user_id as string).url).then(data=>data.json())
        return f
    }

    async function getUsers(){
        return await fetch("/api/user/all")
        .then(data=>data.json())
        
    }

</script>

<AppHead title="Dashboard" />

<AppLayout {breadcrumbs}>
    <div
        class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4"
    >
    {#await getRole()}{:then dart}
        {#if dart == "Admin"}
            <div class="grid auto-rows-min gap-4 md:grid-cols-3">
                <div
                    class="relative aspect-video overflow-hidden overflow-y-scroll rounded-xl border border-sidebar-border/70 dark:border-sidebar-border"
                >
                    {#await getUsers()}
                
                    {:then users} 
                        {#each users as user}
                            <div class="outline p-2 flex flex-row">
                        <span class="flex-1">{user.email}</span>
                        <span>delete</span>
                    </div>
                        {/each}
                    {/await}
                    
                </div>
                <div
                    class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border"
                >
                    <div class="outline p-2 flex flex-row">
                        <span class="flex-1">TestRoom</span>
                        <span class="me-2">edit</span>
                        <span>delete</span>
                    </div>
                </div>
                <div
                    class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border"
                >
                    <PlaceholderPattern />
                </div>
            </div>
            <div
                class="relative min-h-screen flex-1 rounded-xl border border-sidebar-border/70 md:min-h-min dark:border-sidebar-border"
            >
                <PlaceholderPattern />
            </div>
        {/if}
        {#if dart == "Receptionist"}
            <div class="grid h-full gap-4 md:grid-cols-2">
                <div
                    class="relative overflow-hidden overflow-y-scroll rounded-xl border border-sidebar-border/70 dark:border-sidebar-border"
                >
                    <div class="outline p-2 flex flex-row">
                        <span class="flex-1">TestUser12</span>
                        <span class="me-2">check-in</span>
                        <span>check-out</span>
                    </div>
                    
                </div>
                <div
                    class="relative overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border"
                >
                    <div class="outline p-2 flex flex-row">
                        <span class="flex-1">TestRoom</span>
                        <span>fault</span>
                    </div>
                </div>
            </div>
        {/if}
    {/await}
    </div>
</AppLayout>
