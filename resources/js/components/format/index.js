import Bamboo from '@dkocsis-emarsys/bamboo';

export default class KFormat extends Bamboo {
  static get observedAttributes() {
    return ['data-value'];
  }

  static get boundProperties() {
    return [{ name: 'dataValue', as: 'value' }];
  }

  get template() {
    return html => html`${this._format(this._state.get('value'))}`;
  }

  _format(value) {
    if (!value) { return 0; }

    return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ' ');
  }
}
