@php
    // Make the pipeline height configurable. Defaults to -180 if not passed to the view.
    $pipelineY = $pipelineY ?? -50;
@endphp

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

    <div class="scanner-node" style="--pipeline-y: {{ $pipelineY }}px;">
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
        
        <div class="reliquat-section">{{ __('stats.reliquat') }} : 1.2</div>
        
        <div class="actions-section">
            <div class="item-slots">
                <div class="slot slot-gloursonne"></div>
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
                    <div class="history-main-icon"><span class="rune-sprite rune-water-dam-rune"></span></div>
                    <div class="history-details">
                        <div class="history-stat text-pos"><span class="stat-icon sprite-feu"></span> 1 {{ __('stats.fire_damage') }}</div>
                        <div class="history-stat text-neg"><span class="stat-icon sprite-initiative"></span> -10 {{ __('stats.initiative') }}</div>
                        <div class="history-stat text-pos"><span class="stat-icon sprite-eau"></span> 1 {{ __('stats.water_damage') }}</div>
                        <div class="history-stat text-neg"><span class="stat-icon sprite-terre"></span> -1 {{ __('stats.earth_damage') }}</div>
                        <div class="text-info">{{ __('stats.reliquat_gain') }}</div>
                    </div>
                </div>

                <div class="history-item">
                    <div class="history-main-icon"><span class="rune-sprite rune-fire-dam-rune"></span></div>
                    <div class="history-details">
                        <div class="history-stat text-pos"><span class="stat-icon sprite-feu"></span> 1 {{ __('stats.fire_damage') }}</div>
                    </div>
                </div>

                <div class="history-item">
                    <div class="history-main-icon"><span class="rune-sprite rune-fire-dam-rune"></span></div>
                    <div class="history-details">
                        <div class="history-stat text-pos"><span class="stat-icon sprite-feu"></span> 1 {{ __('stats.fire_damage') }}</div>
                    </div>
                </div>

                <div class="history-item">
                    <div class="history-main-icon"><span class="rune-sprite rune-neutral-dam-rune"></span></div>
                    <div class="history-details">
                        <div class="history-stat text-pos"><span class="stat-icon sprite-neutre"></span> 1 {{ __('stats.neutral_damage') }}</div>
                        <div class="history-stat text-neg"><span class="stat-icon sprite-feu"></span> -1 {{ __('stats.intelligence') }}</div>
                    </div>
                </div>

                <div class="history-item">
                    <div class="history-main-icon"><span class="rune-sprite rune-neutral-dam-rune"></span></div>
                    <div class="history-details">
                        <div class="history-stat text-pos"><span class="stat-icon sprite-neutre"></span> 1 {{ __('stats.neutral_damage') }}</div>
                        <div class="history-stat text-neg"><span class="stat-icon sprite-resFeu"></span> -1 {{ __('stats.per_fire_resistance') }}</div>
                        <div class="text-info">{{ __('stats.reliquat_gain') }}</div>
                    </div>
                </div>

                <div class="history-item">
                    <div class="history-main-icon"><span class="rune-sprite rune-int-rune"></span></div>
                    <div class="history-details">
                        <div class="history-stat text-pos"><span class="stat-icon sprite-feu"></span> 1 {{ __('stats.intelligence') }}</div>
                    </div>
                </div>
                
                <div class="history-item">
                    <div class="history-main-icon"><span class="rune-sprite rune-int-rune"></span></div>
                    <div class="history-details">
                        <div class="history-stat text-pos"><span class="stat-icon sprite-feu"></span> 1 {{ __('stats.intelligence') }}</div>
                    </div>
                </div>

                <div class="history-item">
                    <div class="history-main-icon"><span class="rune-sprite rune-int-rune"></span></div>
                    <div class="history-details">
                        <div class="history-stat text-pos"><span class="stat-icon sprite-feu"></span> 1 {{ __('stats.intelligence') }}</div>
                    </div>
                </div>

                <div class="history-item">
                    <div class="history-main-icon"><span class="rune-sprite rune-str-rune"></span></div>
                    <div class="history-details">
                        <div class="history-stat text-pos"><span class="stat-icon sprite-terre"></span> 1 {{ __('stats.strength') }}</div>
                        <div class="text-info">{{ __('stats.reliquat_loss') }}</div>
                    </div>
                </div>

                <div class="history-item">
                    <div class="history-main-icon"><span class="rune-sprite rune-str-rune"></span></div>
                    <div class="history-details">
                        <div class="history-stat text-pos"><span class="stat-icon sprite-terre"></span> 1 {{ __('stats.strength') }}</div>
                        <div class="text-info">{{ __('stats.reliquat_loss') }}</div>
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
                    <span class="stat-icon sprite-pv"></span>
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
                    <span class="stat-icon sprite-terre"></span>
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
                    <span class="stat-icon sprite-feu"></span>
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
                    <span class="stat-icon sprite-eau"></span>
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
                    <span class="stat-icon sprite-sagesse"></span>
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
                    <span class="stat-icon sprite-invocation"></span>
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
                    <span class="stat-icon sprite-neutre"></span>
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
                    <span class="stat-icon sprite-terre"></span>
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
                    <span class="stat-icon sprite-feu"></span>
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
                    <span class="stat-icon sprite-eau"></span>
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
                    <span class="stat-icon sprite-initiative"></span>
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
                    <span class="stat-icon sprite-resFeu"></span>
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