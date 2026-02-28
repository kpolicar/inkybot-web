<?php

return [
    // ── "How does it work" section ────────────────────────────────────────────
    'how_title'                  => 'Comment ça fonctionne?',
    'how_ocr_title'              => 'Vision OCR',
    'how_ocr_desc'               => 'Lit votre interface de jeu en temps réel',
    'how_mouse_title'            => 'Contrôle Souris',
    'how_mouse_desc'             => 'Interagit avec le jeu via la souris',
    'how_ai_title'               => 'IA Intelligente',
    'how_ai_desc'                => 'Choisit la rune optimale pour maximiser les profits',

    // ── Setup form ────────────────────────────────────────────────────────────
    'setup_title'                => 'Inkybot - Préparer',
    'setup_characteristic'       => 'Caractéristique',
    'setup_value'                => 'Valeur',
    'setup_target'               => 'Cible',
    'setup_minimum'              => 'Minimum',
    'setup_priority'             => 'Priorité',
    'setup_see_examples'         => 'Voir des exemples',
    'setup_add_exo'              => 'AJOUTER EXO',
    'setup_remove_exos'          => 'SUPPRIMER EXOS',
    'setup_save_preset'          => 'ENREGISTRER LE PRÉRÉGLAGE',

    // ── Config form ───────────────────────────────────────────────────────────
    'config_title'               => 'Inkybot - Config',
    'config_stat_col'            => 'Caractéristique',
    'config_use_sm_runes'        => 'Utiliser des runes SM',
    'config_use_pa_runes'        => 'Utiliser des runes PA',
    'config_use_ra_runes'        => 'Utiliser des runes RA',
    'config_pa_threshold'        => 'PA Rune Seuil',
    'config_ra_threshold'        => 'RA Rune Seuil',
    'config_max_sm_rune'         => 'Max (SM Rune)',
    'config_max_pa_rune'         => 'Max (PA Rune)',
    'config_restore_high_sink'   => 'Restaurez immédiatement les caractéristiques de chute élevée (PA, PM, Portée, Invocations)',
    'config_publish_exos'        => 'Publier ses exos au Hall of Fame',
    'config_auto_new_session'    => 'Démarrer automatiquement une nouvelle session de statistiques après un passage d\'exo',
    'config_show_tips'           => 'Afficher des conseils et avertissements utiles',
    'config_track_kamas'         => 'Suivre la moyenne des kamas dépensés',
    'config_safe_mode'           => 'Mise en file d\'attente en mode sans échec',
    'config_auto_shutdown'       => 'Arrêt automatique lorsque le bot s\'arrête',
    'config_disabled'            => 'Désactivé',
    'config_ocr_ratio'           => 'Rapport de redimensionnement d\'image OCR personnalisé',
    'config_ocr_ratio_hint'      => '(laisser à "1" sauf si les caractéristiques ne sont pas reconnues correctement)',
    'config_see_examples'        => 'Voir des exemples',
    'config_custom_script'       => 'Script de forgemagie personnalisé',
    'config_choose_file'         => 'Choisir le Fichier',
    'config_save_preset'         => 'ENREGISTRER LE PRÉRÉGLAGE',

    // ── Queue form ────────────────────────────────────────────────────────────
    'queue_title'                => 'Inkybot - File d\'attente',
    'queue_stat_preset'          => 'Préréglage des Caractéristiques',
    'queue_config_preset'        => 'Préréglage de la Configuration',
    'queue_move_up'              => 'Monter',
    'queue_move_down'            => 'Descendre',
    'queue_remove'               => 'Supprimer',
    'queue_clear'                => 'Effacer la file d\'attente',

    // ── Popup: Setup form — Target (Cible) ────────────────────────────────────
    'popup_sf_cible_label'       => 'Cible',
    'popup_sf_cible_desc'        => 'La valeur de la caractéristique que vous souhaiteriez idéalement atteindre lors du forgemagie.',
    'popup_sf_cible_example'     => '"J\'aimerais atteindre 250 Vitalité si possible."',

    // ── Popup: Setup form — Priority (Priorité) ───────────────────────────────
    'popup_sf_priorite_label'    => 'Priorité',
    'popup_sf_priorite_desc'     => 'Lorsque le reliquat est disponible, les caractéristiques de priorité élevée sont améliorées en premier.',
    'popup_sf_priorite_example'  => '"La Vitalité sera priorisée en premier, puis % Résistance Neutre, etc."',

    // ── Popup: Setup form — Minimum ───────────────────────────────────────────
    'popup_sf_minimum_label'     => 'Minimum',
    'popup_sf_minimum_desc'      => 'Un plancher strict — le bot n\'acceptera jamais une valeur inférieure à celle-ci.',
    'popup_sf_minimum_example'   => '"Je dois atteindre au moins 240 Vitalité, ne pas se satisfaire de moins."',

    // ── Popup: Config form — Use Runes ────────────────────────────────────────
    'popup_cf_use_runes_label'   => 'Utiliser des Runes',
    'popup_cf_use_runes_desc'    => 'Activez ou désactivez l\'utilisation de ce type de rune pour cette caractéristique.',
    'popup_cf_use_runes_example' => '"Ne pas utiliser la rune SM Sagesse."',

    // ── Popup: Config form — Max for Rune ─────────────────────────────────────
    'popup_cf_max_rune_label'    => 'Max pour la Rune',
    'popup_cf_max_rune_desc'     => 'Le bot n\'utilisera plus cette rune une fois que la caractéristique atteint cette valeur, quel que soit le reliquat restant.',
    'popup_cf_max_rune_example'  => '"Arrêter d\'utiliser les runes PA Vit après avoir atteint 115."',

    // ── Popup: Config form — Rune Threshold ───────────────────────────────────
    'popup_cf_threshold_label'   => 'Seuil de Rune',
    'popup_cf_threshold_desc'    => 'La valeur de la caractéristique à laquelle le bot passe à l\'utilisation du niveau de rune supérieur.',
    'popup_cf_threshold_example' => '"Passer à la rune PA Vit quand la Vitalité atteint 90."',

    // ── Popup: Config form — Custom Script ────────────────────────────────────
    'popup_cf_script_label'      => 'Script Personnalisé',
    'popup_cf_script_desc'       => 'Chargez un script personnalisé pour remplacer le comportement IA par défaut.',

    // ── Popup: Config form — Presets ──────────────────────────────────────────
    'popup_cf_presets_label'     => 'Préréglages',
    'popup_cf_presets_desc'      => 'Sauvegardez votre configuration actuelle comme préréglage pour une utilisation ultérieure.',

    // ── Popup: Queue form — Maging Queue ──────────────────────────────────────
    'popup_qf_queue_label'       => 'File de Forgemagie',
    'popup_qf_queue_desc'        => 'Ajoutez des objets à la file pour que le bot continue en arrière-plan avec différents préréglages.',
    'popup_qf_queue_example'     => '"Le Gelano est le suivant — le bot commencera automatiquement à le forgemager après avoir terminé l\'objet actuel."',
];
