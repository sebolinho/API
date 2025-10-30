<div class="w-full max-w-[70rem] mx-auto transition-all duration-200 p-4 bg-transparent border border-transparent rounded-xl justify-between items-center" style="margin-top: 100px;">
    <div class="flex flex-col items-center justify-center w-full">
        <div class="flex max-w-[70rem] flex-col items-center w-full h-full min-h-screen gap-2 p-4">
            <main class="flex max-w-[70rem] flex-col items-center w-full h-full min-h-screen gap-2 p-4">
                <div class="flex flex-col items-center gap-4 w-full">
                    <h1 class="text-4xl font-bold text-center bg-gradient-to-br from-white to-gray-500 bg-clip-text text-transparent">API Documentation</h1>
                    <p class="text-center text-white/80 max-w-2xl">Complete guide to using the VidLink API for embedding movies, TV shows, and anime.</p>
                </div>

                <div class="grid grid-cols-1 gap-4 mt-8 w-full max-w-5xl">
                    <!-- Embed Movie -->
                    <div class="p-6 gap-2 transition-all hover:-translate-y-1 rounded-xl bg-white/5 border border-white/10 hover:border-white/20 hover:bg-white/[0.07] flex flex-col w-full">
                        <p class="flex items-center gap-2 text-xl font-semibold">Embed Movie</p>
                        <span class="text-xs text-white/80">TMDb id is required from TMDb API, id should not be empty.</span>
                        <div class="inline-flex items-center justify-between h-fit gap-2 px-3 py-1.5 text-small rounded-medium bg-default/40 text-default-foreground max-w-full">
                            <pre class="bg-transparent font-mono font-normal inline-block whitespace-nowrap text-xs text-wrap max-w-full line-clamp-1">https://vidlink.pro/movie/{tmdb_id}</pre>
                        </div>
                        <div class="flex flex-col mt-4">
                            <span class="text-xs">Code Example:</span>
                            <div class="inline-flex items-center justify-between h-fit gap-2 px-3 py-1.5 text-small rounded-medium bg-primary/20 text-primary">
                                <pre class="bg-transparent font-mono font-normal inline-block whitespace-nowrap text-xs text-wrap">&lt;iframe src="https://vidlink.pro/movie/786892" frameborder="0" allowfullscreen&gt;&lt;/iframe&gt;</pre>
                            </div>
                        </div>
                    </div>

                    <!-- Embed TV Show -->
                    <div class="p-6 gap-2 transition-all hover:-translate-y-1 rounded-xl bg-white/5 border border-white/10 hover:border-white/20 hover:bg-white/[0.07] flex flex-col w-full">
                        <p class="flex items-center gap-2 text-xl font-semibold">Embed TV Show</p>
                        <span class="text-xs text-white/80">TMDb id is required from TMDb API. Season and episode numbers are required.</span>
                        <div class="inline-flex items-center justify-between h-fit gap-2 px-3 py-1.5 text-small rounded-medium bg-default/40 text-default-foreground max-w-full">
                            <pre class="bg-transparent font-mono font-normal inline-block whitespace-nowrap text-xs text-wrap max-w-full line-clamp-1">https://vidlink.pro/tv/{tmdb_id}/{season}/{episode}</pre>
                        </div>
                        <div class="flex flex-col mt-4">
                            <span class="text-xs">Code Example:</span>
                            <div class="inline-flex items-center justify-between h-fit gap-2 px-3 py-1.5 text-small rounded-medium bg-primary/20 text-primary">
                                <pre class="bg-transparent font-mono font-normal inline-block whitespace-nowrap text-xs text-wrap">&lt;iframe src="https://vidlink.pro/tv/94997/1/1" frameborder="0" allowfullscreen&gt;&lt;/iframe&gt;</pre>
                            </div>
                        </div>
                    </div>

                    <!-- Embed Anime -->
                    <div class="p-6 gap-2 transition-all hover:-translate-y-1 rounded-xl bg-white/5 border border-white/10 hover:border-white/20 hover:bg-white/[0.07] flex flex-col w-full">
                        <p class="flex items-center gap-2 text-xl font-semibold">
                            Embed Anime 
                            <span class="px-2 py-0.5 text-xs text-black bg-green-500 rounded-md">New</span>
                        </p>
                        <span class="text-xs text-white/80">MyAnimeList id is required. Episode number and type (sub/dub) should not be empty.</span>
                        <div class="inline-flex items-center justify-between h-fit gap-2 px-3 py-1.5 text-small rounded-medium bg-default/40 text-default-foreground max-w-full">
                            <pre class="bg-transparent font-mono font-normal inline-block whitespace-nowrap text-xs text-wrap max-w-full line-clamp-1">https://vidlink.pro/anime/{MALid}/{number}/{subOrDub}</pre>
                        </div>
                        <div class="mt-4">
                            <span class="text-xs text-white/80">Add ?fallback=true to force fallback to sub/dub if the type was not found.</span>
                        </div>
                        <div class="inline-flex items-center justify-between h-fit gap-2 px-3 py-1.5 text-small rounded-medium bg-default/40 text-default-foreground max-w-full">
                            <pre class="bg-transparent font-mono font-normal inline-block whitespace-nowrap text-xs text-wrap max-w-full line-clamp-1">https://vidlink.pro/anime/{MALid}/{number}/{subOrDub}?fallback=true</pre>
                        </div>
                        <div class="flex flex-col mt-4">
                            <span class="text-xs">Code Example:</span>
                            <div class="inline-flex items-center justify-between h-fit gap-2 px-3 py-1.5 text-small rounded-medium bg-primary/20 text-primary">
                                <pre class="bg-transparent font-mono font-normal inline-block whitespace-nowrap text-xs text-wrap">&lt;iframe src="https://vidlink.pro/anime/5/1/sub" frameborder="0" allowfullscreen&gt;&lt;/iframe&gt;</pre>
                            </div>
                        </div>
                    </div>

                    <!-- Customization Parameters -->
                    <div class="flex flex-col w-full mt-8">
                        <div class="flex items-center gap-4">
                            <h2 class="text-2xl font-semibold">Customization Parameters</h2>
                            <div class="flex-1 h-px bg-gradient-to-r from-white/20 to-transparent"></div>
                        </div>
                        <div class="flex flex-col mt-4">
                            <span class="text-xs text-white/80">You can customize the embedded media player by appending parameters to the URL. Each parameter should start with a ? and multiple parameters should be separated by &amp;.</span>
                        </div>
                        
                        <div class="grid grid-cols-1 gap-4 mt-4 md:grid-cols-2">
                            <div class="p-4 gap-2 transition-all hover:-translate-y-1 rounded-xl bg-white/5 border border-white/10 hover:border-white/20 hover:bg-white/[0.07] flex flex-col">
                                <strong class="text-sm">primaryColor</strong>
                                <p class="text-sm text-gray-400">Sets the primary color of the player, including sliders and autoplay controls.</p>
                                <div class="inline-flex items-center justify-between h-fit gap-2 px-3 py-1.5 text-small rounded-medium bg-default/40 text-default-foreground max-w-full">
                                    <pre class="bg-transparent font-mono font-normal inline-block whitespace-nowrap text-xs">primaryColor=B20710</pre>
                                </div>
                            </div>

                            <div class="p-4 gap-2 transition-all hover:-translate-y-1 rounded-xl bg-white/5 border border-white/10 hover:border-white/20 hover:bg-white/[0.07] flex flex-col">
                                <strong class="text-sm">secondaryColor</strong>
                                <p class="text-sm text-gray-400">Defines the color of the progress bar behind the sliders.</p>
                                <div class="inline-flex items-center justify-between h-fit gap-2 px-3 py-1.5 text-small rounded-medium bg-default/40 text-default-foreground max-w-full">
                                    <pre class="bg-transparent font-mono font-normal inline-block whitespace-nowrap text-xs">secondaryColor=170000</pre>
                                </div>
                            </div>

                            <div class="p-4 gap-2 transition-all hover:-translate-y-1 rounded-xl bg-white/5 border border-white/10 hover:border-white/20 hover:bg-white/[0.07] flex flex-col">
                                <strong class="text-sm">autoplay</strong>
                                <p class="text-sm text-gray-400">Controls whether the media starts playing automatically.</p>
                                <div class="inline-flex items-center justify-between h-fit gap-2 px-3 py-1.5 text-small rounded-medium bg-default/40 text-default-foreground max-w-full">
                                    <pre class="bg-transparent font-mono font-normal inline-block whitespace-nowrap text-xs">autoplay=false</pre>
                                </div>
                            </div>

                            <div class="p-4 gap-2 transition-all hover:-translate-y-1 rounded-xl bg-white/5 border border-white/10 hover:border-white/20 hover:bg-white/[0.07] flex flex-col">
                                <strong class="text-sm">title</strong>
                                <p class="text-sm text-gray-400">Controls whether the media title is displayed.</p>
                                <div class="inline-flex items-center justify-between h-fit gap-2 px-3 py-1.5 text-small rounded-medium bg-default/40 text-default-foreground max-w-full">
                                    <pre class="bg-transparent font-mono font-normal inline-block whitespace-nowrap text-xs">title=false</pre>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</div>
