import axios from 'axios';
import Bamboo from '@dkocsis-emarsys/bamboo';

export default class KArea extends Bamboo {
  init() {
    super.init({ className: 'c-area' });
  }

  static get observedAttributes() {
    return ['data-name', 'data-endpoint'];
  }

  static get boundProperties() {
    return [
      { name: 'dataName', as: 'name' },
      { name: 'dataEndpoint', as: 'endpoint' }
    ];
  }

  get template() {
    return [{
      name: 'area',
      markup: html => html`<div class="c-area__loading">Loading...</div>`,
      container: this._templater.parseHTML('<div class="c-area__container"></div>'),
      autoAppendContainer: true
    }];
  }

  connectedCallback() {
    super.connectedCallback();

    this._startAreaLoading();
  }

  _startAreaLoading() {
    const name = this._state.get('name');
    const endpoint = this._state.get('endpoint');

    axios.get(endpoint + name).then(response => this._templater.getContainer('area').innerHTML = response.data.content);
  }
}
