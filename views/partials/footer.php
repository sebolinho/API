<?php
// Load config for social links
require_once __DIR__ . '/../../admin/Config.php';
$config = Config::load();
$telegram_url = $config['social']['telegram_url'] ?? 'https://t.me/+vidlinkpro';
$telegram_button_text = $config['social']['telegram_button_text'] ?? 'Entre No Telegram';
?>
<div class="fixed flex items-center justify-center w-full gap-2 bottom-4">
    <a href="<?= htmlspecialchars($telegram_url) ?>" target="_blank" rel="noreferrer" class="relative light-sweep px-6 py-2 font-medium backdrop-blur-xl transition-[box-shadow] duration-300 ease-in-out hover:shadow dark:bg-[radial-gradient(circle_at_50%_0%,hsl(var(--primary)/10%)_0%,transparent_60%)] dark:hover:shadow-[0_0_20px_hsl(var(--primary)/10%)] rounded-full bg-blue-600/50 cursor-pointer" tabindex="0" style="--x:-100%;will-change:auto;transform:none;display:inline-block;">
        <span class="relative items-center h-full w-full text-sm uppercase flex gap-2 tracking-wide text-[rgb(0,0,0,65%)] dark:font-light dark:text-[rgb(255,255,255,90%)]" style="mask-image:linear-gradient(-75deg,hsl(var(--primary)) calc(var(--x) + 20%),transparent calc(var(--x) + 30%),hsl(var(--primary)) calc(var(--x) + 100%))">
            <img src="complete/resources/image_12.webp" width="25" height="25" alt="telegram icon">
        </span>
        <span style="mask:linear-gradient(rgb(0,0,0),rgb(0,0,0)) content-box,linear-gradient(rgb(0,0,0),rgb(0,0,0));mask-composite:exclude" class="absolute inset-0 z-10 block rounded-[inherit] bg-[linear-gradient(-75deg,hsl(var(--primary)/10%)_calc(var(--x)+20%),hsl(var(--primary)/50%)_calc(var(--x)+25%),hsl(var(--primary)/10%)_calc(var(--x)+100%))] p-px"></span>
    </a>
    <a href="<?= htmlspecialchars($telegram_url) ?>" target="_blank" rel="noreferrer" class="relative light-sweep px-6 py-2 font-medium backdrop-blur-xl transition-[box-shadow] duration-300 ease-in-out hover:shadow dark:bg-[radial-gradient(circle_at_50%_0%,hsl(var(--primary)/10%)_0%,transparent_60%)] dark:hover:shadow-[0_0_20px_hsl(var(--primary)/10%)] rounded-full bg-indigo-600/20 cursor-pointer" tabindex="0" style="--x:-100%;will-change:auto;transform:none;display:inline-block;">
        <span class="relative items-center h-full w-full text-sm uppercase flex gap-2 tracking-wide text-[rgb(0,0,0,65%)] dark:font-light dark:text-[rgb(255,255,255,90%)]" style="mask-image:linear-gradient(-75deg,hsl(var(--primary)) calc(var(--x) + 20%),transparent calc(var(--x) + 30%),hsl(var(--primary)) calc(var(--x) + 100%))">
            <?= htmlspecialchars($telegram_button_text) ?> 
            <img src="complete/resources/image_11.png" width="25" height="25" alt="telegram icon">
        </span>
        <span style="mask:linear-gradient(rgb(0,0,0),rgb(0,0,0)) content-box,linear-gradient(rgb(0,0,0),rgb(0,0,0));mask-composite:exclude" class="absolute inset-0 z-10 block rounded-[inherit] bg-[linear-gradient(-75deg,hsl(var(--primary)/10%)_calc(var(--x)+20%),hsl(var(--primary)/50%)_calc(var(--x)+25%),hsl(var(--primary)/10%)_calc(var(--x)+100%))] p-px"></span>
    </a>
</div>
<div class="w-full p-4 pb-20 text-center">
    <hr class="shrink-0 bg-divider border-none w-full h-divider my-4" role="separator">
    <span class="text-sm text-white/80"><?= htmlspecialchars($config['site']['copyright'] ?? '© 2024 VidLink. All rights reserved') ?></span>
</div>

<script>
// Light sweep animation effect for footer buttons
document.addEventListener('DOMContentLoaded', function() {
    const buttons = document.querySelectorAll('.light-sweep');
    
    buttons.forEach(button => {
        button.addEventListener('mousemove', function(e) {
            const rect = button.getBoundingClientRect();
            const x = ((e.clientX - rect.left) / rect.width) * 100;
            button.style.setProperty('--x', `${x}%`);
        });
        
        button.addEventListener('mouseleave', function() {
            button.style.setProperty('--x', '-100%');
        });
    });
});
</script>
