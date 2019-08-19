import tingle from 'tingle.js';
import SmartComponent from '../../libs/smartcomponent';

const patternTemplate = data => {
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
    this._modal.addFooterBtn('Hozzáadom', 'c-button', this._addPatternToZone.bind(this));
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
      'selectPattern:click': '_selectPatternHandler'
    };
  }

  static get template() {
    return (html, component) => {
      const state = component._state.get();
      const zoneStyle = `width: ${state.zoneWidth}%; height: ${state.zoneHeight}%; left: ${state.zoneLeft}%; top: ${state.zoneTop}%;`;

      return html`
        <div class="q-planner__left">
          <button class="c-button" data-handler="selectPattern" onclick="${component}">Minta kiválasztása</button>
          <b>Minták</b>
        </div>
        <div class="q-planner__middle">
          <div class="q-planner__product">
            <div class="q-planner__zone" style="${zoneStyle}">
              ${state.patterns && state.patterns.map(patternTemplate)}
            </div>
          </div>
        </div>
        <div class="q-planner__right"></div>
      `;
    };
  }

  _selectPatternHandler() {
    const areaUrl = this._state.get('areaUrl');

    this._modal.setContent(`<k-area data-name="patterns" data-endpoint="${areaUrl}"></k-area>`);

    this._modal.open();
  }

  _addPatternToZone() {
    const currentPatterns = this._state.get('patterns') || [];
    const input = this._modal.modalBoxContent.querySelector('input:checked');
    const patterns = currentPatterns.concat([{ id: Symbol(), id: input.value, url: input.getAttribute('url') }]);

    this._state.set('patterns', patterns);

    this._modal.close();
  }
}
