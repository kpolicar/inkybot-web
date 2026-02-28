<?php

return [
    // ── "How does it work" section ────────────────────────────────────────────
    'how_title'                  => 'How does it work?',
    'how_ocr_title'              => 'OCR Vision',
    'how_ocr_desc'               => 'Reads your game interface in real-time',
    'how_mouse_title'            => 'Mouse Control',
    'how_mouse_desc'             => 'Interacts with the game using the mouse',
    'how_ai_title'               => 'Smart AI',
    'how_ai_desc'                => 'Picks the optimal rune to maximize profit',

    // ── Setup form ────────────────────────────────────────────────────────────
    'setup_title'                => 'Inkybot - Setup',
    'setup_characteristic'       => 'Characteristic',
    'setup_value'                => 'Value',
    'setup_target'               => 'Target',
    'setup_minimum'              => 'Minimum',
    'setup_priority'             => 'Priority',
    'setup_see_examples'         => 'See examples',
    'setup_add_exo'              => 'ADD EXO',
    'setup_remove_exos'          => 'REMOVE EXOS',
    'setup_save_preset'          => 'SAVE PRESET',

    // ── Config form ───────────────────────────────────────────────────────────
    'config_title'               => 'Inkybot - Config',
    'config_stat_col'            => 'Stat',
    'config_use_sm_runes'        => 'Use SM Runes',
    'config_use_pa_runes'        => 'Use PA Runes',
    'config_use_ra_runes'        => 'Use RA Runes',
    'config_pa_threshold'        => 'PA Rune Threshold',
    'config_ra_threshold'        => 'RA Rune Threshold',
    'config_max_sm_rune'         => 'Max (SM Rune)',
    'config_max_pa_rune'         => 'Max (PA Rune)',
    'config_restore_high_sink'   => 'Restore high sink stats immediately (AP, MP, Range, Summons)',
    'config_publish_exos'        => 'Publish exo mages to Hall of Fame',
    'config_auto_new_session'    => 'Automatically start new statistics session on successful exo',
    'config_show_tips'           => 'Show helpful tips and warnings',
    'config_track_kamas'         => 'Track average Kamas spent',
    'config_safe_mode'           => 'Mage Queueing Safe Mode',
    'config_auto_shutdown'       => 'Automatic shutdown when bot stops',
    'config_disabled'            => 'Disabled',
    'config_ocr_ratio'           => 'Custom OCR Image Resize Ratio',
    'config_ocr_ratio_hint'      => '(leave at "1" unless stats aren\'t recognized correctly)',
    'config_see_examples'        => 'See examples',
    'config_custom_script'       => 'Custom Maging Script',
    'config_choose_file'         => 'Choose File',
    'config_save_preset'         => 'SAVE AS PRESET',

    // ── Queue form ────────────────────────────────────────────────────────────
    'queue_title'                => 'Inkybot - Queue',
    'queue_stat_preset'          => 'Stat Preset',
    'queue_config_preset'        => 'Config',
    'queue_move_up'              => 'Up',
    'queue_move_down'            => 'Down',
    'queue_remove'               => 'Remove',
    'queue_clear'                => 'Clear Queue',

    // ── Popup: Setup form — Target (Cible) ────────────────────────────────────
    'popup_sf_cible_label'       => 'Target',
    'popup_sf_cible_desc'        => 'The stat value you\'d ideally like to reach when maging.',
    'popup_sf_cible_example'     => '"I\'d like to reach 250 Vitality if possible."',

    // ── Popup: Setup form — Priority (Priorité) ───────────────────────────────
    'popup_sf_priorite_label'    => 'Priority',
    'popup_sf_priorite_desc'     => 'When sink is available, higher-priority stats are improved first.',
    'popup_sf_priorite_example'  => '"Vitality will be prioritized first, then % Neutral Resistance, etc."',

    // ── Popup: Setup form — Minimum ───────────────────────────────────────────
    'popup_sf_minimum_label'     => 'Minimum',
    'popup_sf_minimum_desc'      => 'A hard floor — the bot will never accept a value below this.',
    'popup_sf_minimum_example'   => '"I must reach at least 240 Vitality, don\'t settle for less."',

    // ── Popup: Config form — Use Runes ────────────────────────────────────────
    'popup_cf_use_runes_label'   => 'Use Runes',
    'popup_cf_use_runes_desc'    => 'Toggle whether the bot should use this rune type for this stat.',
    'popup_cf_use_runes_example' => '"Don\'t use SM Wisdom rune."',

    // ── Popup: Config form — Max for Rune ─────────────────────────────────────
    'popup_cf_max_rune_label'    => 'Max for Rune',
    'popup_cf_max_rune_desc'     => 'The bot won\'t use this rune once the stat hits this value, regardless of remaining sink.',
    'popup_cf_max_rune_example'  => '"Stop using PA Vit runes after reaching 115."',

    // ── Popup: Config form — Rune Threshold ───────────────────────────────────
    'popup_cf_threshold_label'   => 'Rune Threshold',
    'popup_cf_threshold_desc'    => 'The stat value at which the bot switches to using the next rune tier.',
    'popup_cf_threshold_example' => '"Change to PA Vit rune when Vitality reaches 90."',

    // ── Popup: Config form — Custom Script ────────────────────────────────────
    'popup_cf_script_label'      => 'Custom Script',
    'popup_cf_script_desc'       => 'Load a custom script to override default AI behavior.',

    // ── Popup: Config form — Presets ──────────────────────────────────────────
    'popup_cf_presets_label'     => 'Presets',
    'popup_cf_presets_desc'      => 'Save your current configuration as a preset for later use.',

    // ── Popup: Queue form — Maging Queue ──────────────────────────────────────
    'popup_qf_queue_label'       => 'Maging Queue',
    'popup_qf_queue_desc'        => 'Add items to the queue to keep the bot running in the background across multiple presets.',
    'popup_qf_queue_example'     => '"Next up is the Gelano — the bot will automatically start maging it after finishing the current item."',
];
