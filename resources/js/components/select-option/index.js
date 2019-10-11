import Bamboo from '@dkocsis-emarsys/bamboo';

export default class KSelectOption extends Bamboo {
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
