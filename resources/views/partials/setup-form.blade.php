@php
    $setupRows = $setupRows ?? [
        ['stat' => 'stats.mp',                   'value' => '-',   'target' => 1,   'minimum' => 1,   'priority' => 0, 'exo' => 1],
        ['stat' => 'stats.vitality',             'value' => 292, 'target' => 250, 'minimum' => 240, 'priority' => 10],
        ['stat' => 'stats.chance',               'value' => 59,  'target' => 55,  'minimum' => '-', 'priority' => 8],
        ['stat' => 'stats.agility',              'value' => 58,  'target' => 55,  'minimum' => '-', 'priority' => 8],
        ['stat' => 'stats.wisdom',               'value' => 30,  'target' => 38,  'minimum' => '-', 'priority' => 7],
        ['stat' => 'stats.range',                'value' => 1,   'target' => 1,   'minimum' => '-', 'priority' => 0],
        ['stat' => 'stats.water_damage',         'value' => 11,  'target' => 11,  'minimum' => '-', 'priority' => 6],
        ['stat' => 'stats.air_damage',           'value' => 11,  'target' => 11,  'minimum' => '-', 'priority' => 6],
        ['stat' => 'stats.prospecting',          'value' => 6,   'target' => 0,   'minimum' => '-', 'priority' => 0],
        ['stat' => 'stats.initiative',           'value' => 391, 'target' => 380, 'minimum' => '-', 'priority' => 0],
        ['stat' => 'stats.per_neutral_resistance','value' => 7,  'target' => 7,   'minimum' => '-', 'priority' => 9],
        ['stat' => 'stats.per_earth_resistance', 'value' => 7,   'target' => 7,   'minimum' => '-', 'priority' => 9],
        ['stat' => 'stats.per_fire_resistance',  'value' => 7,   'target' => 7,   'minimum' => '-', 'priority' => 9],
        ['stat' => 'stats.lock',                 'value' => 4,   'target' => 4,   'minimum' => '-', 'priority' => 5],
    ];
@endphp
<div class="setup-window">
    <div class="title-bar">
        <div class="title">
            <svg class="title-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 34 34">
                <path fill="#000" transform="translate(3 0)" d="M 25.875 0.0625 C 7.531 0.0625 8.78125 11.4375 8.78125 11.4375 C 8.2290994 12.246696 7.6995693 13.046426 7.25 13.84375 C 7.2192731 13.898245 7.1865288 13.94563 7.15625 14 L 4 14 A 1.0001 1.0001 0 0 0 3.90625 14 A 1.001098 1.001098 0 0 0 3.5 15.90625 L 3 16 C 1.343 16 0 17.344 0 19 L 0 23 C 0 24.656 1.343 26 3 26 L 13 26 C 14.657 26 16 24.656 16 23 L 16 19 C 16 17.344 14.657 16 13 16 L 12.46875 15.875 A 1.0001 1.0001 0 0 0 12 14 L 8.78125 14 C 9.3768313 12.98664 10.046844 11.978044 10.8125 10.96875 C 10.850157 10.925536 10.924518 10.804345 10.96875 10.75 C 11.312321 10.305889 11.682667 9.871631 12.0625 9.4375 C 12.206935 9.262417 12.364614 9.0972071 12.53125 8.90625 C 14.065329 7.2428175 15.90652 5.6997788 18.0625 4.40625 C 16.2125 6.10525 13.15425 9.5635 11.65625 12.1875 C 14.10025 12.4015 17.5465 11.016 19.9375 9 C 19.3975 8.939 16.875 8.48475 16.125 7.84375 C 17.563 7.95975 19.95325 7.97425 20.90625 7.90625 C 22.84525 6.47025 25.063 3.0785 25.875 0.0625 z"/>
            </svg>
            {{ __('winforms.setup_title') }}
        </div>
        <div class="controls">
            <div class="control-btn">_</div>
            <div class="control-btn close">✕</div>
        </div>
    </div>
    <div class="content">
        <table>
            <thead>
                <tr>
                    <th>{{ __('winforms.setup_characteristic') }}</th>
                    <th>{{ __('winforms.setup_value') }}</th>
                    <th data-hl="sf-cible"    data-hl-col="3">{{ __('winforms.setup_target') }}</th>
                    <th data-hl="sf-minimum"  data-hl-col="4">{{ __('winforms.setup_minimum') }}</th>
                    <th data-hl="sf-priorite" data-hl-col="5">{{ __('winforms.setup_priority') }}</th>
                    <th class="icon-cell">-</th>
                </tr>
            </thead>
            <tbody>
                @foreach($setupRows as $row)
                    <tr class="{{ ($row['exo'] ?? false) ? 'row-exo' : '' }}">
                        <td>{{ __($row['stat']) }}</td>
                        <td>{{ $row['value'] }}</td>
                        <td>{{ $row['target'] }}</td>
                        <td>{{ $row['minimum'] }}</td>
                        <td>{{ $row['priority'] }}</td>
                        <td class="icon-cell{{ $loop->first ? ' refresh-icon' : '' }}">{{ $loop->first ? '⟲' : '' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="footer">
        <div class="footer-top"><span href="#" class="examples-link">{{ __('winforms.setup_see_examples') }}</a></div>
        <div class="footer-middle">
            <div class="custom-dropdown" style="width: calc(105px * var(--sw-scale, 1));">
                <div class="custom-dropdown-text">PM</div>
                <div class="custom-dropdown-arrow">▼</div>
            </div>
            <div style="display: flex; align-items: center; gap: calc(5px * var(--sw-scale, 1));">
                <div class="custom-dropdown" style="width: calc(140px * var(--sw-scale, 1));">
                    <div class="custom-dropdown-text">Alliance Gloursonne</div>
                    <div class="custom-dropdown-arrow">▼</div>
                </div>
                <div class="trash-icon">🗑️</div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="button">{{ __('winforms.setup_add_exo') }}</div>
            <div class="button">{{ __('winforms.setup_remove_exos') }}</div>
            <div class="button">{{ __('winforms.setup_save_preset') }}</div>
        </div>
    </div>
</div>
