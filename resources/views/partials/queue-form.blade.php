<style>
    .queue-window {
        width: 430px;
        background-color: #1e1e1e;
        border: 1px solid #3E3E42;
        display: flex;
        flex-direction: column;
        box-shadow: 0 3px 8px rgba(0,0,0,0.5);
        color: #EFEFEF;
        font-family: sans-serif;
    }

    .queue-window .title-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0 7px;
        background-color: #FFFFFF;
        color: #000000;
        height: 21px;
        user-select: none;
        flex-shrink: 0;
    }

    .queue-window .title { font-size: 8px; display: flex; align-items: center; gap: 6px; }
    .queue-window .title-icon { width: 14px; height: 14px; margin-top: 1px; }
    .queue-window .controls { display: flex; height: 100%; }
    .queue-window .control-btn {
        width: 21px; display: flex; justify-content: center;
        align-items: center; font-size: 10px; color: #000000;
    }

    .queue-window .content {
        flex: 1;
        overflow-y: auto;
        background-color: #1e1e1e;
        display: flex;
        flex-direction: column;
    }

    .queue-window .queue-item {
        display: flex;
        align-items: center;
        padding: 8px 10px;
        border-bottom: 1px solid #3E3E42;
        gap: 10px;
    }

    .queue-window .item-icon-placeholder {
        width: 36px;
        height: 36px;
        background-color: #2D2D30;
        display: flex;
        justify-content: center;
        align-items: center;
        border: 1px solid #3E3E42;
        border-radius: 2px;
        flex-shrink: 0;
    }

    .queue-window .icon-gloursonne { background: radial-gradient(circle, #b19356 0%, #3e331c 100%); }
    .queue-window .icon-veinard    { background: radial-gradient(circle, #5b7573 0%, #1e2a2a 100%); }
    .queue-window .icon-crocanneau { background: radial-gradient(circle, #4fa699 0%, #1f423d 100%); }
    .queue-window .icon-gelano     { background: radial-gradient(circle, #9b7fd4 0%, #2d1a5a 100%); }
    .queue-window .icon-douze      { background: radial-gradient(circle, #d4a017 0%, #5a3800 100%); }

    .queue-window .item-details {
        display: flex;
        gap: 8px;
        flex: 1;
    }

    .queue-window .detail-col {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .queue-window .detail-label {
        color: #dcdcdc;
        font-size: 9px;
    }

    .queue-window .custom-dropdown {
        display: flex;
        align-items: stretch;
        background-color: #080808;
        height: 19px;
    }

    .queue-window .custom-dropdown-text {
        flex: 1;
        padding: 0 5px;
        font-size: 9px;
        display: flex;
        align-items: center;
        color: #EFEFEF;
    }

    .queue-window .custom-dropdown-arrow {
        background-color: #FFFFFF;
        color: #000000;
        width: 16px;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 7px;
        flex-shrink: 0;
    }

    .queue-window .item-actions {
        display: flex;
        flex-direction: column;
        gap: 3px;
        flex-shrink: 0;
    }

    .queue-window .action-btn {
        background-color: #080808;
        color: #EFEFEF;
        border: none;
        padding: 3px 6px;
        font-size: 9px;
        text-align: center;
        text-transform: uppercase;
        width: 70px;
    }

    .queue-window .footer {
        padding: 7px 8px;
        background-color: #1e1e1e;
        border-top: 1px solid #3E3E42;
        flex-shrink: 0;
    }

    .queue-window .button {
        background-color: #080808;
        color: #EFEFEF;
        border: none;
        padding: 7px 8px;
        font-size: 9px;
        text-align: center;
        text-transform: uppercase;
        width: 100%;
    }
</style>

<div class="queue-window">
    <div class="title-bar">
        <div class="title">
            <svg class="title-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 34 34">
                <path fill="#000" transform="translate(3 0)" d="M 25.875 0.0625 C 7.531 0.0625 8.78125 11.4375 8.78125 11.4375 C 8.2290994 12.246696 7.6995693 13.046426 7.25 13.84375 C 7.2192731 13.898245 7.1865288 13.94563 7.15625 14 L 4 14 A 1.0001 1.0001 0 0 0 3.90625 14 A 1.001098 1.001098 0 0 0 3.5 15.90625 L 3 16 C 1.343 16 0 17.344 0 19 L 0 23 C 0 24.656 1.343 26 3 26 L 13 26 C 14.657 26 16 24.656 16 23 L 16 19 C 16 17.344 14.657 16 13 16 L 12.46875 15.875 A 1.0001 1.0001 0 0 0 12 14 L 8.78125 14 C 9.3768313 12.98664 10.046844 11.978044 10.8125 10.96875 C 10.850157 10.925536 10.924518 10.804345 10.96875 10.75 C 11.312321 10.305889 11.682667 9.871631 12.0625 9.4375 C 12.206935 9.262417 12.364614 9.0972071 12.53125 8.90625 C 14.065329 7.2428175 15.90652 5.6997788 18.0625 4.40625 C 16.2125 6.10525 13.15425 9.5635 11.65625 12.1875 C 14.10025 12.4015 17.5465 11.016 19.9375 9 C 19.3975 8.939 16.875 8.48475 16.125 7.84375 C 17.563 7.95975 19.95325 7.97425 20.90625 7.90625 C 22.84525 6.47025 25.063 3.0785 25.875 0.0625 z"/>
            </svg>
            Inkybot - File d'attente
        </div>
        <div class="controls">
            <div class="control-btn">_</div>
            <div class="control-btn close">✕</div>
        </div>
    </div>

    <div class="content" data-hl="qf-queue">
        <div class="queue-item">
            <div class="item-icon-placeholder icon-gloursonne"></div>
            <div class="item-details">
                <div class="detail-col">
                    <div class="detail-label">Préréglage des Caractéristiques</div>
                    <div class="custom-dropdown" style="width: 130px;">
                        <div class="custom-dropdown-text">Alliance Gloursonne MP</div>
                        <div class="custom-dropdown-arrow">▼</div>
                    </div>
                </div>
                <div class="detail-col">
                    <div class="detail-label">Config</div>
                    <div class="custom-dropdown" style="width: 75px;">
                        <div class="custom-dropdown-text">Rapide</div>
                        <div class="custom-dropdown-arrow">▼</div>
                    </div>
                </div>
            </div>
            <div class="item-actions">
                <div class="action-btn">Monter</div>
                <div class="action-btn">Descendre</div>
                <div class="action-btn">Supprimer</div>
            </div>
        </div>

        <div class="queue-item">
            <div class="item-icon-placeholder icon-veinard"></div>
            <div class="item-details">
                <div class="detail-col">
                    <div class="detail-label">Préréglage des Caractéristiques</div>
                    <div class="custom-dropdown" style="width: 130px;">
                        <div class="custom-dropdown-text">Gant du Valet Veinard AP</div>
                        <div class="custom-dropdown-arrow">▼</div>
                    </div>
                </div>
                <div class="detail-col">
                    <div class="detail-label">Config</div>
                    <div class="custom-dropdown" style="width: 75px;">
                        <div class="custom-dropdown-text">Défaut</div>
                        <div class="custom-dropdown-arrow">▼</div>
                    </div>
                </div>
            </div>
            <div class="item-actions">
                <div class="action-btn">Monter</div>
                <div class="action-btn">Descendre</div>
                <div class="action-btn">Supprimer</div>
            </div>
        </div>

        <div class="queue-item">
            <div class="item-icon-placeholder icon-crocanneau"></div>
            <div class="item-details">
                <div class="detail-col">
                    <div class="detail-label">Préréglage des Caractéristiques</div>
                    <div class="custom-dropdown" style="width: 130px;">
                        <div class="custom-dropdown-text">Crocanneau MP</div>
                        <div class="custom-dropdown-arrow">▼</div>
                    </div>
                </div>
                <div class="detail-col">
                    <div class="detail-label">Config</div>
                    <div class="custom-dropdown" style="width: 75px;">
                        <div class="custom-dropdown-text">Rapide</div>
                        <div class="custom-dropdown-arrow">▼</div>
                    </div>
                </div>
            </div>
            <div class="item-actions">
                <div class="action-btn">Monter</div>
                <div class="action-btn">Descendre</div>
                <div class="action-btn">Supprimer</div>
            </div>
        </div>

        <div class="queue-item">
            <div class="item-icon-placeholder icon-crocanneau"></div>
            <div class="item-details">
                <div class="detail-col">
                    <div class="detail-label">Préréglage des Caractéristiques</div>
                    <div class="custom-dropdown" style="width: 130px;">
                        <div class="custom-dropdown-text">Crocanneau AP</div>
                        <div class="custom-dropdown-arrow">▼</div>
                    </div>
                </div>
                <div class="detail-col">
                    <div class="detail-label">Config</div>
                    <div class="custom-dropdown" style="width: 75px;">
                        <div class="custom-dropdown-text">Rapide</div>
                        <div class="custom-dropdown-arrow">▼</div>
                    </div>
                </div>
            </div>
            <div class="item-actions">
                <div class="action-btn">Monter</div>
                <div class="action-btn">Descendre</div>
                <div class="action-btn">Supprimer</div>
            </div>
        </div>

        <div class="queue-item">
            <div class="item-icon-placeholder icon-gelano"></div>
            <div class="item-details">
                <div class="detail-col">
                    <div class="detail-label">Préréglage des Caractéristiques</div>
                    <div class="custom-dropdown" style="width: 130px;">
                        <div class="custom-dropdown-text">Anneau de Gelano MP</div>
                        <div class="custom-dropdown-arrow">▼</div>
                    </div>
                </div>
                <div class="detail-col">
                    <div class="detail-label">Config</div>
                    <div class="custom-dropdown" style="width: 75px;">
                        <div class="custom-dropdown-text">Défaut</div>
                        <div class="custom-dropdown-arrow">▼</div>
                    </div>
                </div>
            </div>
            <div class="item-actions">
                <div class="action-btn">Monter</div>
                <div class="action-btn">Descendre</div>
                <div class="action-btn">Supprimer</div>
            </div>
        </div>
    </div>

    <div class="footer">
        <div class="button">Effacer la file d'attente</div>
    </div>
</div>
