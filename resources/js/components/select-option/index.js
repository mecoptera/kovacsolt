import SmartComponent from '../../libs/smartcomponent';

export default class KSelectOption extends SmartComponent {
  init() {
    super.init({
      className: 'c-select-option',
      notifyParent: true,
      watchContent: true
    });
  }

  static get observedAttributes() {
    return ['data-value'];
  }

  static get boundProperties() {
    return [
      { name: 'dataValue', as: 'value' }
    ];
  }

  connectedCallback() {
    super.connectedCallback();

    this._state.set('content', this.textContent);
  }

  contentChangedCallback() {
    this._state.set('content', this.textContent);
  }
}
