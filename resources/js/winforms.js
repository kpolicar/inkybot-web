// ── Annotation popup loop & hover interaction (features page) ────────────
(function () {
    var wrapper = document.getElementById('sf-annotated-wrapper');
    if (!wrapper) return;

    // Propagate data-hl from th[data-hl-col] down to all td in that column
    wrapper.querySelectorAll('th[data-hl-col]').forEach(function (th) {
        var key    = th.dataset.hl;
        var colIdx = parseInt(th.dataset.hlCol);
        th.closest('table').querySelectorAll('tr td:nth-child(' + colIdx + ')').forEach(function (td) {
            td.dataset.hl = key;
        });
    });
    // All queue items get the highlight
    wrapper.querySelectorAll('.queue-window .content[data-hl]').forEach(function (content) {
        var key = content.dataset.hl;
        content.querySelectorAll('.queue-item').forEach(function (item) {
            item.dataset.hl = key;
        });
    });

    // ── Highlight helpers ─────────────────────────────────────────────────
    function addHl(key) {
        wrapper.querySelectorAll('[data-hl="' + key + '"]').forEach(function (el) {
            el.classList.add('hl-active');
        });
    }
    function removeHl(key) {
        wrapper.querySelectorAll('[data-hl="' + key + '"]').forEach(function (el) {
            el.classList.remove('hl-active');
            el.classList.remove('hl-hover');
        });
    }
    // hl-hover only applies to the popup card (scale animation),
    // never to table cells or queue items (loop does NOT call this)
    function addHlHover(key) {
        wrapper.querySelectorAll('.sf-popup[data-hl="' + key + '"]').forEach(function (el) {
            el.classList.add('hl-hover');
        });
    }
    function removeHlHover(key) {
        wrapper.querySelectorAll('.sf-popup[data-hl="' + key + '"]').forEach(function (el) {
            el.classList.remove('hl-hover');
        });
    }

    // ── Shared state ──────────────────────────────────────────────────────
    var userActive = false;
    var hoverKey   = null;
    var resumeId   = null;

    // ── Loop factory ──────────────────────────────────────────────────────
    // Cycles through keys; the loop NEVER adds hl-hover (no scale on auto-cycle)
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
            addHl(cur); // highlight only — no scale
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

    // ── User interaction ──────────────────────────────────────────────────
    wrapper.querySelectorAll('.sf-annotated').forEach(function (container) {
        // Pause as soon as mouse enters any annotated block
        container.addEventListener('mouseenter', function () {
            clearTimeout(resumeId);
            userActive = true;
            pauseLoops();
        });
        // Restart loops (with delay) once mouse leaves
        container.addEventListener('mouseleave', function () {
            if (hoverKey) { removeHl(hoverKey); removeHlHover(hoverKey); hoverKey = null; }
            resumeId = setTimeout(resumeLoops, 800);
        });
        // Track which specific element is hovered; add scale only on cursor interaction
        container.addEventListener('mouseover', function (e) {
            var hlEl = e.target.closest('[data-hl]');
            if (hlEl) {
                var key = hlEl.dataset.hl;
                if (hoverKey && hoverKey !== key) {
                    removeHl(hoverKey);
                    removeHlHover(hoverKey);
                }
                hoverKey = key;
                addHl(hoverKey);
                addHlHover(hoverKey); // scale popup — cursor only
            } else if (hoverKey) {
                removeHl(hoverKey);
                removeHlHover(hoverKey);
                hoverKey = null;
            }
        });
    });

    // Kick off both loops (staggered start)
    loopA.start(1000);
    loopB.start(3200);
}());

// ── Feature image scaling (existing section below the forms) ─────────────
(function () {
    var f = document.querySelector('#features-section');
    var a = document.querySelector('#imgSetupForm');
    var b = document.querySelector('#imgClientForm');
    var c = document.querySelector('#imgConfigForm');
    var d = document.querySelector('#imgQueueForm');
    if (!a || !b || !c || !d) return;

    a.addEventListener('mouseover', function () {
        this.classList.add('scale-110', 'shadow-2xl');
        this.parentNode.classList.add('z-20');
        b.classList.remove('scale-110', 'shadow-2xl'); b.parentNode.classList.remove('z-20');
        c.classList.remove('scale-110', 'shadow-2xl'); c.parentNode.classList.remove('z-20');
        d.classList.remove('translate-y-2', 'opacity-100', 'shadow-2xl');
        d.classList.add('opacity-0', 'xl:-translate-y-40', '-translate-y-16', 'sm:-translate-y-20', 'md:-translate-y-32', 'lg:-translate-y-40');
        d.parentNode.classList.add('xl:-my-40', '-my-16', 'sm:-my-20', 'md:-my-32', 'lg:-my-40');
    });

    b.addEventListener('mouseover', function () {
        this.classList.add('scale-110', 'shadow-2xl');
        this.parentNode.classList.add('z-20');
        a.classList.remove('scale-110', 'shadow-2xl'); a.parentNode.classList.remove('z-20');
        c.classList.remove('scale-110', 'shadow-2xl'); c.parentNode.classList.remove('z-20');
        d.classList.add('translate-y-2', 'opacity-100', 'shadow-2xl');
        d.classList.remove('opacity-0', 'xl:-translate-y-40', '-translate-y-16', 'sm:-translate-y-20', 'md:-translate-y-32', 'lg:-translate-y-40');
        d.parentNode.classList.remove('xl:-my-40', '-my-16', 'sm:-my-20', 'md:-my-32', 'lg:-my-40');
    });

    c.addEventListener('mouseover', function () {
        this.classList.add('scale-110', 'shadow-2xl');
        this.parentNode.classList.add('z-20');
        a.classList.remove('scale-110', 'shadow-2xl'); a.parentNode.classList.remove('z-20');
        b.classList.remove('scale-110', 'shadow-2xl'); b.parentNode.classList.remove('z-20');
        d.classList.remove('translate-y-2', 'opacity-100', 'shadow-2xl');
        d.classList.add('opacity-0', 'xl:-translate-y-40', '-translate-y-16', 'sm:-translate-y-20', 'md:-translate-y-32', 'lg:-translate-y-40');
        d.parentNode.classList.add('xl:-my-40', '-my-16', 'sm:-my-20', 'md:-my-32', 'lg:-my-40');
    });

    if (f) {
        f.addEventListener('mouseleave', function () {
            b.classList.add('scale-110', 'shadow-2xl'); b.parentNode.classList.add('z-20');
            a.classList.remove('scale-110', 'shadow-2xl'); a.parentNode.classList.remove('z-20');
            c.classList.remove('scale-110', 'shadow-2xl'); c.parentNode.classList.remove('z-20');
            d.classList.add('translate-y-2', 'opacity-100', 'shadow-2xl');
            d.classList.remove('opacity-0', 'xl:-translate-y-40', '-translate-y-16', 'sm:-translate-y-20', 'md:-translate-y-32', 'lg:-translate-y-40');
            d.parentNode.classList.remove('xl:-my-40', '-my-16', 'sm:-my-20', 'md:-my-32', 'lg:-my-40');
        });
    }
}());
