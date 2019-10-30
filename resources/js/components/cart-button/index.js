import axios from 'axios';
import Bamboo from '@dkocsis-emarsys/bamboo';

export default class KCartButton extends Bamboo {
  init() {
    super.init({
      className: 'q-cart-button',
      listenChildren: true
    });
  }

  static get observedAttributes() {
    return ['data-area-endpoint', 'data-count'];
  }

  static get boundProperties() {
    return [
      { name: 'dataAreaEndpoint', as: 'areaEndpoint' },
      { name: 'dataCount', as: 'count' }
    ];
  }

  static get eventHandlers() {
    return {
      ':click': '_clickHandler'
    };
  }

  get template() {
    return [
      {
        name: 'button',
        markup: html => this._state.get('count') > 0 ? html`<div class="q-cart-button__badge">${this._state.get('count')}</div>` : html``,
        container: this._templater.parseHTML('<div></div>'),
        autoAppendContainer: true
      },
      {
        name: 'popup',
        markup: html => html`<div class="q-cart-button__panel"><k-area data-endpoint="${this._state.get('areaEndpoint')}" data-name="cartButton"></k-area></div>`,
        container: this._templater.parseHTML('<div class="q-cart-button__popup"></div>')
      }
    ];
  }

  _clickHandler(event) {
    const container = this._templater.getContainer('popup');

    if (container === event.target || container.contains(event.target)) { return false; }

    this.appendChild(container);

    container.classList.toggle('q-cart-button__popup--visible');
  }
}
