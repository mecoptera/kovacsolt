import axios from 'axios';
import SmartComponent from '../../libs/smartcomponent';

export default class KArea extends SmartComponent {
  init() {
    this._container = super._parseHTML('<div class="c-area__container"></div>');

    super.init({
      className: 'c-area',
      render: {
        container: this._container
      }
    });
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

  static get template() {
    return (html, component) => html`<div class="c-area__loading">Loading...</div>`;
  }

  connectedCallback() {
    super.connectedCallback();

    this._startAreaLoading();
  }

  _startAreaLoading() {
    const name = this._state.get('name');
    const endpoint = this._state.get('endpoint');

    axios.get(endpoint + name).then(response => this._container.innerHTML = response.data.content);
  }
}
