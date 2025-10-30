<div class="flex flex-col items-center justify-center w-full" style="margin-top: 100px;">
    <div class="flex max-w-[70rem] flex-col items-center w-full h-full min-h-screen gap-2 p-4">
        <main class="flex max-w-[70rem] flex-col items-center w-full h-full min-h-screen gap-2 p-4">
            <div class="w-full space-y-8">
                <h1 class="text-4xl font-bold text-white">API Documentation</h1>
                
                <section class="space-y-4">
                    <h2 class="text-2xl font-semibold text-white">Embed Movie</h2>
                    <div class="p-6 rounded-xl bg-white/5 backdrop-blur-sm border border-white/10">
                        <p class="text-sm text-gray-400 mb-4">TMDB id is required from TMDB API. Movie ID should not be empty.</p>
                        <div class="inline-flex items-center justify-between h-fit gap-2 px-3 py-1.5 text-small rounded-medium bg-default/40 text-default-foreground max-w-full">
                            <pre class="bg-transparent font-mono font-normal inline-block whitespace-nowrap text-xs text-wrap max-w-full line-clamp-1"><span class="select-none"></span>https://vidlink.pro/movie/{tmdbId}</pre>
                        </div>
                        <div class="flex flex-col mt-4">
                            <span class="text-xs text-gray-400">Code Example:</span>
                            <div class="inline-flex items-center justify-between h-fit gap-2 px-3 py-1.5 text-small rounded-medium bg-primary/20 text-primary">
                                <pre class="bg-transparent font-mono font-normal inline-block whitespace-nowrap text-xs text-wrap"><span class="select-none"></span>&lt;iframe
  src="https://vidlink.pro/movie/786892"
  frameborder="0"
  allowfullscreen
&gt;&lt;/iframe&gt;</pre>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="space-y-4">
                    <h2 class="text-2xl font-semibold text-white">Embed TV Show</h2>
                    <div class="p-6 rounded-xl bg-white/5 backdrop-blur-sm border border-white/10">
                        <p class="text-sm text-gray-400 mb-4">TMDB id, season and episode are required from TMDB API.</p>
                        <div class="inline-flex items-center justify-between h-fit gap-2 px-3 py-1.5 text-small rounded-medium bg-default/40 text-default-foreground max-w-full">
                            <pre class="bg-transparent font-mono font-normal inline-block whitespace-nowrap text-xs text-wrap max-w-full line-clamp-1"><span class="select-none"></span>https://vidlink.pro/tv/{tmdbId}/{season}/{episode}</pre>
                        </div>
                        <div class="flex flex-col mt-4">
                            <span class="text-xs text-gray-400">Code Example:</span>
                            <div class="inline-flex items-center justify-between h-fit gap-2 px-3 py-1.5 text-small rounded-medium bg-primary/20 text-primary">
                                <pre class="bg-transparent font-mono font-normal inline-block whitespace-nowrap text-xs text-wrap"><span class="select-none"></span>&lt;iframe
  src="https://vidlink.pro/tv/94997/1/1"
  frameborder="0"
  allowfullscreen
&gt;&lt;/iframe&gt;</pre>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="space-y-4">
                    <h2 class="text-2xl font-semibold text-white">Embed Anime <span class="px-2 py-0.5 text-xs text-black bg-green-500 rounded-md">New</span></h2>
                    <div class="p-6 rounded-xl bg-white/5 backdrop-blur-sm border border-white/10">
                        <p class="text-sm text-gray-400 mb-4">MyAnimeList id is required from <a class="text-success underline" href="https://myanimelist.net/" target="_blank">MyAnimeList</a> API. Number and type should not be empty.</p>
                        <div class="inline-flex items-center justify-between h-fit gap-2 px-3 py-1.5 text-small rounded-medium bg-default/40 text-default-foreground max-w-full">
                            <pre class="bg-transparent font-mono font-normal inline-block whitespace-nowrap text-xs text-wrap max-w-full line-clamp-1"><span class="select-none"></span>https://vidlink.pro/anime/{MALid}/{number}/{subOrDub}</pre>
                        </div>
                        <div class="mt-4">
                            <span class="text-xs text-white/80">Add ?fallback=true to force fallback to sub and vice versa if the type you set was not found.</span>
                        </div>
                        <div class="inline-flex items-center justify-between h-fit gap-2 px-3 py-1.5 text-small rounded-medium bg-default/40 text-default-foreground max-w-full mt-2">
                            <pre class="bg-transparent font-mono font-normal inline-block whitespace-nowrap text-xs text-wrap max-w-full line-clamp-1"><span class="select-none"></span>https://vidlink.pro/anime/{MALid}/{number}/{subOrDub}?fallback=true</pre>
                        </div>
                        <div class="flex flex-col mt-4">
                            <span class="text-xs text-gray-400">Code Example:</span>
                            <div class="inline-flex items-center justify-between h-fit gap-2 px-3 py-1.5 text-small rounded-medium bg-primary/20 text-primary">
                                <pre class="bg-transparent font-mono font-normal inline-block whitespace-nowrap text-xs text-wrap"><span class="select-none"></span>&lt;iframe
  src="https://vidlink.pro/anime/5/1/sub"
  frameborder="0"
  allowfullscreen
&gt;&lt;/iframe&gt;</pre>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="space-y-4">
                    <h2 class="text-2xl font-semibold text-white">Customization Parameters</h2>
                    <p class="text-sm text-gray-400">You can customize the embedded media player by appending parameters to the URL. Each parameter should start with a ? and multiple parameters should be separated by &amp;.</p>
                    
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
                        <div class="p-4 gap-2 transition-all hover:-translate-y-1 rounded-xl bg-white/5 border border-white/10 hover:border-white/20 hover:bg-white/[0.07] flex flex-col">
                            <strong class="text-sm text-white">primaryColor</strong>
                            <p class="text-sm text-gray-400">Sets the primary color of the player, including sliders and autoplay controls.</p>
                            <div class="inline-flex items-center justify-between h-fit gap-2 px-3 py-1.5 text-small rounded-medium bg-default/40 text-default-foreground">
                                <pre class="bg-transparent font-mono font-normal inline-block text-xs">primaryColor=B20710</pre>
                            </div>
                        </div>

                        <div class="p-4 gap-2 transition-all hover:-translate-y-1 rounded-xl bg-white/5 border border-white/10 hover:border-white/20 hover:bg-white/[0.07] flex flex-col">
                            <strong class="text-sm text-white">secondaryColor</strong>
                            <p class="text-sm text-gray-400">Defines the color of the progress bar behind the sliders.</p>
                            <div class="inline-flex items-center justify-between h-fit gap-2 px-3 py-1.5 text-small rounded-medium bg-default/40 text-default-foreground">
                                <pre class="bg-transparent font-mono font-normal inline-block text-xs">secondaryColor=170000</pre>
                            </div>
                        </div>

                        <div class="p-4 gap-2 transition-all hover:-translate-y-1 rounded-xl bg-white/5 border border-white/10 hover:border-white/20 hover:bg-white/[0.07] flex flex-col">
                            <strong class="text-sm text-white">icons</strong>
                            <p class="text-sm text-gray-400">Changes the design of the icons within the player. Can be either "vid" or "default".</p>
                            <div class="inline-flex items-center justify-between h-fit gap-2 px-3 py-1.5 text-small rounded-medium bg-default/40 text-default-foreground">
                                <pre class="bg-transparent font-mono font-normal inline-block text-xs">icons=vid</pre>
                            </div>
                        </div>

                        <div class="p-4 gap-2 transition-all hover:-translate-y-1 rounded-xl bg-white/5 border border-white/10 hover:border-white/20 hover:bg-white/[0.07] flex flex-col">
                            <strong class="text-sm text-white">title</strong>
                            <p class="text-sm text-gray-400">Controls whether the media title is displayed.</p>
                            <div class="inline-flex items-center justify-between h-fit gap-2 px-3 py-1.5 text-small rounded-medium bg-default/40 text-default-foreground">
                                <pre class="bg-transparent font-mono font-normal inline-block text-xs">title=false</pre>
                            </div>
                        </div>

                        <div class="p-4 gap-2 transition-all hover:-translate-y-1 rounded-xl bg-white/5 border border-white/10 hover:border-white/20 hover:bg-white/[0.07] flex flex-col">
                            <strong class="text-sm text-white">poster</strong>
                            <p class="text-sm text-gray-400">Determines if the poster image is shown.</p>
                            <div class="inline-flex items-center justify-between h-fit gap-2 px-3 py-1.5 text-small rounded-medium bg-default/40 text-default-foreground">
                                <pre class="bg-transparent font-mono font-normal inline-block text-xs">poster=true</pre>
                            </div>
                        </div>

                        <div class="p-4 gap-2 transition-all hover:-translate-y-1 rounded-xl bg-white/5 border border-white/10 hover:border-white/20 hover:bg-white/[0.07] flex flex-col">
                            <strong class="text-sm text-white">autoplay</strong>
                            <p class="text-sm text-gray-400">Controls whether the media starts playing automatically.</p>
                            <div class="inline-flex items-center justify-between h-fit gap-2 px-3 py-1.5 text-small rounded-medium bg-default/40 text-default-foreground">
                                <pre class="bg-transparent font-mono font-normal inline-block text-xs">autoplay=false</pre>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </main>
    </div>
</div>
