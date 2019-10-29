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
    return ['data-area-endpoint'];
  }

  static get boundProperties() {
    return [
      { name: 'dataAreaEndpoint', as: 'areaEndpoint' }
    ];
  }

  static get eventHandlers() {
    return {
      ':click': '_clickHandler'
    };
  }

  get template() {
    return [{
      name: 'popup',
      markup: html => html`<k-area data-endpoint="${this._state.get('areaEndpoint')}" data-name="cartButton"></k-area>`,
      container: this._templater.parseHTML('<div class="q-cart-button__popup"></div>')
    }];
  }

  _clickHandler(event) {
    const container = this._templater.getContainer('popup');

    if (container === event.target || container.contains(event.target)) { return false; }

    this.appendChild(container);

    container.classList.toggle('q-cart-button__popup--visible');
  }
}
