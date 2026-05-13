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
</script>

<AppHead title="Dashboard" />

<AppLayout {breadcrumbs}>
    
</AppLayout>
