<div class="anchor" id="works"></div>
<section class="bg-gray-100 py-8 pb-12 border-b" id="features-section">
    
    <h2 class="w-full my-2 text-5xl font-bold leading-tight text-center text-gray-800">
        How does it work?
    </h2>
    <div class="w-full mb-4">
        <div class="h-1 mx-auto gradient w-64 opacity-25 my-0 py-0 rounded-t"></div>
    </div>
    <div class="flex justify-center">
    <div class="dashboard-container">
        @include('partials.setup-form')
        @include('partials.maging-table', ['showOcr' => true, 'streamHeight' => 180])
    </div>
    <div class="pl-8 pt-16 max-w-xs">
        <ul class="space-y-6 text-gray-700 text-lg">
            <li>
                <span class="font-bold text-gray-900 block">OCR Vision</span>
                Reads your game interface in real-time
            </li>
            <li>
                <span class="font-bold text-gray-900 block">Mouse Control</span>
                Interacts with the game using the mouse
            </li>
            <li>
                <span class="font-bold text-gray-900 block">Smart AI</span>
                Picks the optimal rune to maximize profit
            </li>
        </ul>
    </div>
    </div>
</section>

<div class="anchor" id="features"></div>
<section class="bg-white py-8 pb-12 border-b" id="features-section">

    <h2 class="w-full my-2 text-5xl font-bold leading-tight text-center text-gray-800">
        {{ __('features.heading') }}
    </h2>
    <div class="w-full mb-4">
        <div class="h-1 mx-auto gradient w-64 opacity-25 my-0 py-0 rounded-t"></div>
    </div>

    <style>
        .sf-annotated { position: relative; flex-shrink: 0; }
        .sf-popup {
            position: absolute;
            width: 155px;
            background: #ffffff;
            border: 1px solid #e3e8ef;
            border-radius: 8px;
            padding: 10px 12px 11px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.07), 0 1px 4px rgba(0,0,0,0.05);
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            z-index: 10;
            pointer-events: auto;
            cursor: default;
            transition: border-color 0.25s ease, box-shadow 0.25s ease;
        }
        .sf-popup__label {
            font-size: 9px;
            font-weight: 700;
            color: #0a2540;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            margin-bottom: 5px;
            transition: color 0.25s ease;
        }
        .sf-popup__desc {
            font-size: 10px;
            color: #425466;
            line-height: 1.45;
            margin: 0 0 6px 0;
        }
        .sf-popup__example {
            font-size: 9px;
            color: #697386;
            font-style: italic;
            line-height: 1.4;
            margin: 0;
            border-left: 2px solid #e3e8ef;
            padding-left: 6px;
        }
        .sf-popup--top    { top: -20px;                           right: -170px; }
        .sf-popup--center { top: 50%; transform: translateY(-50%); right: -170px; }
        .sf-popup--bottom { bottom: -20px;                         right: -170px; }
        .sf-popup--left   { right: auto; left: -170px; }

        /* ── column / popup hover highlight ── */
        .sf-popup.hl-active {
            border-color: #8FD838;
            box-shadow: 0 4px 20px rgba(143,216,56,0.2), 0 0 0 3px rgba(143,216,56,0.1), 0 1px 4px rgba(0,0,0,0.05);
        }
        .sf-popup.hl-active .sf-popup__label { color: #3a6a10; }

        #sf-annotated-wrapper .setup-window th,
        #sf-annotated-wrapper .setup-window td,
        #sf-annotated-wrapper .config-window th,
        #sf-annotated-wrapper .config-window td {
            transition: background-color 0.25s ease, color 0.25s ease;
        }
        #sf-annotated-wrapper .setup-window th.hl-active,
        #sf-annotated-wrapper .config-window th.hl-active {
            background-color: rgba(143, 216, 56, 0.25) !important;
            color: #c8ef70 !important;
        }
        #sf-annotated-wrapper .setup-window td.hl-active,
        #sf-annotated-wrapper .config-window td.hl-active {
            background-color: rgba(143, 216, 56, 0.08) !important;
        }
        .config-window .file-picker  { transition: background-color 0.25s ease; border-radius: 2px; outline: 1px solid transparent; }
        .config-window .footer-right { transition: background-color 0.25s ease; border-radius: 2px; outline: 1px solid transparent; }
        .config-window .file-picker.hl-active,
        .config-window .footer-right.hl-active {
            background-color: rgba(143, 216, 56, 0.1);
            outline-color: rgba(143, 216, 56, 0.4);
        }
        .queue-window .queue-item { transition: background-color 0.25s ease; }
        .queue-window .queue-item.hl-active {
            background-color: rgba(143, 216, 56, 0.07);
            box-shadow: inset 2px 0 0 rgba(143, 216, 56, 0.4);
        }

        /* ── mobile / small-screen: stack forms vertically ── */
        @media (max-width: 1500px) {
            #sf-annotated-wrapper {
                flex-direction: column !important;
                align-items: center !important;
                gap: 60px !important;
                margin: 60px auto !important;
            }

            /* Shared reset — clear desktop bottom/transform offsets */
            .sf-popup { bottom: auto !important; transform: none !important; opacity: 0.85; }

            /* setup-form: one per vertical third, alternating sides */
            .sf-popup[data-hl="sf-cible"]    { top: 15% !important; left: auto !important; right: 10px !important; }
            .sf-popup[data-hl="sf-priorite"] { top: 47% !important; left: 10px !important; right: auto !important; }
            .sf-popup[data-hl="sf-minimum"]  { top: 75% !important; left: auto !important; right: 10px !important; }

            /* config-form: two in top third, one middle, two in bottom third */
            .sf-popup[data-hl="cf-use-runes"]  { top:  8% !important; left: auto !important; right: 10px !important; }
            .sf-popup[data-hl="cf-max-rune"]   { top: 24% !important; left: 10px !important; right: auto !important; }
            .sf-popup[data-hl="cf-threshold"]  { top: 47% !important; left: auto !important; right: 10px !important; }
            .sf-popup[data-hl="cf-script"]     { top: 65% !important; left: 10px !important; right: auto !important; }
            .sf-popup[data-hl="cf-presets"]    { top: 81% !important; left: auto !important; right: 10px !important; }

            /* queue-form: single popup in the middle */
            .sf-popup[data-hl="qf-queue"] { top: 40% !important; left: 10px !important; right: auto !important; }
        }
    </style>

    <div id="sf-annotated-wrapper" class="flex justify-around items-center" style="gap: 120px; margin: 120px 0;">
        <div class="sf-annotated" style="--sw-scale: 1.2;">
            @include('partials.setup-form')

            <div class="sf-popup" data-hl="sf-cible" style="top: -100px; left: 150px;">
                <div class="sf-popup__label">Cible</div>
                <p class="sf-popup__desc">The stat value you'd ideally like to reach when maging.</p>
                <p class="sf-popup__example">"I'd like to reach 250 Vitalité if possible."</p>
            </div>

            <div class="sf-popup" data-hl="sf-priorite" style="top: 50px; right: -130px;">
                <div class="sf-popup__label">Priorité</div>
                <p class="sf-popup__desc">When reliquat sink is available, higher-priority stats are improved first.</p>
                <p class="sf-popup__example">"Vitalité will be prioritized first, then % Résistance Neutre, etc."</p>
            </div>

            <div class="sf-popup" data-hl="sf-minimum" style="bottom: -70px; left: 330px;">
                <div class="sf-popup__label">Minimum</div>
                <p class="sf-popup__desc">A hard floor — the bot will never accept a value below this.</p>
                <p class="sf-popup__example">"I must reach at least 240 Vitalité, don't settle for less."</p>
            </div>
        </div>

        <div class="sf-annotated">
            @include('partials.config-form')

            <div class="sf-popup sf-popup--top" data-hl="cf-use-runes" style="top: -100px; left: -80px;">
                <div class="sf-popup__label">Use Runes</div>
                <p class="sf-popup__desc">Toggle whether the bot should use this rune type for this stat.</p>
                <p class="sf-popup__example">"Don't use SM Wisdom rune."</p>
            </div>

            <div class="sf-popup" data-hl="cf-max-rune" style="top: -20px; right: -120px;">
                <div class="sf-popup__label">Max for Rune</div>
                <p class="sf-popup__desc">The bot won't use this rune once the stat hits this value, regardless of remaining sink.</p>
                <p class="sf-popup__example">"Stop using PA Vit runes after reaching 115."</p>
            </div>

            <div class="sf-popup" data-hl="cf-threshold" style="top: -80px; right: 200px;">
                <div class="sf-popup__label">Rune Threshold</div>
                <p class="sf-popup__desc">The stat value at which the bot switches to using the next rune tier.</p>
                <p class="sf-popup__example">"Change to PA Vit rune when Vitality reaches 90."</p>
            </div>

            <div class="sf-popup" data-hl="cf-script" style="bottom: -60px; left: -120px;">
                <div class="sf-popup__label">Custom script</div>
                <p class="sf-popup__desc">Load a custom script to override default AI behavior.</p>
            </div>

            <div class="sf-popup" data-hl="cf-presets" style="bottom: -20px; right: -120px;">
                <div class="sf-popup__label">Presets</div>
                <p class="sf-popup__desc">Save your current configuration as a preset for later use.</p>
            </div>
        </div>

        <div class="sf-annotated">
            @include('partials.queue-form')

            <div class="sf-popup" data-hl="qf-queue" style="top: 150px; left: -90px;">
                <div class="sf-popup__label">Maging Queue</div>
                <p class="sf-popup__desc">Add items to the queue to keep the bot running in the background across multiple presets.</p>
                <p class="sf-popup__example">"Next up is the Gelano — the bot will automatically start maging it after finishing the current item."</p>
            </div>
        </div>
    </div>


    <script>
        (function () {
            var wrapper = document.getElementById('sf-annotated-wrapper');
            if (!wrapper) return;

            // ── propagate data-hl ──
            wrapper.querySelectorAll('th[data-hl-col]').forEach(function (th) {
                var key = th.dataset.hl;
                var colIdx = parseInt(th.dataset.hlCol);
                th.closest('table').querySelectorAll('tr td:nth-child(' + colIdx + ')').forEach(function (td) {
                    td.dataset.hl = key;
                });
            });
            // only the first queue item gets highlighted
            wrapper.querySelectorAll('.queue-window .content[data-hl]').forEach(function (content) {
                var first = content.querySelector('.queue-item');
                if (first) first.dataset.hl = content.dataset.hl;
            });

            // ── highlight helpers ──
            function addHl(key) {
                wrapper.querySelectorAll('[data-hl="' + key + '"]').forEach(function (el) { el.classList.add('hl-active'); });
            }
            function removeHl(key) {
                wrapper.querySelectorAll('[data-hl="' + key + '"]').forEach(function (el) { el.classList.remove('hl-active'); });
            }

            // ── shared state ──
            var userActive = false;
            var hoverKey   = null;
            var resumeId   = null;

            // ── loop factory ──
            // Each loop cycles through its keys with no gap — the next tick
            // immediately swaps to the next highlight (CSS transition handles smoothness).
            function makeLoop(keys, cycleMs) {
                var idx     = 0;
                var cur     = null;
                var timerId = null;
                var startId = null;

                function tick() {
                    if (cur) { removeHl(cur); cur = null; }
                    if (userActive) return;
                    cur = keys[idx % keys.length];
                    idx++;
                    addHl(cur);
                }

                return {
                    start: function (delay) {
                        clearTimeout(startId);
                        clearInterval(timerId); timerId = null;
                        startId = setTimeout(function () {
                            startId = null;
                            if (userActive) return;
                            tick();
                            timerId = setInterval(tick, cycleMs);
                        }, delay || 0);
                    },
                    stop: function () {
                        clearTimeout(startId);  startId = null;
                        clearInterval(timerId); timerId = null;
                        if (cur) { removeHl(cur); cur = null; }
                    }
                };
            }

            // Loop A — setup-form annotations, every 5 s
            var loopA = makeLoop(['sf-cible', 'sf-priorite', 'sf-minimum'], 5000);
            // Loop B — config-form + queue annotations, every 7 s
            var loopB = makeLoop(['cf-use-runes', 'cf-threshold', 'cf-max-rune', 'cf-script', 'cf-presets', 'qf-queue'], 7000);

            function pauseLoops()  { loopA.stop(); loopB.stop(); }
            function resumeLoops() {
                userActive = false;
                loopA.start(0);
                loopB.start(2000); // offset so they rarely fire together
            }

            // ── user interaction ──
            wrapper.querySelectorAll('.sf-annotated').forEach(function (container) {
                // pause as soon as mouse enters any annotated block
                container.addEventListener('mouseenter', function () {
                    clearTimeout(resumeId);
                    userActive = true;
                    pauseLoops();
                });
                // restart loops (with delay) once mouse leaves
                container.addEventListener('mouseleave', function () {
                    if (hoverKey) { removeHl(hoverKey); hoverKey = null; }
                    resumeId = setTimeout(resumeLoops, 800);
                });
                // track which specific element is hovered
                container.addEventListener('mouseover', function (e) {
                    var hlEl = e.target.closest('[data-hl]');
                    if (hlEl) {
                        if (hoverKey && hoverKey !== hlEl.dataset.hl) removeHl(hoverKey);
                        hoverKey = hlEl.dataset.hl;
                        addHl(hoverKey);
                    } else if (hoverKey) {
                        removeHl(hoverKey);
                        hoverKey = null;
                    }
                });
            });

            // ── kick off both loops (staggered start) ──
            loopA.start(1000);
            loopB.start(3200);
        }());
    </script>
    <script>
        let f = document.querySelector("#features-section");
        let a = document.querySelector("#imgSetupForm");
        let b = document.querySelector("#imgClientForm");
        let c = document.querySelector("#imgConfigForm");
        let d = document.querySelector("#imgQueueForm");
        a.addEventListener('mouseover', function () {
            this.classList.add('scale-110')
            this.classList.add('shadow-2xl')
            this.parentNode.classList.add('z-20')
            // this.play();
            // b.pause();
            // c.pause();
            b.classList.remove('scale-110')
            b.classList.remove('shadow-2xl')
            b.parentNode.classList.remove('z-20')
            c.classList.remove('scale-110')
            c.classList.remove('shadow-2xl')
            c.parentNode.classList.remove('z-20')
            d.classList.remove('translate-y-2')
            d.classList.remove('opacity-100')
            d.classList.add('opacity-0')
            d.classList.add('xl:-translate-y-40')
            d.classList.add('-translate-y-16')
            d.classList.add('sm:-translate-y-20')
            d.classList.add('md:-translate-y-32')
            d.classList.add('lg:-translate-y-40')
            d.classList.remove('shadow-2xl')
            d.parentNode.classList.add('xl:-my-40')
            d.parentNode.classList.add('-my-16')
            d.parentNode.classList.add('sm:-my-20')
            d.parentNode.classList.add('md:-my-32')
            d.parentNode.classList.add('lg:-my-40')
        })
        b.addEventListener('mouseover', function () {
            this.classList.add('scale-110')
            this.classList.add('shadow-2xl')
            this.parentNode.classList.add('z-20')
            // this.play();
            // a.pause();
            // c.pause();
            a.classList.remove('scale-110')
            a.parentNode.classList.remove('z-20')
            a.classList.remove('shadow-2xl')
            c.classList.remove('scale-110')
            c.classList.remove('shadow-2xl')
            c.parentNode.classList.remove('z-20')
            d.classList.add('translate-y-2')
            d.classList.add('opacity-100')
            d.classList.remove('opacity-0')
            d.classList.remove('xl:-translate-y-40')
            d.classList.remove('-translate-y-16')
            d.classList.remove('sm:-translate-y-20')
            d.classList.remove('md:-translate-y-32')
            d.classList.remove('lg:-translate-y-40')
            d.classList.add('shadow-2xl')
            d.parentNode.classList.remove('xl:-my-40')
            d.parentNode.classList.remove('-my-16')
            d.parentNode.classList.remove('sm:-my-20')
            d.parentNode.classList.remove('md:-my-32')
            d.parentNode.classList.remove('lg:-my-40')
        })
        f.addEventListener('mouseleave', function () {
            b.classList.add('scale-110')
            b.classList.add('shadow-2xl')
            b.parentNode.classList.add('z-20')
            // this.play();
            // a.pause();
            // c.pause();
            a.classList.remove('scale-110')
            a.parentNode.classList.remove('z-20')
            a.classList.remove('shadow-2xl')
            c.classList.remove('scale-110')
            c.classList.remove('shadow-2xl')
            c.parentNode.classList.remove('z-20')
            d.classList.add('translate-y-2')
            d.classList.add('opacity-100')
            d.classList.remove('opacity-0')
            d.classList.add('shadow-2xl')
            d.classList.remove('xl:-translate-y-40')
            d.classList.remove('-translate-y-16')
            d.classList.remove('sm:-translate-y-20')
            d.classList.remove('md:-translate-y-32')
            d.classList.remove('lg:-translate-y-40')
            d.parentNode.classList.remove('xl:-my-40')
            d.parentNode.classList.remove('-my-16')
            d.parentNode.classList.remove('sm:-my-20')
            d.parentNode.classList.remove('md:-my-32')
            d.parentNode.classList.remove('lg:-my-40')
        })
        c.addEventListener('mouseover', function () {
            this.classList.add('scale-110')
            this.classList.add('shadow-2xl')
            this.parentNode.classList.add('z-20')
            // this.play();
            // a.pause();
            // b.pause();
            a.classList.remove('scale-110')
            a.classList.remove('shadow-2xl')
            a.parentNode.classList.remove('z-20')
            b.classList.remove('scale-110')
            b.classList.remove('shadow-2xl')
            b.parentNode.classList.remove('z-20')
            d.classList.remove('translate-y-2')
            d.classList.remove('opacity-100')
            d.classList.add('opacity-0')
            d.classList.add('xl:-translate-y-40')
            d.classList.add('-translate-y-16')
            d.classList.add('sm:-translate-y-20')
            d.classList.add('md:-translate-y-32')
            d.classList.add('lg:-translate-y-40')
            d.classList.remove('shadow-2xl')
            d.parentNode.classList.add('xl:-my-40')
            d.parentNode.classList.add('-my-16')
            d.parentNode.classList.add('sm:-my-20')
            d.parentNode.classList.add('md:-my-32')
            d.parentNode.classList.add('lg:-my-40')
        })
    </script>
</section>

