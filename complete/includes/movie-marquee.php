<!-- First column -->
<div class="group flex overflow-hidden p-2 [--gap:1rem] [gap:var(--gap)] flex-col [--duration:20s]">
    <?php for ($i = 0; $i < 3; $i++): ?>
    <div class="flex shrink-0 justify-around [gap:var(--gap)] animate-marquee-vertical flex-col group-hover:[animation-play-state:paused]">
        <figure class="relative h-52 w-36 cursor-pointer overflow-hidden rounded-xl border p-4 border-gray-950/[.1] bg-gray-950/[.01] hover:bg-gray-950/[.05] dark:border-gray-50/[.1] dark:bg-gray-50/[.10] dark:hover:bg-gray-50/[.15]">
            <div class="flex flex-row items-center gap-2">
                <img loading="lazy" decoding="async" data-nimg="fill" class="object-cover w-full h-full" style="position:absolute;height:100%;width:100%;inset:0px;color:transparent" src="resources/image_2.webp" alt="Movie Poster">
            </div>
        </figure>
        <figure class="relative h-52 w-36 cursor-pointer overflow-hidden rounded-xl border p-4 border-gray-950/[.1] bg-gray-950/[.01] hover:bg-gray-950/[.05] dark:border-gray-50/[.1] dark:bg-gray-50/[.10] dark:hover:bg-gray-50/[.15]">
            <div class="flex flex-row items-center gap-2">
                <img loading="lazy" decoding="async" data-nimg="fill" class="object-cover w-full h-full" style="position:absolute;height:100%;width:100%;inset:0px;color:transparent" src="resources/image_7.webp" alt="Movie Poster">
            </div>
        </figure>
        <figure class="relative h-52 w-36 cursor-pointer overflow-hidden rounded-xl border p-4 border-gray-950/[.1] bg-gray-950/[.01] hover:bg-gray-950/[.05] dark:border-gray-50/[.1] dark:bg-gray-50/[.10] dark:hover:bg-gray-50/[.15]">
            <div class="flex flex-row items-center gap-2">
                <img loading="lazy" decoding="async" data-nimg="fill" class="object-cover w-full h-full" style="position:absolute;height:100%;width:100%;inset:0px;color:transparent" src="resources/image_3.webp" alt="Movie Poster">
            </div>
        </figure>
        <figure class="relative h-52 w-36 cursor-pointer overflow-hidden rounded-xl border p-4 border-gray-950/[.1] bg-gray-950/[.01] hover:bg-gray-950/[.05] dark:border-gray-50/[.1] dark:bg-gray-50/[.10] dark:hover:bg-gray-50/[.15]">
            <div class="flex flex-row items-center gap-2">
                <img loading="lazy" decoding="async" data-nimg="fill" class="object-cover w-full h-full" style="position:absolute;height:100%;width:100%;inset:0px;color:transparent" src="resources/image_4.webp" alt="Movie Poster">
            </div>
        </figure>
    </div>
    <?php endfor; ?>
</div>

<!-- Second column (reverse animation) -->
<div class="group flex overflow-hidden p-2 [--gap:1rem] [gap:var(--gap)] flex-col [--duration:20s]">
    <?php for ($i = 0; $i < 3; $i++): ?>
    <div class="flex shrink-0 justify-around [gap:var(--gap)] animate-marquee-vertical flex-col group-hover:[animation-play-state:paused] [animation-direction:reverse]">
        <figure class="relative h-52 w-36 cursor-pointer overflow-hidden rounded-xl border p-4 border-gray-950/[.1] bg-gray-950/[.01] hover:bg-gray-950/[.05] dark:border-gray-50/[.1] dark:bg-gray-50/[.10] dark:hover:bg-gray-50/[.15]">
            <div class="flex flex-row items-center gap-2">
                <img loading="lazy" decoding="async" data-nimg="fill" class="object-cover w-full h-full" style="position:absolute;height:100%;width:100%;inset:0px;color:transparent" src="resources/image_6.webp" alt="Movie Poster">
            </div>
        </figure>
        <figure class="relative h-52 w-36 cursor-pointer overflow-hidden rounded-xl border p-4 border-gray-950/[.1] bg-gray-950/[.01] hover:bg-gray-950/[.05] dark:border-gray-50/[.1] dark:bg-gray-50/[.10] dark:hover:bg-gray-50/[.15]">
            <div class="flex flex-row items-center gap-2">
                <img loading="lazy" decoding="async" data-nimg="fill" class="object-cover w-full h-full" style="position:absolute;height:100%;width:100%;inset:0px;color:transparent" src="resources/image_9.webp" alt="Movie Poster">
            </div>
        </figure>
        <figure class="relative h-52 w-36 cursor-pointer overflow-hidden rounded-xl border p-4 border-gray-950/[.1] bg-gray-950/[.01] hover:bg-gray-950/[.05] dark:border-gray-50/[.1] dark:bg-gray-50/[.10] dark:hover:bg-gray-50/[.15]">
            <div class="flex flex-row items-center gap-2">
                <img loading="lazy" decoding="async" data-nimg="fill" class="object-cover w-full h-full" style="position:absolute;height:100%;width:100%;inset:0px;color:transparent" src="resources/image_8.webp" alt="Movie Poster">
            </div>
        </figure>
        <figure class="relative h-52 w-36 cursor-pointer overflow-hidden rounded-xl border p-4 border-gray-950/[.1] bg-gray-950/[.01] hover:bg-gray-950/[.05] dark:border-gray-50/[.1] dark:bg-gray-50/[.10] dark:hover:bg-gray-50/[.15]">
            <div class="flex flex-row items-center gap-2">
                <img loading="lazy" decoding="async" data-nimg="fill" class="object-cover w-full h-full" style="position:absolute;height:100%;width:100%;inset:0px;color:transparent" src="resources/image_5.webp" alt="Movie Poster">
            </div>
        </figure>
    </div>
    <?php endfor; ?>
</div>

<!-- Third column (hidden on mobile) -->
<div class="group overflow-hidden p-2 [--gap:1rem] [gap:var(--gap)] flex-col [--duration:20s] hidden md:block">
    <?php for ($i = 0; $i < 3; $i++): ?>
    <div class="flex shrink-0 justify-around [gap:var(--gap)] animate-marquee-vertical flex-col group-hover:[animation-play-state:paused]">
        <figure class="relative h-52 w-36 cursor-pointer overflow-hidden rounded-xl border p-4 border-gray-950/[.1] bg-gray-950/[.01] hover:bg-gray-950/[.05] dark:border-gray-50/[.1] dark:bg-gray-50/[.10] dark:hover:bg-gray-50/[.15]">
            <div class="flex flex-row items-center gap-2">
                <img loading="lazy" decoding="async" data-nimg="fill" class="object-cover w-full h-full" style="position:absolute;height:100%;width:100%;inset:0px;color:transparent" src="resources/image_2.webp" alt="Movie Poster">
            </div>
        </figure>
        <figure class="relative h-52 w-36 cursor-pointer overflow-hidden rounded-xl border p-4 border-gray-950/[.1] bg-gray-950/[.01] hover:bg-gray-950/[.05] dark:border-gray-50/[.1] dark:bg-gray-50/[.10] dark:hover:bg-gray-50/[.15]">
            <div class="flex flex-row items-center gap-2">
                <img loading="lazy" decoding="async" data-nimg="fill" class="object-cover w-full h-full" style="position:absolute;height:100%;width:100%;inset:0px;color:transparent" src="resources/image_7.webp" alt="Movie Poster">
            </div>
        </figure>
        <figure class="relative h-52 w-36 cursor-pointer overflow-hidden rounded-xl border p-4 border-gray-950/[.1] bg-gray-950/[.01] hover:bg-gray-950/[.05] dark:border-gray-50/[.1] dark:bg-gray-50/[.10] dark:hover:bg-gray-50/[.15]">
            <div class="flex flex-row items-center gap-2">
                <img loading="lazy" decoding="async" data-nimg="fill" class="object-cover w-full h-full" style="position:absolute;height:100%;width:100%;inset:0px;color:transparent" src="resources/image_3.webp" alt="Movie Poster">
            </div>
        </figure>
        <figure class="relative h-52 w-36 cursor-pointer overflow-hidden rounded-xl border p-4 border-gray-950/[.1] bg-gray-950/[.01] hover:bg-gray-950/[.05] dark:border-gray-50/[.1] dark:bg-gray-50/[.10] dark:hover:bg-gray-50/[.15]">
            <div class="flex flex-row items-center gap-2">
                <img loading="lazy" decoding="async" data-nimg="fill" class="object-cover w-full h-full" style="position:absolute;height:100%;width:100%;inset:0px;color:transparent" src="resources/image_4.webp" alt="Movie Poster">
            </div>
        </figure>
    </div>
    <?php endfor; ?>
</div>
