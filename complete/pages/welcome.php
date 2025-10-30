<div data-overlay-container="true">
    <div class="flex flex-col items-center justify-center w-full">
        <div class="relative flex z-0 flex-col items-center justify-center w-full overflow-hidden rounded-lg bg-background md:shadow-xl">
            <div class="flex flex-col gap-4 mt-20 lg:flex-row">
                <div class="flex flex-col items-center justify-center gap-2 text-center lg:text-left lg:items-start">
                    <h1 class="text-6xl font-semibold text-transparent bg-gradient-to-br from-white to-gray-500 bg-clip-text">MEGAEMBED</h1>
                    <h2 class="text-4xl md:text-6xl min-h-[5rem] max-w-[25rem] md:max-w-[35rem] h-full md:w-[50rem] md:h-32 text-center lg:text-left bg-gradient-to-br from-white to-indigo-400 bg-clip-text text-transparent">Biggest and Fastest Streaming API</h2>
                    <div class="flex flex-col items-center gap-2 lg:gap-4 lg:flex-row">
                        <button class="relative light-sweep px-6 py-2 font-medium backdrop-blur-xl transition-[box-shadow] duration-300 ease-in-out hover:shadow dark:bg-[radial-gradient(circle_at_50%_0%,hsl(var(--primary)/10%)_0%,transparent_60%)] dark:hover:shadow-[0_0_20px_hsl(var(--primary)/10%)] rounded-full bg-white/5" tabindex="0" style="--x:-97.93492%;will-change:auto;transform:none">
                            <span class="relative items-center h-full w-full text-sm uppercase flex gap-2 tracking-wide text-[rgb(0,0,0,65%)] dark:font-light dark:text-[rgb(255,255,255,90%)]" style="mask-image:linear-gradient(-75deg,hsl(var(--primary)) calc(var(--x) + 20%),transparent calc(var(--x) + 30%),hsl(var(--primary)) calc(var(--x) + 100%))">Get Started &gt;</span>
                            <span style="mask:linear-gradient(rgb(0,0,0),rgb(0,0,0)) content-box,linear-gradient(rgb(0,0,0),rgb(0,0,0));mask-composite:exclude" class="absolute inset-0 z-10 block rounded-[inherit] bg-[linear-gradient(-75deg,hsl(var(--primary)/10%)_calc(var(--x)+20%),hsl(var(--primary)/50%)_calc(var(--x)+25%),hsl(var(--primary)/10%)_calc(var(--x)+100%))] p-px"></span>
                        </button>
                        <span class="text-xs text-white/80">or</span>
                        <button radius="full" variant="shadow" class="text-sm underline capitalize transition-all text-white/80 hover:text-white hover:scale-105 active:scale-95">Test the Player</button>
                    </div>
                    <div class="flex gap-4 mt-2 cursor-pointer">
                        <div class="p-4 gap-2 transition-all hover:-translate-y-1 rounded-xl bg-white/5 border border-white/10 hover:border-white/20 hover:bg-white/[0.07] flex flex-col items-center">
                            <span class="text-2xl font-bold text-gray-300">
                                <span class="inline-block tabular-nums text-black dark:text-gray-300 tracking-wider">100</span>K+
                            </span>
                            <span class="text-xs text-gray-400">Movies</span>
                        </div>
                        <div class="p-4 gap-2 transition-all hover:-translate-y-1 rounded-xl bg-white/5 border border-white/10 hover:border-white/20 hover:bg-white/[0.07] flex flex-col items-center">
                            <span class="text-2xl font-bold text-gray-300">
                                <span class="inline-block tabular-nums text-black dark:text-gray-300 tracking-wider">70</span>K+
                            </span>
                            <span class="text-xs text-gray-400">Shows</span>
                        </div>
                        <div class="p-4 gap-2 transition-all hover:-translate-y-1 rounded-xl bg-white/5 border border-white/10 hover:border-white/20 hover:bg-white/[0.07] flex flex-col items-center">
                            <span class="text-2xl font-bold text-gray-300">
                                <span class="inline-block tabular-nums text-black dark:text-gray-300 tracking-wider">5</span>K+
                            </span>
                            <span class="text-xs text-gray-400">Anime</span>
                        </div>
                    </div>
                    <span class="text-xs text-white/30">These numbers are an estimate from the 13+ sources we have</span>
                </div>
                <div class="relative flex h-[500px] md:h-screen w-full flex-row items-center justify-center overflow-hidden rounded-lg bg-background md:shadow-xl z-10">
                    <?php include 'includes/movie-marquee.php'; ?>
                    <div class="absolute inset-x-0 top-0 pointer-events-none h-1/3 bg-gradient-to-b from-white dark:from-background"></div>
                    <div class="absolute inset-x-0 bottom-0 pointer-events-none h-1/3 bg-gradient-to-t from-white dark:from-background"></div>
                </div>
            </div>
            <svg aria-hidden="true" class="pointer-events-none absolute inset-0 h-full w-full fill-neutral-400/80 [mask-image:radial-gradient(500px_circle_at_center,white,transparent)]">
                <defs>
                    <pattern id=":R157pja:" width="20" height="20" patternUnits="userSpaceOnUse" patternContentUnits="userSpaceOnUse" x="0" y="0">
                        <circle id="pattern-circle" cx="1" cy="1" r="1"></circle>
                    </pattern>
                </defs>
                <rect width="100%" height="100%" stroke-width="0" fill="url(#:R157pja:)"></rect>
            </svg>
        </div>
        <div class="w-full bg-black py-12 px-4 flex justify-center"></div>
        <div class="flex flex-col gap-4 my-10" style="width: 95%; max-width: 1100px; margin: 0 auto;">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-2.5">
                <?php include 'includes/feature-cards.php'; ?>
            </div>
        </div>
    </div>
</div>
