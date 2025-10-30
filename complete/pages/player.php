<div class="w-full max-w-[70rem] mx-auto transition-all duration-200 p-4 bg-transparent border border-transparent rounded-xl justify-between items-center" style="margin-top: 100px;">
    <div class="flex flex-col items-center justify-center w-full">
        <div class="flex max-w-[70rem] flex-col items-center w-full h-full min-h-screen gap-2 p-4">
            <main id="PlayerTester" class="flex max-w-[70rem] flex-col items-center w-full h-full min-h-screen gap-2 p-4 bg-gray-900 text-white">
                <div class="flex p-1 h-fit gap-2 items-center flex-nowrap overflow-x-scroll scrollbar-hide bg-black/20 rounded-full new">
                    <button id="tab-movie" class="tab-button group" data-selected="true">
                        <span class="cursor-pill"></span>
                        <span class="relative z-10">Movie Player</span>
                    </button>
                    <button id="tab-tv" class="tab-button group">
                        <span class="cursor-pill"></span>
                        <span class="relative z-10">Series Player</span>
                    </button>
                    <button id="tab-anime" class="tab-button group">
                        <span class="cursor-pill"></span>
                        <span class="relative z-10">Anime Player</span>
                    </button>
                </div>

                <div class="w-full py-3 px-1">
                    <div id="content-movie" class="tab-content">
                        <div class="input-container">
                            <input id="movie-tmdb" type="text" class="input-field" value="94997" placeholder=" ">
                            <label for="movie-tmdb" class="input-label">Tmdb</label>
                        </div>
                    </div>

                    <div id="content-tv" class="tab-content">
                        <div class="fields-wrapper">
                            <div class="input-container flex-grow">
                                <input id="tv-tmdb" type="text" class="input-field" value="94997" placeholder=" ">
                                <label for="tv-tmdb" class="input-label">Tmdb</label>
                            </div>
                            <div class="input-container small-input">
                                <input id="tv-season" type="number" class="input-field" value="1" placeholder=" ">
                                <label for="tv-season" class="input-label">S</label>
                            </div>
                            <div class="input-container small-input">
                                <input id="tv-episode" type="number" class="input-field" value="1" placeholder=" ">
                                <label for="tv-episode" class="input-label">E</label>
                            </div>
                        </div>
                    </div>

                    <div id="content-anime" class="tab-content">
                        <div class="fields-wrapper">
                            <div class="input-container flex-grow">
                                <input id="anime-id" type="text" class="input-field" value="40748" placeholder=" ">
                                <label for="anime-id" class="input-label">Mal Id</label>
                            </div>
                            <div class="input-container small-input">
                                <input id="anime-episode" type="number" class="input-field" value="1" placeholder=" ">
                                <label for="anime-episode" class="input-label">E</label>
                            </div>
                            <button id="anime-dub" class="dub-button" data-active="false">DUB</button>
                            <label for="anime-fallback" class="flex items-center gap-2 cursor-pointer">
                                <div class="relative">
                                    <input type="checkbox" id="anime-fallback" class="sr-only peer">
                                    <div class="w-10 h-6 bg-gray-600 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                                </div>
                                <span class="text-sm">Fallback</span>
                            </label>
                        </div>
                    </div>

                    <div class="inline-flex justify-between h-fit gap-2 px-3 py-1.5 rounded-lg items-center w-full text-xs text-white/80 bg-white/10" style="margin-top: 20px;">
                        <pre id="video-url" class="font-mono w-full overflow-x-auto scrollbar-hide">https://vidlink.pro/movie/786892</pre>
                        <button id="copy-button" class="group relative w-8 h-8 flex items-center justify-center" aria-label="Copy this Link">
                            <svg aria-hidden="true" fill="none" height="1.2em" width="1.2em" role="presentation" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="absolute text-green-400 opacity-0 scale-50 group-data-[copied=true]:opacity-100 group-data-[copied=true]:scale-100 transition-transform-opacity">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                            <svg aria-hidden="true" fill="none" height="1.2em" width="1.2em" role="presentation" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24" class="absolute text-inherit opacity-100 scale-100 group-data-[copied=true]:opacity-0 group-data-[copied=true]:scale-50 transition-transform-opacity">
                                <path d="M16 17.1c0 3.5-1.4 4.9-4.9 4.9H6.9C3.4 22 2 20.6 2 17.1v-4.2C2 9.4 3.4 8 6.9 8h4.2c3.5 0 4.9 1.4 4.9 4.9Z"></path>
                                <path d="M22 6.9v4.2c0 3.5-1.4 4.9-4.9 4.9H16v-2.1c0-3.5-1.4-4.9-4.9-4.9H6.9V8h4.2C14.6 8 16 9.4 16 12.9v4.2h1.1c3.5 0 4.9-1.4 4.9-4.9V6.9C22 3.4 20.6 2 17.1 2h-4.2C9.4 2 8 3.4 8 6.9V8h2.1c3.5 0 4.9 1.4 4.9 4.9v2.1h1.1c3.5 0 4.9-1.4 4.9-4.9z"></path>
                            </svg>
                        </button>
                    </div>

                    <div class="w-full h-80 md:h-[40rem] mt-4">
                        <div class="w-full h-full overflow-hidden bg-black rounded-2xl border border-white/10">
                            <iframe id="video-iframe" allowfullscreen class="w-full h-full" src="https://vidlink.pro/movie/786892?autoplay=false"></iframe>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</div>
