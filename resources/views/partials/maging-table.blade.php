@php
    // Make the pipeline height configurable. Defaults to -180 if not passed to the view.
    $pipelineY = $pipelineY ?? -50;
@endphp

<style>
    :root {
        --bg-outer: #212032; --bg-header: linear-gradient(180deg, #575675 0%, #3D3C55 100%);
        --bg-top-panel: #3D3D53; --bg-main-left: #36354C; --bg-main-right: #252438;
        --bg-row: #2F2D48; --bg-slot: #222135; --border-window: #151421;
        --text-light: #F2F2F2; --text-muted: #9D9CAE; --text-green: #8FD838; --xp-bar: #E1E63C;
    }

    .dofus-window {
        width: 900px; background-color: var(--bg-outer);
        border-radius: 12px; border: 2px solid var(--border-window);
        box-shadow: 0 10px 30px rgba(0,0,0,0.7), inset 0 1px 2px rgba(255,255,255,0.1);
        display: flex; flex-direction: column; position: relative; z-index: 1;
        overflow: visible; /* CRITICAL: Lets SVG lines render outside the bounds to the left */
        font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
        color: var(--text-light);
    }

    .window-header {
        background: var(--bg-header); text-align: center; padding: 8px 0;
        font-size: 18px; font-weight: bold; color: white;
        text-shadow: 1px 1px 3px rgba(0,0,0,0.8);
        border-bottom: 2px solid var(--border-window);
        border-radius: 10px 10px 0 0; position: relative;
    }
    .window-header::before {
        content: ''; position: absolute; top: 0; left: 0; right: 0; height: 1px;
        background: rgba(255,255,255,0.15); border-radius: 10px 10px 0 0;
    }

    .top-panel {
        background-color: var(--bg-top-panel); padding: 12px 20px;
        display: flex; justify-content: space-between; align-items: center;
        border-bottom: 2px solid var(--border-window); position: relative; z-index: 10; 
    }

    .profile-section { display: flex; align-items: center; gap: 12px; width: 250px; }
    .profile-img { width: 52px; height: 52px; background-color: #111; border: 2px solid #CCC; border-radius: 4px; overflow: hidden; }
    .profile-img img { width: 100%; height: 100%; object-fit: cover; }
    .profile-details { display: flex; flex-direction: column; gap: 2px; }
    .profile-name { font-size: 16px; font-weight: bold; }
    .profile-job { font-size: 11px; color: var(--text-muted); letter-spacing: 0.5px; text-transform: uppercase; }
    .profile-level { font-size: 11px; color: var(--text-muted); margin-bottom: 4px; }
    .profile-level span { color: white; font-weight: bold; }
    .xp-bar { display: flex; gap: 2px; height: 6px; }
    .xp-bar div { flex: 1; width: 8px; background-color: var(--xp-bar); border-radius: 1px; box-shadow: 0 1px 1px rgba(0,0,0,0.5); }

    .reliquat-section { font-size: 14px; color: var(--text-muted); font-style: italic; flex: 1; text-align: center; }
    .actions-section { display: flex; flex-direction: column; align-items: flex-end; gap: 10px; }
    .item-slots { display: flex; gap: 8px; }
    .slot {
        width: 38px; height: 38px; background-color: var(--bg-slot); border-radius: 4px;
        border: 1px inset rgba(0,0,0,0.5); display: flex; align-items: center; justify-content: center;
        box-shadow: inset 0 2px 4px rgba(0,0,0,0.4), 0 1px 0 rgba(255,255,255,0.05);
    }
    .slot img { width: 80%; height: 80%; object-fit: contain; }
    .slot-faint img { opacity: 0.2; filter: grayscale(100%); }

    .buttons { display: flex; gap: 8px; }
    .btn {
        background: linear-gradient(180deg, #686868 0%, #4D4D4D 100%); border: 1px solid #222;
        color: #999; font-weight: bold; font-size: 11px; padding: 6px 12px; border-radius: 4px;
        box-shadow: inset 0 1px 0 rgba(255,255,255,0.1); text-shadow: 1px 1px 1px rgba(0,0,0,0.8);
    }

    .main-content { display: flex; height: 520px; position: relative; }
    .history-panel {
        width: 260px; background-color: var(--bg-main-left);
        border-right: 2px solid var(--border-window); border-radius: 0 0 0 10px;
        display: flex; flex-direction: column; position: relative; 
        contain: layout paint; /* <--- ADD THIS */
    }
    .history-list { flex: 1; overflow-y: auto; padding: 15px; display: flex; flex-direction: column; gap: 15px; position: relative; z-index: 2; }
    .history-list::-webkit-scrollbar { width: 6px; }
    .history-list::-webkit-scrollbar-track { background: #252438; }
    .history-list::-webkit-scrollbar-thumb { background: #555; border-radius: 3px; }
    .history-item { display: flex; gap: 12px; align-items: flex-start; }
    .history-main-icon { width: 24px; height: 24px; flex-shrink: 0; }
    .history-main-icon img { width: 100%; height: 100%; object-fit: contain; filter: drop-shadow(1px 1px 2px rgba(0,0,0,0.5)); }
    .history-details { display: flex; flex-direction: column; gap: 6px; font-size: 13px; font-weight: bold; }
    .history-stat { display: flex; align-items: center; gap: 6px; }
    .history-stat-icon { width: 14px; height: 14px; display: inline-flex; justify-content: center; align-items: center; }
    .history-stat-icon img { max-width: 100%; max-height: 100%; object-fit: contain; }
    .text-pos { color: var(--text-green); } .text-neg { color: #EFEFEF; } .text-info { color: #8A899C; font-weight: normal; margin-left: 20px;}

    .history-footer {
        padding: 12px 15px; background-color: var(--bg-main-left);
        border-top: 1px solid rgba(255,255,255,0.05); border-radius: 0 0 0 10px; position: relative; z-index: 2;
    }
    .btn-clear {
        background: transparent; border: none; color: var(--text-muted); font-weight: bold;
        display: flex; align-items: center; gap: 8px; text-transform: uppercase; font-size: 11px; padding: 0;
    }
    .btn-clear img { width: 14px; height: 14px; opacity: 0.7; }

    .stats-panel {
        flex: 1; background-color: var(--bg-main-right); border-radius: 0 0 10px 0;
        padding: 15px 20px; display: flex; flex-direction: column; position: relative;
        contain: layout paint;
    }

    /* --- OCR SVG ANIMATION STYLES --- */
    .panel-ocr-svg, .master-connector-svg {
        position: absolute; top: 0; left: 0; width: 100%; height: 100%;
        pointer-events: none; z-index: 100; overflow: visible; 
    }

    @keyframes dash-animation { to { stroke-dashoffset: -140; } }

    /* 1. The High-Performance Fake Shadow (Static, solid, slightly thicker) */
    .ocr-shadow, .ocr-connector-shadow path {
        fill: none; 
        stroke: rgba(0, 0, 0, 0.1); 
        stroke-width: 5; /* Thicker than the white line to create a dark border/glow */
        stroke-linecap: round; 
        stroke-linejoin: round;
        /* Notice: No animations and no filters! */
    }

    /* 2. The Animating White Dashes (Rendered on top) */
    .ocr-rect, .ocr-connector path {
        fill: none; 
        stroke: white; 
        stroke-width: 2; 
        stroke-dasharray: 8, 6; 
        animation: dash-animation 3s linear infinite; 
        /* filter: drop-shadow REMOVED */
    }
    .rune-ocr-svg .ocr-rect { animation: dash-animation 5s linear infinite; } 
    .ocr-connector path { opacity: 0.9; stroke-linecap: round; stroke-linejoin: round; }

    /* desktop pipe goes left; mobile pipe goes up — toggled via media query */
    .ocr-mobile-pipe { display: none; }
    @media (max-width: 1500px) {
        .ocr-desktop-pipe { display: none; }
        .ocr-mobile-pipe  { display: block; }
        .scanner-node     { left: calc(50% - 25px) !important; }
    }

    /* --- SCANNER NODE & SVG ANIMATIONS --- */
    .scanner-node {
        position: absolute;
        left: 0px; 
        width: 50px;
        height: 50px;
        z-index: 150;
        background-color: #ffffff; 
        display: flex; justify-content: center; align-items: center;
        border-radius: 4px;
        box-shadow: 0 0 4px rgba(58, 58, 58, 0.8);
    }
    .scanner-node svg { 
        width: 48px; 
        height: 48px; 
    }

    .scan-group {
        animation: scan-bounce 4s ease-in-out infinite;
        will-change: transform;
        transform: translateZ(0);
    }

    @keyframes scan-bounce {
        0%   { transform: translateY(35px); }
        50%  { transform: translateY(155px); }
        100% { transform: translateY(35px); }
    }

    .glow-top { animation: fade-top-glow 4s ease-in-out infinite; will-change: opacity; }
    .glow-bottom { animation: fade-bottom-glow 4s ease-in-out infinite; will-change: opacity; }

    @keyframes fade-top-glow {
        0%   { opacity: 1; } 
        40%  { opacity: 1; } 
        60%  { opacity: 0; } 
        90%  { opacity: 0; } 
        100% { opacity: 1; }
    }

    @keyframes fade-bottom-glow {
        0%   { opacity: 0; } 
        40%  { opacity: 0; } 
        60%  { opacity: 1; } 
        90%  { opacity: 1; } 
        100% { opacity: 0; }
    }

    /* STATS GRID */
    .stats-grid {
        display: grid; grid-template-columns: 45px 55px 1fr 60px 45px 45px 45px;
        align-items: center; gap: 6px; position: relative; z-index: 2; 
    }
    .stats-header { color: var(--text-muted); font-size: 13px; margin-bottom: 8px; padding: 0 8px; }
    .stats-header div { text-align: left; } .stats-header .col-rune { text-align: center; }

    .stat-row {
        background-color: var(--bg-row); border-radius: 6px; padding: 2px 8px;
        margin-bottom: 4px; font-size: 13px; transition: background-color 0.2s;
        border: 1px solid transparent; position: relative; height: 32px;
    }
    .stat-row:hover { background-color: #373554; }
    .row-highlight { border: 2px solid var(--text-green); background-color: #2F3830; }
    .row-highlight:hover { background-color: #384239; }

    .col-min, .col-max { color: var(--text-muted); text-align: center; }
    .col-stat { display: flex; align-items: center; gap: 6px; color: var(--text-green); font-weight: bold; }
    .col-modif { display: flex; justify-content: center; align-items: center; }
    .modif-badge { background-color: var(--text-green); color: #121212; font-weight: bold; font-size: 11px; padding: 2px 6px; border-radius: 3px; }
    .stat-icon { width: 14px; height: 14px; display: inline-flex; justify-content: center; align-items: center; }
    .stat-icon img { max-width: 100%; max-height: 100%; object-fit: contain; }
    .col-rune { display: flex; justify-content: center; align-items: center; }

    .rune-box {
        width: 28px; height: 28px; background-color: var(--bg-slot); border-radius: 4px; position: relative;
        box-shadow: inset 0 2px 4px rgba(0,0,0,0.5); display: flex; justify-content: center; align-items: center;
    }
    .rune-ocr-svg { position: absolute; top: -2px; left: -2px; width: 32px; height: 32px; pointer-events: none; z-index: 100; }
    .rune-box img { width: 85%; height: 85%; object-fit: contain; }
    .rune-qty {
        position: absolute; top: 0px; right: 1px; font-family: 'Verdana', sans-serif; font-size: 9px;
        font-weight: 900; color: white; -webkit-text-stroke: 0.2px black;
        text-shadow: 1px 1px 0 #000, -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000; z-index: 2;
    }

    /* Rune sprite icons scaled to 24px (from 128px originals, scale = 24/128) */
    .rune-sprite {
        width: 24px; height: 24px; display: inline-block;
        background-image: url('/images/dofus_runes_spritesheet.png');
        background-repeat: no-repeat;
        background-size: 336px 336px;
    }
    .rune-vit-rune { background-position: -72px -312px; }
    .rune-pa-vit-rune { background-position: -264px -144px; }
    .rune-ra-vit-rune { background-position: -312px -216px; }
    .rune-str-rune { background-position: -120px -240px; }
    .rune-pa-str-rune { background-position: -264px -96px; }
    .rune-ra-str-rune { background-position: -120px -192px; }
    .rune-int-rune { background-position: -288px -24px; }
    .rune-pa-int-rune { background-position: 0 -96px; }
    .rune-ra-int-rune { background-position: -312px -168px; }
    .rune-cha-rune { background-position: -192px 0; }
    .rune-pa-cha-rune { background-position: -72px -72px; }
    .rune-ra-cha-rune { background-position: -192px -168px; }
    .rune-wis-rune { background-position: -192px -312px; }
    .rune-pa-wis-rune { background-position: 0 -168px; }
    .rune-ra-wis-rune { background-position: -24px -240px; }
    .rune-sum-rune { background-position: -144px -240px; }
    .rune-neutral-dam-rune { background-position: -216px -48px; }
    .rune-pa-neutral-dam-rune { background-position: -96px -96px; }
    .rune-earth-dam-rune { background-position: -72px -24px; }
    .rune-pa-earth-dam-rune { background-position: -192px -72px; }
    .rune-fire-dam-rune { background-position: -144px -24px; }
    .rune-pa-fire-dam-rune { background-position: -240px -72px; }
    .rune-water-dam-rune { background-position: -96px -312px; }
    .rune-pa-water-dam-rune { background-position: -288px -144px; }
    .rune-ini-rune { background-position: -264px -24px; }
    .rune-pa-ini-rune { background-position: -312px -72px; }
    .rune-ra-ini-rune { background-position: -288px -168px; }
    .rune-fire-res-per-rune { background-position: -168px -24px; }
    .rune-pa-fire-res-rune { background-position: -264px -72px; }
    .rune-ra-fire-res-rune { background-position: -264px -168px; }
</style>

<div class="dofus-window">

    @if($showOcr)
    <svg class="master-connector-svg" xmlns="http://www.w3.org/2000/svg">
    
    <g class="ocr-connector-shadow">
        <path d="M 130 158 L 130 {{ $pipelineY }}" />
        <path d="M 304.5 184 L 304.5 {{ $pipelineY }}" />
        <path d="M 360.5 184 L 360.5 {{ $pipelineY }}" />
        <path d="M 527.5 184 L 527.5 {{ $pipelineY }}" />
        
        <path d="M 847 190 L 847 180 L 807.5 180" />
        <path d="M 743 190 L 743 180 L 807.5 180" />
        <path d="M 795.5 190 L 795.5 {{ $pipelineY }}" />

        <path class="ocr-desktop-pipe" d="M 795.5 {{ $pipelineY }} L -170 {{ $pipelineY }} L -170 15" />
        <path class="ocr-mobile-pipe"  d="M 795.5 {{ $pipelineY }} L 130 {{ $pipelineY }} L 130 0" />
        <path class="ocr-mobile-pipe"  d="M 450 {{ $pipelineY }} L 450 -300" />
    </g>

    <g class="ocr-connector">
        <path d="M 130 158 L 130 {{ $pipelineY }}" />
        <path d="M 304.5 184 L 304.5 {{ $pipelineY }}" />
        <path d="M 360.5 184 L 360.5 {{ $pipelineY }}" />
        <path d="M 527.5 184 L 527.5 {{ $pipelineY }}" />
        
        <path d="M 847 190 L 847 180 L 807.5 180" />
        <path d="M 743 190 L 743 180 L 807.5 180" />
        <path d="M 795.5 190 L 795.5 {{ $pipelineY }}" />

        <path class="ocr-desktop-pipe" d="M 795.5 {{ $pipelineY }} L -170 {{ $pipelineY }} L -170 15" />
        <path class="ocr-mobile-pipe"  d="M 795.5 {{ $pipelineY }} L 130 {{ $pipelineY }} L 130 0" />
        <path class="ocr-mobile-pipe"  d="M 450 {{ $pipelineY }} L 450 -300" />
    </g>
</svg>

    <div class="scanner-node" style="--pipeline-y: {{ $pipelineY }}px; top: calc(var(--pipeline-y) - 28px);">
        <svg viewBox="0 0 200 200" width="100%" height="100%">
            <defs>
                <linearGradient id="scan-glow-top" x1="0" y1="1" x2="0" y2="0">
                    <stop offset="0%" stop-color="#1a1a1a" stop-opacity="0.8" />
                    <stop offset="100%" stop-color="#1a1a1a" stop-opacity="0" />
                </linearGradient>

                <linearGradient id="scan-glow-bottom" x1="0" y1="0" x2="0" y2="1">
                    <stop offset="0%" stop-color="#1a1a1a" stop-opacity="0.8" />
                    <stop offset="100%" stop-color="#1a1a1a" stop-opacity="0" />
                </linearGradient>
            </defs>
            
            <g fill="#333333">
                <rect x="60" y="55" width="45" height="12" rx="6" />
                <rect x="60" y="80" width="55" height="12" rx="6" />
                <rect x="123" y="80" width="20" height="12" rx="6" />
                <rect x="60" y="105" width="45" height="12" rx="6" />
                <rect x="113" y="105" width="30" height="12" rx="6" />
                <rect x="60" y="130" width="55" height="12" rx="6" />
            </g>

            <g class="scan-group">
                <rect class="glow-top" x="35" y="-20" width="130" height="20" fill="url(#scan-glow-top)" />
                <rect class="glow-bottom" x="35" y="4" width="130" height="20" fill="url(#scan-glow-bottom)" />
                <rect x="35" y="0" width="130" height="4" rx="2" fill="#000000" />
            </g>
        </svg>
    </div>
    @endif

    <div class="window-header">Joaillomager</div>
    
    <div class="top-panel">
        <div class="profile-section">
            <div class="profile-img">
                <img src="icons/faces/peaky.png" alt="Profile" onerror="this.src='data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxMDAlIiBoZWlnaHQ9IjEwMCUiPjxyZWN0IHdpZHRoPSIxMDAlIiBoZWlnaHQ9IjEwMCUiIGZpbGw9IiNjY2MwMDAiLz48L3N2Zz4='">
            </div>
            <div class="profile-details">
                <div class="profile-name">Inkybot</div>
                <div class="profile-job">JOAILLOMAGE</div>
                <div class="profile-level">NIV. <span>200</span></div>
                <div class="xp-bar">
                    <div></div><div></div><div></div><div></div><div></div><div></div>
                    <div></div><div></div><div></div><div></div><div></div><div></div>
                </div>
            </div>
        </div>
        
        <div class="reliquat-section">reliquat : 1.2</div>
        
        <div class="actions-section">
            <div class="item-slots">
                <div class="slot">
                    <img src="icons/items/ring.png" alt="Ring" onerror="this.src='data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAyNCAyNCIgZmlsbD0iI2ZmZGEwMCI+PGNpcmNsZSBjeD0iMTIiIGN5PSIxMiIgcj0iOCIgZmlsbD0ibm9uZSIgc3Ryb2tlPSIjZmZkYTAwIiBzdHJva2Utd2lkdGg9IjQiLz48L3N2Zz4='">
                </div>
                <div class="slot slot-faint">
                    <img src="icons/ui/empty_rune.png" alt="Empty Rune" onerror="this.src='data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAyNCAyNCIgZmlsbD0iI2ZmZiI+PHBvbHlnb24gcG9pbnRzPSIxMiwyIDIyLDEyIDEyLDIyIDIsMTIiLz48L3N2Zz4='">
                </div>
                <div class="slot slot-faint">
                    <img src="icons/ui/empty_feather.png" alt="Empty Feather" onerror="this.src='data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAyNCAyNCIgZmlsbD0iI2ZmZiI+PHBhdGggZD0iTTEyLDIgQzEyLDIgMjIsMTIgMjIsMjIgQzIyLDIyIDEyLDEyIDEyLDIgWiIvPjwvc3ZnPg=='">
                </div>
            </div>
            <div class="buttons">
                <div class="btn">FUSIONNER TOUT</div>
                <div class="btn">FUSIONNER</div>
            </div>
        </div>
    </div>

    <div class="main-content">
        <div class="history-panel">
            
            @if($showOcr)
            <svg class="panel-ocr-svg" xmlns="http://www.w3.org/2000/svg">
                <rect class="ocr-rect" x="8" y="10" width="244" height="460" rx="4" />
            </svg>
            @endif

            <div class="history-list">
                <div class="history-item">
                    <div class="history-main-icon"><img src="icons/runes/rune_do_eau.png" alt="rune" onerror="this.outerHTML='🔹'"></div>
                    <div class="history-details">
                        <div class="history-stat text-pos"><span class="history-stat-icon"><img src="icons/stats/damage_fire.png" alt="🔥" onerror="this.outerHTML='🔥'"></span> 1 {{ __('stats.fire_damage') }}</div>
                        <div class="history-stat text-neg"><span class="history-stat-icon"><img src="icons/stats/initiative.png" alt="⚡" onerror="this.outerHTML='⚡'"></span> -10 {{ __('stats.initiative') }}</div>
                        <div class="history-stat text-pos"><span class="history-stat-icon"><img src="icons/stats/damage_water.png" alt="🌊" onerror="this.outerHTML='💧'"></span> 1 {{ __('stats.water_damage') }}</div>
                        <div class="history-stat text-neg"><span class="history-stat-icon"><img src="icons/stats/damage_earth.png" alt="🤎" onerror="this.outerHTML='🟤'"></span> -1 {{ __('stats.earth_damage') }}</div>
                        <div class="text-info">+ reliquat</div>
                    </div>
                </div>

                <div class="history-item">
                    <div class="history-main-icon"><img src="icons/runes/rune_do_feu.png" alt="rune" onerror="this.outerHTML='🔸'"></div>
                    <div class="history-details">
                        <div class="history-stat text-pos"><span class="history-stat-icon"><img src="icons/stats/damage_fire.png" alt="🔥" onerror="this.outerHTML='🔥'"></span> 1 {{ __('stats.fire_damage') }}</div>
                    </div>
                </div>

                <div class="history-item">
                    <div class="history-main-icon"><img src="icons/runes/rune_do_feu.png" alt="rune" onerror="this.outerHTML='🔸'"></div>
                    <div class="history-details">
                        <div class="history-stat text-pos"><span class="history-stat-icon"><img src="icons/stats/damage_fire.png" alt="🔥" onerror="this.outerHTML='🔥'"></span> 1 {{ __('stats.fire_damage') }}</div>
                    </div>
                </div>

                <div class="history-item">
                    <div class="history-main-icon"><img src="icons/runes/rune_do_neu.png" alt="rune" onerror="this.outerHTML='⚪'"></div>
                    <div class="history-details">
                        <div class="history-stat text-pos"><span class="history-stat-icon"><img src="icons/stats/damage_neutral.png" alt="☯️" onerror="this.outerHTML='☯️'"></span> 1 {{ __('stats.neutral_damage') }}</div>
                        <div class="history-stat text-neg"><span class="history-stat-icon"><img src="icons/stats/intelligence.png" alt="🔥" onerror="this.outerHTML='🔥'"></span> -1 {{ __('stats.intelligence') }}</div>
                    </div>
                </div>

                <div class="history-item">
                    <div class="history-main-icon"><img src="icons/runes/rune_do_neu.png" alt="rune" onerror="this.outerHTML='⚪'"></div>
                    <div class="history-details">
                        <div class="history-stat text-pos"><span class="history-stat-icon"><img src="icons/stats/damage_neutral.png" alt="☯️" onerror="this.outerHTML='☯️'"></span> 1 {{ __('stats.neutral_damage') }}</div>
                        <div class="history-stat text-neg"><span class="history-stat-icon"><img src="icons/stats/res_fire.png" alt="🛡️" onerror="this.outerHTML='🛡️'"></span> -1 {{ __('stats.per_fire_resistance') }}</div>
                        <div class="text-info">+ reliquat</div>
                    </div>
                </div>

                <div class="history-item">
                    <div class="history-main-icon"><img src="icons/runes/rune_ine.png" alt="rune" onerror="this.outerHTML='🟥'"></div>
                    <div class="history-details">
                        <div class="history-stat text-pos"><span class="history-stat-icon"><img src="icons/stats/intelligence.png" alt="🔥" onerror="this.outerHTML='🔥'"></span> 1 {{ __('stats.intelligence') }}</div>
                    </div>
                </div>
                
                <div class="history-item">
                    <div class="history-main-icon"><img src="icons/runes/rune_ine.png" alt="rune" onerror="this.outerHTML='🟥'"></div>
                    <div class="history-details">
                        <div class="history-stat text-pos"><span class="history-stat-icon"><img src="icons/stats/intelligence.png" alt="🔥" onerror="this.outerHTML='🔥'"></span> 1 {{ __('stats.intelligence') }}</div>
                    </div>
                </div>

                <div class="history-item">
                    <div class="history-main-icon"><img src="icons/runes/rune_ine.png" alt="rune" onerror="this.outerHTML='🟥'"></div>
                    <div class="history-details">
                        <div class="history-stat text-pos"><span class="history-stat-icon"><img src="icons/stats/intelligence.png" alt="🔥" onerror="this.outerHTML='🔥'"></span> 1 {{ __('stats.intelligence') }}</div>
                    </div>
                </div>

                <div class="history-item">
                    <div class="history-main-icon"><img src="icons/runes/rune_fo.png" alt="rune" onerror="this.outerHTML='🟫'"></div>
                    <div class="history-details">
                        <div class="history-stat text-pos"><span class="history-stat-icon"><img src="icons/stats/strength.png" alt="🪨" onerror="this.outerHTML='🟤'"></span> 1 {{ __('stats.strength') }}</div>
                        <div class="text-info">- reliquat</div>
                    </div>
                </div>

                <div class="history-item">
                    <div class="history-main-icon"><img src="icons/runes/rune_fo.png" alt="rune" onerror="this.outerHTML='🟫'"></div>
                    <div class="history-details">
                        <div class="history-stat text-pos"><span class="history-stat-icon"><img src="icons/stats/strength.png" alt="🪨" onerror="this.outerHTML='🟤'"></span> 1 {{ __('stats.strength') }}</div>
                        <div class="text-info">- reliquat</div>
                    </div>
                </div>

            </div>
            
            <div class="history-footer">
                <div class="btn-clear">
                    <img src="icons/ui/trash.png" alt="🗑️" onerror="this.outerHTML='🗑️'">
                    VIDER L'HISTORIQUE
                </div>
            </div>
        </div>
        
        <div class="stats-panel">
            
            @if($showOcr)
            <svg class="panel-ocr-svg" xmlns="http://www.w3.org/2000/svg">
                <rect class="ocr-rect" x="20" y="36" width="45" height="460" rx="4" />
                <rect class="ocr-rect" x="71" y="36" width="55" height="460" rx="4" />
                <rect class="ocr-rect" x="132" y="36" width="267" height="460" rx="4" />
            </svg>
            @endif

            <div class="stats-grid stats-header">
                <div class="col-min">Min</div>
                <div class="col-max">Max</div>
                <div class="col-stat">Effets / Carac.</div>
                <div class="col-modif">Modif.</div>
                <div class="col-rune"></div>
                <div class="col-rune">Pa</div>
                <div class="col-rune">Ra</div>
            </div>

            <div class="stats-grid stat-row">
                <div class="col-min">201</div>
                <div class="col-max">250</div>
                <div class="col-stat">
                    <span class="stat-icon"><img src="icons/stats/vitality.png" alt="❤️" onerror="this.outerHTML='❤️'"></span>
                    210 {{ __('stats.vitality') }}
                </div>
                <div class="col-modif"></div>
                <div class="col-rune">
                    <div class="rune-box">
                        @if($showOcr) <svg class="rune-ocr-svg" xmlns="http://www.w3.org/2000/svg"><rect class="ocr-rect" x="1" y="1" width="30" height="30" rx="4" /></svg> @endif
                        <span class="rune-sprite rune-vit-rune"></span><span class="rune-qty">224</span>
                    </div>
                </div>
                <div class="col-rune">
                    <div class="rune-box">
                        @if($showOcr) <svg class="rune-ocr-svg" xmlns="http://www.w3.org/2000/svg"><rect class="ocr-rect" x="1" y="1" width="30" height="30" rx="4" /></svg> @endif
                        <span class="rune-sprite rune-pa-vit-rune"></span><span class="rune-qty">649</span>
                    </div>
                </div>
                <div class="col-rune">
                    <div class="rune-box">
                        @if($showOcr) <svg class="rune-ocr-svg" xmlns="http://www.w3.org/2000/svg"><rect class="ocr-rect" x="1" y="1" width="30" height="30" rx="4" /></svg> @endif
                        <span class="rune-sprite rune-ra-vit-rune"></span><span class="rune-qty">101</span>
                    </div>
                </div>
            </div>

            <div class="stats-grid stat-row row-highlight">
                <div class="col-min">31</div>
                <div class="col-max">40</div>
                <div class="col-stat">
                    <span class="stat-icon"><img src="icons/stats/strength.png" alt="🪨" onerror="this.outerHTML='🟤'"></span>
                    33 {{ __('stats.strength') }}
                </div>
                <div class="col-modif"><span class="modif-badge">+1</span></div>
                <div class="col-rune">
                    <div class="rune-box">
                        @if($showOcr) <svg class="rune-ocr-svg" xmlns="http://www.w3.org/2000/svg"><rect class="ocr-rect" x="1" y="1" width="30" height="30" rx="4" /></svg> @endif
                        <span class="rune-sprite rune-str-rune"></span><span class="rune-qty">1993</span>
                    </div>
                </div>
                <div class="col-rune">
                    <div class="rune-box">
                        @if($showOcr) <svg class="rune-ocr-svg" xmlns="http://www.w3.org/2000/svg"><rect class="ocr-rect" x="1" y="1" width="30" height="30" rx="4" /></svg> @endif
                        <span class="rune-sprite rune-pa-str-rune"></span><span class="rune-qty">84</span>
                    </div>
                </div>
                <div class="col-rune">
                    <div class="rune-box">
                        @if($showOcr) <svg class="rune-ocr-svg" xmlns="http://www.w3.org/2000/svg"><rect class="ocr-rect" x="1" y="1" width="30" height="30" rx="4" /></svg> @endif
                        <span class="rune-sprite rune-ra-str-rune"></span><span class="rune-qty">259</span>
                    </div>
                </div>
            </div>

            <div class="stats-grid stat-row">
                <div class="col-min">31</div>
                <div class="col-max">40</div>
                <div class="col-stat">
                    <span class="stat-icon"><img src="icons/stats/intelligence.png" alt="🔥" onerror="this.outerHTML='🔥'"></span>
                    11 {{ __('stats.intelligence') }}
                </div>
                <div class="col-modif"></div>
                <div class="col-rune">
                    <div class="rune-box">
                        @if($showOcr) <svg class="rune-ocr-svg" xmlns="http://www.w3.org/2000/svg"><rect class="ocr-rect" x="1" y="1" width="30" height="30" rx="4" /></svg> @endif
                        <span class="rune-sprite rune-int-rune"></span><span class="rune-qty">995</span>
                    </div>
                </div>
                <div class="col-rune">
                    <div class="rune-box">
                        @if($showOcr) <svg class="rune-ocr-svg" xmlns="http://www.w3.org/2000/svg"><rect class="ocr-rect" x="1" y="1" width="30" height="30" rx="4" /></svg> @endif
                        <span class="rune-sprite rune-pa-int-rune"></span><span class="rune-qty">32</span>
                    </div>
                </div>
                <div class="col-rune">
                    <div class="rune-box">
                        @if($showOcr) <svg class="rune-ocr-svg" xmlns="http://www.w3.org/2000/svg"><rect class="ocr-rect" x="1" y="1" width="30" height="30" rx="4" /></svg> @endif
                        <span class="rune-sprite rune-ra-int-rune"></span><span class="rune-qty">245</span>
                    </div>
                </div>
            </div>

            <div class="stats-grid stat-row">
                <div class="col-min">31</div>
                <div class="col-max">40</div>
                <div class="col-stat">
                    <span class="stat-icon"><img src="icons/stats/chance.png" alt="💧" onerror="this.outerHTML='💧'"></span>
                    31 {{ __('stats.chance') }}
                </div>
                <div class="col-modif"></div>
                <div class="col-rune">
                    <div class="rune-box">
                        @if($showOcr) <svg class="rune-ocr-svg" xmlns="http://www.w3.org/2000/svg"><rect class="ocr-rect" x="1" y="1" width="30" height="30" rx="4" /></svg> @endif
                        <span class="rune-sprite rune-cha-rune"></span><span class="rune-qty">73</span>
                    </div>
                </div>
                <div class="col-rune">
                    <div class="rune-box">
                        @if($showOcr) <svg class="rune-ocr-svg" xmlns="http://www.w3.org/2000/svg"><rect class="ocr-rect" x="1" y="1" width="30" height="30" rx="4" /></svg> @endif
                        <span class="rune-sprite rune-pa-cha-rune"></span><span class="rune-qty">19</span>
                    </div>
                </div>
                <div class="col-rune">
                    <div class="rune-box">
                        @if($showOcr) <svg class="rune-ocr-svg" xmlns="http://www.w3.org/2000/svg"><rect class="ocr-rect" x="1" y="1" width="30" height="30" rx="4" /></svg> @endif
                        <span class="rune-sprite rune-ra-cha-rune"></span><span class="rune-qty">245</span>
                    </div>
                </div>
            </div>

            <div class="stats-grid stat-row">
                <div class="col-min">31</div>
                <div class="col-max">40</div>
                <div class="col-stat">
                    <span class="stat-icon"><img src="icons/stats/wisdom.png" alt="🟣" onerror="this.outerHTML='🟣'"></span>
                    30 {{ __('stats.wisdom') }}
                </div>
                <div class="col-modif"></div>
                <div class="col-rune">
                    <div class="rune-box">
                        @if($showOcr) <svg class="rune-ocr-svg" xmlns="http://www.w3.org/2000/svg"><rect class="ocr-rect" x="1" y="1" width="30" height="30" rx="4" /></svg> @endif
                        <span class="rune-sprite rune-wis-rune"></span><span class="rune-qty">258</span>
                    </div>
                </div>
                <div class="col-rune">
                    <div class="rune-box">
                        @if($showOcr) <svg class="rune-ocr-svg" xmlns="http://www.w3.org/2000/svg"><rect class="ocr-rect" x="1" y="1" width="30" height="30" rx="4" /></svg> @endif
                        <span class="rune-sprite rune-pa-wis-rune"></span><span class="rune-qty">201</span>
                    </div>
                </div>
                <div class="col-rune">
                    <div class="rune-box">
                        @if($showOcr) <svg class="rune-ocr-svg" xmlns="http://www.w3.org/2000/svg"><rect class="ocr-rect" x="1" y="1" width="30" height="30" rx="4" /></svg> @endif
                        <span class="rune-sprite rune-ra-wis-rune"></span><span class="rune-qty">341</span>
                    </div>
                </div>
            </div>

            <div class="stats-grid stat-row">
                <div class="col-min">1</div>
                <div class="col-max">1</div>
                <div class="col-stat">
                    <span class="stat-icon"><img src="icons/stats/summons.png" alt="🐉" onerror="this.outerHTML='🟢'"></span>
                    1 {{ __('stats.summons') }}
                </div>
                <div class="col-modif"></div>
                <div class="col-rune">
                    <div class="rune-box">
                        @if($showOcr) <svg class="rune-ocr-svg" xmlns="http://www.w3.org/2000/svg"><rect class="ocr-rect" x="1" y="1" width="30" height="30" rx="4" /></svg> @endif
                        <span class="rune-sprite rune-sum-rune"></span><span class="rune-qty">64</span>
                    </div>
                </div>
                <div class="col-rune">
                    <div class="rune-box">
                        @if($showOcr) <svg class="rune-ocr-svg" xmlns="http://www.w3.org/2000/svg"><rect class="ocr-rect" x="1" y="1" width="30" height="30" rx="4" /></svg> @endif
                    </div>
                </div>
                <div class="col-rune">
                    <div class="rune-box">
                        @if($showOcr) <svg class="rune-ocr-svg" xmlns="http://www.w3.org/2000/svg"><rect class="ocr-rect" x="1" y="1" width="30" height="30" rx="4" /></svg> @endif
                    </div>
                </div>
            </div>

            <div class="stats-grid stat-row">
                <div class="col-min">7</div>
                <div class="col-max">10</div>
                <div class="col-stat">
                    <span class="stat-icon"><img src="icons/stats/damage_neutral.png" alt="☯️" onerror="this.outerHTML='⚪'"></span>
                    8 {{ __('stats.neutral_damage') }}
                </div>
                <div class="col-modif"></div>
                <div class="col-rune">
                    <div class="rune-box">
                        @if($showOcr) <svg class="rune-ocr-svg" xmlns="http://www.w3.org/2000/svg"><rect class="ocr-rect" x="1" y="1" width="30" height="30" rx="4" /></svg> @endif
                        <span class="rune-sprite rune-neutral-dam-rune"></span><span class="rune-qty">54</span>
                    </div>
                </div>
                <div class="col-rune">
                    <div class="rune-box">
                        @if($showOcr) <svg class="rune-ocr-svg" xmlns="http://www.w3.org/2000/svg"><rect class="ocr-rect" x="1" y="1" width="30" height="30" rx="4" /></svg> @endif
                        <span class="rune-sprite rune-pa-neutral-dam-rune"></span><span class="rune-qty">21</span>
                    </div>
                </div>
                <div class="col-rune">
                    <div class="rune-box">
                        @if($showOcr) <svg class="rune-ocr-svg" xmlns="http://www.w3.org/2000/svg"><rect class="ocr-rect" x="1" y="1" width="30" height="30" rx="4" /></svg> @endif
                    </div>
                </div>
            </div>

            <div class="stats-grid stat-row">
                <div class="col-min">7</div>
                <div class="col-max">10</div>
                <div class="col-stat">
                    <span class="stat-icon"><img src="icons/stats/damage_earth.png" alt="🤎" onerror="this.outerHTML='🟤'"></span>
                    9 {{ __('stats.earth_damage') }}
                </div>
                <div class="col-modif"></div>
                <div class="col-rune">
                    <div class="rune-box">
                        @if($showOcr) <svg class="rune-ocr-svg" xmlns="http://www.w3.org/2000/svg"><rect class="ocr-rect" x="1" y="1" width="30" height="30" rx="4" /></svg> @endif
                        <span class="rune-sprite rune-earth-dam-rune"></span><span class="rune-qty">26</span>
                    </div>
                </div>
                <div class="col-rune">
                    <div class="rune-box">
                        @if($showOcr) <svg class="rune-ocr-svg" xmlns="http://www.w3.org/2000/svg"><rect class="ocr-rect" x="1" y="1" width="30" height="30" rx="4" /></svg> @endif
                        <span class="rune-sprite rune-pa-earth-dam-rune"></span><span class="rune-qty">15</span>
                    </div>
                </div>
                <div class="col-rune">
                    <div class="rune-box">
                        @if($showOcr) <svg class="rune-ocr-svg" xmlns="http://www.w3.org/2000/svg"><rect class="ocr-rect" x="1" y="1" width="30" height="30" rx="4" /></svg> @endif
                    </div>
                </div>
            </div>

            <div class="stats-grid stat-row">
                <div class="col-min">7</div>
                <div class="col-max">10</div>
                <div class="col-stat">
                    <span class="stat-icon"><img src="icons/stats/damage_fire.png" alt="❤️‍🔥" onerror="this.outerHTML='🔴'"></span>
                    10 {{ __('stats.fire_damage') }}
                </div>
                <div class="col-modif"></div>
                <div class="col-rune">
                    <div class="rune-box">
                        @if($showOcr) <svg class="rune-ocr-svg" xmlns="http://www.w3.org/2000/svg"><rect class="ocr-rect" x="1" y="1" width="30" height="30" rx="4" /></svg> @endif
                        <span class="rune-sprite rune-fire-dam-rune"></span><span class="rune-qty">26</span>
                    </div>
                </div>
                <div class="col-rune">
                    <div class="rune-box">
                        @if($showOcr) <svg class="rune-ocr-svg" xmlns="http://www.w3.org/2000/svg"><rect class="ocr-rect" x="1" y="1" width="30" height="30" rx="4" /></svg> @endif
                        <span class="rune-sprite rune-pa-fire-dam-rune"></span><span class="rune-qty">33</span>
                    </div>
                </div>
                <div class="col-rune">
                    <div class="rune-box">
                        @if($showOcr) <svg class="rune-ocr-svg" xmlns="http://www.w3.org/2000/svg"><rect class="ocr-rect" x="1" y="1" width="30" height="30" rx="4" /></svg> @endif
                    </div>
                </div>
            </div>

            <div class="stats-grid stat-row">
                <div class="col-min">7</div>
                <div class="col-max">10</div>
                <div class="col-stat">
                    <span class="stat-icon"><img src="icons/stats/damage_water.png" alt="🌊" onerror="this.outerHTML='🔵'"></span>
                    10 {{ __('stats.water_damage') }}
                </div>
                <div class="col-modif"></div>
                <div class="col-rune">
                    <div class="rune-box">
                        @if($showOcr) <svg class="rune-ocr-svg" xmlns="http://www.w3.org/2000/svg"><rect class="ocr-rect" x="1" y="1" width="30" height="30" rx="4" /></svg> @endif
                        <span class="rune-sprite rune-water-dam-rune"></span><span class="rune-qty">12</span>
                    </div>
                </div>
                <div class="col-rune">
                    <div class="rune-box">
                        @if($showOcr) <svg class="rune-ocr-svg" xmlns="http://www.w3.org/2000/svg"><rect class="ocr-rect" x="1" y="1" width="30" height="30" rx="4" /></svg> @endif
                        <span class="rune-sprite rune-pa-water-dam-rune"></span><span class="rune-qty">41</span>
                    </div>
                </div>
                <div class="col-rune">
                    <div class="rune-box">
                        @if($showOcr) <svg class="rune-ocr-svg" xmlns="http://www.w3.org/2000/svg"><rect class="ocr-rect" x="1" y="1" width="30" height="30" rx="4" /></svg> @endif
                    </div>
                </div>
            </div>

            <div class="stats-grid stat-row">
                <div class="col-min">201</div>
                <div class="col-max">300</div>
                <div class="col-stat">
                    <span class="stat-icon"><img src="icons/stats/initiative.png" alt="⚡" onerror="this.outerHTML='⚡'"></span>
                    226 {{ __('stats.initiative') }}
                </div>
                <div class="col-modif"></div>
                <div class="col-rune">
                    <div class="rune-box">
                        @if($showOcr) <svg class="rune-ocr-svg" xmlns="http://www.w3.org/2000/svg"><rect class="ocr-rect" x="1" y="1" width="30" height="30" rx="4" /></svg> @endif
                        <span class="rune-sprite rune-ini-rune"></span><span class="rune-qty">632</span>
                    </div>
                </div>
                <div class="col-rune">
                    <div class="rune-box">
                        @if($showOcr) <svg class="rune-ocr-svg" xmlns="http://www.w3.org/2000/svg"><rect class="ocr-rect" x="1" y="1" width="30" height="30" rx="4" /></svg> @endif
                        <span class="rune-sprite rune-pa-ini-rune"></span><span class="rune-qty">491</span>
                    </div>
                </div>
                <div class="col-rune">
                    <div class="rune-box">
                        @if($showOcr) <svg class="rune-ocr-svg" xmlns="http://www.w3.org/2000/svg"><rect class="ocr-rect" x="1" y="1" width="30" height="30" rx="4" /></svg> @endif
                        <span class="rune-sprite rune-ra-ini-rune"></span><span class="rune-qty">127</span>
                    </div>
                </div>
            </div>

            <div class="stats-grid stat-row">
                <div class="col-min">4</div>
                <div class="col-max">6</div>
                <div class="col-stat">
                    <span class="stat-icon"><img src="icons/stats/res_fire.png" alt="🛡️" onerror="this.outerHTML='🛡️'"></span>
                    1 {{ __('stats.per_fire_resistance') }}
                </div>
                <div class="col-modif"></div>
                <div class="col-rune">
                    <div class="rune-box">
                        @if($showOcr) <svg class="rune-ocr-svg" xmlns="http://www.w3.org/2000/svg"><rect class="ocr-rect" x="1" y="1" width="30" height="30" rx="4" /></svg> @endif
                        <span class="rune-sprite rune-fire-res-per-rune"></span><span class="rune-qty">337</span>
                    </div>
                </div>
                <div class="col-rune">
                    <div class="rune-box">
                        @if($showOcr) <svg class="rune-ocr-svg" xmlns="http://www.w3.org/2000/svg"><rect class="ocr-rect" x="1" y="1" width="30" height="30" rx="4" /></svg> @endif
                        <span class="rune-sprite rune-pa-fire-res-rune"></span><span class="rune-qty">58</span>
                    </div>
                </div>
                <div class="col-rune">
                    <div class="rune-box">
                        @if($showOcr) <svg class="rune-ocr-svg" xmlns="http://www.w3.org/2000/svg"><rect class="ocr-rect" x="1" y="1" width="30" height="30" rx="4" /></svg> @endif
                        <span class="rune-sprite rune-ra-fire-res-rune"></span><span class="rune-qty">16</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>