<div class="w-full max-w-[70rem] mx-auto transition-all duration-200 p-4 bg-transparent border border-transparent rounded-xl justify-between items-center">
      <div class="flex flex-col items-center justify-center w-full" style="margin-top: 100px;">
         <div class="flex max-w-[70rem] flex-col items-center w-full h-full min-h-screen gap-2 p-4 ">

                
<main id=PlayerTester class="flex max-w-[70rem] flex-col items-center w-full h-full min-h-screen gap-2 p-4">
                <div id=simpleDoc class="flex flex-col justify-center w-full gap-4 text-center">
                    <div class="flex items-center gap-4">
                        <h2 class="text-2xl font-semibold">Api Documentation</h2>
                        <div class="flex-1 h-px bg-gradient-to-r from-white/20 to-transparent"></div>
                    </div>
                    <div class="flex flex-col items-start justify-start w-full gap-4 text-start">
                        <div class="flex flex-col w-full p-4 gap-2 transition-all hover:-translate-y-1 rounded-xl bg-white/5 border border-white/10 hover:border-white/20 hover:bg-white/[0.07]">
                            <p class="text-xl font-semibold">Embed Movies
                                <div><span class="text-xs text-white/80">TmdbId is required from </span><a class="relative inline-flex items-center tap-highlight-transparent outline-none data-[focus-visible=true]:z-10 data-[focus-visible=true]:outline-2 data-[focus-visible=true]:outline-focus data-[focus-visible=true]:outline-offset-2 text-medium text-success no-underline hover:opacity-80 active:opacity-disabled transition-opacity"
                                    href=https://developer.themoviedb.org/docs/getting-started target=_blank rel="noopener noreferrer" tabindex=0 role=link>The Movie Database<svg aria-hidden=true fill=none focusable=false height=1em shape-rendering=geometricPrecision stroke=currentColor stroke-linecap=round stroke-linejoin=round stroke-width=1.5 viewBox="0 0 24 24" width=1em class="flex mx-1 text-current self-center"><path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6"></path><path d="M15 3h6v6"></path><path d="M10 14L21 3"></path></svg></a>
                                    <span
                                    class="text-xs text-white/80"> API.</span>
                                </div>
                                <div class="inline-flex items-center justify-between h-fit gap-2 px-3 py-1.5 text-small rounded-medium bg-default/40 text-default-foreground"><pre class="bg-transparent font-mono font-normal inline-block whitespace-nowrap text-xs text-wrap"><span class=select-none></span>https://vidlink.pro/movie/{tmdbId}</pre>
                                    <button class="group inline-flex items-center justify-center box-border appearance-none select-none whitespace-nowrap font-normal subpixel-antialiased overflow-hidden tap-highlight-transparent data-[pressed=true]:scale-[0.97] outline-none data-[focus-visible=true]:z-10 data-[focus-visible=true]:outline-2 data-[focus-visible=true]:outline-focus data-[focus-visible=true]:outline-offset-2 gap-2 rounded-small px-0 !gap-0 transition-transform-colors-opacity motion-reduce:transition-none bg-transparent min-w-8 w-8 h-8 relative z-10 text-large text-inherit data-[hover=true]:bg-transparent"
                                    type=button aria-label="Copy to clipboard">
                                        <svg aria-hidden=true fill=none focusable=false height=1em role=presentation stroke=currentColor stroke-linecap=round stroke-linejoin=round stroke-width=2 viewBox="0 0 24 24" width=1em class="absolute text-inherit opacity-0 scale-50 group-data-[copied=true]:opacity-100 group-data-[copied=true]:scale-100 transition-transform-opacity">
                                            <polyline points="20 6 9 17 4 12"></polyline>
                                        </svg>
                                        <svg aria-hidden=true fill=none focusable=false height=1em role=presentation stroke=currentColor stroke-linecap=round stroke-linejoin=round stroke-width=1.5 viewBox="0 0 24 24" width=1em class="absolute text-inherit opacity-100 scale-100 group-data-[copied=true]:opacity-0 group-data-[copied=true]:scale-50 transition-transform-opacity">
                                            <path d="M16 17.1c0 3.5-1.4 4.9-4.9 4.9H6.9C3.4 22 2 20.6 2 17.1v-4.2C2 9.4 3.4 8 6.9 8h4.2c3.5 0 4.9 1.4 4.9 4.9Z"></path>
                                            <path d="M8 8V6.9C8 3.4 9.4 2 12.9 2h4.2C20.6 2 22 3.4 22 6.9v4.2c0 3.5-1.4 4.9-4.9 4.9H16"></path>
                                            <path d="M16 12.9C16 9.4 14.6 8 11.1 8"></path>
                                        </svg>
                                    </button>
                                </div>
                                <div class="flex flex-col mt-4"><span class=text-xs>Code Example:</span>
                                    <div class="inline-flex items-center justify-between h-fit gap-2 px-3 py-1.5 text-small rounded-medium bg-primary/20 text-primary"><pre class="bg-transparent font-mono font-normal inline-block whitespace-nowrap text-xs text-wrap"><span class=select-none></span>&lt;iframe
  src="https://vidlink.pro/movie/786892"
  frameborder="0"
  allowfullscreen
&gt;&lt;/iframe&gt;</pre>
                                        <button class="group inline-flex items-center justify-center box-border appearance-none select-none whitespace-nowrap font-normal subpixel-antialiased overflow-hidden tap-highlight-transparent data-[pressed=true]:scale-[0.97] outline-none data-[focus-visible=true]:z-10 data-[focus-visible=true]:outline-2 data-[focus-visible=true]:outline-focus data-[focus-visible=true]:outline-offset-2 gap-2 rounded-small px-0 !gap-0 transition-transform-colors-opacity motion-reduce:transition-none bg-transparent min-w-8 w-8 h-8 relative z-10 text-large text-inherit data-[hover=true]:bg-transparent"
                                        type=button aria-label="Copy to clipboard">
                                            <svg aria-hidden=true fill=none focusable=false height=1em role=presentation stroke=currentColor stroke-linecap=round stroke-linejoin=round stroke-width=2 viewBox="0 0 24 24" width=1em class="absolute text-inherit opacity-0 scale-50 group-data-[copied=true]:opacity-100 group-data-[copied=true]:scale-100 transition-transform-opacity">
                                                <polyline points="20 6 9 17 4 12"></polyline>
                                            </svg>
                                            <svg aria-hidden=true fill=none focusable=false height=1em role=presentation stroke=currentColor stroke-linecap=round stroke-linejoin=round stroke-width=1.5 viewBox="0 0 24 24" width=1em class="absolute text-inherit opacity-100 scale-100 group-data-[copied=true]:opacity-0 group-data-[copied=true]:scale-50 transition-transform-opacity">
                                                <path d="M16 17.1c0 3.5-1.4 4.9-4.9 4.9H6.9C3.4 22 2 20.6 2 17.1v-4.2C2 9.4 3.4 8 6.9 8h4.2c3.5 0 4.9 1.4 4.9 4.9Z"></path>
                                                <path d="M8 8V6.9C8 3.4 9.4 2 12.9 2h4.2C20.6 2 22 3.4 22 6.9v4.2c0 3.5-1.4 4.9-4.9 4.9H16"></path>
                                                <path d="M16 12.9C16 9.4 14.6 8 11.1 8"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                        </div>
                        <div class="p-4 gap-2 transition-all hover:-translate-y-1 rounded-xl bg-white/5 border border-white/10 hover:border-white/20 hover:bg-white/[0.07] flex flex-col w-full">
                            <p class="text-xl font-semibold">Embed Shows
                                <div><span class="text-xs text-white/80">TmdbId is required from </span><a class="relative inline-flex items-center tap-highlight-transparent outline-none data-[focus-visible=true]:z-10 data-[focus-visible=true]:outline-2 data-[focus-visible=true]:outline-focus data-[focus-visible=true]:outline-offset-2 text-medium text-success no-underline hover:opacity-80 active:opacity-disabled transition-opacity"
                                    href=https://developer.themoviedb.org/docs/getting-started target=_blank rel="noopener noreferrer" tabindex=0 role=link>The Movie Database<svg aria-hidden=true fill=none focusable=false height=1em shape-rendering=geometricPrecision stroke=currentColor stroke-linecap=round stroke-linejoin=round stroke-width=1.5 viewBox="0 0 24 24" width=1em class="flex mx-1 text-current self-center"><path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6"></path><path d="M15 3h6v6"></path><path d="M10 14L21 3"></path></svg></a>
                                    <span
                                    class="text-xs text-white/80">API. season and episode number should not be empty.</span>
                                </div>
                                <div class="inline-flex items-center justify-between h-fit gap-2 px-3 py-1.5 text-small rounded-medium bg-default/40 text-default-foreground max-w-full"><pre class="bg-transparent font-mono font-normal inline-block whitespace-nowrap text-xs text-wrap max-w-full line-clamp-1"><span class=select-none></span>https://vidlink.pro/tv/{tmdbId}/{season}/{episode}</pre>
                                    <button class="group inline-flex items-center justify-center box-border appearance-none select-none whitespace-nowrap font-normal subpixel-antialiased overflow-hidden tap-highlight-transparent data-[pressed=true]:scale-[0.97] outline-none data-[focus-visible=true]:z-10 data-[focus-visible=true]:outline-2 data-[focus-visible=true]:outline-focus data-[focus-visible=true]:outline-offset-2 gap-2 rounded-small px-0 !gap-0 transition-transform-colors-opacity motion-reduce:transition-none bg-transparent min-w-8 w-8 h-8 relative z-10 text-large text-inherit data-[hover=true]:bg-transparent"
                                    type=button aria-label="Copy to clipboard">
                                        <svg aria-hidden=true fill=none focusable=false height=1em role=presentation stroke=currentColor stroke-linecap=round stroke-linejoin=round stroke-width=2 viewBox="0 0 24 24" width=1em class="absolute text-inherit opacity-0 scale-50 group-data-[copied=true]:opacity-100 group-data-[copied=true]:scale-100 transition-transform-opacity">
                                            <polyline points="20 6 9 17 4 12"></polyline>
                                        </svg>
                                        <svg aria-hidden=true fill=none focusable=false height=1em role=presentation stroke=currentColor stroke-linecap=round stroke-linejoin=round stroke-width=1.5 viewBox="0 0 24 24" width=1em class="absolute text-inherit opacity-100 scale-100 group-data-[copied=true]:opacity-0 group-data-[copied=true]:scale-50 transition-transform-opacity">
                                            <path d="M16 17.1c0 3.5-1.4 4.9-4.9 4.9H6.9C3.4 22 2 20.6 2 17.1v-4.2C2 9.4 3.4 8 6.9 8h4.2c3.5 0 4.9 1.4 4.9 4.9Z"></path>
                                            <path d="M8 8V6.9C8 3.4 9.4 2 12.9 2h4.2C20.6 2 22 3.4 22 6.9v4.2c0 3.5-1.4 4.9-4.9 4.9H16"></path>
                                            <path d="M16 12.9C16 9.4 14.6 8 11.1 8"></path>
                                        </svg>
                                    </button>
                                </div>
                                <div class="flex flex-col mt-4"><span class=text-xs>Code Example:</span>
                                    <div class="inline-flex items-center justify-between h-fit gap-2 px-3 py-1.5 text-small rounded-medium bg-primary/20 text-primary"><pre class="bg-transparent font-mono font-normal inline-block whitespace-nowrap text-xs text-wrap"><span class=select-none></span>&lt;iframe
  src="https://vidlink.pro/tv/94997/1/1"
  frameborder="0"
  allowfullscreen
&gt;&lt;/iframe&gt;</pre>
                                        <button class="group inline-flex items-center justify-center box-border appearance-none select-none whitespace-nowrap font-normal subpixel-antialiased overflow-hidden tap-highlight-transparent data-[pressed=true]:scale-[0.97] outline-none data-[focus-visible=true]:z-10 data-[focus-visible=true]:outline-2 data-[focus-visible=true]:outline-focus data-[focus-visible=true]:outline-offset-2 gap-2 rounded-small px-0 !gap-0 transition-transform-colors-opacity motion-reduce:transition-none bg-transparent min-w-8 w-8 h-8 relative z-10 text-large text-inherit data-[hover=true]:bg-transparent"
                                        type=button aria-label="Copy to clipboard">
                                            <svg aria-hidden=true fill=none focusable=false height=1em role=presentation stroke=currentColor stroke-linecap=round stroke-linejoin=round stroke-width=2 viewBox="0 0 24 24" width=1em class="absolute text-inherit opacity-0 scale-50 group-data-[copied=true]:opacity-100 group-data-[copied=true]:scale-100 transition-transform-opacity">
                                                <polyline points="20 6 9 17 4 12"></polyline>
                                            </svg>
                                            <svg aria-hidden=true fill=none focusable=false height=1em role=presentation stroke=currentColor stroke-linecap=round stroke-linejoin=round stroke-width=1.5 viewBox="0 0 24 24" width=1em class="absolute text-inherit opacity-100 scale-100 group-data-[copied=true]:opacity-0 group-data-[copied=true]:scale-50 transition-transform-opacity">
                                                <path d="M16 17.1c0 3.5-1.4 4.9-4.9 4.9H6.9C3.4 22 2 20.6 2 17.1v-4.2C2 9.4 3.4 8 6.9 8h4.2c3.5 0 4.9 1.4 4.9 4.9Z"></path>
                                                <path d="M8 8V6.9C8 3.4 9.4 2 12.9 2h4.2C20.6 2 22 3.4 22 6.9v4.2c0 3.5-1.4 4.9-4.9 4.9H16"></path>
                                                <path d="M16 12.9C16 9.4 14.6 8 11.1 8"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                        </div>
                        <div class="p-4 gap-2 transition-all hover:-translate-y-1 rounded-xl bg-white/5 border border-white/10 hover:border-white/20 hover:bg-white/[0.07] flex flex-col w-full">
                            <p class="flex items-center gap-2 text-xl font-semibold">Embed Anime <span class="px-2 py-0.5 text-xs text-black bg-green-500 rounded-md">New</span>
                                <div><span class="text-xs text-white/80">MyAnimeList id is required from </span><a class="relative inline-flex items-center tap-highlight-transparent outline-none data-[focus-visible=true]:z-10 data-[focus-visible=true]:outline-2 data-[focus-visible=true]:outline-focus data-[focus-visible=true]:outline-offset-2 text-medium text-success no-underline hover:opacity-80 active:opacity-disabled transition-opacity"
                                    href=https://myanimelist.net/ target=_blank rel="noopener noreferrer" tabindex=0 role=link>MyAnimeList<svg aria-hidden=true fill=none focusable=false height=1em shape-rendering=geometricPrecision stroke=currentColor stroke-linecap=round stroke-linejoin=round stroke-width=1.5 viewBox="0 0 24 24" width=1em class="flex mx-1 text-current self-center"><path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6"></path><path d="M15 3h6v6"></path><path d="M10 14L21 3"></path></svg></a>
                                    <span
                                    class="text-xs text-white/80">API. number and type should not be empty.</span>
                                </div>
                                <div class="inline-flex items-center justify-between h-fit gap-2 px-3 py-1.5 text-small rounded-medium bg-default/40 text-default-foreground max-w-full"><pre class="bg-transparent font-mono font-normal inline-block whitespace-nowrap text-xs text-wrap max-w-full line-clamp-1"><span class=select-none></span>https://vidlink.pro/anime/{MALid}/{number}/{subOrDub}</pre>
                                    <button
                                    class="group inline-flex items-center justify-center box-border appearance-none select-none whitespace-nowrap font-normal subpixel-antialiased overflow-hidden tap-highlight-transparent data-[pressed=true]:scale-[0.97] outline-none data-[focus-visible=true]:z-10 data-[focus-visible=true]:outline-2 data-[focus-visible=true]:outline-focus data-[focus-visible=true]:outline-offset-2 gap-2 rounded-small px-0 !gap-0 transition-transform-colors-opacity motion-reduce:transition-none bg-transparent min-w-8 w-8 h-8 relative z-10 text-large text-inherit data-[hover=true]:bg-transparent"
                                    type=button aria-label="Copy to clipboard">
                                        <svg aria-hidden=true fill=none focusable=false height=1em role=presentation stroke=currentColor stroke-linecap=round stroke-linejoin=round stroke-width=2 viewBox="0 0 24 24" width=1em class="absolute text-inherit opacity-0 scale-50 group-data-[copied=true]:opacity-100 group-data-[copied=true]:scale-100 transition-transform-opacity">
                                            <polyline points="20 6 9 17 4 12"></polyline>
                                        </svg>
                                        <svg aria-hidden=true fill=none focusable=false height=1em role=presentation stroke=currentColor stroke-linecap=round stroke-linejoin=round stroke-width=1.5 viewBox="0 0 24 24" width=1em class="absolute text-inherit opacity-100 scale-100 group-data-[copied=true]:opacity-0 group-data-[copied=true]:scale-50 transition-transform-opacity">
                                            <path d="M16 17.1c0 3.5-1.4 4.9-4.9 4.9H6.9C3.4 22 2 20.6 2 17.1v-4.2C2 9.4 3.4 8 6.9 8h4.2c3.5 0 4.9 1.4 4.9 4.9Z"></path>
                                            <path d="M8 8V6.9C8 3.4 9.4 2 12.9 2h4.2C20.6 2 22 3.4 22 6.9v4.2c0 3.5-1.4 4.9-4.9 4.9H16"></path>
                                            <path d="M16 12.9C16 9.4 14.6 8 11.1 8"></path>
                                        </svg>
                                        </button>
                                </div>
                                <div class=mt-4><span class="text-xs text-white/80">Add ?fallback=true to force fallback to sub and vice versa if the type you set was not found.</span></div>
                                <div class="inline-flex items-center justify-between h-fit gap-2 px-3 py-1.5 text-small rounded-medium bg-default/40 text-default-foreground max-w-full"><pre class="bg-transparent font-mono font-normal inline-block whitespace-nowrap text-xs text-wrap max-w-full line-clamp-1"><span class=select-none></span>https://vidlink.pro/anime/{MALid}/{number}/{subOrDub}?fallback=true</pre>
                                    <button
                                    class="group inline-flex items-center justify-center box-border appearance-none select-none whitespace-nowrap font-normal subpixel-antialiased overflow-hidden tap-highlight-transparent data-[pressed=true]:scale-[0.97] outline-none data-[focus-visible=true]:z-10 data-[focus-visible=true]:outline-2 data-[focus-visible=true]:outline-focus data-[focus-visible=true]:outline-offset-2 gap-2 rounded-small px-0 !gap-0 transition-transform-colors-opacity motion-reduce:transition-none bg-transparent min-w-8 w-8 h-8 relative z-10 text-large text-inherit data-[hover=true]:bg-transparent"
                                    type=button aria-label="Copy to clipboard">
                                        <svg aria-hidden=true fill=none focusable=false height=1em role=presentation stroke=currentColor stroke-linecap=round stroke-linejoin=round stroke-width=2 viewBox="0 0 24 24" width=1em class="absolute text-inherit opacity-0 scale-50 group-data-[copied=true]:opacity-100 group-data-[copied=true]:scale-100 transition-transform-opacity">
                                            <polyline points="20 6 9 17 4 12"></polyline>
                                        </svg>
                                        <svg aria-hidden=true fill=none focusable=false height=1em role=presentation stroke=currentColor stroke-linecap=round stroke-linejoin=round stroke-width=1.5 viewBox="0 0 24 24" width=1em class="absolute text-inherit opacity-100 scale-100 group-data-[copied=true]:opacity-0 group-data-[copied=true]:scale-50 transition-transform-opacity">
                                            <path d="M16 17.1c0 3.5-1.4 4.9-4.9 4.9H6.9C3.4 22 2 20.6 2 17.1v-4.2C2 9.4 3.4 8 6.9 8h4.2c3.5 0 4.9 1.4 4.9 4.9Z"></path>
                                            <path d="M8 8V6.9C8 3.4 9.4 2 12.9 2h4.2C20.6 2 22 3.4 22 6.9v4.2c0 3.5-1.4 4.9-4.9 4.9H16"></path>
                                            <path d="M16 12.9C16 9.4 14.6 8 11.1 8"></path>
                                        </svg>
                                        </button>
                                </div>
                                <div class="flex flex-col mt-4"><span class=text-xs>Code Example:</span>
                                    <div class="inline-flex items-center justify-between h-fit gap-2 px-3 py-1.5 text-small rounded-medium bg-primary/20 text-primary"><pre class="bg-transparent font-mono font-normal inline-block whitespace-nowrap text-xs text-wrap"><span class=select-none></span>&lt;iframe
  src="https://vidlink.pro/anime/5/1/sub"
  frameborder="0"
  allowfullscreen
&gt;&lt;/iframe&gt;</pre>
                                        <button class="group inline-flex items-center justify-center box-border appearance-none select-none whitespace-nowrap font-normal subpixel-antialiased overflow-hidden tap-highlight-transparent data-[pressed=true]:scale-[0.97] outline-none data-[focus-visible=true]:z-10 data-[focus-visible=true]:outline-2 data-[focus-visible=true]:outline-focus data-[focus-visible=true]:outline-offset-2 gap-2 rounded-small px-0 !gap-0 transition-transform-colors-opacity motion-reduce:transition-none bg-transparent min-w-8 w-8 h-8 relative z-10 text-large text-inherit data-[hover=true]:bg-transparent"
                                        type=button aria-label="Copy to clipboard">
                                            <svg aria-hidden=true fill=none focusable=false height=1em role=presentation stroke=currentColor stroke-linecap=round stroke-linejoin=round stroke-width=2 viewBox="0 0 24 24" width=1em class="absolute text-inherit opacity-0 scale-50 group-data-[copied=true]:opacity-100 group-data-[copied=true]:scale-100 transition-transform-opacity">
                                                <polyline points="20 6 9 17 4 12"></polyline>
                                            </svg>
                                            <svg aria-hidden=true fill=none focusable=false height=1em role=presentation stroke=currentColor stroke-linecap=round stroke-linejoin=round stroke-width=1.5 viewBox="0 0 24 24" width=1em class="absolute text-inherit opacity-100 scale-100 group-data-[copied=true]:opacity-0 group-data-[copied=true]:scale-50 transition-transform-opacity">
                                                <path d="M16 17.1c0 3.5-1.4 4.9-4.9 4.9H6.9C3.4 22 2 20.6 2 17.1v-4.2C2 9.4 3.4 8 6.9 8h4.2c3.5 0 4.9 1.4 4.9 4.9Z"></path>
                                                <path d="M8 8V6.9C8 3.4 9.4 2 12.9 2h4.2C20.6 2 22 3.4 22 6.9v4.2c0 3.5-1.4 4.9-4.9 4.9H16"></path>
                                                <path d="M16 12.9C16 9.4 14.6 8 11.1 8"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                        </div>
                        <div class="flex flex-col w-full mt-8">
                            <div class="flex items-center gap-4">
                                <h2 class="text-2xl font-semibold">Customization Parameters</h2>
                                <div class="flex-1 h-px bg-gradient-to-r from-white/20 to-transparent"></div>
                            </div>
                            <div class="flex flex-col" id=parameters><span class="text-xs text-white/80">You can customize the embedded media player by appending parameters to the URL. Each parameter should start with a ? and multiple parameters should be separated by &amp;.</span><span class="mt-2 text-xs text-white/80">Use <a class="relative inline-flex items-center tap-highlight-transparent outline-none data-[focus-visible=true]:z-10 data-[focus-visible=true]:outline-2 data-[focus-visible=true]:outline-focus data-[focus-visible=true]:outline-offset-2 text-success no-underline hover:opacity-80 active:opacity-disabled transition-opacity text-xs" href=https://htmlcolorcodes.com/color-picker/ target=_blank rel="noopener noreferrer" tabindex=0 role=link>Hex Color Codes<svg aria-hidden=true fill=none focusable=false height=1em shape-rendering=geometricPrecision stroke=currentColor stroke-linecap=round stroke-linejoin=round stroke-width=1.5 viewBox="0 0 24 24" width=1em class="flex mx-1 text-current self-center"><path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6"></path><path d="M15 3h6v6"></path><path d="M10 14L21 3"></path></svg></a>and remove the '#' before applying.</span>
                                <div
                                class="grid grid-cols-1 gap-4 mt-4 md:grid-cols-3">
                                    <div class="p-4 gap-2 transition-all hover:-translate-y-1 rounded-xl bg-white/5 border border-white/10 hover:border-white/20 hover:bg-white/[0.07] flex flex-col">
                                        <div class="flex items-center gap-2"><strong class=text-sm>primaryColor</strong></div>
                                        <p class="text-sm text-gray-400">Sets the primary color of the player, including sliders and autoplay controls.
                                            <div class="inline-flex items-center justify-between h-fit gap-2 px-3 py-1.5 text-small rounded-medium bg-default/40 text-default-foreground max-w-full"><pre class="bg-transparent font-mono font-normal inline-block whitespace-nowrap text-xs text-wrap max-w-full line-clamp-1"><span class=select-none></span>primaryColor=B20710</pre>
                                                <button class="group inline-flex items-center justify-center box-border appearance-none select-none whitespace-nowrap font-normal subpixel-antialiased overflow-hidden tap-highlight-transparent data-[pressed=true]:scale-[0.97] outline-none data-[focus-visible=true]:z-10 data-[focus-visible=true]:outline-2 data-[focus-visible=true]:outline-focus data-[focus-visible=true]:outline-offset-2 gap-2 rounded-small px-0 !gap-0 transition-transform-colors-opacity motion-reduce:transition-none bg-transparent min-w-8 w-8 h-8 relative z-10 text-large text-inherit data-[hover=true]:bg-transparent"
                                                type=button aria-label="Copy to clipboard">
                                                    <svg aria-hidden=true fill=none focusable=false height=1em role=presentation stroke=currentColor stroke-linecap=round stroke-linejoin=round stroke-width=2 viewBox="0 0 24 24" width=1em class="absolute text-inherit opacity-0 scale-50 group-data-[copied=true]:opacity-100 group-data-[copied=true]:scale-100 transition-transform-opacity">
                                                        <polyline points="20 6 9 17 4 12"></polyline>
                                                    </svg>
                                                    <svg aria-hidden=true fill=none focusable=false height=1em role=presentation stroke=currentColor stroke-linecap=round stroke-linejoin=round stroke-width=1.5 viewBox="0 0 24 24" width=1em class="absolute text-inherit opacity-100 scale-100 group-data-[copied=true]:opacity-0 group-data-[copied=true]:scale-50 transition-transform-opacity">
                                                        <path d="M16 17.1c0 3.5-1.4 4.9-4.9 4.9H6.9C3.4 22 2 20.6 2 17.1v-4.2C2 9.4 3.4 8 6.9 8h4.2c3.5 0 4.9 1.4 4.9 4.9Z"></path>
                                                        <path d="M8 8V6.9C8 3.4 9.4 2 12.9 2h4.2C20.6 2 22 3.4 22 6.9v4.2c0 3.5-1.4 4.9-4.9 4.9H16"></path>
                                                        <path d="M16 12.9C16 9.4 14.6 8 11.1 8"></path>
                                                    </svg>
                                                </button>
                                            </div>
                                    </div>
                                    <div class="p-4 gap-2 transition-all hover:-translate-y-1 rounded-xl bg-white/5 border border-white/10 hover:border-white/20 hover:bg-white/[0.07] flex flex-col">
                                        <div class="flex items-center gap-2"><strong class=text-sm>secondaryColor</strong></div>
                                        <p class="text-sm text-gray-400">Defines the color of the progress bar behind the sliders.
                                            <div class="inline-flex items-center justify-between h-fit gap-2 px-3 py-1.5 text-small rounded-medium bg-default/40 text-default-foreground max-w-full"><pre class="bg-transparent font-mono font-normal inline-block whitespace-nowrap text-xs text-wrap max-w-full line-clamp-1"><span class=select-none></span>secondaryColor=170000</pre>
                                                <button class="group inline-flex items-center justify-center box-border appearance-none select-none whitespace-nowrap font-normal subpixel-antialiased overflow-hidden tap-highlight-transparent data-[pressed=true]:scale-[0.97] outline-none data-[focus-visible=true]:z-10 data-[focus-visible=true]:outline-2 data-[focus-visible=true]:outline-focus data-[focus-visible=true]:outline-offset-2 gap-2 rounded-small px-0 !gap-0 transition-transform-colors-opacity motion-reduce:transition-none bg-transparent min-w-8 w-8 h-8 relative z-10 text-large text-inherit data-[hover=true]:bg-transparent"
                                                type=button aria-label="Copy to clipboard">
                                                    <svg aria-hidden=true fill=none focusable=false height=1em role=presentation stroke=currentColor stroke-linecap=round stroke-linejoin=round stroke-width=2 viewBox="0 0 24 24" width=1em class="absolute text-inherit opacity-0 scale-50 group-data-[copied=true]:opacity-100 group-data-[copied=true]:scale-100 transition-transform-opacity">
                                                        <polyline points="20 6 9 17 4 12"></polyline>
                                                    </svg>
                                                    <svg aria-hidden=true fill=none focusable=false height=1em role=presentation stroke=currentColor stroke-linecap=round stroke-linejoin=round stroke-width=1.5 viewBox="0 0 24 24" width=1em class="absolute text-inherit opacity-100 scale-100 group-data-[copied=true]:opacity-0 group-data-[copied=true]:scale-50 transition-transform-opacity">
                                                        <path d="M16 17.1c0 3.5-1.4 4.9-4.9 4.9H6.9C3.4 22 2 20.6 2 17.1v-4.2C2 9.4 3.4 8 6.9 8h4.2c3.5 0 4.9 1.4 4.9 4.9Z"></path>
                                                        <path d="M8 8V6.9C8 3.4 9.4 2 12.9 2h4.2C20.6 2 22 3.4 22 6.9v4.2c0 3.5-1.4 4.9-4.9 4.9H16"></path>
                                                        <path d="M16 12.9C16 9.4 14.6 8 11.1 8"></path>
                                                    </svg>
                                                </button>
                                            </div>
                                    </div>
                                    <div class="p-4 gap-2 transition-all hover:-translate-y-1 rounded-xl bg-white/5 border border-white/10 hover:border-white/20 hover:bg-white/[0.07] flex flex-col">
                                        <div class="flex items-center gap-2"><strong class=text-sm>icons</strong></div>
                                        <p class="text-sm text-gray-400">Changes the design of the icons within the player. can be either "vid" or "default".
                                            <div class="inline-flex items-center justify-between h-fit gap-2 px-3 py-1.5 text-small rounded-medium bg-default/40 text-default-foreground max-w-full"><pre class="bg-transparent font-mono font-normal inline-block whitespace-nowrap text-xs text-wrap max-w-full line-clamp-1"><span class=select-none></span>icons=vid</pre>
                                                <button class="group inline-flex items-center justify-center box-border appearance-none select-none whitespace-nowrap font-normal subpixel-antialiased overflow-hidden tap-highlight-transparent data-[pressed=true]:scale-[0.97] outline-none data-[focus-visible=true]:z-10 data-[focus-visible=true]:outline-2 data-[focus-visible=true]:outline-focus data-[focus-visible=true]:outline-offset-2 gap-2 rounded-small px-0 !gap-0 transition-transform-colors-opacity motion-reduce:transition-none bg-transparent min-w-8 w-8 h-8 relative z-10 text-large text-inherit data-[hover=true]:bg-transparent"
                                                type=button aria-label="Copy to clipboard">
                                                    <svg aria-hidden=true fill=none focusable=false height=1em role=presentation stroke=currentColor stroke-linecap=round stroke-linejoin=round stroke-width=2 viewBox="0 0 24 24" width=1em class="absolute text-inherit opacity-0 scale-50 group-data-[copied=true]:opacity-100 group-data-[copied=true]:scale-100 transition-transform-opacity">
                                                        <polyline points="20 6 9 17 4 12"></polyline>
                                                    </svg>
                                                    <svg aria-hidden=true fill=none focusable=false height=1em role=presentation stroke=currentColor stroke-linecap=round stroke-linejoin=round stroke-width=1.5 viewBox="0 0 24 24" width=1em class="absolute text-inherit opacity-100 scale-100 group-data-[copied=true]:opacity-0 group-data-[copied=true]:scale-50 transition-transform-opacity">
                                                        <path d="M16 17.1c0 3.5-1.4 4.9-4.9 4.9H6.9C3.4 22 2 20.6 2 17.1v-4.2C2 9.4 3.4 8 6.9 8h4.2c3.5 0 4.9 1.4 4.9 4.9Z"></path>
                                                        <path d="M8 8V6.9C8 3.4 9.4 2 12.9 2h4.2C20.6 2 22 3.4 22 6.9v4.2c0 3.5-1.4 4.9-4.9 4.9H16"></path>
                                                        <path d="M16 12.9C16 9.4 14.6 8 11.1 8"></path>
                                                    </svg>
                                                </button>
                                            </div>
                                            <div class=mt-2>
                                                <div><span>Example of "vid" icons:</span>
                                                    <div class="flex gap-2 mt-4">
                                                        <svg viewBox="0 0 32 32" class="size-8 vds-icon" fill=none aria-hidden=true focusable=false xmlns=http://www.w3.org/2000/svg>
                                                            <path d="M10.6667 6.6548C10.6667 6.10764 11.2894 5.79346 11.7295 6.11862L24.377 15.4634C24.7377 15.7298 24.7377 16.2692 24.3771 16.5357L11.7295 25.8813C11.2895 26.2065 10.6667 25.8923 10.6667 25.3451L10.6667 6.6548Z"
                                                            fill=currentColor></path>
                                                        </svg>
                                                        <svg viewBox="0 0 32 32" class="size-8 vds-icon" fill=none aria-hidden=true focusable=false xmlns=http://www.w3.org/2000/svg>
                                                            <path d="M8.66667 6.66667C8.29848 6.66667 8 6.96514 8 7.33333V24.6667C8 25.0349 8.29848 25.3333 8.66667 25.3333H12.6667C13.0349 25.3333 13.3333 25.0349 13.3333 24.6667V7.33333C13.3333 6.96514 13.0349 6.66667 12.6667 6.66667H8.66667Z"
                                                            fill=currentColor></path>
                                                            <path d="M19.3333 6.66667C18.9651 6.66667 18.6667 6.96514 18.6667 7.33333V24.6667C18.6667 25.0349 18.9651 25.3333 19.3333 25.3333H23.3333C23.7015 25.3333 24 25.0349 24 24.6667V7.33333C24 6.96514 23.7015 6.66667 23.3333 6.66667H19.3333Z"
                                                            fill=currentColor></path>
                                                        </svg>
                                                        <svg viewBox="0 0 32 32" class="size-8 vds-icon" fill=none aria-hidden=true focusable=false xmlns=http://www.w3.org/2000/svg>
                                                            <path d="M15.3333 10.3452C15.3333 10.8924 15.9561 11.2066 16.3962 10.8814L20.9234 7.5364C21.2841 7.26993 21.2841 6.73054 20.9235 6.46405L16.3962 3.11873C15.9561 2.79356 15.3333 3.10773 15.3333 3.6549V5.22682C15.3333 5.29746 15.2778 5.35579 15.2073 5.36066C9.31791 5.76757 4.66667 10.674 4.66667 16.6667C4.66667 22.9259 9.74078 28 16 28C22.0352 28 26.9686 23.2827 27.314 17.3341C27.3354 16.9665 27.0348 16.6673 26.6666 16.6673H24.6666C24.2984 16.6673 24.0029 16.9668 23.9726 17.3337C23.6336 21.4399 20.1937 24.6667 16 24.6667C11.5817 24.6667 8 21.085 8 16.6667C8 12.5225 11.1517 9.11428 15.1887 8.70739C15.2663 8.69957 15.3333 8.76096 15.3333 8.83893V10.3452Z"
                                                            fill=currentColor></path>
                                                            <path fill-rule=evenodd clip-rule=evenodd d="M17.0879 19.679C17.4553 19.9195 17.8928 20.0398 18.4004 20.0398C18.9099 20.0398 19.3474 19.9205 19.7129 19.6818C20.0803 19.4413 20.3635 19.0938 20.5623 18.6392C20.7612 18.1847 20.8606 17.6373 20.8606 16.9972C20.8625 16.3608 20.764 15.8192 20.5652 15.3722C20.3663 14.9252 20.0822 14.5853 19.7129 14.3523C19.3455 14.1175 18.908 14 18.4004 14C17.8928 14 17.4553 14.1175 17.0879 14.3523C16.7224 14.5853 16.4402 14.9252 16.2413 15.3722C16.0443 15.8173 15.9449 16.3589 15.943 16.9972C15.9411 17.6354 16.0396 18.1818 16.2385 18.6364C16.4373 19.089 16.7205 19.4366 17.0879 19.679ZM19.1362 18.4262C18.9487 18.7349 18.7034 18.8892 18.4004 18.8892C18.1996 18.8892 18.0225 18.8211 17.8691 18.6847C17.7157 18.5464 17.5964 18.3372 17.5112 18.0568C17.4278 17.7765 17.3871 17.4233 17.389 16.9972C17.3909 16.3684 17.4847 15.9025 17.6703 15.5995C17.8559 15.2945 18.0992 15.1421 18.4004 15.1421C18.603 15.1421 18.7801 15.2093 18.9316 15.3438C19.0831 15.4782 19.2015 15.6828 19.2867 15.9574C19.372 16.2301 19.4146 16.5767 19.4146 16.9972C19.4165 17.6392 19.3237 18.1156 19.1362 18.4262Z"
                                                            fill=currentColor></path>
                                                            <path d="M13.7746 19.8978C13.8482 19.8978 13.9079 19.8381 13.9079 19.7644V14.2129C13.9079 14.1393 13.8482 14.0796 13.7746 14.0796H12.642C12.6171 14.0796 12.5927 14.0865 12.5716 14.0997L11.2322 14.9325C11.1931 14.9568 11.1693 14.9996 11.1693 15.0457V15.9497C11.1693 16.0539 11.2833 16.1178 11.3722 16.0635L12.464 15.396C12.4682 15.3934 12.473 15.3921 12.4779 15.3921C12.4926 15.3921 12.5045 15.404 12.5045 15.4187V19.7644C12.5045 19.8381 12.5642 19.8978 12.6378 19.8978H13.7746Z"
                                                            fill=currentColor></path>
                                                        </svg>
                                                        <svg viewBox="0 0 32 32" class="size-8 vds-icon" fill=none aria-hidden=true focusable=false xmlns=http://www.w3.org/2000/svg>
                                                            <path d="M16.6667 10.3452C16.6667 10.8924 16.0439 11.2066 15.6038 10.8814L11.0766 7.5364C10.7159 7.26993 10.7159 6.73054 11.0766 6.46405L15.6038 3.11873C16.0439 2.79356 16.6667 3.10773 16.6667 3.6549V5.22682C16.6667 5.29746 16.7223 5.35579 16.7927 5.36066C22.6821 5.76757 27.3333 10.674 27.3333 16.6667C27.3333 22.9259 22.2592 28 16 28C9.96483 28 5.03145 23.2827 4.68601 17.3341C4.66466 16.9665 4.96518 16.6673 5.33339 16.6673H7.3334C7.70157 16.6673 7.99714 16.9668 8.02743 17.3337C8.36638 21.4399 11.8064 24.6667 16 24.6667C20.4183 24.6667 24 21.085 24 16.6667C24 12.5225 20.8483 9.11428 16.8113 8.70739C16.7337 8.69957 16.6667 8.76096 16.6667 8.83893V10.3452Z"
                                                            fill=currentColor></path>
                                                            <path fill-rule=evenodd clip-rule=evenodd d="M17.0879 19.679C17.4553 19.9195 17.8928 20.0398 18.4004 20.0398C18.9099 20.0398 19.3474 19.9205 19.7129 19.6818C20.0803 19.4413 20.3635 19.0938 20.5623 18.6392C20.7612 18.1847 20.8606 17.6373 20.8606 16.9972C20.8625 16.3608 20.764 15.8192 20.5652 15.3722C20.3663 14.9252 20.0822 14.5853 19.7129 14.3523C19.3455 14.1175 18.908 14 18.4004 14C17.8928 14 17.4553 14.1175 17.0879 14.3523C16.7224 14.5853 16.4402 14.9252 16.2413 15.3722C16.0443 15.8173 15.9449 16.3589 15.943 16.9972C15.9411 17.6354 16.0396 18.1818 16.2385 18.6364C16.4373 19.089 16.7205 19.4366 17.0879 19.679ZM19.1362 18.4262C18.9487 18.7349 18.7034 18.8892 18.4004 18.8892C18.1996 18.8892 18.0226 18.8211 17.8691 18.6847C17.7157 18.5464 17.5964 18.3372 17.5112 18.0568C17.4279 17.7765 17.3871 17.4233 17.389 16.9972C17.3909 16.3684 17.4847 15.9025 17.6703 15.5995C17.8559 15.2945 18.0993 15.1421 18.4004 15.1421C18.603 15.1421 18.7801 15.2093 18.9316 15.3438C19.0832 15.4782 19.2015 15.6828 19.2868 15.9574C19.372 16.2301 19.4146 16.5767 19.4146 16.9972C19.4165 17.6392 19.3237 18.1156 19.1362 18.4262Z"
                                                            fill=currentColor></path>
                                                            <path d="M13.7746 19.8978C13.8482 19.8978 13.9079 19.8381 13.9079 19.7644V14.2129C13.9079 14.1393 13.8482 14.0796 13.7746 14.0796H12.642C12.6171 14.0796 12.5927 14.0865 12.5716 14.0997L11.2322 14.9325C11.1931 14.9568 11.1693 14.9996 11.1693 15.0457V15.9497C11.1693 16.0539 11.2833 16.1178 11.3722 16.0635L12.464 15.396C12.4682 15.3934 12.473 15.3921 12.4779 15.3921C12.4926 15.3921 12.5045 15.404 12.5045 15.4187V19.7644C12.5045 19.8381 12.5642 19.8978 12.6378 19.8978H13.7746Z"
                                                            fill=currentColor></path>
                                                        </svg>
                                                        <svg viewBox="0 0 32 32" class="size-8 vds-icon" fill=none aria-hidden=true focusable=false xmlns=http://www.w3.org/2000/svg>
                                                            <path fill-rule=evenodd clip-rule=evenodd d="M13.5722 5.33333C13.2429 5.33333 12.9629 5.57382 12.9132 5.89938L12.4063 9.21916C12.4 9.26058 12.3746 9.29655 12.3378 9.31672C12.2387 9.37118 12.1409 9.42779 12.0444 9.48648C12.0086 9.5083 11.9646 9.51242 11.9255 9.49718L8.79572 8.27692C8.48896 8.15732 8.14083 8.27958 7.9762 8.56472L5.5491 12.7686C5.38444 13.0538 5.45271 13.4165 5.70981 13.6223L8.33308 15.7225C8.3658 15.7487 8.38422 15.7887 8.38331 15.8306C8.38209 15.8867 8.38148 15.9429 8.38148 15.9993C8.38148 16.0558 8.3821 16.1121 8.38332 16.1684C8.38423 16.2102 8.36582 16.2503 8.33313 16.2765L5.7103 18.3778C5.45334 18.5836 5.38515 18.9462 5.54978 19.2314L7.97688 23.4352C8.14155 23.7205 8.48981 23.8427 8.79661 23.723L11.926 22.5016C11.9651 22.4864 12.009 22.4905 12.0449 22.5123C12.1412 22.5709 12.2388 22.6274 12.3378 22.6818C12.3745 22.7019 12.4 22.7379 12.4063 22.7793L12.9132 26.0993C12.9629 26.4249 13.2429 26.6654 13.5722 26.6654H18.4264C18.7556 26.6654 19.0356 26.425 19.0854 26.0995L19.5933 22.7801C19.5997 22.7386 19.6252 22.7027 19.6619 22.6825C19.7614 22.6279 19.8596 22.5711 19.9564 22.5121C19.9923 22.4903 20.0362 22.4862 20.0754 22.5015L23.2035 23.7223C23.5103 23.842 23.8585 23.7198 24.0232 23.4346L26.4503 19.2307C26.6149 18.9456 26.5467 18.583 26.2898 18.3771L23.6679 16.2766C23.6352 16.2504 23.6168 16.2104 23.6177 16.1685C23.619 16.1122 23.6196 16.0558 23.6196 15.9993C23.6196 15.9429 23.619 15.8866 23.6177 15.8305C23.6168 15.7886 23.6353 15.7486 23.668 15.7224L26.2903 13.623C26.5474 13.4172 26.6156 13.0544 26.451 12.7692L24.0239 8.56537C23.8592 8.28023 23.5111 8.15797 23.2043 8.27757L20.0758 9.49734C20.0367 9.51258 19.9927 9.50846 19.9569 9.48664C19.8599 9.42762 19.7616 9.37071 19.6618 9.31596C19.6251 9.2958 19.5997 9.25984 19.5933 9.21843L19.0854 5.89915C19.0356 5.57369 18.7556 5.33333 18.4264 5.33333H13.5722ZM16.0001 20.2854C18.3672 20.2854 20.2862 18.3664 20.2862 15.9993C20.2862 13.6322 18.3672 11.7132 16.0001 11.7132C13.6329 11.7132 11.714 13.6322 11.714 15.9993C11.714 18.3664 13.6329 20.2854 16.0001 20.2854Z"
                                                            fill=currentColor></path>
                                                        </svg>
                                                        <svg viewBox="0 0 32 32" class="size-8 vds-icon" fill=none aria-hidden=true focusable=false xmlns=http://www.w3.org/2000/svg>
                                                            <path fill-rule=evenodd clip-rule=evenodd d="M4.6661 6.66699C4.29791 6.66699 3.99943 6.96547 3.99943 7.33366V24.667C3.99943 25.0352 4.29791 25.3337 4.6661 25.3337H27.3328C27.701 25.3337 27.9994 25.0352 27.9994 24.667V7.33366C27.9994 6.96547 27.701 6.66699 27.3328 6.66699H4.6661ZM8.66667 21.3333C8.29848 21.3333 8 21.0349 8 20.6667V11.3333C8 10.9651 8.29848 10.6667 8.66667 10.6667H14C14.3682 10.6667 14.6667 10.9651 14.6667 11.3333V12.6667C14.6667 13.0349 14.3682 13.3333 14 13.3333H10.8C10.7264 13.3333 10.6667 13.393 10.6667 13.4667V18.5333C10.6667 18.607 10.7264 18.6667 10.8 18.6667H14C14.3682 18.6667 14.6667 18.9651 14.6667 19.3333V20.6667C14.6667 21.0349 14.3682 21.3333 14 21.3333H8.66667ZM18 21.3333C17.6318 21.3333 17.3333 21.0349 17.3333 20.6667V11.3333C17.3333 10.9651 17.6318 10.6667 18 10.6667H23.3333C23.7015 10.6667 24 10.9651 24 11.3333V12.6667C24 13.0349 23.7015 13.3333 23.3333 13.3333H20.1333C20.0597 13.3333 20 13.393 20 13.4667V18.5333C20 18.607 20.0597 18.6667 20.1333 18.6667H23.3333C23.7015 18.6667 24 18.9651 24 19.3333V20.6667C24 21.0349 23.7015 21.3333 23.3333 21.3333H18Z"
                                                            fill=currentColor></path>
                                                        </svg>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                    <div class="p-4 gap-2 transition-all hover:-translate-y-1 rounded-xl bg-white/5 border border-white/10 hover:border-white/20 hover:bg-white/[0.07] flex flex-col">
                                        <div class="flex items-center gap-2"><strong class=text-sm>iconColor</strong></div>
                                        <p class="text-sm text-gray-400">Changes the color of the icons within the player.
                                            <div class="inline-flex items-center justify-between h-fit gap-2 px-3 py-1.5 text-small rounded-medium bg-default/40 text-default-foreground max-w-full"><pre class="bg-transparent font-mono font-normal inline-block whitespace-nowrap text-xs text-wrap max-w-full line-clamp-1"><span class=select-none></span>iconColor=B20710</pre>
                                                <button class="group inline-flex items-center justify-center box-border appearance-none select-none whitespace-nowrap font-normal subpixel-antialiased overflow-hidden tap-highlight-transparent data-[pressed=true]:scale-[0.97] outline-none data-[focus-visible=true]:z-10 data-[focus-visible=true]:outline-2 data-[focus-visible=true]:outline-focus data-[focus-visible=true]:outline-offset-2 gap-2 rounded-small px-0 !gap-0 transition-transform-colors-opacity motion-reduce:transition-none bg-transparent min-w-8 w-8 h-8 relative z-10 text-large text-inherit data-[hover=true]:bg-transparent"
                                                type=button aria-label="Copy to clipboard">
                                                    <svg aria-hidden=true fill=none focusable=false height=1em role=presentation stroke=currentColor stroke-linecap=round stroke-linejoin=round stroke-width=2 viewBox="0 0 24 24" width=1em class="absolute text-inherit opacity-0 scale-50 group-data-[copied=true]:opacity-100 group-data-[copied=true]:scale-100 transition-transform-opacity">
                                                        <polyline points="20 6 9 17 4 12"></polyline>
                                                    </svg>
                                                    <svg aria-hidden=true fill=none focusable=false height=1em role=presentation stroke=currentColor stroke-linecap=round stroke-linejoin=round stroke-width=1.5 viewBox="0 0 24 24" width=1em class="absolute text-inherit opacity-100 scale-100 group-data-[copied=true]:opacity-0 group-data-[copied=true]:scale-50 transition-transform-opacity">
                                                        <path d="M16 17.1c0 3.5-1.4 4.9-4.9 4.9H6.9C3.4 22 2 20.6 2 17.1v-4.2C2 9.4 3.4 8 6.9 8h4.2c3.5 0 4.9 1.4 4.9 4.9Z"></path>
                                                        <path d="M8 8V6.9C8 3.4 9.4 2 12.9 2h4.2C20.6 2 22 3.4 22 6.9v4.2c0 3.5-1.4 4.9-4.9 4.9H16"></path>
                                                        <path d="M16 12.9C16 9.4 14.6 8 11.1 8"></path>
                                                    </svg>
                                                </button>
                                            </div>
                                    </div>
                                    <div class="p-4 gap-2 transition-all hover:-translate-y-1 rounded-xl bg-white/5 border border-white/10 hover:border-white/20 hover:bg-white/[0.07] flex flex-col">
                                        <div class="flex items-center gap-2"><strong class=text-sm>title</strong></div>
                                        <p class="text-sm text-gray-400">Controls whether the media title is displayed.
                                            <div class="inline-flex items-center justify-between h-fit gap-2 px-3 py-1.5 text-small rounded-medium bg-default/40 text-default-foreground max-w-full"><pre class="bg-transparent font-mono font-normal inline-block whitespace-nowrap text-xs text-wrap max-w-full line-clamp-1"><span class=select-none></span>title=false</pre>
                                                <button class="group inline-flex items-center justify-center box-border appearance-none select-none whitespace-nowrap font-normal subpixel-antialiased overflow-hidden tap-highlight-transparent data-[pressed=true]:scale-[0.97] outline-none data-[focus-visible=true]:z-10 data-[focus-visible=true]:outline-2 data-[focus-visible=true]:outline-focus data-[focus-visible=true]:outline-offset-2 gap-2 rounded-small px-0 !gap-0 transition-transform-colors-opacity motion-reduce:transition-none bg-transparent min-w-8 w-8 h-8 relative z-10 text-large text-inherit data-[hover=true]:bg-transparent"
                                                type=button aria-label="Copy to clipboard">
                                                    <svg aria-hidden=true fill=none focusable=false height=1em role=presentation stroke=currentColor stroke-linecap=round stroke-linejoin=round stroke-width=2 viewBox="0 0 24 24" width=1em class="absolute text-inherit opacity-0 scale-50 group-data-[copied=true]:opacity-100 group-data-[copied=true]:scale-100 transition-transform-opacity">
                                                        <polyline points="20 6 9 17 4 12"></polyline>
                                                    </svg>
                                                    <svg aria-hidden=true fill=none focusable=false height=1em role=presentation stroke=currentColor stroke-linecap=round stroke-linejoin=round stroke-width=1.5 viewBox="0 0 24 24" width=1em class="absolute text-inherit opacity-100 scale-100 group-data-[copied=true]:opacity-0 group-data-[copied=true]:scale-50 transition-transform-opacity">
                                                        <path d="M16 17.1c0 3.5-1.4 4.9-4.9 4.9H6.9C3.4 22 2 20.6 2 17.1v-4.2C2 9.4 3.4 8 6.9 8h4.2c3.5 0 4.9 1.4 4.9 4.9Z"></path>
                                                        <path d="M8 8V6.9C8 3.4 9.4 2 12.9 2h4.2C20.6 2 22 3.4 22 6.9v4.2c0 3.5-1.4 4.9-4.9 4.9H16"></path>
                                                        <path d="M16 12.9C16 9.4 14.6 8 11.1 8"></path>
                                                    </svg>
                                                </button>
                                            </div>
                                    </div>
                                    <div class="p-4 gap-2 transition-all hover:-translate-y-1 rounded-xl bg-white/5 border border-white/10 hover:border-white/20 hover:bg-white/[0.07] flex flex-col">
                                        <div class="flex items-center gap-2"><strong class=text-sm>poster</strong></div>
                                        <p class="text-sm text-gray-400">Determines if the poster image is shown.
                                            <div class="inline-flex items-center justify-between h-fit gap-2 px-3 py-1.5 text-small rounded-medium bg-default/40 text-default-foreground max-w-full"><pre class="bg-transparent font-mono font-normal inline-block whitespace-nowrap text-xs text-wrap max-w-full line-clamp-1"><span class=select-none></span>poster=true</pre>
                                                <button class="group inline-flex items-center justify-center box-border appearance-none select-none whitespace-nowrap font-normal subpixel-antialiased overflow-hidden tap-highlight-transparent data-[pressed=true]:scale-[0.97] outline-none data-[focus-visible=true]:z-10 data-[focus-visible=true]:outline-2 data-[focus-visible=true]:outline-focus data-[focus-visible=true]:outline-offset-2 gap-2 rounded-small px-0 !gap-0 transition-transform-colors-opacity motion-reduce:transition-none bg-transparent min-w-8 w-8 h-8 relative z-10 text-large text-inherit data-[hover=true]:bg-transparent"
                                                type=button aria-label="Copy to clipboard">
                                                    <svg aria-hidden=true fill=none focusable=false height=1em role=presentation stroke=currentColor stroke-linecap=round stroke-linejoin=round stroke-width=2 viewBox="0 0 24 24" width=1em class="absolute text-inherit opacity-0 scale-50 group-data-[copied=true]:opacity-100 group-data-[copied=true]:scale-100 transition-transform-opacity">
                                                        <polyline points="20 6 9 17 4 12"></polyline>
                                                    </svg>
                                                    <svg aria-hidden=true fill=none focusable=false height=1em role=presentation stroke=currentColor stroke-linecap=round stroke-linejoin=round stroke-width=1.5 viewBox="0 0 24 24" width=1em class="absolute text-inherit opacity-100 scale-100 group-data-[copied=true]:opacity-0 group-data-[copied=true]:scale-50 transition-transform-opacity">
                                                        <path d="M16 17.1c0 3.5-1.4 4.9-4.9 4.9H6.9C3.4 22 2 20.6 2 17.1v-4.2C2 9.4 3.4 8 6.9 8h4.2c3.5 0 4.9 1.4 4.9 4.9Z"></path>
                                                        <path d="M8 8V6.9C8 3.4 9.4 2 12.9 2h4.2C20.6 2 22 3.4 22 6.9v4.2c0 3.5-1.4 4.9-4.9 4.9H16"></path>
                                                        <path d="M16 12.9C16 9.4 14.6 8 11.1 8"></path>
                                                    </svg>
                                                </button>
                                            </div>
                                    </div>
                                    <div class="p-4 gap-2 transition-all hover:-translate-y-1 rounded-xl bg-white/5 border border-white/10 hover:border-white/20 hover:bg-white/[0.07] flex flex-col">
                                        <div class="flex items-center gap-2"><strong class=text-sm>autoplay</strong></div>
                                        <p class="text-sm text-gray-400">Controls whether the media starts playing automatically.
                                            <div class="inline-flex items-center justify-between h-fit gap-2 px-3 py-1.5 text-small rounded-medium bg-default/40 text-default-foreground max-w-full"><pre class="bg-transparent font-mono font-normal inline-block whitespace-nowrap text-xs text-wrap max-w-full line-clamp-1"><span class=select-none></span>autoplay=false</pre>
                                                <button class="group inline-flex items-center justify-center box-border appearance-none select-none whitespace-nowrap font-normal subpixel-antialiased overflow-hidden tap-highlight-transparent data-[pressed=true]:scale-[0.97] outline-none data-[focus-visible=true]:z-10 data-[focus-visible=true]:outline-2 data-[focus-visible=true]:outline-focus data-[focus-visible=true]:outline-offset-2 gap-2 rounded-small px-0 !gap-0 transition-transform-colors-opacity motion-reduce:transition-none bg-transparent min-w-8 w-8 h-8 relative z-10 text-large text-inherit data-[hover=true]:bg-transparent"
                                                type=button aria-label="Copy to clipboard">
                                                    <svg aria-hidden=true fill=none focusable=false height=1em role=presentation stroke=currentColor stroke-linecap=round stroke-linejoin=round stroke-width=2 viewBox="0 0 24 24" width=1em class="absolute text-inherit opacity-0 scale-50 group-data-[copied=true]:opacity-100 group-data-[copied=true]:scale-100 transition-transform-opacity">
                                                        <polyline points="20 6 9 17 4 12"></polyline>
                                                    </svg>
                                                    <svg aria-hidden=true fill=none focusable=false height=1em role=presentation stroke=currentColor stroke-linecap=round stroke-linejoin=round stroke-width=1.5 viewBox="0 0 24 24" width=1em class="absolute text-inherit opacity-100 scale-100 group-data-[copied=true]:opacity-0 group-data-[copied=true]:scale-50 transition-transform-opacity">
                                                        <path d="M16 17.1c0 3.5-1.4 4.9-4.9 4.9H6.9C3.4 22 2 20.6 2 17.1v-4.2C2 9.4 3.4 8 6.9 8h4.2c3.5 0 4.9 1.4 4.9 4.9Z"></path>
                                                        <path d="M8 8V6.9C8 3.4 9.4 2 12.9 2h4.2C20.6 2 22 3.4 22 6.9v4.2c0 3.5-1.4 4.9-4.9 4.9H16"></path>
                                                        <path d="M16 12.9C16 9.4 14.6 8 11.1 8"></path>
                                                    </svg>
                                                </button>
                                            </div>
                                    </div>
                                    <div class="p-4 gap-2 transition-all hover:-translate-y-1 rounded-xl bg-white/5 border border-white/10 hover:border-white/20 hover:bg-white/[0.07] flex flex-col">
                                        <div class="flex items-center gap-2"><strong class=text-sm>Next Episode button</strong></div>
                                        <p class="text-sm text-gray-400">Shows next episode button when 90% of the Tv-show is watched. OFF by default.
                                            <div class="inline-flex items-center justify-between h-fit gap-2 px-3 py-1.5 text-small rounded-medium bg-default/40 text-default-foreground max-w-full"><pre class="bg-transparent font-mono font-normal inline-block whitespace-nowrap text-xs text-wrap max-w-full line-clamp-1"><span class=select-none></span>nextbutton=true</pre>
                                                <button class="group inline-flex items-center justify-center box-border appearance-none select-none whitespace-nowrap font-normal subpixel-antialiased overflow-hidden tap-highlight-transparent data-[pressed=true]:scale-[0.97] outline-none data-[focus-visible=true]:z-10 data-[focus-visible=true]:outline-2 data-[focus-visible=true]:outline-focus data-[focus-visible=true]:outline-offset-2 gap-2 rounded-small px-0 !gap-0 transition-transform-colors-opacity motion-reduce:transition-none bg-transparent min-w-8 w-8 h-8 relative z-10 text-large text-inherit data-[hover=true]:bg-transparent"
                                                type=button aria-label="Copy to clipboard">
                                                    <svg aria-hidden=true fill=none focusable=false height=1em role=presentation stroke=currentColor stroke-linecap=round stroke-linejoin=round stroke-width=2 viewBox="0 0 24 24" width=1em class="absolute text-inherit opacity-0 scale-50 group-data-[copied=true]:opacity-100 group-data-[copied=true]:scale-100 transition-transform-opacity">
                                                        <polyline points="20 6 9 17 4 12"></polyline>
                                                    </svg>
                                                    <svg aria-hidden=true fill=none focusable=false height=1em role=presentation stroke=currentColor stroke-linecap=round stroke-linejoin=round stroke-width=1.5 viewBox="0 0 24 24" width=1em class="absolute text-inherit opacity-100 scale-100 group-data-[copied=true]:opacity-0 group-data-[copied=true]:scale-50 transition-transform-opacity">
                                                        <path d="M16 17.1c0 3.5-1.4 4.9-4.9 4.9H6.9C3.4 22 2 20.6 2 17.1v-4.2C2 9.4 3.4 8 6.9 8h4.2c3.5 0 4.9 1.4 4.9 4.9Z"></path>
                                                        <path d="M8 8V6.9C8 3.4 9.4 2 12.9 2h4.2C20.6 2 22 3.4 22 6.9v4.2c0 3.5-1.4 4.9-4.9 4.9H16"></path>
                                                        <path d="M16 12.9C16 9.4 14.6 8 11.1 8"></path>
                                                    </svg>
                                                </button>
                                            </div>
                                    </div>
                                    <div class="p-4 gap-2 transition-all hover:-translate-y-1 rounded-xl bg-white/5 border border-white/10 hover:border-white/20 hover:bg-white/[0.07] flex flex-col">
                                        <div class="flex items-center gap-2"><strong class=text-sm>Player type<span class="ml-2 px-2 py-0.5 text-xs text-black bg-green-500 rounded-md">New</span></strong></div>
                                        <p class="text-sm text-gray-400">Changes the player to JWPlayer or default player.
                                            <div class="inline-flex items-center justify-between h-fit gap-2 px-3 py-1.5 text-small rounded-medium bg-default/40 text-default-foreground max-w-full"><pre class="bg-transparent font-mono font-normal inline-block whitespace-nowrap text-xs text-wrap max-w-full line-clamp-1"><span class=select-none></span>player=jw</pre>
                                                <button class="group inline-flex items-center justify-center box-border appearance-none select-none whitespace-nowrap font-normal subpixel-antialiased overflow-hidden tap-highlight-transparent data-[pressed=true]:scale-[0.97] outline-none data-[focus-visible=true]:z-10 data-[focus-visible=true]:outline-2 data-[focus-visible=true]:outline-focus data-[focus-visible=true]:outline-offset-2 gap-2 rounded-small px-0 !gap-0 transition-transform-colors-opacity motion-reduce:transition-none bg-transparent min-w-8 w-8 h-8 relative z-10 text-large text-inherit data-[hover=true]:bg-transparent"
                                                type=button aria-label="Copy to clipboard">
                                                    <svg aria-hidden=true fill=none focusable=false height=1em role=presentation stroke=currentColor stroke-linecap=round stroke-linejoin=round stroke-width=2 viewBox="0 0 24 24" width=1em class="absolute text-inherit opacity-0 scale-50 group-data-[copied=true]:opacity-100 group-data-[copied=true]:scale-100 transition-transform-opacity">
                                                        <polyline points="20 6 9 17 4 12"></polyline>
                                                    </svg>
                                                    <svg aria-hidden=true fill=none focusable=false height=1em role=presentation stroke=currentColor stroke-linecap=round stroke-linejoin=round stroke-width=1.5 viewBox="0 0 24 24" width=1em class="absolute text-inherit opacity-100 scale-100 group-data-[copied=true]:opacity-0 group-data-[copied=true]:scale-50 transition-transform-opacity">
                                                        <path d="M16 17.1c0 3.5-1.4 4.9-4.9 4.9H6.9C3.4 22 2 20.6 2 17.1v-4.2C2 9.4 3.4 8 6.9 8h4.2c3.5 0 4.9 1.4 4.9 4.9Z"></path>
                                                        <path d="M8 8V6.9C8 3.4 9.4 2 12.9 2h4.2C20.6 2 22 3.4 22 6.9v4.2c0 3.5-1.4 4.9-4.9 4.9H16"></path>
                                                        <path d="M16 12.9C16 9.4 14.6 8 11.1 8"></path>
                                                    </svg>
                                                </button>
                                            </div>
                                    </div>
                                    <div class="p-4 gap-2 transition-all hover:-translate-y-1 rounded-xl bg-white/5 border border-white/10 hover:border-white/20 hover:bg-white/[0.07] flex flex-col">
                                        <div class="flex items-center gap-2"><strong class=text-sm>startAt<span class="ml-2 px-2 py-0.5 text-xs text-black bg-green-500 rounded-md">New</span></strong></div>
                                        <p class="text-sm text-gray-400">Starts the video at the specified time in seconds. This parameter cannot replace saved progress but can be used for cross-device watch progress. remove cookies and cache after each test for the same content.
                                            <div
                                            class="inline-flex items-center justify-between h-fit gap-2 px-3 py-1.5 text-small rounded-medium bg-default/40 text-default-foreground max-w-full"><pre class="bg-transparent font-mono font-normal inline-block whitespace-nowrap text-xs text-wrap max-w-full line-clamp-1"><span class=select-none></span>startAt=60</pre>
                                                <button class="group inline-flex items-center justify-center box-border appearance-none select-none whitespace-nowrap font-normal subpixel-antialiased overflow-hidden tap-highlight-transparent data-[pressed=true]:scale-[0.97] outline-none data-[focus-visible=true]:z-10 data-[focus-visible=true]:outline-2 data-[focus-visible=true]:outline-focus data-[focus-visible=true]:outline-offset-2 gap-2 rounded-small px-0 !gap-0 transition-transform-colors-opacity motion-reduce:transition-none bg-transparent min-w-8 w-8 h-8 relative z-10 text-large text-inherit data-[hover=true]:bg-transparent"
                                                type=button aria-label="Copy to clipboard">
                                                    <svg aria-hidden=true fill=none focusable=false height=1em role=presentation stroke=currentColor stroke-linecap=round stroke-linejoin=round stroke-width=2 viewBox="0 0 24 24" width=1em class="absolute text-inherit opacity-0 scale-50 group-data-[copied=true]:opacity-100 group-data-[copied=true]:scale-100 transition-transform-opacity">
                                                        <polyline points="20 6 9 17 4 12"></polyline>
                                                    </svg>
                                                    <svg aria-hidden=true fill=none focusable=false height=1em role=presentation stroke=currentColor stroke-linecap=round stroke-linejoin=round stroke-width=1.5 viewBox="0 0 24 24" width=1em class="absolute text-inherit opacity-100 scale-100 group-data-[copied=true]:opacity-0 group-data-[copied=true]:scale-50 transition-transform-opacity">
                                                        <path d="M16 17.1c0 3.5-1.4 4.9-4.9 4.9H6.9C3.4 22 2 20.6 2 17.1v-4.2C2 9.4 3.4 8 6.9 8h4.2c3.5 0 4.9 1.4 4.9 4.9Z"></path>
                                                        <path d="M8 8V6.9C8 3.4 9.4 2 12.9 2h4.2C20.6 2 22 3.4 22 6.9v4.2c0 3.5-1.4 4.9-4.9 4.9H16"></path>
                                                        <path d="M16 12.9C16 9.4 14.6 8 11.1 8"></path>
                                                    </svg>
                                                </button>
                                    </div>
                            </div>
                            <div class="p-4 gap-2 transition-all hover:-translate-y-1 rounded-xl bg-white/5 border border-white/10 hover:border-white/20 hover:bg-white/[0.07] flex flex-col">
                                <div class="flex items-center gap-2"><strong class=text-sm>sub_file<span class="ml-2 px-2 py-0.5 text-xs text-black bg-green-500 rounded-md">New</span></strong></div>
                                <p class="text-sm text-gray-400">Adds external subtitles to the video. Must be a direct link to a VTT subtitle file.
                                    <div class="inline-flex items-center justify-between h-fit gap-2 px-3 py-1.5 text-small rounded-medium bg-default/40 text-default-foreground max-w-full"><pre class="bg-transparent font-mono font-normal inline-block whitespace-nowrap text-xs text-wrap max-w-full line-clamp-1"><span class=select-none></span>sub_file=https://example.com/subtitles.vtt</pre>
                                        <button class="group inline-flex items-center justify-center box-border appearance-none select-none whitespace-nowrap font-normal subpixel-antialiased overflow-hidden tap-highlight-transparent data-[pressed=true]:scale-[0.97] outline-none data-[focus-visible=true]:z-10 data-[focus-visible=true]:outline-2 data-[focus-visible=true]:outline-focus data-[focus-visible=true]:outline-offset-2 gap-2 rounded-small px-0 !gap-0 transition-transform-colors-opacity motion-reduce:transition-none bg-transparent min-w-8 w-8 h-8 relative z-10 text-large text-inherit data-[hover=true]:bg-transparent"
                                        type=button aria-label="Copy to clipboard">
                                            <svg aria-hidden=true fill=none focusable=false height=1em role=presentation stroke=currentColor stroke-linecap=round stroke-linejoin=round stroke-width=2 viewBox="0 0 24 24" width=1em class="absolute text-inherit opacity-0 scale-50 group-data-[copied=true]:opacity-100 group-data-[copied=true]:scale-100 transition-transform-opacity">
                                                <polyline points="20 6 9 17 4 12"></polyline>
                                            </svg>
                                            <svg aria-hidden=true fill=none focusable=false height=1em role=presentation stroke=currentColor stroke-linecap=round stroke-linejoin=round stroke-width=1.5 viewBox="0 0 24 24" width=1em class="absolute text-inherit opacity-100 scale-100 group-data-[copied=true]:opacity-0 group-data-[copied=true]:scale-50 transition-transform-opacity">
                                                <path d="M16 17.1c0 3.5-1.4 4.9-4.9 4.9H6.9C3.4 22 2 20.6 2 17.1v-4.2C2 9.4 3.4 8 6.9 8h4.2c3.5 0 4.9 1.4 4.9 4.9Z"></path>
                                                <path d="M8 8V6.9C8 3.4 9.4 2 12.9 2h4.2C20.6 2 22 3.4 22 6.9v4.2c0 3.5-1.4 4.9-4.9 4.9H16"></path>
                                                <path d="M16 12.9C16 9.4 14.6 8 11.1 8"></path>
                                            </svg>
                                        </button>
                                    </div>
                            </div>
                            <div class="p-4 gap-2 transition-all hover:-translate-y-1 rounded-xl bg-white/5 border border-white/10 hover:border-white/20 hover:bg-white/[0.07] flex flex-col">
                                <div class="flex items-center gap-2"><strong class=text-sm>sub_label<span class="ml-2 px-2 py-0.5 text-xs text-black bg-green-500 rounded-md">New</span></strong></div>
                                <p class="text-sm text-gray-400">Sets the label for the external subtitle track. If not provided, defaults to 'External Subtitle'.
                                    <div class="inline-flex items-center justify-between h-fit gap-2 px-3 py-1.5 text-small rounded-medium bg-default/40 text-default-foreground max-w-full"><pre class="bg-transparent font-mono font-normal inline-block whitespace-nowrap text-xs text-wrap max-w-full line-clamp-1"><span class=select-none></span>sub_label=English</pre>
                                        <button class="group inline-flex items-center justify-center box-border appearance-none select-none whitespace-nowrap font-normal subpixel-antialiased overflow-hidden tap-highlight-transparent data-[pressed=true]:scale-[0.97] outline-none data-[focus-visible=true]:z-10 data-[focus-visible=true]:outline-2 data-[focus-visible=true]:outline-focus data-[focus-visible=true]:outline-offset-2 gap-2 rounded-small px-0 !gap-0 transition-transform-colors-opacity motion-reduce:transition-none bg-transparent min-w-8 w-8 h-8 relative z-10 text-large text-inherit data-[hover=true]:bg-transparent"
                                        type=button aria-label="Copy to clipboard">
                                            <svg aria-hidden=true fill=none focusable=false height=1em role=presentation stroke=currentColor stroke-linecap=round stroke-linejoin=round stroke-width=2 viewBox="0 0 24 24" width=1em class="absolute text-inherit opacity-0 scale-50 group-data-[copied=true]:opacity-100 group-data-[copied=true]:scale-100 transition-transform-opacity">
                                                <polyline points="20 6 9 17 4 12"></polyline>
                                            </svg>
                                            <svg aria-hidden=true fill=none focusable=false height=1em role=presentation stroke=currentColor stroke-linecap=round stroke-linejoin=round stroke-width=1.5 viewBox="0 0 24 24" width=1em class="absolute text-inherit opacity-100 scale-100 group-data-[copied=true]:opacity-0 group-data-[copied=true]:scale-50 transition-transform-opacity">
                                                <path d="M16 17.1c0 3.5-1.4 4.9-4.9 4.9H6.9C3.4 22 2 20.6 2 17.1v-4.2C2 9.4 3.4 8 6.9 8h4.2c3.5 0 4.9 1.4 4.9 4.9Z"></path>
                                                <path d="M8 8V6.9C8 3.4 9.4 2 12.9 2h4.2C20.6 2 22 3.4 22 6.9v4.2c0 3.5-1.4 4.9-4.9 4.9H16"></path>
                                                <path d="M16 12.9C16 9.4 14.6 8 11.1 8"></path>
                                            </svg>
                                        </button>
                                    </div>
                            </div>
                        </div>
                    </div>
                    <section id=watchProgress class="mt-8 space-y-4">
                        <div class="flex items-center gap-4">
                            <h2 class="text-2xl font-semibold">Watch Progress</h2>
                            <div class="flex-1 h-px bg-gradient-to-r from-white/20 to-transparent"></div>
                        </div>
                        <div class="p-6 border rounded-xl bg-white/5 backdrop-blur-sm border-white/10">
                            <div class=space-y-4>
                                <div class="flex items-center gap-3">
                                    <div class="p-2 rounded-lg bg-blue-500/10">
                                        <svg xmlns=http://www.w3.org/2000/svg width=24 height=24 viewBox="0 0 24 24" fill=none stroke=currentColor stroke-width=2 stroke-linecap=round stroke-linejoin=round class="lucide lucide-history w-5 h-5 text-blue-500">
                                            <path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"></path>
                                            <path d="M3 3v5h5"></path>
                                            <path d="M12 7v5l4 2"></path>
                                        </svg>
                                    </div>
                                    <h3 class="text-lg font-medium">Continue Watching Feature</h3></div>
                                <p class="text-sm leading-relaxed text-gray-400">Track your users' watch progress across movies and TV shows. This feature enables "Continue Watching" functionality on your website.</p>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 gap-4 lg:grid-cols-2">
                            <div class="p-6 border rounded-xl bg-white/5 backdrop-blur-sm border-white/10">
                                <div class=space-y-4>
                                    <div class="flex items-center gap-3">
                                        <div class="flex items-center justify-center w-6 h-6 text-sm font-medium text-purple-500 rounded-full bg-purple-500/10">1</div>
                                        <h3 class=font-medium>Add Event Listener</h3></div>
                                    <p class="text-sm text-gray-400">Add this script where your iframe is located. For React/Next.js applications, place it in a useEffect hook.
                                        <div class=relative>
                                            <div class="absolute rounded-lg -inset-1 bg-gradient-to-r from-purple-500/20 to-blue-500/20 blur-sm"></div>
                                            <div class="relative p-4 rounded-lg bg-black/40">
                                                <div class="flex items-center justify-between mb-2">
                                                    <p class="text-xs text-gray-400">Script</p>
                                                    <button class="flex items-center gap-1 text-xs text-gray-400 transition-colors hover:text-white">
                                                        <svg xmlns=http://www.w3.org/2000/svg width=24 height=24 viewBox="0 0 24 24" fill=none stroke=currentColor stroke-width=2 stroke-linecap=round stroke-linejoin=round class="lucide lucide-copy w-3 h-3">
                                                            <rect width=14 height=14 x=8 y=8 rx=2 ry=2></rect>
                                                            <path d="M4 16c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2h10c1.1 0 2 .9 2 2"></path>
                                                        </svg>Copy</button>
                                                </div>
                                                <div class=overflow-x-auto><code class="block font-mono text-sm break-all whitespace-pre-wrap text-white/90">window.addEventListener('message', (event) =&gt; {
  if (event.origin !== 'https://vidlink.pro') return;
  
  if (event.data?.type === 'MEDIA_DATA') {
    const mediaData = event.data.data;
    localStorage.setItem('vidLinkProgress', JSON.stringify(mediaData));
  }
});</code></div>
                                            </div>
                                        </div>
                                </div>
                            </div>
                            <div class="p-6 border rounded-xl bg-white/5 backdrop-blur-sm border-white/10">
                                <div class=space-y-4>
                                    <div class="flex items-center gap-3">
                                        <div class="flex items-center justify-center w-6 h-6 text-sm font-medium rounded-full bg-emerald-500/10 text-emerald-500">2</div>
                                        <h3 class=font-medium>Stored Data Structure</h3></div>
                                    <div class=space-y-2>
                                        <p class="text-sm text-gray-400">The data is stored in localStorage and contains:
                                            <ul class="ml-4 space-y-2 text-sm text-gray-400 list-disc list-inside">
                                                <li>Movie/Show details (title, poster, etc.)
                                                    <li>Watch progress (time watched, duration)
                                                        <li>Last watched episode for TV shows
                                                            <li>Episode-specific progress for shows</ul>
                                    </div>
                                    <div class=relative>
                                        <div class="absolute rounded-lg -inset-1 bg-gradient-to-r from-emerald-500/20 to-teal-500/20 blur-sm"></div>
                                        <div class="relative p-4 rounded-lg bg-black/40">
                                            <div class="flex items-center justify-between mb-2">
                                                <p class="text-xs text-gray-400">Example Data Structure</p>
                                                <button class="flex items-center gap-1 text-xs text-gray-400 transition-colors hover:text-white">
                                                    <svg xmlns=http://www.w3.org/2000/svg width=24 height=24 viewBox="0 0 24 24" fill=none stroke=currentColor stroke-width=2 stroke-linecap=round stroke-linejoin=round class="lucide lucide-copy w-3 h-3">
                                                        <rect width=14 height=14 x=8 y=8 rx=2 ry=2></rect>
                                                        <path d="M4 16c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2h10c1.1 0 2 .9 2 2"></path>
                                                    </svg>Copy</button>
                                            </div>
                                            <div class=overflow-x-auto><code class="block font-mono text-sm break-all whitespace-pre-wrap text-white/90">{
  "76479": {
    "id": 76479,
    "type": "tv",
    "title": "The Boys",
    "poster_path": "/2zmTngn1tYC1AvfnrFLhxeD82hz.jpg",
    "progress": {
      "watched": 31.435372,
      "duration": 3609.867
    },
    "last_season_watched": "1",
    "last_episode_watched": "1",
    "show_progress": {
      "s1e1": {
        "season": "1",
        "episode": "1",
        "progress": {
          "watched": 31.435372,
          "duration": 3609.867
        }
      }
    }
  },
  "786892": {
    "id": 786892,
    "type": "movie",
    "title": "Furiosa: A Mad Max Saga",
    "poster_path": "/iADOJ8Zymht2JPMoy3R7xceZprc.jpg",
    "backdrop_path": "/wNAhuOZ3Zf84jCIlrcI6JhgmY5q.jpg",
    "progress": {
      "watched": 8726.904767,
      "duration": 8891.763
    },
    "last_updated": 1725723972695
  }
}
</code></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section id=playerEvents class="mt-8 space-y-4">
                        <div class="flex items-center gap-4">
                            <h2 class="text-2xl font-semibold">Player Events</h2><span class="px-2 py-0.5 text-xs text-black bg-green-500 rounded-md">New</span>
                            <div class="flex-1 h-px bg-gradient-to-r from-white/20 to-transparent"></div>
                        </div>
                        <div class="p-6 border rounded-xl bg-white/5 backdrop-blur-sm border-white/10">
                            <div class=space-y-4>
                                <div class="flex items-center gap-3">
                                    <div class="p-2 rounded-lg bg-violet-500/10">
                                        <svg xmlns=http://www.w3.org/2000/svg width=24 height=24 viewBox="0 0 24 24" fill=none stroke=currentColor stroke-width=2 stroke-linecap=round stroke-linejoin=round class="lucide lucide-radio w-5 h-5 text-violet-500">
                                            <path d="M4.9 19.1C1 15.2 1 8.8 4.9 4.9"></path>
                                            <path d="M7.8 16.2c-2.3-2.3-2.3-6.1 0-8.5"></path>
                                            <circle cx=12 cy=12 r=2></circle>
                                            <path d="M16.2 7.8c2.3 2.3 2.3 6.1 0 8.5"></path>
                                            <path d="M19.1 4.9C23 8.8 23 15.1 19.1 19"></path>
                                        </svg>
                                    </div>
                                    <h3 class="text-lg font-medium">Player Event Tracking</h3></div>
                                <p class="text-sm leading-relaxed text-gray-400">Listen to player events to track user interactions and video playback states. Events are sent via postMessage to the parent window.</p>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 gap-4 lg:grid-cols-2">
                            <div class="p-6 border rounded-xl bg-white/5 backdrop-blur-sm border-white/10">
                                <div class=space-y-4>
                                    <div class="flex items-center gap-3">
                                        <div class="p-2 rounded-lg bg-amber-500/10">
                                            <svg xmlns=http://www.w3.org/2000/svg width=24 height=24 viewBox="0 0 24 24" fill=none stroke=currentColor stroke-width=2 stroke-linecap=round stroke-linejoin=round class="lucide lucide-list-checks w-5 h-5 text-amber-500">
                                                <path d="m3 17 2 2 4-4"></path>
                                                <path d="m3 7 2 2 4-4"></path>
                                                <path d="M13 6h8"></path>
                                                <path d="M13 12h8"></path>
                                                <path d="M13 18h8"></path>
                                            </svg>
                                        </div>
                                        <h3 class=font-medium>Available Events</h3></div>
                                    <div class=space-y-3>
                                        <div class="p-3 rounded-lg bg-black/20">
                                            <div class="flex items-center gap-2"><span class="px-2 py-0.5 text-xs font-mono bg-white/10 rounded-md">play</span><span class="text-sm text-gray-400">Triggered when video starts playing</span></div>
                                        </div>
                                        <div class="p-3 rounded-lg bg-black/20">
                                            <div class="flex items-center gap-2"><span class="px-2 py-0.5 text-xs font-mono bg-white/10 rounded-md">pause</span><span class="text-sm text-gray-400">Triggered when video is paused</span></div>
                                        </div>
                                        <div class="p-3 rounded-lg bg-black/20">
                                            <div class="flex items-center gap-2"><span class="px-2 py-0.5 text-xs font-mono bg-white/10 rounded-md">seeked</span><span class="text-sm text-gray-400">Triggered when user seeks to a different timestamp</span></div>
                                        </div>
                                        <div class="p-3 rounded-lg bg-black/20">
                                            <div class="flex items-center gap-2"><span class="px-2 py-0.5 text-xs font-mono bg-white/10 rounded-md">ended</span><span class="text-sm text-gray-400">Triggered when video playback ends</span></div>
                                        </div>
                                        <div class="p-3 rounded-lg bg-black/20">
                                            <div class="flex items-center gap-2"><span class="px-2 py-0.5 text-xs font-mono bg-white/10 rounded-md">timeupdate</span><span class="text-sm text-gray-400">Triggered periodically during playback</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="p-6 border rounded-xl bg-white/5 backdrop-blur-sm border-white/10">
                                <div class=space-y-4>
                                    <div class="flex items-center gap-3">
                                        <div class="p-2 rounded-lg bg-blue-500/10">
                                            <svg xmlns=http://www.w3.org/2000/svg width=24 height=24 viewBox="0 0 24 24" fill=none stroke=currentColor stroke-width=2 stroke-linecap=round stroke-linejoin=round class="lucide lucide-file-json w-5 h-5 text-blue-500">
                                                <path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"></path>
                                                <path d="M14 2v4a2 2 0 0 0 2 2h4"></path>
                                                <path d="M10 12a1 1 0 0 0-1 1v1a1 1 0 0 1-1 1 1 1 0 0 1 1 1v1a1 1 0 0 0 1 1"></path>
                                                <path d="M14 18a1 1 0 0 0 1-1v-1a1 1 0 0 1 1-1 1 1 0 0 1-1-1v-1a1 1 0 0 0-1-1"></path>
                                            </svg>
                                        </div>
                                        <h3 class=font-medium>Event Data Structure</h3></div>
                                    <div class=relative>
                                        <div class="absolute rounded-lg -inset-1 bg-gradient-to-r from-blue-500/20 to-purple-500/20 blur-sm"></div>
                                        <div class="relative p-4 rounded-lg bg-black/40">
                                            <div class="flex items-center justify-between mb-2">
                                                <p class="text-xs text-gray-400">Event Object</p>
                                                <button class="flex items-center gap-1 text-xs text-gray-400 transition-colors hover:text-white">
                                                    <svg xmlns=http://www.w3.org/2000/svg width=24 height=24 viewBox="0 0 24 24" fill=none stroke=currentColor stroke-width=2 stroke-linecap=round stroke-linejoin=round class="lucide lucide-copy w-3 h-3">
                                                        <rect width=14 height=14 x=8 y=8 rx=2 ry=2></rect>
                                                        <path d="M4 16c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2h10c1.1 0 2 .9 2 2"></path>
                                                    </svg>Copy</button>
                                            </div>
                                            <div class=overflow-x-auto><code class="block font-mono text-sm break-all whitespace-pre-wrap text-white/90">{
  type: "PLAYER_EVENT",
  data: {
    event: "play" | "pause" | "seeked" | "ended" | "timeupdate",
    currentTime: number,
    duration: number,
    mtmdbId: number,
    mediaType: "movie" | "tv",
    season?: number,
    episode?: number
  }
}</code></div>
                                        </div>
                                    </div>
                                    <div class=mt-4>
                                        <h4 class="mb-2 text-sm font-medium text-gray-300">Implementation Example</h4>
                                        <div class=relative>
                                            <div class="absolute rounded-lg -inset-1 bg-gradient-to-r from-blue-500/20 to-purple-500/20 blur-sm"></div>
                                            <div class="relative p-4 rounded-lg bg-black/40"><code class="block font-mono text-sm break-all whitespace-pre-wrap text-white/90">window.addEventListener('message', (event) =&gt; {
  if (event.origin !== 'https://vidlink.pro') return;
  
  if (event.data?.type === 'PLAYER_EVENT') {
    const { event: eventType, currentTime, duration } = event.data.data;
    // Handle the event
    console.log(`Player ${eventType} at ${currentTime}s of ${duration}s`);
  }
});</code></div>
                                        </div>

                        </div>
                    </div>
                </div>
                </main>
         </div>
      </div>
    </div>
                </div>
            </div>
        </div>
    </div>
