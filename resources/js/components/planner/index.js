import tingle from 'tingle.js';
import { html } from 'lighterhtml';
import SmartComponent from '../../libs/smartcomponent';

const designTemplate = data => {
  return html`<k-resizer><img src="${data.url}"></k-resizer>`
};

export default class KPlanner extends SmartComponent {
  init() {
    super.init({
      className: 'q-planner'
    });

    this._modal = new tingle.modal({
      footer: true,
      stickyFooter: true,
      closeMethods: ['overlay', 'button', 'escape']
    });

    this._modal.addFooterBtn('Mégse', 'c-button c-button--link', this._modal.close.bind(this));
    this._modal.addFooterBtn('Hozzáadom', 'c-button', this._addDesignToZone.bind(this));
  }

  static get observedAttributes() {
    return ['data-zone-width', 'data-zone-height', 'data-zone-left', 'data-zone-top', 'data-area-url'];
  }

  static get boundProperties() {
    return [
      { name: 'dataZoneWidth', as: 'zoneWidth' },
      { name: 'dataZoneHeight', as: 'zoneHeight' },
      { name: 'dataZoneLeft', as: 'zoneLeft' },
      { name: 'dataZoneTop', as: 'zoneTop' },
      { name: 'dataAreaUrl', as: 'areaUrl' }
    ];
  }

  static get eventHandlers() {
    return {
      'selectDesign:click': '_selectDesignHandler'
    };
  }

  get template() {
    return html => {
      const state = this._state.get();
      const zoneStyle = `width: ${state.zoneWidth}%; height: ${state.zoneHeight}%; left: ${state.zoneLeft}%; top: ${state.zoneTop}%;`;

      return html`
        <div class="l-grid__row">
          <div class="l-grid__col-sm-7">
            <div class="q-planner__product">
              <div class="q-planner__zone" style="${zoneStyle}">
                ${state.designs && state.designs.map(designTemplate)}
              </div>
            </div>
          </div>
          <div class="l-grid__col-sm-5">
            <div class="q-planner-settings">
              <div class="q-planner-settings__title">Szín</div>
              <div class="q-planner-settings__content">
                <k-select data-name="dsads">
                  <k-select-option data-value="0">dsadsa</k-select-option>
                  <k-select-option data-value="1">ds423sa</k-select-option>
                  <k-select-option data-value="2">dsa432a</k-select-option>
                  <k-select-option data-value="3">ds234dsa</k-select-option>
                </k-select>
              </div>

              <div class="q-planner-settings__title">Minta</div>
              <div class="q-planner-settings__content">
                <button data-handler="selectDesign" onclick="${this}" class="c-button">Katalógus megnyitása</button>
              </div>
            </div>
          </div>
        </div>
      `;
    };
  }

  _selectDesignHandler() {
    const areaUrl = this._state.get('areaUrl');

    this._modal.setContent(`<k-area data-name="designs" data-endpoint="${areaUrl}"></k-area>`);

    this._modal.open();
  }

  _addDesignToZone() {
    const currentDesigns = this._state.get('designs') || [];
    const input = this._modal.modalBoxContent.querySelector('input:checked');
    const designs = currentDesigns.concat([{ id: Symbol(), id: input.value, url: input.getAttribute('url') }]);

    this._state.set('designs', designs);

    this._modal.close();
  }
}
