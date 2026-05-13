export function getMainBg() {
    const storageItem = localStorage.getItem('theme');
    console.log(storageItem);
    if (storageItem == 'ndi') {
        return '/media/lain.webp';
    } else {
        return '/media/bg.jpg';
    }
}

export function getPlaceholderBg() {
    const storageItem = localStorage.getItem('theme');
    console.log(storageItem);
    if (storageItem == 'ndi') {
        return '/media/miku.webp';
    } else {
        return '/media/bg.jpg';
    }
}

export function changeTheme(location: string) {
    console.log(location);
    const params = new URLSearchParams(location);
    console.log(params);
    console.log(params.get('ndi'));
    if (params.has('ndi') && params.get('ndi') == 'true') {
        localStorage.setItem('theme', 'ndi');
    } else if (params.has('ndi')) {
        localStorage.setItem('theme', 'normal');
    }
}
